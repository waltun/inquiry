<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Todo;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $inquiries = Inquiry::where('submit', 0)->where('user_id', auth()->user()->id)->latest()->take(3)->get();
        $submitInquiries = Inquiry::where('submit', 1)->where('archive_at', null)->where('user_id', auth()->user()->id)->latest()->take(3)->get();

        if (auth()->user()->role == 'admin') {
            $todos = Todo::latest()->paginate(5);
        } else {
            $todos = auth()->user()->todos()->latest()->paginate(5);
        }

        return view('dashboard', compact('inquiries', 'submitInquiries', 'todos'));
    }
}
