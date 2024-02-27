<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Task;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        $inquiries = Inquiry::where('submit', 0)->where('user_id', auth()->user()->id)->latest()->take(3)->get();
        $submitInquiries = Inquiry::where('submit', 1)->where('archive_at', null)->where('user_id', auth()->user()->id)->latest()->take(3)->get();

        $allTodos = auth()->user()->todos()->whereBetween('date', [now()->addDays(1)->startOfDay(), now()->endOfDay()->addDays(8)])->latest()->get();
        $todayTodos = auth()->user()->todos()->whereBetween('date', [now()->startOfDay(), now()->endOfDay()])->where('done', false)->get();

        $unCompleteTodos = auth()->user()->todos()->where('done', false)->where('date', '<=', now())->get();
        foreach ($unCompleteTodos as $unCompleteTodo) {
            $unCompleteTodo->date = now();
            $unCompleteTodo->save();
        }

        $receivedTasks = Task::where('receiver_id', auth()->user()->id)->latest()->get();
        $sentTasks = auth()->user()->tasks()->latest()->get();

        if (!Session::has('modal_shown') || !Session::has('last_modal_displayed')) {
            Session::put('modal_shown', true);
            Session::put('last_modal_displayed', now()->timestamp);

            return view('dashboard', compact('inquiries', 'submitInquiries', 'todayTodos', 'allTodos', 'receivedTasks', 'sentTasks'))->with('showModal', true);
        }

        $lastDisplayedTimestamp = Session::get('last_modal_displayed');
        $currentTimestamp = now()->timestamp;
        $hoursInSeconds = 3 * 60 * 60;

        if (($currentTimestamp - $lastDisplayedTimestamp) >= $hoursInSeconds) {
            Session::put('last_modal_displayed', now()->timestamp);

            return view('dashboard', compact('inquiries', 'submitInquiries', 'todayTodos', 'allTodos', 'receivedTasks', 'sentTasks'))->with('showModal', true);
        }

        return view('dashboard', compact('inquiries', 'submitInquiries', 'todayTodos', 'allTodos', 'receivedTasks', 'sentTasks'))->with('showModal', false);
    }
}
