<?php

namespace App\Http\Controllers;

use App\Models\CurrentPrice;
use App\Models\Modell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductCurrentPriceController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:current-price')->only(['index']);
    }

    public function index()
    {
        $modells = Modell::where('standard', true)->get();
        return view('product-current-price.index', compact('modells'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'percents' => 'array',
            'modells' => 'array'
        ]);

        foreach ($request->modells as $index => $id) {
            $modell = Modell::find($id);
            $modell->percent = $request->percents[$index];
            $modell->save();
        }

        alert()->success('ثبت موفق', 'ضرایب با موفقیت ثبت شدند');

        return back();
    }
}
