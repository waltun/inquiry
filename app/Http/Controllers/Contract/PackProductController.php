<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\ContractProduct;
use App\Models\Pack;
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

        if ($data['quantity'] > $product->quantity) {
            alert()->error('خطا', 'تعداد نباید بیشتر از تعداد محصول باشد');
            return back();
        }

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
}
