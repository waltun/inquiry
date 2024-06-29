<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use App\Models\User;
use Illuminate\Http\Request;

class InvoiceController extends Controller
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
            $invoices = $invoices->latest()->where('complete', false)->paginate(25);
        } else {
            $invoices = $invoices->where('user_id', auth()->user()->id)->where('complete', false)->latest()->paginate(25);
        }

        return view('invoices.index', compact('invoices'));
    }

    public function products(Invoice $invoice)
    {
        if (!$invoice->complete) {
            return view('invoices.products', compact('invoice'));
        }
        alert()->error('خطا', 'امکان ویرایش در این مرحله وجود ندارد');
        return back();
    }

    public function storeProducts(Request $request)
    {
        $request->validate([
            'quantities.*' => 'required|numeric',
            'quantities' => 'required|array',
            'prices.*' => 'required|numeric',
            'prices' => 'required|array',
            'percents.*' => 'required|numeric|between:0,1',
            'percents' => 'required|array',
            'sorts.*' => 'required|numeric',
            'sorts' => 'required|array',
            'descriptions.*' => 'nullable|string|max:255',
            'descriptions' => 'nullable|array',
        ]);

        foreach ($request->products as $index => $id) {
            $product = InvoiceProduct::find($id);

            $product->quantity = $request->quantities[$index];
            $product->description = $request->descriptions[$index];
            $product->price = $request->prices[$index];
            $product->percent = $request->percents[$index];
            $product->sort = $request->sorts[$index];
            $product->show_price = true;

            $product->save();
        }

        alert()->success('ثبت موفق', 'مقادیر با موفقیت ثبت شدند');

        return back();
    }

    public function storeParts(Request $request)
    {
        $request->validate([
            'quantities.*' => 'required|numeric',
            'quantities' => 'required|array',
            'prices.*' => 'required|numeric',
            'prices' => 'required|array',
            'percents.*' => 'required|numeric',
            'percents' => 'required|array',
            'sorts.*' => 'required|numeric',
            'sorts' => 'required|array',
        ]);

        foreach ($request->parts as $index => $id) {
            $product = InvoiceProduct::find($id);

            $product->quantity = $request->quantities[$index];
            $product->price = $request->prices[$index];
            $product->percent = $request->percents[$index];
            $product->sort = $request->sorts[$index];
            $product->show_price = true;

            $product->save();
        }

        alert()->success('ثبت موفق', 'مقادیر با موفقیت ثبت شدند');

        return back();
    }

    public function destroyProduct(Request $request)
    {
        $product = InvoiceProduct::find($request->id);
        $product->deleted_at = now();
        $product->save();

        alert()->success('حذف موفق', 'محصول با موفقیت حذف شد');
    }

    public function restoreProduct(Invoice $invoice)
    {
        foreach ($invoice->products()->where('deleted_at', '!=', null)->get() as $product) {
            $product->update([
                'deleted_at' => null
            ]);
        }

        alert()->success('بازگردانی موفق', 'محصولات با موفقیت بازگردانی شدند');

        return back();
    }

    public function complete(Invoice $invoice)
    {
        if (!$invoice->products()->where('deleted_at', '=', null)->pluck('percent')->contains(0)) {
            $totalPrice = 0;
            foreach ($invoice->products()->where('deleted_at', null)->get() as $product) {
                if ($product->percent > 0) {
                    $totalPrice += ($product->price * $product->quantity) / $product->percent;
                } else {
                    $totalPrice += ($product->price * $product->quantity);
                }
            }

            $invoice->update([
                'complete' => true,
                'price' => $totalPrice,
                ''
            ]);

            alert()->success('ثبت موفق', 'پیش فاکتور با موفقیت نهایی سازی شد');
            return redirect()->route('invoices.final.index');
        }

        alert()->error('خطا', 'ضریب برای همه محصولات ثبت نشده');
        return back();
    }

    public function destroy(Invoice $invoice)
    {
        $contractInvoice = Contract::where('invoice_id', $invoice->id)->get();

        if (!$contractInvoice->isEmpty()) {
            alert()->error('هشدار حذف', 'این پیش فاکتور در قرارداد ها استفاده شده است');
            return back();
        } else {
            foreach ($invoice->products as $product) {
                $product->delete();
            }

            $invoice->delete();
        }

        alert()->success('حذف موفق', 'پیش فاکتور با موفقیت حذف شد');
        return back();
    }

    public function settings(Invoice $invoice)
    {
        $users = User::where('role', 'client')->get();
        return view('invoices.settings', compact('invoice', 'users'));
    }

    public function storeSettings(Request $request, Invoice $invoice)
    {
        $data = $request->validate([
            'tax' => 'required|in:0,1',
            'description' => 'required',
            'user_ids' => 'required|array',
            'buyer_position' => 'required|string|max:255',
            'buyer_name' => 'required|string|max:255',
        ]);

        $invoice->update([
            'tax' => $request->tax,
            'description' => $request->description,
            'buyer_name' => $request->buyer_name,
            'buyer_position' => $request->buyer_position,
        ]);

        $invoice->users()->sync($data['user_ids']);

        alert()->success('ثبت موفق', 'تنظیمات با موفقیت ثبت شد');

        return redirect()->route('invoices.products', $invoice->id);
    }
}
