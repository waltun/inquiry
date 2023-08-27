<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->paginate(20);
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
            'confirmed_address' => 'nullable|string|max:255',
            'postal' => 'nullable|numeric',
            'registration_number' => 'nullable|numeric',
            'agent_name' => 'nullable|string|max:255',
            'agent_phone' => 'nullable|numeric|digits:11',
            'telephone' => 'nullable|numeric|digits:11',
            'email' => 'nullable|string|email|max:255',
            'social_phone' => 'nullable|numeric|digits:11',
            'manager_name' => 'nullable|string|max:255',
            'manager_phone' => 'nullable|numeric|digits:11',
            'delivery_address' => 'nullable|string|max:255',
            'technical_agent_name' => 'nullable|string|max:255',
            'technical_agent_phone' => 'nullable|numeric|digits:11',
            'phone' => 'nullable|numeric|digits:11',
        ]);

        Customer::create($data);

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
            'confirmed_address' => 'nullable|string|max:255',
            'postal' => 'nullable|numeric',
            'registration_number' => 'nullable|numeric',
            'agent_name' => 'nullable|string|max:255',
            'agent_phone' => 'nullable|numeric|digits:11',
            'telephone' => 'nullable|numeric|digits:11',
            'email' => 'nullable|string|email|max:255',
            'social_phone' => 'nullable|numeric|digits:11',
            'manager_name' => 'nullable|string|max:255',
            'manager_phone' => 'nullable|numeric|digits:11',
            'delivery_address' => 'nullable|string|max:255',
            'technical_agent_name' => 'nullable|string|max:255',
            'technical_agent_phone' => 'nullable|numeric|digits:11',
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
