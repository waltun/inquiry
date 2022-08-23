<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CollectionPartController extends Controller
{
    public function index()
    {
        Gate::authorize('part-collection');

        $parts = Part::query();
        $categories = Category::where('parent_id',0)->get();

        if ($keyword = request('search')) {
            $parts->where('collection', true)
                ->where('coil', false)
                ->where('name', 'LIKE', "%{$keyword}%");
        }

        if (!is_null(request('category3'))) {
            if (request()->has('category3')) {
                $parts = $parts->whereHas('categories', function ($q) {
                    $q->where('category_id', request('category3'));
                })->where('collection', true)->where('coil', false);
            }
        }

        if (is_null(request('category3'))) {
            if (request()->has('category2')) {
                $parts = $parts->whereHas('categories', function ($q) {
                    $q->where('category_id', request('category2'));
                })->where('collection', true)->where('coil', false);
            }
        }

        $parts = $parts->where('collection', true)->where('coil', false)->latest()
            ->paginate(25)->withQueryString();

        return view('collection-parts.index', compact('parts', 'categories'));
    }

    public function create(Part $parentPart)
    {
        $parts = Part::query();
        $categories = Category::all();

        if ($keyword = request('search')) {
            $parts->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('unit', 'LIKE', "%{$keyword}%")
                ->orWhere('price', 'LIKE', "%{$keyword}%");
        }

        if ($keyword = request('code')) {
            $parts = $parts->where('code', 'LIKE', $keyword);
        }

        if (request()->has('category')) {
            $parts = $parts->whereHas('categories', function ($q) {
                $q->where('category_id', request('category'));
            })->where('collection', false);
        }

        $parts = $parts->where('collection', false)->latest()->paginate(25)->except($parentPart->id)
            ->except($parentPart->children()->pluck('parent_part_id')->toArray());

        return view('collection-parts.create', compact('parts', 'parentPart', 'categories'));
    }

    public function store(Part $parentPart, Part $childPart)
    {
        $parentPart->children()->syncWithoutDetaching($childPart->id);

        alert()->success('ثبت موفق', 'افزودن قطعه به مجموعه با موفقیت انجام شد');

        return back();
    }

    public function parts(Part $parentPart)
    {
        return view('collection-parts.parts', compact('parentPart'));
    }

    public function destroy(Part $parentPart)
    {
        $parentPart->children()->detach();
        $parentPart->delete();

        alert()->success('حذف موفق', 'حذف قطعه از مجموعه با موفقیت انجام شد');

        return back();
    }

    public function destroyPart(Part $parentPart, $childId)
    {
        Gate::authorize('groups');

        $totalPrice = 0;

        $parentPart->children()->detach($childId);

        foreach ($parentPart->children as $child) {
            if ($child) {
                $totalPrice += $child->price * $child->pivot->value;
            }
        }

        $parentPart->price = $totalPrice;
        $parentPart->save();

        alert()->success('حذف موفق', 'حذف قطعه از مجموعه با موفقیت انجام شد');

        return back();
    }

    public function amounts(Part $parentPart)
    {
        return view('collection-parts.amounts', compact('parentPart'));
    }

    public function storeAmounts(Request $request, Part $parentPart)
    {
        $request->validate([
            'values' => 'required|array',
            'values.*' => 'required|numeric'
        ]);

        $totalPrice = 0;

        foreach ($parentPart->children as $index => $childPart) {
            $childPart->pivot->value = $request->values[$index];
            $childPart->pivot->save();

            $totalPrice += ($childPart->price * $request->values[$index]);
        }

        $parentPart->price = $totalPrice;
        $parentPart->save();

        alert()->success('ثبت موفق', 'ثبت مقادیر با موفقیت انجام شد');

        return redirect()->route('collections.index');
    }

    public function replicate(Part $parentPart)
    {
        $category = $parentPart->categories()->latest()->first();
        $lastPart = $category->parts()->latest()->first();
        $code = str_pad($lastPart->code + 1, 4, "0", STR_PAD_LEFT);

        $newPart = $parentPart->replicate()->fill([
            'code' => $code,
            'name' => $parentPart->name . " کپی شده ",
            'price' => 0
        ]);
        $newPart->save();

        foreach ($parentPart->children as $child) {
            $newPart->children()->attach($child->id);
        }

        foreach ($parentPart->categories as $category) {
            $newPart->categories()->attach($category->id);
        }

        alert()->success('کپی موفق', 'کپی قطعه با موفقیت انجام شد');

        return back();
    }
}
