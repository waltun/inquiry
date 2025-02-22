<?php

namespace App\Http\Controllers;

use App\Models\CoilInput;
use App\Models\DeleteButton;
use App\Models\Group;
use App\Models\Inquiry;
use App\Models\InquiryPrice;
use App\Models\InquiryTerm;
use App\Models\Invoice;
use App\Models\Modell;
use App\Models\Part;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Special;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InquiryController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:inquiries')->only(['index']);
        $this->middleware('can:create-inquiry')->only(['create', 'store']);
        $this->middleware('can:show-inquiry')->only(['show']);
        $this->middleware('can:edit-inquiry')->only(['edit', 'update']);
        $this->middleware('can:delete-inquiry')->only(['destroy']);
        $this->middleware('can:submitted-inquiries')->only(['submitted']);
        $this->middleware('can:submit-inquiry')->only(['submit']);
        $this->middleware('can:priced-inquiries')->only(['priced']);
        $this->middleware('can:copy-inquiry')->only(['copy']);
        $this->middleware('can:correction-inquiry')->only(['correction', 'submittedCorrection']);
        $this->middleware('can:referral-inquiry')->only(['referral', 'tmpReferral']);
        $this->middleware('can:restore-inquiry')->only(['restore']);
        $this->middleware('can:inquiry-product-list')->only(['products']);
        $this->middleware('can:inquiry-description')->only(['description', 'showDescription', 'storeDescription']);
        $this->middleware('can:inquiry-add-to-model')->only(['addToModell']);
        $this->middleware('can:print-inquiry')->only(['print']);
        $this->middleware('can:print-inquiry-product')->only(['printProduct']);
        $this->middleware('can:inquiry-final-submit')->only(['finalSubmit']);
    }

    public function index()
    {
        $inquiries = Inquiry::query();

        if (request()->has('model_id') && !is_null(request('model_id'))) {
            $inquiries = $inquiries->whereHas('products', function ($query) {
                $query->where('model_id', '=', request()->get('model_id'));
            });
        }

        if (request()->has('group_id') && !is_null(request('group_id'))) {
            $inquiries = $inquiries->whereHas('products', function ($query) {
                $query->where('group_id', '=', request()->get('group_id'));
            });
        }

        if (request()->has('search') && !is_null(request('search'))) {
            $inquiries = $inquiries->where('name', 'LIKE', "%" . request()->get('search') . "%")
                ->orWhere('marketer', 'LIKE', "%" . request()->get('search') . "%")
                ->orWhere('inquiry_number', 'LIKE', "%" . request()->get('search') . "%");
        }

        if (request()->has('user_id') && !is_null(request('user_id'))) {
            $inquiries = $inquiries->where('user_id', request('user_id'));
        }

        if (auth()->user()->role == 'admin') {
            $inquiries = $inquiries->where('submit', 0)->latest()->paginate(25);

        } else {
            $inquiries = $inquiries->where('submit', 0)->where('user_id', auth()->user()->id)
                ->orWhere('second_user_id', auth()->user()->id)->latest()->paginate(25);
        }

        $modells = Modell::where('parent_id', '!=', 0)->get();
        $groups = Group::all();
        $delete = DeleteButton::where('active', '1')->first();
        return view('inquiries.index', compact('inquiries', 'delete', 'groups', 'modells'));
    }

    public function create()
    {
        $users = User::where('role', 'client')->orWhere('role', 'staff')->get();
        $staffs = User::where('role', 'staff')->orWhere('role', 'admin')->get();
        return view('inquiries.create', compact('users', 'staffs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'marketer' => 'required|string|max:255',
            'type' => 'required|in:product,part,both',
            'user_ids' => 'required|array',
            'second_user_id' => 'nullable|integer'
        ]);

        $data['user_id'] = $request->user()->id;

        $inquiry = Inquiry::create($data);

        $inquiry->users()->sync($data['user_ids']);

        alert()->success('ثبت موفق', 'ثبت استعلام با موفقیت انجام شد');

        return redirect()->route('inquiries.index');
    }

    public function show(Inquiry $inquiry)
    {
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

        if (auth()->user()->role == 'admin') {
            $colspan = '6';
            $colspan2 = '4';
        } else {
            $colspan = '4';
            $colspan2 = '3';
        }

        return view('inquiries.show', compact('inquiry', 'colspan', 'colspan2'));
    }

    public function edit(Inquiry $inquiry)
    {
        $users = User::where('role', 'client')->orWhere('role', 'staff')->get();
        $staffs = User::where('role', 'staff')->orWhere('role', 'admin')->get();
        return view('inquiries.edit', compact('inquiry', 'users', 'staffs'));
    }

    public function update(Request $request, Inquiry $inquiry)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'marketer' => 'required|string|max:255',
            'type' => 'required|in:product,part,both',
            'user_ids' => 'required|array',
            'second_user_id' => 'nullable|integer'
        ]);

        $inquiry->update($data);

        $inquiry->users()->sync($data['user_ids']);

        alert()->success('ویرایش موفق', 'ویرایش استعلام با موفقیت انجام شد');

        if ($inquiry->submit) {
            return redirect()->route('inquiries.submitted');
        }

        return redirect()->route('inquiries.index');
    }

    public function destroy(Inquiry $inquiry)
    {
        $specials = Special::all()->pluck('id')->toArray();

        $inquiryInvoices = Invoice::where('inquiry_id', $inquiry->id)->get();

        if (!$inquiryInvoices->isEmpty()) {
            alert()->error('هشدار حذف', 'این استعلام در پیش فاکتور ها استفاده شده است');
            return back();
        } else {
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
                    $product->amounts()->delete();
                }

                $inquiry->products()->delete();
            }

            $collectionParts = Part::where('inquiry_id', $inquiry->id)->get();
            foreach ($collectionParts as $collectionPart) {
                if (!$collectionPart->standard) {
                    $collectionPart->delete();
                }
            }

            if (!$inquiry->users->isEmpty()) {
                $inquiry->users()->detach();
            }

            $inquiry->delete();
        }

        alert()->success('حذف موفق', 'حذف استعلام با موفقیت انجام شد');

        return back();
    }

    public function submitted()
    {
        $inquiries = Inquiry::query();

        if (request()->has('model_id') && !is_null(request('model_id'))) {
            $inquiries = $inquiries->whereHas('products', function ($query) {
                $query->where('model_id', '=', request()->get('model_id'));
            });
        }

        if (request()->has('group_id') && !is_null(request('group_id'))) {
            $inquiries = $inquiries->whereHas('products', function ($query) {
                $query->where('group_id', '=', request()->get('group_id'));
            });
        }

        if (request()->has('search') && !is_null(request('search'))) {
            $inquiries = $inquiries->where('name', 'LIKE', "%" . request()->get('search') . "%")
                ->orWhere('marketer', 'LIKE', "%" . request()->get('search') . "%")
                ->orWhere('inquiry_number', 'LIKE', "%" . request()->get('search') . "%");
        }

        if (request()->has('user_id') && !is_null(request('user_id'))) {
            $inquiries = $inquiries->where('user_id', request('user_id'));
        }

        if (auth()->user()->role === 'admin') {
            $inquiries = $inquiries->where('submit', 1)->where('archive_at', null)->latest()->paginate(25);
        } else {
            $inquiries = $inquiries->where('submit', 1)->where('archive_at', null)->where('user_id', auth()->user()->id)
                ->orWhere('second_user_id', auth()->user()->id)->latest()->paginate(25);
        }

        $modells = Modell::where('parent_id', '!=', 0)->get();
        $groups = Group::all();
        $delete = DeleteButton::where('active', '1')->first();
        return view('inquiries.submitted', compact('inquiries', 'modells', 'groups', 'delete'));
    }

    public function submit(Inquiry $inquiry)
    {
        $setting = Setting::where('active', '1')->first();
        if ($setting) {
            if ($setting->price_color_type == 'month') {
                $lastTime = \Carbon\Carbon::now()->subMonth($setting->price_color_last_time);
            }
            if ($setting->price_color_type == 'day') {
                $lastTime = \Carbon\Carbon::now()->subDay($setting->price_color_last_time);
            }
            if ($setting->price_color_type == 'hour') {
                $lastTime = \Carbon\Carbon::now()->subHour($setting->price_color_last_time);
            }
        }

        $partIds = InquiryPrice::select(['part_id'])->distinct()->pluck('part_id')->toArray();


        foreach ($inquiry->products as $product) {
            $part = Part::find($product->part_id);

            if ($product->part_id != 0) {
                if (!$part->children->isEmpty()) {
                    foreach ($part->children as $child) {
                        if (!$child->children->isEmpty()) {
                            foreach ($child->children as $ch) {
                                if (!in_array($ch->id, $partIds)) {
                                    if (($ch->price_updated_at < $lastTime && $ch->price > 0) || ($ch->price_updated_at < $lastTime && $ch->price == 0)) {
                                        auth()->user()->inquiryPrices()->create([
                                            'part_id' => $ch->id,
                                            'inquiry_id' => $inquiry->id
                                        ]);
                                    }
                                }
                            }
                        } else {
                            if (!in_array($child->id, $partIds)) {
                                if (($child->price_updated_at < $lastTime && $child->price > 0) || ($child->price_updated_at < $lastTime && $child->price == 0)) {

                                    auth()->user()->inquiryPrices()->create([
                                        'part_id' => $child->id,
                                        'inquiry_id' => $inquiry->id
                                    ]);
                                }
                            }
                        }
                    }
                } else {
                    if (!in_array($part->id, $partIds)) {
                        if (($part->price_updated_at < $lastTime && $part->price > 0) || ($part->price_updated_at < $lastTime && $part->price == 0)) {
                            auth()->user()->inquiryPrices()->create([
                                'part_id' => $part->id,
                                'inquiry_id' => $inquiry->id
                            ]);
                        }
                    }
                }
            } else {
                if ($product->amounts->isEmpty()) {
                    foreach ($modell->parts as $part) {
                        if (!$part->children->isEmpty()) {
                            foreach ($part->children as $child) {
                                if (!$child->children->isEmpty()) {
                                    foreach ($child->children as $ch) {
                                        if (!in_array($ch->id, $partIds)) {
                                            if (($ch->price_updated_at < $lastTime && $ch->price > 0) || ($ch->price_updated_at < $lastTime && $ch->price == 0)) {
                                                auth()->user()->inquiryPrices()->create([
                                                    'part_id' => $ch->id,
                                                    'inquiry_id' => $inquiry->id
                                                ]);
                                            }
                                        }
                                    }
                                } else {
                                    if (!in_array($child->id, $partIds)) {
                                        if (($child->price_updated_at < $lastTime && $child->price > 0) || ($child->price_updated_at < $lastTime && $child->price == 0)) {

                                            auth()->user()->inquiryPrices()->create([
                                                'part_id' => $child->id,
                                                'inquiry_id' => $inquiry->id
                                            ]);
                                        }
                                    }
                                }
                            }
                        } else {
                            if (!in_array($part->id, $partIds)) {
                                if (($part->price_updated_at < $lastTime && $part->price > 0) || ($part->price_updated_at < $lastTime && $part->price == 0)) {
                                    auth()->user()->inquiryPrices()->create([
                                        'part_id' => $part->id,
                                        'inquiry_id' => $inquiry->id
                                    ]);
                                }
                            }
                        }
                    }
                } else {
                    foreach ($product->amounts as $amount) {
                        $part = Part::find($amount->part_id);

                        if ($amount->value > 0) {
                            if (!$part->children->isEmpty()) {
                                foreach ($part->children as $child) {
                                    if (!$child->children->isEmpty()) {
                                        foreach ($child->children as $ch) {
                                            if (!in_array($ch->id, $partIds)) {
                                                if (($ch->price_updated_at < $lastTime && $ch->price > 0) || ($ch->price_updated_at < $lastTime && $ch->price == 0)) {
                                                    auth()->user()->inquiryPrices()->create([
                                                        'part_id' => $ch->id,
                                                        'inquiry_id' => $inquiry->id
                                                    ]);
                                                }
                                            }
                                        }
                                    } else {
                                        if (!in_array($child->id, $partIds)) {
                                            if (($child->price_updated_at < $lastTime && $child->price > 0) || ($child->price_updated_at < $lastTime && $child->price == 0)) {

                                                auth()->user()->inquiryPrices()->create([
                                                    'part_id' => $child->id,
                                                    'inquiry_id' => $inquiry->id
                                                ]);
                                            }
                                        }
                                    }
                                }
                            } else {
                                if (!in_array($part->id, $partIds)) {
                                    if (($part->price_updated_at < $lastTime && $part->price > 0) || ($part->price_updated_at < $lastTime && $part->price == 0)) {
                                        auth()->user()->inquiryPrices()->create([
                                            'part_id' => $part->id,
                                            'inquiry_id' => $inquiry->id
                                        ]);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        if ($inquiry->products->isEmpty()) {
            alert()->error('محصولات', 'لطفا ابتدا محصولات را مشخص کنید');
            return back();
        }

        if (is_null($inquiry->description)) {
            alert()->error('شرایط استعلام', 'لطفا ابتدا شرایط استعلام را مشخص کنید');
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

        alert()->success('ثبت نهایی موفق', 'ثبت نهایی با موفقیت انجام شد و برای مدیریت ارسال شد');

        return back();
    }

    public function priced()
    {

        $inquiries = Inquiry::query();

        if (request()->has('model_id') && !is_null(request('model_id'))) {
            $inquiries = $inquiries->whereHas('products', function ($query) {
                $query->where('model_id', '=', request()->get('model_id'));
            });
        }

        if (request()->has('group_id') && !is_null(request('group_id'))) {
            $inquiries = $inquiries->whereHas('products', function ($query) {
                $query->where('group_id', '=', request()->get('group_id'));
            });
        }

        if (request()->has('search') && !is_null(request('search'))) {
            $inquiries = $inquiries->where('name', 'LIKE', "%" . request()->get('search') . "%")
                ->orWhere('marketer', 'LIKE', "%" . request()->get('search') . "%")
                ->orWhere('inquiry_number', 'LIKE', "%" . request()->get('search') . "%");
        }

        if (request()->has('user_id') && !is_null(request('user_id'))) {
            $inquiries = $inquiries->where('user_id', request('user_id'));
        }

        if (auth()->user()->role === 'admin') {
            $inquiries = $inquiries->where('archive_at', '!=', null)->orderBy('inquiry_number', 'DESC')->paginate(25)->withQueryString();
        } else {
            $inquiries = $inquiries->where('archive_at', '!=', null)->where('user_id', auth()->user()->id)
                ->orWhere('second_user_id', auth()->user()->id)->orderBy('inquiry_number', 'DESC')->paginate(25)->withQueryString();
        }

        $modells = Modell::where('parent_id', '!=', 0)->get();
        $groups = Group::all();
        $delete = DeleteButton::where('active', '1')->first();
        return view('inquiries.priced', compact('inquiries', 'modells', 'groups', 'delete'));
    }

    public function copy(Inquiry $inquiry)
    {
        $newInquiry = $inquiry->replicate()->fill([
            'archive_at' => null,
            'submit' => false,
            'price' => 0,
            'inquiry_number' => null,
            'copy_id' => $inquiry->id
        ]);
        $newInquiry->save();
        $newInquiry->users()->sync($inquiry->users);

        foreach ($inquiry->products as $product) {
            if ($product->part_id == 0) {
                $newProduct = $product->replicate()->fill([
                    'percent' => 0,
                    'old_percent' => $product->percent,
                    'inquiry_id' => $newInquiry->id,
                    'price' => 0
                ]);
                $newProduct->save();

                if (!$product->attributeValues->isEmpty()) {
                    foreach ($product->attributeValues as $value) {
                        $newProduct->attributeValues()->attach($value->id);
                    }
                }

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

                        $coilInput = CoilInput::where('part_id', $part->id)->where('inquiry_id', $inquiry->id)->first();

                        if (!is_null($coilInput)) {
                            CoilInput::create([
                                'loole_messi' => $coilInput->loole_messi,
                                'fin_coil' => $coilInput->fin_coil,
                                'tedad_radif_coil' => $coilInput->tedad_radif_coil,
                                'fin_dar_inch' => $coilInput->fin_dar_inch,
                                'zekhamat_frame_coil' => $coilInput->zekhamat_frame_coil,
                                'pooshesh_khordegi' => $coilInput->pooshesh_khordegi,
                                'collector_ahani' => $coilInput->collector_ahani,
                                'collector_messi' => $coilInput->collector_messi,
                                'electrod_noghre' => $coilInput->electrod_noghre,
                                'noe_coil' => $coilInput->noe_coil,
                                'toole_coil' => $coilInput->toole_coil,
                                'tedad_loole_dar_radif' => $coilInput->tedad_loole_dar_radif,
                                'tedad_mogheyiat_loole' => $coilInput->tedad_mogheyiat_loole,
                                'tedad_madar_loole' => $coilInput->tedad_madar_loole,
                                'kham' => $coilInput->kham,
                                'tedad_madar_coil' => $coilInput->tedad_madar_coil,
                                'tedad_soorakh_pakhshkon' => $coilInput->tedad_soorakh_pakhshkon,
                                'sathe_coil' => $coilInput->sathe_coil,
                                'type' => $coilInput->type,
                                'part_id' => $newPart->id,
                                'inquiry_id' => $newInquiry->id,
                            ]);
                        }

                        $newPart->categories()->syncWithoutDetaching($part->categories);

                        foreach ($part->children()->wherePivot('head_part_id', null)->orderByPivot('sort', 'ASC')->get() as $child) {
                            $newPart->children()->syncWithoutDetaching([
                                $child->id => [
                                    'value' => $child->pivot->value
                                ]
                            ]);

                            if (!$child->children->isEmpty()) {
                                foreach ($child->children()->wherePivot('head_part_id', $part->id)->orderByPivot('sort', 'ASC')->get() as $ch) {
                                    DB::table('part_child')->insert([
                                        'parent_part_id' => $ch->id,
                                        'child_part_id' => $child->id,
                                        'head_part_id' => $newPart->id,
                                        'value' => $ch->pivot->value,
                                        'sort' => $ch->pivot->sort,
                                        'datasheet' => $ch->pivot->datasheet,
                                    ]);
                                }
                            }
                        }

                        $totalPrice = 0;
                        foreach ($newPart->children as $child) {
                            $totalPrice += ($child->price * $child->pivot->value);
                        }
                        $newPart->price = $totalPrice;
                        $newPart->save();

                        $newAmount = $amount->replicate()->fill([
                            'value' => $amount->value,
                            'product_id' => $newProduct->id,
                            'part_id' => $newPart->id,
                            'price' => max($amount->price, 0)
                        ]);
                        $newAmount->save();
                    } else {
                        $newAmount = $amount->replicate()->fill([
                            'value' => $amount->value,
                            'product_id' => $newProduct->id,
                            'part_id' => $amount->part_id,
                            'price' => max($amount->price, 0)
                        ]);
                        $newAmount->save();
                    }
                }
            } else {
                $part = Part::find($product->part_id);
                $category = $part->categories()->latest()->first();
                $lastPart = $category->parts()->latest()->first();
                $code = str_pad($lastPart->code + 1, 4, "0", STR_PAD_LEFT);

                if ($part->coil == '1' && $part->collection == '1' && !is_null($part->inquiry_id)) {
                    $newPart = $part->replicate()->fill([
                        'code' => $code,
                        'name' => $part->name,
                        'inquiry_id' => $newInquiry->id,
                    ]);
                    $newPart->save();

                    $coilInput = CoilInput::where('part_id', $part->id)->where('inquiry_id', $inquiry->id)->first();

                    if (!is_null($coilInput)) {
                        CoilInput::create([
                            'loole_messi' => $coilInput->loole_messi,
                            'fin_coil' => $coilInput->fin_coil,
                            'tedad_radif_coil' => $coilInput->tedad_radif_coil,
                            'fin_dar_inch' => $coilInput->fin_dar_inch,
                            'zekhamat_frame_coil' => $coilInput->zekhamat_frame_coil,
                            'pooshesh_khordegi' => $coilInput->pooshesh_khordegi,
                            'collector_ahani' => $coilInput->collector_ahani,
                            'collector_messi' => $coilInput->collector_messi,
                            'electrod_noghre' => $coilInput->electrod_noghre,
                            'noe_coil' => $coilInput->noe_coil,
                            'toole_coil' => $coilInput->toole_coil,
                            'tedad_loole_dar_radif' => $coilInput->tedad_loole_dar_radif,
                            'tedad_mogheyiat_loole' => $coilInput->tedad_mogheyiat_loole,
                            'tedad_madar_loole' => $coilInput->tedad_madar_loole,
                            'kham' => $coilInput->kham,
                            'tedad_madar_coil' => $coilInput->tedad_madar_coil,
                            'tedad_soorakh_pakhshkon' => $coilInput->tedad_soorakh_pakhshkon,
                            'sathe_coil' => $coilInput->sathe_coil,
                            'type' => $coilInput->type,
                            'part_id' => $newPart->id,
                            'inquiry_id' => $newInquiry->id,
                        ]);
                    }

                    $newPart->categories()->syncWithoutDetaching($part->categories);

                    foreach ($part->children()->wherePivot('head_part_id', null)->orderByPivot('sort', 'ASC')->get() as $child) {
                        $newPart->children()->syncWithoutDetaching([
                            $child->id => [
                                'value' => $child->pivot->value
                            ]
                        ]);

                        if (!$child->children->isEmpty()) {
                            foreach ($child->children()->wherePivot('head_part_id', $part->id)->orderByPivot('sort', 'ASC')->get() as $ch) {
                                DB::table('part_child')->insert([
                                    'parent_part_id' => $ch->id,
                                    'child_part_id' => $child->id,
                                    'head_part_id' => $newPart->id,
                                    'value' => $ch->pivot->value,
                                    'sort' => $ch->pivot->sort,
                                    'datasheet' => $ch->pivot->datasheet,
                                ]);
                            }
                        }
                    }

                    $totalPrice = 0;
                    foreach ($newPart->children as $child) {
                        $totalPrice += ($child->price * $child->pivot->value);
                    }
                    $newPart->price = $totalPrice;
                    $newPart->save();

                    $newProduct = $product->replicate()->fill([
                        'percent' => 0,
                        'old_percent' => $product->percent,
                        'inquiry_id' => $newInquiry->id,
                        'price' => 0,
                        'part_id' => $newPart->id
                    ]);

                } else {
                    $newProduct = $product->replicate()->fill([
                        'percent' => 0,
                        'old_percent' => $product->percent,
                        'inquiry_id' => $newInquiry->id,
                        'price' => 0,
                        'part_id' => $part->id
                    ]);

                }
                $newProduct->save();
                if (!$product->attributeValues->isEmpty()) {
                    foreach ($product->attributeValues as $value) {
                        $newProduct->attributeValues()->attach($value->id);
                    }
                }
            }
        }

        alert()->success('کپی موفق', 'کپی با موفقیت انجام شد و برای کاربر ارسال شد');

        return back();
    }

    public function correction(Request $request, Inquiry $inquiry)
    {
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
            if ($product->part_id == 0) {
                $newProduct = $product->replicate()->fill([
                    'percent' => 0,
                    'old_percent' => $product->percent,
                    'inquiry_id' => $newInquiry->id,
                    'price' => 0
                ]);
                $newProduct->save();

                if (!$product->attributeValues->isEmpty()) {
                    foreach ($product->attributeValues as $value) {
                        $newProduct->attributeValues()->attach($value->id);
                    }
                }

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

                        $coilInput = CoilInput::where('part_id', $part->id)->where('inquiry_id', $inquiry->id)->first();

                        if (!is_null($coilInput)) {
                            CoilInput::create([
                                'loole_messi' => $coilInput->loole_messi,
                                'fin_coil' => $coilInput->fin_coil,
                                'tedad_radif_coil' => $coilInput->tedad_radif_coil,
                                'fin_dar_inch' => $coilInput->fin_dar_inch,
                                'zekhamat_frame_coil' => $coilInput->zekhamat_frame_coil,
                                'pooshesh_khordegi' => $coilInput->pooshesh_khordegi,
                                'collector_ahani' => $coilInput->collector_ahani,
                                'collector_messi' => $coilInput->collector_messi,
                                'electrod_noghre' => $coilInput->electrod_noghre,
                                'noe_coil' => $coilInput->noe_coil,
                                'toole_coil' => $coilInput->toole_coil,
                                'tedad_loole_dar_radif' => $coilInput->tedad_loole_dar_radif,
                                'tedad_mogheyiat_loole' => $coilInput->tedad_mogheyiat_loole,
                                'tedad_madar_loole' => $coilInput->tedad_madar_loole,
                                'kham' => $coilInput->kham,
                                'tedad_madar_coil' => $coilInput->tedad_madar_coil,
                                'tedad_soorakh_pakhshkon' => $coilInput->tedad_soorakh_pakhshkon,
                                'sathe_coil' => $coilInput->sathe_coil,
                                'type' => $coilInput->type,
                                'part_id' => $newPart->id,
                                'inquiry_id' => $newInquiry->id,
                            ]);
                        }

                        $newPart->categories()->syncWithoutDetaching($part->categories);

                        foreach ($part->children()->wherePivot('head_part_id', null)->orderByPivot('sort', 'ASC')->get() as $child) {
                            $newPart->children()->syncWithoutDetaching([
                                $child->id => [
                                    'value' => $child->pivot->value
                                ]
                            ]);

                            if (!$child->children->isEmpty()) {
                                foreach ($child->children()->wherePivot('head_part_id', $part->id)->orderByPivot('sort', 'ASC')->get() as $ch) {
                                    DB::table('part_child')->insert([
                                        'parent_part_id' => $ch->id,
                                        'child_part_id' => $child->id,
                                        'head_part_id' => $newPart->id,
                                        'value' => $ch->pivot->value,
                                        'sort' => $ch->pivot->sort,
                                        'datasheet' => $ch->pivot->datasheet,
                                    ]);
                                }
                            }
                        }

                        $totalPrice = 0;
                        foreach ($newPart->children as $child) {
                            $totalPrice += ($child->price * $child->pivot->value);
                        }
                        $newPart->price = $totalPrice;
                        $newPart->save();

                        $newAmount = $amount->replicate()->fill([
                            'value' => $amount->value,
                            'product_id' => $newProduct->id,
                            'part_id' => $newPart->id,
                            'price' => max($amount->price, 0)
                        ]);
                        $newAmount->save();
                    } else {
                        $newAmount = $amount->replicate()->fill([
                            'value' => $amount->value,
                            'product_id' => $newProduct->id,
                            'part_id' => $amount->part_id,
                            'price' => max($amount->price, 0)
                        ]);
                        $newAmount->save();
                    }
                }
            } else {
                $part = Part::find($product->part_id);
                $category = $part->categories()->latest()->first();
                $lastPart = $category->parts()->latest()->first();
                $code = str_pad($lastPart->code + 1, 4, "0", STR_PAD_LEFT);

                if ($part->coil == '1' && $part->collection == '1' && !is_null($part->inquiry_id)) {
                    $newPart = $part->replicate()->fill([
                        'code' => $code,
                        'name' => $part->name,
                        'inquiry_id' => $newInquiry->id,
                    ]);
                    $newPart->save();

                    $coilInput = CoilInput::where('part_id', $part->id)->where('inquiry_id', $inquiry->id)->first();

                    if (!is_null($coilInput)) {
                        CoilInput::create([
                            'loole_messi' => $coilInput->loole_messi,
                            'fin_coil' => $coilInput->fin_coil,
                            'tedad_radif_coil' => $coilInput->tedad_radif_coil,
                            'fin_dar_inch' => $coilInput->fin_dar_inch,
                            'zekhamat_frame_coil' => $coilInput->zekhamat_frame_coil,
                            'pooshesh_khordegi' => $coilInput->pooshesh_khordegi,
                            'collector_ahani' => $coilInput->collector_ahani,
                            'collector_messi' => $coilInput->collector_messi,
                            'electrod_noghre' => $coilInput->electrod_noghre,
                            'noe_coil' => $coilInput->noe_coil,
                            'toole_coil' => $coilInput->toole_coil,
                            'tedad_loole_dar_radif' => $coilInput->tedad_loole_dar_radif,
                            'tedad_mogheyiat_loole' => $coilInput->tedad_mogheyiat_loole,
                            'tedad_madar_loole' => $coilInput->tedad_madar_loole,
                            'kham' => $coilInput->kham,
                            'tedad_madar_coil' => $coilInput->tedad_madar_coil,
                            'tedad_soorakh_pakhshkon' => $coilInput->tedad_soorakh_pakhshkon,
                            'sathe_coil' => $coilInput->sathe_coil,
                            'type' => $coilInput->type,
                            'part_id' => $newPart->id,
                            'inquiry_id' => $newInquiry->id,
                        ]);
                    }

                    $newPart->categories()->syncWithoutDetaching($part->categories);

                    foreach ($part->children()->wherePivot('head_part_id', null)->orderByPivot('sort', 'ASC')->get() as $child) {
                        $newPart->children()->syncWithoutDetaching([
                            $child->id => [
                                'value' => $child->pivot->value
                            ]
                        ]);

                        if (!$child->children->isEmpty()) {
                            foreach ($child->children()->wherePivot('head_part_id', $part->id)->orderBy('sort', 'ASC')->get() as $ch) {
                                DB::table('part_child')->insert([
                                    'parent_part_id' => $ch->id,
                                    'child_part_id' => $child->id,
                                    'head_part_id' => $newPart->id,
                                    'value' => $ch->pivot->value,
                                    'sort' => $ch->pivot->sort,
                                    'datasheet' => $ch->pivot->datasheet,
                                ]);
                            }
                        }
                    }

                    $totalPrice = 0;
                    foreach ($newPart->children as $child) {
                        $totalPrice += ($child->price * $child->pivot->value);
                    }
                    $newPart->price = $totalPrice;
                    $newPart->save();

                    $newProduct = $product->replicate()->fill([
                        'percent' => 0,
                        'old_percent' => $product->percent,
                        'inquiry_id' => $newInquiry->id,
                        'price' => 0,
                        'part_id' => $newPart->id
                    ]);

                } else {
                    $newProduct = $product->replicate()->fill([
                        'percent' => 0,
                        'old_percent' => $product->percent,
                        'inquiry_id' => $newInquiry->id,
                        'price' => 0,
                        'part_id' => $part->id
                    ]);

                }
                $newProduct->save();
                if (!$product->attributeValues->isEmpty()) {
                    foreach ($product->attributeValues as $value) {
                        $newProduct->attributeValues()->attach($value->id);
                    }
                }
            }
        }

        alert()->success('اطلاح موفق', 'اصلاح استعلام با موفقیت انجام شد و برای کاربر ارسال شد');

        return back();
    }

    public function submittedCorrection(Request $request, Inquiry $inquiry)
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

        foreach ($inquiry->products as $product) {
            $product->price = 0;
            $product->percent = 0;
            $product->old_percent = $product->percent;
            $product->save();
        }

        //Send Notification
        //if ($user) {
        //    $user->notify(new CorrectionInquiryNotification($inquiry));
        //}

        alert()->success('اصلاح موفق', 'اصلاح استعلام با موفقیت انجام شد و برای کاربر ارسال شد');

        return back();
    }

    public function referral(Request $request, Inquiry $inquiry)
    {
        $user = User::find($request['user_id']);

        $newInquiry = $inquiry->replicate()->fill([
            'archive_at' => null,
            'submit' => false,
            'price' => 0,
            'inquiry_number' => null,
            'user_id' => $user->id,
            'manager' => $user->name
        ]);
        $newInquiry->save();

        foreach ($inquiry->products as $product) {
            if ($product->part_id == 0) {
                $newProduct = $product->replicate()->fill([
                    'percent' => 0,
                    'old_percent' => $product->percent,
                    'inquiry_id' => $newInquiry->id,
                    'price' => 0
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
                        $newPart->price = $totalPrice;
                        $newPart->save();
                    }

                    $newAmount = $amount->replicate()->fill([
                        'value' => $amount->value,
                        'product_id' => $newProduct->id,
                        'part_id' => $amount->part_id,
                        'price' => max($amount->price, 0)
                    ]);
                    $newAmount->save();
                }
            } else {
                $part = Part::find($product->part_id);
                $category = $part->categories()->latest()->first();
                $lastPart = $category->parts()->latest()->first();
                $code = str_pad($lastPart->code + 1, 4, "0", STR_PAD_LEFT);

                if ($part->coil == '1' && $part->collection == '1' && !is_null($part->inquiry_id)) {
                    $newPart = $part->replicate()->fill([
                        'code' => $code,
                        'inquiry_id' => $newInquiry->id
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
                    $newPart->part_price = $totalPrice;
                    $newPart->save();

                    $newProduct = $product->replicate()->fill([
                        'percent' => 0,
                        'old_percent' => $product->percent,
                        'inquiry_id' => $newInquiry->id,
                        'price' => 0,
                        'part_id' => $newPart->id
                    ]);
                    $newProduct->save();
                } else {
                    $newProduct = $product->replicate()->fill([
                        'percent' => 0,
                        'old_percent' => $product->percent,
                        'inquiry_id' => $newInquiry->id,
                        'price' => 0,
                        'part_id' => $part->id
                    ]);
                    $newProduct->save();
                }
            }
        }

        alert()->success('ارجاع موفق', 'ارجاع با موفقیت انجام شد و برای کاربر ارسال شد');

        return back();
    }

    public function tmpReferral(Request $request, Inquiry $inquiry)
    {
        $inquiry->update([
            'user_id' => $request['user_id']
        ]);

        alert()->success('ارجاع موفق', 'ارجاع با موفقیت انجام شد و برای کاربر ارسال شد');

        return back();
    }

    public function restore(Inquiry $inquiry)
    {
        foreach ($inquiry->products as $product) {
            $product->old_percent = $product->percent;
            $product->percent = 0;
            $product->price = 0;
            $product->save();
        }

        $inquiry->update([
            'archive_at' => null,
            'submit' => 1,
            'price' => 0,
        ]);

        alert()->success('بازگردانی موفق', 'بازگردانی استعلام با موفقیت انجام شد');

        return back();
    }

    public function products(Inquiry $inquiry)
    {
        if (auth()->user()->role == 'admin') {
            $inquiries = Inquiry::where('archive_at', null)->get();
        } else {
            $inquiries = Inquiry::where('user_id', auth()->user()->id)->where('archive_at', null)->get();
        }
        return view('inquiries.products', compact('inquiry', 'inquiries'));
    }

    public function addProductToInquiry(Request $request, Product $product)
    {
        $request->validate([
            'inquiry_id' => 'required|integer'
        ]);

        $inquiry = Inquiry::find($request->inquiry_id);

        if ($inquiry->products->isEmpty()) {
            $sort = 1;
        } else {
            $productSort = $inquiry->products()->max('sort');
            $sort = $productSort + 1;
        }

        $newProduct = $product->replicate()->fill([
            'percent' => 0,
            'old_percent' => 0,
            'inquiry_id' => $inquiry->id,
            'sort' => $sort
        ]);
        $newProduct->save();

        if (!$product->attributeValues->isEmpty()) {
            foreach ($product->attributeValues as $value) {
                $newProduct->attributeValues()->attach($value->id);
            }
        }

        foreach ($product->amounts as $amount) {
            $part = Part::find($amount->part_id);
            $category = $part->categories()->latest()->first();
            $lastPart = $category->parts()->latest()->first();
            $code = str_pad($lastPart->code + 1, 4, "0", STR_PAD_LEFT);

            if ($part->coil == '1' && $part->collection == '1' && !is_null($part->inquiry_id)) {
                $newPart = $part->replicate()->fill([
                    'code' => $code,
                    'name' => $part->name,
                    'inquiry_id' => $inquiry->id,
                    'product_id' => $newProduct->id
                ]);
                $newPart->save();

                $newPart->categories()->syncWithoutDetaching($part->categories);

                $coilInput = CoilInput::where('part_id', $part->id)->where('inquiry_id', $inquiry->id)->first();

                if (!is_null($coilInput)) {
                    CoilInput::create([
                        'loole_messi' => $coilInput->loole_messi,
                        'fin_coil' => $coilInput->fin_coil,
                        'tedad_radif_coil' => $coilInput->tedad_radif_coil,
                        'fin_dar_inch' => $coilInput->fin_dar_inch,
                        'zekhamat_frame_coil' => $coilInput->zekhamat_frame_coil,
                        'pooshesh_khordegi' => $coilInput->pooshesh_khordegi,
                        'collector_ahani' => $coilInput->collector_ahani,
                        'collector_messi' => $coilInput->collector_messi,
                        'electrod_noghre' => $coilInput->electrod_noghre,
                        'noe_coil' => $coilInput->noe_coil,
                        'toole_coil' => $coilInput->toole_coil,
                        'tedad_loole_dar_radif' => $coilInput->tedad_loole_dar_radif,
                        'tedad_mogheyiat_loole' => $coilInput->tedad_mogheyiat_loole,
                        'tedad_madar_loole' => $coilInput->tedad_madar_loole,
                        'kham' => $coilInput->kham,
                        'tedad_madar_coil' => $coilInput->tedad_madar_coil,
                        'tedad_soorakh_pakhshkon' => $coilInput->tedad_soorakh_pakhshkon,
                        'sathe_coil' => $coilInput->sathe_coil,
                        'type' => $coilInput->type,
                        'part_id' => $newPart->id,
                        'inquiry_id' => $newInquiry->id,
                    ]);
                }

                foreach ($part->children()->where('head_part_id', null)->orderByPivot('sort', 'ASC')->get() as $child) {
                    $newPart->children()->syncWithoutDetaching([
                        $child->id => [
                            'value' => $child->pivot->value
                        ]
                    ]);

                    if (!$child->children->isEmpty()) {
                        foreach ($child->children()->where('head_part_id', $part->id)->orderBy('sort', 'ASC')->get() as $ch) {
                            DB::table('part_child')->insert([
                                'parent_part_id' => $ch->id,
                                'child_part_id' => $child->id,
                                'head_part_id' => $newPart->id,
                                'value' => $ch->pivot->value,
                                'sort' => $ch->pivot->sort,
                                'datasheet' => $ch->pivot->datasheet,
                            ]);
                        }
                    }
                }

                $totalPrice = 0;
                foreach ($newPart->children as $child) {
                    $totalPrice += ($child->price * $child->pivot->value);
                }
                $newPart->price = $totalPrice;
                $newPart->save();
            }

            $newAmount = $amount->replicate()->fill([
                'value' => $amount->value,
                'product_id' => $newProduct->id,
                'part_id' => $amount->part_id,
                'price' => max($amount->price, 0)
            ]);
            $newAmount->save();
        }

        alert()->success('ثبت موفق', 'محصول با موفقیت به استعلام اضافه شد');

        return back();
    }

    public function description(Inquiry $inquiry)
    {
        $terms = InquiryTerm::all();
        return view('inquiries.description', compact('inquiry', 'terms'));
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

        if ($inquiry->type == 'part') {
            return redirect()->route('inquiries.parts.index', $inquiry->id);
        }
        return redirect()->route('inquiries.product.index', $inquiry->id);
    }

    public function finalSubmit(Inquiry $inquiry)
    {
        if (!$inquiry->products->pluck('percent')->contains(0)) {
            $inquiry->archive_at = now();
            $finalTotalPrice = 0;
            foreach ($inquiry->products as $product) {
                $finalTotalPrice += $product->price * $product->quantity;
            }
            $inquiry->price = $finalTotalPrice;
            if (is_null($inquiry->inquiry_number)) {
                $data['inquiry_number'] = '';
                $data = $this->getCode($data);
                $inquiry->inquiry_number = $data['inquiry_number'];
            }
            $inquiry->copy_id = null;
            $inquiry->correction_id = null;
            $inquiry->save();

            alert()->success('آرشیو استعلام', 'آرشیو استعلام با موفقیت انجام شد و برای کاربر ارسال شد');
            return redirect()->route('inquiries.priced');
        }

        alert()->error('خطا', 'ضریب گذاری برای همه محصولات انجام نشده');
        return back();

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
        $first4 = substr((string)$number, 0, 4);

        if (!$inquiries->isEmpty()) {
            if ($year > (int)$first4) {
                $inquiryNumber = '00001';
                $data['inquiry_number'] = $year . $inquiryNumber;
            } else {
                $inquiryNumber = str_pad($number + 1, 5, "0", STR_PAD_LEFT);
                $data['inquiry_number'] = $inquiryNumber;
            }
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

    public function addToInvoice(Request $request, Inquiry $inquiry)
    {
        $request->validate([
            'buyer_name' => 'required|string|max:255',
            'buyer_position' => 'nullable|string|max:255',
        ]);

        $sameInvoices = Invoice::where('inquiry_id', $inquiry->id)->get();
        if (!$sameInvoices->isEmpty()) {
            if (count($sameInvoices) > 1) {
                $explodeNumber = explode('-', $sameInvoices->last()->invoice_number)[1];
                $number = (int)$explodeNumber + 1;
                $invoiceNumber = $inquiry->inquiry_number . '-' . $number;
            } else {
                $invoiceNumber = $inquiry->inquiry_number . '-1';
            }
        } else {
            $invoiceNumber = $inquiry->inquiry_number;
        }

        $newInvoice = $inquiry->invoices()->create([
            'price' => 0,
            'description' => $inquiry->description,
            'user_id' => $inquiry->user_id,
            'tax' => true,
            'buyer_name' => $request->buyer_name,
            'buyer_position' => $request->buyer_position,
            'invoice_number' => $invoiceNumber
        ]);

        foreach ($inquiry->products as $product) {
            $newInvoice->products()->create([
                'percent' => 0.00,
                'quantity' => $product->quantity ?? 0,
                'quantity2' => $product->quantity2 ?? 0,
                'price' => $product->price,
                'model_custom_name' => $product->model_custom_name ?? null,
                'description' => $product->description ?? null,
                'type' => $product->type ?? null,
                'group_id' => $product->group_id ?? null,
                'model_id' => $product->model_id ?? null,
                'part_id' => $product->part_id ?? null,
                'product_id' => $product->id,
                'show_price' => true,
                'sort' => $product->sort
            ]);
        }

        $newInvoice->users()->sync($inquiry->users);

        alert()->success('ثبت موفق', 'صدور پیش فاکتور برای این استعلام انجام شد');

        return redirect()->route('invoices.index');
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

    public function datasheet(Inquiry $inquiry)
    {
        return view('inquiries.datasheet', compact('inquiry'));
    }

    public function printDatasheet(Inquiry $inquiry)
    {
        return view('inquiries.print-datasheet', compact('inquiry'));
    }

    public function printPrice(Inquiry $inquiry)
    {
        return view('inquiries.print-price', compact('inquiry'));
    }

    public function deleteAll(Request $request)
    {
        $specials = Special::all()->pluck('id')->toArray();

        foreach ($request->inquiries as $id) {
            $inquiry = Inquiry::find($id);

            $inquiryInvoices = Invoice::where('inquiry_id', $inquiry->id)->get();

            if (!$inquiryInvoices->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'یکی از استعلام های انتخاب شده در پیش فاکتور ها استفاده شده است'
                ], 422);
            } else {
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
                        $product->amounts()->delete();
                    }

                    $inquiry->products()->delete();
                }

                $collectionParts = Part::where('inquiry_id', $inquiry->id)->get();
                foreach ($collectionParts as $collectionPart) {
                    if (!$collectionPart->standard) {
                        $collectionPart->delete();
                    }
                }

                if (!$inquiry->users->isEmpty()) {
                    $inquiry->users()->detach();
                }

                $inquiry->delete();
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'استعلام های انتخاب شده با موفقیت حذف شدند.'
        ], 200);
    }
}
