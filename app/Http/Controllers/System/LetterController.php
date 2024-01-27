<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\Letter;
use App\Models\User;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class LetterController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:letters')->only(['index']);
        $this->middleware('can:create-letter')->only(['create', 'store']);
        $this->middleware('can:edit-letter')->only(['edit', 'update']);
        $this->middleware('can:delete-letter')->only(['destroy']);
    }

    public function index()
    {
        $letters = Letter::query();

        if ($keyword = request()->has('search')) {
            $letters->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('number', 'LIKE', "%{$keyword}%")
                ->orWhere('method', 'LIKE', "%{$keyword}%");
        }

        if ($category = request()->has('category')) {
            $letters->where('category', $category);
        }

        $letters = $letters->latest()->paginate(25)->withQueryString();
        return view('systems.letters.index', compact('letters'));
    }

    public function create()
    {
        $users = User::all();
        $date = Jalalian::now();
        $today = $date->getYear() . "-" . $date->getMonth() . "-" . $date->getDay();
        return view('systems.letters.create', compact('users', 'today'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'method' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'date' => 'required|string|max:255',
            'registrar' => 'required|integer',
        ]);

        $data = $this->getLetterNumber($data);

        $explodeDate = explode('-', $data['date']);
        $data['date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();

        $request->user()->letters()->create($data);

        alert()->success('ثبت موفق', 'مکاتبه جدید با موفقیت ثبت شد');

        return redirect()->route('letters.index');
    }

    public function edit(Letter $letter)
    {
        $users = User::all();

        $year = jdate($letter->date)->getYear();
        $month = jdate($letter->date)->getMonth();
        $day = jdate($letter->date)->getDay();
        $date = $year . "-" . $month . "-" . $day;

        return view('systems.letters.edit', compact('letter', 'users', 'date'));
    }

    public function update(Request $request, Letter $letter)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'method' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'date' => 'required|string|max:255',
            'registrar' => 'required|integer',
        ]);

        $explodeDate = explode('-', $data['date']);
        $data['date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();

        $letter->update($data);

        alert()->success('بروزرسانی موفق', 'مکاتبه با موفقیت بروزرسانی شد');

        return redirect()->route('letters.index');
    }

    public function destroy(Letter $letter)
    {
        $letter->delete();

        alert()->success('حذف موفق', 'مکاتبه با موفقیت حذف شد');

        return back();
    }

    public function getLetterNumber(array $data)
    {
        $letters = Letter::select(['number'])->get();
        $number = 0;
        foreach ($letters as $letter) {
            if ((int)$letter->number > $number) {
                $number = (int)$letter->number;
            }
        }

        $year = jdate(now())->getYear();
        $first4 = substr((string)$number, 0, 4);

        if (!$letters->isEmpty()) {
            if ($year > (int)$first4) {
                $letterNumber = '00001';
                $data['number'] = $year . $letterNumber;
            } else {
                $letterNumber = str_pad($number + 1, 4, "0", STR_PAD_LEFT);
                $data['number'] = $letterNumber;
            }
        } else {
            $data['number'] = jdate(now())->getYear() . "0001";
        }
        return $data;
    }
}
