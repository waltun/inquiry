<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PartController extends Controller
{
    public function index()
    {
        Gate::authorize('parts');

        $parts = Part::query();
        $categories = Category::all();

        if ($keyword = request('search')) {
            $parts->where('collection', false)
                ->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('unit', 'LIKE', "%{$keyword}%")
                ->orWhere('price', 'LIKE', "%{$keyword}%");
        }

        if ($keyword = request('code')) {
            $parts = $parts->where('code', 'LIKE', $keyword)->where('collection', false);
        }

//        if (request()->has('category')) {
//            $parts = $parts->where('collection', false)->where('category_id', request('category'));
//        }

        $parts = $parts->where('collection', false)->latest()->paginate(25);

        return view('parts.index', compact('parts', 'categories'));
    }

    public function create()
    {
        Gate::authorize('parts');

        $categories = Category::where('parent_id', 0)->with(['parts'])->get();

        return view('parts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        Gate::authorize('parts');

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
            'price' => 'nullable',
            'collection' => 'required|in:true,false',
            'categories' => 'required|array'
        ]);

        $data = $this->getLastCode($data);

        if ($data['collection'] == 'true') {
            $data['collection'] = true;
        } else {
            $data['collection'] = false;
        }

        $part = Part::create($data);
        $part->categories()->sync($data['categories']);

        alert()->success('ثبت موفق', 'ثبت قطعه با موفقیت انجام شد');

        if ($data['collection']) {
            return redirect()->route('collections.index');
        }
        return redirect()->route('parts.index');
    }

    public function edit(Part $part)
    {
        Gate::authorize('parts');

        $categories = Category::with(['parts'])->get();

        return view('parts.edit', compact('part', 'categories'));
    }

    public function update(Request $request, Part $part)
    {
        Gate::authorize('parts');

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
            'price' => 'nullable',
            'collection' => 'required|in:true,false',
            'categories' => 'required|array'
        ]);

        if ($data['collection'] == 'true') {
            $data['collection'] = true;
        } else {
            $data['collection'] = false;
        }

        $part->update($data);
        $part->categories()->detach();
        $part->categories()->sync($data['categories']);

        alert()->success('ویرایش موفق', 'ویرایش قطعه با موفقیت انجام شد');

        if ($data['collection']) {
            return redirect()->route('collections.index');
        }
        return redirect()->route('parts.index');
    }

    public function destroy(Part $part)
    {
        Gate::authorize('parts');

        $part->delete();

        alert()->success('حذف موفق', 'حذف قطعه با موفقیت انجام شد');

        return back();
    }

    public function replicate(Part $part)
    {
        $lastPart = Part::latest()->first();
        $code = str_pad($lastPart->code + 1, 4, "0", STR_PAD_LEFT);

        $newPart = $part->replicate()->fill([
            'code' => $code,
            'name' => $part->name . " کپی شده ",
        ]);
        $newPart->save();

        return back();
    }

    public function getCategory(Request $request)
    {
        $category = Category::find($request->id);
        $children = $category->children;

        if (count($children) > 0) {
            return response(['data' => $children]);
        }
        return response(['data' => null]);
    }

    public function getLastCode(array $data)
    {
        $lastPart = Part::latest()->first();
        if ($lastPart) {
            $lastPartCode = str_pad($lastPart->code + 1, 3, "0", STR_PAD_LEFT);
            $data['code'] = $lastPartCode;
        } else {
            $data['code'] = '001';
        }
        return $data;
    }
}
