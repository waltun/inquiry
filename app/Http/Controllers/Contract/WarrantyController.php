<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\ContractProduct;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class WarrantyController extends Controller
{
    public function index(Contract $contract)
    {
        if (!$contract->packings->isEmpty()) {
            return view('contracts.warranty.index', compact('contract'));
        }

        alert()->success('خطا', 'پکینگ لیست ایجاد نشده!');

        return back();
    }

    public function store(Request $request, Contract $contract)
    {
        $data = $request->validate([
            'warranty_start' => 'required|array',
            'warranty_start.*' => 'nullable|string|max:255',
            'warranty_days' => 'required|array',
            'warranty_days.*' => 'nullable|numeric',
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

            $warrantyStartParse = Carbon::parse($warrantyStart);

            $warrantyEnd = $warrantyStartParse->addDays((int)$data['warranty_days'][$index]);

            $product->warranty_start = $warrantyStart;
            $product->warranty_end = $warrantyEnd;
            $product->warranty_days = $data['warranty_days'][$index];
            $product->save();
        }

        alert()->success('ثبت موفق', 'ثبت تاریخ گارانتی با موفقیت انجام شد');

        return back();
    }
}
