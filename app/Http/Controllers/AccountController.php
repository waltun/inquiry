<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::latest()->paginate(20);
        return view('accounts.index', compact('accounts'));
    }

    public function create()
    {
        return view('accounts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'bank' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'card_number' => 'nullable|string|max:255',
            'shaba_number' => 'nullable|string|max:255',
            'branch' => 'nullable|string|max:255',
            'branch_code' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        Account::create($data);

        alert()->success('ثبت موفق', 'ثبت حساب با موفقیت انجام شد');

        return redirect()->route('accounts.index');
    }

    public function edit(Account $account)
    {
        return view('accounts.edit', compact('account'));
    }

    public function update(Request $request, Account $account)
    {
        $data = $request->validate([
            'bank' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'card_number' => 'nullable|string|max:255',
            'shaba_number' => 'nullable|string|max:255',
            'branch' => 'nullable|string|max:255',
            'branch_code' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        $account->update($data);

        alert()->success('بروزرسانی موفق', 'بروزرسانی حساب با موفقیت انجام شد');

        return redirect()->route('accounts.index');
    }

    public function destroy(Account $account)
    {
        $account->delete();

        alert()->success('حذف موفق', 'حذف حساب با موفقیت انجام شد');

        return back();
    }
}
