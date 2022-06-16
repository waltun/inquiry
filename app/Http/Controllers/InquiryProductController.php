<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryProductController extends Controller
{
    public function create(Inquiry $inquiry)
    {
        $groups = Group::all();
        return view('inquiry-product.create', compact('groups', 'inquiry'));
    }

    public function store(Request $request, Inquiry $inquiry)
    {
        $request->validate([
            'group_id' => 'required|integer',
            'model_id' => 'required|integer',
        ]);

        $inquiry->groups()->attach($request['group_id'], [
            'model_id' => $request['model_id']
        ]);

        alert()->success('ثبت موفق', 'ثبت محصول برای استعلام با موفقیت انجام شد');

        return redirect()->route('inquiries.index');
    }
}
