<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::latest()->paginate(20);

        return view('permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:permissions',
            'label' => 'required|string|max:255'
        ]);

        Permission::create($data);

        alert()->success('ثبت موفق', 'ثبت دسترسی با موفقیت انجام شد');

        return redirect()->route('permissions.index');
    }

    public function show(Permission $permission)
    {
        //
    }

    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('permissions')->ignore($permission->id)],
            'label' => 'required|string|max:255'
        ]);

        $permission->update($data);

        alert()->success('بروزرسانی موفق', 'بروزرسانی دسترسی با موفقیت انجام شد');

        return redirect()->route('permissions.index');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        alert()->success('حذف موفق', 'حذف دسترسی با موفقیت انجام شد');

        return back();
    }
}
