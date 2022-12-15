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
        $categories = Category::where('parent_id', 0)->get();

        if ($keyword = request('search')) {
            $parts->where('coil', false)
                ->where('name', 'LIKE', "%{$keyword}%");
        }

        if (!is_null(request('category3'))) {
            if (request()->has('category3')) {
                $parts = $parts->whereHas('categories', function ($q) {
                    $q->where('category_id', request('category3'));
                })->where('coil', false);
            }
        }

        if (is_null(request('category3'))) {
            if (request()->has('category2')) {
                $parts = $parts->whereHas('categories', function ($q) {
                    $q->where('category_id', request('category2'));
                })->where('coil', false);
            }
        }

        $parts = $parts->where('coil', false)->latest()
            ->paginate(25)->withQueryString();

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
            'categories' => 'required|array|min:3|max:3',
            'unit2' => 'nullable|string|max:255',
            'operator1' => 'nullable|string|max:255',
            'operator2' => 'nullable|string|max:255',
            'formula1' => 'nullable|numeric',
            'formula2' => 'nullable|numeric',
            'weight' => 'nullable|numeric'
        ]);

        if ($data['collection'] == 'true') {
            $data['collection'] = true;
        } else {
            $data['collection'] = false;
        }

        if (count($request['categories']) == 3 && $request['categories'][2] != "") {
            $part = Part::create($data);
            $part->categories()->sync($data['categories']);
            $code = $this->getLastCode($part);
            $part->code = $code;
            $part->price_updated_at = now();
            $part->save();
        } else {
            return back()->withErrors(['لطفا دسته بندی را به صورت کامل وارد کنید']);
        }

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
            'categories' => 'required|array',
            'unit2' => 'nullable|string|max:255',
            'operator1' => 'nullable|string|max:255',
            'operator2' => 'nullable|string|max:255',
            'formula1' => 'nullable|numeric',
            'formula2' => 'nullable|numeric',
            'weight' => 'nullable|numeric'
        ]);

        if ($data['collection'] == 'true') {
            $data['collection'] = true;
        } else {
            $data['collection'] = false;
        }

        $part->update($data);
        $part->categories()->detach();
        $part->categories()->sync($data['categories']);

        if (!$part->parents->isEmpty()) {
            foreach ($part->parents as $parent) {
                $price = 0;
                foreach ($parent->children as $child) {
                    $price += $child->price * $child->pivot->value;
                }
                $parent->update([
                    'price' => $price,
                    'old_price' => $parent->price,
                    'price_updated_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

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
        Gate::authorize('parts');

        $category = $part->categories()->latest()->first();
        $lastPart = $category->parts()->latest()->first();
        $code = str_pad($lastPart->code + 1, 4, "0", STR_PAD_LEFT);

        $newPart = $part->replicate()->fill([
            'code' => $code,
            'name' => $part->name . " کپی شده ",
        ]);
        $newPart->save();

        foreach ($part->categories as $category) {
            $newPart->categories()->attach($category->id);
        }

        alert()->success('کپی موفق', 'کپی قطعه با موفقیت انجام شد');

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

    public function getLastCode($part)
    {
        $parts = Part::all();
        if (!$parts->isEmpty()) {
            $category = $part->categories()->latest()->first();
            $categoryPart = $category->parts->toArray();

            if (count($categoryPart) == 1) {
                $code = '0001';
            }
            if (count($categoryPart) == 2) {
                $lastPart = $categoryPart[0];
                $code = str_pad($lastPart['code'] + 1, 4, "0", STR_PAD_LEFT);
            }
            if (count($categoryPart) > 2) {
                $lastPart = $categoryPart[count($categoryPart) - 2];
                $code = str_pad($lastPart['code'] + 1, 4, "0", STR_PAD_LEFT);
            }
        } else {
            $code = '0001';
        }
        return $code;
    }
}
