<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Group;
use App\Models\Modell;
use App\Models\Part;
use App\Models\Special;
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

        if (request()->has('calculate') && !is_null(request('calculate'))) {
            $specials = Special::all()->pluck('part_id');
            $parts->where('coil', '=', '1')->where('standard', '!=', '1')
                ->whereIn('id',$specials);
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

        $parts = $parts->whereNotIn('id', $modell->parts->pluck('id'))->latest()->paginate(25)->withQueryString();

        return view('modell-parts.index', compact('parts', 'modell', 'group', 'categories'));
    }

    public function store(Modell $modell, $partId)
    {
        Gate::authorize('groups');

        $sort = 0;
        if ($modell->parts->isEmpty()) {
            $sort = 1;
        } else {
            $part = $modell->parts()->max('sort');
            $sort = $part + 1;
        }

        $modell->parts()->attach($partId, [
            'sort' => $sort
        ]);

        alert()->success('ثبت موفق', 'افزودن قطعه به مدل با موفقیت انجام شد');

        return back();
    }
}
