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
        $categories = Category::all();

        if ($keyword = request('search')) {
            $parts->where('collection', false)
                ->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('unit', 'LIKE', "%{$keyword}%")
                ->orWhere('price', 'LIKE', "%{$keyword}%");
        }

        if ($keyword = request('code')) {
            $parts = $parts->where('collection', false)->where('code', 'LIKE', $keyword);
        }

        if (request()->has('category')) {
            $parts = $parts->where('collection', false)->where('category_id', request('category'));
        }

        $parts = $parts->where('collection', false)->latest()->paginate(25);

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
            $updatedPart->update([
                'price' => $request->prices[$index],
                'updated_at' => now()
            ]);
        }

        alert()->success('ثبت موفق', 'ثبت قیمت گذاری با موفقیت انجام شد');

        return redirect()->route('parts.price.index');
    }
}
