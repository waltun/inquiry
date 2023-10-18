<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Invoice;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function choose(Contract $contract)
    {
        if (auth()->user()->role == 'admin') {
            $invoices = Invoice::latest()->where('complete', true)->get();
        } else {
            $invoices = Invoice::where('user_id', auth()->user()->id)->where('complete', true)->latest()->get();
        }

        return view('contracts.products.choose-product', compact('contract', 'invoices'));
    }

    public function storeChoose(Request $request)
    {
        $invoice = Invoice::find($request->invoice_id);
        $products = $invoice->products()->where('deleted_at', null)->get();

        if (!$products->isEmpty()) {
            return response(['products' => $products]);
        }
        return response(['data' => null]);
    }
}
