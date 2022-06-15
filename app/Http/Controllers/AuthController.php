<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');

    }

    public function storeLogin(Request $request)
    {
        $user = User::where('phone', $request['phone'])->first();

        $credentials = $request->validate([
            'phone' => ['required', 'numeric', 'digits:11', 'regex:/(09)[0-9]{9}/'],
            'password' => ['required', 'string', 'max:255'],
        ]);

        if ($user) {
            if ($user->active != 0) {
                if (Auth::attempt($credentials)) {
                    $request->session()->regenerate();

                    alert()->success('ورود موفق', 'شما با موفقیت به بخش استعلام قیمت وارد شدید');

                    return redirect()->intended('/');
                }

                return back()->withErrors([
                    'phone' => 'شماره تماس یا رمز عبور صحیح نمی باشد.',
                ]);
            }
            return back()->withErrors([
                'active' => 'کاربر مورد نظر هنوز از سوی مدیریت تایید نشده است.'
            ]);
        }
        return back()->withErrors([
            'active' => 'کاربری با این مشخصات وجود ندارد'
        ]);
    }

    public function register()
    {
        return view('auth.register');
    }

    public function storeRegister(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'digits:11', 'regex:/(09)[0-9]{9}/', 'numeric', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nation' => ['required', 'digits:10', 'numeric', 'unique:users'],
            'gender' => ['required', 'in:male,female'],
            'role' => ['required', 'in:user']
        ]);

        $data['password'] = Hash::make($request['password']);

        User::create($data);

        $request->session()->flash('register');
        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        alert()->success('خروج موفق', 'شما با موفقیت از بخش استعلام خارج شدید');

        return redirect('/');
    }
}
