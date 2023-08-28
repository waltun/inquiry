<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Contract;
use App\Models\Guarantee;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class GuaranteeController extends Controller
{
    public function index(Contract $contract)
    {
        return view('contracts.guarantees.index', compact('contract'));
    }

    public function create(Contract $contract)
    {
        $accounts = Account::all();
        return view('contracts.guarantees.create', compact('contract', 'accounts'));
    }

    public function store(Request $request, Contract $contract)
    {
        $data = $this->validateData($request);

        $contract->guarantees()->create($data);

        alert()->success('ثبت موفق', 'ثبت تضمین با موفقیت انجام شد');

        return redirect()->route('contracts.guarantees.index', $contract->id);
    }

    public function edit(Guarantee $guarantee)
    {
        $accounts = Account::all();

        $day = jdate($guarantee->date)->getDay();
        $month = jdate($guarantee->date)->getMonth();
        $year = jdate($guarantee->date)->getYear();
        $date = $year . '-' . $month . '-' . $day;

        $returnDay = jdate($guarantee->return_date)->getDay();
        $returnMonth = jdate($guarantee->return_date)->getMonth();
        $returnYear = jdate($guarantee->return_date)->getYear();
        $returnDate = $returnYear . '-' . $returnMonth . '-' . $returnDay;

        return view('contracts.guarantees.edit', compact('guarantee', 'accounts', 'date', 'returnDate'));
    }

    public function update(Request $request, Guarantee $guarantee)
    {
        $data = $this->validateData($request);

        $guarantee->update($data);

        alert()->success('بروزرسانی موفق', 'بروزرسانی تضمین با موفقیت انجام شد');

        return redirect()->route('contracts.guarantees.index', $guarantee->contract_id);
    }

    public function destroy(Guarantee $guarantee)
    {
        //
    }

    public function confirm(Request $request, Contract $contract)
    {
        $request->validate([
            'confirms.*' => 'required|integer',
            'guarantees.*' => 'required|integer',
            'confirms' => 'array',
            'guarantees' => 'array',
        ]);

        foreach ($request->guarantees as $index => $id) {
            $guarantee = Guarantee::find($id);
            $guarantee->confirm = $request->confirms[$index];
            $guarantee->save();
        }

        alert()->success('ثبت موفق', 'ثبت تاییدیه تضامین با موفقیت انجام شد');

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
            'receiver' => 'nullable|string|max:255',
            'return_date' => 'nullable|string|max:255',
            'code' => 'nullable|string|max:255'
        ]);

        if (!is_null($data['date'])) {
            $explodeDate = explode('-', $data['date']);
            $data['date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        if (!is_null($data['return_date'])) {
            $explodeReturnDate = explode('-', $data['return_date']);
            $data['return_date'] = (new Jalalian($explodeReturnDate[0], $explodeReturnDate[1], $explodeReturnDate[2]))->toCarbon()->toDateTimeString();
        }
        return $data;
    }
}
