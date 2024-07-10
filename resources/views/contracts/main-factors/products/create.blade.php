<x-layout>
    <!-- Breadcrumb -->
    <div class="flex items-center space-x-2 space-x-reverse whitespace-nowrap overflow-x-auto custom_nav pb-2" style="overflow-y: hidden;">
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
                    مدیریت فاکتور های قیمتی قرارداد
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
        <a href="{{ route('contracts.main-factors.products.index', [$contract->id, $main_factor->id]) }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    مدیریت محصولات فاکتور قیمتی {{ $main_factor->number }}
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
                    افزودن محصول به فاکتور قیمتی
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
                    افزودن محصول به فاکتور قیمتی {{ $main_factor->number }}
                </p>
            </div>
        </div>
        <div class="flex items-center space-x-4 space-x-reverse">
            <a href="{{ route('contracts.main-factors.products.index', [$contract->id, $main_factor->id]) }}" class="page-warning-btn">
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
        <!-- Product List -->
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
                                فاکتور ها
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

                                $quantity = 0;
                                foreach ($product->factors as $factor) {
                                    $quantity += $factor->pivot->quantity;
                                }

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
                                    {{ $product->tag ?? '-' }}
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    {{ $product->quantity - $quantity }}
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    <div class="flex items-center justify-center" x-data="{open : false}">
                                        <div class="flex items-center justify-center" x-data="{open:false}">
                                            <button class="table-warning-btn" @click="open = !open" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                                </svg>
                                                مشاهده ({{ count($product->factors) }})
                                            </button>
                                            <div class="relative z-10" x-show="open" x-cloak>
                                                <div class="modal-backdrop"></div>
                                                <div class="fixed z-10 inset-0 overflow-y-auto">
                                                    <div class="modal">
                                                        <div class="modal-body">
                                                            <div class="bg-white dark:bg-slate-800 p-4">
                                                                <div class="mb-4 flex justify-between items-center">
                                                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                                        مشاهده فاکتور های {{ $modell->parent->name }}
                                                                        - {{ $product->model_custom_name ?? $modell->name }}
                                                                    </h3>
                                                                    <button type="button" @click="open = false">
                                                                        <span class="modal-close">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
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
                                                                    @foreach($product->factors as $factor2)
                                                                        <div class="p-2 rounded-md bg-sky-100">
                                                                            <p class="text-sm font-bold">
                                                                                فاکتور : {{ $factor2->number }} | تعداد
                                                                                : {{ $factor2->pivot->quantity }}
                                                                            </p>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="table-tr-td border-t-0 border-r-0">
                                    @if($product->quantity - $quantity)
                                        <div class="flex items-center justify-center" x-data="{open : false}">
                                            <div class="flex items-center justify-center" x-data="{open:false}">
                                                <button class="table-warning-btn" @click="open = !open" type="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M12 4.5v15m7.5-7.5h-15"/>
                                                    </svg>
                                                    افزودن
                                                </button>
                                                <div class="relative z-10" x-show="open" x-cloak>
                                                    <div class="modal-backdrop"></div>
                                                    <div class="fixed z-10 inset-0 overflow-y-auto">
                                                        <div class="modal">
                                                            <div class="modal-body">
                                                                <form class="bg-white dark:bg-slate-800 p-4"
                                                                      action="{{ route('contracts.main-factors.products.store', [$contract->id, $main_factor->id]) }}"
                                                                      method="POST">
                                                                    @csrf

                                                                    <div class="mb-4 flex justify-between items-center">
                                                                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                                            اضافه کردن محصول {{ $modell->parent->name }}
                                                                            - {{ $product->model_custom_name ?? $modell->name }}
                                                                            به فاکتور {{ $main_factor->number }}
                                                                        </h3>
                                                                        <button type="button" @click="open = false">
                                                                        <span class="modal-close">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
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
                                                                        <input type="hidden" name="product_id"
                                                                               value="{{ $product->id }}">
                                                                        <input type="number" class="input-text"
                                                                               name="quantity"
                                                                               value="{{ $product->quantity - $quantity }}"
                                                                               placeholder="تعداد اضافه شدن این محصول">
                                                                        <div class="mt-2">
                                                                        <span class="text-xs text-red-600">
                                                                        * نباید بیشتر از تعداد محصول باشد | حداکثر :     {{ $product->quantity - $quantity }} تا
                                                                        </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mt-4 flex justify-end">
                                                                        <button type="submit" class="form-submit-btn">
                                                                            افزودن
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                                            </svg>
                                            تکمیل شده
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- Part List -->
        @php
            $types = ['setup','years','control','power_cable','control_cable','pipe','install_setup_price','setup_price','supervision','transport','other','setup_one','install','cable','canal','copper_piping','carbon_piping', 'coil',null];
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
                            <th class="p-4">فاکتور ها</th>
                            <th class="p-4 rounded-tl-lg">اقدامات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            @php
                                $part = \App\Models\Part::find($product->part_id);

                                $partQuantity = 0;
                                foreach ($product->factors as $factor3) {
                                    $partQuantity += $factor3->pivot->quantity;
                                }
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
                                    {{ $product->quantity - $partQuantity }}
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    <div class="flex items-center justify-center" x-data="{open : false}">
                                        <div class="flex items-center justify-center" x-data="{open:false}">
                                            <button class="table-warning-btn" @click="open = !open" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                                </svg>
                                                مشاهده ({{ count($product->factors) }})
                                            </button>
                                            <div class="relative z-10" x-show="open" x-cloak>
                                                <div class="modal-backdrop"></div>
                                                <div class="fixed z-10 inset-0 overflow-y-auto">
                                                    <div class="modal">
                                                        <div class="modal-body">
                                                            <div class="bg-white dark:bg-slate-800 p-4">
                                                                <div class="mb-4 flex justify-between items-center">
                                                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                                        مشاهده فاکتور های {{ $part->name }}
                                                                    </h3>
                                                                    <button type="button" @click="open = false">
                                                                        <span class="modal-close">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
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
                                                                    @foreach($product->factors as $factor4)
                                                                        <div class="p-2 rounded-md bg-sky-100">
                                                                            <p class="text-sm font-bold">
                                                                                {{ $factor4->number }} | تعداد
                                                                                : {{ $factor4->pivot->quantity }}
                                                                            </p>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="table-tr-td border-t-0 border-r-0">
                                    @if($product->quantity - $partQuantity)
                                        <div class="flex items-center justify-center" x-data="{open : false}">
                                            <div class="flex items-center justify-center" x-data="{open:false}">
                                                <button class="table-warning-btn" @click="open = !open" type="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M12 4.5v15m7.5-7.5h-15"/>
                                                    </svg>
                                                    افزودن
                                                </button>
                                                <div class="relative z-10" x-show="open" x-cloak>
                                                    <div class="modal-backdrop"></div>
                                                    <div class="fixed z-10 inset-0 overflow-y-auto">
                                                        <div class="modal">
                                                            <div class="modal-body">
                                                                <form class="bg-white dark:bg-slate-800 p-4"
                                                                      action="{{ route('contracts.main-factors.products.store', [$contract->id, $main_factor->id]) }}"
                                                                      method="POST">
                                                                    @csrf

                                                                    <div class="mb-4 flex justify-between items-center">
                                                                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                                            اضافه کردن محصول {{ $part->name }}به فاکتور
                                                                        </h3>
                                                                        <button type="button" @click="open = false">
                                                                        <span class="modal-close">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
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
                                                                        <input type="hidden" name="product_id"
                                                                               value="{{ $product->id }}">
                                                                        <input type="number" class="input-text"
                                                                               name="quantity"
                                                                               value="{{ $product->quantity - $partQuantity }}"
                                                                               placeholder="تعداد اضافه شدن این محصول">
                                                                        <div class="mt-2">
                                                                        <span class="text-xs text-red-600">
                                                                        * نباید بیشتر از تعداد محصول باشد | حداکثر :     {{ $product->quantity - $partQuantity }} تا
                                                                        </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mt-4 flex justify-end">
                                                                        <button type="submit" class="form-submit-btn">
                                                                            افزودن
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                                            </svg>
                                            تکمیل شده
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        @endforeach
    </div>
</x-layout>
