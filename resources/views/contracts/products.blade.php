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
            <a href="{{ route('contracts.choose-product', $contract->id) }}" class="page-success-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                     stroke="currentColor" class="w-4 h-4 ml-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6"/>
                </svg>
                انتخاب محصول جدید
            </a>

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
                            @foreach($contract->products()->where('group_id','!=',0)->where('model_id','!=',0)->get() as $product)
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
                                        {{ $modell->parent->name }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        {{ $product->model_custom_name ?? $modell->name }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        {{ $product->description ?? '-' }}
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
                                        <div class="flex justify-center">
                                            @if(auth()->user()->role == 'admin')
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
                                        {{ $part->name }}
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
                                        <div class="flex justify-center">
                                            <form
                                                action="{{ route('contracts.destroy-product', $product->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="table-delete-btn"
                                                        onclick="return confirm('محصول حذف شود ؟')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                         class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                                    </svg>
                                                    حذف
                                                </button>
                                            </form>
                                        </div>
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
            <!-- Search -->
            <div class="bg-white p-4 rounded-lg shadow border border-gray-200 mt-6">
                <form method="GET" action="" class="grid grid-cols-4 gap-4" id="search-form">
                    <input type="text" id="inputSearch" class="input-text" name="search"
                           placeholder="جستجو نام و شماره و بازاریاب و... + اینتر" value="{{ request('search') }}">
                    <select name="user_id" id="inputManager" class="input-text" onchange="searchForm()">
                        <option value="">انتخاب مسئول پروژه</option>
                        @foreach(\App\Models\User::all() as $user)
                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    @if(request()->has('search') || request()->has('type'))
                        <div>
                            <a href="{{ route('contracts.products', $contract->id) }}"
                               class="text-sm font-medium text-indigo-500 underline underline-offset-4">
                                پاکسازی جستجو
                            </a>
                        </div>
                    @endif
                </form>
            </div>

            <div class="mb-4">
                <p class="text-red-500 font-bold">
                    * توجه : هیچ پیش فاکتوری برای این قرارداد انتخاب نشده، لطفا برای ادامه از لیست پیش فاکتور ها انتخاب
                    کنید.
                </p>
            </div>

            <div class="mt-4 space-y-4">
                <div class="mt-8 overflow-x-auto rounded-lg hidden md:block">
                    <table class="w-full border-collapse">
                        <thead>
                        <tr class="table-th-tr">
                            <th scope="col" class="p-4 rounded-tr-lg">
                                شماره پیش فاکتور
                            </th>
                            <th scope="col" class="p-4">
                                نام پروژه
                            </th>
                            <th scope="col" class="p-4">
                                مسئول پروژه
                            </th>
                            <th scope="col" class="p-4">
                                بازاریاب
                            </th>
                            <th scope="col" class="p-4">
                                تاریخ
                            </th>
                            <th scope="col" class="p-4 rounded-tl-lg">
                                <span class="sr-only">اقدامات</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invoices as $invoice)
                            <tr class="table-tb-tr group {{ $loop->even ? 'bg-sky-100' : '' }}">
                                <td class="table-tr-td border-t-0 border-l-0">
                                    INV-{{ $invoice->invoice_number ? $invoice->invoice_number : $invoice->inquiry->inquiry_number }}
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    {{ $invoice->inquiry->name }}
                                </td>
                                @php
                                    $user = \App\Models\User::find($invoice->user_id);
                                @endphp
                                <td class="table-tr-td border-t-0 border-x-0">
                                    {{ $user->name }}
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    {{ $invoice->inquiry->marketer }}
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    {{ jdate($invoice->created_at)->format('%A, %d %B %Y') }}
                                </td>
                                <td class="table-tr-td border-t-0 border-r-0">
                                    <div class="flex items-center space-x-4 space-x-reverse">
                                        <a href="{{ route('invoices.final.print',$invoice->id) }}"
                                           class="table-dropdown-copy text-xs" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/>
                                            </svg>
                                            قیمت
                                        </a>
                                        <form action="{{ route('contracts.select-invoice', $contract->id) }}"
                                              method="POST">
                                            @csrf
                                            <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                                            <button class="table-success-btn" type="submit"
                                                    onclick="return confirm('پیش فاکتور به قرارداد اضافه شود ؟')">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/>
                                                </svg>
                                                افزودن به قرارداد
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $invoices->links() }}
                </div>
            </div>
        @endif
    </div>
</x-layout>
