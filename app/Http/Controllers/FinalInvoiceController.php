<?php

namespace App\Http\Controllers;

use App\Models\Amount;
use App\Models\Contract;
use App\Models\ContractProductAmount;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use App\Models\Part;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use Melipayamak;

class FinalInvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::query();

        if ($keyword = request('search')) {
            $invoices->whereHas('inquiry', function ($query) use ($keyword) {
                $query->where('name', 'LIKE', "%{$keyword}%")
                    ->orWhere('marketer', 'LIKE', "%{$keyword}%")
                    ->orWhere('inquiry_number', 'LIKE', "%{$keyword}%");
            });
        }

        if (request()->has('user_id') && !is_null(request('user_id'))) {
            $invoices = $invoices->where('user_id', request('user_id'));
        }

        if (auth()->user()->role == 'admin') {
            $invoices = $invoices->latest()->where('complete', true)->paginate(25)->withQueryString();
        } else {
            $invoices = $invoices->where('user_id', auth()->user()->id)->where('complete', true)->latest()->paginate(25)->withQueryString();
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
        $showPriceProduct = $invoice->products()->select('show_price')->where('group_id', '!=', 0)
            ->where('model_id', '!=', 0)->get()->contains('show_price', '==', '0');
        $showPricePart = $invoice->products()->select('show_price')->where('part_id', '!=', 0)
            ->get()->contains('show_price', '==', '0');
        return view('invoices.print-page', compact('invoice', 'showPricePart', 'showPriceProduct'));
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

        foreach ($request->products as $index => $id) {
            $invoiceProduct = InvoiceProduct::find($id);
            $product = Product::find($invoiceProduct->product_id);
            $product->show_datasheet = $request->show_datasheets[$index];
            $invoiceProduct->show_datasheet = $request->show_datasheets[$index];
            $product->save();
            $invoiceProduct->save();
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
                $part = Part::find($amount->part_id);
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

                $contractProduct->spareAmounts()->create([
                    'value' => $amount->value,
                    'value2' => $amount->value2,
                    'part_id' => $amount->part_id,
                    'price' => $amount->price,
                    'sort' => $amount->sort,
                    'weight' => $amount->weight ?? 0
                ]);
            }

            if ($product->part_id != 0) {
                $part = Part::find($product->part_id);
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
                        'value' => $product->quantity,
                        'value2' => $product->quantity2,
                        'part_id' => $product->part_id,
                        'price' => $product->price,
                    ]);
                }
            }
        }

        alert()->success('ثبت موفق', 'پیش فاکتور با موفقیت به قرارداد اضافه شد');

        return redirect()->route('contracts.index');
    }

    public function invoiceSMS(Invoice $invoice, User $user)
    {
        $api = new Melipayamak\MelipayamakApi('9022228553', '@2047507881Pp');
        $smsSoap = $api->sms('soap');
        $to = $user->phone;
        $smsSoap->sendByBaseNumber([$user->name, $invoice->invoice_number, $user->phone], $to, '178529');

        alert()->success('ارسال موفق', 'پیام با موفقیت برای مشتری ارسال شد');

        return back();
    }

    public function referral(Request $request, Invoice $invoice)
    {
        $invoice->update([
            'user_id' => $request['user_id']
        ]);

        alert()->success('ارجاع موفق', 'ارجاع با موفقیت انجام شد و برای کاربر ارسال شد');

        return back();
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
