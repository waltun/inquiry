<?php

namespace App\Http\Controllers;

use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CollectionPartController extends Controller
{
    public function index()
    {
        Gate::authorize('part-collection');

        $parts = Part::query();

        if ($keyword = request('search')) {
            $parts->where('collection', true)
                ->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('unit', 'LIKE', "%{$keyword}%")
                ->orWhere('price', 'LIKE', "%{$keyword}%");
        }

        if ($keyword = request('code')) {
            $parts = $parts->where('code', 'LIKE', $keyword)->where('collection', true);
        }

        $parts = $parts->where('collection', true)->latest()->paginate(25);

        return view('collection-parts.index', compact('parts'));
    }

    public function create(Part $collectionPart)
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

        //$parts = $parts->latest()->paginate(25)->except($group->parts->pluck('id')->toArray());
        $parts = $parts->latest()->paginate(25);

        return view('collection-parts.create', compact('parts', 'collectionPart'));
    }

    public function store(Part $collectionPart, Part $part)
    {
        dd($collectionPart, $part);
    }
}
