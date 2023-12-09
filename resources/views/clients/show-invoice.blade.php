<x-clients.layout>
    <div>
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="md:w-8 md:h-8 w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                </svg>
                <div class="mr-2">
                    <p class="font-bold md:text-2xl text-sm text-black dark:text-white">
                        مشاهده قیمت پیش فاکتور {{ $invoice->inquiry->name }} | {{ $user->name }}
                    </p>
                </div>
            </div>
            <a href="{{ route('clients.invoices', $user->id) }}" class="page-warning-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-4 h-4 ml-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3"/>
                </svg>
                بازگشت
            </a>
        </div>

        <div class="mb-4 flex">
            <a href="{{ route('clients.invoices.print', [$user->id, $invoice->id]) }}" class="page-info-btn" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-4 h-4 ml-1">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z"/>
                </svg>
                پرینت پیش فاکتور
            </a>
        </div>

        <div class="mb-4">
            <p class="text-xs font-bold text-black font-Titr">
                {{ $invoice->buyer_position }}
            </p>
            <p class="text-xs font-bold text-black font-Titr">
                {{ $invoice->buyer_name }}
            </p>
        </div>

        <!-- Product List -->
        @php
            $productTotalPrice = 0;
        @endphp
        @if(!$invoice->products()->where('group_id','!=',0)->where('model_id','!=',0)->where('deleted_at',null)->get()->isEmpty())
            <div class="mb-4">
                <div>
                    <p class="text-sm font-bold font-Titr">لیست محصولات</p>
                </div>

                <div class="mt-2 md:block hidden">
                    <table class="w-full border-collapse">
                        <thead>
                        <tr class="bg-sky-100 text-black border border-black text-xs">
                            <th scope="col" class="p-1 rounded-tr-lg" style="border-left: 1px solid black">
                                ردیف
                            </th>
                            <th scope="col" class="p-1" style="border-left: 1px solid black">
                                دسته محصول
                            </th>
                            <th scope="col" class="p-1" style="border-left: 1px solid black">
                                مدل محصول
                            </th>
                            <th scope="col" class="p-1" style="border-left: 1px solid black">
                                تگ
                            </th>
                            <th scope="col" class="p-1" style="border-left: 1px solid black">
                                واحد
                            </th>
                            <th scope="col" class="p-1" style="border-left: 1px solid black">
                                تعداد
                            </th>
                            <th scope="col" class="p-1" style="border-left: 1px solid black">
                                قیمت واحد (تومان)
                            </th>
                            <th scope="col" class="p-1">
                                قیمت کل (تومان)
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invoice->products()->where('group_id','!=',0)->where('model_id','!=',0)->where('deleted_at',null)->get() as $product)
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
                            <tr class="text-black text-xs text-center">
                                <td class="border border-black border-t-0 border-l p-1">
                                    {{ $loop->index + 1 }}
                                </td>
                                <td class="border border-black border-t-0 border-l p-1">
                                    {{ $modell->parent->name }}
                                </td>
                                <td class="border border-black border-t-0 border-l p-1">
                                    {{ $product->model_custom_name ?? $modell->name }}
                                </td>
                                <td class="border border-black border-t-0 border-l p-1">
                                    {{ $product->description ?? '-' }}
                                </td>
                                <td class="border border-black border-t-0 border-l p-1">
                                    دستگاه
                                </td>
                                <td class="border border-black border-t-0 border-l p-1">
                                    {{ $product->quantity }}
                                </td>
                                @php
                                    $percentPrice = $price / $product->percent;
                                @endphp
                                <td class="border border-black border-t-0 border-l p-1">
                                    {{ number_format($percentPrice) }}
                                </td>
                                <td class="border border-black border-t-0 border-r-0 p-1">
                                    {{ number_format($productPercentPrice) }}
                                </td>
                            </tr>
                        @endforeach
                        <tr class="text-black text-sm text-center font-medium">
                            <td class="border border-black border-t-0 p-1" colspan="6">
                                جمع قیمت (تومان)
                            </td>
                            <td class="border border-black border-t-0 p-1" colspan="3">
                                {{ number_format($productTotalPrice) }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Mobile -->
                <div class="block md:hidden mt-2">
                    @foreach($invoice->products()->where('group_id','!=',0)->where('model_id','!=',0)->where('deleted_at',null)->get() as $product)
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
                        <div class="p-4 rounded-lg shadow bg-white mb-4">
                            <div class="mb-3">
                                <p class="text-xs text-black text-center font-medium">
                                    دسته :
                                    {{ $modell->parent->name }}
                                </p>
                            </div>
                            <div class="mb-3">
                                <p class="text-xs text-black text-center font-medium">
                                    مدل :
                                    {{ $product->model_custom_name ?? $modell->name }}
                                </p>
                            </div>
                            <div class="mb-3">
                                <p class="text-xs text-black text-center font-medium">
                                    تگ :
                                    {{ $product->description ?? '-' }}
                                </p>
                            </div>
                            <div class="mb-3">
                                <p class="text-xs text-black text-center font-medium">
                                    واحد :
                                    دستگاه
                                </p>
                            </div>
                            <div class="mb-3">
                                <p class="text-xs text-black text-center font-medium">
                                    تعداد :
                                    {{ $product->quantity }}
                                </p>
                            </div>
                            @php
                                $percentPrice = $price / $product->percent;
                            @endphp
                            <div class="mb-3">
                                <p class="text-xs text-black text-center font-bold">
                                    قیمت واحد :
                                    {{ number_format($percentPrice) }} تومان
                                </p>
                            </div>
                            <div class="mb-3">
                                <p class="text-xs text-black text-center font-bold">
                                    قیمت کل :
                                    {{ number_format($productPercentPrice) }} تومان
                                </p>
                            </div>
                            <div class="mb-3">
                                <p class="text-xs text-black text-center font-bold">
                                    جمع قیمت کل :
                                    {{ number_format($productTotalPrice) }} تومان
                                </p>
                            </div>
                        </div>
                    @endforeach
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
                <div class="card border-0 mb-0">
                    <div class="mb-2">
                        <p class="text-sm font-bold font-Titr">
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
                        <tr class="border bg-sky-100 text-black border-black text-xs text-center">
                            <th class="p-1" style="border-left: 1px solid black">ردیف</th>
                            <th class="p-1" style="border-left: 1px solid black">نام قطعه</th>
                            <th class="p-1" style="border-left: 1px solid black">واحد</th>
                            <th class="p-1" style="border-left: 1px solid black">تعداد</th>
                            @if(!$showPricePart)
                                <th class="p-1" style="border-left: 1px solid black">قیمت واحد (تومان)</th>
                                <th class="p-1">قیمت کل (تومان)</th>
                            @else
                                <th class="p-1">قیمت کل (تومان)</th>
                            @endif

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
                            <tr class="border bg-white text-black border-black text-xs text-center">
                                <td class="p-1 border-black border-t-0 border-l">
                                    {{ $loop->index + 1 }}
                                </td>
                                <td class="p-1 border-black border-t-0 border-l">
                                    {{ $part->name }}
                                </td>
                                <td class="p-1 border-black border-t-0 border-l">
                                    {{ $part->unit }}
                                </td>
                                <td class="p-1 border-black border-t-0 border-l">
                                    {{ $product->quantity }}
                                </td>
                                @php
                                    $percentPrice = $price / $product->percent;
                                @endphp
                                @if($product->show_price)
                                    <td class="p-1 border-black border-t-0 border-l">
                                        {{ number_format($percentPrice) }}
                                    </td>
                                    <td class="p-1 border-black border-t-0 border-r-0">
                                        {{ number_format($partPercentPrice) }}
                                    </td>
                                @else
                                    <td class="border-black border-l">

                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        @php
                            $partsTotalPrice += $partTotalPrice;
                        @endphp
                        <tr class="text-black text-sm text-center font-medium">
                            <td class="border border-black border-t-0 p-1" colspan="4">
                                جمع قیمت (تومان)
                            </td>
                            <td class="border border-black border-t-0 p-1" colspan="3">
                                {{ number_format($partTotalPrice) }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            @endif
        @endforeach

        <!-- Total price -->
        @php
            $finalPrice = $productTotalPrice + $partsTotalPrice;
            $taxPrice = 0;

            if ($invoice->tax) {
                $taxPrice = $finalPrice * 9 / 100;
            }
        @endphp
        <div class="md:grid grid-cols-3 gap-4 mb-4 space-y-4 md:space-y-0">
            <div class="border border-black pb-2">
                <div class="border-b border-black py-2 bg-gray-100">
                    <p class="text-sm font-medium text-center">
                        جمع قیمت پیش فاکتور (تومان)
                    </p>
                </div>
                <div class="mt-2">
                    <p class="text-sm font-medium text-center">
                        {{ number_format($finalPrice) }}
                    </p>
                </div>
            </div>
            @if($invoice->tax)
                <div class="border border-black pb-2">
                    <div class="border-b border-black py-2 bg-gray-100">
                        <p class="text-sm font-medium text-center">
                            عوارض و مالیات ارزش افزوده (تومان)
                        </p>
                    </div>
                    <div class="mt-2">
                        <p class="text-sm font-medium text-center">
                            {{ number_format($taxPrice) }}
                        </p>
                    </div>
                </div>

                <div class="border border-black pb-2">
                    <div class="border-b border-black py-2 bg-gray-100">
                        <p class="text-sm font-medium text-center">
                            قیمت نهایی با احتساب مالیات (تومان)
                        </p>
                    </div>
                    <div class="mt-2">
                        <p class="text-sm font-medium text-center">
                            {{ number_format($finalPrice + $taxPrice) }}
                        </p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Invoice description -->
        @if(!is_null($invoice->description))
            <div class="card border-0">
                <div class="card-header">
                    <p class="card-title text-base font-Titr">
                        شرایط پیش فاکتور
                    </p>
                </div>

                <div class="decimal-list">
                    {!! $invoice->description !!}
                </div>
            </div>
        @endif

        <!-- Expert -->
        <div class="mx-5 ml-10 mb-4 flex justify-between items-center">
            <div>
                <p class="text-xs font-bold bg-[#cf3b61] text-white py-1 px-2 rounded-lg">
                    کارشناس : {{ $invoice->user->name }} - داخلی {{ $invoice->user->internal_number }}
                </p>
            </div>
            <div class="ml-10">
                <p class="text-sm font-bold text-black text-center font-Titr">
                    با احترام فراوان<br> شرکت تهویه آذرباد
                </p>
            </div>
        </div>
    </div>
</x-clients.layout>
