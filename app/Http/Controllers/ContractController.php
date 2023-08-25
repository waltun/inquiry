<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\ContractProduct;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index()
    {
        $contracts = Contract::latest()->with(['invoice', 'products'])->paginate(20);
        return view('contracts.index', compact('contracts'));
    }

    public function products(Contract $contract)
    {
        return view('contracts.products', compact('contract'));
    }

    public function updateProducts(Request $request)
    {
        $request->validate([
            'quantities.*' => 'required|numeric',
            'quantities' => 'required|array',
            'prices.*' => 'required|numeric',
            'prices' => 'required|array',
        ]);

        foreach ($request->products as $index => $id) {
            $product = ContractProduct::find($id);

            $product->quantity = $request->quantities[$index];
            $product->price = $request->prices[$index];

            $product->save();
        }

        alert()->success('ثبت موفق', 'مقادیر با موفقیت ثبت شدند');

        return back();
    }

    public function show(Contract $contract)
    {
        return view('contracts.show', compact('contract'));
    }
}
