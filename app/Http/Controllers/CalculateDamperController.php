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

        $newPart = $part->replicate()->fill([
            'name' => $name,
            'code' => random_int(1111, 9999),
        ]);

        $newPart->save();

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
}
