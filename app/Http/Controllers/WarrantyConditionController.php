<?php

namespace App\Http\Controllers;

use App\Models\WarrantyCondition;
use Illuminate\Http\Request;

class WarrantyConditionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:settings')->only([
            'index', 'create', 'store', 'edit', 'update', 'destroy'
        ]);
    }

    public function index()
    {
        $conditions = WarrantyCondition::latest()->paginate(20);
        return view('settings.warranty-conditions.index', compact('conditions'));
    }

    public function create()
    {
        return view('settings.warranty-conditions.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required'
        ]);

        WarrantyCondition::create($data);

        alert()->success('ثبت موفق', 'شرایط گارانتی جدید با موفقیت ثبت شد');

        return redirect()->route('settings.warrantyCondition.index');
    }

    public function edit(WarrantyCondition $warrantyCondition)
    {
        return view('settings.warranty-conditions.edit', compact('warrantyCondition'));
    }

    public function update(Request $request, WarrantyCondition $warrantyCondition)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required'
        ]);

        $warrantyCondition->update($data);

        alert()->success('بروزرسانی موفق', 'شرایط گارانتی با موفقیت بروزرسانی شد');

        return redirect()->route('settings.warrantyCondition.index');
    }

    public function destroy(WarrantyCondition $warrantyCondition)
    {
        $warrantyCondition->delete();

        alert()->success('حذف موفق', 'شرایط گارانتی با موفقیت حذف شد');

        return back();
    }
}
