<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\System\Coding;
use App\Models\System\Purchase;
use App\Models\System\Store;
use App\Models\System\SystemCategory;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:purchase')->only(['index']);
        $this->middleware('can:edit-purchase')->only(['edit', 'update']);
        $this->middleware('can:delete-purchase')->only(['destroy']);
        $this->middleware('can:change-status-purchase')->only(['changeStatus']);
        $this->middleware('can:complete-purchase')->only(['complete']);
        $this->middleware('can:add-to-store-purchase')->only(['addToStore']);
        $this->middleware('can:view-purchase')->only(['view', 'purchased']);
    }

    public function index()
    {
        $purchase = Purchase::query();

        if (request()->has('search2') && !is_null($keyword = request('search2'))) {
            $purchase = $purchase->where(function ($query) use ($keyword) {
                $query->where(function ($query) use ($keyword) {
                    $query->where('title', 'LIKE', "%$keyword%")
                        ->orWhere('unit', 'LIKE', "%$keyword%")
                        ->whereNull('coding_id');
                })->orWhere(function ($query) use ($keyword) {
                    $query->whereNotNull('coding_id')->whereHas('coding', function ($query) use ($keyword) {
                        $query->where('title', 'LIKE', "%$keyword%")
                            ->orWhere('unit', 'LIKE', "%$keyword%")
                            ->orWhere('code', 'LIKE', "%$keyword%");
                    });
                });
            });
        }

        if (request()->has('status') && !is_null(request('status'))) {
            $purchase = $purchase->where('status', request('status'));
        }

        if (request()->has('buy_location') && !is_null(request('buy_location'))) {
            $purchase = $purchase->where('buy_location', request('buy_location'));
        }

        if (request()->has('code') && !is_null(request('code'))) {
            if (request('code') == '0') {
                $purchase = $purchase->where('coding_id', '=', null);
            }
            if (request('code') == '1') {
                $purchase = $purchase->where('coding_id', '!=', null);
            }
        }

        $codings = Coding::query();
        if (!is_null(request('category3'))) {
            if (request()->has('category3')) {
                $codings = $codings->whereHas('systemCategories', function ($q) {
                    $q->where('category_id', request('category3'));
                });
            }
        }
        if (is_null(request('category3'))) {
            if (request()->has('category2')) {
                $codings = $codings->whereHas('systemCategories', function ($q) {
                    $q->where('category_id', request('category2'));
                });
            }
        }
        if ($keyword = request('search')) {
            $codings->where('name', 'LIKE', "%$keyword%")
                ->orWhere('code', 'LIKE', "%$keyword%");
        }
        $codings = $codings->orderBy('code', 'ASC')->paginate(20)->withQueryString();

        $categories = SystemCategory::where('parent_id', 0)->with(['children'])->get();
        $date = Jalalian::now();
        $today = $date->getYear() . "-" . $date->getMonth() . "-" . $date->getDay();
        $purchase = $purchase->orderBy('important', 'DESC')->where('status', '!=', 'purchased')->paginate(50)->withQueryString();

        $contracts = Contract::all();

        return view('systems.purchase.index', compact('purchase', 'categories', 'today', 'codings', 'contracts'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'coding_id' => 'nullable',
            'title' => 'required_if:coding_id,null|string|max:255',
            'unit' => 'required_if:coding_id,null|string|max:255',
            'request_quantity' => 'required|numeric',
            'date' => 'nullable|string|max:255',
            'description' => 'nullable',
            'document_number' => 'nullable',
            'buy_location' => 'required|string|max:255',
            'applicant' => 'required|string|max:255',
        ]);

        $data['status'] = 'pending';

        if (!is_null($data['coding_id'])) {
            $data['title'] = null;
            $data['unit'] = null;
        }

        if (!is_null($data['date'])) {
            $explodeDate = explode('-', $data['date']);
            $data['date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        Purchase::create($data);

        alert()->success('ثبت موفق', 'درخواست خرید با موفقیت ثبت شد');

        return redirect()->route('purchase.index');
    }

    public function edit(Purchase $purchase)
    {
        $codings = Coding::query();
        if (!is_null(request('category3'))) {
            if (request()->has('category3')) {
                $codings = $codings->whereHas('systemCategories', function ($q) {
                    $q->where('category_id', request('category3'));
                });
            }
        }
        if (is_null(request('category3'))) {
            if (request()->has('category2')) {
                $codings = $codings->whereHas('systemCategories', function ($q) {
                    $q->where('category_id', request('category2'));
                });
            }
        }
        if ($keyword = request('search')) {
            $codings->where('name', 'LIKE', "%$keyword%")
                ->orWhere('code', 'LIKE', "%$keyword%");
        }
        $codings = $codings->orderBy('code', 'ASC')->paginate(20)->withQueryString();

        $categories = SystemCategory::where('parent_id', 0)->with(['children'])->get();

        $year = jdate($purchase->date)->getYear();
        $month = jdate($purchase->date)->getMonth();
        $day = jdate($purchase->date)->getDay();
        $date = $year . '-' . $month . '-' . $day;

        $contracts = Contract::all();

        return view('systems.purchase.edit', compact('purchase', 'codings', 'categories', 'date', 'contracts'));
    }

    public function update(Request $request, Purchase $purchase)
    {
        $data = $request->validate([
            'coding_id' => 'nullable',
            'title' => 'required_if:coding_id,null|string|max:255',
            'unit' => 'required_if:coding_id,null|string|max:255',
            'request_quantity' => 'required|numeric',
            'date' => 'nullable|string|max:255',
            'description' => 'nullable',
            'document_number' => 'nullable',
            'buy_location' => 'required|string|max:255',
            'applicant' => 'required|string|max:255',
        ]);

        if (!is_null($data['coding_id'])) {
            $data['name'] = null;
            $data['unit'] = null;
        }

        if (!is_null($data['date'])) {
            $explodeDate = explode('-', $data['date']);
            $data['date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        $purchase->update($data);

        alert()->success('بروزرسانی موفق', 'درخواست خرید مورد نظر با موفقیت بروزرسانی شد');

        return redirect()->route('purchase.index');
    }

    public function destroy(Request $request)
    {
        $purchase = Purchase::find($request->id);

        $purchase->delete();

        alert()->success('حذف موفق', 'لیست خرید با موفقیت حذف شد');
    }

    public function changeStatus(Request $request)
    {
        foreach ($request->purchase_ids as $index => $id) {
            $purchase = Purchase::find($id);

            $purchase->update([
                'accepted_quantity' => $request->accepted_quantity[$index],
                'important' => $request->important[$index],
            ]);

            if ($request->status[$index] == 'accepted' && $purchase->accepted_quantity > 0) {
                $purchase->status = $request->status[$index];
                $purchase->save();
            } else {
                $purchase->status = $request->status[$index];
                $purchase->save();
            }
        }

        alert()->success('ثبت موفق', 'وضعیت و تعداد با موفقیت تغییر کردند');

        return back();
    }

    public function complete()
    {
        $purchase = Purchase::query();

        if (request()->has('search2') && !is_null($keyword = request('search2'))) {
            $purchase = $purchase->where(function ($query) use ($keyword) {
                $query->where(function ($query) use ($keyword) {
                    $query->where('title', 'LIKE', "%$keyword%")
                        ->orWhere('unit', 'LIKE', "%$keyword%")
                        ->whereNull('coding_id');
                })->orWhere(function ($query) use ($keyword) {
                    $query->whereNotNull('coding_id')->whereHas('coding', function ($query) use ($keyword) {
                        $query->where('title', 'LIKE', "%$keyword%")
                            ->orWhere('unit', 'LIKE', "%$keyword%")
                            ->orWhere('code', 'LIKE', "%$keyword%");
                    });
                });
            });
        }

        if (request()->has('status') && !is_null(request('status'))) {
            $purchase = $purchase->where('status', request('status'));
        }

        if (request()->has('buy_location') && !is_null(request('buy_location'))) {
            $purchase = $purchase->where('buy_location', request('buy_location'));
        }

        if (request()->has('code') && !is_null(request('code'))) {
            if (request('code') == '0') {
                $purchase = $purchase->where('coding_id', '=', null);
            }
            if (request('code') == '1') {
                $purchase = $purchase->where('coding_id', '!=', null);
            }
        }

        $date = Jalalian::now();
        $today = $date->getYear() . "-" . $date->getMonth() . "-" . $date->getDay();

        $purchase = $purchase->orderBy('store', 'ASC')->where('status', '=', 'purchased')->paginate(50);

        return view('systems.purchase.complete', compact('purchase', 'today'));
    }

    public function addToStore(Request $request, Purchase $purchase)
    {
        $data = $request->validate([
            'date' => 'required|string|max:255',
            'store' => 'required|integer',
            'delivery' => 'nullable|string|max:255',
        ]);

        if (!is_null($data['date'])) {
            $explodeDate = explode('-', $data['date']);
            $data['date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        if (!is_null($purchase->coding_id)) {
            $coding = Coding::find($purchase->coding_id);
        }

        Store::create([
            'name' => $purchase->title,
            'quantity' => $purchase->accepted_quantity,
            'seller' => $purchase->seller,
            'delivery' => $data['delivery'],
            'unit' => $purchase->unit,
            'status' => 'purchase',
            'qc' => 'pending',
            'description' => $purchase->description,
            'store' => $data['store'],
            'date' => $data['date'],
            'coding_id' => !is_null($purchase->coding_id) ? $coding->id : null,
            'code' => $purchase->store_code
        ]);

        $purchase->store = true;
        $purchase->save();

        alert()->success('ثبت موفق', 'اقلام با موفقیت به اقلام ورودی اضافه شدند');

        return back();
    }

    public function view()
    {
        $purchase = Purchase::query();

        if (request()->has('search2') && !is_null($keyword = request('search2'))) {
            $purchase = $purchase->where(function ($query) use ($keyword) {
                $query->where(function ($query) use ($keyword) {
                    $query->where('title', 'LIKE', "%$keyword%")
                        ->orWhere('unit', 'LIKE', "%$keyword%")
                        ->whereNull('coding_id');
                })->orWhere(function ($query) use ($keyword) {
                    $query->whereNotNull('coding_id')->whereHas('coding', function ($query) use ($keyword) {
                        $query->where('title', 'LIKE', "%$keyword%")
                            ->orWhere('unit', 'LIKE', "%$keyword%")
                            ->orWhere('code', 'LIKE', "%$keyword%");
                    });
                });
            });
        }

        if (request()->has('status') && !is_null(request('status'))) {
            $purchase = $purchase->where('status', request('status'));
        }

        if (request()->has('buy_location') && !is_null(request('buy_location'))) {
            $purchase = $purchase->where('buy_location', request('buy_location'));
        }

        if (request()->has('code') && !is_null(request('code'))) {
            if (request('code') == '0') {
                $purchase = $purchase->where('coding_id', '=', null);
            }
            if (request('code') == '1') {
                $purchase = $purchase->where('coding_id', '!=', null);
            }
        }

        $date = Jalalian::now();
        $today = $date->getYear() . "-" . $date->getMonth() . "-" . $date->getDay();

        $purchase = $purchase->orderBy('important', 'DESC')->orderBy('store', 'ASC')->where('status', '=', 'accepted')->paginate(50);

        return view('systems.purchase.view', compact('purchase', 'today'));
    }

    public function purchased(Request $request, Purchase $purchase)
    {
        $request->validate([
            'seller' => 'required|string|max:255',
            'store_code' => 'required|string|max:255',
        ]);

        $purchase->status = 'purchased';
        $purchase->seller = $request->seller;
        $purchase->store_code = $request->store_code;
        $purchase->save();

        alert()->success('ثبت موفق', 'اقلام با موفقیت خریداری شدند');

        return back();
    }

    public function restorePurchased(Purchase $purchase)
    {
        $purchase->status = 'accepted';
        $purchase->save();

        alert()->success('بازگردانی موفق', 'اقلام با موفقیت به لیست خرید اضافه بازگردانی شدند');

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
