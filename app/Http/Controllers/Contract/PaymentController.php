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
        $data = $this->validateData($request);

        $contract->payments()->create($data);

        alert()->success('ثبت موفق', 'ثبت پرداخت با موفقیت انجام شد');

        return redirect()->route('contracts.payments.index', $contract->id);
    }

    public function edit(Payment $payment)
    {
        $accounts = Account::all();

        $day = jdate($payment->date)->getDay();
        $month = jdate($payment->date)->getMonth();
        $year = jdate($payment->date)->getYear();
        $date = $year . '-' . $month . '-' . $day;

        return view('contracts.payments.edit', compact('payment', 'accounts', 'date'));
    }

    public function update(Request $request, Payment $payment)
    {
        $data = $this->validateData($request);

        $payment->update($data);

        alert()->success('بروزرسانی موفق', 'بروزرسانی پرداخت با موفقیت انجام شد');

        return redirect()->route('contracts.payments.index', $payment->contract_id);
    }

    public function destroy(Request $request)
    {
        $payment = Payment::find($request->id);

        $payment->delete();

        alert()->success('حذف موفق', 'حذف پرداخت با موفقیت انجام شد');
    }

    public function confirm(Request $request, Contract $contract)
    {
        $request->validate([
            'confirms.*' => 'required|integer',
            'payments.*' => 'required|integer',
            'confirms' => 'array',
            'payments' => 'array',
        ]);

        foreach ($request->payments as $index => $id) {
            $payment = Payment::find($id);
            $payment->confirm = $request->confirms[$index];
            $payment->save();
        }

        alert()->success('ثبت موفق', 'ثبت تاییدیه پرداخت ها با موفقیت انجام شد');

        return back();
    }

    /**
     * @param Request $request
     * @return array
     */
    public function validateData(Request $request): array
    {
        $data = $request->validate([
            'price' => 'required|numeric',
            'date' => 'nullable|string|max:255',
            'text' => 'nullable|string|max:255',
            'type' => 'required|string|max:255',
            'account_id' => 'nullable|integer',
            'cash_type' => 'required|string|max:255'
        ]);

        if (!is_null($data['date'])) {
            $explodeDate = explode('-', $data['date']);
            $data['date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }
        return $data;
    }
}
