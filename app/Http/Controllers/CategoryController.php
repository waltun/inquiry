<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\DeleteButton;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:categories')->only(['index']);
        $this->middleware('can:create-category')->only(['create', 'store']);
        $this->middleware('can:edit-category')->only(['edit', 'update']);
        $this->middleware('can:delete-category')->only(['destroy']);
    }

    public function index()
    {
        Gate::authorize('categories');

        $categories = Category::where('parent_id', 0)->with(['children'])->latest()->paginate(25);
        $delete = DeleteButton::where('active', '1')->first();

        return view('categories.index', compact('categories', 'delete'));
    }

    public function create()
    {
        Gate::authorize('categories');

        $categories = Category::all();

        $code = $this->getCode();
        session()->put('prev-url', url()->previous());

        return view('categories.create', compact('categories', 'code'));
    }

    public function store(Request $request)
    {
        Gate::authorize('categories');

        $request->validate([
            'name' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'parent_id' => 'required',
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
            'name_en' => $request['name_en'],
            'code' => $request['code'],
            'parent_id' => $request['parent_id']
        ]);

        alert()->success('ثبت موفق', 'ثبت دسته بندی با موفقیت انجام شد');
        $prevUrl = session('prev-url', route('categories.index'));

        return redirect()->to($prevUrl);
    }

    public function edit(Category $category)
    {
        Gate::authorize('categories');

        $categories = Category::all();
        session()->put('prev-url', url()->previous());

        return view('categories.edit', compact('category', 'categories'));
    }

    public function update(Request $request, Category $category)
    {
        Gate::authorize('categories');

        $request->validate([
            'name' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
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
            'name_en' => $request['name_en'],
            'code' => $request['code'],
            'parent_id' => $request['parent_id']
        ]);

        alert()->success('ویرایش موفق', 'ویرایش دسته بندی با موفقیت انجام شد');
        $prevUrl = session('prev-url', route('categories.index'));

        return redirect()->to($prevUrl);
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

    public function children(Category $category)
    {
        session()->put('prev-url', url()->previous());
        $delete = DeleteButton::where('active', '1')->first();

        return view('categories.children', compact('category', 'delete'));
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
