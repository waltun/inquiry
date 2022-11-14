<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inquiry;
use App\Models\Part;
use App\Models\Product;
use App\Models\Setting;
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

        return view('inquiry-part.index', compact('inquiry', 'setting'));
    }

    public function create(Inquiry $inquiry)
    {
        $parts = Part::query();
        $categories = Category::where('parent_id', 0)->get();

        if ($keyword = request('search')) {
            $parts->where('name', 'LIKE', "%{$keyword}%")
                ->whereNotIn('id', $inquiry->products->pluck('part_id'));
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

        $parts = $parts->whereNotIn('id', $inquiry->products->pluck('part_id'))->latest()->paginate(25);

        return view('inquiry-part.create', compact('inquiry', 'categories', 'parts'));
    }

    public function store(Request $request, Inquiry $inquiry, Part $part)
    {
        $request->validate([
            'quantity' => 'required|numeric',
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
            'quantity2' => $request['quantity2'] ?? null
        ]);

        alert()->success('ثبت موفق', 'ثبت قطعه برای استعلام با موفقیت انجام شد');

        return back();
    }

    public function destroy(Inquiry $inquiry, Part $part)
    {
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
            'part_ids' => 'required|array'
        ]);

        foreach ($inquiry->products()->where('part_id', '!=', 0)->get() as $index => $product) {
            $product->update([
                'part_id' => $request->part_ids[$index],
                'quantity' => $request->quantities[$index],
                'quantity2' => $request->quantities2[$index] ?? null,
            ]);
        }

        alert()->success('ثبت موفق', 'ثبت مقادیر با موفقیت انجام شد');

        return back();
    }
}
