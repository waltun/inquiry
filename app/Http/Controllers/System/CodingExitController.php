<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\Coding;
use App\Models\System\CodingExit;
use App\Models\System\Exitt;
use App\Models\System\SystemCategory;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class CodingExitController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:exit-codings')->only(['index', 'storeReturn']);
        $this->middleware('can:create-exit-coding')->only(['create', 'store']);
        $this->middleware('can:edit-exit-coding')->only(['edit', 'update']);
        $this->middleware('can:delete-exit-coding')->only(['destroy']);
    }

    public function index(Exitt $exitt)
    {
        $codings = $exitt->codingExits;

        return view('systems.exits.codings.index', compact('codings', 'exitt'));
    }

    public function create(Exitt $exitt)
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

        return view('systems.exits.codings.create', compact('exitt', 'codings', 'categories'));
    }

    public function store(Request $request, Exitt $exitt)
    {
        $data = $request->validate([
            'coding_id' => 'nullable',
            'name' => 'required_if:coding_id,null|string|max:255',
            'unit' => 'required_if:coding_id,null|string|max:255',
            'quantity' => 'required|numeric',
        ]);

        $exitt->codingExits()->create($data);

        alert()->success('ثبت موفق', 'محصول با موفقیت اضافه شد');

        return redirect()->route('exit-coding.index', $exitt->id);
    }

    public function edit(Exitt $exitt, CodingExit $codingExit)
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

        return view('systems.exits.codings.edit', compact('codings', 'categories', 'exitt', 'codingExit'));
    }

    public function update(Request $request, Exitt $exitt, CodingExit $codingExit)
    {
        $data = $request->validate([
            'coding_id' => 'nullable',
            'name' => 'required_if:coding_id,null|string|max:255',
            'unit' => 'required_if:coding_id,null|string|max:255',
            'quantity' => 'required|numeric',
        ]);

        $codingExit->update($data);

        alert()->success('بروزرسانی موفق', 'محصول با موفقیت بروزرسانی شد');

        return redirect()->route('exit-coding.index', $exitt->id);
    }

    public function destroy(Exitt $exitt, CodingExit $codingExit)
    {
        $codingExit->delete();

        alert()->success('حذف موفق', 'محصول با موفقیت حذف شد');

        return back();
    }

    public function storeReturn(Request $request, Exitt $exitt, CodingExit $codingExit)
    {
        $data = $request->validate([
            'return_quantity' => 'nullable|numeric',
            'return_date' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255'
        ]);

        if (!is_null($data['return_date'])) {
            $explodeDate = explode('/', $data['return_date']);
            $data['return_date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        $codingExit->return_quantity = $data['return_quantity'];
        $codingExit->return_date = $data['return_date'];
        $codingExit->description = $data['description'];
        $codingExit->save();

        alert()->success('عودت موفق', 'عودت با موفقیت ثبت شد');

        return back();
    }
}
