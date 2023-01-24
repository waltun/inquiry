<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        Gate::authorize('categories');

        $categories = Category::where('parent_id', 0)->with(['children'])->latest()->paginate(25);

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        Gate::authorize('categories');

        $categories = Category::all();

        $code = $this->getCode();

        return view('categories.create', compact('categories', 'code'));
    }

    public function store(Request $request)
    {
        Gate::authorize('categories');

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
        Gate::authorize('categories');

        $categories = Category::all();
        return view('categories.edit', compact('category', 'categories'));
    }

    public function update(Request $request, Category $category)
    {
        Gate::authorize('categories');

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
        Gate::authorize('categories');

        if (count($category->children) > 0) {
            $category->children()->delete();
        }

        $category->delete();

        alert()->success('حذف موفق', 'حذف دسته بندی با موفقیت انجام شد');

        return back();
    }

    public function getCode()
    {
        if (request()->has('parent')) {
            $parent = request('parent');
            $lastCategory = Category::where('parent_id', $parent)->latest()->first();
            if (!is_null($lastCategory)) {
                $code = str_pad($lastCategory->code + 1, 2, "0", STR_PAD_LEFT);
            } else {
                $code = '01';
            }
        } else {
            $lastCategory = Category::where('parent_id', 0)->latest()->first();
            if (!is_null($lastCategory)) {
                $code = str_pad($lastCategory->code + 1, 1, "0", STR_PAD_LEFT);
            } else {
                $code = '1';
            }
        }
        return $code;
    }
}
