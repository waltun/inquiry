<?php

namespace App\Http\Controllers;

use App\Models\Amount;
use App\Models\Group;
use App\Models\Inquiry;
use App\Models\Modell;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class InquiryProductController extends Controller
{
    public function index(Inquiry $inquiry)
    {
        return view('inquiry-product.index', compact('inquiry'));
    }

    public function create(Inquiry $inquiry)
    {
        $groups = Group::all();
        return view('inquiry-product.create', compact('groups', 'inquiry'));
    }

    public function store(Request $request, Inquiry $inquiry)
    {
        $request->validate([
            'group_id' => 'required|integer',
            'model_id' => 'required|integer',
            'quantity' => 'required|numeric|min:1'
        ]);

        $inquiry->products()->create([
            'group_id' => $request['group_id'],
            'model_id' => $request['model_id'],
            'quantity' => $request['quantity']
        ]);

        alert()->success('ثبت موفق', 'ثبت محصول برای استعلام با موفقیت انجام شد');

        return redirect()->route('inquiries.index');
    }

    public function show(Product $product)
    {
        $group = Group::find($product->group_id);
        $modell = Modell::find($product->model_id);
        $inquiry = Inquiry::find($product->inquiry_id);
        $totalPrice = 0;
        return view('inquiry-product.show', compact('product', 'inquiry', 'group', 'modell', 'totalPrice'));
    }

    public function amounts(Product $product)
    {
        $group = Group::find($product->group_id);
        $modell = Modell::find($product->model_id);
        $inquiry = Inquiry::find($product->inquiry_id);
        return view('inquiry-product.amounts', compact('product', 'group', 'modell', 'inquiry'));
    }

    public function storeAmounts(Request $request, Product $product)
    {
        Gate::authorize('inquiry-amounts');

        $group = Group::find($product->group_id);
        $inquiry = Inquiry::find($product->inquiry_id);

        $request->validate([
            'amounts' => 'required|array',
            'amounts.*' => 'required|numeric'
        ]);

        foreach ($group->parts as $index => $part) {
            $amount = Amount::where('part_id', $part->id)->where('product_id', $product->id)->first();

            if ($amount) {
                if ($amount->value != $request->amounts[$index]) {
                    $amount->update([
                        'value' => $request->amounts[$index]
                    ]);
                }
            } else {
                Amount::create([
                    'value' => $request->amounts[$index],
                    'product_id' => $product->id,
                    'part_id' => $part->id
                ]);
            }
        }

        $product->updated_at = now();
        $product->save();

        alert()->success('ثبت موفق', 'ثبت مقادیر با موفقیت انجام شد');

        return redirect()->route('inquiries.product.index', $inquiry->id);
    }

    public function percent(Product $product)
    {
        Gate::authorize('inquiry-percent');

        $totalPrice = 0;

        $group = Group::find($product->group_id);
        $modell = Modell::find($product->model_id);
        $inquiry = Inquiry::find($product->inquiry_id);

        foreach ($group->parts as $part) {
            $amount = $product->amounts()->where('part_id', $part->id)->first();
            if ($amount) {
                $totalPrice += ($part->price * $amount->value);
            }
        }

        return view('inquiry-product.percent', compact('inquiry', 'group', 'modell', 'totalPrice', 'product'));
    }

    public function storePercent(Request $request, Product $product)
    {
        Gate::authorize('inquiry-percent');

        $request->validate([
            'percent' => 'required|numeric|between:0,1'
        ]);

        $totalPrice = 0;

        $group = Group::find($product->group_id);
        $inquiry = Inquiry::find($product->inquiry_id);

        foreach ($group->parts as $part) {
            $amount = $product->amounts()->where('part_id', $part->id)->first();
            if ($amount) {
                $totalPrice += ($part->price * $amount->value);
            }
        }

        $finalPrice = ($totalPrice * $product->quantity) / $request['percent'];

        $product->update([
            'price' => $finalPrice,
            'percent' => $request['percent'],
        ]);

        if (!$inquiry->products->pluck('percent')->contains(0)) {
            $inquiry->archive_at = now();
            $inquiry->price = $inquiry->products->sum('price');
            $inquiry->save();
        }

        alert()->success('ثبت ضریب موفق', 'ثبت ضریب با موفقیت انجام شد و برای کاربر ارسال شد');

        return redirect()->route('inquiries.product.index', $inquiry->id);
    }
}
