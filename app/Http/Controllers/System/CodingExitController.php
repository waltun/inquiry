<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\Coding;
use App\Models\System\CodingExit;
use App\Models\System\SystemCategory;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class CodingExitController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:coding-exits')->only(['index']);
        $this->middleware('can:edit-coding-exits')->only(['edit', 'update']);
        $this->middleware('can:delete-coding-exits')->only(['destroy']);
    }

    public function index()
    {
        $exits = CodingExit::query();

        if (request()->has('search2') && !is_null($keyword = request('search2'))) {
            $exits = $exits->where(function ($query) use ($keyword) {
                $query->where(function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%{$keyword}%")
                        ->orWhere('unit', 'LIKE', "%{$keyword}%")
                        ->whereNull('coding_id');
                })->orWhere(function ($query) use ($keyword) {
                    $query->whereNotNull('coding_id')->whereHas('coding', function ($query) use ($keyword) {
                        $query->where('name', 'LIKE', "%{$keyword}%")
                            ->orWhere('unit', 'LIKE', "%{$keyword}%");
                    });
                });
            });
        }

        if (request()->has('code') && !is_null(request('code'))) {
            if (request('code') == '0') {
                $exits = $exits->where('coding_id', '=', null);
            }
            if (request('code') == '1') {
                $exits = $exits->where('coding_id', '!=', null);
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
            $codings->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('code', 'LIKE', "%{$keyword}%");
        }
        $codings = $codings->orderBy('code', 'ASC')->paginate(20)->withQueryString();

        $categories = SystemCategory::where('parent_id', 0)->with(['children'])->get();
        $date = Jalalian::now();
        $today = $date->getYear() . "-" . $date->getMonth() . "-" . $date->getDay();
        $exits = $exits->orderBy('return_date', 'DESC')->paginate(50)->withQueryString();

        return view('systems.coding-exits.index', compact('exits', 'categories', 'today', 'codings'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'coding_id' => 'nullable',
            'name' => 'required_if:coding_id,null|string|max:255',
            'unit' => 'required_if:coding_id,null|string|max:255',
            'quantity' => 'required|numeric',
            'return_date' => 'nullable|string|max:255',
            'getter_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'car_number' => 'nullable|string|max:255',
            'description' => 'nullable'
        ]);

        if (!is_null($data['coding_id'])) {
            $data['name'] = null;
            $data['unit'] = null;
        }

        if (!is_null($data['return_date'])) {
            $explodeDate = explode('-', $data['return_date']);
            $data['return_date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        CodingExit::create($data);

        alert()->success('ثبت موفق', 'خروج موقت با موفقیت ثبت شد');

        return redirect()->route('coding-exits.index');
    }

    public function edit(CodingExit $coding_exit)
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
            $codings->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('code', 'LIKE', "%{$keyword}%");
        }
        $codings = $codings->orderBy('code', 'ASC')->paginate(20)->withQueryString();

        $categories = SystemCategory::where('parent_id', 0)->with(['children'])->get();

        $year = jdate($coding_exit->return_date)->getYear();
        $month = jdate($coding_exit->return_date)->getMonth();
        $day = jdate($coding_exit->return_date)->getDay();
        $date = $year . '-' . $month . '-' . $day;

        return view('systems.coding-exits.edit', compact('coding_exit', 'codings', 'categories', 'date'));
    }

    public function update(Request $request, CodingExit $coding_exit)
    {
        $data = $request->validate([
            'coding_id' => 'nullable',
            'name' => 'required_if:coding_id,null|string|max:255',
            'unit' => 'required_if:coding_id,null|string|max:255',
            'quantity' => 'required|numeric',
            'return_date' => 'nullable|string|max:255',
            'getter_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'car_number' => 'nullable|string|max:255',
            'description' => 'nullable'
        ]);

        if (!is_null($data['coding_id'])) {
            $data['name'] = null;
            $data['unit'] = null;
        }

        if (!is_null($data['return_date'])) {
            $explodeDate = explode('-', $data['return_date']);
            $data['return_date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        $coding_exit->update($data);

        alert()->success('بروزرسانی موفق', 'کالای مورد نظر با موفقیت بروزرسانی شد');

        return redirect()->route('coding-exits.index');
    }

    public function destroy(Request $request)
    {
        $exit = CodingExit::find($request->id);

        $exit->delete();

        alert()->success('حذف موفق', 'اقلام ورودی با موفقیت حذف شد');
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
