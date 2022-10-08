<?php

namespace App\Http\Controllers;

use App\Models\Amount;
use App\Models\Group;
use App\Models\Inquiry;
use App\Models\Modell;
use App\Models\User;
use App\Notifications\CopyInquiryNotification;
use App\Notifications\CorrectionInquiryNotification;
use App\Notifications\NewInquiryNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class InquiryController extends Controller
{
    public function index()
    {
        Gate::authorize('inquiries');

        if (auth()->user()->role == 'admin') {
            $inquiries = Inquiry::where('submit', 0)->latest()->paginate(25);
        } else {
            $inquiries = Inquiry::where('submit', 0)->where('user_id', auth()->user()->id)->latest()->paginate(25);
        }

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
            'inquiry_number' => 'numeric|nullable',
            'type' => 'required|in:product,part,both'
        ]);

        $data['manager'] = auth()->user()->name;

        $data = $this->getCode($data);

        $data['user_id'] = $request->user()->id;

        Inquiry::create($data);

        alert()->success('ثبت موفق', 'ثبت استعلام با موفقیت انجام شد');

        return redirect()->route('inquiries.index');
    }

    public function show(Inquiry $inquiry)
    {
        Gate::authorize('detail-inquiry');

        if ($inquiry->products->isEmpty()) {
            alert()->error('محصولات', 'لطفا ابتدا محصولات را مشخص کنید');
            return back();
        }

        foreach ($inquiry->products()->where('group_id', '!=', 0)->where('model_id', '!=', 0)->get() as $product) {
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
            'type' => 'required|in:product,part,both'
        ]);

        $inquiry->update($data);

        alert()->success('ویرایش موفق', 'ویرایش استعلام با موفقیت انجام شد');

        return redirect()->route('inquiries.index');
    }

    public function destroy(Inquiry $inquiry)
    {
        Gate::authorize('delete-inquiry');

        if (!$inquiry->products->isEmpty()) {
            $inquiry->products()->delete();
        }

        $inquiry->delete();

        alert()->success('حذف موفق', 'حذف استعلام با موفقیت انجام شد');

        return back();
    }

    public function submitted()
    {
        Gate::authorize('submit-inquiry');

        if (auth()->user()->role === 'admin') {
            $inquiries = Inquiry::where('submit', 1)->where('archive_at', null)->latest()->paginate(25);
        } else {
            $inquiries = Inquiry::where('submit', 1)->where('archive_at', null)->where('user_id', auth()->user()->id)->latest()->paginate(25);
        }

        return view('inquiries.submitted', compact('inquiries'));
    }

    public function submit(Inquiry $inquiry)
    {
        Gate::authorize('submit-inquiry');

        if ($inquiry->products->isEmpty()) {
            alert()->error('محصولات', 'لطفا ابتدا محصولات را مشخص کنید');
            return back();
        }

        foreach ($inquiry->products()->where('group_id', '!=', 0)->where('model_id', '!=', 0)->get() as $product) {
            if ($product->amounts->isEmpty()) {
                alert()->error('مقادیر محصولات', 'لطفا ابتدا مقادیر محصولات را مشخص کنید');
                return back();
            }
        }

        $inquiry->update([
            'submit' => true,
            'message' => null,
        ]);
        //Send Notification
        auth()->user()->notify(new NewInquiryNotification($inquiry));
        alert()->success('ثبت نهایی موفق', 'ثبت نهایی با موفقیت انجام شد و برای مدیریت ارسال شد');

        return back();
    }

    public function priced()
    {
        Gate::authorize('priced-inquiry');

        if (auth()->user()->role === 'admin') {
            $inquiries = Inquiry::where('archive_at', '!=', null)->latest()->paginate(25);
        } else {
            $inquiries = Inquiry::where('archive_at', '!=', null)->where('user_id', auth()->user()->id)->latest()->paginate(25);
        }

        return view('inquiries.priced', compact('inquiries'));
    }

    public function copy(Inquiry $inquiry)
    {
        Gate::authorize('create-inquiry');

        $user = User::find($inquiry->user_id);

        $lastInquiry = Inquiry::all()->last();
        $inquiryNumber = str_pad($lastInquiry->inquiry_number + 1, 5, "0", STR_PAD_LEFT);

        $newInquiry = $inquiry->replicate()->fill([
            'archive_at' => null,
            'submit' => false,
            'price' => 0,
            'inquiry_number' => $inquiryNumber
        ]);
        $newInquiry->save();

        foreach ($inquiry->products as $product) {
            $newProduct = $product->replicate()->fill([
                'percent' => 0,
                'inquiry_id' => $newInquiry->id,
                'price' => 0,
            ]);
            $newProduct->save();

            foreach ($product->amounts as $amount) {
                $newAmount = $amount->replicate()->fill([
                    'value' => $amount->value,
                    'product_id' => $newProduct->id,
                    'part_id' => $amount->part_id,
                    'price' => $amount->price > 0 ? $amount->price : 0
                ]);
                $newAmount->save();
            }
        }

        //Send Notification
        $user->notify(new CopyInquiryNotification($newInquiry));

        alert()->success('کپی موفق', 'کپی با موفقیت انجام شد و برای کاربر ارسال شد');

        return back();
    }

    public function correction(Request $request, Inquiry $inquiry)
    {
        Gate::authorize('correction-inquiry');

        $user = User::find($inquiry->user_id);

        $request->validate([
            'message' => 'required'
        ]);

        $inquiry->update([
            'message' => $request['message'],
            'price' => 0,
            'submit' => false,
            'archive_at' => null,
        ]);

        foreach ($inquiry->products as $product) {
            $product->price = 0;
            $product->percent = 0;
            $product->save();
        }

        //Send Notification
        $user->notify(new CorrectionInquiryNotification($inquiry));

        alert()->success('اصلاح موفق', 'اصلاح استعلام با موفقیت انجام شد و برای کاربر ارسال شد');

        return back();
    }

    public function referral(Request $request, Inquiry $inquiry)
    {
        Gate::authorize('create-inquiry');

        $lastInquiry = Inquiry::all()->last();
        $inquiryNumber = str_pad($lastInquiry->inquiry_number + 1, 5, "0", STR_PAD_LEFT);
        $user = User::find($request['user_id']);

        $newInquiry = $inquiry->replicate()->fill([
            'archive_at' => null,
            'submit' => false,
            'price' => 0,
            'inquiry_number' => $inquiryNumber,
            'user_id' => $request['user_id'],
            'manager' => $user->name
        ]);
        $newInquiry->save();

        foreach ($inquiry->products as $product) {
            $newProduct = $product->replicate()->fill([
                'percent' => 0,
                'inquiry_id' => $newInquiry->id,
                'price' => 0,
            ]);
            $newProduct->save();

            foreach ($product->amounts as $amount) {
                $newAmount = $amount->replicate()->fill([
                    'value' => $amount->value,
                    'product_id' => $newProduct->id,
                    'part_id' => $amount->part_id,
                    'price' => $amount->price > 0 ? $amount->price : 0
                ]);
                $newAmount->save();
            }
        }

        alert()->success('ارجاع موفق', 'ارجاع با موفقیت انجام شد و برای کاربر ارسال شد');

        return back();
    }

    public function products(Inquiry $inquiry)
    {
        Gate::authorize('create-inquiry');

        return view('inquiries.products', compact('inquiry'));
    }

    public function description(Inquiry $inquiry)
    {
        return view('inquiries.description', compact('inquiry'));
    }

    public function storeDescription(Request $request, Inquiry $inquiry)
    {
        $request->validate([
            'description' => 'required'
        ]);

        $inquiry->update([
            'description' => $request['description']
        ]);

        alert()->success('ثبت موفق', 'شرایط استعلام با موفقیت ثبت شد');

        return redirect()->route('inquiries.index');
    }

    public function selectModelByGroup(Request $request)
    {
        $group = Group::find($request->group_id);
        $modells = $group->modells()->where('parent_id', 0)->get();

        return response(['data' => $modells]);
    }

    public function selectModelByModel(Request $request)
    {
        $modell = Modell::find($request->model_id);
        $children = $modell->children;

        return response(['data' => $children]);
    }

    public function getCode(array $data)
    {
        $lastInquiry = Inquiry::all()->last();
        $year = jdate(now())->getYear();
        if (!is_null($lastInquiry)) {
            $inquiryNumber = str_pad($lastInquiry->inquiry_number + 1, 5, "0", STR_PAD_LEFT);
            $data['inquiry_number'] = $inquiryNumber;
        } else {
            $inquiryNumber = '00001';
            $data['inquiry_number'] = $year . $inquiryNumber;
        }
        return $data;
    }
}
