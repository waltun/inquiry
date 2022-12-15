<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Part;
use Illuminate\Http\Request;

class SeparateCalculateElectricalController extends Controller
{
    public function index()
    {
        $panel = Part::find('1879');
        return view('calculate.separate-electrical.index', compact('panel'));
    }

    public function panel(Part $part)
    {
        $categories = Category::where('parent_id', 0)->get();
        return view('calculate.separate-electrical.panel', compact('part', 'categories'));
    }

    public function calculatePanel(Request $request)
    {
        $sorts = $request->sorts;
        $part_ids = $request->part_ids;
        $values = $request->values;
        $name = "LCP-PU-";

        alert()->success('محاسبه موفق', 'محاسبه با موفقیت انجام شد');

        return back()->with(['sorts' => $sorts, 'name' => $name, 'part_ids' => $part_ids, 'values' => $values]);
    }

    public function storePanel(Request $request, Part $part)
    {
        $request->validate([
            'values' => 'required|array',
            'values.*' => 'required|numeric'
        ]);

        $code = $this->getLastCode($part);

        $newPart = $part->replicate()->fill([
            'name' => $request->name,
            'code' => $code,
            'coil' => true,
            'price_updated_at' => now(),
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

        $totalPrice = 0;
        foreach ($request['part_ids'] as $index => $id) {
            $childPart = Part::find($id);

            $newPart->children()->attach($id, [
                'parent_part_id' => $request->part_ids[$index],
                'value' => $request->values[$index],
                'sort' => $request->sorts[$index]
            ]);

            $totalPrice += ($childPart->price * $request->values[$index]);
        }
        $newPart->price = $totalPrice;
        $newPart->save();

        alert()->success('محاسبه موفق', 'محاسبه تابلو برق با موفقیت انجام شد');

        return redirect()->route('separate.electrical.index');
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
