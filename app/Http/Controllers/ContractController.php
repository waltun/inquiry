<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index()
    {
        $contracts = Contract::latest()->with(['invoice', 'products'])->paginate(20);
        return view('contracts.index', compact('contracts'));
    }
}
