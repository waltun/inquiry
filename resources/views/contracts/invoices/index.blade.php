<x-layout>
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
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg-active">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 4.5v15m6-15v15m-10.875 0h15.75c.621 0 1.125-.504 1.125-1.125V5.625c0-.621-.504-1.125-1.125-1.125H4.125C3.504 4.5 3 5.004 3 5.625v12.75c0 .621.504 1.125 1.125 1.125z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    مشاهده پیش فاکتور پیوست قرارداد
                </p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="md:flex items-center justify-between mt-8 mb-4 space-y-4 md:space-y-0">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-8 h-8 dark:text-white">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z"></path>
            </svg>
            <div class="mr-2">
                <p class="font-bold text-2xl text-black dark:text-white">
                    پیش فاکتور پیوست قرارداد {{ $contract->name }}
                </p>
            </div>
        </div>

        <a href="{{ route('contracts.show', $contract->id) }}" class="page-warning-btn">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-4 h-4 ml-1">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3"></path>
            </svg>
            بازگشت
        </a>
    </div>

    <!-- Content -->
    @if(!$contract->products->isEmpty())
        @foreach($invoices as $invoice)
            <div class="mb-10 space-y-4 border-2 border-myBlue-100 rounded-md p-4">
                <!-- Info -->
                <div class="mb-4 card bg-myBlue-300 flex items-center justify-between">
                    <div class="flex items-center space-x-4 space-x-reverse justify-center">
                        <p class="bg-white py-2 px-4 rounded-lg text-sm text-black">
                            نام پروژه : {{ $invoice->inquiry->name }}
                        </p>
                        <p class="bg-white py-2 px-4 rounded-lg text-sm text-black">
                            شماره پیش فاکتور :
                            INV-{{ $invoice->invoice_number ? $invoice->invoice_number : $invoice->inquiry->inquiry_number }}
                        </p>
                        <p class="bg-white py-2 px-4 rounded-lg text-sm text-black">
                            تاریخ : {{ jdate($invoice->created_at)->format('%A, %d %B %Y') }}

                        </p>
                        <p class="bg-white py-2 px-4 rounded-lg text-sm text-black">
                            مسئول پروژه : {{ $invoice->user->name }}
                        </p>
                    </div>
                    <!-- Print -->
                    <div class="flex items-center space-x-4 space-x-reverse">
                        <a href="{{ route('invoices.final.printPage',$invoice->id) }}" target="_blank"
                           class="flex items-center text-sm font-bold text-white underline underline-offset-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6 ml-1">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z"/>
                            </svg>
                            برای پرینت پیش فاکتور کلیک کنید
                        </a>
                        <a href="{{ route('invoices.final.printDatasheet',$invoice->id) }}" target="_blank"
                           class="flex items-center text-sm font-bold text-white underline underline-offset-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6 ml-1">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z"/>
                            </svg>
                            برای پرینت دیتاشیت کلیک کنید
                        </a>
                    </div>
                </div>

                <!-- Product List -->
                @php
                    $productTotalPrice = 0;
                @endphp
                @if(!$invoice->products()->where('group_id','!=',0)->where('model_id','!=',0)->where('deleted_at', null)->get()->isEmpty())
                    <div class="card">
                        <div class="card-header">
                            <p class="card-title text-lg">لیست محصولات</p>
                        </div>

                        <div class="mt-8 overflow-x-auto rounded-lg hidden md:block">
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
                                        قیمت با ضریب (تومان)
                                    </th>
                                    <th scope="col" class="p-4">
                                        قیمت کل (تومان)
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($invoice->products()->orderBy('sort', 'ASC')->where('group_id','!=',0)->where('model_id','!=',0)->where('deleted_at',null)->get() as $product)
                                    @php
                                        $modell = \App\Models\Modell::find($product->model_id);

                                        $price = $product->price;
                                        $productPercentPrice = 0;
                                        if ($product->percent > 0) {
                                            $productTotalPrice += $price * $product->quantity / $product->percent;
                                            $productPercentPrice = $price * $product->quantity / $product->percent;
                                        } else {
                                            $productTotalPrice += $price * $product->quantity;
                                            $productPercentPrice = $price * $product->quantity;
                                        }
                                    @endphp
                                    <tr class="table-tb-tr group">
                                        <td class="table-tr-td border-t-0 border-l-0">
                                            {{ $loop->index + 1 }}
                                        </td>
                                        <td class="table-tr-td border-t-0 border-x-0">
                                            <a href="#product{{ $product->id }}">
                                                {{ $modell->parent->name ?? '-' }}
                                            </a>
                                        </td>
                                        <td class="table-tr-td border-t-0 border-x-0">
                                            <a href="#product{{ $product->id }}">
                                                {{ $product->model_custom_name ?? $modell->name }}
                                            </a>
                                        </td>
                                        <td class="table-tr-td border-t-0 border-x-0">
                                            {{ $product->description ?? '-' }}
                                        </td>
                                        <td class="table-tr-td border-t-0 border-x-0">
                                            {{ $product->quantity }}
                                        </td>
                                        <td class="table-tr-td border-t-0 border-x-0">
                                            {{ number_format($price) }}
                                        </td>
                                        @php
                                            $percentPrice = $price / $product->percent;
                                        @endphp
                                        <td class="table-tr-td border-t-0 border-x-0">
                                            {{ number_format($percentPrice) }}
                                        </td>
                                        <td class="table-tr-td border-t-0 border-r-0">
                                            {{ number_format($productPercentPrice) }}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr class="table-tb-tr group">
                                    <td class="table-tr-td border-t-0" colspan="10">
                                        <div class="flex items-center justify-end">
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
                        $products = $invoice->products()->where('part_id','!=',0)->where('type',$type)->where('deleted_at',null)->get();
                    @endphp
                    @if(!$products->isEmpty())
                        <form method="POST" action="{{ route('invoices.final.showPrice') }}" class="card">
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
                                    <th class="p-4">قیمت با ضریب (تومان)</th>
                                    <th class="p-4">قیمت کل (تومان)</th>
                                    <th class="p-4 rounded-tl-lg">نمایش قیمت</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $partTotalPrice = 0;
                                @endphp
                                @foreach($products as $product)
                                    @php
                                        $part = \App\Models\Part::find($product->part_id);

                                        $price = $product->price;
                                        $partPercentPrice = 0;
                                        if ($product->percent > 0) {
                                            $partTotalPrice += $price * $product->quantity / $product->percent;
                                            $partPercentPrice = $price * $product->quantity / $product->percent;
                                        } else {
                                            $partTotalPrice += $price * $product->quantity;
                                            $partPercentPrice = $price * $product->quantity;
                                        }
                                    @endphp
                                    <tr class="table-tb-tr group whitespace-normal">
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
                                            {{ number_format($price) }}
                                        </td>
                                        @php
                                            $percentPrice = $product->price / $product->percent;
                                        @endphp
                                        <td class="table-tr-td border-t-0 border-x-0">
                                            {{ number_format($percentPrice) }}
                                        </td>
                                        <td class="table-tr-td border-t-0 border-x-0">
                                            {{ number_format($partPercentPrice) }}
                                        </td>
                                        <td class="table-tr-td border-t-0 border-r-0">
                                            <select name="show_prices[]" id="inputShowPrice{{ $product->id }}"
                                                    class="input-text">
                                                <option value="1" {{ $product->show_price ? 'selected' : '' }}>
                                                    نمایش قیمت
                                                </option>
                                                <option value="0" {{ !$product->show_price ? 'selected' : '' }}>
                                                    عدم نمایش قیمت
                                                </option>
                                            </select>
                                            <input type="hidden" name="products[]" value="{{ $product->id }}">
                                        </td>
                                    </tr>
                                @endforeach
                                @php
                                    $partsTotalPrice += $partTotalPrice;
                                @endphp
                                <tr class="table-tb-tr group">
                                    <td class="table-tr-td border-t-0" colspan="8">
                                        <div class="flex justify-end">
                                            <p class="table-price-label">
                                                جمع قیمت : {{ number_format($partTotalPrice) }} تومان
                                            </p>

                                            <button class="page-warning-btn mr-4 py-2" type="submit">
                                                ثبت
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </form>
                    @endif
                @endforeach

                <!-- Total price -->
                @php
                    $finalPrice = $productTotalPrice + $partsTotalPrice;
                    $taxPrice = 0;

                    $tax = \App\Models\Tax::where('year', jdate($invoice->created_at)->getYear())->first();

                    if ($invoice->tax) {
                        $taxPrice = $finalPrice * $tax->rate / 100;
                    }
                @endphp
                <div class="grid grid-cols-3 gap-4">
                    <div class="border border-gray-300 p-4 shadow rounded-md bg-white">
                        <p class="font-bold text-center text-red-600">
                            قیمت نهایی پیش فاکتور : {{ number_format($finalPrice) }} تومان
                        </p>
                    </div>
                    @if($invoice->tax)
                        <div class="border border-gray-300 p-4 shadow rounded-md bg-white">
                            <p class="font-bold text-center text-gray-600">
                                {{ $tax->rate }}% مالیات بر ارزش افزوده : {{ number_format($taxPrice) }} تومان
                            </p>
                        </div>
                        <div class="border border-gray-300 p-4 shadow rounded-md bg-white">
                            <p class="font-bold text-center text-green-600">
                                قیمت نهایی با احتساب مالیات : {{ number_format($finalPrice +$taxPrice) }} تومان
                            </p>
                        </div>
                    @endif
                </div>

                @foreach($invoice->products()->orderBy('sort', 'ASC')->where('group_id','!=',0)->where('model_id','!=',0)->where('deleted_at',null)->get() as $invoiceProduct)
                    @php
                        $inquiry = $invoiceProduct->invoice->inquiry;
                        $product = \App\Models\Product::find($invoiceProduct->product_id);
                        $modell = \App\Models\Modell::find($product->model_id);
                        $weight = 0;
                    @endphp
                    @if(!$product->amounts->isEmpty())
                        <div class="card" id="product{{ $invoiceProduct->id }}">
                            <div class="card-header">
                                <p class="card-title text-lg">
                                    {{ $loop->index + 1 }} -
                                    لیست قطعات محصول
                                    <span class="text-red-600">{{ $modell->parent->name ?? '-' }}</span> -
                                    <span class="text-red-600">{{ $product->description }}</span> -
                                    <span class="text-red-600">{{ $product->model_custom_name ?? $modell->name }}</span> -
                                    <span class="text-red-600">تعداد :  {{ number_format($product->quantity) }} دستگاه</span>
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
                                @foreach($product->amounts()->orderBy('sort', 'ASC')->get() as $amount)
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
                                            {{ $amount->price ? number_format($amount->price) : $part->price }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                @endforeach

                <!-- Invoice description -->
                @if(!is_null($invoice->description))
                    <div class="card">
                        <div class="card-header">
                            <p class="card-title text-lg">
                                شرایط پیش فاکتور
                            </p>
                        </div>

                        <div class="decimal-list">
                            {!! $invoice->description !!}
                        </div>
                    </div>
                @endif

            </div>
        @endforeach
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

        <div class="my-4">
            <p class="text-red-500 font-bold">
                * توجه : هیچ پیش فاکتوری برای این قرارداد انتخاب نشده، لطفا برای ادامه از لیست پیش فاکتورها انتخاب
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
                    @php
                        $contractIds = \App\Models\Contract::pluck('invoice_id')->toArray();
                    @endphp
                    @foreach($selectInvoices as $selectInvoice)
                        <tr class="table-tb-tr group {{ $loop->even ? 'bg-sky-100' : '' }}">
                            <td class="table-tr-td border-t-0 border-l-0">
                                INV-{{ $selectInvoice->invoice_number ?: $selectInvoice->inquiry->inquiry_number }}
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                {{ $selectInvoice->inquiry->name }}
                            </td>
                            @php
                                $user = \App\Models\User::find($selectInvoice->user_id);
                            @endphp
                            <td class="table-tr-td border-t-0 border-x-0">
                                {{ $user->name }}
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                {{ $selectInvoice->inquiry->marketer }}
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                {{ jdate($selectInvoice->created_at)->format('%A, %d %B %Y') }}
                            </td>
                            <td class="table-tr-td border-t-0 border-r-0">
                                <div class="flex items-center justify-center space-x-4 space-x-reverse">
                                    <a href="{{ route('invoices.final.print',$selectInvoice->id) }}"
                                       class="table-dropdown-copy text-xs" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/>
                                        </svg>
                                        قیمت
                                    </a>
                                    @if(!in_array($selectInvoice->id, $contractIds))
                                        <form action="{{ route('contracts.select-invoice', $contract->id) }}"
                                              method="POST">
                                            @csrf
                                            <input type="hidden" name="invoice_id" value="{{ $selectInvoice->id }}">
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
                                    @else
                                        اضافه شده
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $selectInvoices->links() }}
            </div>
        </div>
    @endif
</x-layout>

