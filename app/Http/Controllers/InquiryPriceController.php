<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\InquiryPrice;
use App\Models\Part;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class InquiryPriceController extends Controller
{
    public function index()
    {
        Gate::authorize('price');

        $inquiryPrices = InquiryPrice::all()->unique('inquiry_id');
        return view('inquiry-price.index', compact('inquiryPrices'));
    }

    public function store(Request $request)
    {
        auth()->user()->inquiryPrices()->create([
            'part_id' => $request->part_id,
            'inquiry_id' => $request->inquiry_id
        ]);
    }

    public function update(Request $request, Inquiry $inquiry)
    {
        Gate::authorize('price');

        $request->validate([
            'prices' => 'required|array',
            'prices.*' => 'nullable|numeric'
        ]);

        foreach ($request->parts as $index => $part) {
            $updatedPart = Part::find($part);
            $inquiryPrice = InquiryPrice::where('part_id', $part)->first();

            if ($updatedPart->price !== (int)$request->prices[$index]) {
                $updatedPart->update([
                    'price' => $request->prices[$index],
                    'old_price' => $updatedPart->price,
                    'price_updated_at' => now()
                ]);

                $inquiryPrice->delete();
            }
        }

        alert()->success('ثبت موفق', 'ثبت قیمت گذاری با موفقیت انجام شد');

        return back();
    }
}
