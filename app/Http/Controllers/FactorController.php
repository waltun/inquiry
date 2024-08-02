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
        if (auth()->user()->role == 'admin') {
            $factors = Factor::latest()->with(['contract', 'contractProducts', 'user'])->paginate(20);
        } else {
            $factors = Factor::latest()->with(['contract', 'contractProducts', 'user'])->whereHas('contract', function ($query) {
                $query->where('user_id', auth()->id());
            })->paginate(20);
        }
        return view('factors.index', compact('factors'));
    }
}
