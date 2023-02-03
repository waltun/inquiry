<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inquiry;
use App\Models\Part;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Special;
use App\Models\User;
use App\Notifications\PercentInquiryNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class InquiryPartController extends Controller
{
    public function index(Inquiry $inquiry)
    {
        Gate::authorize('create-inquiry');

        $setting = Setting::where('active', '1')->first();
        $specials = Special::all()->pluck('part_id')->toArray();

        return view('inquiry-part.index', compact('inquiry', 'setting', 'specials'));
    }

    public function create(Inquiry $inquiry)
    {
        $parts = Part::query();
        $categories = Category::where('parent_id', 0)->get();

        if ($keyword = request('search')) {
            $parts->where('name', 'LIKE', "%{$keyword}%");
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

        $parts = $parts->latest()->paginate(25);

        return view('inquiry-part.create', compact('inquiry', 'categories', 'parts'));
    }

    public function store(Request $request, Inquiry $inquiry, Part $part)
    {
        $request->validate([
            'quantity' => 'required|numeric',
            'type' => 'required'
        ]);

        $sort = 0;
        if ($inquiry->products()->where('part_id', '!=', 0)->get()->isEmpty()) {
            $sort = 1;
        } else {
            $product = $inquiry->products()->where('part_id', '!=', 0)->max('sort');
            $sort = $product + 1;
        }

        $inquiry->products()->create([
            'part_id' => $part->id,
            'quantity' => $request['quantity'],
            'sort' => $sort,
            'quantity2' => $request['quantity2'] ?? null,
            'description' => $request['tag'],
            'weight' => $part->weight * $request['quantity'],
            'type' => $request['type']
        ]);

        alert()->success('ثبت موفق', 'ثبت قطعه برای استعلام با موفقیت انجام شد');

        return back();
    }

    public function destroy(Inquiry $inquiry, Part $part)
    {
        foreach ($inquiry->products()->where('part_id', '!=', null)->get() as $product) {
            if ($product->sort > $inquiry->products()->where('part_id', $part->id)->first()->sort) {
                $product->sort = $product->sort - 1;
                $product->save();
            }
        }

        $inquiry->products()->where('part_id', $part->id)->delete();

        alert()->success('حذف موفق', 'حذف قطعه تکی با موفقیت انجام شد');
    }

    public function multiPercent(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'percent' => 'required|numeric|between:1,3'
        ]);

        foreach ($request->ids as $id) {
            $product = Product::find($id);
            $inquiryPart = Part::find($product->part_id);
            $inquiry = Inquiry::find($product->inquiry_id);
            $user = User::find($inquiry->user_id);

            if (!is_null($inquiryPart)) {
                $finalPrice = $inquiryPart->price * $request->percent;
                $product->part_price = $inquiryPart->price;
                $product->save();
            }

            $product->update([
                'price' => $finalPrice,
                'percent' => $request->percent,
            ]);
        }

        if (!$inquiry->products->pluck('percent')->contains(0)) {
            $inquiry->archive_at = now();
            $finalTotalPrice = 0;
            foreach ($inquiry->products as $product) {
                $finalTotalPrice += $product->price * $product->quantity;
            }
            $inquiry->price = $finalTotalPrice;
            $inquiry->save();

            //Send Notification
            $user->notify(new PercentInquiryNotification($inquiry));
            return redirect()->route('inquiries.priced');
        }
    }

    public function storeAmounts(Request $request, Inquiry $inquiry)
    {
        $request->validate([
            'quantities' => 'required|array',
            'quantities.*' => 'required|numeric',
            'part_ids' => 'required|array',
            'tags' => 'nullable|array',
            'types' => 'required'
        ]);

        if ($request['type'] == 'setup') {
            foreach ($inquiry->products()->where('part_id', '!=', 0)->where('type', 'setup')->get() as $index => $product) {
                $product->update([
                    'part_id' => $request->part_ids[$index],
                    'quantity' => $request->quantities[$index],
                    'quantity2' => $request->quantities2[$index] ?? null,
                    'description' => $request->tags[$index],
                    'types' => $request->types[$index]
                ]);
            }
        }

        if ($request['type'] == 'years') {
            foreach ($inquiry->products()->where('part_id', '!=', 0)->where('type', 'years')->get() as $index => $product) {
                $product->update([
                    'part_id' => $request->part_ids[$index],
                    'quantity' => $request->quantities[$index],
                    'quantity2' => $request->quantities2[$index] ?? null,
                    'description' => $request->tags[$index],
                    'types' => $request->types[$index]
                ]);
            }
        }

        if ($request['type'] == 'control') {
            foreach ($inquiry->products()->where('part_id', '!=', 0)->where('type', 'control')->get() as $index => $product) {
                $product->update([
                    'part_id' => $request->part_ids[$index],
                    'quantity' => $request->quantities[$index],
                    'quantity2' => $request->quantities2[$index] ?? null,
                    'description' => $request->tags[$index],
                    'types' => $request->types[$index]
                ]);
            }
        }

        if ($request['type'] == 'power_cable') {
            foreach ($inquiry->products()->where('part_id', '!=', 0)->where('type', 'power_cable')->get() as $index => $product) {
                $product->update([
                    'part_id' => $request->part_ids[$index],
                    'quantity' => $request->quantities[$index],
                    'quantity2' => $request->quantities2[$index] ?? null,
                    'description' => $request->tags[$index],
                    'types' => $request->types[$index]
                ]);
            }
        }

        if ($request['type'] == 'control_cable') {
            foreach ($inquiry->products()->where('part_id', '!=', 0)->where('type', 'control_cable')->get() as $index => $product) {
                $product->update([
                    'part_id' => $request->part_ids[$index],
                    'quantity' => $request->quantities[$index],
                    'quantity2' => $request->quantities2[$index] ?? null,
                    'description' => $request->tags[$index],
                    'types' => $request->types[$index]
                ]);
            }
        }

        if ($request['type'] == 'pipe') {
            foreach ($inquiry->products()->where('part_id', '!=', 0)->where('type', 'pipe')->get() as $index => $product) {
                $product->update([
                    'part_id' => $request->part_ids[$index],
                    'quantity' => $request->quantities[$index],
                    'quantity2' => $request->quantities2[$index] ?? null,
                    'description' => $request->tags[$index],
                    'types' => $request->types[$index]
                ]);
            }
        }

        if ($request['type'] == 'setup_price') {
            foreach ($inquiry->products()->where('part_id', '!=', 0)->where('type', 'setup_price')->get() as $index => $product) {
                $product->update([
                    'part_id' => $request->part_ids[$index],
                    'quantity' => $request->quantities[$index],
                    'quantity2' => $request->quantities2[$index] ?? null,
                    'description' => $request->tags[$index],
                    'types' => $request->types[$index]
                ]);
            }
        }

        if ($request['type'] == 'supervision') {
            foreach ($inquiry->products()->where('part_id', '!=', 0)->where('type', 'supervision')->get() as $index => $product) {
                $product->update([
                    'part_id' => $request->part_ids[$index],
                    'quantity' => $request->quantities[$index],
                    'quantity2' => $request->quantities2[$index] ?? null,
                    'description' => $request->tags[$index],
                    'types' => $request->types[$index]
                ]);
            }
        }

        if ($request['type'] == 'transport') {
            foreach ($inquiry->products()->where('part_id', '!=', 0)->where('type', 'transport')->get() as $index => $product) {
                $product->update([
                    'part_id' => $request->part_ids[$index],
                    'quantity' => $request->quantities[$index],
                    'quantity2' => $request->quantities2[$index] ?? null,
                    'description' => $request->tags[$index],
                    'types' => $request->types[$index]
                ]);
            }
        }

        if ($request['type'] == 'other') {
            foreach ($inquiry->products()->where('part_id', '!=', 0)->where('type', 'other')->get() as $index => $product) {
                $product->update([
                    'part_id' => $request->part_ids[$index],
                    'quantity' => $request->quantities[$index],
                    'quantity2' => $request->quantities2[$index] ?? null,
                    'description' => $request->tags[$index],
                    'types' => $request->types[$index]
                ]);
            }
        }

        if ($request['type'] == 'previous') {
            foreach ($inquiry->products()->where('part_id', '!=', 0)->where('type', null)->get() as $index => $product) {
                $product->update([
                    'part_id' => $request->part_ids[$index],
                    'quantity' => $request->quantities[$index],
                    'quantity2' => $request->quantities2[$index] ?? null,
                    'description' => $request->tags[$index],
                    'types' => $request->types[$index]
                ]);
            }
        }

        alert()->success('ثبت موفق', 'ثبت مقادیر با موفقیت انجام شد');

        return back();
    }
}
