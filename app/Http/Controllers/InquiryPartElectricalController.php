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
            'electrical_type' => 'required'
        ]);

        if ($request['electrical_type'] == 'air') {
            $part = Part::find('2249');
            return redirect()->route('inquiryPart.electrical.air', [$inquiry->id, $part->id]);
        }

        if ($request['electrical_type'] == 'chiller') {
            $part = Part::find('2144');
            return redirect()->route('inquiryPart.electrical.chiller', [$inquiry->id, $part->id]);
        }

        if ($request['electrical_type'] == 'mini') {
            $part = Part::find('2264');
            return redirect()->route('inquiryPart.electrical.mini', [$inquiry->id, $part->id]);
        }

        if ($request['electrical_type'] == 'panel') {
            $part = Part::find('1879');
            return redirect()->route('inquiryPart.electrical.panel', [$inquiry->id, $part->id]);
        }

        if ($request['electrical_type'] == 'zent') {
            $part = Part::find('2256');
            return redirect()->route('inquiryPart.electrical.zent', [$inquiry->id, $part->id]);
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

        foreach ($part->children()->orderBy('sort', 'ASC')->get() as $child) {
            $newPart->children()->attach($child->id, [
                'sort' => $child->pivot->sort,
            ]);
        }

        foreach ($newPart->children()->orderBy('sort', 'ASC')->get() as $index => $child) {
            foreach ($request->part_ids[$index] as $index2 => $id) {
                $child->children()->attach($request->part_ids[$index][$index2], [
                    'head_part_id' => $newPart->id,
                    'value' => $request->values[$index][$index2],
                    'sort' => $request->sorts[$index][$index2],
                    'datasheet' => 1
                ]);
            }
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

    public function chiller(Inquiry $inquiry, Part $part)
    {
        $categories = Category::where('parent_id', 0)->get();
        return view('calculate.inquiry-electrical.chiller', compact('part', 'categories', 'inquiry'));
    }

    public function calculateChiller(Request $request)
    {
        $sorts = $request->sorts;
        $part_ids = $request->part_ids;
        $values = $request->values;
        $name = "LCP-AC";

        alert()->success('محاسبه موفق', 'محاسبه با موفقیت انجام شد');

        return back()->with(['sorts' => $sorts, 'name' => $name, 'part_ids' => $part_ids, 'values' => $values]);
    }

    public function storeChiller(Request $request, Inquiry $inquiry, Part $part)
    {
        $request->validate([
            'values' => 'required|array',
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

        foreach ($part->children()->orderBy('sort', 'ASC')->get() as $child) {
            $newPart->children()->attach($child->id, [
                'sort' => $child->pivot->sort,
            ]);
        }

        foreach ($newPart->children()->orderBy('sort', 'ASC')->get() as $index => $child) {
            foreach ($request->part_ids[$index] as $index2 => $id) {
                $child->children()->attach($request->part_ids[$index][$index2], [
                    'head_part_id' => $newPart->id,
                    'value' => $request->values[$index][$index2],
                    'sort' => $request->sorts[$index][$index2],
                    'datasheet' => 1
                ]);
            }
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

    public function mini(Inquiry $inquiry, Part $part)
    {
        $categories = Category::where('parent_id', 0)->get();
        return view('calculate.inquiry-electrical.mini', compact('part', 'categories', 'inquiry'));
    }

    public function calculateMini(Request $request)
    {
        $sorts = $request->sorts;
        $part_ids = $request->part_ids;
        $values = $request->values;
        $name = "LCP-MACH";

        alert()->success('محاسبه موفق', 'محاسبه با موفقیت انجام شد');

        return back()->with(['sorts' => $sorts, 'name' => $name, 'part_ids' => $part_ids, 'values' => $values]);
    }

    public function storeMini(Request $request, Inquiry $inquiry, Part $part)
    {
        $request->validate([
            'values' => 'required|array',
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

        foreach ($part->children()->orderBy('sort', 'ASC')->get() as $child) {
            $newPart->children()->attach($child->id, [
                'sort' => $child->pivot->sort,
            ]);
        }

        foreach ($newPart->children()->orderBy('sort', 'ASC')->get() as $index => $child) {
            foreach ($request->part_ids[$index] as $index2 => $id) {
                $child->children()->attach($request->part_ids[$index][$index2], [
                    'head_part_id' => $newPart->id,
                    'value' => $request->values[$index][$index2],
                    'sort' => $request->sorts[$index][$index2],
                    'datasheet' => 1
                ]);
            }
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

    public function panel(Inquiry $inquiry, Part $part)
    {
        $categories = Category::where('parent_id', 0)->get();
        return view('calculate.inquiry-electrical.panel', compact('part', 'categories', 'inquiry'));
    }

    public function calculatePanel(Request $request)
    {
        $sorts = $request->sorts;
        $part_ids = $request->part_ids;
        $values = $request->values;
        $name = "LCP-PU";

        alert()->success('محاسبه موفق', 'محاسبه با موفقیت انجام شد');

        return back()->with(['sorts' => $sorts, 'name' => $name, 'part_ids' => $part_ids, 'values' => $values]);
    }

    public function storePanel(Request $request, Inquiry $inquiry, Part $part)
    {
        $request->validate([
            'values' => 'required|array',
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

        foreach ($part->children()->orderBy('sort', 'ASC')->get() as $child) {
            $newPart->children()->attach($child->id, [
                'sort' => $child->pivot->sort,
            ]);
        }

        foreach ($newPart->children()->orderBy('sort', 'ASC')->get() as $index => $child) {
            foreach ($request->part_ids[$index] as $index2 => $id) {
                $child->children()->attach($request->part_ids[$index][$index2], [
                    'head_part_id' => $newPart->id,
                    'value' => $request->values[$index][$index2],
                    'sort' => $request->sorts[$index][$index2],
                    'datasheet' => 1
                ]);
            }
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

    public function zent(Inquiry $inquiry, Part $part)
    {
        $categories = Category::where('parent_id', 0)->get();
        return view('calculate.inquiry-electrical.zent', compact('part', 'categories', 'inquiry'));
    }

    public function calculateZent(Request $request)
    {
        $sorts = $request->sorts;
        $part_ids = $request->part_ids;
        $values = $request->values;
        $name = "LCP-AHW";

        alert()->success('محاسبه موفق', 'محاسبه با موفقیت انجام شد');

        return back()->with(['sorts' => $sorts, 'name' => $name, 'part_ids' => $part_ids, 'values' => $values]);
    }

    public function storeZent(Request $request, Inquiry $inquiry, Part $part)
    {
        $request->validate([
            'values' => 'required|array',
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

        foreach ($part->children()->orderBy('sort', 'ASC')->get() as $child) {
            $newPart->children()->attach($child->id, [
                'sort' => $child->pivot->sort,
            ]);
        }

        foreach ($newPart->children()->orderBy('sort', 'ASC')->get() as $index => $child) {
            foreach ($request->part_ids[$index] as $index2 => $id) {
                $child->children()->attach($request->part_ids[$index][$index2], [
                    'head_part_id' => $newPart->id,
                    'value' => $request->values[$index][$index2],
                    'sort' => $request->sorts[$index][$index2],
                    'datasheet' => 1
                ]);
            }
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
