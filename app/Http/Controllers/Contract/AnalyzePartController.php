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
        $amounts = ContractProductAmount::query();

        $amounts = $amounts->where('status', '=', 'ordered')
            ->orWhere('status', '=', null)->where('value', '>', 0)->get();

        if (request()->has('buyer_manage') && !is_null(request('buyer_manage'))) {
            $amounts = $amounts->where('buyer_manage', request('buyer_manage'));
        }

        if (request()->has('search') && !is_null($keyword = request('search'))) {
            $parts = collect([]);
            foreach ($amounts as $amount) {
                $part = Part::where('name', 'LIKE', "%{$keyword}%")->where('id', $amount->part_id)->first();
                if (!is_null($part)) {
                    $parts->push($part->id);
                }
            }
            $parts = $parts->toArray();
            $amounts = $amounts->whereIn('part_id', $parts);
        }

        $values = [];

        foreach ($amounts as $amount) {
            $values[$amount->part_id] = [
                'value' => 0,
                'buyer' => $amount->buyer,
                'buyer_manage' => $amount->buyer_manage,
                'status' => $amount->status
            ];
        }

        foreach ($amounts as $amount) {
            $values[$amount->part_id]['value'] += $amount->value * $amount->product->quantity;
        }

        return view('contracts.analyze-parts.index', compact('values', 'amounts'));
    }

    public function store(Request $request)
    {
        foreach ($request->part_ids as $index => $id) {
            $amounts = ContractProductAmount::where('part_id', $id)->get();

            foreach ($amounts as $amount) {
                $amount->buyer_manage = $request->buyer_manage[$index];
                $amount->status = $request->status[$index];
                $amount->save();
            }
        }

        alert()->success('ثبت موفق', 'اطلاعات با موفقیت ثبت شد');

        return back();
    }
}
