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
        $showPriceProduct = $invoice->products()->select('show_price')->where('group_id', '!=', 0)
            ->where('model_id', '!=', 0)->get()->contains('show_price', '==', '0');
        $showPricePart = $invoice->products()->select('show_price')->where('part_id', '!=', 0)
            ->get()->contains('show_price', '==', '0');

        $invoiceUserIds = $invoice->users->pluck('id')->toArray();

        if (in_array(auth()->user()->id, $invoiceUserIds)) {
            $invoice->seen_at = now();
            $invoice->save();
        }

        return view('clients.show-invoice', compact('user', 'invoice', 'showPricePart', 'showPriceProduct'));
    }

    public function printInvoice(User $user, Invoice $invoice)
    {
        $showPriceProduct = $invoice->products()->select('show_price')->where('group_id', '!=', 0)
            ->where('model_id', '!=', 0)->get()->contains('show_price', '==', '0');
        $showPricePart = $invoice->products()->select('show_price')->where('part_id', '!=', 0)
            ->get()->contains('show_price', '==', '0');
        return view('clients.print-invoice', compact('user', 'invoice', 'showPricePart', 'showPriceProduct'));
    }

    public function printDatasheet(User $user, Invoice $invoice)
    {
        return view('clients.print-datasheet', compact('user', 'invoice'));
    }
}
