<?php

namespace App\Http\Controllers;

use App\Models\Amount;
use App\Models\Category;
use App\Models\ContractProductAmount;
use App\Models\DeleteButton;
use App\Models\InquiryPrice;
use App\Models\Part;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PartController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:parts')->only(['index']);
        $this->middleware('can:create-part')->only(['create', 'store']);
        $this->middleware('can:edit-part')->only(['edit', 'update']);
        $this->middleware('can:delete-part')->only(['destroy']);
        $this->middleware('can:replicate-part')->only(['replicate']);
    }

    public function index()
    {
        Gate::authorize('parts');

        $parts = Part::query();
        $categories = Category::where('parent_id', 0)->get();
        $delete = DeleteButton::where('active', '1')->first();

        if ($keyword = request('search')) {
            $parts->where('coil', false)
                ->where('collection', false)
                ->where('name', 'LIKE', "%{$keyword}%");
        }

        if (!is_null(request('category3'))) {
            if (request()->has('category3')) {
                $parts = $parts->whereHas('categories', function ($q) {
                    $q->where('category_id', request('category3'));
                })->where('coil', false)->where('collection', false);
            }
        }

        if (is_null(request('category3'))) {
            if (request()->has('category2')) {
                $parts = $parts->whereHas('categories', function ($q) {
                    $q->where('category_id', request('category2'));
                })->where('coil', false)->where('collection', false);
            }
        }

        $parts = $parts->where('coil', false)->where('collection', false)->latest()
            ->paginate(25)->withQueryString();

        return view('parts.index', compact('parts', 'categories', 'delete'));
    }

    public function create()
    {
        Gate::authorize('parts');

        $categories = Category::where('parent_id', 0)->with(['parts'])->get();

        return view('parts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        Gate::authorize('parts');

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
            'price' => 'nullable|numeric',
            'collection' => 'required|in:true,false',
            'categories' => 'required|array|min:3|max:3',
            'unit2' => 'nullable|string|max:255',
            'operator1' => 'nullable|string|max:255',
            'operator2' => 'nullable|string|max:255',
            'formula1' => 'nullable|numeric',
            'formula2' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'name_en' => 'nullable|string|max:255',
            'extract' => 'required|in:0,1',
            'analyzee' => 'required|in:0,1',
            'factory_code' => 'nullable|numeric'
        ]);

        if ($data['collection'] == 'true') {
            $data['collection'] = true;
        } else {
            $data['collection'] = false;
        }

        if (count($request['categories']) == 3 && $request['categories'][2] != "") {
            $part = Part::create($data);
            $part->categories()->sync($data['categories']);
            $code = $this->getLastCode($part);
            $part->code = $code;
            $part->price_updated_at = now();
            $part->save();
        } else {
            return back()->withErrors(['لطفا دسته بندی را به صورت کامل وارد کنید']);
        }

        alert()->success('ثبت موفق', 'ثبت قطعه با موفقیت انجام شد');

        if ($data['collection']) {
            return redirect()->route('collections.index');
        }
        return redirect()->route('parts.index');
    }

    public function edit(Part $part)
    {
        Gate::authorize('parts');

        $categories = Category::with(['parts'])->where('parent_id', 0)->get();

        return view('parts.edit', compact('part', 'categories'));
    }

    public function update(Request $request, Part $part)
    {
        Gate::authorize('parts');

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
            'price' => 'nullable',
            'collection' => 'required|in:true,false',
            'categories' => 'required|array',
            'unit2' => 'nullable|string|max:255',
            'operator1' => 'nullable|string|max:255',
            'operator2' => 'nullable|string|max:255',
            'formula1' => 'nullable|numeric',
            'formula2' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'name_en' => 'nullable|string|max:255',
            'extract' => 'required|in:0,1',
            'analyzee' => 'required|in:0,1',
            'factory_code' => 'nullable|numeric'
        ]);

        if ($data['collection'] == 'true') {
            $data['collection'] = true;
        } else {
            $data['collection'] = false;
        }

        $part->update($data);
        $part->categories()->detach();
        $part->categories()->sync($data['categories']);

        $inquiryPrices = InquiryPrice::where('part_id', $part->id)->get();
        foreach ($inquiryPrices as $inquiryPrice) {
            $inquiryPrice->delete();
        }

        alert()->success('ویرایش موفق', 'ویرایش قطعه با موفقیت انجام شد');

        if ($data['collection']) {
            return redirect()->route('collections.index');
        }
        return redirect()->route('parts.index');
    }

    public function destroy(Part $part)
    {
        Gate::authorize('parts');

        $contractPart = ContractProductAmount::where('part_id', $part->id)->get();
        $productPart = Product::where('part_id', $part->id)->get();
        $amountPart = Amount::where('part_id', $part->id)->get();

        if (!$contractPart->isEmpty() || !$productPart->isEmpty() || !$amountPart->isEmpty()) {
            alert()->error('هشدار حذف', 'این قطعه در قرارداد، پیش فاکتور یا استعلام استفاده شده');
            return back();
        } else {
            $part->delete();
        }

        alert()->success('حذف موفق', 'حذف قطعه با موفقیت انجام شد');

        return back();
    }

    public function replicate(Part $part)
    {
        Gate::authorize('parts');

        $category = $part->categories()->latest()->first();
        $lastPart = $category->parts()->latest()->first();
        $code = str_pad($lastPart->code + 1, 4, "0", STR_PAD_LEFT);

        $newPart = $part->replicate()->fill([
            'code' => $code,
            'name' => $part->name . " کپی شده ",
        ]);
        $newPart->save();

        foreach ($part->categories as $category) {
            $newPart->categories()->attach($category->id);
        }

        if (!$part->children->isEmpty()) {
            foreach ($part->children()->orderByPivot('sort', 'ASC')->get() as $child) {
                $newPart->children()->attach($child->id, [
                    'value' => $child->pivot->value,
                    'sort' => $child->pivot->sort
                ]);
            }
        }

        alert()->success('کپی موفق', 'کپی قطعه با موفقیت انجام شد');

        return back();
    }

    public function getCategory(Request $request)
    {
        $category = Category::find($request->id);
        $children = $category->children;

        if (count($children) > 0) {
            return response(['data' => $children]);
        }
        return response(['data' => null]);
    }

    public function getLastCode($part)
    {
        $parts = Part::all();
        if (!$parts->isEmpty()) {
            $category = $part->categories()->latest()->first();
            $categoryPart = $category->parts->toArray();

            if (count($categoryPart) == 1) {
                $code = '0001';
            }
            if (count($categoryPart) == 2) {
                $lastPart = $categoryPart[0];
                $code = str_pad($lastPart['code'] + 1, 4, "0", STR_PAD_LEFT);
            }
            if (count($categoryPart) > 2) {
                $lastPart = $categoryPart[count($categoryPart) - 2];
                $code = str_pad($lastPart['code'] + 1, 4, "0", STR_PAD_LEFT);
            }
        } else {
            $code = '0001';
        }
        return $code;
    }
}
