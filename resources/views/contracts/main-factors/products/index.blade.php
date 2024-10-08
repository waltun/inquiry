<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script>
            function deleteProduct(factor_id, product_id) {
                if (confirm('محصول حذف شود ؟')) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('contracts.main-factors.products.destroy') }}',
                        data: {
                            factor_id: factor_id,
                            product_id: product_id
                        },
                        success: function () {
                            location.reload();
                        }
                    });
                }
            }
        </script>
    </x-slot>

    <!-- Breadcrumb -->
    <div class="flex items-center space-x-2 space-x-reverse whitespace-nowrap overflow-x-auto custom_nav pb-2">
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
                      d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    قراردادها
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
        <a href="{{ route('contracts.show', $contract->id) }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    مشاهده قرارداد {{ $contract->name }}
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
        <a href="{{ route('main-factors.index', $contract->id) }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    مدیریت فاکتور های قیمتی
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
                      d="M5.25 14.25h13.5m-13.5 0a3 3 0 01-3-3m3 3a3 3 0 100 6h13.5a3 3 0 100-6m-16.5-3a3 3 0 013-3h13.5a3 3 0 013 3m-19.5 0a4.5 4.5 0 01.9-2.7L5.737 5.1a3.375 3.375 0 012.7-1.35h7.126c1.062 0 2.062.5 2.7 1.35l2.587 3.45a4.5 4.5 0 01.9 2.7m0 0a3 3 0 01-3 3m0 3h.008v.008h-.008v-.008zm0-6h.008v.008h-.008v-.008zm-3 6h.008v.008h-.008v-.008zm0-6h.008v.008h-.008v-.008z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    مدیریت محصولات فاکتور شماره {{ $main_factor->number }}
                </p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="flex items-center justify-between mt-8">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-8 h-8 dark:text-white">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M5.25 14.25h13.5m-13.5 0a3 3 0 01-3-3m3 3a3 3 0 100 6h13.5a3 3 0 100-6m-16.5-3a3 3 0 013-3h13.5a3 3 0 013 3m-19.5 0a4.5 4.5 0 01.9-2.7L5.737 5.1a3.375 3.375 0 012.7-1.35h7.126c1.062 0 2.062.5 2.7 1.35l2.587 3.45a4.5 4.5 0 01.9 2.7m0 0a3 3 0 01-3 3m0 3h.008v.008h-.008v-.008zm0-6h.008v.008h-.008v-.008zm-3 6h.008v.008h-.008v-.008zm0-6h.008v.008h-.008v-.008z"/>
            </svg>
            <div class="mr-2">
                <p class="font-bold text-2xl text-black dark:text-white">
                    لیست محصولات فاکتور شماره {{ $main_factor->number }}
                </p>
            </div>
        </div>
        <div class="flex items-center space-x-4 space-x-reverse">
            <a href="{{ route('main-factors.index', $contract->id) }}" class="page-warning-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3"/>
                </svg>
                <span class="mr-2">بازگشت</span>
            </a>
        </div>
    </div>

    <!-- Content -->
    <div class="mt-4 space-y-4">
        <div class="p-4 rounded-md border-2 border-indigo-500">
            @if(!$main_factor->contractProducts()->where('group_id','!=',0)->where('model_id','!=',0)->get()->isEmpty())
                <form method="POST" action="{{ route('contracts.main-factors.products.store-price', [$contract->id, $main_factor->id]) }}" class="mt-8 overflow-x-auto rounded-lg">
                    @csrf
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
                                کد اختصاصی
                            </th>
                            <th scope="col" class="p-4">
                                تگ
                            </th>
                            <th scope="col" class="p-4">
                                تعداد
                            </th>
                            <th class="p-4">
                                قیمت (تومان)
                            </th>
                            <th class="p-4">
                                قیمت کل (تومان)
                            </th>
                            <th scope="col" class="p-4">
                        <span class="sr-only">
                            اقدامات
                        </span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $totalPrice = 0;
                            $totalTaxPrice = 0;
                        @endphp
                        @foreach($main_factor->contractProducts()->where('group_id','!=',0)->where('model_id','!=',0)->where('packing', false)->get() as $product)
                            <input type="hidden" value="{{ $product->id }}" name="products[]">
                            @php
                                $modell = \App\Models\Modell::find($product->model_id);

                                $price = 0;
                                $taxItem = \App\Models\Tax::where('year', jdate($main_factor->date)->getYear())->first();
                                $price += $product->price * $product->pivot->quantity;

                                $tax = $price * $taxItem->rate / 100.0;
                                $totalTaxPrice += $tax;

                                $totalPrice += $price + $tax;
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
                                    {{ $product->code }}
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    {{ $product->description ?? '-' }}
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    {{ $product->pivot->quantity }}
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    <input type="text" value="{{ $product->price }}" name="prices[]" class="input-text text-center w-36">
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    {{ number_format($product->price * $product->quantity) }}
                                </td>
                                <td class="table-tr-td border-t-0 border-r-0">
                                    <div class="flex items-center justify-center">
                                        <button class="table-delete-btn" type="button" onclick="deleteProduct({{ $main_factor->id }}, {{ $product->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                            </svg>
                                            حذف
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="flex justify-end mt-4">
                        <button type="submit" class="form-submit-btn">
                            ثبت قیمت ها
                        </button>
                    </div>
                </form>

                <div class="mt-4 grid grid-cols-3 gap-4 mb-6">
                    <div>
                        <div class="bg-green-500 p-4 rounded-t-lg">
                            <p class="text-sm font-bold text-white text-center">
                                جمع مبلغ (با ارزش افزوده)
                            </p>
                        </div>
                        <div class="bg-white p-4 rounded-b-lg shadow">
                            <p class="font-bold text-black text-center">
                                {{ number_format($totalPrice) }} تومان
                            </p>
                        </div>
                    </div>

                    <div>
                        <div class="bg-gray-500 p-4 rounded-t-lg">
                            <p class="text-sm font-bold text-white text-center">
                                مبلغ ارزش افزوده ({{ $taxItem->rate ?? '-' }}%)
                            </p>
                        </div>
                        <div class="bg-white p-4 rounded-b-lg shadow">
                            <p class="font-bold text-black text-center">
                                {{ number_format($totalTaxPrice) }} تومان
                            </p>
                        </div>
                    </div>

                    <div>
                        <div class="bg-indigo-500 p-4 rounded-t-lg">
                            <p class="text-sm font-bold text-white text-center">
                                جمع مبلغ (بدون ارزش افزوده)
                            </p>
                        </div>
                        <div class="bg-white p-4 rounded-b-lg shadow">
                            <p class="font-bold text-black text-center">
                                {{ number_format($totalPrice - $totalTaxPrice) }} تومان
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Part List -->
            @php
                $types = ['setup','years','control','power_cable','control_cable','pipe','install_setup_price','setup_price','supervision','transport','other','setup_one','install','cable','canal','copper_piping','carbon_piping', 'coil',null];
            @endphp
            @foreach($types as $type)
                @php
                    $products = $main_factor->contractProducts()->where('part_id','!=',0)->where('packing', false)->where('type',$type)->get();
                @endphp
                @if(!$products->isEmpty())
                    <form method="POST" action="{{ route('contracts.main-factors.products.store-price', [$contract->id, $main_factor->id]) }}" class="card">
                        @csrf
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
                                <th class="p-4">کد اختصاصی</th>
                                <th class="p-4">واحد</th>
                                <th class="p-4">تعداد</th>
                                <th class="p-4">قیمت (تومان)</th>
                                <th class="p-4">قیمت کل (تومان)</th>
                                <th class="p-4 rounded-tl-lg">
                                    <span class="sr-only">اقدامات</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $totalPartPrice = 0;
                                $totalPartTaxPrice = 0;
                            @endphp
                            @foreach($products as $product)
                                <input type="hidden" value="{{ $product->id }}" name="products[]">
                                @php
                                    $part = \App\Models\Part::find($product->part_id);
                                    $price = 0;
                                    $taxItem = \App\Models\Tax::where('year', jdate($main_factor->date)->getYear())->first();
                                    $price += $product->price * $product->pivot->quantity;

                                    $tax = $price * $taxItem->rate / 100.0;
                                    $totalPartTaxPrice += $tax;

                                    $totalPartPrice += $price + $tax;
                                @endphp
                                <tr class="table-tb-tr group whitespace-normal {{ $loop->even ? 'bg-sky-100' : '' }}">
                                    <td class="table-tr-td border-t-0 border-l-0">
                                        {{ $loop->index + 1 }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        {{ $part->name }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        {{ $product->code }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        {{ $part->unit }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        {{ $product->pivot->quantity }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        <input type="text" value="{{ $product->price }}" name="prices[]" class="input-text text-center w-36">
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        {{ number_format($product->price * $product->pivot->quantity) }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-r-0">
                                        <div class="flex items-center justify-center">
                                            <button class="table-delete-btn" type="button" onclick="deleteProduct({{ $main_factor->id }}, {{ $product->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                                </svg>
                                                حذف
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="flex justify-end mt-4 mb-4">
                            <button type="submit" class="form-submit-btn">
                                ثبت قیمت ها
                            </button>
                        </div>
                    </form>

                    <div class="grid grid-cols-3 gap-4 mb-6">
                        <div>
                            <div class="bg-green-500 p-4 rounded-t-lg">
                                <p class="text-sm font-bold text-white text-center">
                                    جمع مبلغ (با ارزش افزوده)
                                </p>
                            </div>
                            <div class="bg-white p-4 rounded-b-lg shadow">
                                <p class="font-bold text-black text-center">
                                    {{ number_format($totalPartPrice) }} تومان
                                </p>
                            </div>
                        </div>

                        <div>
                            <div class="bg-gray-500 p-4 rounded-t-lg">
                                <p class="text-sm font-bold text-white text-center">
                                    مبلغ ارزش افزوده ({{ $taxItem->rate ?? '-' }}%)
                                </p>
                            </div>
                            <div class="bg-white p-4 rounded-b-lg shadow">
                                <p class="font-bold text-black text-center">
                                    {{ number_format($totalPartTaxPrice) }} تومان
                                </p>
                            </div>
                        </div>

                        <div>
                            <div class="bg-indigo-500 p-4 rounded-t-lg">
                                <p class="text-sm font-bold text-white text-center">
                                    جمع مبلغ (بدون ارزش افزوده)
                                </p>
                            </div>
                            <div class="bg-white p-4 rounded-b-lg shadow">
                                <p class="font-bold text-black text-center">
                                    {{ number_format($totalPartPrice - $totalPartTaxPrice) }} تومان
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        @php
            $price2 = 0;
            $tax2 = 0;
            $taxItem2 = 0;
            $totalTaxPrice2 = 0;
            $totalPrice2 = 0;
            if (!$main_factor->contractProducts->isEmpty()) {
                foreach ($main_factor->contractProducts as $product) {
                    $taxItem2 = \App\Models\Tax::where('year', jdate($main_factor->date)->getYear())->first();
                    $price2 += $product->price * $product->pivot->quantity;
                }

                $tax2 = $price2 * $taxItem2->rate / 100.0;
                $totalTaxPrice2 += $tax2;

                $totalPrice2 += $price2 + $tax2;
            }
        @endphp

        <div class="border-2 border-indigo-500 p-4 rounded-md mt-8 shadow-lg bg-sky-100">
            <div class="mb-4">
                <p class="text-xl font-bold text-black">
                    قیمت کل نهایی
                </p>
            </div>
            <div class="grid grid-cols-3 gap-4 mb-6">
                <div>
                    <div class="bg-green-500 p-4 rounded-t-lg">
                        <p class="text-sm font-bold text-white text-center">
                            قیمت کل (با ارزش افزوده)
                        </p>
                    </div>
                    <div class="bg-white p-4 rounded-b-lg shadow">
                        <p class="font-bold text-black text-center">
                            {{ number_format($totalPrice2) }} تومان
                        </p>
                    </div>
                </div>

                <div>
                    <div class="bg-gray-500 p-4 rounded-t-lg">
                        <p class="text-sm font-bold text-white text-center">
                            مبلغ کل ارزش افزوده ({{ $taxItem2->rate ?? '-' }}%)
                        </p>
                    </div>
                    <div class="bg-white p-4 rounded-b-lg shadow">
                        <p class="font-bold text-black text-center">
                            {{ number_format($totalTaxPrice2) }} تومان
                        </p>
                    </div>
                </div>

                <div>
                    <div class="bg-indigo-500 p-4 rounded-t-lg">
                        <p class="text-sm font-bold text-white text-center">
                            مبلغ کل (بدون ارزش افزوده)
                        </p>
                    </div>
                    <div class="bg-white p-4 rounded-b-lg shadow">
                        <p class="font-bold text-black text-center">
                            {{ number_format($totalPrice2 - $totalTaxPrice2) }} تومان
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <a href="{{ route('contracts.main-factors.products.create', [$contract->id, $main_factor->id]) }}"
               class="page-success-btn inline-flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-5 h-5 ml-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                انتخاب محصول
            </a>
        </div>
    </div>
</x-layout>
