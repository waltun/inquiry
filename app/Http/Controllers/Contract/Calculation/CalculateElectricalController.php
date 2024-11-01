<?php

namespace App\Http\Controllers\Contract\Calculation;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contract;
use App\Models\ContractProduct;
use App\Models\Part;
use Illuminate\Http\Request;

class CalculateElectricalController extends Controller
{
    public function panel(Contract $contract, Part $part, ContractProduct $product, Part $part2)
    {
        $categories = Category::where('parent_id', 0)->get();
        return view('contracts.calculation.electrical.panel', compact('part', 'categories', 'contract', 'product', 'part2'));
    }

    public function calculatePanel(Request $request)
    {
        $sorts = $request->sorts;
        $part_ids = $request->part_ids;
        $values = $request->values;
        $productModel = $request['product_model'];
        $name = $productModel . "-LCP-PU";

        alert()->success('محاسبه موفق', 'محاسبه با موفقیت انجام شد');

        return back()->with(['sorts' => $sorts, 'name' => $name, 'part_ids' => $part_ids, 'values' => $values]);
    }

    public function storePanel(Request $request, Contract $contract, Part $part, ContractProduct $product, Part $part2)
    {
        $name = $request['name'];
        $code = $this->getLastCode($part);

        $newPart = $part->replicate()->fill([
            'name' => $name,
            'code' => $code,
            'coil' => true,
            'price_updated_at' => now(),
            'contract_id' => $contract->id,
            'product_id' => $product->id,
            'price' => $request['price']
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

        alert()->success('محاسبه موفق', 'محاسبه تابلو برق با موفقیت انجام شد');

        $product->spareAmounts()->where('part_id', $part2->id)->first()->update([
            'part_id' => $newPart->id
        ]);

        return redirect()->route('contracts.parts.index', $contract->id);
    }

    public function chiller(Contract $contract, Part $part, ContractProduct $product, Part $part2)
    {
        $categories = Category::where('parent_id', 0)->get();
        return view('contracts.calculation.electrical.chiller', compact('part', 'categories', 'contract', 'product', 'part2'));
    }

    public function calculateChiller(Request $request)
    {
        $sorts = $request->sorts;
        $part_ids = $request->part_ids;
        $values = $request->values;
        $productModel = $request['product_model'];
        $name = $productModel . "-LCP-ACH";

        alert()->success('محاسبه موفق', 'محاسبه با موفقیت انجام شد');

        return back()->with(['sorts' => $sorts, 'name' => $name, 'part_ids' => $part_ids, 'values' => $values]);
    }

    public function storeChiller(Request $request, Contract $contract, Part $part, ContractProduct $product, Part $part2)
    {
        $name = $request['name'];
        $code = $this->getLastCode($part);

        $newPart = $part->replicate()->fill([
            'name' => $name,
            'code' => $code,
            'coil' => true,
            'contract_id' => $contract->id,
            'price_updated_at' => now(),
            'product_id' => $product->id,
            'price' => $request['price']
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

        $product->spareAmounts()->where('part_id', $part2->id)->first()->update([
            'part_id' => $newPart->id
        ]);

        alert()->success('محاسبه موفق', 'محاسبه تابلو برق با موفقیت انجام شد');

        return redirect()->route('contracts.parts.index', $contract->id);
    }

    public function air(Contract $contract, Part $part, ContractProduct $product, Part $part2)
    {
        $categories = Category::where('parent_id', 0)->get();
        return view('contracts.calculation.electrical.air', compact('part', 'categories', 'contract', 'product', 'part2'));
    }

    public function calculateAir(Request $request)
    {
        $sorts = $request->sorts;
        $part_ids = $request->part_ids;
        $values = $request->values;
        $productModel = $request['product_model'];
        $name = $productModel . "-LCP-AHU";

        alert()->success('محاسبه موفق', 'محاسبه با موفقیت انجام شد');

        return back()->with(['sorts' => $sorts, 'name' => $name, 'part_ids' => $part_ids, 'values' => $values]);
    }

    public function storeAir(Request $request, Contract $contract, Part $part, ContractProduct $product, Part $part2)
    {
        $name = $request['name'];
        $code = $this->getLastCode($part);

        $newPart = $part->replicate()->fill([
            'name' => $name,
            'code' => $code,
            'coil' => true,
            'price_updated_at' => now(),
            'contract_id' => $contract->id,
            'product_id' => $product->id,
            'price' => $request['price'],
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

        $product->spareAmounts()->where('part_id', $part2->id)->first()->update([
            'part_id' => $newPart->id
        ]);

        alert()->success('محاسبه موفق', 'محاسبه تابلو برق با موفقیت انجام شد');

        return redirect()->route('contracts.parts.index', $contract->id);
    }

    public function zent(Contract $contract, Part $part, ContractProduct $product, Part $part2)
    {
        $categories = Category::where('parent_id', 0)->get();
        return view('contracts.calculation.electrical.zent', compact('part', 'categories', 'contract', 'product', 'part2'));
    }

    public function calculateZent(Request $request)
    {
        $sorts = $request->sorts;
        $part_ids = $request->part_ids;
        $values = $request->values;
        $productModel = $request['product_model'];
        $name = $productModel . "-LCP-AHW";

        alert()->success('محاسبه موفق', 'محاسبه با موفقیت انجام شد');

        return back()->with(['sorts' => $sorts, 'name' => $name, 'part_ids' => $part_ids, 'values' => $values]);
    }

    public function storeZent(Request $request, Contract $contract, Part $part, ContractProduct $product, Part $part2)
    {
        $name = $request['name'];
        $code = $this->getLastCode($part);

        $newPart = $part->replicate()->fill([
            'name' => $name,
            'code' => $code,
            'coil' => true,
            'price_updated_at' => now(),
            'contract_id' => $contract->id,
            'product_id' => $product->id,
            'price' => $request['price'],
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

        $product->spareAmounts()->where('part_id', $part2->id)->first()->update([
            'part_id' => $newPart->id
        ]);

        alert()->success('محاسبه موفق', 'محاسبه تابلو برق با موفقیت انجام شد');

        return redirect()->route('contracts.parts.index', $contract->id);
    }

    public function mini(Contract $contract, Part $part, ContractProduct $product, Part $part2)
    {
        $categories = Category::where('parent_id', 0)->get();
        return view('contracts.calculation.electrical.mini', compact('part', 'categories', 'contract', 'product', 'part2'));
    }

    public function calculateMini(Request $request)
    {
        $sorts = $request->sorts;
        $part_ids = $request->part_ids;
        $values = $request->values;
        $productModel = $request['product_model'];
        $name = $productModel . "-LCP-MACH-";

        alert()->success('محاسبه موفق', 'محاسبه با موفقیت انجام شد');

        return back()->with(['sorts' => $sorts, 'name' => $name, 'part_ids' => $part_ids, 'values' => $values]);
    }

    public function storeMini(Request $request, Contract $contract, Part $part, ContractProduct $product, Part $part2)
    {
        $name = $request['name'];
        $code = $this->getLastCode($part);

        $newPart = $part->replicate()->fill([
            'name' => $name,
            'code' => $code,
            'coil' => true,
            'price_updated_at' => now(),
            'contract_id' => $contract->id,
            'product_id' => $product->id,
            'price' => $request['price'],
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

        $product->spareAmounts()->where('part_id', $part2->id)->first()->update([
            'part_id' => $newPart->id
        ]);

        alert()->success('محاسبه موفق', 'محاسبه تابلو برق با موفقیت انجام شد');

        return redirect()->route('contracts.parts.index', $contract->id);
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
