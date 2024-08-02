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

    public function destroy(Request $request)
    {
        $main_factor = Factor::find($request->factor_id);
        $product = ContractProduct::find($request->product_id);

        $main_factor->contractProducts()->detach($product->id);

        alert()->success('حذف موفق', 'محصول با موفقیت از فاکتور حذف شد');
    }

    public function storePrice(Request $request, Contract $contract, Factor $main_factor)
    {
        $request->validate([
            'products' => 'required|array',
            'prices' => 'required|array',
            'products.*' => 'required|integer',
            'prices.*' => 'required|numeric',
        ]);

        foreach ($request->products as $index => $id) {
            $product = ContractProduct::find($id);
            $product->price = $request->prices[$index];
            $product->save();
        }

        alert()->success('ثبت موفق', 'قیمت ها با موفقیت ثبت شد');

        return back();
    }
}
