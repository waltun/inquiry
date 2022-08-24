<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Models\Product;
use Illuminate\Http\Request;

class CalculateDamperController extends Controller
{
    public function taze(Part $part, Product $product)
    {
        return view('calculate.damper.taze', compact('part', 'product'));
    }

    public function raft(Part $part, Product $product)
    {
        return view('calculate.damper.raft', compact('part', 'product'));
    }

    public function bargasht(Part $part, Product $product)
    {
        return view('calculate.damper.bargasht', compact('part', 'product'));
    }

    public function exast(Part $part, Product $product)
    {
        return view('calculate.damper.exast', compact('part', 'product'));
    }

    public function store(Request $request, Part $part, Product $product)
    {
        $name = $request['name'];
        $code = $this->getLastCode($part);

        $newPart = $part->replicate()->fill([
            'name' => $name,
            'code' => $code,
            'coil' => true
        ]);

        $newPart->save();

        foreach ($part->categories as $category) {
            $newPart->categories()->syncWithoutDetaching($category->id);
        }

        foreach ($part->children as $child) {
            $newPart->children()->syncWithoutDetaching($child->id);
        }

        foreach ($newPart->children as $index => $childPart) {
            $childPart->pivot->value = $request->values[$index];
            $childPart->pivot->save();
        }

        $request->session()->put('price' . $part->id, $request->final_price);

        alert()->success('محاسبه موفق', 'محاسبه دمپر با موفقیت انجام شد');

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
