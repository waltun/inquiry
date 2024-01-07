<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
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
        return view('contracts.packings.create', compact('contract'));
    }

    public function store(Request $request, Contract $contract)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
            'weight' => 'required|numeric',
            'length' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'type' => 'required|string|max:255',
        ]);

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
        return view('contracts.packings.edit', compact('contract', 'packing'));
    }

    public function update(Request $request, Contract $contract, Packing $packing)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
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
}
