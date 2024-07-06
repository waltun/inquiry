<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\ContractProduct;
use App\Models\Factor;
use Illuminate\Http\Request;

class MainFactorProductController extends Controller
{
    public function index(Contract $contract, Factor $main_factor)
    {
        return view('contracts.main-factors.products.index', compact('contract', 'main_factor'));
    }

    public function create(Contract $contract, Factor $main_factor)
    {
        return view('contracts.main-factors.products.create', compact('contract', 'main_factor'));
    }

    public function store(Request $request, Contract $contract, Factor $main_factor)
    {
        $data = $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|numeric'
        ]);

        $product = ContractProduct::find($data['product_id']);

        $quantity = 0;
        foreach ($product->factors as $factor) {
            $quantity += $factor->pivot->quantity;
        }

        if ($data['quantity'] > $product->quantity - $quantity) {
            alert()->error('خطا', 'تعداد نباید بیشتر از تعداد محصول باشد');
            return back();
        }

        $main_factor->contractProducts()->attach($product->id, [
            'quantity' => $data['quantity']
        ]);

        alert()->success('ثبت موفق', 'محصول با موفقیت به فاکتور اضافه شد');

        return back();
    }

    public function destroy(Contract $contract, Factor $main_factor, ContractProduct $product)
    {
        $main_factor->contractProducts()->detach($product->id);

        alert()->success('حذف موفق', 'محصول با موفقیت از فاکتور حذف شد');

        return back();
    }
}
