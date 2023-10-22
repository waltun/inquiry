<?php

namespace App\Http\Controllers;

use App\Models\Amount;
use App\Models\Contract;
use App\Models\ContractProduct;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Part;
use App\Models\User;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class ContractController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:contracts')->only(['index']);
        $this->middleware('can:contract-products')->only(['products', 'updateProducts']);
        $this->middleware('can:show-contract')->only(['products', 'show']);
    }

    public function index()
    {
        $contracts = Contract::query();

        if ($keyword = request('search')) {
            $contracts->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('number', 'LIKE', "%{$keyword}%")
                ->orWhere('marketer', 'LIKE', "%{$keyword}%");
        }

        if (request()->has('type') && !is_null(request('type'))) {
            $contracts->where('type', request('type'));
        }

        if (request()->has('customer') && !is_null(request('customer'))) {
            $contracts->where('customer_id', request('customer'));
        }

        $contracts = $contracts->latest()->with(['invoice', 'products'])->paginate(20)->withQueryString();

        $customers = Customer::latest()->get();
        return view('contracts.index', compact('contracts', 'customers'));
    }

    public function create()
    {
        $customers = Customer::all();

        return view('contracts.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'required|integer',
            'type' => 'required|string|in:official,operational',
            'old_number' => 'nullable|string|max:255'
        ]);

        $number = '';
        if ($data['type'] == 'official') {
            $number = $this->getOfficialCode();
        }
        if ($data['type'] == 'operational') {
            $number = $this->getOperationalCode();
        }

        $data["number"] = $number;

        auth()->user()->contracts()->create($data);

        alert()->success('ثبت موفق', 'تبدیل پیش فاکتور به قطعه با موفقیت انجام شد');

        return redirect()->route('contracts.index');
    }

    public function edit(Contract $contract)
    {
        $users = User::all();

        $date = '';
        if (!is_null($contract->start_contract_date)) {
            $day = jdate($contract->start_contract_date)->getDay();
            $month = jdate($contract->start_contract_date)->getMonth();
            $year = jdate($contract->start_contract_date)->getYear();
            $date = $year . '-' . $month . '-' . $day;
        }

        return view('contracts.edit', compact('contract', 'users', 'date'));
    }

    public function update(Request $request, Contract $contract)
    {
        $data = $request->validate([
            'start_contract_date' => 'required|string|max:255',
            'user_id' => 'required|integer',
            'old_number' => 'nullable|string|max:255'
        ]);

        if (!is_null($data['start_contract_date'])) {
            $explodeDate = explode('-', $data['start_contract_date']);
            $data['start_contract_date'] = (new Jalalian($explodeDate[0], $explodeDate[1], $explodeDate[2]))->toCarbon()->toDateTimeString();
        }

        $contract->update($data);

        alert()->success('بروزرسانی موفق', 'بروزرسانی قرارداد با موفقیت انجام شد');

        return redirect()->route('contracts.index');
    }

    public function destroy(Contract $contract)
    {
        if (!$contract->products->isEmpty()) {
            foreach ($contract->products as $product) {
                if (!$product->amounts->isEmpty()) {
                    foreach ($product->amounts as $amount) {
                        $amount->delete();
                    }
                }

                if (!$product->spareAmounts->isEmpty()) {
                    foreach ($product->spareAmounts as $spareAmount) {
                        $spareAmount->delete();
                    }
                }

                $product->delete();
            }
        }

        $contract->delete();

        alert()->success('حذف موفق', 'حذف قرارداد با موفقیت انجام شد');

        return back();
    }

    public function products(Contract $contract)
    {
        if (auth()->user()->role == 'admin') {
            $invoices = Invoice::latest()->where('complete', true)->paginate(25);
        } else {
            $invoices = Invoice::where('user_id', auth()->user()->id)->where('complete', true)->latest()->paginate(25);
        }

        return view('contracts.products', compact('contract', 'invoices'));
    }

    public function destroyProduct(ContractProduct $contractProduct)
    {
        if (!$contractProduct->spareAmounts->isEmpty()) {
            foreach ($contractProduct->spareAmounts as $spareAmount) {
                $spareAmount->delete();
            }
        }

        if (!$contractProduct->amounts->isEmpty()) {
            foreach ($contractProduct->amounts as $amount) {
                $amount->delete();
            }
        }

        $contractProduct->delete();

        alert()->success('حذف موفق', 'حذف محصول با موفقیت انجام شد');

        return back();
    }

    public function updateProducts(Request $request)
    {
        $request->validate([
            'quantities.*' => 'required|numeric',
            'quantities' => 'required|array',
            'prices.*' => 'required|numeric',
            'prices' => 'required|array',
        ]);

        foreach ($request->products as $index => $id) {
            $product = ContractProduct::find($id);

            $product->quantity = $request->quantities[$index];
            $product->price = $request->prices[$index];

            $product->save();
        }

        alert()->success('ثبت موفق', 'مقادیر با موفقیت ثبت شدند');

        return back();
    }

    public function show(Contract $contract)
    {
        return view('contracts.show', compact('contract'));
    }

    public function selectInvoice(Request $request, Contract $contract)
    {
        $data = $request->validate([
            'invoice_id' => 'required|integer',
            'amount' => 'required|integer'
        ]);

        $invoice = Invoice::find($data["invoice_id"]);

        $contract->name = $invoice->inquiry->name;
        $contract->marketer = $invoice->inquiry->marketer;
        $contract->user_id = $invoice->user_id;
        $contract->invoice_id = $invoice->id;
        $contract->save();

        foreach ($invoice->products()->where('deleted_at', null)->get() as $product) {
            $amounts = Amount::where('product_id', $product->product_id)->get();

            $price = $product->price / $product->percent;

            $contractProduct = $contract->products()->create([
                'quantity' => $product->quantity,
                'price' => $price,
                'model_custom_name' => $product->model_custom_name,
                'tag' => $product->description,
                'type' => $product->type,
                'group_id' => $product->group_id,
                'model_id' => $product->model_id,
                'part_id' => $product->part_id,
                'product_id' => $product->product_id
            ]);

            foreach ($amounts as $amount) {
                $part = Part::find($amount->part_id);
                if ($data["amount"] == '1') {
                    if ($part->collection && !$part->children->isEmpty()) {
                        foreach ($part->children as $child) {
                            if (!$child->children->isEmpty()) {
                                foreach ($child->children as $ch) {
                                    $contractProduct->amounts()->create([
                                        'value' => $ch->pivot->value,
                                        'value2' => $ch->pivot->value2,
                                        'part_id' => $ch->id,
                                        'price' => $ch->price,
                                        'sort' => $ch->pivot->sort,
                                        'weight' => $ch->weight ?? 0
                                    ]);
                                }
                            } else {
                                $contractProduct->amounts()->create([
                                    'value' => $child->pivot->value,
                                    'value2' => $child->pivot->value2,
                                    'part_id' => $child->id,
                                    'price' => $child->price,
                                    'sort' => $child->pivot->sort,
                                    'weight' => $child->weight ?? 0
                                ]);
                            }
                        }
                    } else {
                        $contractProduct->amounts()->create([
                            'value' => $amount->value,
                            'value2' => $amount->value2,
                            'part_id' => $amount->part_id,
                            'price' => $amount->price,
                            'sort' => $amount->sort,
                            'weight' => $amount->weight ?? 0
                        ]);
                    }
                }

                $contractProduct->spareAmounts()->create([
                    'value' => $amount->value,
                    'value2' => $amount->value2,
                    'part_id' => $amount->part_id,
                    'price' => $amount->price,
                    'sort' => $amount->sort,
                    'weight' => $amount->weight ?? 0
                ]);
            }
        }

        alert()->success('ثبت موفق', 'پیش قلکتور با موفقیت برای قرارداد ثبت شد');

        return back();
    }

    public function getOfficialCode()
    {
        $contracts = Contract::select('number')->where('number', '!=', null)->where('type', 'official')->get();

        $number = 0;
        $explodeNumber = '';
        foreach ($contracts as $contract) {
            $explodeNumber = explode('-', $contract->number);
            if ((int)$explodeNumber[2] > $number) {
                $number = (int)$explodeNumber[2];
            }
        }

        $year = jdate(now())->getYear();

        if (!$contracts->isEmpty()) {
            if ($year > $explodeNumber[0]) {
                $contractNumber = '1000';
            } else {
                $contractNumber = str_pad($number + 1, 4, "0", STR_PAD_RIGHT);
            }
        } else {
            $contractNumber = '1000';
        }
        return $year . '-1-' . $contractNumber;
    }

    public function getOperationalCode()
    {
        $contracts = Contract::select('number')->where('number', '!=', null)->where('type', 'operational')->get();

        $number = 0;
        $explodeNumber = '';
        foreach ($contracts as $contract) {
            $explodeNumber = explode('-', $contract->number);
            if ((int)$explodeNumber[2] > $number) {
                $number = (int)$explodeNumber[2];
            }
        }

        $year = jdate(now())->getYear();

        if (!$contracts->isEmpty()) {
            if ($year > $explodeNumber[0]) {
                $contractNumber = '1000';
            } else {
                $contractNumber = str_pad($number + 1, 4, "0", STR_PAD_RIGHT);
            }
        } else {
            $contractNumber = '1000';
        }
        return $year . '-2-' . $contractNumber;
    }
}
