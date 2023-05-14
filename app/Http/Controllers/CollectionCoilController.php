<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\DeleteButton;
use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CollectionCoilController extends Controller
{
    public function index()
    {
        Gate::authorize('collections');

        $parts = Part::query();
        $categories = Category::where('parent_id', 0)->get();
        $delete = DeleteButton::where('active', '1')->first();

        if ($keyword = request('search')) {
            $parts->where('collection', true)
                ->where('coil', true)
                ->where('name', 'LIKE', "%{$keyword}%");
        }

        if (!is_null(request('category3'))) {
            if (request()->has('category3')) {
                $parts = $parts->whereHas('categories', function ($q) {
                    $q->where('category_id', request('category3'));
                })->where('collection', true)->where('coil', true);
            }
        }

        if (is_null(request('category3'))) {
            if (request()->has('category2')) {
                $parts = $parts->whereHas('categories', function ($q) {
                    $q->where('category_id', request('category2'));
                })->where('collection', true)->where('coil', true);
            }
        }

        $parts = $parts->where('collection', true)->where('coil', true)->latest()
            ->paginate(25)->withQueryString();

        return view('collection-coils.index', compact('parts', 'categories', 'delete'));
    }

    public function standard(Request $request, Part $part)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $category = $part->categories()->latest()->first();
        $lastPart = $category->parts()->latest()->first();
        $code = str_pad($lastPart->code + 1, 4, "0", STR_PAD_LEFT);

        $newPart = $part->replicate()->fill([
            'name' => $request->name,
            'code' => $code,
            'standard' => true,
            'inquiry_id' => null,
            'product_id' => null,
            'price_updated_at' => now(),
            'price' => 0,
            'weight' => 0
        ]);
        $newPart->save();

        $newPart->categories()->syncWithoutDetaching($part->categories);

        foreach ($part->children as $child) {
            $newPart->children()->syncWithoutDetaching([
                $child->id => [
                    'value' => $child->pivot->value
                ]
            ]);
        }

        $totalPrice = 0;
        $totalWeight = 0;
        foreach ($newPart->children as $child) {
            $totalPrice += ($child->price * $child->pivot->value);
            $totalWeight += ($child->weight * $child->pivot->value);
        }
        $newPart->price = $totalPrice;
        $newPart->weight = $totalWeight;
        $newPart->save();

        alert()->success('ثبت موفق', 'استاندارد سازی با موفقیت انجام شد');

        return back();
    }

    public function multiDelete(Request $request)
    {
        foreach ($request->ids as $id) {
            $part = Part::find($id);
            $part->delete();
        }

        return response('success', '200');
    }
}
