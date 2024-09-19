<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;

class WarrantyConditionController extends Controller
{
    public function index(Contract $contract)
    {
        return view('contracts.warranty-conditions.index', compact('contract'));
    }
}
