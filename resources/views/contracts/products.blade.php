<x-layout>
    <x-slot name="js">
        <script>
            function searchForm() {
                let form = document.getElementById('search-form');
                form.submit();
            }
        </script>
    </x-slot>

    <!-- Breadcrumb -->
    <div class="flex items-center space-x-2 space-x-reverse">
        <a href="{{ route('dashboard') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0l4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0l-5.571 3-5.571-3"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    داشبورد
                </p>
            </div>
        </a>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                 class="breadcrumb-svg-arrow">
                <path fill-rule="evenodd"
                      d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                      clip-rule="evenodd"/>
            </svg>
        </div>
        <a href="{{ route('contracts.index') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    قرارداد ها
                </p>
            </div>
        </a>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                 class="breadcrumb-svg-arrow">
                <path fill-rule="evenodd"
                      d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                      clip-rule="evenodd"/>
            </svg>
        </div>
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg-active">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 4.5v15m6-15v15m-10.875 0h15.75c.621 0 1.125-.504 1.125-1.125V5.625c0-.621-.504-1.125-1.125-1.125H4.125C3.504 4.5 3 5.004 3 5.625v12.75c0 .621.504 1.125 1.125 1.125z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    محصولات قرارداد {{ $contract->name }} - {{ $contract->customer->name }} -
                    CNT-{{ $contract->number }}
                </p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="md:flex items-center justify-between mt-8 space-y-4 md:space-y-0">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-8 h-8 dark:text-white">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 4.5v15m6-15v15m-10.875 0h15.75c.621 0 1.125-.504 1.125-1.125V5.625c0-.621-.504-1.125-1.125-1.125H4.125C3.504 4.5 3 5.004 3 5.625v12.75c0 .621.504 1.125 1.125 1.125z"/>
            </svg>
            <div class="mr-2">
                <p class="font-bold text-2xl text-black dark:text-white">
                    لیست محصولات و قطعات قرارداد {{ $contract->name }} - {{ $contract->customer->name }} -
                    CNT-{{ $contract->number }}
                </p>
            </div>
        </div>
        <div class="flex items-center space-x-4 space-x-reverse">
            @if(!$contract->products->isEmpty())
                <a href="{{ route('contracts.choose-product', $contract->id) }}" class="page-success-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                         stroke="currentColor" class="w-4 h-4 ml-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6"/>
                    </svg>
                    انتخاب محصول جدید
                </a>
            @endif

            <a href="{{ route('contracts.show', $contract->id) }}" class="page-warning-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-4 h-4 ml-1">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3"></path>
                </svg>
                بازگشت
            </a>
        </div>
    </div>

    <!-- Content -->
    <div class="mt-4 space-y-4">
        @if(!$contract->products->isEmpty())
            @php
                $amountStatus = true;
                foreach ($contract->products as $product) {
                    if (!$product->spareAmounts->isEmpty()) {
                        $amountStatus = false;
                    }
                }
            @endphp

                <!-- Store amounts -->
            @if($amountStatus)
                <form method="POST" action="{{ route('contracts.store-product-amount', $contract->id) }}" class="mt-4">
                    @csrf

                    <button type="submit" class="form-submit-btn" onclick="return confirm('مقادیر صادر شوند ؟')">
                        صدور مقادیر محصولات
                    </button>
                </form>
            @else
                <div class="flex items-center space-x-2 space-x-reverse">
                    <p class="text-sm font-medium text-red-600">
                        مقادیر محصولات صادر شده
                    </p>
                    <span>|</span>
                    <form action="{{ route('contracts.destroy-product-amount', $contract->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs text-red-500 font-medium"
                                onclick="return confirm('مقادیر حذف شود ؟')">
                            حذف
                        </button>
                    </form>
                </div>
            @endif

            <!-- Product List -->
            @php
                $productTotalPrice = 0;
            @endphp
            @if(!$contract->products()->where('group_id','!=',0)->where('model_id','!=',0)->get()->isEmpty())
                <div class="card">
                    <div class="card-header">
                        <p class="card-title text-lg">لیست محصولات</p>
                    </div>

                    <div class="mt-8 overflow-x-auto rounded-lg">
                        <table class="w-full border-collapse">
                            <thead>
                            <tr class="table-th-tr">
                                <th scope="col" class="p-4 rounded-tr-lg">
                                    ردیف
                                </th>
                                <th scope="col" class="p-4">
                                    پیش فاکتور
                                </th>
                                <th scope="col" class="p-4">
                                    دسته محصول
                                </th>
                                <th scope="col" class="p-4">
                                    مدل محصول
                                </th>
                                <th scope="col" class="p-4">
                                    تگ
                                </th>
                                <th scope="col" class="p-4">
                                    تعداد
                                </th>
                                <th scope="col" class="p-4">
                                    قیمت واحد (تومان)
                                </th>
                                <th scope="col" class="p-4">
                                    قیمت کل (تومان)
                                </th>
                                <th scope="col" class="p-4">
                                    اقدامات
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contract->products()->orderBy('sort', 'ASC')->where('group_id','!=',0)->where('model_id','!=',0)->get() as $product)
                                <input type="hidden" name="products[]" value="{{ $product->id }}">
                                @php
                                    $modell = \App\Models\Modell::find($product->model_id);

                                    $productTotalPrice += $product->price * $product->quantity;
                                @endphp
                                <tr class="table-tb-tr group whitespace-normal {{ $loop->even ? 'bg-sky-100' : '' }}">
                                    <td class="table-tr-td border-t-0 border-l-0">
                                        {{ $loop->index + 1 }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        @if($product->invoice_id)
                                            <a href="{{ route('invoices.final.print', $product->invoice->id) }}"
                                               target="_blank" class="text-indigo-500">
                                                INV-{{ $product->invoice->inquiry->inquiry_number }}
                                            </a>
                                        @endif
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        <a href="#product{{ $product->id }}">
                                            {{ $modell->parent->name }}
                                        </a>
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        <a href="#product{{ $product->id }}">
                                            {{ $product->model_custom_name ?? $modell->name }}
                                        </a>
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        {{ $product->tag ?? '-' }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        {{ $product->quantity }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        {{ number_format($product->price) }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        {{ number_format($product->price * $product->quantity) }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-r-0">
                                        <div class="flex justify-center space-x-4 space-x-reverse">
                                            @if(auth()->user()->role == 'admin')
                                                @if(!$product->recipe)
                                                    <div x-data="{open: false}">
                                                        <button type="button" class="table-success-btn"
                                                                @click="open = !open">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                 viewBox="0 0 24 24" stroke-width="1.5"
                                                                 stroke="currentColor" class="w-4 h-4 ml-1">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"></path>
                                                            </svg>
                                                            صدور دستور ساخت
                                                        </button>
                                                        <div class="relative z-10" x-show="open" x-cloak>
                                                            <div class="modal-backdrop"></div>
                                                            <div class="fixed z-10 inset-0 overflow-y-auto">
                                                                <div class="modal">
                                                                    <div class="modal-body">
                                                                        <form method="POST"
                                                                              action="{{ route('contracts.products.recipe', [$contract->id, $product->id]) }}"
                                                                              class="bg-white dark:bg-slate-800 p-4">
                                                                            @csrf
                                                                            <div
                                                                                class="mb-4 flex justify-between items-center">
                                                                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                                                    صدور دستور ساخت محصول
                                                                                </h3>
                                                                                <button type="button"
                                                                                        @click="open = false">
                                                                                <span class="modal-close">
                                                                                    <svg
                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                        fill="none"
                                                                                        viewBox="0 0 24 24"
                                                                                        stroke-width="1.5"
                                                                                        stroke="currentColor"
                                                                                        class="w-5 h-5 dark:text-white">
                                                                                        <path stroke-linecap="round"
                                                                                              stroke-linejoin="round"
                                                                                              d="M6 18L18 6M6 6l12 12"/>
                                                                                    </svg>
                                                                                </span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="mt-6 space-y-2">
                                                                                <div class="mb-4">
                                                                                    <label for="inputPacking"
                                                                                           class="form-label">
                                                                                        انتخاب ریز آنالیز قطعات
                                                                                    </label>
                                                                                    <select name="store_parts"
                                                                                            id="inputPacking"
                                                                                            class="input-text">
                                                                                        <option value="">انتخاب کنید
                                                                                        </option>
                                                                                        <option value="1">اضافه شود
                                                                                        </option>
                                                                                        <option value="0">اضافه نشود
                                                                                        </option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="flex justify-end">
                                                                                    <button type="submit"
                                                                                            class="form-submit-btn">
                                                                                        صدور
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <p type="button" class="table-success-btn"
                                                       @click="open = !open">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                             viewBox="0 0 24 24" stroke-width="1.5"
                                                             stroke="currentColor" class="w-4 h-4 ml-1">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="m4.5 12.75 6 6 9-13.5"/>
                                                        </svg>
                                                        دستور ساخت صادر شده
                                                    </p>
                                                @endif
                                                <form method="POST"
                                                      action="{{ route('contracts.destroy-product', $product->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="table-delete-btn"
                                                            onclick="return confirm('محصول حذف شود ؟')">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                             viewBox="0 0 24 24" stroke-width="1.5"
                                                             stroke="currentColor"
                                                             class="w-4 h-4 ml-1">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                                        </svg>
                                                        حذف
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="table-tb-tr group">
                                <td class="table-tr-td border-t-0" colspan="10">
                                    <div class="flex justify-end items-center">
                                        <p class="table-price-label">
                                            قیمت کل : {{ number_format($productTotalPrice) }} تومان
                                        </p>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <!-- Part List -->
            @php
                $types = ['setup','years','control','power_cable','control_cable','pipe','install_setup_price','setup_price','supervision','transport','other','setup_one','install','cable','canal','copper_piping','carbon_piping', 'coil',null];
                $partsTotalPrice = 0;
            @endphp
            @foreach($types as $type)
                @php
                    $products = $contract->products()->where('part_id','!=',0)->where('type',$type)->get();
                @endphp
                @if(!$products->isEmpty())
                    <div class="card">
                        <div class="card-header">
                            <p class="card-title text-lg">
                                @switch($type)
                                    @case('setup')
                                        قطعات یدکی راه اندازی
                                        @break
                                    @case('years')
                                        قطعات یدکی دوسالانه
                                        @break
                                    @case('control')
                                        قطعات کنترلی
                                        @break
                                    @case('power_cable')
                                        قطعات کابل قدرت
                                        @break
                                    @case('control_cable')
                                        قطعات کابل کنترلی
                                        @break
                                    @case('pipe')
                                        قطعات لوله و اتصالات
                                        @break
                                    @case('install_setup_price')
                                        دستمزد نصب و راه اندازی
                                        @break
                                    @case('setup_price')
                                        دستمزد راه اندازی
                                        @break
                                    @case('supervision')
                                        دستمزد نظارت
                                        @break
                                    @case('transport')
                                        هزینه حمل
                                        @break
                                    @case('other')
                                        سایر تجهیزات
                                        @break
                                    @case('setup_one')
                                        قطعات راه اندازی
                                        @break
                                    @case('install')
                                        قطعات نصب
                                        @break
                                    @case('cable')
                                        اقلام کابل کشی
                                        @break
                                    @case('canal')
                                        اقلام کانال کشی
                                        @break
                                    @case('copper_piping')
                                        دستمزد لوله کشی مسی
                                        @break
                                    @case('carbon_piping')
                                        دستمزد لوله کشی کربن استیل
                                        @break
                                    @case('coil')
                                        انواع کویل
                                        @break
                                    @case('')
                                        سایر تجهیزات (قطعات قبلی)
                                        @break
                                @endswitch
                            </p>
                        </div>
                        <table class="w-full border-collapse">
                            <thead>
                            <tr class="table-th-tr">
                                <th class="p-4 rounded-tr-lg">ردیف</th>
                                <th class="p-4">پیش فاکتور</th>
                                <th class="p-4">نام قطعه</th>
                                <th class="p-4">واحد</th>
                                <th class="p-4">تعداد</th>
                                <th class="p-4">قیمت واحد (تومان)</th>
                                <th class="p-4">قیمت کل (تومان)</th>
                                <th class="p-4">اقدامات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $partTotalPrice = 0;
                            @endphp
                            @foreach($products as $product)
                                @php
                                    $part = \App\Models\Part::find($product->part_id);
                                    $partTotalPrice += $product->price * $product->quantity;

                                @endphp
                                <tr class="table-tb-tr group whitespace-normal {{ $loop->even ? 'bg-sky-100' : '' }}">
                                    <td class="table-tr-td border-t-0 border-l-0">
                                        {{ $loop->index + 1 }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        @if($product->invoice_id)
                                            <a href="{{ route('invoices.final.print', $product->invoice->id) }}"
                                               target="_blank" class="text-indigo-500">
                                                INV-{{ $product->invoice->inquiry->inquiry_number }}
                                            </a>
                                        @endif
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        <div class="flex items-center justify-center">
                                            {{ $part->name }}
                                            @if($part->coil == '1' && !$part->standard && !in_array($part->id,$specials))
                                                <a href="{{ route('collections.amounts',$part->id) }}" target="_blank"
                                                   class="table-info-btn mr-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    </svg>
                                                    جزئیات
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        {{ $part->unit }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        {{ $product->quantity }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        {{ number_format($product->price) }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        {{ number_format($product->price * $product->quantity) }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-r-0">
                                        @if(auth()->user()->role == 'admin')
                                            <div class="flex justify-center space-x-4 space-x-reverse">
                                                @if(!$product->recipe)
                                                    <div x-data="{open: false}">
                                                        <button type="button" class="table-success-btn"
                                                                @click="open = !open">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                 viewBox="0 0 24 24" stroke-width="1.5"
                                                                 stroke="currentColor" class="w-4 h-4 ml-1">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"></path>
                                                            </svg>
                                                            صدور دستور ساخت
                                                        </button>
                                                        <div class="relative z-10" x-show="open" x-cloak>
                                                            <div class="modal-backdrop"></div>
                                                            <div class="fixed z-10 inset-0 overflow-y-auto">
                                                                <div class="modal">
                                                                    <div class="modal-body">
                                                                        <form method="POST"
                                                                              action="{{ route('contracts.products.recipe', [$contract->id, $product->id]) }}"
                                                                              class="bg-white dark:bg-slate-800 p-4">
                                                                            @csrf
                                                                            <div
                                                                                class="mb-4 flex justify-between items-center">
                                                                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                                                    صدور دستور ساخت محصول
                                                                                </h3>
                                                                                <button type="button"
                                                                                        @click="open = false">
                                                                                <span class="modal-close">
                                                                                    <svg
                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                        fill="none"
                                                                                        viewBox="0 0 24 24"
                                                                                        stroke-width="1.5"
                                                                                        stroke="currentColor"
                                                                                        class="w-5 h-5 dark:text-white">
                                                                                        <path stroke-linecap="round"
                                                                                              stroke-linejoin="round"
                                                                                              d="M6 18L18 6M6 6l12 12"/>
                                                                                    </svg>
                                                                                </span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="mt-6 space-y-2">
                                                                                <div class="mb-4">
                                                                                    <label for="inputPacking"
                                                                                           class="form-label">
                                                                                        انتخاب ریز آنالیز قطعات
                                                                                    </label>
                                                                                    <select name="store_parts"
                                                                                            id="inputPacking"
                                                                                            class="input-text">
                                                                                        <option value="">انتخاب کنید
                                                                                        </option>
                                                                                        <option value="1">اضافه شود
                                                                                        </option>
                                                                                        <option value="0">اضافه نشود
                                                                                        </option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="flex justify-end">
                                                                                    <button type="submit"
                                                                                            class="form-submit-btn">
                                                                                        صدور
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <p type="button" class="table-success-btn"
                                                       @click="open = !open">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                             viewBox="0 0 24 24" stroke-width="1.5"
                                                             stroke="currentColor" class="w-4 h-4 ml-1">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="m4.5 12.75 6 6 9-13.5"/>
                                                        </svg>
                                                        دستور ساخت صادر شده
                                                    </p>
                                                @endif
                                                <form
                                                    action="{{ route('contracts.destroy-product', $product->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="table-delete-btn"
                                                            onclick="return confirm('محصول حذف شود ؟')">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                             viewBox="0 0 24 24" stroke-width="1.5"
                                                             stroke="currentColor"
                                                             class="w-4 h-4 ml-1">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                                        </svg>
                                                        حذف
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            @php
                                $partsTotalPrice += $partTotalPrice;
                            @endphp
                            <tr class="table-tb-tr group">
                                <td class="table-tr-td border-t-0" colspan="9">
                                    <div class="flex justify-end">
                                        <p class="table-price-label">
                                            جمع قیمت : {{ number_format($partTotalPrice) }} تومان
                                        </p>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                @endif
            @endforeach

            @foreach($contract->products()->orderBy('sort', 'ASC')->where('group_id','!=',0)->where('model_id','!=',0)->get() as $product)
                @php
                    $modell = \App\Models\Modell::find($product->model_id);
                    $weight = 0;
                @endphp
                @if(!$product->spareAmounts->isEmpty())
                    <div class="card" id="product{{ $product->id }}">
                        <div class="card-header">
                            <p class="card-title text-lg">
                                {{ $loop->index + 1 }} -
                                لیست قطعات
                                <span class="text-red-600">{{ $modell->parent->name }}</span> -
                                <span class="text-red-600">{{ $product->tag }}</span> -
                                <span class="text-red-600">{{ $product->model_custom_name ?? $modell->name }}</span> -
                                <span class="text-red-600">تعداد :  {{ $product->quantity }} دستگاه</span>
                            </p>
                        </div>
                        <table class="w-full border-collapse">
                            <thead>
                            <tr class="table-th-tr whitespace-nowrap">
                                <th class="p-4 rounded-tr-lg">ردیف</th>
                                <th class="p-4">نام قطعه</th>
                                <th class="p-4">واحد</th>
                                <th class="p-4">مقادیر</th>
                                <th class="p-4 rounded-tl-lg">قیمت (تومان)</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($product->spareAmounts()->orderBy('sort', 'ASC')->get() as $amount)
                                @php
                                    $part = \App\Models\Part::find($amount->part_id);
                                    $weight += $amount->weight * $amount->value;

                                    $category = $part->categories[1];
                                    $selectedCategory = $part->categories[2];
                                @endphp
                                <tr class="table-tb-tr group whitespace-nowrap {{ $loop->even ? 'bg-sky-100' : '' }}">
                                    <td class="table-tr-td border-t-0 border-l-0">
                                        {{ $amount->sort }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        {{ $part->name }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        {{ $part->unit }}
                                        @if(!is_null($part->unit2))
                                            / {{ $part->unit2 }}
                                        @endif
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        <div class="flex items-center justify-center">
                                            {{ $amount->value }}
                                            @if(!is_null($part->unit2))
                                                <p class="mr-2">/</p>
                                                {{ $amount->value2 }}
                                            @endif
                                        </div>
                                    </td>
                                    <td class="table-tr-td border-t-0 border-r-0">
                                        {{ $amount->price ? number_format($amount->price) : number_format($part->price) }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            @endforeach

            <div class="flex items-center justify-between">
                <!-- Delete All -->
                <form method="POST" action="{{ route('contracts.products.delete-all', $contract->id) }}"
                      class="mt-4">
                    @csrf
                    @method('DELETE')

                    <button class="form-cancel-btn" type="submit" onclick="return confirm('همه محصولات حذف شود ؟')">
                        حذف همه محصولات
                    </button>
                </form>

                <!-- Total price -->
                <div class="flex justify-end items-center sticky bottom-4 space-x-4 space-x-reverse">
                    <p class="table-price-label text-lg">
                        قیمت نهایی قرارداد : {{ number_format($productTotalPrice + $partsTotalPrice) }} تومان
                    </p>
                </div>
            </div>
        @else
            <div class="mt-8">
                <p class="text-base text-center text-red-600 font-bold">
                    --- منتظر انتخاب پیش فاکتور ---
                </p>
                <div class="flex justify-center mt-4">
                    <a href="{{ route('contracts.invoices.index', $contract->id) }}"
                       class="text-sm font-medium text-indigo-600 underline underline-offset-4">
                        انتخاب پیش فاکتور
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-layout>
