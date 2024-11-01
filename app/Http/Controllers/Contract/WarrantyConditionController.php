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
        $terms = WarrantyCondition::all();

        return view('contracts.warranty-conditions.index', compact('contract', 'terms'));
    }

    public function store(Request $request, Contract $contract)
    {
        $request->validate([
            'description' => 'required|string',
        ]);

        $contract->update([
            'description' => $request['description']
        ]);

        alert()->success('ثبت موفق', 'شرایط گارانتی با موفقیت ثبت شد');

        return redirect()->route('contracts.warranty-condition.index', $contract->id);
    }
}
