<?php

namespace App\Http\Controllers;

use App\Models\Contract;
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
            $factors = Factor::latest()->with(['contract', 'contractProducts', 'user'])->where('confirm', 0)->paginate(20);
            $contracts = Contract::where('type', 'official')->get();
        } else {
            $factors = Factor::latest()->with(['contract', 'contractProducts', 'user'])->where('confirm', 0)->whereHas('contract', function ($query) {
                $query->where('user_id', auth()->id());
            })->paginate(20);

            $contracts = auth()->user()->contracts()->where('type', 'official')->get();
        }

        return view('factors.index', compact('factors', 'contracts'));
    }

    public function success()
    {
        if (auth()->user()->role == 'admin') {
            $factors = Factor::latest()->with(['contract', 'contractProducts', 'user'])->where('confirm', 1)->paginate(20);
        } else {
            $factors = Factor::latest()->with(['contract', 'contractProducts', 'user'])->where('confirm', 1)->whereHas('contract', function ($query) {
                $query->where('user_id', auth()->id());
            })->paginate(20);
        }
        return view('factors.success', compact('factors'));
    }
}
