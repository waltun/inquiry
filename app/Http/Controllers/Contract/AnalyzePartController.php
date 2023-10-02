<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\ContractProductAmount;
use Illuminate\Http\Request;

class AnalyzePartController extends Controller
{
    public function index()
    {
        $amounts = ContractProductAmount::select('part_id', \DB::raw('SUM(value) as total_amount'))
            ->groupBy('part_id')->where('value', '>', 0)->get();

        return view('contracts.analyze-parts.index', compact('amounts'));
    }
}
