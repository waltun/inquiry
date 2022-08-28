<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Group;
use App\Models\Part;
use Illuminate\Support\Facades\Gate;

class PartOfGroupController extends Controller
{
    public function index(Group $group)
    {
        Gate::authorize('groups');

        $parts = Part::query();
        $categories = Category::where('parent_id', 0)->get();

        if ($keyword = request('search')) {
            $parts->where('name', 'LIKE', "%{$keyword}%")
                ->where('coil', false)
                ->whereNotIn('id', $group->parts->pluck('id'));
        }

        if (!is_null(request('category3'))) {
            if (request()->has('category3')) {
                $parts = $parts->whereHas('categories', function ($q) {
                    $q->where('category_id', request('category3'));
                })->where('coil', false);
            }
        }

        if (is_null(request('category3'))) {
            if (request()->has('category2')) {
                $parts = $parts->whereHas('categories', function ($q) {
                    $q->where('category_id', request('category2'));
                })->where('coil', false);
            }
        }

        $parts = $parts->whereNotIn('id', $group->parts->pluck('id'))->where('coil', false)->latest()->paginate(25);

        return view('group-parts.index', compact('parts', 'group', 'categories'));
    }

    public function store(Group $group, $partId)
    {
        Gate::authorize('groups');

        $group->parts()->syncWithoutDetaching($partId);

        alert()->success('ثبت موفق', 'افزودن قطعه به گروه با موفقیت انجام شد');

        return back();
    }
}
