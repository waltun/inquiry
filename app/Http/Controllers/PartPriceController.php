<?php

namespace App\Http\Controllers;

use App\Models\Part;
use Illuminate\Http\Request;

class PartPriceController extends Controller
{
    public function index()
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

        $parts = $parts->latest()->paginate(25);

        return view('part-price.index', compact('parts'));
    }

    public function edit(Part $part)
    {
        return view('part-price.edit', compact('part'));
    }

    public function update(Request $request, Part $part)
    {
        $request->validate([
            'price' => 'required|numeric'
        ]);

        $part->update([
            'price' => $request['price']
        ]);

        alert()->success('ثبت موفق', 'ثبت قیمت گذاری با موفقیت انجام شد');

        return redirect()->route('parts.price.index');
    }
}
