<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Inquiry;
use App\Models\Modell;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    public function index(Product $product)
    {
        $modell = Modell::find($product->model_id);

        if ($modell->standard) {
            $attributes = $modell->attributes()->orderBy('sort', 'ASC')->get();
        } else {
            $attributes = $modell->parent->attributes()->orderBy('sort', 'ASC')->get();
        }

        $inquiry = Inquiry::find($product->inquiry_id);
        return view('inquiry-product.attributes.index', compact('attributes', 'product', 'modell', 'inquiry'));
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'attributes.*' => 'required|integer',
            'attributes' => 'required|array',
            'values.*' => 'nullable|string|max:255',
            'values' => 'array',
        ]);

        $modell = Modell::find($product->model_id);

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

        $product->attributeValues()->sync($values);

        alert()->success('ثبت موفق', 'مقادیر مشخصه فنی با موفقیت ثبت شد');

        return back();
    }
}
