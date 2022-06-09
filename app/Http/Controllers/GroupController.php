<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::latest()->paginate(25);
        return view('groups.index', compact('groups'));
    }

    public function create()
    {
        return view('groups.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|numeric|unique:groups'
        ]);

        $fileNewName = null;

        if ($request->has('image')) {
            $file = $request['image'];
            $fileNewName = Carbon::now()->format('Y-m-d_H-i-s_u.') . $file->extension();
            $file->move(public_path('/files/groups'), $fileNewName);
        }

        Group::create([
            'name' => $request['name'],
            'image' => $fileNewName,
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
        return view('groups.edit', compact('group'));
    }

    public function update(Request $request, Group $group)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => ['required', 'numeric', Rule::unique('groups')->ignore($group->id)]
        ]);

        if ($request->has('image')) {
            File::delete(public_path('/files/groups/' . $group->image));
            $file = $request['image'];
            $fileNewName = Carbon::now()->format('Y-m-d_H-i-s_u.') . $file->extension();
            $file->move(public_path('/files/groups'), $fileNewName);
        } else {
            $fileNewName = $group->image;
        }

        $group->update([
            'name' => $request['name'],
            'image' => $fileNewName,
            'code' => $request['code']
        ]);

        alert()->success('بروزرسانی موفق', 'بروزرسانی گروه با موفقیت انجام شد');

        return redirect()->route('groups.index');
    }

    public function destroy(Group $group)
    {
        if ($group->image) {
            File::delete(public_path('/files/groups/' . $group->image));
        }

        $group->delete();

        alert()->success('حذف موفق', 'حذف گروه با موفقیت انجام شد');

        return back();
    }

    public function parts(Group $group)
    {
        return view('groups.parts', compact('group'));
    }

    public function destroyPart(Group $group, $partId)
    {
        $group->parts()->detach($partId);

        alert()->success('حذف موفق', 'حذف قطعه از گروه با موفقیت انجام شد');

        return back();
    }
}
