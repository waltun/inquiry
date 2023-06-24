<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryAttributeController extends Controller
{
    public function index(Category $category)
    {
        $attributes = $category->attributes()->orderBy('sort', 'ASC')->get();
        $allAttributes = Attribute::all();
        return view('categories.attributes.index', compact('attributes', 'category', 'allAttributes'));
    }

    public function store(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
        ]);

        $sort = 0;
        if ($category->attributes->isEmpty()) {
            $sort = 1;
        } else {
            $maxSort = $category->attributes()->max('sort');
            $sort = $maxSort + 1;
        }

        $attribute = Attribute::firstOrCreate($data);

        $category->attributes()->attach($attribute->id, [
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

        $category = Category::find($request->category_id);

        $record = Attribute::where('name', $data['name'])->where('unit', $data['unit'])->where('id', '!=', $attribute->id)->first();
        if ($record) {
            alert()->error('خطا', 'نام مشخصه فنی وارد شده از قبل وجود دارد.');
            return null;
        }

        $newAttribute = Attribute::firstOrCreate($data);
        $category->attributes()->detach($attribute->id);
        $category->attributes()->attach($newAttribute->id);

        alert()->success('بروزرسانی موفق', 'مشخصه فنی با موفقیت بروزرسانی شد');

        //return back();
    }

    public function destroy(Request $request)
    {
        $attribute = Attribute::find($request->attrId);
        $category = Category::find($request->catId);

        $category->attributes()->detach($attribute->id);

        alert()->success('حذف موفق', 'مشخصه فنی با موفقیت حذف شد');

        //return back();
    }

    public function replicate(Request $request, Category $category)
    {
        $selectedCategory = Category::find($request->category_id);

        $selectedCategory->attributes()->delete();

        foreach ($category->attributes as $attribute) {
            $selectedCategory->attributes()->attach($attribute->id, ['sort' => $attribute->pivot->sort]);
        }

        alert()->success('کپی موفق', 'دیتاشیت با موفقیت کپی شد');

        return back();
    }

    public function storeSort(Request $request, Category $category)
    {
        $request->validate([
            'sorts' => 'array',
            'sorts.*' => 'nullable|numeric',
            'default_value' => 'array',
            'default_value.*' => 'nullable|string|max:255',
        ]);

        foreach ($category->attributes()->orderBy('sort', 'ASC')->get() as $index => $attribute) {
            $attribute->pivot->sort = $request->sorts[$index];
            $attribute->pivot->default_value = $request->default_value[$index];
            $attribute->pivot->save();
        }

        alert()->success('ثبت موفق', 'Sort با موفقیت ثبت شد');

        return back();
    }
}
