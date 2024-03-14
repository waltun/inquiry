<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;

class GuaranteeController extends Controller
{
    public function index()
    {
        $contracts = Contract::where('complete', false)->with(['guarantees'])->get();
        return view('guarantees.index', compact('contracts'));
    }
}
