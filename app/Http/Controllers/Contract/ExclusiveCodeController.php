<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\ContractProduct;
use Illuminate\Http\Request;

class ExclusiveCodeController extends Controller
{
    public function index(Contract $contract)
    {
        return view('contracts.exclusive-code.index', compact('contract'));
    }

    public function store(Request $request, Contract $contract)
    {
        foreach ($request->products as $index => $id) {
            $product = ContractProduct::find($id);
            $product->update([
                'code' => $request->codes[$index]
            ]);
        }

        alert()->success('ثبت موفق', 'کد های اختصاصی با موفقیت ثبت شدند');

        return back();
    }
}
