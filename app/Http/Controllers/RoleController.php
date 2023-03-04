<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::latest()->paginate(20);
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:roles',
            'label' => 'required|string|max:255',
            'permissions' => 'required|array'
        ]);

        $role = Role::create($data);

        $role->permissions()->sync($data['permissions']);

        alert()->success('ثبت موفق', 'ثبت دسترسی با موفقیت انجام شد');

        return redirect()->route('roles.index');
    }

    public function show(Role $role)
    {
        //
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('roles')->ignore($role->id)],
            'label' => 'required|string|max:255',
            'permissions' => 'required|array'
        ]);

        $role->update($data);

        $role->permissions()->sync($data['permissions']);

        alert()->success('ثبت موفق', 'بروزرسانی نقش با موفقیت انجام شد');

        return redirect()->route('roles.index');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        alert()->success('حذف موفق', 'حذف نقش با موفقیت انجام شد');

        return back();
    }
}
