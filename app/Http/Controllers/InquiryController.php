<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Inquiry;
use App\Models\Product;
use App\Models\User;
use App\Notifications\CopyInquiryNotification;
use App\Notifications\NewInquiryNotification;
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
        $data['inquiry_number'] = "IQY-" . random_int(111111, 999999);
        $data['user_id'] = $request->user()->id;

        Inquiry::create($data);

        alert()->success('ثبت موفق', 'ثبت استعلام با موفقیت انجام شد');

        return redirect()->route('inquiries.index');
    }

    public function show(Inquiry $inquiry)
    {
        Gate::authorize('inquiry-detail');

        if ($inquiry->products->isEmpty()) {
            alert()->error('محصولات', 'لطفا ابتدا محصولات را مشخص کنید');
            return back();
        }

        foreach ($inquiry->products as $product) {
            if ($product->amounts->isEmpty()) {
                alert()->error('مقادیر محصولات', 'لطفا ابتدا مقادیر محصولات را مشخص کنید');
                return back();
            }
        }


        return view('inquiries.show', compact('inquiry'));
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

        if (!$inquiry->products->isEmpty()) {
            $inquiry->products()->delete();
        }

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

        //Send Notification
        auth()->user()->notify(new NewInquiryNotification($inquiry));

        alert()->success('ثبت نهایی موفق', 'ثبت نهایی با موفقیت انجام شد و برای مدیریت ارسال شد');

        return back();
    }

    public function priced()
    {
        Gate::authorize('create-inquiry');

        $inquiries = Inquiry::where('archive_at', '!=', null)->where('user_id', auth()->user()->id)->latest()->paginate(25);

        return view('inquiries.priced', compact('inquiries'));
    }

    public function copy(Inquiry $inquiry)
    {
        Gate::authorize('inquiry-restore');

        $user = User::find($inquiry->user_id);

        $newInquiry = $inquiry->replicate()->fill([
            'archive_at' => null,
            'submit' => false,
            'price' => 0,
        ]);
        $newInquiry->save();

        foreach ($inquiry->products as $product) {
            $newProduct = $product->replicate()->fill([
                'percent' => 0,
                'inquiry_id' => $newInquiry->id,
                'price' => 0,
            ]);
            $newProduct->save();
        }

        //Send Notification
        $user->notify(new CopyInquiryNotification($newInquiry));

        alert()->success('کپی موفق', 'کپی با موفقیت انجام شد و برای کاربر ارسال شد');

        return back();
    }

    public function correction(Request $request, Inquiry $inquiry)
    {
        $request->validate([
            'message' => 'required'
        ]);

        $inquiry->update([
            'message' => $request['message'],
            'price' => 0,
            'submit' => false,
            'archive_at' => null,
        ]);

        alert()->success('اصلاح موفق', 'اصلاح استعلام با موفقیت انجام شد و برای کاربر ارسال شد');

        return back();
    }

    public function products(Inquiry $inquiry)
    {
        return view('inquiries.products', compact('inquiry'));
    }

    public function changeModelAjax(Request $request)
    {
        $group = Group::find($request->group_id);
        $modells = $group->modells;

        return response(['data' => $modells]);
    }
}
