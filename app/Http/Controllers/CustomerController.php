<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:customers')->only(['index']);
        $this->middleware('can:create-customer')->only(['create', 'store']);
        $this->middleware('can:edit-customer')->only(['edit', 'update']);
        $this->middleware('can:delete-customer')->only(['destroy']);
    }

    public function index()
    {

        if (auth()->user()->role == 'admin') {
            $customers = Customer::latest()->paginate(20);
        } else {
            $customers = auth()->user()->customers()->latest()->paginate(20);
        }

        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'nation' => 'nullable|numeric',
            'address' => 'nullable|string|max:255',
            'postal' => 'nullable|numeric',
            'registration_number' => 'nullable|numeric',
            'telephone' => 'nullable|numeric|digits:11',
            'email' => 'nullable|string|email|max:255',
            'social_phone' => 'nullable|numeric|digits:11',
            'phone' => 'nullable|numeric|digits:11',
        ]);

        auth()->user()->customers()->create($data);

        alert()->success('ثبت موفق', 'ثبت مشتری با موفقیت انجام شد');

        return redirect()->route('customers.index');
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'type' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'nation' => 'nullable|numeric',
            'address' => 'nullable|string|max:255',
            'postal' => 'nullable|numeric',
            'registration_number' => 'nullable|numeric',
            'telephone' => 'nullable|numeric|digits:11',
            'email' => 'nullable|string|email|max:255',
            'social_phone' => 'nullable|numeric|digits:11',
            'phone' => 'nullable|numeric|digits:11',
        ]);

        $customer->update($data);

        alert()->success('بروزرسانی موفق', 'بروزرسانی مشتری با موفقیت انجام شد');

        return redirect()->route('customers.index');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        alert()->success('حذف موفق', 'حذف مشتری با موفقیت انجام شد');

        return back();
    }
}
