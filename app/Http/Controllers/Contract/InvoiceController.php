<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(Contract $contract)
    {
        $invoices = $contract->invoices;

        if ($keyword = request('search')) {
            $invoices->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('marketer', 'LIKE', "%{$keyword}%")
                ->orWhere('inquiry_number', 'LIKE', "%{$keyword}%");
        }

        if (request()->has('user_id') && !is_null(request('user_id'))) {
            $invoices = $invoices->where('user_id', request('user_id'));
        }

        if (auth()->user()->role == 'admin') {
            $selectInvoices = Invoice::latest()->where('complete', true)->paginate(20);
        } else {
            $selectInvoices = Invoice::where('user_id', auth()->user()->id)->where('complete', true)->latest()->paginate(20);
        }

        return view('contracts.invoices.index', compact('invoices', 'contract', 'selectInvoices'));
    }
}
