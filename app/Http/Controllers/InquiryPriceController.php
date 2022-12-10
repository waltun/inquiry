<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\InquiryPrice;
use App\Models\Part;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\InquiryPriceNotification;
use Carbon\Carbon;
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
        $part = Part::find($request->part_id);
        $setting = Setting::where('active', '1')->first();

        if ($setting) {
            if ($setting->price_color_type == 'month') {
                $lastTime = \Carbon\Carbon::now()->subMonth($setting->price_color_last_time);
            }
            if ($setting->price_color_type == 'day') {
                $lastTime = \Carbon\Carbon::now()->subDay($setting->price_color_last_time);
            }
            if ($setting->price_color_type == 'hour') {
                $lastTime = \Carbon\Carbon::now()->subHour($setting->price_color_last_time);
            }
        }

        if ($part->collection == '1' && !$part->children->isEmpty()) {
            foreach ($part->children as $child) {
                if (($child->price_updated_at < $lastTime && $child->price > 0) || ($child->price_updated_at < $lastTime && $child->price == 0)) {
                    $inquiryPrice = auth()->user()->inquiryPrices()->create([
                        'part_id' => $child->id,
                        'inquiry_id' => $request->inquiry_id
                    ]);
                }
            }
        } else {
            $inquiryPrice = auth()->user()->inquiryPrices()->create([
                'part_id' => $request->part_id,
                'inquiry_id' => $request->inquiry_id
            ]);
        }

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
            $inquiryPrices = InquiryPrice::where('part_id', $part)->get();
            foreach ($inquiryPrices as $inquiryPrice) {
                if ($updatedPart->price !== (int)$request->prices[$index]) {
                    $percentPrice = $updatedPart->price + $updatedPart->price / 5;
                    if (($request->prices[$index] >= $percentPrice) && !$updatedPart->percent_submit) {
                        $updatedPart->percent_submit = true;
                        $updatedPart->save();
                    } else {
                        $updatedPart->update([
                            'price' => $request->prices[$index],
                            'old_price' => $updatedPart->price,
                            'price_updated_at' => now(),
                            'percent_submit' => 0,
                        ]);

                        if (!$updatedPart->parents->isEmpty()) {
                            foreach ($updatedPart->parents as $parent) {
                                $price = 0;
                                foreach ($parent->children as $child) {
                                    $price += $child->price * $child->pivot->value;
                                }
                                $parent->update([
                                    'price' => $price,
                                    'old_price' => $parent->price,
                                    'price_updated_at' => now(),
                                    'updated_at' => now()
                                ]);
                            }
                        }
                        $inquiryPrice->delete();
                    }
                }
            }
        }

        alert()->success('ثبت موفق', 'ثبت قیمت گذاری با موفقیت انجام شد');
        return back();
    }

    public function updateDate(Request $request)
    {
        $part = Part::find($request->id);
        $inquiryPrices = InquiryPrice::where('part_id', $part->id)->get();

        foreach ($inquiryPrices as $inquiryPrice) {
            if ($part->price != 0 && !is_null($part->price)) {
                $part->price_updated_at = Carbon::now();
                $part->save();
                $inquiryPrice->delete();
            } else {
                return response(['data' => 'error']);
            }
        }
    }
}
