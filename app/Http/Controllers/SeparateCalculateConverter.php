<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Part;
use Illuminate\Http\Request;

class SeparateCalculateConverter extends Controller
{
    public function index()
    {
        $evaporator = Part::find('1194');
        return view('calculate.separate-converters.index', compact('evaporator'));
    }

    public function evaporator(Part $part)
    {
        $categories = Category::where('parent_id', 0)->get();
        return view('calculate.separate-converters.evaporator', compact('part', 'categories'));
    }

    public function calculateEvaporator(Request $request)
    {
        $inputs = $request->validate([
            'loole_messi' => 'required',
            'size_loole_pooste' => 'required',
            'picho_mohre' => 'required',
            'ayegh' => 'required',
            'sensor' => 'required',
            'cap' => 'required',
            'navdani' => 'required',
            'boshen1' => 'required',
            'boshen2' => 'required',
            'flanch' => 'required',
            'tube' => 'required',
            'ring' => 'required',
            'toole_loole_messi' => 'required',
            'tedad_loole_messi' => 'required',
            'toole_loole_pooste' => 'required'
        ]);
    }

    public function storeEvaporator(Request $request, Part $part)
    {
        dd($request->all());
    }
}
