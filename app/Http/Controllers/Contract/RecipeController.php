<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\ContractProduct;
use App\Models\Part;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index(Contract $contract)
    {
        if (auth()->user()->id == 4) {
            $contract->seen_at = now();
            $contract->save();
        }

        if ($contract->recipe || $contract->products->contains('recipe', 1)) {
            return view('contracts.recipe.index', compact('contract'));
        }

        alert()->error('خطا', 'هنوز دستور ساختی صادر نشده');

        return back();
    }

    public function parts(Contract $contract)
    {
        if ($contract->recipe || $contract->products->contains('recipe', 1)) {
            return view('contracts.recipe.parts', compact('contract'));
        }

        alert()->error('خطا', 'هنوز دستور ساختی صادر نشده');

        return back();
    }

    public function storeParts(Request $request, Contract $contract)
    {
        $product = ContractProduct::where('id', $request->product_id)->where('contract_id', $contract->id)->first();

        if (!$product->spareAmounts->isEmpty()) {
            $product->spareAmounts()->delete();
        }

        if (!$product->amounts->isEmpty()) {
            $product->amounts()->delete();
        }

        foreach ($request->part_ids as $index => $id) {
            $part = Part::find($id);

            if ($part->collection && !$part->children->isEmpty()) {
                foreach ($part->children as $child) {
                    if (!$child->children->isEmpty()) {
                        foreach ($child->children as $ch) {
                            $product->amounts()->create([
                                'value' => $ch->pivot->value,
                                'value2' => $ch->pivot->value2,
                                'part_id' => $ch->id,
                                'price' => $ch->price,
                                'sort' => $ch->pivot->sort,
                                'weight' => $ch->weight ?? 0
                            ]);
                        }
                    } else {
                        $product->amounts()->create([
                            'value' => $child->pivot->value,
                            'value2' => $child->pivot->value2,
                            'part_id' => $child->id,
                            'price' => $child->price,
                            'sort' => $child->pivot->sort,
                            'weight' => $child->weight ?? 0
                        ]);
                    }
                }
            } else {
                $product->amounts()->create([
                    'value' => $request->amounts[$index],
                    'value2' => $request->amounts2[$index],
                    'part_id' => $id,
                    'price' => $part->price,
                    'weight' => $part->weight ?? 0,
                    'sort' => $request->sorts[$index]
                ]);
            }

            $product->spareAmounts()->create([
                'value' => $request->amounts[$index],
                'value2' => $request->amounts2[$index],
                'part_id' => $id,
                'weight' => $part->weight ?? 0,
                'price' => $part->price,
                'sort' => $request->sorts[$index]
            ]);
        }

        alert()->success('ثبت موفق', 'ثبت مقادیر با موفقیت انجام شد');

        return back();
    }

    public function addToPacking(Request $request, Contract $contract, ContractProduct $product)
    {
        $data = $request->validate([
            'packing_id' => 'required|integer',
            'quantity' => 'required|numeric'
        ]);

        if ($data['quantity'] > $product->quantity) {
            alert()->error('خطا', 'تعداد نباید بیشتر از تعداد محصول باشد');
            return back();
        }

        $product->packings()->attach($data['packing_id'], [
            'quantity' => $data['quantity']
        ]);

        alert()->success('ثبت موفق', 'محصول با موفقیت به پکینگ اضافه شد');

        return back();
    }

    public function addFactoryText(Request $request, Contract $contract, ContractProduct $product)
    {
        $data = $request->validate([
            'factory_text' => 'required'
        ]);

        $product->update($data);

        alert()->success('ثبت موفق', 'توضیحات محصول با موفقیت اضافه شد');

        return back();
    }
}
