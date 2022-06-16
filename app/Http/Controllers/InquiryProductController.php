<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Inquiry;
use App\Models\Product;
use Illuminate\Http\Request;

class InquiryProductController extends Controller
{
    public function index(Inquiry $inquiry)
    {
        return view('inquiry-product.index', compact('inquiry'));
    }

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

        $inquiry->products()->create([
            'group_id' => $request['group_id'],
            'model_id' => $request['model_id'],
        ]);

        alert()->success('ثبت موفق', 'ثبت محصول برای استعلام با موفقیت انجام شد');

        return redirect()->route('inquiries.index');
    }
}
