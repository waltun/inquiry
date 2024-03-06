<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class LeaveController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:leaves')->only(['index']);
        $this->middleware('can:create-leave')->only(['create', 'store']);
        $this->middleware('can:edit-leave')->only(['edit', 'update']);
        $this->middleware('can:delete-leave')->only(['destroy']);
    }

    public function index()
    {
        $leaves = auth()->user()->leaves()->latest()->paginate(20);

        return view('leaves.index', compact('leaves'));
    }

    public function create()
    {
        return view('leaves.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|string|in:daily,hourly',
            'start_date' => 'required|string|max:255',
            'end_date' => 'nullable|string|max:255',
            'start_hour' => 'nullable|string|max:255',
            'end_hour' => 'nullable|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        if (!is_null($data['start_date'])) {
            $explodeStartDate = explode('/', $data['start_date']);
            $data['start_date'] = (new Jalalian($explodeStartDate[0], $explodeStartDate[1], $explodeStartDate[2]))->toCarbon()->toDateTimeString();
        }

        if (!is_null($data['end_date'])) {
            $explodeEndDate = explode('/', $data['end_date']);
            $data['end_date'] = (new Jalalian($explodeEndDate[0], $explodeEndDate[1], $explodeEndDate[2]))->toCarbon()->toDateTimeString();
        }

        $data['confirm'] = false;

        auth()->user()->leaves()->create($data);

        alert()->success('ثبت موفق', 'ثبت مرخصی جدید با موفقیت انجام شد');

        return redirect()->route('leaves.index');
    }

    public function edit(Leave $leaf)
    {
        $startDay = jdate($leaf->start_date)->getDay();
        $startMonth = jdate($leaf->start_date)->getMonth();
        $startYear = jdate($leaf->start_date)->getYear();
        $startDate = $startYear . '/' . $startMonth . '/' . $startDay;

        $endDay = jdate($leaf->end_date)->getDay();
        $endMonth = jdate($leaf->end_date)->getMonth();
        $endYear = jdate($leaf->end_date)->getYear();
        $endDate = $endYear . '/' . $endMonth . '/' . $endDay;

        return view('leaves.edit', compact('leaf', 'startDate', 'endDate'));
    }

    public function update(Request $request, Leave $leaf)
    {
        $data = $request->validate([
            'type' => 'required|string|in:daily,hourly',
            'start_date' => 'required|string|max:255',
            'end_date' => 'nullable|string|max:255',
            'start_hour' => 'nullable|string|max:255',
            'end_hour' => 'nullable|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        if (!is_null($data['start_date'])) {
            $explodeStartDate = explode('/', $data['start_date']);
            $data['start_date'] = (new Jalalian($explodeStartDate[0], $explodeStartDate[1], $explodeStartDate[2]))->toCarbon()->toDateTimeString();
        }

        if (!is_null($data['end_date'])) {
            $explodeEndDate = explode('/', $data['end_date']);
            $data['end_date'] = (new Jalalian($explodeEndDate[0], $explodeEndDate[1], $explodeEndDate[2]))->toCarbon()->toDateTimeString();
        }

        if ($data['type'] == 'daily') {
            $data['start_hour'] = null;
            $data['end_hour'] = null;
        }

        if ($data['type'] == 'hourly') {
            $data['end_date'] = null;
        }

        $leaf->update($data);

        alert()->success('بروزرسانی موفق', 'بروزرسانی مرخصی با موفقیت انجام شد');

        return redirect()->route('leaves.index');
    }

    public function destroy(Leave $leaf)
    {
        $leaf->delete();

        alert()->success('حذف موفق', 'حذف مرخصی با موفقیت انجام شد');

        return back();
    }
}
