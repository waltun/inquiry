<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\ContractContract;
use App\Models\ContractNotification;
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

        $data = $this->uploadFile($contract, $date, $request, $data);

        $contract->contractContracts()->create($data);

        ContractNotification::create([
            'message' => 'فایل قرارداد با موفقیت بارگذاری شد',
            'current_url' => route('contract-files.index', $contract->id),
            'next_url' => route('contracts.products', $contract->id),
            'next_message' => 'برای مشاهده، اضافه یا حذف محصولات و صدور مقادیر محصولات به لینک ارجاع شده مراجعه کنید',
            'read_at' => null,
            'done_at' => null,
            'contract_id' => $contract->id,
            'user_id' => auth()->user()->id,
        ]);

        alert()->success('ثبت موفق', 'فایل قرارداد با موفقیت بارگذاری شد');

        return redirect()->route('contract-files.index', $contract->id);
    }

    public function edit(Contract $contract, ContractContract $contract_file)
    {
        $day = jdate($contract_file->date)->getDay();
        $month = jdate($contract_file->date)->getMonth();
        $year = jdate($contract_file->date)->getYear();
        $date = $year . '-' . $month . '-' . $day;

        return view('contracts.contract.edit', compact('contract', 'contract_file', 'date'));
    }

    public function update(Request $request, Contract $contract, ContractContract $contract_file)
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
            $file = '../public_html' . $contract_file->file;
            unlink($file);

            $data = $this->uploadFile($contract, $date, $request, $data);
        }

        $contract_file->update($data);

        alert()->success('بروزرسانی موفق', 'فایل قرارداد با موفقیت بروزرسانی شد');

        return redirect()->route('contract-files.index', $contract->id);
    }

    public function destroy(Contract $contract, ContractContract $contract_file)
    {
        $file = '../public_html' . $contract_file->file;
        unlink($file);

        $contract_file->delete();

        alert()->success('حذف موفق', 'فایل قرارداد با موفقیت حذف شد');

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
        $path = '../public_html/files/contracts/' . $year . '/' . $folder . '/Financial/Contract(PO)/';
        $savePath = '/files/contracts/' . $year . '/' . $folder . '/Financial/Contract(PO)/';

        $fileNewName = 'CNT-' . $contract->number . '-Contract-' . $date . '-(' . rand(1, 99) . ')' . '.' . $request->file->extension();
        $request->file->move($path, $fileNewName);

        $finalFile = $savePath . $fileNewName;

        $data['file'] = $finalFile;
        return $data;
    }
}
