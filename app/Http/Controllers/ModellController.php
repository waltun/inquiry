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

        if (request()->has('parent')) {
            $modell = Modell::where('id', request('parent'))->first();
            $code = $this->getParentLastCode($modell);
        } else {
            $code = $this->getLastCode($group);
        }

        return view('modells.create', compact('group', 'code'));
    }

    public function store(Request $request, $id)
    {
        Gate::authorize('groups');

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $group = Group::find($id);

        if (!is_null($request->parent_id)) {
            $modell = Modell::where('id', $request->parent_id)->first();
            $code = $this->getParentLastCode($modell);
            Modell::create([
                'name' => $request['name'],
                'code' => $code,
                'group_id' => $id,
                'parent_id' => $modell->id
            ]);
        } else {
            $code = $this->getLastCode($group);
            Modell::create([
                'name' => $request['name'],
                'code' => $code,
                'group_id' => $id,
                'parent_id' => 0
            ]);
        }

        alert()->success('ثبت موفق', 'ثبت مدل با موفقیت انجام شد');

        return redirect()->route('groups.index');
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

        if ($request['parent_id']) {
            $request->validate([
                'parent_id' => 'required',
            ]);

            $modell->update([
                'name' => $request['name'],
                'parent_id' => $request['parent_id']
            ]);
        }

        if ($request['group_id']) {
            $request->validate([
                'group_id' => 'required',
            ]);

            $modell->update([
                'name' => $request['name'],
                'group_id' => $request['group_id']
            ]);
        }

        alert()->success('ویرایش موفق', 'ویرایش مدل با موفقیت انجام شد');

        return redirect()->route('groups.index');
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

        $group = Group::find($modell->group_id);
        $lastModellCode = $this->getLastCode($group);

        $newModell = $modell->replicate()->fill([
            'code' => $lastModellCode,
            'name' => $modell->name . " کپی شده",
        ]);
        $newModell->save();

        foreach ($modell->parts as $part) {
            $newModell->parts()->syncWithoutDetaching([
                $part->id => [
                    'value' => $part->pivot->value
                ]
            ]);
        }

        alert()->success('کپی موفق', 'کپی مدل با موفقیت انجام شد');

        return back();
    }

    public function parts(Modell $modell)
    {
        Gate::authorize('groups');

        return view('modells.parts', compact('modell'));
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
            'values.*' => 'numeric|nullable',
            'sorts' => 'array|required',
            'sorts.*' => 'numeric|required'
        ]);

        foreach ($modell->parts as $index => $part) {
            $part->pivot->update([
                'value' => $request->values[$index],
                'part_id' => $request->part_ids[$index],
                'sort' => $request->sorts[$index],
            ]);
        }

        alert()->success('مقادیر', 'مقدار قطعات برای مدل با موفقیت ثبت شد');

        return back();
    }

    public function getLastCode($group)
    {
        if (!$group->modells->isEmpty()) {
            $lastModell = $group->modells()->where('parent_id', 0)->latest()->first();
            $lastModellCode = str_pad($lastModell->code + 1, 2, "0", STR_PAD_LEFT);
        } else {
            $lastModellCode = '01';
        }
        return $lastModellCode;
    }

    public function getParentLastCode($modell)
    {
        if (!$modell->children->isEmpty()) {
            $lastModellCode = $modell->children()->latest()->first()->code;
            $code = str_pad($lastModellCode + 1, 4, "0", STR_PAD_LEFT);
        } else {
            $code = '0001';
        }
        return $code;
    }
}
