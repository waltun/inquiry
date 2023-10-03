<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\ContractProductAmount;
use App\Models\Part;
use Illuminate\Http\Request;

class AnalyzePartController extends Controller
{
    public function index()
    {
//        $amounts = ContractProductAmount::select('part_id', \DB::raw('SUM(value) as total_amount'))
//            ->groupBy('part_id')->where('value', '>', 0)->get();

        $amounts = ContractProductAmount::where('value', '>', 0)->get();

        $partIds = collect([]);
        $values = [];

        foreach ($amounts as $amount) {
            $partIds->push($amount->part_id);
            $values[$amount->part_id] = 0;
        }

        $partIds = $partIds->toArray();

        foreach ($amounts as $amount) {
            if (!$amount->part->collection) {
                if (in_array($amount->part_id, $partIds)) {
                    $values[$amount->part_id] += $amount->value;
                }
            } else {
                foreach ($amount->part->children as $child) {
                    if (in_array($child->id, $partIds)) {
                        $values[$child->id] += $child->pivot->value;
                    }
                }
            }
        }

        return view('contracts.analyze-parts.index', compact('values', 'amounts'));
    }
}
