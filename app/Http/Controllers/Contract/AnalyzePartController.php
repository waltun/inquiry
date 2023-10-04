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
        $amounts = ContractProductAmount::where('value', '>', 0)->get();

        $values = [];

        foreach ($amounts as $amount) {
            if (!$amount->part->collection) {
                $values[$amount->part_id] = 0;
            } else {
                foreach ($amount->part->children as $child) {
                    if ($child->pivot->value > 0) {
                        $values[$child->id] = 0;
                    }
                }
            }
        }

        foreach ($amounts as $amount) {
            if (!$amount->part->collection) {
                $values[$amount->part_id] += $amount->value * $amount->product->quantity;
            } else {
                foreach ($amount->part->children as $child) {
                    if ($child->pivot->value > 0) {
                        $values[$child->id] += $child->pivot->value * $amount->product->quantity;
                    }
                }
            }
        }

        return view('contracts.analyze-parts.index', compact('values', 'amounts'));
    }
}
