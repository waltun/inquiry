<?php

namespace App\Http\Controllers;

use App\Models\InquiryTerm;
use Illuminate\Http\Request;

class InquiryTermController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:settings')->only([
            'index', 'create', 'store', 'edit', 'update', 'destroy'
        ]);
    }

    public function index()
    {
        $terms = InquiryTerm::latest()->paginate(20);
        return view('settings.inquiry-terms.index', compact('terms'));
    }

    public function create()
    {
        return view('settings.inquiry-terms.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required'
        ]);

        InquiryTerm::create($data);

        alert()->success('ثبت موفق', 'شرایط فروش جدید با موفقیت ثبت شد');
        return redirect()->route('settings.inquiryTerms.index');
    }

    public function edit(InquiryTerm $inquiryTerm)
    {
        return view('settings.inquiry-terms.edit', compact('inquiryTerm'));
    }

    public function update(Request $request, InquiryTerm $inquiryTerm)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required'
        ]);

        $inquiryTerm->update($data);

        alert()->success('بروزرسانی موفق', 'شرایط فروش با موفقیت بروزرسانی شد');
        return redirect()->route('settings.inquiryTerms.index');
    }

    public function destroy(InquiryTerm $inquiryTerm)
    {
        $inquiryTerm->delete();

        alert()->success('حذف موفق', 'شرایط فروش با موفقیت حذف شد');
        return back();
    }
}
