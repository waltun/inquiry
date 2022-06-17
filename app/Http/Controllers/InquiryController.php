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

        $inquiries = Inquiry::where('submit', 0)->where('user_id', auth()->user()->id)->latest()->paginate(25);

        return view('inquiries.index', compact('inquiries'));
    }

    public function create()
    {
        Gate::authorize('create-inquiry');

        return view('inquiries.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('create-inquiry');

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'marketer' => 'required|string|max:255',
            'inquiry_number' => 'numeric|nullable'
        ]);

        $data['manager'] = auth()->user()->name;
        $data['inquiry_number'] = random_int(999, 999999);
        $data['user_id'] = $request->user()->id;

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

        return view('inquiries.edit', compact('inquiry'));
    }

    public function update(Request $request, Inquiry $inquiry)
    {
        Gate::authorize('create-inquiry');

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'marketer' => 'required|string|max:255',
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

    public function submitted()
    {
        Gate::authorize('inquiry-percent');

        $inquiries = Inquiry::where('submit', 1)->where('archive_at', null)->latest()->paginate(25);

        return view('inquiries.submitted', compact('inquiries'));
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

    public function priced()
    {
        Gate::authorize('create-inquiry');

        $inquiries = Inquiry::where('archive_at', '!=', null)->where('user_id', auth()->user()->id)->latest()->paginate(25);

        return view('inquiries.priced', compact('inquiries'));
    }

    public function restore(Inquiry $inquiry)
    {
        Gate::authorize('inquiry-restore');

        $inquiry->update([
            'price' => 0,
            'percent' => 0,
            'archive_at' => null,
            'submit' => false,
        ]);

        alert()->success('ثبت اصلاح موفق', 'ثبت اصلاح با موفقیت انجام شد و برای کاربر ارسال شد');

        return back();
    }

    public function changeModelAjax(Request $request)
    {
        $group = Group::find($request->group_id);
        $modells = $group->modells;

        return response(['data' => $modells]);
    }
}
