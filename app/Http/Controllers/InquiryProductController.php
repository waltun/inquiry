<?php

namespace App\Http\Controllers;

use App\Models\Amount;
use App\Models\Category;
use App\Models\DeleteButton;
use App\Models\Group;
use App\Models\Inquiry;
use App\Models\InquiryPrice;
use App\Models\Modell;
use App\Models\Part;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Special;
use App\Models\User;
use App\Notifications\PercentInquiryNotification;
use Illuminate\Http\Request;

class InquiryProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:inquiry-products')->only(['index']);
        $this->middleware('can:create-inquiry-product')->only(['create', 'store']);
        $this->middleware('can:edit-inquiry-product')->only(['edit', 'update']);
        $this->middleware('can:show-inquiry-product')->only(['show']);
        $this->middleware('can:inquiry-product-amounts')->only(['amounts', 'storeAmounts']);
        $this->middleware('can:inquiry-product-percent')->only(['percent', 'storePercent']);
        $this->middleware('can:delete-inquiry-product')->only(['destroy']);
        $this->middleware('can:inquiry-product-multi-percent')->only(['multiPercent']);
        $this->middleware('can:inquiry-product-replicate')->only(['replicate']);
    }

    public function index(Inquiry $inquiry)
    {
        $delete = DeleteButton::where('active', '1')->first();
        return view('inquiry-product.index', compact('inquiry', 'delete'));
    }

    public function create(Inquiry $inquiry)
    {
        $groups = Group::all();
        return view('inquiry-product.create', compact('groups', 'inquiry'));
    }

    public function store(Request $request, Inquiry $inquiry)
    {
        $request->validate([
            'group_id' => 'required|integer',
            'model_id' => 'required|integer',
            'quantity' => 'required|numeric|min:1',
            'description' => 'nullable|string|max:255',
            'model_custom_name' => 'string|max:255|nullable',
            'property' => 'nullable|string|max:255'
        ]);

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
            'property' => $request['property'],
            'sort' => $sort,
        ]);

        alert()->success('ثبت موفق', 'ثبت محصول برای استعلام با موفقیت انجام شد');

        return redirect()->route('inquiries.product.index', $inquiry->id);
    }

    public function edit(Product $product)
    {
        $inquiry = Inquiry::find($product->inquiry_id);

        return view('inquiry-product.edit', compact('product', 'inquiry'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|numeric',
            'description' => 'nullable|string|max:255',
            'model_custom_name' => 'string|max:255|nullable',
            'property' => 'string|max:255|nullable',
            'sort' => 'required|numeric'
        ]);

        $product->update([
            'quantity' => $request['quantity'],
            'description' => $request['description'],
            'model_custom_name' => $request['model_custom_name'],
            'property' => $request['property'],
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
        $group = Group::find($product->group_id);
        $modell = Modell::find($product->model_id);
        $inquiry = Inquiry::find($product->inquiry_id);
        $amounts = Amount::where('product_id', $product->id)->orderBy('sort', 'ASC')->get();
        $specials = Special::all()->pluck('part_id')->toArray();

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

        return view('inquiry-product.amounts', compact('product', 'group', 'modell', 'inquiry', 'amounts', 'specials', 'setting'));
    }

    public function storeAmounts(Request $request, Product $product)
    {
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

            foreach ($request['part_ids'] as $index => $id) {
                $part = Part::find($id);
                $createdAmount = Amount::create([
                    'value' => $request->modellAmounts[$index] ?? 0,
                    'value2' => $request->units[$index] ?? null,
                    'product_id' => $product->id,
                    'part_id' => $id,
                    'sort' => $request->sorts[$index] ?? 0,
                    'weight' => $part->weight
                ]);

                $special = Special::where('part_id', $id)->first();

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

            foreach ($request['part_ids'] as $index => $id) {
                $part = Part::find($id);
                $createdAmount = Amount::create([
                    'value' => $request->amounts[$index] ?? 0,
                    'value2' => $request->units[$index] ?? null,
                    'product_id' => $product->id,
                    'part_id' => $id,
                    'sort' => $request->sorts[$index] ?? 0,
                    'weight' => $part->weight
                ]);

                $special = Special::where('part_id', $id)->first();

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

        return back();
    }

    public function percent(Product $product)
    {
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
            $totalPrice = $product->price == 0 ? $inquiryPart->price : $product->price;
        }

        return view('inquiry-product.percent', compact('inquiry', 'group', 'modell', 'totalPrice', 'product'));
    }

    public function storePercent(Request $request, Product $product)
    {
        $request->validate([
            'percent' => 'required|numeric|between:1,3'
        ]);

        $group = Group::find($product->group_id);
        $modell = Modell::find($product->model_id);
        $inquiryPart = Part::find($product->part_id);
        $inquiry = Inquiry::find($product->inquiry_id);
        $user = User::find($inquiry->user_id);

        $totalPrice = 0;
        $totalWeight = 0;

        if (!is_null($group) && !is_null($modell)) {
            foreach ($product->amounts as $amount) {
                $part = Part::find($amount->part_id);
                $totalPrice += $part->price * $amount->value;
                $totalWeight += $part->weight * $amount->value;
            }
            $finalPrice = $totalPrice * $request['percent'];
            $finalWeight = $totalWeight * $product->quantity;
        }

        if (!is_null($inquiryPart)) {
            if ($product->price == 0) {
                $finalPrice = $inquiryPart->price * $request['percent'];
            } else {
                $finalPrice = $product->price * $request['percent'];
            }
            $finalWeight = $inquiryPart->weight * $product->quantity;
            $product->part_price = $inquiryPart->price;
            $product->save();
        }

        $product->update([
            'price' => $finalPrice,
            'percent' => $request['percent'],
            'weight' => $finalWeight,
            'percent_by' => $request->user()->id,
        ]);

        foreach ($product->amounts as $amount) {
            $amountPrice = Part::find($amount->part_id)->price;
            $amountWeight = Part::find($amount->part_id)->weight;
            $amount->price = $amountPrice;
            $amount->weight = $amountWeight;
            $amount->save();
        }

        alert()->success('ثبت ضریب موفق', 'ثبت ضریب با موفقیت انجام شد');

        if (!is_null($group) && !is_null($modell)) {
            return redirect()->route('inquiries.product.index', $inquiry->id);
        }
        return redirect()->route('inquiries.parts.index', $inquiry->id);
    }


    public function destroy(Product $product)
    {
        $collectionParts = Part::where('product_id', $product->id)->get();
        if (!$collectionParts->isEmpty()) {
            foreach ($collectionParts as $collectionPart) {
                $collectionPart->delete();
            }
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
            $totalPrice = 0;

            foreach ($product->amounts as $amount) {
                $part = Part::find($amount->part_id);
                if ($product->price == 0) {
                    $totalPrice += ($part->price * $amount->value);
                } else {
                    $totalPrice += ($product->price * $amount->value);
                }
                $amountPrice = Part::find($amount->part_id)->price;
                $amount->price = $amountPrice;
                $amount->save();
            }

            $finalPrice = $totalPrice * $request->percent;

            $product->update([
                'price' => $finalPrice,
                'percent' => $request->percent,
                'percent_by' => $request->user()->id,
            ]);
        }
    }

    public function replicate(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|numeric',
            'model_custom_name' => 'nullable|string|max:255'
        ]);

        $inquiry = Inquiry::find($product->inquiry_id);

        if ($inquiry->products->isEmpty()) {
            $sort = 1;
        } else {
            $inquiryProduct = $inquiry->products()->max('sort');
            $sort = $inquiryProduct + 1;
        }

        $newProduct = $product->replicate()->fill([
            'quantity' => $request['quantity'],
            'model_custom_name' => $request['model_custom_name'] ?? null,
            'sort' => $sort
        ]);
        $newProduct->save();

        if (!$product->amounts->isEmpty()) {
            foreach ($product->amounts as $amount) {
                $part = Part::find($amount->part_id);
                $category = $part->categories()->latest()->first();
                $lastPart = $category->parts()->latest()->first();
                $code = str_pad($lastPart->code + 1, 4, "0", STR_PAD_LEFT);

                if ($part->coil == '1' && $part->collection == '1' && !is_null($part->inquiry_id)) {
                    $newPart = $part->replicate()->fill([
                        'code' => $code,
                        'name' => $part->name,
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

                    $newPart->save();
                }
                $newProduct->amounts()->save($amount->replicate());
            }
        }

        alert()->success('کپی موفق', 'کپی محصول با موفقیت انجام شد');

        return back();
    }

    public function changePart(Request $request)
    {
        $category = Category::find($request->id);
        $part = Part::find($request->part);
        $specials = Special::all()->pluck('part_id')->toArray();
        $product = Product::find($request->product);

        if ((in_array($part->id, $specials) && !$part->standard) || ($part->coil && !$part->standard)) {
            $parts = $category->parts()->where('product_id', $product->id)->get();
            if ($parts->isEmpty()) {
                $parts[] = $category->parts()->first();
            }
        } else {
            $parts = $category->parts;
        }

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
}
