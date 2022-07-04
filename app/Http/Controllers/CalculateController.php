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
}
