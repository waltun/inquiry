<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Part;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PartPriceController extends Controller
{
    public function index()
    {
        Gate::authorize('price');

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
        Gate::authorize('price');

        $request->validate([
            'prices' => 'required|array',
            'prices.*' => 'nullable|numeric'
        ]);

        foreach ($request->parts as $index => $part) {
            $updatedPart = Part::where('id', $part)->first();
            if ($updatedPart->price !== (int)$request->prices[$index]) {
                $updatedPart->update([
                    'price' => $request->prices[$index],
                    'old_price' => $updatedPart->price,
                    'price_updated_at' => now()
                ]);
            }
        }

        alert()->success('ثبت موفق', 'ثبت قیمت گذاری با موفقیت انجام شد');

        return redirect()->route('parts.price.index');
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
}
