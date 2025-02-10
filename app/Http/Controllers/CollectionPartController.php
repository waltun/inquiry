<?php

namespace App\Http\Controllers;

use App\Models\Amount;
use App\Models\Category;
use App\Models\ContractProductAmount;
use App\Models\DeleteButton;
use App\Models\Part;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class CollectionPartController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:collections')->only(['index']);
        $this->middleware('can:collection-parts')->only(['parts']);
        $this->middleware('can:collection-add-part')->only(['create', 'store']);
        $this->middleware('can:delete-collection')->only(['destroy']);
        $this->middleware('can:collection-delete-part')->only(['destroyPart']);
        //$this->middleware('can:collection-amounts')->only(['amounts', 'storeAmounts']);
        $this->middleware('can:replicate-collection')->only(['replicate']);
        $this->middleware('can:print-collection')->only(['print']);
    }

    public function index()
    {
        $parts = Part::query();
        $setting = Setting::where('active', '1')->first();
        $delete = DeleteButton::where('active', '1')->first();
        $categories = Category::where('parent_id', 0)->get();

        if ($keyword = request('search')) {
            $parts->where('collection', true)
                ->where('coil', false)
                ->where('name', 'LIKE', "%{$keyword}%");
        }

        if (!is_null(request('category3'))) {
            if (request()->has('category3')) {
                $parts = $parts->whereHas('categories', function ($q) {
                    $q->where('category_id', request('category3'));
                })->where('collection', true)->where('coil', false);
            }
        }

        if (is_null(request('category3'))) {
            if (request()->has('category2')) {
                $parts = $parts->whereHas('categories', function ($q) {
                    $q->where('category_id', request('category2'));
                })->where('collection', true)->where('coil', false);
            }
        }

        $parts = $parts->where('collection', true)->where('coil', false)->latest()
            ->paginate(25)->withQueryString();

        return view('collection-parts.index', compact('parts', 'categories', 'setting', 'delete'));
    }

    public function create(Part $parentPart)
    {
        $parts = Part::query();
        $categories = Category::where('parent_id', 0)->get();

        if ($keyword = request('search')) {
            $parts->where('coil', false)
                ->where('name', 'LIKE', "%{$keyword}%");
        }

        if (!is_null(request('category3'))) {
            if (request()->has('category3')) {
                $parts = $parts->whereHas('categories', function ($q) {
                    $q->where('category_id', request('category3'));
                })->where('coil', false);
            }
        }

        if (is_null(request('category3'))) {
            if (request()->has('category2')) {
                $parts = $parts->whereHas('categories', function ($q) {
                    $q->where('category_id', request('category2'));
                })->where('coil', false);
            }
        }

        $parts = $parts->where('coil', false)->latest()->paginate(25)->except($parentPart->id)
            ->except($parentPart->children()->pluck('parent_part_id')->toArray());

        return view('collection-parts.create', compact('parts', 'parentPart', 'categories'));
    }

    public function store(Part $parentPart, Part $childPart)
    {
        $sort = 0;
        if ($parentPart->children->isEmpty()) {
            $sort = 1;
        } else {
            $parentSort = $parentPart->children()->max('sort');
            $sort = $parentSort + 1;
        }

        $parentPart->children()->attach($childPart->id, [
            'sort' => $sort
        ]);

        alert()->success('ثبت موفق', 'افزودن قطعه به مجموعه با موفقیت انجام شد');

        return back();
    }

    public function parts(Part $parentPart)
    {
        $setting = Setting::where('active', '1')->first();

        return view('collection-parts.parts', compact('parentPart', 'setting'));
    }

    public function destroy(Part $parentPart)
    {
        $contractPart = ContractProductAmount::where('part_id', $parentPart->id)->get();
        $productPart = Product::where('part_id', $parentPart->id)->get();
        $amountPart = Amount::where('part_id', $parentPart->id)->get();

        if (!$contractPart->isEmpty() || !$productPart->isEmpty() || !$amountPart->isEmpty()) {
            alert()->error('هشدار حذف', 'این قطعه در قرارداد، پیش فاکتور یا استعلام استفاده شده');
            return back();
        } else {
            $parentPart->children()->detach();
            $parentPart->delete();
        }

        alert()->success('حذف موفق', 'حذف قطعه از مجموعه با موفقیت انجام شد');

        return back();
    }

    public function destroyPart(Part $parentPart, $childId)
    {
        $totalPrice = 0;
        $totalWeight = 0;
        $ids = ['6052', '6053', '6054', '6055', '6057', '6058', '6059', '6060', '6062', '6063', '6064'];

        foreach ($parentPart->children()->orderBy('sort', 'ASC')->get() as $child) {
            if ($child) {
                $totalPrice += $child->price * $child->pivot->value;
                $totalWeight += $child->weight * $child->pivot->value;
            }
        }

        $parentPart->children()->wherePivot('head_part_id', null)->detach($childId);

        $parentPart->price = $totalPrice;
        $parentPart->weight = $totalWeight;
        $parentPart->save();

        alert()->success('حذف موفق', 'حذف قطعه از مجموعه با موفقیت انجام شد');

        return back();
    }

    public function amounts(Part $parentPart)
    {
        $setting = Setting::where('active', '1')->first();

        return view('collection-parts.amounts', compact('parentPart', 'setting'));
    }

    public
    function storeAmounts(Request $request, Part $parentPart)
    {
        $totalPrice = 0;
        $totalWeight = 0;
        $ids = ['6052', '6053', '6054', '6055', '6057', '6058', '6059', '6060', '6062', '6063', '6064'];

        foreach ($parentPart->children()->where('head_part_id', null)->orderBy('sort', 'ASC')->get() as $index => $child) {
            if (!$child->children->isEmpty() && in_array($child->id, $ids)) {
                foreach ($child->children()->wherePivot('head_part_id', $parentPart->id)->orderBy('sort', 'ASC')->get() as $index2 => $ch) {
                    DB::table('part_child')->where('parent_part_id', $ch->id)->where('head_part_id', $parentPart->id)
                        ->where('child_part_id', $child->id)->update([
                            'parent_part_id' => $request->part_ids[$index][$index2],
                            'value' => $request->values[$index][$index2],
                            'sort' => $request->sorts[$index][$index2],
                            'head_part_id' => $parentPart->id,
                        ]);

                    $totalPrice += $ch->price * $request->values[$index][$index2];
                    $totalWeight += $ch->weight * $request->values[$index][$index2];
                }
            } else {
                $child->pivot->update([
                    'parent_part_id' => $request->part_ids[$index],
                    'value' => $request->values[$index],
                    'sort' => $request->sorts[$index],
                ]);

                $totalPrice += $child->price * $request->values[$index];
                $totalWeight += $child->weight * $request->values[$index];
            }
        }

        $parentPart->price = $totalPrice;
        $parentPart->weight = $totalWeight;
        $parentPart->name = $request->name;
        $parentPart->save();

        alert()->success('ثبت موفق', 'ثبت مقادیر با موفقیت انجام شد');

        return back();
    }

    public
    function replicate(Part $parentPart)
    {
        $category = $parentPart->categories()->latest()->first();
        $lastPart = $category->parts()->latest()->first();
        $code = str_pad($lastPart->code + 1, 4, "0", STR_PAD_LEFT);

        $newPart = $parentPart->replicate()->fill([
            'code' => $code,
            'name' => $parentPart->name . " کپی شده ",
            'price' => 0,
            'weight' => 0,
        ]);
        $newPart->save();

        $newPart->categories()->syncWithoutDetaching($parentPart->categories);

        foreach ($parentPart->children()->orderByPivot('sort', 'ASC')->get() as $part) {
            $newPart->children()->attach([
                $part->id => [
                    'value' => $part->pivot->value,
                    'sort' => $part->pivot->sort
                ]
            ]);
        }

        alert()->success('کپی موفق', 'کپی قطعه با موفقیت انجام شد');

        return back();
    }

    public
    function changeParts(Request $request, Part $parentPart)
    {
        $totalPrice = 0;
        $totalWeight = 0;
        $ids = ['6052', '6053', '6054', '6055', '6057', '6058', '6059', '6060', '6062', '6063', '6064'];

        foreach ($parentPart->children()->where('head_part_id', null)->orderBy('sort', 'ASC')->get() as $index => $child) {
            if (!$child->children->isEmpty() && in_array($child->id, $ids)) {
                foreach ($child->children()->wherePivot('head_part_id', $parentPart->id)->orderBy('sort', 'ASC')->get() as $index2 => $ch) {
                    DB::table('part_child')->where('parent_part_id', $ch->id)->where('head_part_id', null)
                        ->where('child_part_id', $child->id)->update([
                            'parent_part_id' => $request->part_ids[$index][$index2],
                            'value' => $request->values[$index][$index2],
                            'sort' => $request->sorts[$index][$index2],
                            'datasheet' => $request->datasheets[$index][$index2],
                            'head_part_id' => $parentPart->id,
                        ]);

                    $totalPrice += $ch->price * $request->values[$index][$index2];
                    $totalWeight += $ch->weight * $request->values[$index][$index2];
                }
            } else {
                DB::table('part_child')->where('parent_part_id', $child->id)->where('head_part_id', null)
                    ->where('child_part_id', $parentPart->id)->update([
                        'parent_part_id' => $request->part_ids[$index],
                        'value' => $request->values[$index],
                        'value2' => $request->units[$index],
                        'sort' => $request->sorts[$index],
                        'datasheet' => $request->datasheets[$index],
                        'head_part_id' => null
                    ]);

                $totalPrice += $child->price * $request->values[$index];
                $totalWeight += $child->weight * $request->values[$index];
            }
        }

        $parentPart->price = $totalPrice;
        $parentPart->weight = $totalWeight;
        $parentPart->save();

        alert()->success('مقادیر', 'مقدار قطعات برای مجموعه با موفقیت ثبت شد');

        return back();
    }

    public
    function print(Part $parentPart)
    {
        return view('collection-parts.print', compact('parentPart'));
    }
}
