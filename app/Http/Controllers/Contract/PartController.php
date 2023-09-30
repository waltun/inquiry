<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;

class PartController extends Controller
{
    public function index(Contract $contract)
    {
        return view('contracts.parts.index', compact('contract'));
    }
}
