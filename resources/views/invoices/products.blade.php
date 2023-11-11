<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script>
            function deleteProduct(id) {
                if (confirm('محصول از پیش فاکتور حذف شود ؟')) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('invoices.products.destroy') }}',
                        data: {
                            'id': id
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
        <a href="{{ route('invoices.index') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    پیش فاکتور ها
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
                    محصولات پیش فاکتور {{ $invoice->inquiry->name }}
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
                    لیست محصولات و قطعات پیش فاکتور {{ $invoice->inquiry->name }}
                </p>
            </div>
        </div>
        <form action="{{ route('invoices.products.restore',$invoice->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <button class="page-info-btn" onclick="return confirm('محصولات حذف شده بازگردانی شوند ؟')">
                بازگردانی محصولات
            </button>
        </form>
    </div>

    <div class="mt-4">
        <x-errors />
    </div>

    <!-- Content -->
    <div class="mt-4 space-y-4">
        <!-- Product List -->
        @php
            $productTotalPrice = 0;
        @endphp
        @if(!$invoice->products()->where('group_id','!=',0)->where('model_id','!=',0)->where('deleted_at',null)->get()->isEmpty())
            <div class="card">
                <div class="card-header">
                    <p class="card-title text-lg">لیست محصولات</p>
                </div>

                <form method="POST" action="{{ route('invoices.products.store') }}"
                      class="mt-8 overflow-x-auto rounded-lg">
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
                                تگ
                            </th>
                            <th scope="col" class="p-4">
                                تعداد
                            </th>
                            <th scope="col" class="p-4">
                                قیمت نت واحد (تومان)
                            </th>
                            <th scope="col" class="p-4">
                                ضریب
                            </th>
                            <th scope="col" class="p-4">
                                قیمت با ضریب (تومان)
                            </th>
                            <th scope="col" class="p-4">
                                قیمت کل (تومان)
                            </th>
                            <th scope="col" class="p-4 rounded-tl-lg">
                                <span class="sr-only">اقدامات</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invoice->products()->where('group_id','!=',0)->where('model_id','!=',0)->where('deleted_at',null)->get() as $product)
                            @php
                                $modell = \App\Models\Modell::find($product->model_id);

                                $productPercentPrice = 0;
                                if ($product->percent > 0) {
                                    $productTotalPrice += ($product->price * $product->quantity) / $product->percent;
                                    $productPercentPrice = ($product->price * $product->quantity) / $product->percent;
                                } else {
                                    $productTotalPrice += ($product->price * $product->quantity);
                                    $productPercentPrice = ($product->price * $product->quantity);
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
                                    {{ $product->description ?? '-' }}
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    <input type="text" class="input-text w-20 text-center"
                                           value="{{ $product->quantity }}"
                                           name="quantities[]">
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    <input type="text" class="input-text text-center" value="{{ $product->price }}"
                                           name="prices[]">
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    <input type="text" class="input-text w-20 text-center"
                                           value="{{ $product->percent }}"
                                           name="percents[]">
                                    <input type="hidden" name="products[]" value="{{ $product->id }}">
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    @if($product->percent > 0)
                                        {{ number_format($product->price / $product->percent) }}
                                    @else
                                        {{ number_format($product->price) }}
                                    @endif
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    {{ number_format($productPercentPrice) }}
                                </td>
                                <td class="table-tr-td border-t-0 border-r-0">
                                    <div class="flex items-center space-x-2 space-x-reverse">
                                        <div>
                                            <button type="button" class="table-warning-btn"
                                                    onclick="deleteProduct({{ $product->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                                </svg>
                                                حذف
                                            </button>
                                        </div>
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

                    <div class="mt-4">
                        <button type="submit" class="form-submit-btn">
                            ثبت مقادیر
                        </button>
                    </div>
                </form>
            </div>
        @endif

        <!-- Part List -->
        @php
            $types = ['setup','years','control','power_cable','control_cable','pipe','install_setup_price','setup_price','supervision','transport','other','setup_one','install','cable','canal','copper_piping','carbon_piping', 'coil',null];
            $partsTotalPrice = 0;
        @endphp
        @foreach($types as $type)
            @php
                $products = $invoice->products()->where('part_id','!=',0)->where('type',$type)->where('deleted_at',null)->get();
            @endphp
            @if(!$products->isEmpty())
                <form method="POST" action="{{ route('invoices.parts.store') }}" class="card">
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
                            <th class="p-4">واحد</th>
                            <th class="p-4">تعداد</th>
                            <th class="p-4">قیمت نت واحد (تومان)</th>
                            <th class="p-4">ضریب</th>
                            <th class="p-4">قیمت با ضریب (تومان)</th>
                            <th class="p-4">قیمت کل (تومان)</th>
                            <th class="p-4 rounded-tl-lg">
                                <span class="sr-only">اقدامات</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $partTotalPrice = 0;
                        @endphp
                        @foreach($products as $product)
                            @php
                                $part = \App\Models\Part::find($product->part_id);

                                $partPercentPrice = 0;
                                if ($product->percent > 0) {
                                    if ($product->price == 0) {
                                        $partTotalPrice += ($part->price * $product->quantity) / $product->percent;
                                        $partPercentPrice = ($part->price * $product->quantity) / $product->percent;
                                    } else {
                                        $partTotalPrice += ($product->price * $product->quantity) / $product->percent;
                                        $partPercentPrice = ($product->price * $product->quantity) / $product->percent;
                                    }
                                } else {
                                    if ($product->price == 0) {
                                        $partTotalPrice += ($part->price * $product->quantity);
                                        $partPercentPrice = ($part->price * $product->quantity);
                                    } else {
                                        $partTotalPrice += ($product->price * $product->quantity);
                                        $partPercentPrice = ($product->price * $product->quantity);
                                    }
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
                                    <input type="text" class="input-text w-20 text-center"
                                           value="{{ $product->quantity }}"
                                           name="quantities[]">
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    <input type="text" class="input-text text-center" value="{{ $product->price }}"
                                           name="prices[]">
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    <input type="text" class="input-text w-20 text-center"
                                           value="{{ $product->percent }}" name="percents[]">
                                    <input type="hidden" name="parts[]" value="{{ $product->id }}">
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    @if($product->percent > 0)
                                        @if($product->price == 0)
                                            {{ number_format($part->price / $product->percent) }}
                                        @else
                                            {{ number_format($product->price / $product->percent) }}
                                        @endif
                                    @else
                                        @if($product->price == 0)
                                            {{ number_format($part->price) }}
                                        @else
                                            {{ number_format($product->price) }}
                                        @endif
                                    @endif
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    {{ number_format($partPercentPrice) }}
                                </td>
                                <td class="table-tr-td border-t-0 border-r-0">
                                    <div class="flex items-center space-x-2 space-x-reverse">
                                        <div>
                                            <button type="button" class="table-warning-btn"
                                                    onclick="deleteProduct({{ $product->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                                </svg>
                                                حذف
                                            </button>
                                        </div>
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

                    <div class="mt-4">
                        <button type="submit" class="form-submit-btn">
                            ثبت مقادیر
                        </button>
                    </div>
                </form>
            @endif
        @endforeach

        <!-- Total price -->
        <div class="flex justify-end items-center sticky bottom-4 space-x-4 space-x-reverse">
            <p class="table-price-label text-lg">
                قیمت نهایی پیش فاکتور : {{ number_format($productTotalPrice + $partsTotalPrice) }} تومان
            </p>
            <p class="table-weight-label text-lg">
                اختلاف قیمت با نت
                : {{ number_format(($productTotalPrice + $partsTotalPrice) - $invoice->inquiry->price) }} تومان
            </p>
        </div>
    </div>
</x-layout>
