<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function dashboard(User $user)
    {
        return view('clients.dashboard', compact('user'));
    }

    public function invoice(User $user)
    {
        $invoices = $user->invoices;
        return view('clients.invoices', compact('user', 'invoices'));
    }

    public function showInvoice(User $user, Invoice $invoice)
    {
        return view('clients.show-invoice', compact('user', 'invoice'));
    }

    public function printInvoice(User $user, Invoice $invoice)
    {
        return view('clients.print-invoice', compact('user', 'invoice'));
    }

    public function printDatasheet(User $user, Invoice $invoice)
    {
        return view('clients.print-datasheet', compact('user', 'invoice'));
    }
}
