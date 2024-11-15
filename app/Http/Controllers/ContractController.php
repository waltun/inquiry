<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\ContractNotification;
use App\Models\ContractProduct;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Special;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
            $contracts->where('name', 'LIKE', "%$keyword%")
                ->orWhere('number', 'LIKE', "%$keyword%")
                ->orWhere('marketer', 'LIKE', "%$keyword%");
        }

        if (request()->has('type') && !is_null(request('type'))) {
            $contracts->where('type', request('type'));
        }

        if (request()->has('user_id') && !is_null(request('user_id'))) {
            $contracts->where('user_id', request('user_id'));
        }

        if (request()->has('customer') && !is_null(request('customer'))) {
            $contracts->where('customer_id', request('customer'));
        }

        if (auth()->user()->role == 'admin') {
            $contracts = $contracts->orderBy('number', 'DESC')->with(['invoices', 'products'])->where('complete', 0)->paginate(20)->withQueryString();
        } else {
            $contracts = $contracts->orderBy('number', 'DESC')->with(['invoices', 'products'])->where('complete', 0)->where('user_id', auth()->user()->id)->paginate(20)->withQueryString();
        }

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

        $contract = auth()->user()->contracts()->create($data);

        $this->createFolders($contract);

        ContractNotification::create([
            'message' => 'یک قرارداد جدید ایجاد شد',
            'current_url' => route('contracts.show', $contract->id),
            'next_url' => route('contracts.invoices.index', $contract->id),
            'next_message' => 'برای انتخاب پیش فاکتور قرارداد به لینک ارجاع شده مراجعه کنید',
            'read_at' => null,
            'done_at' => null,
            'contract_id' => $contract->id,
            'user_id' => auth()->user()->id,
        ]);

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
            $date = $year . '/' . $month . '/' . $day;
        }

        return view('contracts.edit', compact('contract', 'users', 'date'));
    }

    public function update(Request $request, Contract $contract)
    {
        $data = $request->validate([
            'start_contract_date' => 'nullable|string|max:255',
            'user_id' => 'required|integer',
            'old_number' => 'nullable|string|max:255',
            'name' => 'required|string|max:255'
        ]);

        if (!is_null($data['start_contract_date'])) {
            $explodeDate = explode('/', $data['start_contract_date']);
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
        $invoices = Invoice::query();
        $specials = Special::all()->pluck('part_id')->toArray();

        if ($keyword = request('search')) {
            $invoices->whereHas('inquiry', function ($query) use ($keyword) {
                $query->where('name', 'LIKE', "%$keyword%")
                    ->orWhere('marketer', 'LIKE', "%$keyword%")
                    ->orWhere('inquiry_number', 'LIKE', "%$keyword%");
            });
        }

        if (request()->has('user_id') && !is_null(request('user_id'))) {
            $invoices = $invoices->where('user_id', request('user_id'));
        }

        if (auth()->user()->role == 'admin') {
            $invoices = $invoices->latest()->where('complete', true)->paginate(25);
        } else {
            $invoices = $invoices->where('user_id', auth()->user()->id)->where('complete', true)->latest()->paginate(25);
        }

        $customers = Customer::all();
        return view('contracts.products', compact('contract', 'invoices', 'customers', 'specials'));
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
        ]);

        $invoice = Invoice::find($data["invoice_id"]);

        $contract->name = $invoice->inquiry->name;
        $contract->marketer = $invoice->inquiry->marketer;
        $contract->user_id = $invoice->user_id;
        $contract->save();

        foreach ($invoice->products()->where('deleted_at', null)->get() as $product) {
            $price = $product->price / $product->percent;

            $contract->products()->create([
                'quantity' => $product->quantity,
                'price' => $price,
                'model_custom_name' => $product->model_custom_name,
                'tag' => $product->description,
                'type' => $product->type,
                'group_id' => $product->group_id,
                'model_id' => $product->model_id,
                'part_id' => $product->part_id,
                'product_id' => $product->product_id,
                'invoice_id' => $invoice->id,
                'sort' => $product->sort
            ]);
        }

        $invoice->contract_id = $contract->id;
        $invoice->save();

        ContractNotification::create([
            'message' => 'پیش فاکتور برای قرارداد انتخاب شد',
            'current_url' => route('contracts.invoices.index', $contract->id),
            'next_url' => route('contract-files.index', $contract->id),
            'next_message' => 'برای آپلود فایل قرارداد به لینک ارجاع شده مراجعه کنید',
            'read_at' => null,
            'done_at' => null,
            'contract_id' => $contract->id,
            'user_id' => auth()->user()->id,
        ]);

        alert()->success('ثبت موفق', 'پیش فاکتور با موفقیت برای قرارداد ثبت شد');

        return redirect()->route('contracts.products', $contract->id);
    }

    public function deleteAll(Contract $contract)
    {
        $invoices = Invoice::where('contract_id', $contract->id)->get();
        foreach ($invoices as $invoice) {
            $invoice->contract_id = null;
            $invoice->save();
        }

        foreach ($contract->products as $product) {
            if (!$product->spareAmounts->isEmpty()) {
                foreach ($product->spareAmounts as $spareAmount) {
                    $spareAmount->delete();
                }
            }

            if (!$product->amounts->isEmpty()) {
                foreach ($product->amounts as $amount) {
                    $amount->delete();
                }
            }

            $product->delete();
        }

        alert()->success('حذف موفق', 'همه محصولات قرارداد با موفقیت حذف شدند');

        return back();
    }

    public function complete(Contract $contract)
    {
        $contract->complete = 1;
        $contract->save();

        alert()->success('ثبت موفق', 'وضعیت قرارداد با موفقیت به اتمام شده تغییر کرد');

        return back();
    }

    public function changeUser(Request $request, Contract $contract)
    {
        $request->validate([
            'user_id' => 'required|integer',
        ]);

        $contract->user_id = $request->user_id;
        $contract->save();

        alert()->success('ثبت موفق', 'مسئول پرونده با موفقیت تغییر کرد');

        return back();
    }

    public function datasheet(Contract $contract)
    {
        return view('contracts.datasheet', compact('contract'));
    }

    public function getOfficialCode()
    {
        $startOfYear = jdate()->getFirstDayOfYear()->toCarbon();

        $contracts = Contract::select('number')->where('number', '!=', null)->where('type', 'official')->get();

        $year = jdate(now())->getYear();

        $number = 0;
        $explodeNumber = '';
        foreach ($contracts as $contract) {
            $explodeNumber = explode('-', $contract->number);

            if ((int)$explodeNumber[0] == $year) {
                if ((int)$explodeNumber[2] > $number) {
                    $number = (int)$explodeNumber[2];
                }
            }
        }

        if (!$contracts->isEmpty()) {
            if ($year > (int)$explodeNumber[0]) {
                $contractNumber = '1000';
            } else {
                $contractNumber = str_pad($number + 1, 4, "0");
            }
        } else {
            $contractNumber = '1000';
        }

        return $year . '-1-' . $contractNumber;
    }

    public function getOperationalCode()
    {
        $startOfYear = jdate()->getFirstDayOfYear()->toCarbon();

        $contracts = Contract::select('number')->where('number', '!=', null)->where('type', 'operational')->get();

        $year = jdate(now())->getYear();

        $number = 0;
        $explodeNumber = '';
        foreach ($contracts as $contract) {
            $explodeNumber = explode('-', $contract->number);
            if ((int)$explodeNumber[0] == $year) {
                if ((int)$explodeNumber[2] > $number) {
                    $number = (int)$explodeNumber[2];
                }
            }
        }

        if (!$contracts->isEmpty()) {
            if ($year > (int)$explodeNumber[0]) {
                $contractNumber = '1000';
            } else {
                $contractNumber = str_pad($number + 1, 4, "0");
            }
        } else {
            $contractNumber = '1000';
        }
        return $year . '-2-' . $contractNumber;
    }

    /**
     * @param Contract|Model $contract
     * @return void
     */
    public function createFolders(Contract|Model $contract): void
    {
        $year = jdate($contract->created_at)->getYear();

        $firstPath = 'files/contracts/' . $year . '/';
        if (!File::exists('files/contracts/' . $year)) {
            File::makeDirectory($firstPath, 0755, true);
        }

        $secondPath = $firstPath . 'CNT-' . $contract->number . '/';
        if (!File::exists($secondPath)) {
            File::makeDirectory($secondPath, 0755, true);
        }

        $salePath = $secondPath . 'Sales/';
        if (!File::exists($salePath)) {
            File::makeDirectory($salePath, 0755, true);
        }

        $financialLetterPath = $salePath . 'Letters/';
        if (!File::exists($financialLetterPath)) {
            File::makeDirectory($financialLetterPath, 0755, true);
        }

        $financialLetterSendPath = $financialLetterPath . 'Send/';
        if (!File::exists($financialLetterSendPath)) {
            File::makeDirectory($financialLetterSendPath, 0755, true);
        }

        $financialLetterReceivePath = $financialLetterPath . 'Receive/';
        if (!File::exists($financialLetterReceivePath)) {
            File::makeDirectory($financialLetterReceivePath, 0755, true);
        }

        $financialPath = $secondPath . 'Financial/';
        if (!File::exists($financialPath)) {
            File::makeDirectory($financialPath, 0755, true);
        }

        $financialInvoicePath = $financialPath . 'Invoice/';
        if (!File::exists($financialInvoicePath)) {
            File::makeDirectory($financialInvoicePath, 0755, true);
        }

        $financialRecoupmentPath = $financialPath . 'Recoupment/';
        if (!File::exists($financialRecoupmentPath)) {
            File::makeDirectory($financialRecoupmentPath, 0755, true);
        }

        $financialRecoupmentPath = $financialPath . 'Contract(PO)/';
        if (!File::exists($financialRecoupmentPath)) {
            File::makeDirectory($financialRecoupmentPath, 0755, true);
        }

        $factoryPath = $secondPath . 'Factory/';
        if (!File::exists($factoryPath)) {
            File::makeDirectory($factoryPath, 0755, true);
        }

        $factoryTechnicalPath = $factoryPath . 'Technical-Documents/';
        if (!File::exists($factoryTechnicalPath)) {
            File::makeDirectory($factoryTechnicalPath, 0755, true);
        }

        $factoryShippingPath = $factoryPath . 'Shipping-Documents/';
        if (!File::exists($factoryShippingPath)) {
            File::makeDirectory($factoryShippingPath, 0755, true);
        }

        $factoryImagePath = $factoryPath . 'Images/';
        if (!File::exists($factoryImagePath)) {
            File::makeDirectory($factoryImagePath, 0755, true);
        }

        $factoryImagePath = $factoryPath . 'MOM/';
        if (!File::exists($factoryImagePath)) {
            File::makeDirectory($factoryImagePath, 0755, true);
        }
    }
}
