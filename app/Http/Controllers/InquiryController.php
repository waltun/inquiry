<?php

namespace App\Http\Controllers;

use App\Models\Amount;
use App\Models\Group;
use App\Models\Inquiry;
use App\Models\Modell;
use App\Models\Part;
use App\Models\Product;
use App\Models\Special;
use App\Models\User;
use App\Notifications\CopyInquiryNotification;
use App\Notifications\CorrectionInquiryNotification;
use App\Notifications\NewInquiryNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;

class InquiryController extends Controller
{
    public function index()
    {
        Gate::authorize('inquiries');

        $inquiries = Inquiry::query();

        if (request()->has('inquiry_number') && request()->get('inquiry_number') != null) {
            $inquiries = $inquiries->where('inquiry_number', 'LIKE', "%" . request()->get('inquiry_number') . "%");
        }

        if (request()->has('name') && request()->get('name') != null) {
            $inquiries = $inquiries->where('name', 'LIKE', "%" . request()->get('name') . "%");
        }

        if (request()->has('manager') && request()->get('manager') != null) {
            $inquiries = $inquiries->where('manager', 'LIKE', "%" . request()->get('manager') . "%");
        }

        if (request()->has('marketer') && request()->get('marketer') != null) {
            $inquiries = $inquiries->where('marketer', 'LIKE', "%" . request()->get('marketer') . "%");
        }

        if (request()->has('model_id') && request()->get('model_id') != null) {
            $inquiries = $inquiries->whereHas('products', function ($query) {
                $query->where('model_id', request()->get('model_id'));
            });
        }

        if (request()->has('group_id') && request()->get('group_id') != null) {
            $inquiries = $inquiries->whereHas('products', function ($query) {
                $query->where('group_id', request()->get('group_id'));
            });
        }

        if (auth()->user()->role == 'admin') {
            $inquiries = $inquiries->where('submit', 0)->latest()->paginate(25);
        } else {
            $inquiries = $inquiries->where('submit', 0)->where('user_id', auth()->user()->id)->latest()->paginate(25);
        }

        $modells = Modell::where('parent_id', '!=', 0)->get();
        $groups = Group::all();
        return view('inquiries.index', compact('inquiries', 'modells', 'groups'));
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
            'type' => 'required|in:product,part,both'
        ]);

        $data['user_id'] = $request->user()->id;

        Inquiry::create($data);

        alert()->success('ثبت موفق', 'ثبت استعلام با موفقیت انجام شد');

        return redirect()->route('inquiries.index');
    }

    public function show(Inquiry $inquiry)
    {
        Gate::authorize('priced-inquiry');

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

        $colspan = '';
        $colspan2 = '';
        if (auth()->user()->role == 'admin' || auth()->user()->role == 'technical') {
            $colspan = '5';
            $colspan2 = '3';
        } else {
            $colspan = '3';
            $colspan2 = '2';
        }

        return view('inquiries.show', compact('inquiry', 'colspan', 'colspan2'));
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
            'type' => 'required|in:product,part,both',
        ]);

        $inquiry->update($data);

        alert()->success('ویرایش موفق', 'ویرایش استعلام با موفقیت انجام شد');

        return redirect()->route('inquiries.index');
    }

    public function destroy(Inquiry $inquiry)
    {
        Gate::authorize('delete-inquiry');

        $specials = Special::all()->pluck('id')->toArray();

        if (!$inquiry->products->isEmpty()) {
            foreach ($inquiry->products as $product) {
                $modell = Modell::find($product->model_id);
                if ($modell) {
                    if (!$modell->parts->isEmpty()) {
                        foreach ($modell->parts as $part) {
                            if (in_array($part->id, $specials)) {
                                session()->forget('selectedPart' . $part->id);
                                session()->forget('price' . $part->id);
                            }
                        }
                    }
                }
            }

            $inquiry->products()->delete();
        }

        $collectionParts = Part::where('inquiry_id', $inquiry->id)->get();
        foreach ($collectionParts as $collectionPart) {
            $collectionPart->delete();
        }

        $inquiry->delete();

        alert()->success('حذف موفق', 'حذف استعلام با موفقیت انجام شد');

        return back();
    }

    public function submitted()
    {
        Gate::authorize('submit-inquiry');

        $inquiries = Inquiry::query();

        if (request()->has('inquiry_number') && request()->get('inquiry_number') != null) {
            $inquiries = $inquiries->where('inquiry_number', 'LIKE', "%" . request()->get('inquiry_number') . "%");
        }

        if (request()->has('name') && request()->get('name') != null) {
            $inquiries = $inquiries->where('name', 'LIKE', "%" . request()->get('name') . "%");
        }

        if (request()->has('manager') && request()->get('manager') != null) {
            $inquiries = $inquiries->where('manager', 'LIKE', "%" . request()->get('manager') . "%");
        }

        if (request()->has('marketer') && request()->get('marketer') != null) {
            $inquiries = $inquiries->where('marketer', 'LIKE', "%" . request()->get('marketer') . "%");
        }

        if (request()->has('model_id') && request()->get('model_id') != null) {
            $inquiries = $inquiries->whereHas('products', function ($query) {
                $query->where('model_id', request()->get('model_id'));
            });
        }

        if (request()->has('group_id') && request()->get('group_id') != null) {
            $inquiries = $inquiries->whereHas('products', function ($query) {
                $query->where('group_id', request()->get('group_id'));
            });
        }

        if (auth()->user()->role === 'admin') {
            $inquiries = $inquiries->where('submit', 1)->where('archive_at', null)->latest()->paginate(25);
        } else {
            $inquiries = $inquiries->where('submit', 1)->where('archive_at', null)->where('user_id', auth()->user()->id)->latest()->paginate(25);
        }

        $modells = Modell::where('parent_id', '!=', 0)->get();
        $groups = Group::all();
        return view('inquiries.submitted', compact('inquiries', 'modells', 'groups'));
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

        $data['inquiry_number'] = '';
        $data = $this->getCode($data);

        $inquiry->update([
            'submit' => true,
            'message' => null,
            'inquiry_number' => $data['inquiry_number']
        ]);
        //Send Notification
        $adminUsers = User::where('role', 'admin')->get();
        auth()->user()->notify(new NewInquiryNotification($inquiry));
        Notification::send($adminUsers, new NewInquiryNotification($inquiry));

        alert()->success('ثبت نهایی موفق', 'ثبت نهایی با موفقیت انجام شد و برای مدیریت ارسال شد');

        return back();
    }

    public function priced()
    {
        Gate::authorize('priced-inquiry');

        $inquiries = Inquiry::query();

        if (request()->has('inquiry_number') && request()->get('inquiry_number') != null) {
            $inquiries = $inquiries->where('inquiry_number', 'LIKE', "%" . request()->get('inquiry_number') . "%");
        }

        if (request()->has('name') && request()->get('name') != null) {
            $inquiries = $inquiries->where('name', 'LIKE', "%" . request()->get('name') . "%");
        }

        if (request()->has('manager') && request()->get('manager') != null) {
            $inquiries = $inquiries->where('manager', 'LIKE', "%" . request()->get('manager') . "%");
        }

        if (request()->has('marketer') && request()->get('marketer') != null) {
            $inquiries = $inquiries->where('marketer', 'LIKE', "%" . request()->get('marketer') . "%");
        }

        if (request()->has('model_id') && request()->get('model_id') != null) {
            $inquiries = $inquiries->whereHas('products', function ($query) {
                $query->where('model_id', request()->get('model_id'));
            });
        }

        if (request()->has('group_id') && request()->get('group_id') != null) {
            $inquiries = $inquiries->whereHas('products', function ($query) {
                $query->where('group_id', request()->get('group_id'));
            });
        }

        if (auth()->user()->role === 'admin') {
            $inquiries = $inquiries->where('archive_at', '!=', null)->orderBy('inquiry_number', 'DESC')->paginate(25);
        } else {
            $inquiries = $inquiries->where('archive_at', '!=', null)->where('user_id', auth()->user()->id)->orderBy('inquiry_number', 'DESC')->paginate(25);
        }

        $modells = Modell::where('parent_id', '!=', 0)->get();
        $groups = Group::all();
        return view('inquiries.priced', compact('inquiries', 'modells', 'groups'));
    }

    public function copy(Inquiry $inquiry)
    {
        Gate::authorize('create-inquiry');

        $user = User::find($inquiry->user_id);

        $newInquiry = $inquiry->replicate()->fill([
            'archive_at' => null,
            'submit' => false,
            'price' => 0,
            'inquiry_number' => null,
            'copy_id' => $inquiry->id
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
                $part = Part::find($amount->part_id);
                $category = $part->categories()->latest()->first();
                $lastPart = $category->parts()->latest()->first();
                $code = str_pad($lastPart->code + 1, 4, "0", STR_PAD_LEFT);

                if ($part->coil == '1' && $part->collection == '1' && !is_null($part->inquiry_id)) {
                    $name = $part->name;
                    $explode = explode('-', $name);
                    $explode[0] = $inquiryNumber;
                    $newName = implode('-', $explode);

                    $newPart = $part->replicate()->fill([
                        'code' => $code,
                        'name' => $newName,
                        'inquiry_id' => $newInquiry->id,
                        'product_id' => $newProduct->id
                    ]);
                    $newPart->save();

                    $newPart->categories()->syncWithoutDetaching($part->categories);

                    foreach ($part->children as $child) {
                        $newPart->children()->syncWithoutDetaching([
                            $child->id => [
                                'value' => $child->pivot->value
                            ]
                        ]);
                    }

                    $totalPrice = 0;
                    foreach ($newPart->children as $child) {
                        $totalPrice += ($child->price * $child->pivot->value);
                    }
                    $newPart->save();
                }

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

        $newInquiry = $inquiry->replicate()->fill([
            'archive_at' => null,
            'submit' => false,
            'price' => 0,
            'inquiry_number' => null,
            'message' => $request['message'],
            'correction_id' => $inquiry->id
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
                $part = Part::find($amount->part_id);
                $category = $part->categories()->latest()->first();
                $lastPart = $category->parts()->latest()->first();
                $code = str_pad($lastPart->code + 1, 4, "0", STR_PAD_LEFT);

                if ($part->coil == '1' && $part->collection == '1' && !is_null($part->inquiry_id)) {
                    $name = $part->name;
                    $explode = explode('-', $name);
                    $explode[0] = $inquiryNumber;
                    $newName = implode('-', $explode);

                    $newPart = $part->replicate()->fill([
                        'code' => $code,
                        'name' => $newName,
                        'inquiry_id' => $newInquiry->id,
                        'product_id' => $newProduct->id
                    ]);
                    $newPart->save();

                    $newPart->categories()->syncWithoutDetaching($part->categories);

                    foreach ($part->children as $child) {
                        $newPart->children()->syncWithoutDetaching([
                            $child->id => [
                                'value' => $child->pivot->value
                            ]
                        ]);
                    }

                    $totalPrice = 0;
                    foreach ($newPart->children as $child) {
                        $totalPrice += ($child->price * $child->pivot->value);
                    }
                    $newPart->save();
                }

                $newAmount = $amount->replicate()->fill([
                    'value' => $amount->value,
                    'product_id' => $newProduct->id,
                    'part_id' => $amount->part_id,
                    'price' => $amount->price
                ]);
                $newAmount->save();
            }
        }

        //Send Notification
        if ($user) {
            $user->notify(new CorrectionInquiryNotification($newInquiry));
        }

        alert()->success('اطلاح موفق', 'اصلاح استعلام با موفقیت انجام شد و برای کاربر ارسال شد');

        return back();
    }

    public function submittedCorrection(Request $request, Inquiry $inquiry)
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
        if ($user) {
            $user->notify(new CorrectionInquiryNotification($inquiry));
        }

        alert()->success('اصلاح موفق', 'اصلاح استعلام با موفقیت انجام شد و برای کاربر ارسال شد');

        return back();
    }

    public function referral(Request $request, Inquiry $inquiry)
    {
        Gate::authorize('create-inquiry');

        $user = User::find($request['user_id']);

        $newInquiry = $inquiry->replicate()->fill([
            'archive_at' => null,
            'submit' => false,
            'price' => 0,
            'inquiry_number' => null,
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
                $part = Part::find($amount->part_id);
                $category = $part->categories()->latest()->first();
                $lastPart = $category->parts()->latest()->first();
                $code = str_pad($lastPart->code + 1, 4, "0", STR_PAD_LEFT);

                if ($part->coil == '1' && $part->collection == '1' && !is_null($part->inquiry_id)) {
                    $newPart = $part->replicate()->fill([
                        'code' => $code,
                        'name' => $part->name,
                        'inquiry_id' => $newInquiry->id,
                        'product_id' => $newProduct->id
                    ]);
                    $newPart->save();

                    $newPart->categories()->syncWithoutDetaching($part->categories);

                    foreach ($part->children as $child) {
                        $newPart->children()->syncWithoutDetaching([
                            $child->id => [
                                'value' => $child->pivot->value
                            ]
                        ]);
                    }

                    $totalPrice = 0;
                    foreach ($newPart->children as $child) {
                        $totalPrice += ($child->price * $child->pivot->value);
                    }
                    $newPart->save();
                }

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

    public function tmpReferral(Request $request, Inquiry $inquiry)
    {
        Gate::authorize('create-inquiry');

        $inquiry->update([
            'user_id' => $request['user_id']
        ]);

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

    public function showDescription(Inquiry $inquiry)
    {
        return view('inquiries.show-description', compact('inquiry'));
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
        $inquiries = Inquiry::select('inquiry_number')->where('inquiry_number', '!=', null)->get();

        $number = 0;
        foreach ($inquiries as $inquiry) {
            if ((int)$inquiry->inquiry_number > $number) {
                $number = (int)$inquiry->inquiry_number;
            }
        }

        $year = jdate(now())->getYear();
        if (!$inquiries->isEmpty()) {
            $inquiryNumber = str_pad($number + 1, 5, "0", STR_PAD_LEFT);
            $data['inquiry_number'] = $inquiryNumber;
        } else {
            $inquiryNumber = '00001';
            $data['inquiry_number'] = $year . $inquiryNumber;
        }
        return $data;
    }

    public function printProduct(Inquiry $inquiry)
    {
        return view('inquiries.print-product', compact('inquiry'));
    }

    public function print(Inquiry $inquiry)
    {
        $colspan = '';
        $colspan2 = '';
        if (auth()->user()->role == 'admin' || auth()->user()->role == 'technical') {
            $colspan = '5';
            $colspan2 = '3';
        } else {
            $colspan = '3';
            $colspan2 = '2';
        }
        return view('inquiries.print', compact('inquiry', 'colspan', 'colspan2'));
    }

    public function addToModell(Product $product)
    {
        $name = $product->model_custom_name;
        $modell = Modell::find($product->model_id);
        $parentModell = Modell::find($modell->parent_id);
        $code = $this->getParentLastCode($parentModell);

        $createdModell = Modell::create([
            'name' => $name,
            'code' => $code,
            'group_id' => $modell->group_id,
            'parent_id' => $modell->parent_id
        ]);

        foreach ($product->amounts as $amount) {
            $createdModell->parts()->attach($amount->part_id, [
                'value' => $amount->value,
                'value2' => $amount->value2 ?? null,
                'sort' => $amount->sort
            ]);
        }

        $product->copy_model = '1';
        $product->save();

        alert()->success('ثبت موفق', 'مدل مورد نظر با موفقیت به مدل های استاندارد اضافه شد');

        return back();
    }

    public function getParentLastCode($modell)
    {
        if (!$modell->children->isEmpty()) {
            $lastModellCode = $modell->children()->latest()->first()->code;
            $code = str_pad($lastModellCode + 1, 4, "0", STR_PAD_LEFT);
        } else {
            $code = '0001';
        }
        return $code;
    }
}
