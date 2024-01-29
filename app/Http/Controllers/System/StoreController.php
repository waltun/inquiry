<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\Coding;
use App\Models\System\Store;
use App\Models\System\SystemCategory;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class StoreController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('can:all-stores')->only(['index']);
//        $this->middleware('can:edit-all-stores')->only(['edit', 'update']);
//        $this->middleware('can:delete-all-stores')->only(['destroy']);
//        $this->middleware('can:change-status-all-stores')->only(['changeStatus']);
//        $this->middleware('can:export-all-stores')->only(['export']);
//    }

    public function index()
    {
        $stores = Store::query();

        if (request()->has('search2') && !is_null($keyword = request('search2'))) {
            $stores = $stores->where(function ($query) use ($keyword) {
                $query->where(function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%{$keyword}%")
                        ->orWhere('unit', 'LIKE', "%{$keyword}%")
                        ->whereNull('coding_id');
                })->orWhere(function ($query) use ($keyword) {
                    $query->whereNotNull('coding_id')->whereHas('coding', function ($query) use ($keyword) {
                        $query->where('name', 'LIKE', "%{$keyword}%")
                            ->orWhere('unit', 'LIKE', "%{$keyword}%")
                            ->orWhere('code', 'LIKE', "%{$keyword}%");
                    });
                });
            });
        }

        if (request()->has('status') && !is_null(request('status'))) {
            $stores = $stores->where('status', request('status'));
        }

        if (request()->has('qc') && !is_null(request('qc'))) {
            $stores = $stores->where('qc', request('qc'));
        }

        if (request()->has('code') && !is_null(request('code'))) {
            if (request('code') == '0') {
                $stores = $stores->where('coding_id', '=', null);
            }
            if (request('code') == '1') {
                $stores = $stores->where('coding_id', '!=', null);
            }
        }

        $codings = Coding::query();
        if (!is_null(request('category3'))) {
            if (request()->has('category3')) {
                $codings = $codings->whereHas('categories', function ($q) {
                    $q->where('category_id', request('category3'));
                });
            }
        }
        if (is_null(request('category3'))) {
            if (request()->has('category2')) {
                $codings = $codings->whereHas('categories', function ($q) {
                    $q->where('category_id', request('category2'));
                });
            }
        }
        if ($keyword = request('search')) {
            $codings->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('code', 'LIKE', "%{$keyword}%");
        }
        $codings = $codings->orderBy('code', 'ASC')->paginate(20)->withQueryString();

        $categories = SystemCategory::where('parent_id', 0)->with(['children'])->get();
        $date = Jalalian::now();
        $today = $date->getYear() . "-" . $date->getMonth() . "-" . $date->getDay();
        $stores = $stores->orderBy('date', 'DESC')->paginate(25);

        return view('systems.stores.index', compact('stores', 'categories', 'today', 'codings'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'coding_id' => 'nullable',
            'name' => 'required_if:coding_id,null|string|max:255',
            'unit' => 'required_if:coding_id,null|string|max:255',
            'quantity' => 'required|numeric',
            'date' => 'nullable|string|max:255',
            'store' => 'required|integer',
            'delivery' => 'nullable|string|max:255',
            'seller' => 'nullable|string|max:255',
            'code' => 'required|numeric',
            'description' => 'nullable'
        ]);

        $data['status'] = 'registering';
        $data['qc'] = 'pending';

        if (!is_null($data['coding_id'])) {
            $data['name'] = null;
            $data['unit'] = null;
        }

        if (!is_null($data['date'])) {
            $explodeDate = explode('-', $data['date']);
            $data['date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        Store::create($data);

        alert()->success('ثبت موفق', 'اقلام ورودی با موفقیت ثبت شد');
        return redirect()->route('stores.index');
    }

    public function edit(Store $store)
    {
        $codings = Coding::query();
        if (!is_null(request('category3'))) {
            if (request()->has('category3')) {
                $codings = $codings->whereHas('categories', function ($q) {
                    $q->where('category_id', request('category3'));
                });
            }
        }
        if (is_null(request('category3'))) {
            if (request()->has('category2')) {
                $codings = $codings->whereHas('categories', function ($q) {
                    $q->where('category_id', request('category2'));
                });
            }
        }
        if ($keyword = request('search')) {
            $codings->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('code', 'LIKE', "%{$keyword}%");
        }
        $codings = $codings->orderBy('code', 'ASC')->paginate(20)->withQueryString();

        $categories = SystemCategory::where('parent_id', 0)->with(['children'])->get();

        $year = jdate($store->date)->getYear();
        $month = jdate($store->date)->getMonth();
        $day = jdate($store->date)->getDay();
        $date = $year . '-' . $month . '-' . $day;

        return view('systems.stores.edit', compact('store', 'codings', 'categories', 'date'));
    }

    public function update(Request $request, Store $store)
    {
        $data = $request->validate([
            'coding_id' => 'nullable',
            'name' => 'required_if:coding_id,null|string|max:255',
            'unit' => 'required_if:coding_id,null|string|max:255',
            'quantity' => 'required|numeric',
            'date' => 'nullable|string|max:255',
            'store' => 'required|integer',
            'delivery' => 'nullable|string|max:255',
            'seller' => 'nullable|string|max:255',
            'code' => 'required|numeric',
            'description' => 'nullable'
        ]);

        if (!is_null($data['coding_id'])) {
            $data['name'] = null;
            $data['unit'] = null;
        }

        if (!is_null($data['date'])) {
            $explodeDate = explode('-', $data['date']);
            $data['date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        $store->update($data);

        alert()->success('بروزرسانی موفق', 'کالای مورد نظر با موفقیت بروزرسانی شد');

        return redirect()->route('stores.index');
    }

    public function destroy(Request $request)
    {
        $store = Store::find($request->id);

        $store->delete();

        alert()->success('حذف موفق', 'اقلام ورودی با موفقیت حذف شد');
    }

    public function changeStatus(Request $request)
    {
        foreach ($request->store_ids as $index => $id) {
            $store = Store::find($id);

            $store->update([
                'status' => $request->status[$index],
                'qc' => $request->qc[$index],
                'store_code' => $request->store_code[$index]
            ]);
        }

        alert()->success('ثبت موفق', 'وضعیت و QC با موفقیت تغییر کردند');

        return back();
    }

    public function searchCategory(Request $request)
    {
        return response([
            'category1' => $request->category1,
            'category2' => $request->category2,
            'category3' => $request->category3,
        ]);
    }

    public function searchText(Request $request)
    {
        return response([
            'text' => $request->text,
        ]);
    }
}
