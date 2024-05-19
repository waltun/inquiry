<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\ContractDocument;
use App\Models\ContractNotification;
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

        $data = $this->uploadFile($contract, $date, $request, $data);

        $contract->contractDocuments()->create($data);

        ContractNotification::create([
            'message' => 'مدرک تایید شده آپلود شد',
            'current_url' => route('documents.index', $contract->id),
            'next_url' => route('loadings.index', $contract->id),
            'next_message' => 'برای آپلود مدارک بارگیری و حمل این قرارداد به لینک ارجاع شده مراجعه کنید',
            'read_at' => null,
            'done_at' => null,
            'contract_id' => $contract->id,
            'user_id' => auth()->user()->id,
        ]);

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
            'file' => 'nullable|file',
            'date' => 'required|string|max:255',
            'name' => 'required|string|max:255',
        ]);

        $date = $data['date'];

        if (!is_null($data['date'])) {
            $explodeDate = explode('-', $data['date']);
            $data['date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        if (isset($data['file']) && !is_null($data['file'])) {
            $file = '../public_html' . $document->file;
            unlink($file);

            $data = $this->uploadFile($contract, $date, $request, $data);
        }

        $document->update($data);

        alert()->success('بروزرسانی موفق', 'مدرک تایید شده با موفقیت بروزرسانی شد');

        return redirect()->route('documents.index', $contract);
    }

    public function destroy(Contract $contract, ContractDocument $document)
    {
        $file = '../public_html' . $document->file;

        if (is_file($file)) {
            unlink($file);
        }

        $document->delete();

        alert()->success('حذف موفق', 'مدرک تایید شده با موفقیت حذف شد');

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
        $path = '../public_html/files/contracts/' . $year . '/' . $folder . '/Factory/Technical-Documents/';
        $savePath = '/files/contracts/' . $year . '/' . $folder . '/Factory/Technical-Documents/';

        $fileNewName = 'CNT-' . $contract->number . '-' . $data['name'] . '-' . $date . '-(' . rand(1, 99) . ')' . '.' . $request->file->extension();
        $request->file->move($path, $fileNewName);

        $finalFile = $savePath . $fileNewName;

        $data['file'] = $finalFile;
        return $data;
    }
}
