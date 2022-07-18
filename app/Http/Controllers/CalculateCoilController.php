<?php

namespace App\Http\Controllers;

use App\Models\Part;
use Illuminate\Http\Request;

class CalculateCoilController extends Controller
{
    public function evaperator(Part $part)
    {
        return view('calculate.coil.evaperator', compact('part'));
    }

    public function abi(Part $part)
    {
        return view('calculate.coil.abi', compact('part'));
    }

    public function condensor(Part $part)
    {
        return view('calculate.coil.condensor', compact('part'));
    }

    public function fancoil(Part $part)
    {
        return view('calculate.coil.fancoil', compact('part'));
    }

    public function store(Request $request, Part $part)
    {
        $request->session()->put('price' . $part->id, $request->final_price);

        alert()->success('محاسبه موفق', 'محاسبه کویل با موفقیت انجام شد');

        return redirect()->route('inquiries.index');
    }

    public function getData(Request $request)
    {
        $part = Part::find($request->id);
        return response(['data' => $part]);
    }
}
