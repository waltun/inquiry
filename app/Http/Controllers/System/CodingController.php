<?php

namespace App\Http\Controllers\System;

use App\Exports\CodingExport;
use App\Http\Controllers\Controller;
use App\Models\System\Coding;
use App\Models\System\SystemCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Morilog\Jalali\Jalalian;

class CodingController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('can:codings')->only(['index']);
//        $this->middleware('can:create-coding')->only(['create', 'store']);
//        $this->middleware('can:edit-coding')->only(['edit', 'update']);
//        $this->middleware('can:delete-coding')->only(['destroy']);
//        $this->middleware('can:copy-coding')->only(['replicate']);
//        $this->middleware('can:export-coding')->only(['exportPage', 'export']);
//    }

    public function index()
    {
        $codings = Coding::query();

        if (request()->has('sort') && request('sort') == "name") {
            $codings = $codings->orderBy('name', 'ASC');
        }

        if (request()->has('sort') && request('sort') == "code") {
            $codings = $codings->orderBy('code', 'ASC');
        }

        if ($keyword = request('search')) {
            $codings->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('code', 'LIKE', "%{$keyword}%");
        }

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

        $codings = $codings->orderBy('code', 'ASC')->paginate(25)->withQueryString();
        $categories = SystemCategory::where('parent_id', 0)->with(['children'])->get();
        return view('systems.coding.index', compact('codings', 'categories'));
    }

    public function create()
    {
        $categories = SystemCategory::where('parent_id', 0)->with(['children'])->get();

        return view('systems.coding.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
            'store' => 'required|in:10,12,14',
            'categories' => 'required|array|min:3|max:3',
        ]);

        if (!is_null($request->code)) {
            $request->validate([
                'code' => 'nullable|digits:3|numeric'
            ]);
        }

        if (count($request['categories']) == 3 && $request['categories'][2] != "") {
            $coding = Coding::create($data);
            $coding->categories()->sync($data['categories']);
            if (!isset($request->code)) {
                $code = $this->getCode($coding);
                $coding->code = $code;
            } else {
                $categoryCode = '';
                foreach ($coding->categories as $category) {
                    $categoryCode .= $category->code;
                }
                $coding->code = $categoryCode . $request->code;
            }
            $coding->save();
        } else {
            return back()->withErrors(['لطفا دسته بندی را به صورت کامل وارد کنید']);
        }

        alert()->success('ثبت موفق', 'ثبت قطعه با موفقیت انجام شد');

        return back();
    }

    public function edit(Coding $coding)
    {
        return view('systems.coding.edit', compact('coding'));
    }

    public function update(Request $request, Coding $coding)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
            'store' => 'required|in:10,12,14',
            'code' => ['required', 'numeric', Rule::unique('codings')->ignore($coding->id)],
        ]);

        $data['copy'] = '0';

        $coding->update($data);

        alert()->success('بروزرسانی موفق', 'کدینگ مورد نظر با موفقیت بروزرسانی شد');

        return back();
    }

    public function destroy(Coding $coding)
    {
        $coding->delete();

        alert()->success('حذف موفق', 'کدینگ مورد نظر با موفقیت حذف شد');

        return back();
    }

    public function replicate(Coding $coding)
    {
        $code = $this->getCode($coding);

        $newCoding = $coding->replicate()->fill([
            'code' => $code,
            'name' => $coding->name . " کپی شده ",
        ]);
        $newCoding->copy = '1';
        $newCoding->save();

        foreach ($coding->categories as $category) {
            $newCoding->categories()->attach($category->id);
        }

        alert()->success('کپی موفق', 'کدینگ مورد نظر با موفقیت کپی شد');

        return back();
    }

    public function category(Request $request)
    {
        $category = SystemCategory::find($request->id);
        $children = $category->children;

        if (count($children) > 0) {
            return response(['data' => $children]);
        }
        return response(['data' => 'no-child']);
    }

    public function getCode($coding): string
    {
        $categoryCode = "";
        foreach ($coding->categories as $category) {
            $categoryCode .= $category->code;
        }

        $codings = Coding::select(['code'])->get();
        $code = "";
        if (!$codings->isEmpty()) {
            $category = $coding->categories()->latest()->first();
            $categoryCoding = $category->codings->toArray();

            if (count($categoryCoding) == 1) {
                $code = '001';
            }
            if (count($categoryCoding) == 2) {
                $lastCoding = $categoryCoding[0];
                $lastThreeCode = substr($lastCoding['code'], 5);
                $code = str_pad($lastThreeCode + 1, 3, "0", STR_PAD_LEFT);
            }
            if (count($categoryCoding) > 2) {
                //$lastCoding = $categoryCoding[count($categoryCoding) - 2];
                $codes = array_map(function ($catCode) {
                    return $catCode['code'];
                }, $categoryCoding);

                $lastThreeCode = substr(max($codes), 5);
                $code = str_pad($lastThreeCode + 1, 3, "0", STR_PAD_LEFT);
            }
        } else {
            $code = '001';
        }

        return $categoryCode . $code;
    }

    public function exportPage()
    {
        $codings = Coding::query();

        if (request()->has('start') && request()->has('end')) {
            $explodeStartDate = explode('-', request('start'));
            $explodeEndDate = explode('-', request('end'));
            $startDate = (new Jalalian($explodeStartDate[0], $explodeStartDate[1], $explodeStartDate[2]))->toCarbon()->toDateTimeString();
            $endDate = (new Jalalian($explodeEndDate[0], $explodeEndDate[1], $explodeEndDate[2]))->toCarbon()->toDateTimeString();

            $codings = $codings->whereBetween('created_at', [$startDate, $endDate])->get();
        }

        return view('systems.coding.export', compact('codings'));
    }

    public function export(Request $request)
    {
        $request->validate([
            'start' => 'required|string|max:255',
            'end' => 'required|string|max:255',
        ]);

        $explodeStartDate = explode('-', $request->start);
        $explodeEndDate = explode('-', $request->end);
        $startDate = (new Jalalian($explodeStartDate[0], $explodeStartDate[1], $explodeStartDate[2]))->toCarbon()->toDateTimeString();
        $endDate = (new Jalalian($explodeEndDate[0], $explodeEndDate[1], $explodeEndDate[2]))->toCarbon()->toDateTimeString();

        $name = "New-Store-Code-" . jdate(Carbon::now())->format('Y-m-d');

        return Excel::download(new CodingExport($startDate, $endDate), $name . ".xls", \Maatwebsite\Excel\Excel::XLS);
    }
}
