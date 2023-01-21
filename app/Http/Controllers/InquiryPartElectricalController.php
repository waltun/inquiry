<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inquiry;
use App\Models\Part;
use App\Models\Product;
use Illuminate\Http\Request;

class InquiryPartElectricalController extends Controller
{
    public function index(Request $request, Inquiry $inquiry)
    {
        $request->validate([
            'electrical_type' => 'required|in:air'
        ]);

        if ($request['electrical_type'] == 'air') {
            $part = Part::find('2249');
            return redirect()->route('inquiryPart.electrical.air', [$inquiry->id, $part->id]);
        }
    }

    public function air(Inquiry $inquiry, Part $part)
    {
        $categories = Category::where('parent_id', 0)->get();
        return view('calculate.inquiry-electrical.air', compact('part', 'categories', 'inquiry'));
    }

    public function calculateAir(Request $request)
    {
        $sorts = $request->sorts;
        $part_ids = $request->part_ids;
        $values = $request->values;
        $name = "LCP-AHU";

        alert()->success('محاسبه موفق', 'محاسبه با موفقیت انجام شد');

        return back()->with(['sorts' => $sorts, 'name' => $name, 'part_ids' => $part_ids, 'values' => $values]);
    }

    public function storeAir(Request $request, Inquiry $inquiry, Part $part)
    {
        $request->validate([
            'values' => 'required|array',
            'values.*' => 'required|numeric',
            'quantity' => 'required|numeric'
        ]);

        $name = $request['name'];
        $code = $this->getLastCode($part);

        $newPart = $part->replicate()->fill([
            'name' => $name,
            'code' => $code,
            'coil' => true,
            'price_updated_at' => now(),
            'inquiry_id' => $inquiry->id,
            'price' => $request['price'],
            'weight' => $request['weight']
        ]);
        $newPart->save();

        if (isset($request->categories)) {
            if (!is_null($request->categories[0])) {
                $newPart->categories()->sync($request['categories']);
            } else {
                $newPart->categories()->sync($part->categories);
            }
        } else {
            $newPart->categories()->sync($part->categories);
        }

        foreach ($request['part_ids'] as $index => $id) {
            $newPart->children()->attach($id, [
                'parent_part_id' => $request->part_ids[$index],
                'value' => $request->values[$index],
                'sort' => $request->sorts[$index]
            ]);
        }

        if ($inquiry->products()->where('part_id', '!=', 0)->get()->isEmpty()) {
            $sort = 1;
        } else {
            $product = $inquiry->products()->where('part_id', '!=', 0)->max('sort');
            $sort = $product + 1;
        }

        $inquiry->products()->create([
            'part_id' => $newPart->id,
            'quantity' => $request['quantity'],
            'sort' => $sort,
            'weight' => $request['weight'] * $request['quantity']
        ]);

        alert()->success('محاسبه موفق', 'محاسبه تابلو محلی با موفقیت انجام شد');

        return redirect()->route('inquiries.parts.index', $inquiry->id);
    }

    public function getLastCode($part)
    {
        $category = $part->categories()->latest()->first();
        $categoryPart = $category->parts->toArray();
        if (count($categoryPart) > 0) {
            $lastPart = $categoryPart[count($categoryPart) - 1];
            $code = str_pad($lastPart['code'] + 1, 4, "0", STR_PAD_LEFT);
        }
        return $code;
    }
}
