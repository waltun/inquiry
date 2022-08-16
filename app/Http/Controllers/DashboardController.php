<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $inquiries = Inquiry::where('submit', 0)->where('user_id', auth()->user()->id)->latest()->take(3)->get();
        $submitInquiries = Inquiry::where('submit', 1)->where('archive_at', null)->latest()->take(3)->get();

        return view('dashboard', compact('inquiries', 'submitInquiries'));
    }
}
