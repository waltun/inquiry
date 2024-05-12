<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\ContractPicture;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class PictureController extends Controller
{
    public function index(Contract $contract)
    {
        $pictures = $contract->contractPictures()->latest()->paginate(20);
        return view('contracts.pictures.index', compact('pictures', 'contract'));
    }

    public function create(Contract $contract)
    {
        return view('contracts.pictures.create', compact('contract'));
    }

    public function store(Request $request, Contract $contract)
    {
        $data = $request->validate([
            'file' => 'required|file',
            'title' => 'nullable|string|max:255',
            'date' => 'required|string|max:255',
        ]);

        $date = $data['date'];

        if (!is_null($data['date'])) {
            $explodeDate = explode('-', $data['date']);
            $data['date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        $year = jdate($contract->created_at)->getYear();
        $folder = 'CNT-' . $contract->number;
        $path = '../public_html/files/contracts/' . $year . '/' . $folder . '/Factory/Images/';
        $savePath = '/files/contracts/' . $year . '/' . $folder . '/Factory/Images/';

        $fileNewName = 'CNT-' . $contract->number . '-Image-' . $date . '-(' . rand(1, 99) . ')' . '.' . $request->file->extension();
        $request->file->move($path, $fileNewName);

        $finalFile = $savePath . $fileNewName;

        $data['file'] = $finalFile;

        $contract->contractPictures()->create($data);

        alert()->success('ثبت موفق', 'تصویر ساخت با موفقیت بارگذاری شد');

        return redirect()->route('pictures.index', $contract->id);
    }

    public function edit(ContractPicture $contractPicture)
    {
        //
    }

    public function update(Request $request, ContractPicture $contractPicture)
    {
        //
    }

    public function destroy(ContractPicture $contractPicture)
    {
        //
    }
}
