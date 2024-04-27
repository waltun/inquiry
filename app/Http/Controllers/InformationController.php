<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:settings')->only([
            'index', 'create', 'store', 'edit', 'update', 'destroy'
        ]);
    }

    public function index()
    {
        $information = Information::latest()->paginate(20);
        return view('settings.information.index', compact('information'));
    }

    public function create()
    {
        return view('settings.information.create');
    }

    public function store(Request $request)
    {
        $informations = Information::all()->contains('active', 1);

        if (!$informations) {
            $data = $request->validate([
                'title' => 'required|string|max:255',
                'title_en' => 'nullable|string|max:255',
                'logo' => 'nullable|string|max:255',
                'website' => 'nullable|string|max:255',
                'address' => 'nullable',
                'phone' => 'nullable|string|max:255',
                'telephone' => 'nullable|string|max:255',
                'email' => 'nullable|string|email|max:255',
                'header' => 'required|in:0,1',
                'active' => 'required|in:0,1',
            ]);

            Information::create($data);

            alert()->success('ثبت موفق', 'اطلاعات سربرگ با موفقیت ثبت شد');

            return redirect()->route('information.index');
        }

        alert()->error('خطا', 'تنها یک سربرگ فعال مورد قبول است');

        return back();
    }

    public function edit(Information $information)
    {
        return view('settings.information.edit', compact('information'));
    }

    public function update(Request $request, Information $information)
    {
        $informations = Information::all()->except($information->id)->contains('active', 1);

        if (!$informations) {
            $data = $request->validate([
                'title' => 'required|string|max:255',
                'title_en' => 'nullable|string|max:255',
                'logo' => 'nullable|string|max:255',
                'website' => 'nullable|string|max:255',
                'address' => 'nullable',
                'phone' => 'nullable|string|max:255',
                'telephone' => 'nullable|string|max:255',
                'email' => 'nullable|string|email|max:255',
                'header' => 'required|in:0,1',
                'active' => 'required|in:0,1',
            ]);

            $information->update($data);

            alert()->success('بروزرسانی موفق', 'اطلاعات سربرگ با موفقیت بروزرسانی شد');

            return redirect()->route('information.index');
        }

        alert()->error('خطا', 'تنها یک سربرگ فعال مورد قبول است');

        return back();
    }

    public function destroy(Information $information)
    {
        $information->delete();

        alert()->success('حذف موفق', 'اطلاعات سربرگ با موفقیت حذف شد');

        return back();
    }
}
