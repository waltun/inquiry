<?php

namespace App\Http\Controllers;

use App\Models\Amount;
use App\Models\Group;
use App\Models\Inquiry;
use App\Models\Modell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class InquiryController extends Controller
{
    public function index()
    {
        Gate::authorize('inquiries');

        $inquiries = Inquiry::latest()->paginate(25);

        return view('inquiries.index', compact('inquiries'));
    }

    public function create()
    {
        Gate::authorize('create-inquiry');

        $groups = Group::select(['name', 'id'])->get();
        return view('inquiries.create', compact('groups'));
    }

    public function store(Request $request)
    {
        Gate::authorize('create-inquiry');

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'model_id' => 'required|integer',
            'group_id' => 'required|integer',
        ]);

        $data['manager'] = auth()->user()->name;

        Inquiry::create($data);

        alert()->success('ثبت موفق', 'ثبت استعلام با موفقیت انجام شد');

        return redirect()->route('inquiries.index');
    }

    public function show(Inquiry $inquiry)
    {
        Gate::authorize('inquiry-detail');

        if ($inquiry->amounts->isEmpty()) {
            alert()->error('مقادیر', 'لطفا ابتدا مقادیر را مشخص کنید');
            return back();
        }

        $group = Group::find($inquiry->group_id);

        if ($group->parts->pluck('price')->contains(null) || $group->parts->pluck('price')->contains(0)) {
            alert()->error('قیمت گذاری', 'لطفا ابتدا قیمت قطعات را مشخص کنید');
            return back();
        }

        $modell = Modell::find($inquiry->model_id);
        $totalPrice = 0;

        return view('inquiries.show', compact('inquiry', 'group', 'modell', 'totalPrice'));
    }

    public function edit(Inquiry $inquiry)
    {
        Gate::authorize('create-inquiry');

        $group = Group::find($inquiry->group_id);
        $modells = $group->modells;
        $groups = Group::select(['name', 'id'])->get();
        return view('inquiries.edit', compact('inquiry', 'modells', 'groups'));
    }

    public function update(Request $request, Inquiry $inquiry)
    {
        Gate::authorize('create-inquiry');

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'model_id' => 'required|integer',
            'group_id' => 'required|integer',
        ]);

        $inquiry->update($data);

        alert()->success('ویرایش موفق', 'ویرایش استعلام با موفقیت انجام شد');

        return redirect()->route('inquiries.index');
    }

    public function destroy(Inquiry $inquiry)
    {
        Gate::authorize('create-inquiry');

        $inquiry->delete();

        alert()->success('حذف موفق', 'حذف استعلام با موفقیت انجام شد');

        return back();
    }

    public function amounts(Inquiry $inquiry)
    {
        Gate::authorize('inquiry-value');

        $group = Group::find($inquiry->group_id);
        $modell = Modell::find($inquiry->model_id);
        return view('inquiries.amounts', compact('inquiry', 'group', 'modell'));
    }

    public function storeAmounts(Request $request, Inquiry $inquiry)
    {
        Gate::authorize('inquiry-value');

        $group = Group::find($inquiry->group_id);

        $request->validate([
            'amounts' => 'required'
        ]);

        foreach ($group->parts as $index => $part) {
            $amount = Amount::where('part_id', $part->id)->where('inquiry_id', $inquiry->id)->first();

            if ($amount) {
                if ($amount->value != $request->amounts[$index]) {
                    $amount->update([
                        'value' => $request->amounts[$index]
                    ]);
                }
            } else {
                Amount::create([
                    'value' => $request->amounts[$index],
                    'inquiry_id' => $inquiry->id,
                    'part_id' => $part->id
                ]);
            }
        }

        alert()->success('ثبت موفق', 'ثبت مقادیر با موفقیت انجام شد');

        return redirect()->route('inquiries.index');
    }

    public function submit(Inquiry $inquiry)
    {
        Gate::authorize('create-inquiry');

        $inquiry->update([
            'submit' => true
        ]);

        alert()->success('ثبت نهایی موفق', 'ثبت نهایی با موفقیت انجام شد و برای مدیریت ارسال شد');

        return back();
    }

    public function changeModelAjax(Request $request)
    {
        $group = Group::find($request->group_id);
        $modells = $group->modells;

        return response(['data' => $modells]);
    }
}
