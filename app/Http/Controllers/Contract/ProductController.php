<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Amount;
use App\Models\Contract;
use App\Models\ContractNotification;
use App\Models\ContractProduct;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use App\Models\Part;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function choose(Contract $contract)
    {
        if (auth()->user()->role == 'admin') {
            $invoices = Invoice::latest()->where('complete', true)->paginate(20);
        } else {
            $invoices = Invoice::where('user_id', auth()->user()->id)->where('complete', true)->latest()->paginate(20);
        }

        return view('contracts.products.choose-product', compact('contract', 'invoices'));
    }

    public function invoice(Contract $contract, Invoice $invoice)
    {
        return view('contracts.products.invoice-products', compact('contract', 'invoice'));
    }

    public function storeInvoice(Request $request, Contract $contract, Invoice $invoice)
    {
        $product = InvoiceProduct::find($request->product_id);

        $amounts = Amount::where('product_id', $product->product_id)->get();

        $price = $product->price / $product->percent;

        $contractProduct = $contract->products()->create([
            'quantity' => $product->quantity,
            'price' => $price,
            'model_custom_name' => $product->model_custom_name,
            'tag' => $product->description,
            'type' => $product->type,
            'group_id' => $product->group_id,
            'model_id' => $product->model_id,
            'part_id' => $product->part_id,
            'product_id' => $product->product_id,
            'invoice_id' => $invoice->id
        ]);

        $contract->invoice_id = $invoice->id;
        $contract->save();

        foreach ($amounts as $amount) {
            $part = Part::find($amount->part_id);
            if ($part->collection && !$part->children->isEmpty()) {
                foreach ($part->children as $child) {
                    if (!$child->children->isEmpty()) {
                        foreach ($child->children as $ch) {
                            $contractProduct->amounts()->create([
                                'value' => $ch->pivot->value,
                                'value2' => $ch->pivot->value2,
                                'part_id' => $ch->id,
                                'price' => $ch->price,
                                'sort' => $ch->pivot->sort,
                                'weight' => $ch->weight ?? 0
                            ]);
                        }
                    } else {
                        $contractProduct->amounts()->create([
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
                $contractProduct->amounts()->create([
                    'value' => $amount->value,
                    'value2' => $amount->value2,
                    'part_id' => $amount->part_id,
                    'price' => $amount->price,
                    'sort' => $amount->sort,
                    'weight' => $amount->weight ?? 0
                ]);
            }

            $contractProduct->spareAmounts()->create([
                'value' => $amount->value,
                'value2' => $amount->value2,
                'part_id' => $amount->part_id,
                'price' => $amount->price,
                'sort' => $amount->sort,
                'weight' => $amount->weight ?? 0
            ]);
        }

        alert()->success('ثبت موفق', 'محصول با موفقیت به قرارداد اضافه شد');

        return redirect()->route('contracts.products', $contract->id);
    }

    public function storeAmounts(Contract $contract)
    {
        foreach ($contract->products as $product) {
            $amounts = Amount::where('product_id', $product->product_id)->orderBy('sort', 'ASC')->get();

            if (!$amounts->isEmpty()) {
                foreach ($amounts as $amount) {
                    $part = Part::find($amount->part_id);
                    if ($part->extract && !$part->children->isEmpty()) {
                        foreach ($part->children as $child) {
                            if ($child->extract && !$child->children->isEmpty()) {
                                foreach ($child->children as $ch) {
                                    $product->spareAmounts()->create([
                                        'value' => $ch->pivot->value * $amount->value,
                                        'value2' => $ch->pivot->value2,
                                        'part_id' => $ch->id,
                                        'price' => $ch->price,
                                        'sort' => $child->pivot->sort . '-' . $ch->pivot->sort,
                                        'weight' => $ch->weight ?? 0
                                    ]);
                                }
                            } else {
                                $product->spareAmounts()->create([
                                    'value' => $child->pivot->value * $amount->value,
                                    'value2' => $child->pivot->value2,
                                    'part_id' => $child->id,
                                    'price' => $child->price,
                                    'sort' => $amount->sort . '-' . $child->pivot->sort,
                                    'weight' => $child->weight ?? 0
                                ]);
                            }
                        }
                    }
                    $product->spareAmounts()->create([
                        'value' => $amount->value,
                        'value2' => $amount->value2,
                        'part_id' => $amount->part_id,
                        'price' => $amount->price,
                        'sort' => $amount->sort,
                        'weight' => $amount->weight ?? 0
                    ]);
                }
            }

        }

        ContractNotification::create([
            'message' => 'مقادیر محصولات با موفقیت صادر شدند',
            'current_url' => route('contracts.products', $contract->id),
            'next_url' => route('contracts.parts.index', $contract->id),
            'next_message' => 'برای مشاهده و تغییر ریز آنالیز قطعات محصولات و صدور دستور ساخت به لینک ارجاع شده مراجعه کنید',
            'read_at' => null,
            'done_at' => null,
            'contract_id' => $contract->id,
            'user_id' => auth()->user()->id,
        ]);

        alert()->success('ثبت موفق', 'مقادیر محصولات با موفقیت صادر شدند');

        return back();
    }

    public function destroyAmounts(Contract $contract)
    {
        foreach ($contract->products as $product) {
            $product->spareAmounts()->delete();
        }

        alert()->success('حذف موفق', 'مقادیر محصولات با موفقیت حذف شدند');

        return back();
    }

    public function storeRecipe(Request $request, Contract $contract, ContractProduct $contractProduct)
    {
        $contractProduct->update([
            'recipe' => true
        ]);

        if ($contract->products->every('recipe', 1)) {
            $contract->update([
                'recipe' => true
            ]);
        }

        if ($contract->recipe) {
            if (!$contractProduct->amounts->isEmpty()) {
                $contractProduct->amounts()->delete();
            }
        }

        if ($contract->recipe && $request->store_parts == '1') {
            foreach ($contractProduct->spareAmounts as $amount) {
                if (!is_null($contractProduct->part_id) && $contractProduct->part_id != 0) {
                    $part = Part::find($contractProduct->part_id);
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
                                            $contractProduct->amounts()->create([
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
                                    $contractProduct->amounts()->create([
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
                        $contractProduct->amounts()->create([
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

        alert()->success('ثبت موفق', 'دستور ساخت با موفقیت صادر شد');

        return back();
    }
}
