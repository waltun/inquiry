<?php

namespace App\Http\Controllers;

use App\Models\Part;
use Illuminate\Http\Request;

class CalculateController extends Controller
{
    public function coilEvaperator(Part $part)
    {
        return view('calculate.coil.evaperator', compact('part'));
    }

    public function coilAbi(Part $part)
    {
        return view('calculate.coil.abi', compact('part'));
    }

    public function coilCondensor(Part $part)
    {
        return view('calculate.coil.condensor', compact('part'));
    }

    public function coilFancoil(Part $part)
    {
        return view('calculate.coil.fancoil', compact('part'));
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

    public function damperTaze(Part $part)
    {
        return view('calculate.damper.taze', compact('part'));
    }

    public function damperRaft(Part $part)
    {
        return view('calculate.damper.raft', compact('part'));
    }

    public function damperBargasht(Part $part)
    {
        return view('calculate.damper.bargasht', compact('part'));
    }

    public function damperExast(Part $part)
    {
        return view('calculate.damper.exast', compact('part'));
    }
}
