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

        $types = ['setup', 'years', 'control', 'power_cable', 'control_cable', 'pipe', 'install_setup_price', 'setup_price', 'supervision', 'transport', 'other', 'setup_one', 'install', 'cable', 'canal', 'copper_piping', 'carbon_piping', 'coil', null];

        foreach ($types as $type) {
            if ($request['submitType'] == $type) {
                foreach ($inquiry->products()->where('part_id', '!=', 0)->where('type', $type)->get() as $index => $product) {
                    $product->update([
                        'part_id' => $request->part_ids[$index],
                        'quantity' => $request->quantities[$index],
                        'quantity2' => $request->quantities2[$index] ?? null,
                        'description' => $request->tags[$index],
                        'type' => $request->types[$index],
                        'price' => $request->prices[$index] ?? 0,
                    ]);
                }
            }
        }

        alert()->success('ثبت موفق', 'ثبت مقادیر با موفقیت انجام شد');

        return back();
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
