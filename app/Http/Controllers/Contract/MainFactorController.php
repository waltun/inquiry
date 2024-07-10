<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Factor;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class MainFactorController extends Controller
{
    public function index(Contract $contract)
    {
        $factors = $contract->factors()->orderBy('date', 'ASC')->paginate(20);

        return view('contracts.main-factors.index', compact('contract', 'factors'));
    }

    public function create(Contract $contract)
    {
        return view('contracts.main-factors.create', compact('contract'));
    }

    public function store(Request $request, Contract $contract)
    {
        $data = $request->validate([
            'date' => 'required|string|max:255',
            'number' => 'required|string|max:255'
        ]);

        $data['user_id'] = auth()->user()->id;

        if (!is_null($data['date'])) {
            $explodeDate = explode('-', $data['date']);
            $data['date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        $contract->factors()->create($data);

        alert()->success('ثبت موفق', 'فاکتور قیمتی با موفقیت ثبت شد');

        return redirect()->route('main-factors.index', $contract->id);
    }

    public function edit(Contract $contract, Factor $main_factor)
    {
        $day = jdate($main_factor->date)->getDay();
        $month = jdate($main_factor->date)->getMonth();
        $year = jdate($main_factor->date)->getYear();
        $date = $year . '-' . $month . '-' . $day;

        return view('contracts.main-factors.edit', compact('contract', 'main_factor', 'date'));
    }

    public function update(Request $request, Contract $contract, Factor $main_factor)
    {
        $data = $request->validate([
            'date' => 'required|string|max:255',
            'number' => 'required|string|max:255'
        ]);

        $data['user_id'] = auth()->user()->id;

        if (!is_null($data['date'])) {
            $explodeDate = explode('-', $data['date']);
            $data['date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        $main_factor->update($data);

        alert()->success('بروزرسانی موفق', 'فاکتور قیمتی با موفقیت بروزرسانی شد');

        return redirect()->route('main-factors.index', $contract->id);
    }

    public function destroy(Contract $contract, Factor $main_factor)
    {
        $main_factor->delete();

        alert()->success('حذف موفق', 'فاکتور قیمتی با موفقیت حذف شد');

        return back();
    }
}
