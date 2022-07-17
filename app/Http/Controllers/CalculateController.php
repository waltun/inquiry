<?php

namespace App\Http\Controllers;

use App\Models\Part;
use Illuminate\Http\Request;

class CalculateController extends Controller
{
    public function coil(Part $part)
    {
        return view('calculate.coil', compact('part'));
    }

    public function storeCoil(Request $request, Part $part)
    {
        $request->session()->put('price' . $part->id, $request->final_price);

        alert()->success('محاسبه موفق', 'محاسبه کویل با موفقیت انجام شد');

        return redirect()->route('inquiries.index');
    }

    public function getDataCoil(Request $request)
    {
        $part = Part::find($request->id);
        return response(['data' => $part]);
    }

    public function damper(Part $part)
    {
        return view('calculate.damper', compact('part'));
    }
}
