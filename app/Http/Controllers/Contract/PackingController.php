<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\ContractNotification;
use App\Models\ContractProduct;
use App\Models\Group;
use App\Models\Modell;
use App\Models\Packing;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class PackingController extends Controller
{
    public function index(Contract $contract)
    {
        $packings = $contract->packings()->paginate(20);
        return view('contracts.packings.index', compact('packings', 'contract'));
    }

    public function store(Request $request, Contract $contract)
    {
        $data = $request->validate([
            'date' => 'required|string|max:255',
            'name' => 'required|string|max:255'
        ]);

        if (!is_null($data['date'])) {
            $explodeDate = explode('/', $data['date']);
            $data['date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        $contract->packings()->create($data);

        ContractNotification::create([
            'message' => 'پکینگ لیست جدید برای این قرارداد ساخته شد',
            'current_url' => route('packings.index', $contract->id),
            'next_url' => route('contracts.exits.index', $contract->id),
            'next_message' => 'برای صدور مجوز خروج های این قرارداد به لینک ارجاع شده مراجعه کنید',
            'read_at' => null,
            'done_at' => null,
            'contract_id' => $contract->id,
            'user_id' => auth()->user()->id,
        ]);

        alert()->success('ثبت موفق', 'پکینگ جدید با موفقیت ثبت شد');

        return back();
    }

    public function show(Contract $contract, Packing $packing)
    {
        return view('contracts.packings.print', compact('contract', 'packing'));
    }

    public function update(Request $request, Contract $contract, Packing $packing)
    {
        $data = $request->validate([
            'date' => 'required|string|max:255',
            'name' => 'required|string|max:255'
        ]);

        if (!is_null($data['date'])) {
            $explodeDate = explode('/', $data['date']);
            $data['date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        alert()->success('بروزرسانی موفق', 'پکینگ با موفقیت بروزرسانی شد');

        $packing->update($data);

        return back();
    }

    public function destroy(Contract $contract, Packing $packing)
    {
        $packing->delete();

        alert()->success('حذف موفق', 'پکینگ با موفقیت حذف شد');

        return back();
    }

    public function print(Contract $contract)
    {
        return view('contracts.packings.print-all', compact('contract'));
    }
}
