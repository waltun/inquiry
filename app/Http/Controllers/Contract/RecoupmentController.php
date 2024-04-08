<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;

class RecoupmentController extends Controller
{
    public function index(Contract $contract)
    {
        return view('contracts.recoupment.index', compact('contract'));
    }

    public function store(Request $request, Contract $contract)
    {
        $data = $request->validate([
            'recoupment' => 'required|string'
        ]);

        $contract->update([
            'recoupment' => $data['recoupment']
        ]);

        alert()->success('ثبت موفق', 'فایل مفاصا حساب با موفقیت بارگذاری شد');

        return back();
    }
}
