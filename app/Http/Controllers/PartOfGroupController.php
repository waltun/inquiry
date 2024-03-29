<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Group;
use App\Models\Part;
use Illuminate\Support\Facades\Gate;

class PartOfGroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:part-of-group')->only(['index', 'store']);
    }

    public function index(Group $group)
    {
        $parts = Part::query();
        $categories = Category::where('parent_id', 0)->get();

        if ($keyword = request('search')) {
            $parts->where('name', 'LIKE', "%{$keyword}%")
                ->whereNotIn('id', $group->parts->pluck('id'));
        }

        if (!is_null(request('category3'))) {
            if (request()->has('category3')) {
                $parts = $parts->whereHas('categories', function ($q) {
                    $q->where('category_id', request('category3'));
                });
            }
        }

        if (is_null(request('category3'))) {
            if (request()->has('category2')) {
                $parts = $parts->whereHas('categories', function ($q) {
                    $q->where('category_id', request('category2'));
                });
            }
        }

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
