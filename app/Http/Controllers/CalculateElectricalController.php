<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inquiry;
use App\Models\Part;
use App\Models\Product;
use Illuminate\Http\Request;

class CalculateElectricalController extends Controller
{
    public function panel(Part $part, Product $product)
    {
        $categories = Category::where('parent_id', 0)->get();
        $inquiry = Inquiry::select('inquiry_number')->where('id', $product->inquiry_id)->first();
        return view('calculate.electrical.panel', compact('part', 'categories', 'inquiry', 'product'));
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

    public function storePanel(Request $request, Part $part, Product $product)
    {
        $request->validate([
            'values' => 'required|array',
            'values.*' => 'required|numeric'
        ]);

        $name = $request['name'];
        $code = $this->getLastCode($part);

        $newPart = $part->replicate()->fill([
            'name' => $name,
            'code' => $code,
            'coil' => true,
            'price_updated_at' => now(),
            'inquiry_id' => $product->inquiry_id,
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

        foreach ($request['part_ids'] as $index => $id) {
            $newPart->children()->attach($id, [
                'parent_part_id' => $request->part_ids[$index],
                'value' => $request->values[$index],
                'sort' => $request->sorts[$index]
            ]);
        }

        $request->session()->put('electrical-btn-' . $part->id . $product->id, 'calculated');
        $request->session()->put('selectedPart' . $newPart->id, $newPart->id);

        alert()->success('محاسبه موفق', 'محاسبه تابلو برق با موفقیت انجام شد');

        return redirect()->route('inquiries.product.amounts', $product->id);
    }

    public function chiller(Part $part, Product $product)
    {
        $categories = Category::where('parent_id', 0)->get();
        $inquiry = Inquiry::select('inquiry_number')->where('id', $product->inquiry_id)->first();
        return view('calculate.electrical.chiller', compact('part', 'categories', 'inquiry', 'product'));
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

    public function storeChiller(Request $request, Part $part, Product $product)
    {
        $name = $request['name'];
        $code = $this->getLastCode($part);

        $newPart = $part->replicate()->fill([
            'name' => $name,
            'code' => $code,
            'coil' => true,
            'inquiry_id' => $product->inquiry_id,
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

        foreach ($part->children()->orderBy('sort', 'ASC')->get() as $index => $child) {
            foreach ($child->children()->orderBy('sort', 'ASC')->get() as $index2 => $ch) {
                $newPart->children()->attach($ch->id, [
                    'parent_part_id' => $request->part_ids[$index][$index2],
                    'value' => $request->values[$index][$index2],
                    'sort' => $request->sorts[$index][$index2]
                ]);
            }
        }

        $request->session()->put('electrical-btn-' . $part->id . $product->id, 'calculated');
        $request->session()->put('selectedPart' . $newPart->id, $newPart->id);

        alert()->success('محاسبه موفق', 'محاسبه تابلو برق با موفقیت انجام شد');

        return redirect()->route('inquiries.product.amounts', $product->id);
    }

    public function air(Part $part, Product $product)
    {
        $categories = Category::where('parent_id', 0)->get();
        $inquiry = Inquiry::select('inquiry_number')->where('id', $product->inquiry_id)->first();
        return view('calculate.electrical.air', compact('part', 'categories', 'inquiry', 'product'));
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

    public function storeAir(Request $request, Part $part, Product $product)
    {
        $request->validate([
            'values' => 'required|array',
            'values.*' => 'required|numeric'
        ]);

        $name = $request['name'];
        $code = $this->getLastCode($part);

        $newPart = $part->replicate()->fill([
            'name' => $name,
            'code' => $code,
            'coil' => true,
            'price_updated_at' => now(),
            'inquiry_id' => $product->inquiry_id,
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

        foreach ($request['part_ids'] as $index => $id) {
            $newPart->children()->attach($id, [
                'parent_part_id' => $request->part_ids[$index],
                'value' => $request->values[$index],
                'sort' => $request->sorts[$index]
            ]);
        }

        $request->session()->put('electrical-btn-' . $part->id . $product->id, 'calculated');
        $request->session()->put('selectedPart' . $newPart->id, $newPart->id);

        alert()->success('محاسبه موفق', 'محاسبه تابلو برق با موفقیت انجام شد');

        return redirect()->route('inquiries.product.amounts', $product->id);
    }

    public function zent(Part $part, Product $product)
    {
        $categories = Category::where('parent_id', 0)->get();
        $inquiry = Inquiry::select('inquiry_number')->where('id', $product->inquiry_id)->first();
        return view('calculate.electrical.zent', compact('part', 'categories', 'inquiry', 'product'));
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

    public function storeZent(Request $request, Part $part, Product $product)
    {
        $request->validate([
            'values' => 'required|array',
            'values.*' => 'required|numeric'
        ]);

        $name = $request['name'];
        $code = $this->getLastCode($part);

        $newPart = $part->replicate()->fill([
            'name' => $name,
            'code' => $code,
            'coil' => true,
            'price_updated_at' => now(),
            'inquiry_id' => $product->inquiry_id,
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

        foreach ($request['part_ids'] as $index => $id) {
            $newPart->children()->attach($id, [
                'parent_part_id' => $request->part_ids[$index],
                'value' => $request->values[$index],
                'sort' => $request->sorts[$index]
            ]);
        }

        $request->session()->put('electrical-btn-' . $part->id . $product->id, 'calculated');
        $request->session()->put('selectedPart' . $newPart->id, $newPart->id);

        alert()->success('محاسبه موفق', 'محاسبه تابلو برق با موفقیت انجام شد');

        return redirect()->route('inquiries.product.amounts', $product->id);
    }

    public function mini(Part $part, Product $product)
    {
        $categories = Category::where('parent_id', 0)->get();
        $inquiry = Inquiry::select('inquiry_number')->where('id', $product->inquiry_id)->first();
        return view('calculate.electrical.mini', compact('part', 'categories', 'inquiry', 'product'));
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

    public function storeMini(Request $request, Part $part, Product $product)
    {
        $request->validate([
            'values' => 'required|array',
            'values.*' => 'required|numeric'
        ]);

        $name = $request['name'];
        $code = $this->getLastCode($part);

        $newPart = $part->replicate()->fill([
            'name' => $name,
            'code' => $code,
            'coil' => true,
            'price_updated_at' => now(),
            'inquiry_id' => $product->inquiry_id,
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

        foreach ($request['part_ids'] as $index => $id) {
            $newPart->children()->attach($id, [
                'parent_part_id' => $request->part_ids[$index],
                'value' => $request->values[$index],
                'sort' => $request->sorts[$index]
            ]);
        }

        $request->session()->put('electrical-btn-' . $part->id . $product->id, 'calculated');
        $request->session()->put('selectedPart' . $newPart->id, $newPart->id);

        alert()->success('محاسبه موفق', 'محاسبه تابلو برق با موفقیت انجام شد');

        return redirect()->route('inquiries.product.amounts', $product->id);
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
