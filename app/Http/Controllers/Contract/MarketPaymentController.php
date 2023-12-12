<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Marketing;
use App\Models\MarketPayment;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class MarketPaymentController extends Controller
{
    public function index(Marketing $marketing)
    {
        return view('contracts.marketings.payments.index', compact('marketing'));
    }

    public function create(Marketing $marketing)
    {
        $accounts = $marketing->marketer->accounts;
        return view('contracts.marketings.payments.create', compact('marketing', 'accounts'));
    }

    public function store(Request $request, Marketing $marketing)
    {
        $data = $this->validateData($request);

        $data['contract_id'] = $marketing->contract_id;

        $marketing->payments()->create($data);

        alert()->success('ثبت موفق', 'ثبت بازاریابی با موفقیت انجام شد');

        return redirect()->route('contracts.marketings.payments.index', $marketing->id);
    }

    public function edit(MarketPayment $marketPayment)
    {
        $accounts = $marketPayment->marketing->marketer->accounts;

        if (!is_null($marketPayment->date)) {
            $day = jdate($marketPayment->date)->getDay();
            $month = jdate($marketPayment->date)->getMonth();
            $year = jdate($marketPayment->date)->getYear();
            $date = $year . '-' . $month . '-' . $day;
        } else {
            $date = '';
        }

        return view('contracts.marketings.payments.edit', compact('marketPayment', 'accounts', 'date'));
    }

    public function update(Request $request, MarketPayment $marketPayment)
    {
        $data = $this->validateData($request);

        $marketPayment->update($data);

        alert()->success('بروزرسانی موفق', 'بروزرسانی بازاریابی با موفقیت انجام شد');

        return redirect()->route('contracts.marketings.payments.index', $marketPayment->marketing_id);
    }

    public function destroy(Request $request)
    {
        $marketPayment = MarketPayment::find($request->id);

        $marketPayment->delete();

        alert()->success('حذف موفق', 'پرداخت بازاریابی با موفقیت حذف شد');
    }

    public function confirm(Request $request, Marketing $marketing)
    {
        $request->validate([
            'confirms.*' => 'required|integer',
            'payments.*' => 'required|integer',
            'confirms' => 'array',
            'payments' => 'array',
        ]);

        foreach ($request->payments as $index => $id) {
            $marketPayment = MarketPayment::find($id);
            $marketPayment->confirm = $request->confirms[$index];
            $marketPayment->save();
        }

        alert()->success('ثبت موفق', 'ثبت تاییدیه بازاریابی ها با موفقیت انجام شد');

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
            'marketer_account_id' => 'required|integer',
        ]);

        if (!is_null($data['date'])) {
            $explodeDate = explode('-', $data['date']);
            $data['date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }
        return $data;
    }
}
