<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contract;
use App\Models\ContractNotification;
use App\Models\ContractPartHistory;
use App\Models\ContractProduct;
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
            if ($contract->recipe) {
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
            }

            $product->spareAmounts()->delete();
        }

        if ($contract->recipe) {
            if (!$product->amounts->isEmpty()) {
                $product->amounts()->delete();
            }
        }

        foreach ($request->part_ids as $index => $id) {
            $part = Part::find($id);

            if ($contract->recipe) {
                if ($part->analyzee) {
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
                }
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

    public function storeRecipe(Request $request, Contract $contract)
    {
        $contract->update([
            'recipe' => true
        ]);

        $contract->products()->update([
            'recipe' => true
        ]);

        foreach ($contract->products as $product) {
            if ($contract->recipe) {
                if (!$product->amounts->isEmpty()) {
                    $product->amounts()->delete();
                }
            }

            if ($contract->recipe && $request->store_parts == '1') {
                foreach ($product->spareAmounts as $amount) {
                    if (!is_null($product->part_id) && $product->part_id != 0) {
                        $part = Part::find($product->part_id);
                    } else {
                        $part = Part::find($amount->part_id);
                    }

                    if ($part->analyzee) {
                        if ($part->collection && !$part->children->isEmpty()) {
                            foreach ($part->children as $child) {
                                if ($child->analyzee) {
                                    if (!$child->children->isEmpty()) {
                                        foreach ($child->children as $ch) {
                                            if ($ch->analyzee) {
                                                $product->amounts()->create([
                                                    'value' => $ch->pivot->value * $child->pivot->value * $amount->value,
                                                    'value2' => $ch->pivot->value2 * $child->pivot->value2 * $amount->value2,
                                                    'part_id' => $ch->id,
                                                    'price' => $ch->price,
                                                    'sort' => $ch->pivot->sort,
                                                    'weight' => $ch->weight ?? 0
                                                ]);
                                            }
                                        }
                                    } else {
                                        $product->amounts()->create([
                                            'value' => $child->pivot->value * $amount->value,
                                            'value2' => $child->pivot->value2 * $amount->value2,
                                            'part_id' => $child->id,
                                            'price' => $child->price,
                                            'sort' => $child->pivot->sort,
                                            'weight' => $child->weight ?? 0
                                        ]);
                                    }
                                }
                            }
                        } else {
                            $product->amounts()->create([
                                'value' => $amount->value,
                                'value2' => $amount->value2,
                                'part_id' => $amount->part_id,
                                'price' => $amount->price,
                                'weight' => $amount->weight ?? 0,
                                'sort' => $amount->sort
                            ]);
                        }
                    }
                }
            }
        }

        ContractNotification::create([
            'message' => 'دستور ساخت قرارداد با موفقیت صادر شد',
            'current_url' => route('contracts.recipe.index', $contract->id),
            'next_url' => route('contracts.construction.index', $contract->id),
            'next_message' => 'برای صدور پایان ساخت دستگاه ها و قطعات به لینک ارجاع شده مراجعه کنید',
            'read_at' => null,
            'done_at' => null,
            'contract_id' => $contract->id,
            'user_id' => auth()->user()->id,
        ]);

        alert()->success('ثبت موفق', 'دستور ساخت با موفقیت صادر شد');

        return back();
    }

    public function destroyRecipe(Contract $contract)
    {
        $contract->update([
            'recipe' => false
        ]);

        foreach ($contract->products as $product) {
            if (!$product->amounts->isEmpty()) {
                $product->amounts()->delete();
            }
        }

        alert()->success('حذف موفق', 'دستور ساخت با موفقیت حذف شد');

        return back();
    }

    public function addPart(Contract $contract, ContractProduct $product)
    {
        $parts = Part::query();
        $categories = Category::where('parent_id', 0)->get();

        if ($keyword = request('search')) {
            $parts->where('name', 'LIKE', "%{$keyword}%");
        }

        if (!is_null(request('category3'))) {
            if (request()->has('category3')) {
                $parts = $parts->whereHas('categories', function ($q) {
                    $q->where('category_id', request('category3'));
                });
            }
        }

        if (is_null(request('category3'))) {
            if (request()->has('category2')) {
                $parts = $parts->whereHas('categories', function ($q) {
                    $q->where('category_id', request('category2'));
                });
            }
        }

        $parts = $parts->latest()->paginate(25);

        return view('contracts.parts.add-part', compact('contract', 'product', 'categories', 'parts'));
    }

    public function storePart(Request $request, Contract $contract, ContractProduct $product)
    {
        $request->validate([
            'quantity' => 'required|numeric',
            'tag' => 'nullable|string|max:255',
            'part_id' => 'required|integer'
        ]);

        $part = Part::find($request->part_id);

//        if ($product->spareAmounts->isEmpty()) {
//            $sort = 1;
//        } else {
//            $max = $product->spareAmounts()->max('sort');
//            $sort = $max + 1;
//        }

        $product->spareAmounts()->create([
            'value' => $request->quantity,
            'value2' => $request->quantity2,
            'price' => $part->price,
            'weight' => $part->weight ?? 0,
            'part_id' => $part->id,
//            'sort' => $sort
        ]);

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
                'value' => $request->quantity,
                'value2' => $request->quantity2,
                'part_id' => $part->id,
                'price' => $part->price,
                'sort' => 0,
                'weight' => $part->weight ?? 0
            ]);
        }

        alert()->success('ثبت موفق', 'افزودن قطعه به قرارداد با موفقیت انجام شد');

        return redirect()->route('contracts.parts.index', $contract->id);
    }

    public function addSinglePart(Contract $contract, ContractProduct $product)
    {
        $parts = Part::query();
        $categories = Category::where('parent_id', 0)->get();

        if ($keyword = request('search')) {
            $parts->where('name', 'LIKE', "%{$keyword}%");
        }

        if (!is_null(request('category3'))) {
            if (request()->has('category3')) {
                $parts = $parts->whereHas('categories', function ($q) {
                    $q->where('category_id', request('category3'));
                });
            }
        }

        if (is_null(request('category3'))) {
            if (request()->has('category2')) {
                $parts = $parts->whereHas('categories', function ($q) {
                    $q->where('category_id', request('category2'));
                });
            }
        }

        $parts = $parts->latest()->paginate(25);

        return view('contracts.parts.add-single-part', compact('contract', 'product', 'categories', 'parts'));
    }

    public function storeSinglePart(Request $request, Contract $contract, ContractProduct $product)
    {
        $request->validate([
            'quantity' => 'required|numeric',
            'tag' => 'nullable|string|max:255',
            'part_id' => 'required|integer',
            'type' => 'required'
        ]);

        $part = Part::find($request->part_id);

        $contract->products()->create([
            'part_id' => $part->id,
            'quantity' => $request['quantity'],
            'tag' => $request['tag'],
            'type' => $request['type'],
            'price' => $part->price,
            'product_id' => null,
            'model_id' => 0,
            'group_id' => 0
        ]);

        alert()->success('ثبت موفق', 'افزودن قطعه به قرارداد با موفقیت انجام شد');

        return redirect()->route('contracts.parts.index', $contract->id);
    }

    public function destroyPart(Request $request)
    {
        $product = ContractProduct::find($request->product_id);

        $amounts = $product->amounts()->where('part_id', $request->part_id)->get();

        if (!$amounts->isEmpty()) {
            foreach ($amounts as $amount) {
                $amount->delete();
            }
        }

        $spareAmount = $product->spareAmounts()->where('part_id', $request->part_id)->first();
        if (!is_null($spareAmount)) {
            $spareAmount->delete();
        }

        $product->delete();

        alert()->success('حذف موفق', 'حذف قطعه از قرارداد با موفقیت انجام شد');
    }

    public function storeProduct(Request $request, Contract $contract)
    {
        $products = $contract->products()->where('part_id', '!=', 0)->get();

        foreach ($contract->products()->where('part_id', '!=', 0)->where('type', $request->type)->get() as $index => $product) {
            $product->update([
                'part_id' => $request->part_ids[$index],
                'quantity' => $request->quantities[$index],
            ]);
        }

        foreach ($products as $product) {
            if (!$product->spareAmounts->isEmpty()) {
                if ($contract->recipe) {
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
                }
            }
        }

        alert()->success('ثبت موفق', 'ثبت مقادیر با موفقیت انجام شد');

        return back();
    }
}
