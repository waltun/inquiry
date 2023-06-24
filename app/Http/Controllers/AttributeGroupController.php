<?php

namespace App\Http\Controllers;

use App\Models\AttributeGroup;
use Illuminate\Http\Request;

class AttributeGroupController extends Controller
{
    public function index()
    {
        $groups = AttributeGroup::latest()->paginate(20);
        return view('attribute-groups.index', compact('groups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        AttributeGroup::create([
            'name' => $request->name
        ]);

        alert()->success('ثبت موفق', 'دسته بندی با موفقیت ایجاد شد');

        return back();
    }

    public function update(Request $request, AttributeGroup $attributeGroup)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $attributeGroup->update([
            'name' => $request->name
        ]);

        alert()->success('بروزرسانی موفق', 'دسته بندی با موفقیت بروزرسانی شد');

        return back();
    }

    public function destroy(AttributeGroup $attributeGroup)
    {
        $attributeGroup->delete();

        alert()->success('حذف موفق', 'دسته بندی با موفقیت حذف شد');

        return back();
    }
}
