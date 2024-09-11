<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;

class GuaranteeController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:guarantees')->only(['index']);
    }

    public function index()
    {
        if (auth()->user()->role == 'admin') {
            $contracts = Contract::where('complete', false)->with(['guarantees'])->get();
        } else {
            $contracts = auth()->user()->contracts()->where('complete', false)->with(['guarantees'])->get();
        }

        return view('guarantees.index', compact('contracts'));
    }
}
