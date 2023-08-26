<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Contract;
use App\Models\Payment;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class PaymentController extends Controller
{
    public function index(Contract $contract)
    {
        return view('contracts.payments.index', compact('contract'));
    }

    public function create(Contract $contract)
    {
        $accounts = Account::all();
        return view('contracts.payments.create', compact('contract', 'accounts'));
    }

    public function store(Request $request, Contract $contract)
    {
        $data = $request->validate([
            'price' => 'required|numeric',
            'date' => 'nullable|string|max:255',
            'text' => 'nullable|string|max:255',
            'type' => 'required|string|max:255',
            'account_id' => 'nullable|integer'
        ]);

        if (!is_null($data['date'])) {
            $explodeDate = explode('-', $data['date']);
            $data['date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        $contract->payments()->create($data);

        alert()->success('ثبت موفق', 'ثبت واریزی با موفقیت انجام شد');

        return redirect()->route('contracts.payments.index', $contract->id);
    }

    public function edit(Payment $payment)
    {
        //
    }

    public function update(Request $request, Payment $payment)
    {
        //
    }

    public function destroy(Payment $payment)
    {
        //
    }
}
