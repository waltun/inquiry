<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:tasks')->only(['index']);
        $this->middleware('can:create-task')->only(['create', 'store']);
        $this->middleware('can:edit-task')->only(['edit', 'update']);
        $this->middleware('can:delete-task')->only(['destroy']);
        $this->middleware('can:done-task')->only(['markAsDone']);
    }

    public function index()
    {
        $receivedTasks = Task::where('receiver_id', auth()->user()->id)->latest()->get();
        $sentTasks = auth()->user()->tasks()->latest()->get();

        return view('tasks.index', compact('receivedTasks', 'sentTasks'));
    }

    public function sent()
    {
        $sentTasks = auth()->user()->tasks()->latest()->get();

        return view('tasks.sent', compact('sentTasks'));
    }

    public function create()
    {
        $receivers = User::where('role', 'staff')->orWhere('role', 'admin')->get()->except(auth()->user()->id);
        return view('tasks.create', compact('receivers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|string|max:255',
            'level' => 'required|in:high,medium,low',
            'receiver_id' => 'required|integer',
            'description' => 'nullable'
        ]);

        if (!is_null($data['date'])) {
            $explodeDate = explode('/', $data['date']);
            $data['date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        auth()->user()->tasks()->create($data);

        alert()->success('ثبت موفق', 'ثبت تسک جدید با موفقیت انجام شد');

        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        $receivers = User::where('role', 'staff')->orWhere('role', 'admin')->get()->except(auth()->user()->id);

        $day = jdate($task->date)->getDay();
        $month = jdate($task->date)->getMonth();
        $year = jdate($task->date)->getYear();
        $date = $year . '/' . $month . '/' . $day;

        return view('tasks.edit', compact('receivers', 'task', 'date'));
    }

    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|string|max:255',
            'level' => 'required|in:high,medium,low',
            'receiver_id' => 'required|integer',
            'description' => 'nullable'
        ]);

        if (!is_null($data['date'])) {
            $explodeDate = explode('/', $data['date']);
            $data['date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        $task->update($data);

        alert()->success('بروزرسانی موفق', 'بروزرسانی تسک با موفقیت انجام شد');

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        alert()->success('حذف موفق', 'حذف تسک با موفقیت انجام شد');

        return back();
    }

    public function markAsDone(Task $task)
    {
        $task->done = true;
        $task->save();

        alert()->success('اتمام موفق', 'اتمام تسک با موفقیت انجام شد');

        return back();
    }

    public function review(Task $task)
    {
        $task->done = false;
        $task->save();

        alert()->success('بازنگری موفق', 'بازنگری تسک با موفقیت انجام شد');

        return back();
    }
}
