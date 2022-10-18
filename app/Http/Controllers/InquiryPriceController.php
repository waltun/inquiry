<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\InquiryPrice;
use App\Models\Part;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\InquiryPriceNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;

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
        $inquiryPrice = auth()->user()->inquiryPrices()->create([
            'part_id' => $request->part_id,
            'inquiry_id' => $request->inquiry_id
        ]);

        $priceUsers = User::where('role', 'price')->orWhere('role', 'logistic')->get();
        Notification::send($priceUsers, new InquiryPriceNotification($inquiryPrice));
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
