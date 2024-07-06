<?php

namespace App\Http\Controllers;

use App\Exceptions\CoreException;
use App\Models\Inquiry;
use App\Models\Task;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        //throw new CoreException('Laravel Can Not be Loaded!');

        $users = User::where('role', 'staff')->orWhere('role', 'admin')->get()->except(auth()->user()->id);

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

        $sentTasks = Task::query();

        if (!is_null(request('level')) && request()->has('level')) {
            $sentTasks->where('level', request('level'));
        }

        if (!is_null(request('receiver_id')) && request()->has('receiver_id')) {
            $sentTasks->where('receiver_id', request('receiver_id'));
        }

        $sentTasks = $sentTasks->where('user_id', auth()->user()->id)->get();

        if (!Session::has('modal_shown') || !Session::has('last_modal_displayed')) {
            Session::put('modal_shown', true);
            Session::put('last_modal_displayed', now()->timestamp);

            return view('dashboard', compact('inquiries', 'submitInquiries', 'todayTodos', 'allTodos', 'receivedTasks', 'sentTasks', 'users'))->with('showModal', true);
        }

        $lastDisplayedTimestamp = Session::get('last_modal_displayed');
        $currentTimestamp = now()->timestamp;
        $hoursInSeconds = 3 * 60 * 60;

        if (($currentTimestamp - $lastDisplayedTimestamp) >= $hoursInSeconds) {
            Session::put('last_modal_displayed', now()->timestamp);

            return view('dashboard', compact('inquiries', 'submitInquiries', 'todayTodos', 'allTodos', 'receivedTasks', 'sentTasks', 'users'))->with('showModal', true);
        }

        return view('dashboard', compact('inquiries', 'submitInquiries', 'todayTodos', 'allTodos', 'receivedTasks', 'sentTasks', 'users'))->with('showModal', false);
    }
}
