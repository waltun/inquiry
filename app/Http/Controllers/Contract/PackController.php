<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Group;
use App\Models\Pack;
use App\Models\Packing;
use Illuminate\Http\Request;

class PackController extends Controller
{
    public function index(Contract $contract, Packing $packing)
    {
        $packs = $packing->packs()->paginate(20);
        return view('contracts.packings.packs.index', compact('contract', 'packing', 'packs'));
    }

    public function create(Contract $contract, Packing $packing)
    {
        $groups = Group::all();
        $names = $groups->flatMap(function ($group) {
            return $group->modells()->where('parent_id', 0)->pluck('name');
        });

        return view('contracts.packings.packs.create', compact('contract', 'names', 'packing'));
    }

    public function store(Request $request, Contract $contract, Packing $packing)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'weight' => 'nullable|numeric',
            'length' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'type' => 'required|string|max:255',
            'code' => 'nullable'
        ]);

        $finalCode = $this->getFinalCode($contract, $packing);

        $data['code'] = $finalCode;

        $packing->packs()->create($data);

        alert()->success('ثبت موفق', 'پک جدید با موفقیت ثبت شد');

        return redirect()->route('packs.index', [$contract->id, $packing->id]);
    }

    public function edit(Contract $contract, Packing $packing, Pack $pack)
    {
        $groups = Group::all();
        $names = $groups->flatMap(function ($group) {
            return $group->modells()->where('parent_id', 0)->pluck('name');
        });

        return view('contracts.packings.packs.edit', compact('contract', 'packing', 'names', 'pack'));
    }

    public function update(Request $request, Contract $contract, Packing $packing, Pack $pack)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'weight' => 'required|numeric',
            'length' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'type' => 'required|string|max:255',
            'packing_id' => 'required|integer|exists:packings,id'
        ]);

        alert()->success('بروزرسانی موفق', 'پکینگ با موفقیت بروزرسانی شد');

        $pack->update($data);

        return redirect()->route('packs.index', [$contract->id, $packing->id]);
    }

    public function destroy(Contract $contract, Packing $packing, Pack $pack)
    {
//        foreach ($packing->products as $product) {
//            $product->packing_id = null;
//            $product->save();
//        }

        $pack->delete();

        alert()->success('حذف موفق', 'پک با موفقیت حذف شد');

        return back();
    }

    public function marking(Contract $contract, Packing $packing, Pack $pack)
    {
        return view('contracts.packings.packs.marking', compact('contract', 'packing', 'pack'));
    }

    /**
     * @param Contract $contract
     * @param Packing $packing
     * @return string
     */
    public function getFinalCode(Contract $contract, Packing $packing): string
    {
        $lastContractCode = explode('-', $contract->number)[2];
        $currentYear = jdate(now())->getYear();

        $lastPackingCode = Pack::whereHas('packing', function ($query) use ($contract) {
            $query->where('contract_id', $contract->id);
        })->max('code');

        if (is_null($lastPackingCode)) {
            $lastPackingCode = '01';
        } else {
            $explodeLastPackingCode = explode('-', $lastPackingCode)[2];
            $lastPackingCode = str_pad($explodeLastPackingCode + 1, 2, "0", STR_PAD_LEFT);
        }

        return $currentYear . "-" . $lastContractCode . "-" . $lastPackingCode;
    }
}
