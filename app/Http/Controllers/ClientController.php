<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::latest()->paginate(20);
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|numeric',
            'email' => 'nullable|string|email'
        ]);

        Client::create($data);

        alert()->success('ثبت موفق', 'ثبت مشتری استعلام با موفقیت انجام شد');

        return redirect()->route('clients.index');
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|numeric',
            'email' => 'nullable|string|email'
        ]);

        $client->update($data);

        alert()->success('بروزرسانی موفق', 'بروزرسانی مشتری استعلام با موفقیت انجام شد');

        return redirect()->route('clients.index');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        alert()->success('حذف موفق', 'حذف مشتری استعلام با موفقیت انجام شد');

        return back();
    }
}
