<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Modell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
        ]);

        $lastModellCode = $this->getLastCode($id);

        Modell::create([
            'name' => $request['name'],
            'code' => $lastModellCode,
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
        ]);

        $modell->update([
            'name' => $request['name'],
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

    public function parts(Modell $modell)
    {
        Gate::authorize('modells');

        $group = Group::find($modell->group_id);

        return view('modells.parts', compact('modell', 'group'));
    }

    public function destroyPart(Modell $modell, $partId)
    {
        Gate::authorize('modells');

        $modell->parts()->detach($partId);

        alert()->success('حذف موفق', 'حذف قطعه از مدل با موفقیت انجام شد');
    }

    public function partValues(Request $request, Modell $modell)
    {
        $request->validate([
            'values' => 'array|required',
            'values.*' => 'numeric|nullable'
        ]);

        foreach ($modell->parts as $index => $part) {
            $part->pivot->update([
                'value' => $request->values[$index]
            ]);
        }

        alert()->success('مقادیر', 'مقدار قطعات برای مدل با موفقیت ثبت شد');

        return back();
    }

    public function getLastCode($id)
    {
        $group = Group::find($id);
        $lastModell = Modell::where('group_id', $group->id)->latest()->first();
        if ($lastModell) {
            $lastModellCode = str_pad($lastModell->code + 1, 4, "0", STR_PAD_LEFT);
        } else {
            $lastModellCode = '0001';
        }
        return $lastModellCode;
    }
}
