<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:payments')->only(['index']);
    }

    public function index()
    {
        $contracts = Contract::latest()->with(['payments', 'products'])->paginate(20);
        return view('payments.index', compact('contracts'));
    }
}
