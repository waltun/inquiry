<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\ContractProduct;
use App\Models\WarrantyCondition;
use Illuminate\Http\Request;

class WarrantyConditionController extends Controller
{
    public function index(Contract $contract)
    {
        return view('contracts.warranty-conditions.index', compact('contract'));
    }

    public function product(Contract $contract, ContractProduct $contractProduct)
    {
        $terms = WarrantyCondition::all();

        return view('contracts.warranty-conditions.product', compact('contract', 'contractProduct', 'terms'));
    }

    public function storeDescription(Request $request, Contract $contract, ContractProduct $contractProduct)
    {
        $request->validate([
            'description' => 'required|string',
        ]);

        $contractProduct->update([
            'description' => $request['description']
        ]);

        alert()->success('ثبت موفق', 'شرایط گارانتی محصول با موفقیت ثبت شد');

        return redirect()->route('contracts.warranty-condition.index', $contract->id);
    }
}
