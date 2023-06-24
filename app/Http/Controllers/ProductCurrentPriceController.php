<?php

namespace App\Http\Controllers;

use App\Models\CurrentPrice;
use App\Models\InquiryPrice;
use App\Models\Modell;
use App\Models\Part;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductCurrentPriceController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:current-price')->only(['index']);
    }

    public function index()
    {
        $modells = Modell::where('standard', true)->get();

        $setting = Setting::where('active', '1')->first();
        switch ($setting->price_color_type) {
            case 'month' :
                $lastTime = Carbon::now()->subMonth($setting->price_color_last_time);
                $midTime = Carbon::now()->subMonth($setting->price_color_mid_time);
                break;
            case 'day' :
                $lastTime = Carbon::now()->subDay($setting->price_color_last_time);
                $midTime = Carbon::now()->subDay($setting->price_color_mid_time);
                break;
            case 'hour' :
                $lastTime = Carbon::now()->subHour($setting->price_color_last_time);
                $midTime = Carbon::now()->subHour($setting->price_color_mid_time);
                break;
        }

        foreach ($modells as $modell) {
            foreach ($modell->parts as $part) {
                $productPriceIds = InquiryPrice::where('part_id', $part->id)->pluck('part_id')->toArray();
                $parentIds = Part::whereIn('id', InquiryPrice::all()->pluck('part_id'))->whereHas('parents')->pluck('id')->flatten()->toArray();

                if (!in_array($part->id, $productPriceIds) && !in_array($part->id, $parentIds)) {
                    if ($part->price_updated_at < $lastTime && $part->price > 0) {
                        InquiryPrice::create([
                            'user_id' => auth()->user()->id,
                            'part_id' => $part->id,
                            'inquiry_id' => null,
                            'product_id' => $modell->id
                        ]);
                    }
                    if ($part->price_updated_at < $lastTime && $part->price == 0) {
                        InquiryPrice::create([
                            'user_id' => auth()->user()->id,
                            'part_id' => $part->id,
                            'inquiry_id' => null,
                            'product_id' => $modell->id
                        ]);
                    }
                }
            }
        }

        return view('product-current-price.index', compact('modells'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'percents' => 'array',
            'modells' => 'array'
        ]);

        foreach ($request->modells as $index => $id) {
            $modell = Modell::find($id);
            $modell->percent = $request->percents[$index];
            $modell->save();
        }

        alert()->success('ثبت موفق', 'ضرایب با موفقیت ثبت شدند');

        return back();
    }
}
