<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Part;
use Illuminate\Http\Request;

class PartAttributeController extends Controller
{
    public function index(Part $part)
    {
        $arrayCategory = collect([]);
        foreach ($part->categories as $category) {
            if ($category->children->isEmpty()) {
                $arrayCategory->push($category);
                $currentCategory = $category;
                while ($currentCategory->parent_id != 0) {
                    $nextCategory = $currentCategory->parent;
                    $arrayCategory->push($nextCategory);
                    $currentCategory = $nextCategory;
                }
            }
        }

        $category = $arrayCategory->first();
        $attributes = $category->attributes()->orderBy('sort', 'ASC')->get();

        session()->put('prev-url', url()->previous());

        return view('parts.attributes.index', compact('attributes', 'part'));
    }

    public function store(Request $request, Part $part)
    {
        $request->validate([
            'attributes.*' => 'required|integer',
            'attributes' => 'required|array',
            'values.*' => 'nullable|string|max:255',
            'values' => 'array',
            'show_datasheet' => 'required|in:0,1'
        ]);

        $values = collect([]);
        foreach ($request['attributes'] as $index => $id) {
            $attribute = Attribute::find($id);
            if (!is_null($request->values[$index])) {
                $value = $attribute->values()->firstOrCreate([
                    'value' => $request->values[$index]
                ]);

                $values->push($value->id);
            }
        }

        $part->attributeValues()->sync($values);
        $part->show_datasheet = $request->show_datasheet;
        $part->save();

        alert()->success('ثبت موفق', 'مقادیر مشخصه فنی با موفقیت ثبت شد');

        return back();
    }
}
