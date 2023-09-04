<?php

namespace App\Http\Controllers;

use App\Models\Marketer;
use App\Models\MarketerAccount;
use Illuminate\Http\Request;

class MarketerAccountController extends Controller
{
    public function index(Marketer $marketer)
    {
        return view('marketers.accounts.index', compact('marketer'));
    }

    public function create(Marketer $marketer)
    {
        return view('marketers.accounts.create', compact('marketer'));
    }

    public function store(Request $request, Marketer $marketer)
    {
        $data = $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'nullable|string|max:255',
            'card_number' => 'nullable|string|max:255',
            'shaba_number' => 'required|string|max:255',
            'account_name' => 'required|string|max:255'
        ]);

        $marketer->accounts()->create($data);

        alert()->success('ثبت موفق', 'ثبت حساب با موفقیت انجام شد');

        return redirect()->route('marketers.accounts.index', $marketer->id);
    }

    public function edit(MarketerAccount $marketerAccount)
    {
        return view('marketers.accounts.edit', compact('marketerAccount'));
    }

    public function update(Request $request, MarketerAccount $marketerAccount)
    {
        $data = $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'nullable|string|max:255',
            'card_number' => 'nullable|string|max:255',
            'shaba_number' => 'required|string|max:255',
            'account_name' => 'required|string|max:255'
        ]);

        $marketerAccount->update($data);

        alert()->success('بروزرسانی موفق', 'بروزرسانی حساب با موفقیت انجام شد');

        return redirect()->route('marketers.accounts.index', $marketerAccount->marketer->id);
    }
}
