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

        if (auth()->user()->role == 'admin') {
            $selectInvoices = Invoice::latest()->where('complete', true)->paginate(20);
        } else {
            $selectInvoices = Invoice::where('user_id', auth()->user()->id)->where('complete', true)->latest()->paginate(20);
        }

        return view('contracts.invoices.index', compact('invoices', 'contract', 'selectInvoices'));
    }
}
