<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\SystemCategory;
use Illuminate\Http\Request;

class SystemCategoryController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('can:categories')->only(['index', 'children']);
//        $this->middleware('can:create-category')->only(['create', 'store']);
//        $this->middleware('can:edit-category')->only(['edit', 'update']);
//        $this->middleware('can:delete-category')->only(['destroy']);
//    }

    public function index()
    {
        $categories = SystemCategory::where('parent_id', 0)->with(['children'])->latest()->paginate(25);
        return view('systems.categories.index', compact('categories'));
    }

    public function children(SystemCategory $system_category)
    {
        return view('systems.categories.children', compact('system_category'));
    }

    public function create()
    {
        $code = $this->getCode();
        session()->put('prev-url', url()->previous());
        return view('systems.categories.create', compact('code'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'required|integer'
        ]);

        if ($request->parent_id == 0) {
            $request->validate([
                'code' => 'required|numeric|digits:1'
            ]);
        } else {
            $request->validate([
                'code' => 'required|numeric|digits:2'
            ]);
        }

        SystemCategory::create([
            'name' => $request->name,
            'code' => $request->code,
            'parent_id' => $request->parent_id
        ]);

        alert()->success('ثبت موفق', 'دسته بندی با موفقیت ایجاد شد');
        $prevUrl = session('prev-url', route('system-categories.index'));

        return redirect()->to($prevUrl);
    }

    public function edit(SystemCategory $system_category)
    {
        $categories = SystemCategory::all()->except($system_category->id);
        session()->put('prev-url', url()->previous());
        return view('systems.categories.edit', compact('system_category', 'categories'));
    }

    public function update(Request $request, SystemCategory $system_category)
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

        $system_category->update([
            'name' => $request['name'],
            'code' => $request['code'],
            'parent_id' => $request['parent_id']
        ]);

        alert()->success('بروزرسانی موفق', 'دسته بندی با موفقیت بروزرسانی شد');
        $prevUrl = session('prev-url', route('system-categories.index'));

        return redirect()->to($prevUrl);
    }

    public function destroy(SystemCategory $system_category)
    {
        if ($system_category->codings->isEmpty()) {

            $system_category->delete();

            alert()->success('حذف موفق', 'دسته بندی با موفقیت حذف شد');

            return back();
        }

        alert()->error('خطا', 'دسته بندی دارای کدینگ می باشد!');
        return back();
    }

    public function getCode()
    {
        if (request()->has('parent')) {
            $parent = request('parent');
            $lastCategory = SystemCategory::where('parent_id', $parent)->latest()->first();
            if (!is_null($lastCategory)) {
                $code = str_pad($lastCategory->code + 1, 2, "0", STR_PAD_LEFT);
            } else {
                $code = '01';
            }
        } else {
            $lastCategory = SystemCategory::where('parent_id', 0)->latest()->first();
            if (!is_null($lastCategory)) {
                $code = str_pad($lastCategory->code + 1, 1, "0", STR_PAD_LEFT);
            } else {
                $code = '1';
            }
        }
        return $code;
    }
}
