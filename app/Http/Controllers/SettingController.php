<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('settings.index', compact('setting'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'price_color_type' => 'required|in:hour,day,month',
            'price_color_time' => 'required|numeric'
        ]);

        Setting::create([
            'price_color_type' => $request['price_color_type'],
            'price_color_time' => $request['price_color_time']
        ]);

        alert()->success('ثبت موفق', 'ثبت تنظیمات با موفقیت انجام شد');

        return back();
    }
}
