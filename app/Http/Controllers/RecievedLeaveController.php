<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;

class RecievedLeaveController extends Controller
{
    public function index()
    {
        $leaves = Leave::latest()->paginate(20);
        return view('recieved-leaves.index', compact('leaves'));
    }

    public function update(Leave $leaf)
    {
        $leaf->confirm = true;
        $leaf->save();

        alert()->success('ثبت موفق', 'تایید مرخصی با موفقیت انجام شد');

        return back();
    }
}
