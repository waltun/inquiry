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
        if (auth()->user()->role == 'admin') {
            $contracts = Contract::orderBy('number', 'DESC')->with(['payments', 'products'])->paginate(20);
        } else {
            $contracts = Contract::where('user_id', auth()->user()->id)->orderBy('number', 'DESC')->with(['payments', 'products'])->paginate(20);
        }

        return view('payments.index', compact('contracts'));
    }
}
