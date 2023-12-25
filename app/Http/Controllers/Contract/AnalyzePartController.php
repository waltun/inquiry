<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\ContractProductAmount;
use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class AnalyzePartController extends Controller
{
    public function index()
    {
        $amounts = ContractProductAmount::query()->with(['product', 'product.contract']);

        $amounts = $amounts->where('status', '=', 'ordered')
            ->orWhere('status', '=', null)->where('value', '>', 0)->get();

        if (request()->has('buyer_manage') && !is_null(request('buyer_manage'))) {
            $amounts = $amounts->where('buyer_manage', request('buyer_manage'));
        }

        if (request()->has('search') && !is_null($keyword = request('search'))) {
            $partIds = Part::where('name', 'LIKE', "%$keyword%")->pluck('id')->toArray();
            $amounts = $amounts->whereIn('part_id', $partIds);
        }

        $values = [];

        foreach ($amounts as $amount) {
            if ($amount->product->contract->recipe) {
                $values[$amount->part_id] = [
                    'value' => 0,
                    'buyer' => $amount->buyer,
                    'buyer_manage' => $amount->buyer_manage,
                    'status' => $amount->status
                ];
            }
        }

        foreach ($amounts as $amount) {
            if ($amount->product->contract->recipe) {
                $values[$amount->part_id]['value'] += $amount->value * $amount->product->quantity;
            }
        }

        $uniqueAmounts = ContractProductAmount::all()->unique('contract_product_id');
        $searchContracts = collect();

        foreach ($uniqueAmounts as $uniqueAmount) {
            $searchContracts->push($uniqueAmount->product->contract);
        }

        $searchContracts = $searchContracts->unique('id');

        $paginator = $this->getAwarePaginator($values);

        return view('contracts.analyze-parts.index', compact('amounts', 'searchContracts', 'paginator'));
    }

    public function store(Request $request)
    {
        $amounts = ContractProductAmount::where('part_id', $request->part_id)->get();

        foreach ($amounts as $amount) {
            if ($amount->product->contract_id == $request->contract_id) {
                $amount->buyer_manage = $request->buyer_manage;
                $amount->status = $request->status;
                $amount->user_id = $request->user_id;
                $amount->save();
            }
        }

        alert()->success('ثبت موفق', 'اطلاعات با موفقیت ثبت شد');

        return back();
    }

    /**
     * @param array $values
     * @return LengthAwarePaginator
     */
    public function getAwarePaginator(array $values): LengthAwarePaginator
    {
        $valuesCollection = collect($values);
        $perPage = 25;
        $page = request('page', 1);
        $paginatedValues = $valuesCollection->slice(($page - 1) * $perPage, $perPage);
        $paginator = new LengthAwarePaginator($paginatedValues, $valuesCollection->count(), $perPage, $page);
        $paginator->withPath(route('contracts.analyze-parts.index'))->withQueryString();
        return $paginator;
    }
}
