<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\ContractPartHistory;
use App\Models\ContractProduct;
use App\Models\ContractProductAmountSpare;
use App\Models\Part;
use Illuminate\Http\Request;

class PartController extends Controller
{
    public function index(Contract $contract)
    {
        return view('contracts.parts.index', compact('contract'));
    }

    public function storeAmounts(Request $request, Contract $contract)
    {
        $product = ContractProduct::where('id', $request->product_id)->where('contract_id', $contract->id)->first();

        if (!$product->spareAmounts->isEmpty()) {
            foreach ($product->spareAmounts()->orderBy('sort', 'ASC')->get() as $index => $spareAmount) {
                if ($spareAmount->part_id != $request->part_ids[$index]) {
                    ContractPartHistory::create([
                        'old_part_id' => $spareAmount->part_id,
                        'new_part_id' => $request->part_ids[$index],
                        'contract_product_id' => $product->id,
                        'contract_id' => $contract->id,
                        'user_id' => auth()->user()->id,
                        'type' => 'change'
                    ]);
                }
            }

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
}
