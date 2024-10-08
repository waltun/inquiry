<?php

namespace App\Http\Controllers;

use App\Exceptions\CoreException;
use App\Models\ActiveCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Melipayamak;

class AuthController extends Controller
{
    public function login()
    {
        //throw new CoreException('Laravel Can Not be Loaded!');

        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    public function storeLogin(Request $request)
    {
        $request->validate([
            'phone' => 'required|numeric|digits:11|regex:/(09)[0-9]{9}/'
        ]);

        $user = User::where('phone', $request->phone)->first();

        if (!is_null($user)) {
            $code = ActiveCode::generateCode($user);

//            $api = new Melipayamak\MelipayamakApi('9022228553', '@2047507881Pp');
//            $smsSoap = $api->sms('soap');
//            $to = $request->phone;
//            $smsSoap->sendByBaseNumber([$code], $to, '125970');

//            $data = array('username' => "9022228553", 'password' => "@2047507881Pp", 'text' => $code, 'to' => $request->phone, "bodyId" => 125970);
//            $post_data = http_build_query($data);
//            $handle = curl_init('https://rest.payamak-panel.com/api/SendSMS/BaseServiceNumber');
//            curl_setopt($handle, CURLOPT_HTTPHEADER, array(
//                'content-type' => 'application/x-www-form-urlencoded'
//            ));
//            curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
//            curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
//            curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
//            curl_setopt($handle, CURLOPT_POST, true);
//            curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
//            $response = curl_exec($handle);

            $request->session()->flash('phone', $user->phone);
            $request->session()->flash('success-login', 'کد تایید با موفقیت به شماره وارد شده ارسال شد.');

            $activeCode = ActiveCode::where('user_id', $user->id)->orderBy('expired_at', 'desc')->first();
        } else {
            $createdUser = User::create([
                'phone' => $request->phone,
                'role' => 'user'
            ]);
            $code = ActiveCode::generateCode($createdUser);
            $api = new Melipayamak\MelipayamakApi('9022228553', '0PM@N');
            $smsSoap = $api->sms();
            $to = $request->phone;
            $smsSoap->sendByBaseNumber([$code], $to, '123453');
            $request->session()->flash('phone', $createdUser->phone);
            $activeCode = ActiveCode::where('user_id', $createdUser->id)->orderBy('expired_at', 'desc')->first();
        }

        $expiredTime = (jdate($activeCode->expired_at)->getTimestamp());
        $expiredTime *= 1000;

        $request->session()->flash('expired', $expiredTime);

        return redirect()->route('login.phone');
    }

    public function phone()
    {
        session()->reflash();
        if (session()->has('phone')) {
            $expiredTime = session()->get('expired');
            return view('auth.phone', compact('expiredTime'));
        }
        return redirect()->route('login')->with('session-error', 'لطفا شماره موبایل خود را وارد کنید!');
    }

    public function storePhone(Request $request)
    {
        session()->reflash();

        if (session()->has('phone')) {
            $request->validate([
                'code1' => 'required|numeric|digits:1',
                'code2' => 'required|numeric|digits:1',
                'code3' => 'required|numeric|digits:1',
                'code4' => 'required|numeric|digits:1',
            ]);

            $code = $request->code1 . $request->code2 . $request->code3 . $request->code4;

            $user = User::where('phone', session()->get('phone'))->first();

            if (!is_null($user)) {
                $status = ActiveCode::verifyCode($code, $user);
                if ($user->active) {
                    if ($status) {
                        $user->activeCode()->delete();
//                    if (!$user->active) {
//                        $user->update([
//                            'active' => true
//                        ]);
//                    }
                        Auth::loginUsingId($user->id);

                        alert()->success('ورود موفق', 'شما با موفقیت وارد سیستم شدید');

                        if ($user->role == 'client') {
                            return redirect()->route('clients.invoices', $user->id);
                        }

                        if ($user->role == 'logistics') {
                            return redirect()->route('purchase.view');
                        }

                        return redirect()->route('dashboard');
                    }
                    return back()->with('code-error', 'کد وارد شده صحیح نمی باشد!');
                }
                return back()->with('code-error', 'منتظر تایید مدیریت!');
            }
        }

        return redirect()->route('login')->with('session-error', 'لطفا شماره موبایل خود را وارد کنید!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->intended('/');
    }
}
