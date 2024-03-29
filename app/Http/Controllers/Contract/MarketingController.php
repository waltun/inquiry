<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Contract;
use App\Models\Marketer;
use App\Models\Marketing;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class MarketingController extends Controller
{
    public function index(Contract $contract)
    {
        return view('contracts.marketings.index', compact('contract'));
    }

    public function create(Contract $contract)
    {
        $marketers = Marketer::all();
        $accounts = Account::all();
        return view('contracts.marketings.create', compact('contract', 'marketers', 'accounts'));
    }

    public function store(Request $request, Contract $contract)
    {
        $data = $this->validateData($request);

        $data['user_id'] = auth()->user()->id;

        $contract->marketings()->create($data);

        alert()->success('ثبت موفق', 'ثبت بازاریابی با موفقیت انجام شد');

        return redirect()->route('contracts.marketings.index', $contract->id);
    }

    public function edit(Marketing $marketing)
    {
        $accounts = Account::all();
        $marketers = Marketer::all();

        $day = jdate($marketing->date)->getDay();
        $month = jdate($marketing->date)->getMonth();
        $year = jdate($marketing->date)->getYear();
        $date = $year . '-' . $month . '-' . $day;

        return view('contracts.marketings.edit', compact('marketing', 'marketers', 'accounts', 'date'));
    }

    public function update(Request $request, Marketing $marketing)
    {
        $data = $this->validateData($request);

        $marketing->update($data);

        alert()->success('بروزرسانی موفق', 'بروزرسانی بازاریابی با موفقیت انجام شد');

        return redirect()->route('contracts.marketings.index', $marketing->contract_id);
    }

    public function destroy(Request $request)
    {
        $marketing = Marketing::find($request->id);

        if (!$marketing->payments->isEmpty()) {
            foreach ($marketing->payments as $payment) {
                $payment->delete();
            }
        }

        $marketing->delete();

        alert()->success('حذف موفق', 'حذف بازاریابی با موفقیت انجام شد');
    }

    public function confirm(Request $request, Contract $contract)
    {
        $request->validate([
            'confirms.*' => 'required|integer',
            'marketings.*' => 'required|integer',
            'confirms' => 'array',
            'marketings' => 'array',
        ]);

        foreach ($request->marketings as $index => $id) {
            $marketing = Marketing::find($id);
            $marketing->confirm = $request->confirms[$index];
            $marketing->save();
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
        return $request->validate([
            'price' => 'required|numeric',
            'text' => 'nullable|string|max:255',
            'marketer_id' => 'required|integer',
        ]);
    }
}
