<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Group;
use App\Models\Modell;
use App\Models\Part;
use Illuminate\Http\Request;

class PartOfModellController extends Controller
{
    public function index(Modell $modell)
    {
        $parts = Part::query();
        $group = Group::find($modell->group_id);
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
            $parts = $parts->whereHas('categories', function ($q) {
                $q->where('category_id', request('category'));
            })->where('collection', false);
        }

        //$parts = $parts->latest()->get()->except($modell->parts->pluck('id')->toArray());
        $parts = $parts->whereNotIn('id', $modell->parts->pluck('id'))->latest()->paginate(25);

        return view('modell-parts.index', compact('parts', 'modell', 'group', 'categories'));
    }

    public function store(Modell $modell, $partId)
    {
        $modell->parts()->syncWithoutDetaching($partId);

        alert()->success('ثبت موفق', 'افزودن قطعه به مدل با موفقیت انجام شد');

        return back();
    }
}
