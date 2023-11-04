<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Customer;
use Illuminate\Http\Request;

class FinalContractController extends Controller
{
    public function index()
    {
        $contracts = Contract::query();

        if ($keyword = request('search')) {
            $contracts->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('number', 'LIKE', "%{$keyword}%")
                ->orWhere('marketer', 'LIKE', "%{$keyword}%");
        }

        if (request()->has('type') && !is_null(request('type'))) {
            $contracts->where('type', request('type'));
        }

        if (request()->has('customer') && !is_null(request('customer'))) {
            $contracts->where('customer_id', request('customer'));
        }

        $contracts = $contracts->latest()->with(['invoice', 'products'])->where('complete', 1)->paginate(20)->withQueryString();

        $customers = Customer::latest()->get();
        return view('contracts.final.index', compact('contracts','customers'));
    }
}
