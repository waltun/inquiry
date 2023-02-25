<?php

namespace App\Http\Controllers;

use App\Models\CurrentPrice;
use App\Models\DeleteButton;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('settings.index');
    }

    public function priceColorIndex()
    {
        $settings = Setting::latest()->paginate(20);
        return view('settings.price-color.index', compact('settings'));
    }

    public function priceColorCreate()
    {
        return view('settings.price-color.create');
    }

    public function priceColorStore(Request $request)
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
            return redirect()->route('settings.price-color.index');
        }

        Setting::create([
            'price_color_type' => $request['price_color_type'],
            'price_color_mid_time' => $request['price_color_mid_time'],
            'price_color_last_time' => $request['price_color_last_time'],
            'active' => $request['active'],
        ]);

        alert()->success('ثبت موفق', 'ثبت تنظیمات با موفقیت انجام شد');

        return redirect()->route('settings.price-color.index');
    }

    public function priceColorEdit(Setting $setting)
    {
        return view('settings.price-color.edit', compact('setting'));
    }

    public function priceColorUpdate(Request $request, Setting $setting)
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

        return redirect()->route('settings.price-color.index');
    }

    public function priceColorDestroy(Setting $setting)
    {
        $setting->delete();

        alert()->success('حذف موفق', 'حذف تنظیمات با موفقیت انجام شد');

        return back();
    }

    public function deleteButtonIndex()
    {
        $settings = DeleteButton::latest()->paginate(20);
        return view('settings.delete-button.index', compact('settings'));
    }

    public function deleteButtonCreate()
    {
        return view('settings.delete-button.create');
    }

    public function deleteButtonStore(Request $request)
    {
        $request->validate([
            'parts' => 'required',
            'collection_parts' => 'required',
            'collection_coil' => 'required',
            'users' => 'required',
            'inquiries' => 'required',
            'categories' => 'required',
            'products' => 'required',
            'active' => 'required',
        ]);

        $activeSetting = DeleteButton::where('active', '1')->get();
        if (!$activeSetting->isEmpty() && $request['active'] == '1') {
            alert()->error('خطا', 'نمیتوان بیشتر از یک تنظیمات فعال ثبت کرد');
            return redirect()->route('settings.delete-button.index');
        }

        DeleteButton::create([
            'parts' => $request['parts'],
            'collection_parts' => $request['collection_parts'],
            'collection_coil' => $request['collection_coil'],
            'users' => $request['users'],
            'inquiries' => $request['inquiries'],
            'categories' => $request['categories'],
            'products' => $request['products'],
            'active' => $request['active'],
        ]);

        alert()->success('ثبت موفق', 'ثبت تنظیمات با موفقیت انجام شد');

        return redirect()->route('settings.delete-button.index');
    }

    public function deleteButtonEdit(DeleteButton $deleteButton)
    {
        return view('settings.delete-button.edit', compact('deleteButton'));
    }

    public function deleteButtonUpdate(Request $request, DeleteButton $deleteButton)
    {
        $request->validate([
            'parts' => 'required',
            'collection_parts' => 'required',
            'collection_coil' => 'required',
            'users' => 'required',
            'inquiries' => 'required',
            'categories' => 'required',
            'products' => 'required',
            'active' => 'required',
        ]);

        $deleteButton->update([
            'parts' => $request['parts'],
            'collection_parts' => $request['collection_parts'],
            'collection_coil' => $request['collection_coil'],
            'users' => $request['users'],
            'inquiries' => $request['inquiries'],
            'categories' => $request['categories'],
            'products' => $request['products'],
            'active' => $request['active'],
        ]);

        alert()->success('ویرایش موفق', 'ویرایش تنظیمات با موفقیت انجام شد');

        return redirect()->route('settings.delete-button.index');
    }

    public function deleteButtonDestroy(DeleteButton $deleteButton)
    {
        $deleteButton->delete();

        alert()->success('حذف موفق', 'حذف تنظیمات با موفقیت انجام شد');

        return back();
    }

    public function create()
    {
        $description = CurrentPrice::first();
        return view('settings.current-price-description.create', compact('description'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required'
        ]);

        $descriptions = CurrentPrice::all();
        foreach ($descriptions as $description) {
            $description->delete();
        }

        CurrentPrice::create([
            'description' => $request['description']
        ]);

        alert()->success('ثبت موفق', 'ثبت توضیحات با موفقیت انجام شد');

        return redirect()->route('settings.index');
    }
}
