<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('parent_id', 0)->with(['children'])->latest()->paginate(25);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'required'
        ]);

        if ($request['parent_id'] == 0) {
            $request->validate([
                'code' => 'required|numeric|digits:1'
            ]);
        } else {
            $request->validate([
                'code' => 'required|numeric|digits:2'
            ]);
        }

        Category::create([
            'name' => $request['name'],
            'code' => $request['code'],
            'parent_id' => $request['parent_id']
        ]);

        alert()->success('ثبت موفق', 'ثبت دسته بندی با موفقیت انجام شد');

        return redirect()->route('categories.index');
    }

    public function edit(Category $category)
    {
        $categories = Category::all();
        return view('categories.edit', compact('category', 'categories'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'required',
        ]);

        if ($request['parent_id'] == 0) {
            $request->validate([
                'code' => "required|numeric|digits:1"
            ]);
        } else {
            $request->validate([
                'code' => "required|numeric|digits:2"
            ]);
        }

        $category->update([
            'name' => $request['name'],
            'code' => $request['code'],
            'parent_id' => $request['parent_id']
        ]);

        alert()->success('ویرایش موفق', 'ویرایش دسته بندی با موفقیت انجام شد');

        return redirect()->route('categories.index');
    }

    public function destroy(Category $category)
    {
        if (count($category->children) > 0) {
            $category->children()->delete();
        }

        $category->delete();

        alert()->success('حذف موفق', 'حذف دسته بندی با موفقیت انجام شد');

        return back();
    }
}
