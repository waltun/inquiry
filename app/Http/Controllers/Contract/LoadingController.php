<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\ContractLoading;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class LoadingController extends Controller
{
    public function index(Contract $contract)
    {
        $loadings = $contract->contractLoadings()->latest()->paginate(20);
        return view('contracts.loadings.index', compact('loadings', 'contract'));
    }

    public function create(Contract $contract)
    {
        return view('contracts.loadings.create', compact('contract'));
    }

    public function store(Request $request, Contract $contract)
    {
        $data = $request->validate([
            'file' => 'required|file',
            'number' => 'nullable|string|max:255',
            'date' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        $date = $data['date'];

        if (!is_null($data['date'])) {
            $explodeDate = explode('-', $data['date']);
            $data['date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        $year = jdate($contract->created_at)->getYear();
        $folder = 'CNT-' . $contract->number;
        $path = '../public_html/files/contracts/' . $year . '/' . $folder . '/Factory/Shipping-Documents/';
        $savePath = '/files/contracts/' . $year . '/' . $folder . '/Factory/Shipping-Documents/';

        $fileNewName = 'CNT-' . $contract->number . '-Shipping-' . $date . '-(' . rand(1, 99) . ')' . '.' . $request->file->extension();
        $request->file->move($path, $fileNewName);

        $finalFile = $savePath . $fileNewName;

        $data['file'] = $finalFile;

        $contract->contractLoadings()->create($data);

        alert()->success('ثبت موفق', 'فایل بارگیری با موفقیت بارگذاری شد');

        return redirect()->route('loadings.index', $contract->id);
    }

    public function edit(ContractLoading $contractLoading)
    {
        //
    }

    public function update(Request $request, ContractLoading $contractLoading)
    {
        //
    }

    public function destroy(ContractLoading $contractLoading)
    {
        //
    }
}
