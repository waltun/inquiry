<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\AttributeGroup;
use App\Models\Modell;
use Illuminate\Http\Request;

class ModellAttributeController extends Controller
{
    public function index(Modell $modell)
    {
        $attributes = $modell->attributes()->orderBy('sort', 'ASC')->get();
        $allAttributes = Attribute::all();
        $groups = AttributeGroup::all();
        return view('modells.attributes.index', compact('modell', 'attributes', 'allAttributes', 'groups'));
    }

    public function store(Request $request, Modell $modell)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
        ]);

        $sort = 0;
        if ($modell->attributes->isEmpty()) {
            $sort = 1;
        } else {
            $maxSort = $modell->attributes()->max('sort');
            $sort = $maxSort + 1;
        }

        $attribute = Attribute::firstOrCreate($data);

        $modell->attributes()->attach($attribute->id, [
            'sort' => $sort,
        ]);

        alert()->success('ثبت موفق', 'مشخصه فنی با موفقیت ثبت شد');

        return back();
    }

    public function update(Request $request, Attribute $attribute)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:255'
        ]);

        $modell = Modell::find($request->modell_id);

        $record = Attribute::where('name', $data['name'])->where('unit', $data['unit'])->where('id', '!=', $attribute->id)->first();
        if ($record) {
            alert()->error('خطا', 'نام مشخصه فنی وارد شده از قبل وجود دارد.');
            return null;
        }

        $newAttribute = Attribute::firstOrCreate($data);
        $modell->attributes()->detach($attribute->id);
        $modell->attributes()->attach($newAttribute->id);

        alert()->success('بروزرسانی موفق', 'مشخصه فنی با موفقیت بروزرسانی شد');

        //return back();
    }

    public function destroy(Request $request)
    {
        $attribute = Attribute::find($request->attrId);
        $modell = Modell::find($request->modId);

        $modell->attributes()->detach($attribute->id);

        alert()->success('حذف موفق', 'مشخصه فنی با موفقیت حذف شد');

        //return back();
    }

    public function replicate(Request $request, Modell $modell)
    {
        $selectedModell = Modell::find($request->modell_id);

        $selectedModell->attributes()->delete();

        foreach ($modell->attributes as $attribute) {
            $selectedModell->attributes()->attach($attribute->id, [
                'sort' => $attribute->pivot->sort,
                'default_value' => $attribute->pivot->default_value
            ]);
        }

        alert()->success('کپی موفق', 'دیتاشیت با موفقیت کپی شد');

        return back();
    }

    public function storeSort(Request $request, Modell $modell)
    {
        $request->validate([
            'sorts' => 'array',
            'sorts.*' => 'nullable|numeric',
            'default_value' => 'array',
            'default_value.*' => 'nullable|string|max:255',
            'attribute_group_id' => 'array',
            'attribute_group_id.*' => 'nullable|integer',
        ]);

        foreach ($modell->attributes()->orderBy('sort', 'ASC')->get() as $index => $attribute) {
            $attribute->pivot->sort = $request->sorts[$index];
            $attribute->pivot->default_value = $request->default_value[$index];
            $attribute->pivot->attribute_group_id = $request->attribute_group_id[$index];
            $attribute->pivot->save();
        }

        alert()->success('ثبت موفق', 'Sort با موفقیت ثبت شد');

        return back();
    }
}
