<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\ContractRecoupment;
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

        $data = $this->uploadFile($contract, $date, $request, $data);

        $contract->contractRecoupments()->create($data);

        alert()->success('ثبت موفق', 'مفاصا حساب با موفقیت بارگذاری شد');

        return redirect()->route('recoupments.index', $contract->id);
    }

    public function edit(Contract $contract, ContractRecoupment $recoupment)
    {
        $day = jdate($recoupment->date)->getDay();
        $month = jdate($recoupment->date)->getMonth();
        $year = jdate($recoupment->date)->getYear();
        $date = $year . '-' . $month . '-' . $day;

        return view('contracts.recoupment.edit', compact('contract', 'recoupment', 'date'));
    }

    public function update(Request $request, Contract $contract, ContractRecoupment $recoupment)
    {
        $data = $request->validate([
            'file' => 'nullable|file',
            'number' => 'nullable|string|max:255',
            'date' => 'required|string|max:255'
        ]);

        $date = $data['date'];

        if (!is_null($data['date'])) {
            $explodeDate = explode('-', $data['date']);
            $data['date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        if (isset($data['file']) && !is_null($data['file'])) {
            $file = '../public_html' . $recoupment->file;
            unlink($file);

            $data = $this->uploadFile($contract, $date, $request, $data);
        }

        $recoupment->update($data);

        alert()->success('بروزرسانی موفق', 'مفاصا حساب با موفقیت بروزرسانی شد');

        return redirect()->route('recoupments.index', $contract->id);
    }

    public function destroy(Contract $contract, ContractRecoupment $recoupment)
    {
        $file = '../public_html' . $recoupment->file;
        unlink($file);

        $recoupment->delete();

        alert()->success('حذف موفق', 'مفاصا حساب با موفقیت حذف شد');

        return back();
    }

    /**
     * @param Contract $contract
     * @param mixed $date
     * @param Request $request
     * @param array $data
     * @return array
     */
    public function uploadFile(Contract $contract, mixed $date, Request $request, array $data): array
    {
        $year = jdate($contract->created_at)->getYear();
        $folder = 'CNT-' . $contract->number;
        $path = '../public_html/files/contracts/' . $year . '/' . $folder . '/Financial/Recoupment/';
        $savePath = '/files/contracts/' . $year . '/' . $folder . '/Financial/Recoupment/';

        $fileNewName = 'CNT-' . $contract->number . '-Recoupment-' . $date . '-(' . rand(1, 99) . ')' . '.' . $request->file->extension();
        $request->file->move($path, $fileNewName);

        $finalFile = $savePath . $fileNewName;

        $data['file'] = $finalFile;
        return $data;
    }
}
