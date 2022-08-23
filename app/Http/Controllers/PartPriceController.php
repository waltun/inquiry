<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PartPriceController extends Controller
{
    public function index()
    {
        Gate::authorize('part-price');

        $parts = Part::query();
        $categories = Category::where('parent_id', 0)->get();

        if ($keyword = request('search')) {
            $parts->where('collection', false)
                ->where('coil', false)
                ->where('name', 'LIKE', "%{$keyword}%");
        }

        if (request('price') == "1") {
            $parts->where('collection', false)
                ->where('coil', false)
                ->where('price', '>', 0);
        }

        if (request('price') == "0") {
            $parts->where('collection', false)
                ->where('coil', false)
                ->where('price', '=', 0);
        }

        if (request()->has('category3')) {
            $parts = $parts->whereHas('categories', function ($q) {
                $q->where('category_id', request('category3'));
            })->where('collection', false)->where('coil', false);
        }

        $parts = $parts->where('collection', false)->where('coil', false)
            ->orderBy('updated_at', 'ASC')->paginate(25)->withQueryString();

        return view('part-price.index', compact('parts', 'categories'));
    }

    public function update(Request $request)
    {
        Gate::authorize('part-price');

        $request->validate([
            'prices' => 'required|array',
            'prices.*' => 'nullable|numeric'
        ]);

        foreach ($request->parts as $index => $part) {
            $updatedPart = Part::where('id', $part)->first();
            if ($updatedPart->price !== (int)$request->prices[$index]) {
                $updatedPart->update([
                    'price' => $request->prices[$index],
                    'old_price' => $updatedPart->price,
                    'updated_at' => now()
                ]);
            }
        }

        alert()->success('ثبت موفق', 'ثبت قیمت گذاری با موفقیت انجام شد');

        return redirect()->route('parts.price.index');
    }
}
