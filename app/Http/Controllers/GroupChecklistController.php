<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Checklist;
use Illuminate\Http\Request;

class GroupChecklistController extends Controller
{
    public function index(Group $group)
    {
        $checklists = $group->checklists()->orderBy('sort', 'ASC')->get();
        $allChecklists = Checklist::all();

        return view('groups.qc-checklist.index', compact('group', 'checklists', 'allChecklists'));
    }

    public function store(Request $request, Group $group)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $sort = 0;
        if ($group->qcChecklists->isEmpty()) {
            $sort = 1;
        } else {
            $maxSort = $group->checklists()->max('sort');
            $sort = $maxSort + 1;
        }

        $checklist = Checklist::firstOrCreate($data);

        $group->checklists()->attach($checklist->id, [
            'sort' => $sort,
        ]);

        alert()->success('ثبت موفق', 'چک لیست با موفقیت ثبت شد');

        return back();
    }

    public function storeSort(Request $request, Group $group)
    {
        $request->validate([
            'sorts' => 'array',
            'sorts.*' => 'nullable|numeric',
        ]);

        foreach ($group->checklists()->orderBy('sort', 'ASC')->get() as $index => $checklist) {
            $checklist->pivot->sort = $request->sorts[$index];
            $checklist->pivot->save();
        }

        alert()->success('ثبت موفق', 'Sort با موفقیت ثبت شد');

        return back();
    }

    public function destroy(Request $request)
    {
        $checklist = Checklist::find($request->checklist_id);
        $group = Group::find($request->group_id);

        $group->checklists()->detach($checklist->id);

        alert()->success('حذف موفق', 'چک لیست با موفقیت حذف شد');
    }
}
