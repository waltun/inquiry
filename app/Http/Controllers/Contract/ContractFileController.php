<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;

class ContractFileController extends Controller
{
    public function index(Contract $contract)
    {
        return view('contracts.contract.index', compact('contract'));
    }

    public function store(Request $request, Contract $contract)
    {
        $data = $request->validate([
            'file' => 'required|string|max:255'
        ]);

        $contract->update([
            'file' => $data['file']
        ]);

        alert()->success('ثبت موفق', 'فایل قرارداد با موفقیت بارگذاری شد');

        return back();
    }
}
