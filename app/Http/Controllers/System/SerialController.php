<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\Serial;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class SerialController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:serials')->only(['index']);
        $this->middleware('can:create-serial')->only(['create', 'store']);
        $this->middleware('can:edit-serial')->only(['edit', 'update']);
        $this->middleware('can:copy-serial')->only(['replicate']);
        $this->middleware('can:delete-serial')->only(['destroy']);
    }

    public function index()
    {
        $serials = Serial::latest()->paginate(20);
        return view('systems.serials.index', compact('serials'));
    }

    public function create()
    {
        $date = Jalalian::now();
        $today = $date->getYear() . "-" . $date->getMonth() . "-" . $date->getDay();

        $serialNumber = $this->getSerialNumber();

        return view('systems.serials.create', compact('today', 'serialNumber'));
    }

    public function store(Request $request)
    {
        $data = $this->getValidate($request);

        if (!is_null($data['send_date'])) {
            $explodeDate = explode('-', $data['send_date']);
            $data['send_date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        Serial::create($data);

        alert()->success('ثبت موفق', 'شماره سریال جدید با موفقیت ثبت شد');

        return redirect()->route('serials.index');
    }

    public function edit(Serial $serial)
    {
        $year = jdate($serial->send_date)->getYear();
        $month = jdate($serial->send_date)->getMonth();
        $day = jdate($serial->send_date)->getDay();
        $date = $year . "-" . $month . "-" . $day;
        return view('systems.serials.edit', compact('serial', 'date'));
    }

    public function update(Request $request, Serial $serial)
    {
        $data = $this->getValidate($request);

        if (!is_null($data['send_date'])) {
            $explodeDate = explode('-', $data['send_date']);
            $data['send_date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        $serial->update($data);

        alert()->success('بروزرسانی موفق', 'شماره سریال با موفقیت بروزرسانی شد');

        return redirect()->route('serials.index');
    }

    public function destroy(Serial $serial)
    {
        $serial->delete();

        alert()->success('حذف موفق', 'شماره سریال با موفقیت حذف شد');

        return back();
    }

    public function replicate(Serial $serial)
    {
        $serialNumber = $this->getSerialNumber();

        $newSerial = $serial->replicate()->fill([
            'serial' => $serialNumber
        ]);
        $newSerial->save();

        alert()->success('کپی موفق', 'شماره سریال با موفقیت کپی شد');

        return back();
    }

    public function getValidate(Request $request)
    {
        return $request->validate([
            'buyer' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|numeric',
            'serial' => 'required|numeric',
            'number' => 'required|string|max:255',
            'type' => 'required|in:official,operational',
            'send_date' => 'nullable|string|max:255'
        ]);
    }

    public function getSerialNumber()
    {
        $serials = Serial::select(['serial'])->get();
        $number = 0;
        foreach ($serials as $serial) {
            if ((int)$serial->serial > $number) {
                $number = (int)$serial->serial;
            }
        }

        $year = jdate(now())->getYear();
        $first4 = substr((string)$number, 0, 4);

        if (!$serials->isEmpty()) {
            if ($year > (int)$first4) {
                $serialNumber = '0001';
            } else {
                $serialNumber = str_pad($number + 1, 4, "0", STR_PAD_LEFT);
            }
        } else {
            $serialNumber = jdate(now())->getYear() . "0001";
        }
        return $serialNumber;
    }
}
