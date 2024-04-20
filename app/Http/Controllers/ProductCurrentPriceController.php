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
        $modells = Modell::where('standard', true)->with('parts')->get();

        $setting = Setting::where('active', '1')->first();
        switch ($setting->price_color_type) {
            case 'month' :
                $lastTime = Carbon::now()->subMonth($setting->price_color_last_time);
                break;
            case 'day' :
                $lastTime = Carbon::now()->subDay($setting->price_color_last_time);
                break;
            case 'hour' :
                $lastTime = Carbon::now()->subHour($setting->price_color_last_time);
                break;
        }

        foreach ($modells as $modell) {
            foreach ($modell->parts as $part) {
                $this->processInquiryParts($part, $lastTime, $modell);

                if ($part->collection) {
                    $price = $this->calculatePrice($part);
                    $part->price = $price;
                    $part->price_updated_at = now();
                    $part->save();
                }
            }
        }

        return view('product-current-price.index', compact('modells'));
    }

    function processInquiryParts($part, $lastTime, $modell)
    {
        if (!$part->children->isEmpty()) {
            foreach ($part->children as $child) {
                $this->processInquiryParts($child, $lastTime, $modell);
            }
        } else {
            if (
                !auth()->user()->inquiryPrices()->where('part_id', $part->id)->exists() &&
                (($part->price_updated_at < $lastTime && $part->price > 0) || ($part->price_updated_at < $lastTime && $part->price == 0))
            ) {
                auth()->user()->inquiryPrices()->create([
                    'part_id' => $part->id,
                    'inquiry_id' => null,
                    'product_id' => $modell->id
                ]);
            }
        }
    }

    function calculatePrice($part)
    {
        $price = 0;

        foreach ($part->children()->wherePivot('head_part_id', $part->parent->id ?? null)->orderBy('sort', 'ASC')->get() as $child) {
            if (!$child->children->isEmpty()) {
                $price += $this->calculatePrice($child);
            } else {
                $price += $child->price * $child->pivot->value;
            }
        }

        return $price;
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
