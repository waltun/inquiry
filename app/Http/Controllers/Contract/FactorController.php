<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\ContractFactor;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class FactorController extends Controller
{
    public function index(Contract $contract)
    {
        $factors = $contract->contractFactors()->latest()->paginate(20);
        return view('contracts.factors.index', compact('factors', 'contract'));
    }

    public function create(Contract $contract)
    {
        return view('contracts.factors.create', compact('contract'));
    }

    public function store(Request $request, Contract $contract)
    {
        $data = $request->validate([
            'price' => 'required|numeric',
            'tax_price' => 'required|numeric',
            'file' => 'required',
            'number' => 'nullable|numeric',
            'date' => 'nullable|string|max:255',
        ]);

        $date = $data['date'];

        if (!is_null($data['date'])) {
            $explodeDate = explode('-', $data['date']);
            $data['date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        $data = $this->uploadFile($contract, $date, $request, $data);

        $contract->contractFactors()->create($data);

        alert()->success('ثبت موفق', 'فاکتور رسمی با موفقیت ثبت شد شد');

        return redirect()->route('factors.index', $contract);
    }

    public function edit(Contract $contract, ContractFactor $factor)
    {
        $day = jdate($factor->date)->getDay();
        $month = jdate($factor->date)->getMonth();
        $year = jdate($factor->date)->getYear();
        $date = $year . '-' . $month . '-' . $day;

        return view('contracts.factors.edit', compact('factor', 'contract', 'date'));
    }

    public function update(Request $request, Contract $contract, ContractFactor $factor)
    {
        $data = $request->validate([
            'price' => 'required|numeric',
            'tax_price' => 'required|numeric',
            'file' => 'nullable|file',
            'number' => 'nullable|numeric',
            'date' => 'nullable|string|max:255',
        ]);

        $date = $data['date'];

        if (!is_null($data['date'])) {
            $explodeDate = explode('-', $data['date']);
            $data['date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        if (isset($data['file']) && !is_null($data['file'])) {
            $file = '../public_html' . $factor->file;
            unlink($file);

            $data = $this->uploadFile($contract, $date, $request, $data);
        }

        $factor->update($data);

        alert()->success('بروزرسانی موفق', 'فاکتور رسمی با موفقیت بروزرسانی شد شد');

        return redirect()->route('factors.index', $contract);
    }

    public function destroy(Contract $contract, ContractFactor $factor)
    {
        $file = '../public_html' . $factor->file;

        if (is_file($file)) {
            unlink($file);
        }

        $factor->delete();

        alert()->success('حذف موفق', 'فاکتور رسمی با موفقیت حذف شد شد');

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
        $path = '../public_html/files/contracts/' . $year . '/' . $folder . '/Financial/Invoice/';
        $savePath = '/files/contracts/' . $year . '/' . $folder . '/Financial/Invoice/';

        $fileNewName = 'CNT-' . $contract->number . '-Invoice-' . $date . '-(' . rand(1, 99) . ')' . '.' . $request->file->extension();
        $request->file->move($path, $fileNewName);

        $finalFile = $savePath . $fileNewName;

        $data['file'] = $finalFile;
        return $data;
    }
}
