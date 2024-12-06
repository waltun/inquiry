<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::latest()->paginate(25);

        return view('systems.employees.index', compact('employees'));
    }

    public function create()
    {
        return view('systems.employees.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'nation' => 'required|string|max:255',
            'level' => 'required|string|max:255',
            'insurance' => 'nullable|string|max:255',
            'phone' => 'required|numeric|digits:11',
            'cart' => 'nullable|string|max:255',
            'education' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'start_date' => 'required|string|max:255',
            'end_date' => 'nullable|string|max:255',
        ]);

        $explodeStartDate = explode('/', $data['start_date']);
        $data['start_date'] = (new Jalalian($explodeStartDate[0], $explodeStartDate[1], $explodeStartDate[2]))->toCarbon()->toDateTimeString();

        if (!is_null($data['end_date'])) {
            $explodeEndDate = explode('/', $data['end_date']);
            $data['end_date'] = (new Jalalian($explodeEndDate[0], $explodeEndDate[1], $explodeEndDate[2]))->toCarbon()->toDateTimeString();
        }

        Employee::create($data);

        alert()->success('ثبت موفق', 'ثبت کارمند با موفقیت انجام شد');

        return redirect()->route('employees.index');
    }

    public function edit(Employee $employee)
    {
        $startDay = jdate($employee->start_date)->getDay();
        $startMonth = jdate($employee->start_date)->getMonth();
        $startYear = jdate($employee->start_date)->getYear();
        $startDate = $startYear . '/' . $startMonth . '/' . $startDay;

        $endDate = '';
        if (!is_null($employee->end_date)) {
            $endDay = jdate($employee->start_date)->getDay();
            $endMonth = jdate($employee->start_date)->getMonth();
            $endYear = jdate($employee->start_date)->getYear();
            $endDate = $endYear . '/' . $endMonth . '/' . $endDay;
        }

        return view('systems.employees.edit', compact('employee', 'startDate', 'endDate'));
    }

    public function update(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'nation' => 'required|string|max:255',
            'level' => 'required|string|max:255',
            'insurance' => 'nullable|string|max:255',
            'phone' => 'required|numeric|digits:11',
            'cart' => 'nullable|string|max:255',
            'education' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'start_date' => 'required|string|max:255',
            'end_date' => 'nullable|string|max:255',
        ]);

        $explodeStartDate = explode('/', $data['start_date']);
        $data['start_date'] = (new Jalalian($explodeStartDate[0], $explodeStartDate[1], $explodeStartDate[2]))->toCarbon()->toDateTimeString();

        if (!is_null($data['end_date'])) {
            $explodeEndDate = explode('/', $data['end_date']);
            $data['end_date'] = (new Jalalian($explodeEndDate[0], $explodeEndDate[1], $explodeEndDate[2]))->toCarbon()->toDateTimeString();
        }

        $employee->update($data);

        alert()->success('بروزرسانی موفق', 'بروزرسانی کارمند با موفقیت انجام شد');

        return redirect()->route('employees.index');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        alert()->success('حذف موفق', 'حذف کارمند با موفقیت انجام شد');

        return back();
    }
}
