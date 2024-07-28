<?php

namespace App\Http\Controllers;

use App\Models\Factor;
use Illuminate\Http\Request;

class FactorController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:factors')->only(['index']);
    }

    public function index()
    {
        $factors = Factor::latest()->with(['contract', 'contractProducts', 'user'])->paginate(20);
        return view('factors.index', compact('factors'));
    }
}
