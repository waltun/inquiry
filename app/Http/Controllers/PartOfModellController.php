<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Group;
use App\Models\Modell;
use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PartOfModellController extends Controller
{
    public function index(Modell $modell)
    {
        Gate::authorize('groups');

        $parts = Part::query();
        $group = Group::find($modell->group_id);
        $categories = Category::where('parent_id', 0)->get();

        if ($keyword = request('search')) {
            $parts->where('name', 'LIKE', "%{$keyword}%")
                ->whereNotIn('id', $modell->parts->pluck('id'));
        }

        if (request()->has('category3')) {
            $parts = $parts->whereHas('categories', function ($q) {
                $q->where('category_id', request('category3'));
            })->where('collection', false)->whereNotIn('id', $modell->parts->pluck('id'));
        }

        //$parts = $parts->latest()->get()->except($modell->parts->pluck('id')->toArray());
        $parts = $parts->whereNotIn('id', $modell->parts->pluck('id'))->latest()->paginate(25);

        return view('modell-parts.index', compact('parts', 'modell', 'group', 'categories'));
    }

    public function store(Modell $modell, $partId)
    {
        Gate::authorize('groups');

        $modell->parts()->syncWithoutDetaching($partId);

        alert()->success('ثبت موفق', 'افزودن قطعه به مدل با موفقیت انجام شد');

        return back();
    }
}
