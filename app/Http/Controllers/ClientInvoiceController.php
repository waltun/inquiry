<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class ClientInvoiceController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'client')->latest()->paginate(20);
        return view('client-invoices.index', compact('users'));
    }
}
