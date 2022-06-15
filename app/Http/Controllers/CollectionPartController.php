<?php

namespace App\Http\Controllers;

use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        $collectionParts = DB::table('part_part')->where('part_collection_id', $collectionPart->id)->get();

        $parts = $parts->latest()->paginate(25)->except($collectionParts->pluck('part_id')->toArray())
            ->except($collectionPart->id);

        return view('collection-parts.create', compact('parts', 'collectionPart'));
    }

    public function store(Part $collectionPart, Part $part)
    {
        DB::table('part_part')->insert([
            'part_id' => $part->id,
            'part_collection_id' => $collectionPart->id
        ]);

        alert()->success('ثبت موفق', 'افزودن قطعه به مجموعه با موفقیت انجام شد');

        return back();
    }

    public function parts(Part $collectionPart)
    {
        $collectionParts = DB::table('part_part')->where('part_collection_id', $collectionPart->id)->get();

        return view('collection-parts.parts', compact('collectionPart', 'collectionParts'));
    }

    public function destroy(Part $collectionPart, Part $part)
    {
        dd($collectionPart, $part);
    }
}
