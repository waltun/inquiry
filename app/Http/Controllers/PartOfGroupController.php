<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Part;

class PartOfGroupController extends Controller
{
    public function index(Group $group)
    {
        $parts = Part::query();

        if ($keyword = request('search')) {
            $parts->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('unit', 'LIKE', "%{$keyword}%")
                ->orWhere('price', 'LIKE', "%{$keyword}%");
        }

        if ($keyword = request('code')) {
            $parts = $parts->where('code', 'LIKE', $keyword);
        }

        $parts = $parts->latest()->paginate(25)->except($group->parts->pluck('id')->toArray());

        return view('group-parts.index', compact('parts', 'group'));
    }

    public function store(Group $group, $partId)
    {
        $group->parts()->syncWithoutDetaching($partId);

        alert()->success('ثبت موفق', 'افزودن قطعه به گروه با موفقیت انجام شد');

        return back();
    }
}
