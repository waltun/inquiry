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
        $modellAttribute = $modell->attributes()->where('attribute_id', $attribute->id)->where('modell_id', $modell->id)->first();

        $record = Attribute::where('name', $data['name'])->where('unit', $data['unit'])->where('id', '!=', $attribute->id)->first();
        if ($record) {
            alert()->error('خطا', 'نام مشخصه فنی وارد شده از قبل وجود دارد.');
            return null;
        }

        $newAttribute = Attribute::firstOrCreate($data);
        $modell->attributes()->detach($attribute->id);
        $modell->attributes()->attach($newAttribute->id, [
            'sort' => $modellAttribute->pivot->sort,
            'default_value' => $modellAttribute->pivot->default_value,
            'attribute_group_id' => $modellAttribute->pivot->attribute_group_id,
            'show_data' => $modellAttribute->pivot->show_data
        ]);

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

        if (!$selectedModell->attributes->isEmpty()) {
            $modell->attributes()->detach();

            foreach ($selectedModell->attributes as $attribute) {
                $modell->attributes()->attach($attribute->id, [
                    'sort' => $attribute->pivot->sort,
                    'default_value' => $attribute->pivot->default_value
                ]);
            }

            alert()->success('کپی موفق', 'دیتاشیت با موفقیت کپی شد');
            return back();
        }

        alert()->error('خطا!', 'دسته انتخاب شده فاقد دیتاشیت می باشد');
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
            'show_data' => 'array',
            'show_data.*' => 'nullable|integer|in:0,1',
        ]);

        foreach ($modell->attributes()->orderBy('sort', 'ASC')->get() as $index => $attribute) {
            $attribute->pivot->sort = $request->sorts[$index];
            $attribute->pivot->default_value = $request->default_value[$index];
            $attribute->pivot->attribute_group_id = $request->attribute_group_id[$index];
            $attribute->pivot->show_data = $request->show_data[$index];
            $attribute->pivot->save();
        }

        alert()->success('ثبت موفق', 'Sort با موفقیت ثبت شد');

        return back();
    }
}
