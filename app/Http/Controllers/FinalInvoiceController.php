<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
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

        return view('invoices.final', compact('invoices'));
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

    public function addToContract(Request $request, Invoice $invoice)
    {
        $data = $request->validate([
            'period' => 'required|string|max:255',
            'build_date' => 'nullable|string|max:255',
            'delivery_date' => 'nullable|string|max:255',
            'start_contract_date' => 'nullable|string|max:255',
        ]);

        if (!is_null($data['build_date'])) {
            $explodeBuildDate = explode('-', $data['build_date']);
            $data['build_date'] = (new Jalalian($explodeBuildDate[0], $explodeBuildDate[1], $explodeBuildDate[2]))->toCarbon()->toDateTimeString();
        }

        if (!is_null($data['delivery_date'])) {
            $explodeDeliveryDate = explode('-', $data['delivery_date']);
            $data['delivery_date'] = (new Jalalian($explodeDeliveryDate[0], $explodeDeliveryDate[1], $explodeDeliveryDate[2]))->toCarbon()->toDateTimeString();
        }

        if (!is_null($data['start_contract_date'])) {
            $explodeContractDate = explode('-', $data['start_contract_date']);
            $data['start_contract_date'] = (new Jalalian($explodeContractDate[0], $explodeContractDate[1], $explodeContractDate[2]))->toCarbon()->toDateTimeString();
        }

        $invoice->contracts()->create($data);

        return "success";
    }
}
