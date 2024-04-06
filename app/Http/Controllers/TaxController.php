<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class TaxController extends Controller
{
    public function index()
    {
        $taxes = Tax::latest()->paginate(20);
        return view('settings.taxes.index', compact('taxes'));
    }

    public function create()
    {
        return view('settings.taxes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'year' => 'required|numeric',
            'rate' => 'required|numeric'
        ]);

        $tax = Tax::where('year', $data['year'])->first();

        if ($tax) {
            alert()->error('خطا', 'ارزش افزوده برای این سال ثبت شده است');

            return back();
        }

        Tax::create($data);

        alert()->success('ثبت موفق', 'ارزش افزوده با موفقیت ثبت شد');

        return redirect()->route('taxes.index');
    }

    public function edit(Tax $tax)
    {
        return view('settings.taxes.edit', compact('tax'));
    }

    public function update(Request $request, Tax $tax)
    {
        $data = $request->validate([
            'rate' => 'required|numeric'
        ]);

        $tax->update($data);

        alert()->success('بروزرسانی موفق', 'ارزش افزوده با موفقیت بروزرسانی شد');

        return redirect()->route('taxes.index');
    }

    public function destroy(Tax $tax)
    {
        $tax->delete();

        alert()->success('حذف موفق', 'ارزش افزوده با موفقیت حذف شد');

        return back();
    }
}
