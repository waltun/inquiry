<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\ContractNotification;
use App\Models\Packing;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class ExitController extends Controller
{
    public function index(Contract $contract)
    {
        $packings = $contract->packings()->paginate(20);
        return view('contracts.exits.index', compact('contract', 'packings'));
    }

    public function update(Request $request, Contract $contract, Packing $packing)
    {
        $data = $request->validate([
            'exit_at' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'receiver' => 'required'
        ]);

        if (!is_null($data['exit_at'])) {
            $explodeDate = explode('/', $data['exit_at']);
            $data['exit_at'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        $packing->update($data);

        if (!$contract->packings->contains('exit_at', null)) {
            ContractNotification::create([
                'message' => 'تمامی مجوز خروج های محصولات و قطعات این قرارداد صادر شد',
                'current_url' => route('contracts.exits.index', $contract->id),
                'next_url' => route('documents.index', $contract->id),
                'next_message' => 'برای آپلود مدارک تایید شده این قرارداد به لینک ارجاع شده مراجعه کنید',
                'read_at' => null,
                'done_at' => null,
                'contract_id' => $contract->id,
                'user_id' => auth()->user()->id,
            ]);
        }

        alert()->success('صدور موفق', 'مجوز خروج با موفقیت صادر شد');

        return back();
    }

    public function print(Contract $contract, Packing $packing)
    {
        return view('contracts.exits.print', compact('contract', 'packing'));
    }
}
