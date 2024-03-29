<?php

namespace App\Http\Controllers;

use App\Models\Amount;
use App\Models\Category;
use App\Models\Group;
use App\Models\Inquiry;
use App\Models\Modell;
use App\Models\Part;
use App\Models\Product;
use App\Models\Special;
use Illuminate\Http\Request;

class NewPartInquiryController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:create-new-inquiry-part')->only(['create', 'store']);
        $this->middleware('can:delete-new-inquiry-part')->only(['destroy']);
    }

    public function create(Product $product)
    {
        $modell = Modell::find($product->model_id);
        $group = Group::find($product->group_id);
        $categories = Category::where('parent_id', 0)->get();

        $parts = Part::query();

        if ($keyword = request('search')) {
            $parts->where('name', 'LIKE', "%{$keyword}%")
                ->whereNotIn('id', $modell->parts->pluck('id'));
        }

        if (request()->has('calculate') && !is_null(request('calculate'))) {
            $specials = Special::all()->pluck('part_id');
            $parts->where('coil', '=', '1')->where('standard', '!=', '1')
                ->whereIn('id', $specials);
        }

        if (!is_null(request('category3'))) {
            if (request()->has('category3')) {
                $parts = $parts->whereHas('categories', function ($q) {
                    $q->where('category_id', request('category3'));
                });
            }
        }

        if (is_null(request('category3'))) {
            if (request()->has('category2')) {
                $parts = $parts->whereHas('categories', function ($q) {
                    $q->where('category_id', request('category2'));
                });
            }
        }

        if (request()->has('calculate')) {
            $parts = $parts
                ->whereIn('id', [170, 169, 168, 167, 149, 148, 147, 146, 150, 1194, 1301, 1879, 2144, 2249, 2256, 2264]);
        }

        $parts = $parts->whereNotIn('id', $product->amounts->pluck('part_id'))->latest()->paginate(25)->withQueryString();

        return view('inquiry-new-part.create', compact('product', 'group', 'modell', 'categories', 'parts'));
    }

    public function store(Request $request, Product $product, Part $part)
    {
        $request->validate([
            'value' => 'required|numeric'
        ]);

        $lastSort = $product->amounts()->max('sort');
        $sort = $lastSort + 1;

        $product->amounts()->create([
            'value' => $request['value'],
            'value2' => $request['value2'] ?? null,
            'sort' => $sort,
            'part_id' => $part->id,
            'price' => 0
        ]);

        alert()->success('ثبت موفق', 'افزودن قطعه به محصول استعلام با موفقیت انجام شد');

        return redirect()->route('inquiries.product.amounts', $product->id);
    }

    public function destroy(Amount $amount)
    {
        $product = Product::find($amount->product_id);

        foreach ($product->amounts as $amount2) {
            if ($amount2->sort > $amount->sort) {
                $amount2->sort = $amount2->sort - 1;
                $amount2->save();
            }
        }

        $amount->delete();

        return response(['success']);
    }
}
