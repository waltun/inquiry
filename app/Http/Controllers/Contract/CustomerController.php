<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Contract $contract)
    {
        return view('contracts.customer.index', compact('contract'));
    }
}
