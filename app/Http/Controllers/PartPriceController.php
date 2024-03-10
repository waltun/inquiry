<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\InquiryPrice;
use App\Models\Part;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PartPriceController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:part-price')->only(['index']);
        $this->middleware('can:part-price-update')->only(['update', 'updateDate', 'multiUpdateDate']);
    }

    public function index()
    {
        $parts = Part::query();
        $categories = Category::where('parent_id', 0)->get();
        $setting = Setting::where('active', '1')->first();

        if ($setting->price_color_type == 'month') {
            $lastTime = \Carbon\Carbon::now()->subMonth($setting->price_color_last_time);
            $midTime = \Carbon\Carbon::now()->subMonth($setting->price_color_mid_time);
        }
        if ($setting->price_color_type == 'day') {
            $lastTime = \Carbon\Carbon::now()->subDay($setting->price_color_last_time);
            $midTime = \Carbon\Carbon::now()->subDay($setting->price_color_mid_time);
        }
        if ($setting->price_color_type == 'hour') {
            $lastTime = \Carbon\Carbon::now()->subHour($setting->price_color_last_time);
            $midTime = \Carbon\Carbon::now()->subHour($setting->price_color_mid_time);
        }

        if ($keyword = request('search')) {
            $parts->where('collection', false)
                ->where('coil', false)
                ->where('name', 'LIKE', "%{$keyword}%");
        }

        if (request('price') == "no-price") {
            $parts->where('collection', false)
                ->where('coil', false)
                ->where('price', '=', 0)
                ->where('price_updated_at', '<', $lastTime);
        }

        if (request('price') == "success-price") {
            $parts->where('collection', false)
                ->where('coil', false)
                ->where('price', '>', 0)
                ->where('price_updated_at', '>', $lastTime)
                ->where('price_updated_at', '>', $midTime);
        }

        if (request('price') == "expired-price") {
            $parts->where('collection', false)
                ->where('coil', false)
                ->where('price', '>', 0)
                ->where('price_updated_at', '<', $lastTime);
        }

        if (request('price') == "mid-price") {
            $parts->where('collection', false)
                ->where('coil', false)
                ->where('price', '>', 0)
                ->where('price_updated_at', '>', $lastTime)
                ->where('price_updated_at', '<', $midTime);
        }

        if (!is_null(request('category3'))) {
            if (request()->has('category3')) {
                $parts = $parts->whereHas('categories', function ($q) {
                    $q->where('category_id', request('category3'));
                })->where('collection', false)->where('coil', false);
            }
        }

        if (is_null(request('category3'))) {
            if (request()->has('category2')) {
                $parts = $parts->whereHas('categories', function ($q) {
                    $q->where('category_id', request('category2'));
                })->where('collection', false)->where('coil', false);
            }
        }

        $parts = $parts->where('collection', false)->where('coil', false)
            ->orderBy('price_updated_at', 'ASC')->paginate(25)->withQueryString();

        return view('part-price.index', compact('parts', 'categories', 'setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'prices' => 'required|array',
            'prices.*' => 'nullable|numeric'
        ]);

        foreach ($request->parts as $index => $id) {
            $part = Part::where('id', $id)->first();
            $inquiryPrices = InquiryPrice::where('part_id', $part->id)->get();
            if ($part->price !== (int)$request->prices[$index]) {
                if ($part->price != 0) {
                    $percentPrice = $part->price + $part->price / 2;
                    if (($request->prices[$index] >= $percentPrice) && !$part->percent_submit) {
                        $part->percent_submit = true;
                        $part->save();
                    } else {
                        $inquiryPrices = InquiryPrice::where('part_id', $part->id)->get();
                        $part->update([
                            'price' => $request->prices[$index],
                            'old_price' => $part->price,
                            'price_updated_at' => now(),
                            'percent_submit' => 0,
                            'weight' => $request->weights[$index],
                            'factory_code' => $request->factory_codes[$index]
                        ]);

                        foreach ($inquiryPrices as $inquiryPrice) {
                            $inquiryPrice->delete();
                        }
                    }
                } else {
                    $part->update([
                        'price' => $request->prices[$index],
                        'old_price' => $part->price,
                        'price_updated_at' => now(),
                        'percent_submit' => 0,
                        'weight' => $request->weights[$index],
                        'factory_code' => $request->factory_codes[$index]
                    ]);

                    foreach ($inquiryPrices as $inquiryPrice) {
                        $inquiryPrice->delete();
                    }
                }
            } else if ($part->weight !== (int)$request->weights[$index]) {
                $part->update([
                    'weight' => $request->weights[$index],
                    'factory_code' => $request->factory_codes[$index]
                ]);
            }
        }

        alert()->success('ثبت موفق', 'ثبت قیمت گذاری با موفقیت انجام شد');

        return back();
    }

    public function updateDate(Request $request)
    {
        $part = Part::find($request->id);
        if ($part->price != 0 && !is_null($part->price)) {
            $part->price_updated_at = Carbon::now();
            $part->save();
        } else {
            return response(['data' => 'error']);
        }
    }

    public function multiUpdateDate(Request $request)
    {
        foreach ($request->ids as $id) {
            $part = Part::find($id);

            if ($part->price != 0 && !is_null($part->price)) {
                $part->price_updated_at = Carbon::now();
                $part->save();
            } else {
                return response(['data' => 'error']);
            }
        }
        return response('success', '200');
    }
}
