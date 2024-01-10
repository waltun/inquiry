<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\ContractProduct;
use App\Models\Group;
use App\Models\Modell;
use App\Models\Packing;
use Illuminate\Http\Request;

class PackingController extends Controller
{
    public function index(Contract $contract)
    {
        $packings = $contract->packings()->latest()->paginate(20);
        return view('contracts.packings.index', compact('packings', 'contract'));
    }

    public function create(Contract $contract)
    {
        $groups = Group::all();
        $names = $groups->flatMap(function ($group) {
            return $group->modells()->where('parent_id', 0)->pluck('name');
        });

        return view('contracts.packings.create', compact('contract', 'names'));
    }

    public function store(Request $request, Contract $contract)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'weight' => 'required|numeric',
            'length' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'type' => 'required|string|max:255',
            'code' => 'nullable'
        ]);

        $finalCode = $this->getFinalCode($contract);

        $data['code'] = $finalCode;

        $contract->packings()->create($data);

        alert()->success('ثبت موفق', 'پکینگ جدید با موفقیت ثبت شد');

        return redirect()->route('packings.index', $contract->id);
    }

    public function show(Contract $contract, Packing $packing)
    {
        return view('contracts.packings.show', compact('contract', 'packing'));
    }

    public function edit(Contract $contract, Packing $packing)
    {
        $groups = Group::all();
        $names = $groups->flatMap(function ($group) {
            return $group->modells()->where('parent_id', 0)->pluck('name');
        });

        return view('contracts.packings.edit', compact('contract', 'packing', 'names'));
    }

    public function update(Request $request, Contract $contract, Packing $packing)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'weight' => 'required|numeric',
            'length' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'type' => 'required|string|max:255',
        ]);

        alert()->success('بروزرسانی موفق', 'پکینگ با موفقیت بروزرسانی شد');

        $packing->update($data);

        return redirect()->route('packings.index', $contract->id);
    }

    public function destroy(Contract $contract, Packing $packing)
    {
        foreach ($packing->products as $product) {
            $product->packing_id = null;
            $product->save();
        }

        $packing->delete();

        alert()->success('حذف موفق', 'پکینگ با موفقیت حذف شد');

        return back();
    }

    public function print(Contract $contract)
    {
        return view('contracts.packings.print', compact('contract'));
    }

    public function choose(Contract $contract, Packing $packing)
    {
        return view('contracts.packings.choose', compact('contract', 'packing'));
    }

    public function storeChoose(Request $request, Contract $contract, Packing $packing)
    {
        $request->validate([
            'product_id' => 'required|integer'
        ]);

        $product = ContractProduct::find($request->product_id);

        $product->packing_id = $packing->id;
        $product->save();

        alert()->success('ثبت موفق', 'محصول با موفقیت به پکینگ اضافه شد');

        return back();
    }

    public function deleteProduct(Request $request, Contract $contract, Packing $packing)
    {
        $request->validate([
            'product_id' => 'required|integer'
        ]);

        $product = ContractProduct::find($request->product_id);

        $product->packing_id = null;
        $product->save();

        alert()->success('حذف موفق', 'محصول با موفقیت از پکینگ حذف شد');

        return back();
    }

    /**
     * @param Contract $contract
     * @return string
     */
    public function getFinalCode(Contract $contract): string
    {
        $lastContractCode = explode('-', $contract->number)[2];
        $currentYear = jdate(now())->getYear();
        $lastPackingCode = $contract->packings()->max('code');

        if (is_null($lastPackingCode)) {
            $lastPackingCode = '01';
        } else {
            $explodeLastPackingCode = explode('-', $lastPackingCode)[2];
            $lastPackingCode = str_pad($explodeLastPackingCode + 1, 2, "0", STR_PAD_LEFT);
        }

        return $currentYear . "-" . $lastContractCode . "-" . $lastPackingCode;
    }
}
