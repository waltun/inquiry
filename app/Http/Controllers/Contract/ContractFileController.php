<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\ContractContract;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class ContractFileController extends Controller
{
    public function index(Contract $contract)
    {
        $files = $contract->contractContracts()->latest()->paginate(20);
        return view('contracts.contract.index', compact('contract', 'files'));
    }

    public function create(Contract $contract)
    {
        return view('contracts.contract.create', compact('contract'));
    }

    public function store(Request $request, Contract $contract)
    {
        $data = $request->validate([
            'file' => 'required|file',
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
        $path = '../public_html/files/contracts/' . $year . '/' . $folder . '/Financial/Contract(PO)/';
        $savePath = '/files/contracts/' . $year . '/' . $folder . '/Financial/Contract(PO)/';

        $fileNewName = 'CNT-' . $contract->number . '-Contract-' . $date . '-(' . rand(1, 99) . ')' . '.' . $request->file->extension();
        $request->file->move($path, $fileNewName);

        $finalFile = $savePath . $fileNewName;

        $data['file'] = $finalFile;

        $contract->contractContracts()->create($data);

        alert()->success('ثبت موفق', 'فایل قرارداد با موفقیت بارگذاری شد');

        return redirect()->route('contract-files.index', $contract->id);
    }
}
