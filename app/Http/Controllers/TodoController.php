<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:todos')->only(['index']);
        $this->middleware('can:create-todo')->only(['create', 'store']);
        $this->middleware('can:edit-todo')->only(['edit', 'update']);
        $this->middleware('can:delete-todo')->only(['destroy']);
    }

    public function index()
    {
        $todos = auth()->user()->todos()->latest()->paginate(25);

        $unCompleteTodos = auth()->user()->todos()->where('done', false)->where('date', '<=', now()->subDays(1))->get();
        foreach ($unCompleteTodos as $unCompleteTodo) {
            $unCompleteTodo->date = now();
            $unCompleteTodo->save();
        }

        return view('todos.index', compact('todos'));
    }

    public function create()
    {
        return view('todos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|string|max:255',
            'description' => 'nullable'
        ]);

        if (!is_null($data['date'])) {
            $explodeDate = explode('/', $data['date']);
            $data['date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        auth()->user()->todos()->create($data);

        alert()->success('ثبت موفق', 'ثبت کار جدید با موفقیت انجام شد');

        return redirect()->route('todos.index');
    }

    public function edit(Todo $todo)
    {
        $day = jdate($todo->date)->getDay();
        $month = jdate($todo->date)->getMonth();
        $year = jdate($todo->date)->getYear();
        $date = $year . '/' . $month . '/' . $day;

        return view('todos.edit', compact('todo', 'date'));
    }

    public function update(Request $request, Todo $todo)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|string|max:255',
            'description' => 'nullable'
        ]);

        if (!is_null($data['date'])) {
            $explodeDate = explode('/', $data['date']);
            $data['date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        $todo->update($data);

        alert()->success('بروزرسانی موفق', 'بروزرسانی کار با موفقیت انجام شد');

        return redirect()->route('todos.index');
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        alert()->success('حذف موفق', 'حذف کار با موفقیت انجام شد');

        return back();
    }

    public function markAsDone(Todo $todo)
    {
        $todo->done = true;
        $todo->save();

        alert()->success('اتمام موفق', 'اتمام کار با موفقیت انجام شد');

        return back();
    }
}
