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

        $todos = auth()->user()->todos()->whereBetween('date', [now()->startOfDay(), now()->endOfDay()->addDays(7)])->latest()->get();

        $unCompleteTodos = auth()->user()->todos()->where('done', false)->where('date', '<=', now()->subDays(1))->get();
        foreach ($unCompleteTodos as $unCompleteTodo) {
            $unCompleteTodo->date = now();
            $unCompleteTodo->save();
        }

        return view('dashboard', compact('inquiries', 'submitInquiries', 'todos'));
    }
}
