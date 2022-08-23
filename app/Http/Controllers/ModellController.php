<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Modell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ModellController extends Controller
{
    public function index($id)
    {
        Gate::authorize('groups');

        $group = Group::find($id);
        $modells = $group->modells()->latest()->paginate(25);
        return view('modells.index', compact('modells', 'group'));
    }

    public function create($id)
    {
        Gate::authorize('groups');

        $group = Group::find($id);
        return view('modells.create', compact('group'));
    }

    public function store(Request $request, $id)
    {
        Gate::authorize('groups');

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
        Gate::authorize('groups');

        $group = Group::find($modell->group_id);
        return view('modells.edit', compact('modell', 'group'));
    }

    public function update(Request $request, Modell $modell)
    {
        Gate::authorize('groups');

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
        Gate::authorize('groups');

        $modell->delete();

        alert()->success('حذف موفق', 'حذف مدل با موفقیت انجام شد');

        return back();
    }

    public function replicate(Modell $modell)
    {
        Gate::authorize('groups');

        $lastModell = Modell::latest()->first();
        $code = str_pad($lastModell->code + 1, 4, "0", STR_PAD_LEFT);

        $newModell = $modell->replicate()->fill([
            'code' => $code,
            'name' => $modell->name . " کپی شده",
        ]);
        $newModell->save();

        alert()->success('کپی موفق', 'کپی مدل با موفقیت انجام شد');

        return back();
    }

    public function parts(Modell $modell)
    {
        Gate::authorize('groups');

        $group = Group::find($modell->group_id);

        return view('modells.parts', compact('modell', 'group'));
    }

    public function destroyPart(Modell $modell, $partId)
    {
        Gate::authorize('groups');

        $modell->parts()->detach($partId);

        alert()->success('حذف موفق', 'حذف قطعه از مدل با موفقیت انجام شد');
    }

    public function partValues(Request $request, Modell $modell)
    {
        Gate::authorize('groups');

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
        $lastModell = Modell::latest()->first();
        if ($lastModell) {
            $lastModellCode = str_pad($lastModell->code + 1, 4, "0", STR_PAD_LEFT);
        } else {
            $lastModellCode = '0001';
        }
        return $lastModellCode;
    }
}
