<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class RecoupmentController extends Controller
{
    public function index(Contract $contract)
    {
        $recoupments = $contract->contractRecoupments()->latest()->paginate(20);
        return view('contracts.recoupment.index', compact('contract', 'recoupments'));
    }

    public function create(Contract $contract)
    {
        return view('contracts.recoupment.create', compact('contract'));
    }

    public function store(Request $request, Contract $contract)
    {
        $data = $request->validate([
            'file' => 'required|file|max:255',
            'number' => 'nullable|string|max:255',
            'date' => 'required|string|max:255'
        ]);

        $date = $data['date'];

        if (!is_null($data['date'])) {
            $explodeDate = explode('-', $data['date']);
            $data['date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        $year = jdate($contract->created_at)->getYear();
        $folder = 'CNT-' . $contract->number;
        $path = '../public_html/files/contracts/' . $year . '/' . $folder . '/Financial/Recoupment/';
        $savePath = '/files/contracts/' . $year . '/' . $folder . '/Financial/Recoupment/';

        $fileNewName = 'CNT-' . $contract->number . '-Recoupment-' . $date . '-(' . rand(1, 99) . ')' . '.' . $request->file->extension();
        $request->file->move($path, $fileNewName);

        $finalFile = $savePath . $fileNewName;

        $data['file'] = $finalFile;

        $contract->contractRecoupments()->create($data);

        alert()->success('ثبت موفق', 'مفاصا حساب با موفقیت بارگذاری شد');

        return redirect()->route('recoupments.index', $contract->id);
    }
}
