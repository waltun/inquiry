<?php

namespace App\Http\Controllers;

use App\Models\Part;
use Illuminate\Http\Request;

class CalculateController extends Controller
{
    public function index(Part $part)
    {
        return view('calculate.index', compact('part'));
    }

    public function store(Request $request, Part $part)
    {
        $request->session()->put('price' . $part->id, $request->price);

        return back();
    }

    public function getData(Request $request)
    {
        $part = Part::find($request->id);
        return response(['data' => $part]);
    }
}
