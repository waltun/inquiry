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

        $data = $this->uploadFile($contract, $date, $request, $data);

        $contract->contractPictures()->create($data);

        alert()->success('ثبت موفق', 'تصویر ساخت با موفقیت بارگذاری شد');

        return redirect()->route('pictures.index', $contract->id);
    }

    public function edit(Contract $contract, ContractPicture $picture)
    {
        $day = jdate($picture->date)->getDay();
        $month = jdate($picture->date)->getMonth();
        $year = jdate($picture->date)->getYear();
        $date = $year . '-' . $month . '-' . $day;

        return view('contracts.pictures.edit', compact('contract', 'picture', 'date'));
    }

    public function update(Request $request, Contract $contract, ContractPicture $picture)
    {
        $data = $request->validate([
            'file' => 'nullable|file',
            'title' => 'nullable|string|max:255',
            'date' => 'required|string|max:255',
        ]);

        $date = $data['date'];

        if (!is_null($data['date'])) {
            $explodeDate = explode('-', $data['date']);
            $data['date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        if (isset($data['file']) && !is_null($data['file'])) {
            $file = '../public_html' . $picture->file;
            unlink($file);

            $data = $this->uploadFile($contract, $date, $request, $data);
        }

        $picture->update($data);

        alert()->success('بروزرسانی موفق', 'تصویر ساخت با موفقیت بروزرسانی شد');

        return redirect()->route('pictures.index', $contract->id);
    }

    public function destroy(Contract $contract, ContractPicture $picture)
    {
        $file = '../public_html' . $picture->file;

        if (is_file($file)) {
            unlink($file);
        }

        $picture->delete();

        alert()->success('حذف موفق', 'تصویر ساخت با موفقیت حذف شد');

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
        $path = '../public_html/files/contracts/' . $year . '/' . $folder . '/Factory/Images/';
        $savePath = '/files/contracts/' . $year . '/' . $folder . '/Factory/Images/';

        $fileNewName = 'CNT-' . $contract->number . '-Image-' . $date . '-(' . rand(1, 99) . ')' . '.' . $request->file->extension();
        $request->file->move($path, $fileNewName);

        $finalFile = $savePath . $fileNewName;

        $data['file'] = $finalFile;
        return $data;
    }
}
