<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class ClientInvoiceController extends Controller
{
    public function index()
    {
        $users = User::query();

        if ($keyword = request('search')) {
            $users->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('phone', 'LIKE', "%{$keyword}%");
        }

        $users = $users->where('role', 'client')->latest()->paginate(20)->withQueryString();
        return view('client-invoices.index', compact('users'));
    }
}
