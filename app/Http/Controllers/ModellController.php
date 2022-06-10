<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Modell;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ModellController extends Controller
{

    public function index($id)
    {
        $group = Group::find($id);
        $modells = $group->modells()->latest()->paginate(25);
        return view('modells.index', compact('modells', 'group'));
    }

    public function create($id)
    {
        $group = Group::find($id);
        return view('modells.create', compact('group'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|numeric|unique:modells'
        ]);

        Modell::create([
            'name' => $request['name'],
            'code' => $request['code'],
            'group_id' => $id
        ]);

        alert()->success('ثبت موفق', 'ثبت مدل با موفقیت انجام شد');

        return redirect()->route('modells.index', $id);
    }

    public function show(Modell $modell)
    {
        //
    }

    public function edit(Modell $modell)
    {
        $group = Group::find($modell->group_id);
        return view('modells.edit', compact('modell', 'group'));
    }

    public function update(Request $request, Modell $modell)
    {
        $request->validate([
            'name' => 'required|string|max:2550',
            'code' => ['required', 'numeric', Rule::unique('modells')->ignore($modell->id)]
        ]);

        $modell->update([
            'name' => $request['name'],
            'code' => $request['code']
        ]);

        alert()->success('ویرایش موفق', 'ویرایش مدل با موفقیت انجام شد');

        return redirect()->route('modells.index', $modell->group_id);
    }

    public function destroy(Modell $modell)
    {
        $modell->delete();

        alert()->success('حذف موفق', 'حذف مدل با موفقیت انجام شد');

        return back();
    }

    public function replicate(Modell $modell)
    {
        $newModell = $modell->replicate();
        $newModell->code = random_int(100, 99999);
        $newModell->save();

        alert()->success('کپی موفق', 'کپی مدل با موفقیت انجام شد');

        return back();
    }
}
