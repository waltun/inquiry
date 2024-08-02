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
        $users = User::where('role', 'staff')->orWhere('role', 'admin')->get()->except(auth()->user()->id);

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

        return view('dashboard', compact('todayTodos', 'allTodos', 'receivedTasks', 'sentTasks', 'users'));
    }
}
