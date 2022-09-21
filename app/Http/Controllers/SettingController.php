<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::latest()->paginate(20);
        return view('settings.index', compact('settings'));
    }

    public function create()
    {
        return view('settings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'price_color_type' => 'required|in:hour,day,month',
            'price_color_mid_time' => 'required|numeric',
            'price_color_last_time' => 'required|numeric',
            'active' => 'required'
        ]);

        $activeSetting = Setting::where('active', '1')->get();
        if (!$activeSetting->isEmpty() && $request['active'] == '1') {
            alert()->error('خطا', 'نمیتوان بیشتر از یک تنظیمات فعال ثبت کرد');
            return redirect()->route('settings.index');
        }

        Setting::create([
            'price_color_type' => $request['price_color_type'],
            'price_color_mid_time' => $request['price_color_mid_time'],
            'price_color_last_time' => $request['price_color_last_time'],
            'active' => $request['active'],
        ]);

        alert()->success('ثبت موفق', 'ثبت تنظیمات با موفقیت انجام شد');

        return redirect()->route('settings.index');
    }

    public function edit(Setting $setting)
    {
        return view('settings.edit', compact('setting'));
    }

    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'price_color_type' => 'required|in:hour,day,month',
            'price_color_mid_time' => 'required|numeric',
            'price_color_last_time' => 'required|numeric',
            'active' => 'required'
        ]);

        $setting->update([
            'price_color_type' => $request['price_color_type'],
            'price_color_mid_time' => $request['price_color_mid_time'],
            'price_color_last_time' => $request['price_color_last_time'],
            'active' => $request['active'],
        ]);

        alert()->success('ویرایش موفق', 'ویرایش تنظیمات با موفقیت انجام شد');

        return redirect()->route('settings.index');
    }

    public function destroy(Setting $setting)
    {
        $setting->delete();

        alert()->success('حذف موفق', 'حذف تنظیمات با موفقیت انجام شد');

        return back();
    }
}
