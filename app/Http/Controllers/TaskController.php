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

        $sentTasks = Task::query();

        if (!is_null(request('level')) && request()->has('level')) {
            $sentTasks->where('level', request('level'));
        }

        if (!is_null(request('receiver_id')) && request()->has('receiver_id')) {
            $sentTasks->where('receiver_id', request('receiver_id'));
        }

        $sentTasks = $sentTasks->where('user_id', auth()->user()->id)->get();

        $users = User::where('role', 'staff')->orWhere('role', 'admin')->get()->except(auth()->user()->id);

        return view('tasks.index', compact('receivedTasks', 'sentTasks', 'users'));
    }

    public function sent()
    {
        $sentTasks = auth()->user()->tasks()->latest()->get();

        return view('tasks.sent', compact('sentTasks'));
    }

    public function create()
    {
        $receivers = User::where('role', 'staff')->orWhere('role', 'admin')->orWhere('role', 'logistics')->get()->except(auth()->user()->id);
        return view('tasks.create', compact('receivers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|string|max:255',
            'level' => 'required|in:high,medium,low',
            'receivers' => 'required|array',
            'description' => 'nullable',
            'file' => 'nullable|file',
            'extension_days' => 'required|numeric',
            'extension_count' => 'required|numeric',
        ]);

        if (!is_null($data['date'])) {
            $explodeDate = explode('/', $data['date']);
            $data['date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        foreach ($data['receivers'] as $receiverId) {
            $receiver = User::findOrFail($receiverId);

            if (isset($request['file'])) {
                $path = '../public_html/files/tasks/';
                $savePath = '/files/tasks/';

                $fileNewName = 'Task-' . $receiver->phone . '-(' . rand(1, 99) . ')' . '.' . $request->file->extension();
                $request->file->move($path, $fileNewName);

                $finalFile = $savePath . $fileNewName;

                $data['file'] = $finalFile;
            }

            Task::create([
                'title' => $data['title'],
                'date' => $data['date'],
                'level' => $data['level'],
                'receiver_id' => $receiverId,
                'description' => $data['description'],
                'file' => $data['file'] ?? null,
                'user_id' => auth()->user()->id,
                'done' => false,
                'done_at' => null,
                'extension_days' => $data['extension_days'],
                'extension_count' => $data['extension_count'],
            ]);
        }

        alert()->success('ثبت موفق', 'ثبت وظیفه جدید با موفقیت انجام شد');

        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        $receivers = User::where('role', 'staff')->orWhere('role', 'admin')->orWhere('role', 'logistics')->get()->except(auth()->user()->id);

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
            'description' => 'nullable',
            'extension_days' => 'required|numeric',
            'extension_count' => 'required|numeric',
        ]);

        if (!is_null($data['date'])) {
            $explodeDate = explode('/', $data['date']);
            $data['date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        $task->update($data);

        alert()->success('بروزرسانی موفق', 'بروزرسانی وظیفه با موفقیت انجام شد');

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        alert()->success('حذف موفق', 'حذف وظیفه با موفقیت انجام شد');

        return back();
    }

    public function markAsDone(Task $task)
    {
        $task->done = true;
        $task->done_at = now();
        $task->save();

        alert()->success('اتمام موفق', 'اتمام وظیفه با موفقیت انجام شد');

        return back();
    }

    public function review(Task $task)
    {
        $task->done = false;
        $task->done_at = null;
        $task->save();

        alert()->success('بازنگری موفق', 'بازنگری وظیفه با موفقیت انجام شد');

        return back();
    }

    public function reply(Task $task)
    {
        return view('tasks.reply', compact('task'));
    }

    public function storeReply(Request $request, Task $task)
    {
        $request->validate([
            'reply' => 'required',
        ]);

        $task->update([
            'reply' => $request->reply,
        ]);

        alert()->success('ثبت موفق', 'ثبت پاسخ وظیفه با موفقیت انجام شد');

        return redirect()->route('tasks.index');
    }

    public function extension(Request $request, Task $task)
    {
        $data = $request->validate([
            'extension_days_request' => 'required|integer'
        ]);

        if ($task->extension_usage <= $task->extension_count) {
            $task->extension_days_request = $data['extension_days_request'];
            $task->extension_days_request_at = now();
            $task->extension_usage++;
            $task->save();

            alert()->success('تمدید موفق', 'تمدید وظیفه با موفقیت انجام شد');

            return back();
        }

        alert()->error('خطا', 'تعداد دفعات تمدیدی شما به پایان رسیده!');
    }
}
