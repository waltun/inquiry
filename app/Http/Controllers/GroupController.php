<?php

namespace App\Http\Controllers;

use App\Models\DeleteButton;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class GroupController extends Controller
{
    public function index()
    {
        Gate::authorize('groups');

        $groups = Group::all();
        $delete = DeleteButton::where('active', '1')->first();

        return view('groups.index', compact('groups', 'delete'));
    }

    public function create()
    {
        Gate::authorize('groups');

        $code = $this->getCode();

        return view('groups.create', compact('code'));
    }

    public function store(Request $request)
    {
        Gate::authorize('groups');

        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|numeric|digits:2|unique:groups'
        ]);

        Group::create([
            'name' => $request['name'],
            'code' => $request['code']
        ]);

        alert()->success('ثبت موفق', 'افزودن گروه جدید با موفقیت انجام شد');

        return redirect()->route('groups.index');
    }

    public function show(Group $group)
    {
        //
    }

    public function edit(Group $group)
    {
        Gate::authorize('groups');

        return view('groups.edit', compact('group'));
    }

    public function update(Request $request, Group $group)
    {
        Gate::authorize('groups');

        $request->validate([
            'name' => 'required|string|max:255',
            'code' => ['required', 'numeric', 'digits:2', Rule::unique('groups')->ignore($group->id)]
        ]);

        $group->update([
            'name' => $request['name'],
            'code' => $request['code']
        ]);

        alert()->success('بروزرسانی موفق', 'بروزرسانی گروه با موفقیت انجام شد');

        return redirect()->route('groups.index');
    }

    public function destroy(Group $group)
    {
        Gate::authorize('groups');

        $group->delete();

        alert()->success('حذف موفق', 'حذف گروه با موفقیت انجام شد');

        return back();
    }

    public function parts(Group $group)
    {
        Gate::authorize('groups');

        return view('groups.parts', compact('group'));
    }

    public function destroyPart(Group $group, $partId)
    {
        Gate::authorize('groups');

        $group->parts()->detach($partId);

        alert()->success('حذف موفق', 'حذف قطعه از گروه با موفقیت انجام شد');
    }

    public function partValues(Request $request, Group $group)
    {
        Gate::authorize('groups');

        $request->validate([
            'values' => 'array|required',
            'values.*' => 'numeric|nullable'
        ]);

        foreach ($group->parts as $index => $part) {
            $part->pivot->update([
                'value' => $request->values[$index]
            ]);
        }

        alert()->success('مقادیر', 'مقدار قطعات برای گروه با موفقیت ثبت شد');

        return back();
    }

    public function getCode()
    {
        $lastGroup = Group::latest()->first();
        if (!is_null($lastGroup)) {
            $code = str_pad($lastGroup->code + 1, 2, "0", STR_PAD_LEFT);
        } else {
            $code = '01';
        }
        return $code;
    }
}
