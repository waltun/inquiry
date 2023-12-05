<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ClientInvoiceController extends Controller
{
    public function index(User $user)
    {
        $invoices = $user->invoices;
        return view('client-invoice.index', compact('invoices', 'user'));
    }
}
