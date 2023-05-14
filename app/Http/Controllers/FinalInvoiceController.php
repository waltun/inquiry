<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class FinalInvoiceController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'admin') {
            $invoices = Invoice::latest()->where('complete', true)->paginate(25);
        } else {
            $invoices = Invoice::where('user_id', auth()->user()->id)->where('complete', true)->latest()->paginate(25);
        }

        return view('invoices.final', compact('invoices'));
    }

    public function print(Invoice $invoice)
    {
        return view('invoices.print', compact('invoice'));
    }

    public function printPage(Invoice $invoice)
    {
        return view('invoices.print-page', compact('invoice'));
    }

    public function restore(Invoice $invoice)
    {
        $invoice->update([
            'complete' => '0'
        ]);

        alert()->success('بازگردانی موفق', 'پیش فاکتور با موفقیت بازگردانی شد');

        return back();
    }
}
