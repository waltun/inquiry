<?php

namespace App\Http\Controllers;

use App\Models\DeleteButton;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query();

        if (request('role')) {
            $users->where('role', request('role'))->get();
        }

        $delete = DeleteButton::where('active', '1')->first();
        $users = $users->get();

        return view('users.index', compact('users', 'delete'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'digits:11', 'regex:/(09)[0-9]{9}/', 'numeric', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nation' => ['required', 'digits:10', 'numeric', 'unique:users'],
            'gender' => ['required', 'in:male,female'],
            'role' => ['required', 'in:admin,technical,sale-manager,price,logistic,sale-expert,it,user,agent'],
            'active' => ['required', 'integer', 'in:0,1']
        ]);

        $data['password'] = Hash::make($request['password']);

        User::create($data);

        alert()->success('ثبت موفق', 'افزودن کاربر جدید با موفقیت انجام شد');

        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['required', 'digits:11', 'regex:/(09)[0-9]{9}/', 'numeric', Rule::unique('users')->ignore($user->id)],
            'nation' => ['required', 'digits:10', 'numeric', Rule::unique('users')->ignore($user->id)],
            'gender' => ['required', 'in:male,female'],
            'role' => ['required', 'in:admin,technical,sale-manager,price,logistic,sale-expert,it,user,agent'],
            'active' => ['required', 'integer', 'in:0,1']
        ]);

        if (!is_null($request['password'])) {
            $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed']
            ]);
            $data['password'] = $request['password'];
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        alert()->success('بروزرسانی موفق', 'بروزرسانی کاربر با موفقیت انجام شد');

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();

        alert()->success('حذف موفق', 'حذف کاربر با موفقیت انجام شد');

        return back();
    }

    public function deleted()
    {
        $users = User::onlyTrashed()->latest()->paginate(20);
        return view('users.deleted', compact('users'));
    }

    public function restore($id)
    {
        $user = User::where('id', $id)->withTrashed()->first();

        $user->restore();

        alert()->success('بازگردانی موفق', 'بازگردانی کاربر با موفقیت انجام شد');

        return redirect()->route('users.index');
    }

    public function forceDelete($id)
    {
        $user = User::where('id', $id)->withTrashed()->first();

        $user->forceDelete();

        alert()->success('حذف کامل موفق', 'حذف کامل کاربر با موفقیت انجام شد');

        return redirect()->route('users.deleted');
    }

    public function permissions(User $user)
    {
        $permissions = Permission::all();
        $roles = Role::all();
        return view('users.permissions', compact('user', 'permissions', 'roles'));
    }

    public function storePermissions(Request $request, User $user)
    {
        $data = $request->validate([
            'roles' => 'required|array',
            'permissions' => 'required|array',
        ]);

        $user->roles()->sync($data['roles']);
        $user->permissions()->sync($data['permissions']);

        alert()->success('ثبت دسترسی موفق', 'ثبت دسترسی کاربر با موفقیت انجام شد');

        return redirect()->route('users.index');
    }
}
