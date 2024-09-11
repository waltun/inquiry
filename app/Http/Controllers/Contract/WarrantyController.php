<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\ContractProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class WarrantyController extends Controller
{
    public function index(Contract $contract)
    {
        return view('contracts.warranty.index', compact('contract'));
    }

    public function store(Request $request, Contract $contract)
    {
        $data = $request->validate([
            'warranty_start' => 'required|array',
            'warranty_start.*' => 'nullable|string|max:255',
            'warranty_end' => 'required|array',
            'warranty_end.*' => 'nullable|string|max:255',
            'products' => 'required|array',
            'products.*' => 'required|integer',
        ]);

        foreach ($request->products as $index => $id) {
            $product = ContractProduct::find($id);

            $warrantyStart = null;
            if (!is_null($request->warranty_start[$index])) {
                $explodeStartDate = explode('/', $request->warranty_start[$index]);
                $warrantyStart = (new Jalalian($explodeStartDate[0], $explodeStartDate[1], $explodeStartDate[2]))->toCarbon()->toDateTimeString();
            }

            $warrantyEnd = null;
            if (!is_null($request->warranty_end[$index])) {
                $explodeEndDate = explode('/', $request->warranty_end[$index]);
                $warrantyEnd = (new Jalalian($explodeEndDate[0], $explodeEndDate[1], $explodeEndDate[2]))->toCarbon()->toDateTimeString();
            }

            $product->warranty_start = $warrantyStart;
            $product->warranty_end = $warrantyEnd;
            $product->save();
        }

        alert()->success('ثبت موفق', 'ثبت تاریخ گارانتی با موفقیت انجام شد');

        return back();
    }
}
