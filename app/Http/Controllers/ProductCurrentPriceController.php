<?php

namespace App\Http\Controllers;

use App\Models\Modell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductCurrentPriceController extends Controller
{
    public function index()
    {
        Gate::authorize('current-price');

        $modells = Modell::where('standard', true)->get();
        return view('product-current-price.index', compact('modells'));
    }
}
