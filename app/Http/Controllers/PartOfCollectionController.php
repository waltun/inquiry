<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Part;
use Illuminate\Http\Request;

class PartOfCollectionController extends Controller
{
    public function index(Collection $collection)
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

        $parts = $parts->latest()->paginate(25)->except($collection->parts->pluck('id')->toArray());

        return view('collection-parts.index', compact('parts', 'collection'));
    }

    public function store(Collection $collection, $partId)
    {
        $collection->parts()->syncWithoutDetaching($partId);

        alert()->success('ثبت موفق', 'افزودن قطعه به مجموعه با موفقیت انجام شد');

        return back();
    }
}
