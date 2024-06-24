<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\ContractNote;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index(Contract $contract)
    {
        $notes = $contract->contractNotes()->latest()->paginate(20);

        return view('contracts.notes.index', compact('contract', 'notes'));
    }

    public function create(Contract $contract)
    {
        return view('contracts.notes.create', compact('contract'));
    }

    public function store(Request $request, Contract $contract)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'nullable',
        ]);

        $data['user_id'] = auth()->user()->id;

        $contract->contractNotes()->create($data);

        alert()->success('ثبت موفق', 'یادداشت با موفقیت ثبت شد');

        return redirect()->route('notes.index', $contract->id);
    }

    public function edit(Contract $contract, ContractNote $note)
    {
        return view('contracts.notes.edit', compact('note', 'contract'));
    }

    public function update(Request $request, Contract $contract, ContractNote $note)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'nullable',
        ]);

        $note->update($data);

        alert()->success('بروزرسانی موفق', 'یادداشت با موفقیت بروزرسانی شد');

        return redirect()->route('notes.index', $contract->id);
    }

    public function destroy(ContractNote $note)
    {
        $note->delete();

        alert()->success('حذف موفق', 'یادداشت با موفقیت حذف شد');

        return back();
    }
}
