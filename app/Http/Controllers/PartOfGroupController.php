<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Group;
use App\Models\Part;

class PartOfGroupController extends Controller
{
    public function index(Group $group)
    {
        $parts = Part::query();
        $categories = Category::all();

        if ($keyword = request('search')) {
            $parts->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('unit', 'LIKE', "%{$keyword}%")
                ->orWhere('price', 'LIKE', "%{$keyword}%");
        }

        if ($keyword = request('code')) {
            $parts = $parts->where('code', 'LIKE', $keyword);
        }

        if (request()->has('category')) {
            $parts = $parts->where('collection', false)->where('category_id', request('category'));
        }

        //$parts = $parts->latest()->get()->except($group->parts->pluck('id')->toArray());
        $parts = $parts->whereNotIn('id', $group->parts->pluck('id'))->latest()->paginate(25);

        return view('group-parts.index', compact('parts', 'group', 'categories'));
    }

    public function store(Group $group, $partId)
    {
        $group->parts()->syncWithoutDetaching($partId);

        alert()->success('ثبت موفق', 'افزودن قطعه به گروه با موفقیت انجام شد');

        return back();
    }
}
