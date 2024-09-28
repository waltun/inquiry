<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\Coding;
use App\Models\System\CodingExit;
use App\Models\System\Exitt;
use App\Models\System\SystemCategory;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class ExitController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:exits')->only(['index']);
        $this->middleware('can:create-exit')->only(['create', 'store']);
        $this->middleware('can:edit-exit')->only(['edit', 'update']);
        $this->middleware('can:delete-exit')->only(['destroy']);
    }

    public function index()
    {
        $exits = Exitt::latest()->paginate(20);

        return view('systems.exits.index', compact('exits'));
    }

    public function create()
    {
        return view('systems.exits.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'number' => 'nullable',
            'exit_at' => 'required|string|max:255',
            'exiter' => 'required|string|max:255',
            'car_number' => 'nullable|string|max:255',
            'phone' => 'nullable|numeric|digits:11',
            'type' => 'required|in:personal,mission',
            'mission_location' => 'nullable|string|max:255',
            'mission_reason' => 'nullable|string|max:255',
            'mission_users' => 'nullable|string|max:255',
        ]);

        $allExits = Exitt::all();

        if ($allExits->isEmpty()) {
            $data['number'] = 100;
        } else {
            $lastExit = Exitt::latest()->first();
            $data['number'] = $lastExit->number + 1;
        }

        if (!is_null($data['exit_at'])) {
            $explodeDate = explode('/', $data['exit_at']);
            $data['exit_at'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        Exitt::create($data);

        alert()->success('ثبت موفق', 'خروج موقت با موفقیت ثبت شد');

        return redirect()->route('exits.index');
    }

    public function edit(Exitt $exit)
    {
        $year = jdate($exit->exit_at)->getYear();
        $month = jdate($exit->exit_at)->getMonth();
        $day = jdate($exit->exit_at)->getDay();
        $date = $year . '/' . $month . '/' . $day;

        return view('systems.exits.edit', compact('exit', 'date'));
    }

    public function update(Request $request, Exitt $exit)
    {
        $data = $request->validate([
            'exit_at' => 'required|string|max:255',
            'exiter' => 'required|string|max:255',
            'car_number' => 'nullable|string|max:255',
            'phone' => 'nullable|numeric|digits:11',
            'type' => 'required|in:personal,mission',
            'mission_location' => 'nullable|string|max:255',
            'mission_reason' => 'nullable|string|max:255',
            'mission_users' => 'nullable|string|max:255',
            'confirm_quantity' => 'required|integer|in:0,1'
        ]);

        if (!is_null($data['exit_at'])) {
            $explodeDate = explode('/', $data['exit_at']);
            $data['exit_at'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        $exit->update($data);

        alert()->success('بروزرسانی موفق', 'خروج موقت با موفقیت بروزرسانی شد');

        return redirect()->route('exits.index');
    }

    public function destroy(Request $request)
    {
        $exit = Exitt::findOrFail($request->id);

        foreach ($exit->codingExits as $codingExit) {
            $codingExit->delete();
        }

        $exit->delete();

        alert()->success('حذف موفق', 'خروج موقت با موفقیت حذف شد');
    }

    public function accepted(Request $request)
    {
        $request->validate([
            'accepted' => 'required|array',
            'accepted.*' => 'required|integer|in:0,1',
            'exits' => 'required|array',
            'exits.*' => 'required|integer',
        ]);

        foreach ($request->exits as $index => $id) {
            $exit = Exitt::find($id);
            $exit->accepted = $request->accepted[$index];
            $exit->save();
        }

        alert()->success('ثبت موفق', 'تاییدیه ها با موفقیت ثبت شد');

        return back();
    }

    public function print(Exitt $exit)
    {
        return view('systems.exits.print', compact('exit'));
    }
}
