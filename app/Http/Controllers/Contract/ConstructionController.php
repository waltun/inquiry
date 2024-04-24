<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\ContractProduct;
use App\Models\Serial;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class ConstructionController extends Controller
{
    public function index(Contract $contract)
    {
        if ($contract->recipe || $contract->products->contains('recipe', 1)) {
            return view('contracts.construction.index', compact('contract'));
        }

        alert()->error('خطا', 'هنوز دستور ساختی صادر نشده');

        return back();
    }

    public function update(Request $request, Contract $contract, ContractProduct $product)
    {
        $data = $request->validate([
            'end_at' => 'required|string|max:255',
        ]);

        $this->storeSerial($contract, $product);

        if (!is_null($data['end_at'])) {
            $explodeDate = explode('/', $data['end_at']);
            $data['end_at'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        $product->update([
            'status' => 'end',
            'end_at' => $data['end_at']
        ]);

        alert()->success('ثبت موفق', 'صدور پایان ساخت با موفقیت انجام شد');

        return back();
    }

    /**
     * @param Contract $contract
     * @param ContractProduct $product
     * @return void
     */
    public function storeSerial(Contract $contract, ContractProduct $product): void
    {
        $lastSerialNumber = Serial::where('contract_id', $contract->id)->orderByDesc('id')->first();

        if ($lastSerialNumber) {
            $lastSerialNumberPart = explode('-', $lastSerialNumber->serial_number)[3];
            $startNumber = intval($lastSerialNumberPart) + 1;
        } else {
            $startNumber = 100;
        }

        $serialNumbers = [];
        for ($i = 0; $i < $product->quantity; $i++) {
            $serialNumber = $contract->number . '-' . ($startNumber + $i);
            $serialNumbers[] = $serialNumber;
        }

        foreach ($serialNumbers as $serialNumber) {
            Serial::create([
                'serial_number' => $serialNumber,
                'contract_id' => $contract->id,
                'contract_product_id' => $product->id
            ]);
        }
    }
}
