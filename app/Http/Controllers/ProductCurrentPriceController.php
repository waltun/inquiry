<?php

namespace App\Http\Controllers;

use App\Models\Modell;
use Illuminate\Http\Request;

class ProductCurrentPriceController extends Controller
{
    public function index()
    {
        $modells = Modell::where('standard',true)->get();
        return view('product-current-price.index',compact('modells'));
    }
}
