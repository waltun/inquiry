<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Part;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CollectionPartController extends Controller
{
    public function index()
    {
        Gate::authorize('collections');

        $parts = Part::query();
        $setting = Setting::where('active', '1')->first();
        $categories = Category::where('parent_id', 0)->get();

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

        return view('collection-parts.index', compact('parts', 'categories', 'setting'));
    }

    public function create(Part $parentPart)
    {
        Gate::authorize('collections');

        $parts = Part::query();
        $categories = Category::where('parent_id', 0)->get();

        if ($keyword = request('search')) {
            $parts->where('collection', false)
                ->where('coil', false)
                ->where('name', 'LIKE', "%{$keyword}%");
        }

        if (!is_null(request('category3'))) {
            if (request()->has('category3')) {
                $parts = $parts->whereHas('categories', function ($q) {
                    $q->where('category_id', request('category3'));
                })->where('collection', false)->where('coil', false);
            }
        }

        if (is_null(request('category3'))) {
            if (request()->has('category2')) {
                $parts = $parts->whereHas('categories', function ($q) {
                    $q->where('category_id', request('category2'));
                })->where('collection', false)->where('coil', false);
            }
        }

        $parts = $parts->where('collection', false)->where('coil', false)->latest()->paginate(25)->except($parentPart->id)
            ->except($parentPart->children()->pluck('parent_part_id')->toArray());

        return view('collection-parts.create', compact('parts', 'parentPart', 'categories'));
    }

    public function store(Part $parentPart, Part $childPart)
    {
        Gate::authorize('collections');

        $parentPart->children()->syncWithoutDetaching($childPart->id);

        alert()->success('ثبت موفق', 'افزودن قطعه به مجموعه با موفقیت انجام شد');

        return back();
    }

    public function parts(Part $parentPart)
    {
        Gate::authorize('collections');

        $setting = Setting::where('active', '1')->first();

        return view('collection-parts.parts', compact('parentPart', 'setting'));
    }

    public function destroy(Part $parentPart)
    {
        Gate::authorize('collections');

        $parentPart->children()->detach();
        $parentPart->delete();

        alert()->success('حذف موفق', 'حذف قطعه از مجموعه با موفقیت انجام شد');

        return back();
    }

    public function destroyPart(Part $parentPart, $childId)
    {
        Gate::authorize('collections');

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
        Gate::authorize('collections');

        $setting = Setting::where('active', '1')->first();

        return view('collection-parts.amounts', compact('parentPart', 'setting'));
    }

    public function storeAmounts(Request $request, Part $parentPart)
    {
        Gate::authorize('collections');

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
        Gate::authorize('collections');

        $category = $parentPart->categories()->latest()->first();
        $lastPart = $category->parts()->latest()->first();
        $code = str_pad($lastPart->code + 1, 4, "0", STR_PAD_LEFT);

        $newPart = $parentPart->replicate()->fill([
            'code' => $code,
            'name' => $parentPart->name . " کپی شده ",
            'price' => 0
        ]);
        $newPart->save();

        $newPart->categories()->syncWithoutDetaching($parentPart->categories);

        foreach ($parentPart->children as $part) {
            $newPart->children()->syncWithoutDetaching([
                $part->id => [
                    'value' => $part->pivot->value
                ]
            ]);
        }

        alert()->success('کپی موفق', 'کپی قطعه با موفقیت انجام شد');

        return back();
    }

    public function changeParts(Request $request, Part $parentPart)
    {
        $totalPrice = 0;
        foreach ($parentPart->children as $index => $child) {
            $child->pivot->update([
                'parent_part_id' => $request->part_ids[$index],
                'value2' => $request->units[$index],
                'value' => $request->values[$index],
                'sort' => $request->sorts[$index]
            ]);

            $totalPrice += ($child->price * $request->values[$index]);
        }

        $parentPart->price = $totalPrice;
        $parentPart->save();

        alert()->success('مقادیر', 'مقدار قطعات برای مجموعه با موفقیت ثبت شد');

        return back();
    }
}
