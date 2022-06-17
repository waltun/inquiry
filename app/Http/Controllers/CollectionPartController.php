<?php

namespace App\Http\Controllers;

use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CollectionPartController extends Controller
{
    public function index()
    {
        Gate::authorize('part-collection');

        $parts = Part::query();

        if ($keyword = request('search')) {
            $parts->where('collection', true)
                ->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('unit', 'LIKE', "%{$keyword}%")
                ->orWhere('price', 'LIKE', "%{$keyword}%");
        }

        if ($keyword = request('code')) {
            $parts = $parts->where('code', 'LIKE', $keyword)->where('collection', true);
        }

        $parts = $parts->where('collection', true)->latest()->paginate(25);

        return view('collection-parts.index', compact('parts'));
    }

    public function create(Part $parentPart)
    {
        $parts = Part::query();

        if ($keyword = request('search')) {
            $parts->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('unit', 'LIKE', "%{$keyword}%")
                ->orWhere('price', 'LIKE', "%{$keyword}%");
        }

        if ($keyword = request('code')) {
            $parts = $parts->where('code', 'LIKE', $keyword);
        }

        $parts = $parts->latest()->paginate(25)->except($parentPart->id)
            ->except($parentPart->children()->pluck('parent_part_id')->toArray());

        return view('collection-parts.create', compact('parts', 'parentPart'));
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

    public function destroy(Part $parentPart, Part $childPart)
    {
        $parentPart->children()->detach($childPart->id);

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
}
