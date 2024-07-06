<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inquiry;
use App\Models\InquiryPrice;
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
    public function __construct()
    {
        $this->middleware('can:inquiry-parts')->only(['index']);
        $this->middleware('can:create-inquiry-part')->only(['create', 'store']);
        $this->middleware('can:delete-inquiry-part')->only(['destroy']);
        $this->middleware('can:inquiry-part-multi-percent')->only(['multiPercent']);
        $this->middleware('can:inquiry-part-amounts')->only(['storeAmounts']);
    }

    public function index(Inquiry $inquiry)
    {
        $setting = Setting::where('active', '1')->first();
        $specials = Special::all()->pluck('part_id')->toArray();

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

        $partIds = InquiryPrice::select(['part_id'])->distinct()->pluck('part_id')->toArray();

        foreach ($inquiry->products()->where('part_id', '!=', 0)->get() as $product) {
            $part = \App\Models\Part::find($product->part_id);

            if (!$part->children->isEmpty()) {
                foreach ($part->children as $child) {
                    if (!$child->children->isEmpty()) {
                        foreach ($child->children as $ch) {
                            if (!in_array($ch->id, $partIds)) {
                                if (($ch->price_updated_at < $lastTime && $ch->price > 0) || ($ch->price_updated_at < $lastTime && $ch->price == 0)) {
                                    auth()->user()->inquiryPrices()->create([
                                        'part_id' => $ch->id,
                                        'inquiry_id' => $inquiry->id
                                    ]);
                                }
                            }
                        }
                    } else {
                        if (!in_array($child->id, $partIds)) {
                            if (($child->price_updated_at < $lastTime && $child->price > 0) || ($child->price_updated_at < $lastTime && $child->price == 0)) {

                                auth()->user()->inquiryPrices()->create([
                                    'part_id' => $child->id,
                                    'inquiry_id' => $inquiry->id
                                ]);
                            }
                        }
                    }
                }
            } else {
                if (!in_array($part->id, $partIds)) {
                    if (($part->price_updated_at < $lastTime && $part->price > 0) || ($part->price_updated_at < $lastTime && $part->price == 0)) {
                        auth()->user()->inquiryPrices()->create([
                            'part_id' => $part->id,
                            'inquiry_id' => $inquiry->id
                        ]);
                    }
                }
            }
        }

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

        $parts = $parts->latest()->paginate(25)->withQueryString();

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
                'percent_by' => $request->user()->id
            ]);
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

        $electricalIds = [492, 493, 494, 495, 496];

        $types = ['setup', 'years', 'control', 'power_cable', 'control_cable', 'pipe', 'install_setup_price', 'setup_price', 'supervision', 'transport', 'other', 'setup_one', 'install', 'cable', 'canal', 'copper_piping', 'carbon_piping', 'coil', null];

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

        foreach ($types as $type) {
            if ($request['submitType'] == $type) {
                foreach ($inquiry->products()->where('part_id', '!=', 0)->where('type', $type)->get() as $index => $product) {
                    $part = Part::find($product->part_id);

                    $product->update([
                        'part_id' => $request->part_ids[$index],
                        'quantity' => $request->quantities[$index],
                        'quantity2' => $request->quantities2[$index] ?? null,
                        'description' => $request->tags[$index],
                        'type' => $request->types[$index],
                        'price' => $request->prices[$index] ?? $product->price,
                    ]);

                    if ($product->inquiry->submit) {
                        if ($request->quantities[$index] > 0) {
                            if (!in_array($part->categories->last()->id, $electricalIds)) {
                                $this->processInquiryParts($part, $lastTime, $product->inquiry, $electricalIds);
                            }
                        }

                        if ($part->collection) {
                            if (!in_array($part->categories->last()->id, $electricalIds)) {
                                $this->calculatePrice($part, $electricalIds);
                            }
                        }
                    }
                }
            }
        }

        alert()->success('ثبت موفق', 'ثبت مقادیر با موفقیت انجام شد');

        return back();
    }

    function processInquiryParts($part, $lastTime, $inquiry, $electricalIds)
    {
        if (!in_array($part->categories->last()->id, $electricalIds)) {
            if (!$part->children->isEmpty()) {
                foreach ($part->children as $child) {
                    $this->processInquiryParts($child, $lastTime, $inquiry, $electricalIds);
                }
            } else {
                if (
                    !auth()->user()->inquiryPrices()->where('part_id', $part->id)->where('inquiry_id', $inquiry->id)->exists() &&
                    (($part->price_updated_at < $lastTime && $part->price > 0) || ($part->price_updated_at < $lastTime && $part->price == 0))
                ) {
                    auth()->user()->inquiryPrices()->create([
                        'part_id' => $part->id,
                        'inquiry_id' => $inquiry->id
                    ]);
                }
            }
        }
    }

    function calculatePrice($part, $electricalIds)
    {
        $price = 0;

        if (!in_array($part->categories->last()->id, $electricalIds)) {
            foreach ($part->children as $child) {
                if ($child->collection && !$child->children()->where('head_part_id', $part->id)->get()->isEmpty()) {
                    foreach ($child->children()->where('head_part_id', $part->id)->get() as $sefid) {
                        if (!$sefid->children->isEmpty()) {
                            $price += $this->calculatePrice($sefid, $electricalIds) * $sefid->pivot->value;
                        } else {
                            $price += $sefid->price * $sefid->pivot->value;
                        }
                    }
                } elseif (!$child->children->isEmpty()) {
                    $price += $this->calculatePrice($child, $electricalIds) * $child->pivot->value;
                } else {
                    $price += $child->price * $child->pivot->value;
                }
            }

            $part->price = $price;
            $part->price_updated_at = now();
            $part->save();
        }

        return $price;
    }

    public function getCode(array $data)
    {
        $inquiries = Inquiry::select('inquiry_number')->where('inquiry_number', '!=', null)->get();

        $number = 0;
        foreach ($inquiries as $inquiry) {
            if ((int)$inquiry->inquiry_number > $number) {
                $number = (int)$inquiry->inquiry_number;
            }
        }

        $year = jdate(now())->getYear();
        $first4 = substr((string)$number, 0, 4);

        if (!$inquiries->isEmpty()) {
            if ($year > (int)$first4) {
                $inquiryNumber = '00001';
                $data['inquiry_number'] = $year . $inquiryNumber;
            } else {
                $inquiryNumber = str_pad($number + 1, 5, "0", STR_PAD_LEFT);
                $data['inquiry_number'] = $inquiryNumber;
            }
        } else {
            $inquiryNumber = '00001';
            $data['inquiry_number'] = $year . $inquiryNumber;
        }
        return $data;
    }
}
