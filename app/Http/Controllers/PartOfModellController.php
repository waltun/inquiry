<?php

namespace App\Http\Controllers;

use App\Models\Modell;
use App\Models\Part;
use Illuminate\Http\Request;

class PartOfModellController extends Controller
{
    public function index(Modell $modell)
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

        $parts = $parts->latest()->get()->except($modell->parts->pluck('id')->toArray());

        return view('modell-parts.index', compact('parts', 'modell'));
    }

    public function store(Modell $modell, $partId)
    {
        $modell->parts()->syncWithoutDetaching($partId);

        alert()->success('ثبت موفق', 'افزودن قطعه به مدل با موفقیت انجام شد');

        return back();
    }
}
