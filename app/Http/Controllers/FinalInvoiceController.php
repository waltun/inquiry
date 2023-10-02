<?php

namespace App\Http\Controllers;

use App\Models\Amount;
use App\Models\Contract;
use App\Models\ContractProductAmount;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class FinalInvoiceController extends Controller
{
    public function index()
    {
        $searchableFields = [
            'inquiry_number' => 'LIKE',
            'name' => 'LIKE',
            'marketer' => 'LIKE',
            'model_id' => '=',
            'group_id' => '=',
        ];

        $invoices = Invoice::query();

        foreach ($searchableFields as $field => $operator) {
            if (request()->has($field) && request()->get($field) != null) {
                if ($field == 'model_id' || $field == 'group_id') {
                    $invoices = $invoices->whereHas('inquiry', function ($query) use ($field, $operator) {
                        $query->where($field, $operator, request()->get($field));
                    });
                } else {
                    $invoices = $invoices->whereHas('inquiry', function ($query) use ($field, $operator) {
                        $query->where($field, $operator, "%" . request()->get($field) . "%");
                    });
                }
            }
        }

        if (request()->has('user_id') && !is_null(request('user_id'))) {
            $invoices = $invoices->where('user_id', request('user_id'));
        }

        if (auth()->user()->role == 'admin') {
            $invoices = $invoices->latest()->where('complete', true)->paginate(25);
        } else {
            $invoices = $invoices->where('user_id', auth()->user()->id)->where('complete', true)->latest()->paginate(25);
        }

        $customers = Customer::select(['name', 'id'])->get();

        return view('invoices.final', compact('invoices', 'customers'));
    }

    public function print(Invoice $invoice)
    {
        return view('invoices.print', compact('invoice'));
    }

    public function printPage(Invoice $invoice)
    {
        return view('invoices.print-page', compact('invoice'));
    }

    public function restore(Invoice $invoice)
    {
        $invoice->update([
            'complete' => '0'
        ]);

        alert()->success('بازگردانی موفق', 'پیش فاکتور با موفقیت بازگردانی شد');

        return back();
    }

    public function datasheet(Invoice $invoice)
    {
        return view('invoices.datasheet', compact('invoice'));
    }

    public function printDatasheet(Invoice $invoice)
    {
        return view('invoices.print-datasheet', compact('invoice'));
    }

    public function showPrice(Request $request)
    {
        foreach ($request->products as $index => $id) {
            $product = InvoiceProduct::find($id);
            $product->show_price = $request->show_prices[$index];
            $product->save();
        }

        alert()->success('ثبت موفق', 'ثبت نمایش قیمت با موفقیت انجام شد');

        return back();
    }

    public function addToContract(Request $request, Invoice $invoice)
    {
        $data = $request->validate([
            'customer_id' => 'required|integer',
            'type' => 'required|string|in:official,operational',
        ]);

        $number = '';
        if ($data['type'] == 'official') {
            $number = $this->getOfficialCode($data);
        }
        if ($data['type'] == 'operational') {
            $number = $this->getOperationalCode($data);
        }

        $contract = $invoice->contracts()->create($data);
        $contract->name = $invoice->inquiry->name;
        $contract->marketer = $invoice->inquiry->marketer;
        $contract->user_id = $invoice->user_id;
        $contract->number = $number;
        $contract->save();

        foreach ($invoice->products as $product) {
            $amounts = Amount::where('product_id', $product->product_id)->get();

            $contractProduct = $contract->products()->create([
                'quantity' => $product->quantity,
                'price' => $product->price,
                'model_custom_name' => $product->model_custom_name,
                'tag' => $product->description,
                'type' => $product->type,
                'group_id' => $product->group_id,
                'model_id' => $product->model_id,
                'part_id' => $product->part_id,
                'product_id' => $product->product_id
            ]);

            foreach ($amounts as $amount) {
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

        alert()->success('ثبت موفق', 'تبدیل پیش فاکتور به قطعه با موفقیت انجام شد');

        return redirect()->route('contracts.index');
    }

    public function getOfficialCode(array $data)
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

    public function getOperationalCode(array $data)
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
