<?php

namespace App\Http\Controllers;

use App\Models\Amount;
use App\Models\Category;
use App\Models\Group;
use App\Models\Inquiry;
use App\Models\Modell;
use App\Models\Part;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Special;
use App\Models\User;
use App\Notifications\PercentInquiryNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class InquiryProductController extends Controller
{
    public function index(Inquiry $inquiry)
    {
        Gate::authorize('create-inquiry');

        return view('inquiry-product.index', compact('inquiry'));
    }

    public function create(Inquiry $inquiry)
    {
        Gate::authorize('create-inquiry');

        $groups = Group::all();
        return view('inquiry-product.create', compact('groups', 'inquiry'));
    }

    public function store(Request $request, Inquiry $inquiry)
    {
        Gate::authorize('create-inquiry');

        $request->validate([
            'group_id' => 'required|integer',
            'model_id' => 'required|integer',
            'quantity' => 'required|numeric|min:1',
            'description' => 'nullable|string|max:255',
            'model_custom_name' => 'string|max:255|nullable',
        ]);

        $sort = 0;
        if ($inquiry->products->isEmpty()) {
            $sort = 1;
        } else {
            $product = $inquiry->products()->max('sort');
            $sort = $product + 1;
        }

        $inquiry->products()->create([
            'group_id' => $request['group_id'],
            'model_id' => $request['model_id'],
            'quantity' => $request['quantity'],
            'description' => $request['description'],
            'model_custom_name' => $request['model_custom_name'],
            'sort' => $sort,
        ]);

        alert()->success('ثبت موفق', 'ثبت محصول برای استعلام با موفقیت انجام شد');

        return redirect()->route('inquiries.product.index', $inquiry->id);
    }

    public function edit(Product $product)
    {
        Gate::authorize('create-inquiry');

        $inquiry = Inquiry::find($product->inquiry_id);

        return view('inquiry-product.edit', compact('product', 'inquiry'));
    }

    public function update(Request $request, Product $product)
    {
        Gate::authorize('create-inquiry');

        $request->validate([
            'quantity' => 'required|numeric',
            'description' => 'nullable|string|max:255',
            'model_custom_name' => 'string|max:255|nullable',
            'sort' => 'required|numeric'
        ]);

        $product->update([
            'quantity' => $request['quantity'],
            'description' => $request['description'],
            'model_custom_name' => $request['model_custom_name'],
            'sort' => $request['sort']
        ]);

        alert()->success('ویرایش موفق', 'ویرایش محصول با موفقیت انجام شد');

        if ($product->part_id == 0) {
            return redirect()->route('inquiries.product.index', $product->inquiry_id);
        } else {
            return redirect()->route('inquiries.parts.index', $product->inquiry_id);
        }
    }

    public function show(Product $product)
    {
        Gate::authorize('create-inquiry');

        if ($product->amounts->isEmpty()) {
            alert()->error('مقادیر محصولات', 'لطفا ابتدا مقادیر محصولات را مشخص کنید');
            return back();
        }

        $group = Group::find($product->group_id);
        $modell = Modell::find($product->model_id);
        $inquiry = Inquiry::find($product->inquiry_id);

        $totalPrice = 0;
        $totalGroupPrice = 0;
        $totalModellPrice = 0;

        return view('inquiry-product.show', compact('product', 'inquiry', 'group', 'modell', 'totalPrice'
            , 'totalGroupPrice', 'totalModellPrice'));
    }

    public function amounts(Product $product)
    {
        Gate::authorize('create-inquiry');

        $group = Group::find($product->group_id);
        $modell = Modell::find($product->model_id);
        $inquiry = Inquiry::find($product->inquiry_id);
        $amounts = Amount::where('product_id', $product->id)->orderBy('sort', 'ASC')->get();
        $specials = Special::all()->pluck('part_id')->toArray();
        $setting = Setting::where('active', '1')->first();
        return view('inquiry-product.amounts', compact('product', 'group', 'modell', 'inquiry', 'amounts', 'specials', 'setting'));
    }

    public function storeAmounts(Request $request, Product $product)
    {
        Gate::authorize('create-inquiry');

        $inquiry = Inquiry::find($product->inquiry_id);
        $modell = Modell::find($product->model_id);
        $amounts = Amount::where('product_id', $product->id)->get();

        if ($amounts->isEmpty() && !$modell->parts->isEmpty()) {
            $request->validate([
                'modellAmounts' => 'required|array',
                'modellAmounts.*' => 'nullable|numeric',
                'sorts' => 'required|array',
                'sorts.*' => 'nullable|numeric'
            ]);

            if (!$amounts->isEmpty()) {
                foreach ($amounts as $amount) {
                    $amount->delete();
                }
            }

            foreach ($request['part_ids'] as $index => $part) {
                $createdAmount = Amount::create([
                    'value' => $request->modellAmounts[$index] ?? 0,
                    'value2' => $request->units[$index] ?? null,
                    'product_id' => $product->id,
                    'part_id' => $part,
                    'sort' => $request->sorts[$index] ?? 0,
                ]);

                $special = Special::where('part_id', $part)->first();

                if (!is_null($special)) {
                    $createdAmount->price = session('price' . $part) ?? 0;
                    $createdAmount->save();
                    session()->forget('price' . $part);
                }
            }
        } else {
            $request->validate([
                'amounts' => 'required|array',
                'amounts.*' => 'nullable|numeric',
                'sorts' => 'required|array',
                'sorts.*' => 'nullable|numeric'
            ]);

            if (!$amounts->isEmpty()) {
                foreach ($amounts as $amount) {
                    $amount->delete();
                }
            }

            foreach ($request['part_ids'] as $index => $part) {
                $createdAmount = Amount::create([
                    'value' => $request->amounts[$index] ?? 0,
                    'value2' => $request->units[$index] ?? null,
                    'product_id' => $product->id,
                    'part_id' => $part,
                    'sort' => $request->sorts[$index] ?? 0,
                ]);

                $special = Special::where('part_id', $part)->first();

                if (!is_null($special)) {
                    $createdAmount->price = session('price' . $part) ?? 0;
                    $createdAmount->save();
                    session()->forget('price' . $part);
                }
                if (session()->has('selectedPart' . $part)) {
                    session()->forget('selectedPart' . $part);
                }
            }
        }

        $product->updated_at = now();
        $product->save();

        alert()->success('ثبت موفق', 'ثبت مقادیر با موفقیت انجام شد');

        return redirect()->route('inquiries.product.index', $inquiry->id);
    }

    public function percent(Product $product)
    {
        Gate::authorize('percent-inquiry');

        $group = Group::find($product->group_id);
        $modell = Modell::find($product->model_id);
        $inquiryPart = Part::find($product->part_id);
        $inquiry = Inquiry::find($product->inquiry_id);

        $totalPrice = 0;

        if (!is_null($group) && !is_null($modell)) {

            foreach ($product->amounts as $amount) {
                $part = Part::find($amount->part_id);
                $totalPrice += ($part->price * $amount->value);
            }
        }

        if (!is_null($inquiryPart)) {
            $totalPrice = $inquiryPart->price;
        }

        return view('inquiry-product.percent', compact('inquiry', 'group', 'modell', 'totalPrice', 'product'));
    }

    public function storePercent(Request $request, Product $product)
    {
        Gate::authorize('percent-inquiry');

        $request->validate([
            'percent' => 'required|numeric|between:1,3'
        ]);

        $group = Group::find($product->group_id);
        $modell = Modell::find($product->model_id);
        $inquiryPart = Part::find($product->part_id);
        $inquiry = Inquiry::find($product->inquiry_id);
        $user = User::find($inquiry->user_id);

        $totalPrice = 0;

        if (!is_null($group) && !is_null($modell)) {

            foreach ($product->amounts as $amount) {
                $part = Part::find($amount->part_id);
                $totalPrice += ($part->price * $amount->value);
            }
            $finalPrice = $totalPrice * $request['percent'];
        }

        if (!is_null($inquiryPart)) {
            $finalPrice = $inquiryPart->price * $request['percent'];
            $product->part_price = $inquiryPart->price;
            $product->save();
        }

        $product->update([
            'price' => $finalPrice,
            'percent' => $request['percent'],
        ]);

        foreach ($product->amounts as $amount) {
            $amountPrice = Part::find($amount->part_id)->price;
            $amount->price = $amountPrice;
            $amount->save();
        }

        if (!$inquiry->products->pluck('percent')->contains(0)) {
            $inquiry->archive_at = now();
            $finalTotalPrice = 0;
            foreach ($inquiry->products as $product) {
                $finalTotalPrice += $product->price * $product->quantity;
            }
            $inquiry->price = $finalTotalPrice;
            $inquiry->save();

            //Send Notification
            $user->notify(new PercentInquiryNotification($inquiry));

            alert()->success('آرشیو استعلام', 'آرشیو استعلام با موفقیت انجام شد و برای کاربر ارسال شد');
            return redirect()->route('inquiries.priced');
        }

        alert()->success('ثبت ضریب موفق', 'ثبت ضریب با موفقیت انجام شد');

        if (!is_null($group) && !is_null($modell)) {
            return redirect()->route('inquiries.product.index', $inquiry->id);
        }
        return redirect()->route('inquiries.parts.index', $inquiry->id);
    }

    public function destroy(Product $product)
    {
        Gate::authorize('create-inquiry');

        $collectionParts = Part::where('product_id', $product->id)->get();
        if (!$collectionParts->isEmpty()) {
            foreach ($collectionParts as $collectionPart) {
                $collectionPart->delete();
            }
        }

        if (!$product->amounts->isEmpty()) {
            $product->amounts()->delete();
        }

        $product->delete();

        alert()->success('حذف موفق', 'حذف محصول با موفقیت انجام شد');

        return back();
    }

    public function multiPercent(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'percent' => 'required|numeric|between:1,3'
        ]);

        foreach ($request->ids as $id) {
            $product = Product::find($id);
            $inquiry = Inquiry::find($product->inquiry_id);
            $user = User::find($inquiry->user_id);
            $group = Group::find($product->group_id);
            $modell = Modell::find($product->model_id);

            $totalGroupPrice = 0;
            $totalModellPrice = 0;

            if (!$modell->parts->isEmpty()) {
                foreach ($modell->parts as $part) {
                    $amount = $product->amounts()->where('part_id', $part->id)->first();
                    if ($amount) {
                        $totalModellPrice += ($part->price * $amount->value);
                    }
                }
            }

            if (!$group->parts->isEmpty()) {
                foreach ($group->parts as $part) {
                    $amount = $product->amounts()->where('part_id', $part->id)->first();
                    if ($amount) {
                        $totalGroupPrice += ($part->price * $amount->value);
                    }
                }
            }

            $totalPrice = $totalGroupPrice + $totalModellPrice;
            $finalPrice = $totalPrice * $request->percent;

            $product->update([
                'price' => $finalPrice,
                'percent' => $request->percent,
            ]);
        }

        if (!$inquiry->products->pluck('percent')->contains(0)) {
            $inquiry->archive_at = now();
            $finalTotalPrice = 0;
            foreach ($inquiry->products as $product) {
                $finalTotalPrice += $product->price * $product->quantity;
            }
            $inquiry->price = $finalTotalPrice;
            $inquiry->save();

            //Send Notification
            $user->notify(new PercentInquiryNotification($inquiry));
            return redirect()->route('inquiries.priced');
        }
    }

    public function changePart(Request $request)
    {
        $category = Category::find($request->id);
        $parts = $category->parts;
        return response(['data' => $parts]);
    }

    public function changePrice(Request $request)
    {
        $part = Part::find($request->id);
        $price = $part->price;
        return response(['price' => $price]);
    }

    public function getPart(Request $request)
    {
        $part = Part::find($request->id);
        return response(['data' => $part]);
    }
}
