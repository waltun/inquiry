<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contract;
use App\Models\ContractProduct;
use App\Models\Pack;
use App\Models\Part;
use Illuminate\Http\Request;

class PackProductController extends Controller
{
    public function index(Contract $contract, Pack $pack)
    {
        return view('contracts.packings.packs.products.index', compact('contract', 'pack'));
    }

    public function create(Contract $contract, Pack $pack)
    {
        return view('contracts.packings.packs.products.create', compact('contract', 'pack'));
    }

    public function store(Request $request, Contract $contract, Pack $pack)
    {
        $data = $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|numeric'
        ]);

        $product = ContractProduct::find($data['product_id']);

        $quantity = 0;
        foreach ($product->packs as $pack2) {
            $quantity += $pack2->pivot->quantity;
        }

//        if ($data['quantity'] > $product->quantity - $quantity) {
//            alert()->error('خطا', 'تعداد نباید بیشتر از تعداد محصول باشد');
//            return back();
//        }

        $pack->products()->attach($product->id, [
            'quantity' => $data['quantity']
        ]);

        alert()->success('ثبت موفق', 'محصول با موفقیت به پک اضافه شد');

        return back();
    }

    public function destroy(Contract $contract, Pack $pack, ContractProduct $product)
    {
        $pack->products()->detach($product->id);

        alert()->success('حذف موفق', 'محصول با موفقیت از پک حذف شد');

        return back();
    }

    public function addPart(Contract $contract, Pack $pack)
    {
        $parts = Part::query();
        $categories = Category::where('parent_id', 0)->get();

        if ($keyword = request('search')) {
            $parts->where('name', 'LIKE', "%{$keyword}%");
        }

        if (!is_null(request('category3'))) {
            if (request()->has('category3')) {
                $parts = $parts->whereHas('categories', function ($q) {
                    $q->where('category_id', request('category3'));
                });
            }
        }

        if (is_null(request('category3'))) {
            if (request()->has('category2')) {
                $parts = $parts->whereHas('categories', function ($q) {
                    $q->where('category_id', request('category2'));
                });
            }
        }

        $parts = $parts->latest()->paginate(25);

        return view('contracts.packings.packs.products.add-new-product', compact('contract', 'pack', 'parts', 'categories'));
    }

    public function storePart(Request $request, Contract $contract, Pack $pack)
    {
        $request->validate([
            'quantity' => 'required|numeric',
            'part_id' => 'required|integer'
        ]);

        $part = Part::find($request->part_id);

        $product = ContractProduct::create([
            'quantity' => $request->quantity,
            'price' => 0,
            'type' => null,
            'status' => null,
            'sort' => 0,
            'packing' => true,
            'contract_id' => $contract->id,
            'group_id' => 0,
            'model_id' => 0,
            'part_id' => $part->id,
            'product_id' => null,
            'invoice_id' => null
        ]);

        alert()->success('ثبت موفق', 'افزودن قطعه به پکینگ با موفقیت انجام شد');

        return back();
    }
}
