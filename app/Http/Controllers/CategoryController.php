<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(25);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Category::create([
            'name' => $request['name']
        ]);

        alert()->success('ثبت موفق', 'ثبت دسته بندی با موفقیت انجام شد');

        return redirect()->route('categories.index');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $category->update([
            'name' => $request['name']
        ]);

        alert()->success('ویرایش موفق', 'ویرایش دسته بندی با موفقیت انجام شد');

        return redirect()->route('categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        alert()->success('حذف موفق', 'حذف دسته بندی با موفقیت انجام شد');

        return back();
    }
}
