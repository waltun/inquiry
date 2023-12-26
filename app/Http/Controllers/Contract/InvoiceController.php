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
        $invoice = Invoice::find($contract->invoice_id);

        return view('contracts.invoices.index', compact('invoice', 'contract'));
    }
}
