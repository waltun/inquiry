<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Part;
use Illuminate\Http\Request;

class SeparateCalculateElectricalController extends Controller
{
    public function index()
    {
        $panel = Part::find('1879');
        return view('calculate.separate-electrical.index', compact('panel'));
    }

    public function panel(Part $part)
    {
        $categories = Category::where('parent_id', 0)->get();
        return view('calculate.separate-electrical.panel', compact('part', 'categories'));
    }
}
