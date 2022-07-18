<?php

namespace App\Http\Controllers;

use App\Models\Part;
use Illuminate\Http\Request;

class CalculateDamperController extends Controller
{
    public function taze(Part $part)
    {
        return view('calculate.damper.taze', compact('part'));
    }

    public function raft(Part $part)
    {
        return view('calculate.damper.raft', compact('part'));
    }

    public function bargasht(Part $part)
    {
        return view('calculate.damper.bargasht', compact('part'));
    }

    public function exast(Part $part)
    {
        return view('calculate.damper.exast', compact('part'));
    }

    public function store(Request $request, Part $part)
    {
        $request->session()->put('price' . $part->id, $request->final_price);

        alert()->success('محاسبه موفق', 'محاسبه دمپر با موفقیت انجام شد');

        return redirect()->route('inquiries.index');
    }
}
