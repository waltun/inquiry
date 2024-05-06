<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\ContractDocument;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class DocumentController extends Controller
{
    public function index(Contract $contract)
    {
        $documents = $contract->contractDocuments()->latest()->paginate(20);
        return view('contracts.documents.index', compact('documents', 'contract'));
    }

    public function create(Contract $contract)
    {
        return view('contracts.documents.create', compact('contract'));
    }

    public function store(Request $request, Contract $contract)
    {
        $data = $request->validate([
            'file' => 'required',
            'date' => 'required|string|max:255',
            'name' => 'required|string|max:255',
        ]);

        $date = $data['date'];

        if (!is_null($data['date'])) {
            $explodeDate = explode('-', $data['date']);
            $data['date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        $year = jdate($contract->created_at)->getYear();
        $folder = 'CNT-' . $contract->number;
        $path = '/files/contracts/' . $year . '/' . $folder . '/Factory/Technical-Documents/';

        $fileNewName = 'CNT-' . $contract->number . '-' . $data['name'] . '-' . $date . '-(' . rand(1, 99) . ')' . '.' . $request->file->extension();
        $request->file->move(public_path($path), $fileNewName);

        $finalFile = $path . $fileNewName;

        $data['file'] = $finalFile;

        $contract->contractDocuments()->create($data);

        alert()->success('ثبت موفق', 'مدرک تایید شده با موفقیت ثبت شد شد');

        return redirect()->route('documents.index', $contract);
    }

    public function edit(Contract $contract, ContractDocument $document)
    {
        $day = jdate($document->date)->getDay();
        $month = jdate($document->date)->getMonth();
        $year = jdate($document->date)->getYear();
        $date = $year . '-' . $month . '-' . $day;

        return view('contracts.documents.edit', compact('contract', 'document', 'date'));
    }

    public function update(Request $request, Contract $contract, ContractDocument $document)
    {
        $data = $request->validate([
            'file' => 'required',
            'date' => 'required|string|max:255',
            'name' => 'required|string|max:255',
        ]);

        if (!is_null($data['date'])) {
            $explodeDate = explode('-', $data['date']);
            $data['date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        $document->update($data);

        alert()->success('بروزرسانی موفق', 'مدرک تایید شده با موفقیت بروزرسانی شد');

        return redirect()->route('documents.index', $contract);
    }

    public function destroy(Contract $contract, ContractDocument $document)
    {
        $document->delete();

        alert()->success('حذف موفق', 'مدرک تایید شده با موفقیت حذف شد');

        return back();
    }
}
