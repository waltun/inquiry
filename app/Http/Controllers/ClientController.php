<?php

namespace App\Http\Controllers;

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
}
