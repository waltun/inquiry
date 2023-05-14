<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>INV-{{ $invoice->inquiry->inquiry_number }}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="font-IRANSans">

<!-- Content -->
<div class="mx-auto" style="width: 21cm">
    <table style="page-break-after: always" class="w-full relative">
        <!-- Header -->
        <thead style="display: table-header-group">
        <tr>
            <th>
                <header class="flex fixed top-0 z-50 w-full">
                    <div class="w-36 h-14 bg-[#cf3b61] -mr-10" style="transform: skew(30deg)"></div>
                    <div class="w-96 h-14 bg-gray-100 mr-10" style="transform: skew(30deg)">
                        <div class="flex items-center space-x-2 justify-center" style="transform: skew(-30deg)">
                            <img src="{{ asset('images/azarbad.png') }}" alt="" class="w-24">
                            <div class="space-y-1">
                                <p class="text-sm font-medium text-myBlue-100 tracking-wider">تهویه آذرباد</p>
                                <p class="text-xs font-medium text-myBlue-100">Tahvieh Azarbad</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-40 h-14 bg-gray-100 mr-10" style="transform: skew(30deg)">
                        <div class="flex justify-between mx-3">
                            <div class="w-6 h-16 bg-[#cf3b61]"></div>
                            <div class="w-6 h-16 bg-[#005a96]"></div>
                        </div>
                    </div>
                    <div class="w-full h-5 bg-[#cf3b61]"></div>
                    <div class="absolute right-72 top-5 mr-16 p-1">
                        <div class="flex mr-16 justify-center">
                            <p class="text-xs font-bold text-black">
                                نام پروژه / خریدار : {{ $invoice->inquiry->name }}
                            </p>
                        </div>
                        <div class="flex items-center justify-center whitespace-nowrap mt-2">
                            <p class="text-xs font-bold text-black mr-16">
                                تاریخ : {{ jdate($invoice->created_at)->format('Y/m/d') }}
                            </p>
                            <p class="text-xs font-bold text-black mr-8">
                                شماره : INV-{{ $invoice->inquiry->inquiry_number }}
                            </p>
                        </div>
                    </div>
                </header>
                <div class="block mb-20 w-full"></div>
            </th>
        </tr>
        </thead>
        <!-- Footer -->
        <tfoot>
        <tr>
            <td>
                <footer class="flex items-end fixed bottom-0 z-50 w-full">
                    <div class="w-64 h-12 bg-[#cf3b61] flex items-center justify-center z-30"
                         style="border-top-left-radius: 2.5rem">
                        <p class="text-sm font-bold text-white">
                            www.tahviehazarbad.com
                        </p>
                    </div>
                    <div class="w-36 h-10 bg-[#005a96] absolute -top-6 z-10"
                         style="border-top-left-radius: 2rem"></div>
                    <div class="w-full bg-[#005a96] mb-0 -mr-2 p-1">
                        <div class="flex items-center mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                 class="w-5 h-5 text-white">
                                <path fill-rule="evenodd"
                                      d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <p class="text-xs text-white font-medium mr-1 text-justify">
                                تهران، پونک، خیابان سردار جنگل، بالاتر از میرزابابایی، نبش بن بست ده متری گلستان، پلاک
                                4، واحد 4
                            </p>
                        </div>
                    </div>
                    <div class="absolute right-56 -top-4 p-2">
                        <div class="grid grid-cols-3 gap-4">
                            <div class="flex items-center justify-end">
                                <p class="text-xs text-black font-medium ml-2 text-justify">
                                    info@tahviehazarbad.com
                                </p>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                     class="w-6 h-6 flex-shrink-0 text-white bg-gray-600 rounded-md p-1">
                                    <path
                                        d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z"/>
                                    <path
                                        d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z"/>
                                </svg>
                            </div>
                            <div class="flex items-center justify-end">
                                <p class="text-xs text-black font-medium ml-2 text-justify">
                                    09224924765
                                </p>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                     class="w-6 h-6 flex-shrink-0 text-white bg-gray-600 rounded-md p-1">
                                    <path d="M10.5 18.75a.75.75 0 000 1.5h3a.75.75 0 000-1.5h-3z"/>
                                    <path fill-rule="evenodd"
                                          d="M8.625.75A3.375 3.375 0 005.25 4.125v15.75a3.375 3.375 0 003.375 3.375h6.75a3.375 3.375 0 003.375-3.375V4.125A3.375 3.375 0 0015.375.75h-6.75zM7.5 4.125C7.5 3.504 8.004 3 8.625 3H9.75v.375c0 .621.504 1.125 1.125 1.125h2.25c.621 0 1.125-.504 1.125-1.125V3h1.125c.621 0 1.125.504 1.125 1.125v15.75c0 .621-.504 1.125-1.125 1.125h-6.75A1.125 1.125 0 017.5 19.875V4.125z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="flex items-center justify-end">
                                <p class="text-xs text-black font-medium ml-2 text-justify">
                                    02144411345
                                </p>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                     class="w-6 h-6 flex-shrink-0 text-white bg-[#cf3b61] rounded-md p-1">
                                    <path fill-rule="evenodd"
                                          d="M1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </footer>
                <div class="block mt-20 w-full"></div>
            </td>
        </tr>
        </tfoot>
        <!-- Main -->
        <tbody>
        <tr>
            <td>
                <div class="relative">
                    <!-- Product List -->
                    @php
                        $productTotalPrice = 0;
                    @endphp
                    @if(!$invoice->products()->where('group_id','!=',0)->where('model_id','!=',0)->where('deleted_at',null)->get()->isEmpty())
                        <div class="card border-0 mb-0">
                            <div>
                                <p class="text-sm font-bold">لیست محصولات</p>
                            </div>

                            <div class="mt-2">
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

                                            $price = ceil($product->price / 1000) * 1000;
                                            $productPercentPrice = 0;
                                            if ($product->percent > 0) {
                                                $productTotalPrice += ceil($price * $product->quantity / $product->percent / 1000) * 1000;
                                                $productPercentPrice = ceil($price * $product->quantity / $product->percent / 1000) * 1000;
                                            } else {
                                                $productTotalPrice += ceil($price * $product->quantity / 1000) * 1000;
                                                $productPercentPrice = ceil($price * $product->quantity / 1000) * 1000;
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
                                                $percentPrice = ceil($price / $product->percent / 1000) * 1000;
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
                        </div>
                    @endif

                    <!-- Part List -->
                    @php
                        $types = ['setup','years','control','power_cable','control_cable','pipe','install_setup_price','setup_price','supervision','transport','other','setup_one','install','cable','canal','copper_piping','carbon_piping',null];
                        $partsTotalPrice = 0;
                    @endphp
                    @foreach($types as $type)
                        @php
                            $products = $invoice->products()->where('part_id','!=',0)->where('type',$type)->where('deleted_at',null)->get();
                        @endphp
                        @if(!$products->isEmpty())
                            <div class="card border-0 mb-0">
                                <div class="mb-2">
                                    <p class="text-sm font-bold">
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
                                        <th class="p-1" style="border-left: 1px solid black">قیمت واحد (تومان)</th>
                                        <th class="p-1">قیمت کل (تومان)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $partTotalPrice = 0;
                                    @endphp
                                    @foreach($products as $product)
                                        @php
                                            $part = \App\Models\Part::find($product->part_id);

                                            $price = ceil($product->price / 1000) * 1000;
                                            $partPercentPrice = 0;
                                            if ($product->percent > 0) {
                                                $partTotalPrice += ceil($price * $product->quantity / $product->percent / 1000) * 1000;
                                                $partPercentPrice = ceil($price * $product->quantity / $product->percent / 1000) * 1000;
                                            } else {
                                                $partTotalPrice += ceil($price * $product->quantity / 1000) * 1000;
                                                $partPercentPrice = ceil($price * $product->quantity / 1000) * 1000;
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
                                                $percentPrice = ceil($price / $product->percent / 1000) * 1000;
                                            @endphp
                                            <td class="p-1 border-black border-t-0 border-l">
                                                {{ number_format($percentPrice) }}
                                            </td>
                                            <td class="p-1 border-black border-t-0 border-r-0">
                                                {{ number_format($partPercentPrice) }}
                                            </td>
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
                            $taxPrice = ceil($finalPrice * 9 / 100 / 1000) * 1000;
                        }
                    @endphp
                    <div class="grid grid-cols-3 gap-4 mx-5 mb-4">
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
                                        {{ number_format($finalPrice +$taxPrice) }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Invoice description -->
                    @if(!is_null($invoice->description))
                        <div class="card border-0">
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

                    <!-- Expert -->
                    <div class="mx-5 ml-10 mb-4 flex justify-between items-center">
                        <div>
                            <p class="text-xs font-bold bg-[#cf3b61] text-white py-1 px-2 rounded-lg">
                                کارشناس : {{ $invoice->user->name }} - داخلی {{ $invoice->user->internal_number }}
                            </p>
                        </div>
                        <div class="ml-10">
                            <p class="text-sm font-bold text-black text-center">
                                با احترام فراوان<br> شرکت تهویه آذرباد
                            </p>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<script>
    window.onload = function () {
        window.print();
    }
</script>

</body>
</html>
