<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'admin') {
            $invoices = Invoice::latest()->paginate(25);
        } else {
            $invoices = Invoice::where('user_id', auth()->user()->id)->latest()->paginate(25);
        }

        return view('invoices.index', compact('invoices'));
    }
}
