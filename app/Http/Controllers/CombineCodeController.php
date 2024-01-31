<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Models\System\Coding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CombineCodeController extends Controller
{
    public function index()
    {
        $parts = Part::query();
        $codings = Coding::query();

        if ($keyword = request('search')) {
            $parts->where('name', 'LIKE', "%{$keyword}%");
            $codings->where('name', 'LIKE', "%{$keyword}%");
        }

        $parts = $parts->orderBy('name')->where('coil', false)->paginate(25);
        $codings = $codings->orderBy('name')->paginate(25);

        return view('combine-codes.index', compact('parts', 'codings'));
    }
}
