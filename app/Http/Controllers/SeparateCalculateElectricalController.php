<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Part;
use Illuminate\Http\Request;

class SeparateCalculateElectricalController extends Controller
{
    public function __construct()
    {
        $array = [
            'index', 'panel', 'calculatePanel', 'storePanel', 'chiller', 'calculateChiller', 'storeChiller', 'air',
            'calculateAir', 'storeAir', 'zent', 'calculateZent', 'storeZent', 'mini', 'calculateMini', 'storeMini'
        ];
        $this->middleware('can:separate-calculate-electricals')->only($array);
    }

    public function index()
    {
        $panel = Part::find('1879');
        $chiller = Part::find('2144');
        $air = Part::find('2249');
        $zent = Part::find('2256');
        $mini = Part::find('2264');
        return view('calculate.separate-electrical.index', compact('panel', 'chiller', 'air', 'zent', 'mini'));
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
        $code = $this->getLastCode($part);

        $newPart = $part->replicate()->fill([
            'name' => $request->name,
            'code' => $code,
            'coil' => true,
            'price_updated_at' => now(),
            'standard' => $request['standard']
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
        foreach ($part->children()->orderBy('sort', 'ASC')->get() as $index => $child) {
            foreach ($child->children()->orderBy('sort', 'ASC')->get() as $index2 => $ch) {
                if ($request->values[$index][$index2] > 0) {
                    $newPart->children()->attach($ch->id, [
                        'parent_part_id' => $request->part_ids[$index][$index2],
                        'value' => $request->values[$index][$index2],
                        'sort' => $request->sorts[$index][$index2]
                    ]);
                }

                $totalPrice += ($ch->price * $request->values[$index][$index2]);
            }
        }

        $newPart->price = $totalPrice;
        $newPart->save();

        alert()->success('محاسبه موفق', 'محاسبه تابلو برق با موفقیت انجام شد');

        return redirect()->route('separate.electrical.index');
    }

    public function chiller($id)
    {
        $part = Part::find($id);
        $categories = Category::where('parent_id', 0)->get();
        return view('calculate.separate-electrical.chiller', compact('part', 'categories'));
    }

    public function calculateChiller(Request $request)
    {
        $sorts = $request->sorts;
        $part_ids = $request->part_ids;
        $values = $request->values;
        $name = "LCP-AC-";

        alert()->success('محاسبه موفق', 'محاسبه با موفقیت انجام شد');

        return back()->with(['sorts' => $sorts, 'name' => $name, 'part_ids' => $part_ids, 'values' => $values]);
    }

    public function storeChiller(Request $request, $id)
    {
        $part = Part::find($id);

        $code = $this->getLastCode($part);

        $newPart = $part->replicate()->fill([
            'name' => $request->name,
            'code' => $code,
            'coil' => true,
            'price_updated_at' => now(),
            'standard' => $request['standard']
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

        $newPart->children()->syncWithoutDetaching($part->children);

        foreach ($newPart->children as $index => $child) {
            $child->children()->syncWithoutDetaching($request);
        }

        //$newPart->price = $totalPrice;
        //$newPart->save();

        alert()->success('محاسبه موفق', 'محاسبه تابلو برق با موفقیت انجام شد');

        return redirect()->route('separate.electrical.index');
    }

    public function air(Part $part)
    {
        $categories = Category::where('parent_id', 0)->get();
        return view('calculate.separate-electrical.air', compact('part', 'categories'));
    }

    public function calculateAir(Request $request)
    {
        $sorts = $request->sorts;
        $part_ids = $request->part_ids;
        $values = $request->values;
        $name = "LCP-AHU-";

        alert()->success('محاسبه موفق', 'محاسبه با موفقیت انجام شد');

        return back()->with(['sorts' => $sorts, 'name' => $name, 'part_ids' => $part_ids, 'values' => $values]);
    }

    public function storeAir(Request $request, Part $part)
    {
        $code = $this->getLastCode($part);

        $newPart = $part->replicate()->fill([
            'name' => $request->name,
            'code' => $code,
            'coil' => true,
            'price_updated_at' => now(),
            'standard' => $request['standard']
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
        foreach ($part->children()->orderBy('sort', 'ASC')->get() as $index => $child) {
            foreach ($child->children()->orderBy('sort', 'ASC')->get() as $index2 => $ch) {
                if ($request->values[$index][$index2] > 0) {
                    $newPart->children()->attach($ch->id, [
                        'parent_part_id' => $request->part_ids[$index][$index2],
                        'value' => $request->values[$index][$index2],
                        'sort' => $request->sorts[$index][$index2]
                    ]);
                }

                $totalPrice += ($ch->price * $request->values[$index][$index2]);
            }
        }
        $newPart->price = $totalPrice;
        $newPart->save();

        alert()->success('محاسبه موفق', 'محاسبه تابلو برق با موفقیت انجام شد');

        return redirect()->route('separate.electrical.index');
    }

    public function zent(Part $part)
    {
        $categories = Category::where('parent_id', 0)->get();
        return view('calculate.separate-electrical.zent', compact('part', 'categories'));
    }

    public function calculateZent(Request $request)
    {
        $sorts = $request->sorts;
        $part_ids = $request->part_ids;
        $values = $request->values;
        $name = "LCP-AHW-";

        alert()->success('محاسبه موفق', 'محاسبه با موفقیت انجام شد');

        return back()->with(['sorts' => $sorts, 'name' => $name, 'part_ids' => $part_ids, 'values' => $values]);
    }

    public function storeZent(Request $request, Part $part)
    {
        $code = $this->getLastCode($part);

        $newPart = $part->replicate()->fill([
            'name' => $request->name,
            'code' => $code,
            'coil' => true,
            'price_updated_at' => now(),
            'standard' => $request['standard']
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
        foreach ($part->children()->orderBy('sort', 'ASC')->get() as $index => $child) {
            foreach ($child->children()->orderBy('sort', 'ASC')->get() as $index2 => $ch) {
                if ($request->values[$index][$index2] > 0) {
                    $newPart->children()->attach($ch->id, [
                        'parent_part_id' => $request->part_ids[$index][$index2],
                        'value' => $request->values[$index][$index2],
                        'sort' => $request->sorts[$index][$index2]
                    ]);
                }

                $totalPrice += ($ch->price * $request->values[$index][$index2]);
            }
        }
        $newPart->price = $totalPrice;
        $newPart->save();

        alert()->success('محاسبه موفق', 'محاسبه تابلو برق با موفقیت انجام شد');

        return redirect()->route('separate.electrical.index');
    }

    public function mini(Part $part)
    {
        $categories = Category::where('parent_id', 0)->get();
        return view('calculate.separate-electrical.mini', compact('part', 'categories'));
    }

    public function calculateMini(Request $request)
    {
        $sorts = $request->sorts;
        $part_ids = $request->part_ids;
        $values = $request->values;
        $name = "LCP-MACH-";

        alert()->success('محاسبه موفق', 'محاسبه با موفقیت انجام شد');

        return back()->with(['sorts' => $sorts, 'name' => $name, 'part_ids' => $part_ids, 'values' => $values]);
    }

    public function storeMini(Request $request, Part $part)
    {
        $code = $this->getLastCode($part);

        $newPart = $part->replicate()->fill([
            'name' => $request->name,
            'code' => $code,
            'coil' => true,
            'price_updated_at' => now(),
            'standard' => $request['standard']
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
        foreach ($part->children()->orderBy('sort', 'ASC')->get() as $index => $child) {
            foreach ($child->children()->orderBy('sort', 'ASC')->get() as $index2 => $ch) {
                if ($request->values[$index][$index2] > 0) {
                    $newPart->children()->attach($ch->id, [
                        'parent_part_id' => $request->part_ids[$index][$index2],
                        'value' => $request->values[$index][$index2],
                        'sort' => $request->sorts[$index][$index2]
                    ]);
                }

                $totalPrice += ($ch->price * $request->values[$index][$index2]);
            }
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
