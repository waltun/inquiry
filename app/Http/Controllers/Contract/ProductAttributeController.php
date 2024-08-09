<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Contract;
use App\Models\ContractProduct;
use App\Models\Modell;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    public function index(Contract $contract, ContractProduct $contractProduct)
    {
        $modell = Modell::find($contractProduct->model_id);

        if ($modell->standard) {
            $attributes = $modell->attributes()->orderBy('sort', 'ASC')->get();
        } else {
            $attributes = $modell->parent->attributes()->orderBy('sort', 'ASC')->get();
        }

        $inquiryProduct = Product::find($contractProduct->product_id);

        return view('contracts.attribute-product.index', compact('contract', 'contractProduct', 'attributes', 'inquiryProduct'));
    }

    public function store(Request $request, Contract $contract, ContractProduct $contractProduct)
    {
        $request->validate([
            'attributes.*' => 'required|integer',
            'attributes' => 'required|array',
            'values.*' => 'nullable|string|max:255',
            'values' => 'array',
        ]);

        $modell = Modell::find($contractProduct->model_id);

        $values = collect([]);
        foreach ($request['attributes'] as $index => $id) {
            $attribute = Attribute::find($id);
            $modellAttribute = $modell->parent->attributes()->where('attribute_id', $attribute->id)->first();

            if (!is_null($request->values[$index])) {
                $value = $attribute->values()->firstOrCreate([
                    'value' => $request->values[$index]
                ]);

                $modellAttribute->pivot->unit = $request->units[$index];
                $modellAttribute->pivot->save();
                $values->push($value->id);
            }
        }

        $contractProduct->attributeValues()->sync($values);

        alert()->success('ثبت موفق', 'مقادیر مشخصه فنی با موفقیت ثبت شد');

        return back();
    }
}
