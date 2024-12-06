<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contract Payments</title>

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
                </header>
                <div class="p-4" style="margin-top: 5rem;">
                    <table class="table-fixed w-full border-collapse">
                        <thead>
                        <tr class="text-black border-2 border-black text-xs bg-sky-100">
                            <th scope="col" class="p-1" style="border-left: 1px solid black" colspan="2">
                                <p class="text-sm">
                                    صورت وضعیت
                                </p>
                            </th>
                        </tr>
                        <tr class="text-black border-2 border-black text-xs">
                            <th scope="col" class="p-1 rounded-tr-lg" colspan="2"
                                style="border-left: 1px solid black">
                                <p class="text-sm">
                                    خریدار : {{ $contract->customer->name }}
                                </p>
                            </th>
                        </tr>
                        <tr class="text-black border-x-2 border border-black text-xs">
                            <th scope="col" class="p-1" style="border-left: 1px solid black">
                                <p class="text-sm">
                                    شماره قرارداد
                                </p>
                            </th>
                            <th scope="col" class="p-1" style="border-left: 1px solid black">
                                <p class="text-sm">
                                    تاریخ
                                </p>
                            </th>
                        </tr>
                        <tr class="text-black border-2 border-t border-black text-xs">
                            <th scope="col" class="p-1" style="border-left: 1px solid black">
                                <p class="text-sm">
                                    @if(is_null($contract->old_number))
                                        CNT-{{ $contract->number }}
                                    @else
                                        {{ $contract->old_number }}
                                    @endif
                                </p>
                            </th>
                            <th scope="col" class="p-1" style="border-left: 1px solid black">
                                <p class="text-sm">
                                    {{ jdate(now())->format('Y/m/d') }}
                                </p>
                            </th>
                        </tr>
                        <tr class="text-black border-2 border-t border-black text-xs">
                            <th scope="col" class="p-1 rounded-tr-lg" colspan="2"
                                style="border-left: 1px solid black">
                                <p class="text-sm">
                                    نام پروژه : {{ $contract->name }}
                                </p>
                            </th>
                        </tr>
                        </thead>
                    </table>
                </div>

                <div class="block mb-16 w-full"></div>
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
                                استان البرز، ماهدشت، خیابان سرداران، شهرک صنعتی خوارزمی، خیابان ششم شمالی، پلاک 39
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
                    <div class="card border-0 mb-0">
                        <div class="mt-2">
                            <div class="mb-4">
                                <p class="text-sm font-medium text-black mb-2">مبالغ قرارداد : </p>
                                <table class="table-auto w-full border-collapse">
                                    <thead>
                                    <tr class="text-black border border-x border-black text-xs bg-sky-100">
                                        <th scope="col" class="p-1 rounded-tr-lg" style="border-left: 1px solid black">
                                            @if($contract->type == 'official')
                                                مبلغ کل قرارداد با ارزش افزوده (تومان)
                                            @else
                                                مبلغ کل قرارداد (تومان)
                                            @endif
                                        </th>
                                        <th scope="col" class="p-1" style="border-left: 1px solid black">
                                            مبلغ ارزش افزوده (تومان)
                                        </th>
                                        <th scope="col" class="p-1" style="border-left: 1px solid black">
                                            مبلغ کل قرارداد بدون ارزش افزوده (تومان)
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        if ($contract->factors->isEmpty()) {
                                            $contractPrice = 0;
                                            $paymentPrice = 0;
                                            $leftPrice = 0;
                                            $collectionPrice = 0;

                                            foreach ($contract->products as $product) {
                                                $contractPrice += $product->price * $product->quantity;
                                            }

                                            foreach ($contract->payments()->where('confirm', 1)->get() as $payment2) {
                                                if ($payment2->type == 'return') {
                                                    $paymentPrice -= $payment2->price;
                                                } else {
                                                    $paymentPrice += $payment2->price;
                                                }

                                                if (is_null($payment2->account_id) && $payment2->cash_type == 'check') {
                                                    $collectionPrice += $payment2->price;
                                                }
                                            }

                                            $taxItem = \App\Models\Tax::where('year', jdate($contract->created_at)->getYear())->first();

                                            $tax = $contractPrice * $taxItem->rate / 100;
                                            $contractTaxPrice = $contractPrice + $tax;

                                            $leftPrice = $contractPrice - $paymentPrice;
                                            $leftTaxPrice = $contractTaxPrice - $paymentPrice;
                                        } else {
                                            $paymentPrice = 0;
                                            $collectionPrice = 0;
                                            foreach ($contract->payments()->where('confirm', 1)->get() as $payment2) {
                                                if ($payment2->type == 'return') {
                                                    $paymentPrice -= $payment2->price;
                                                } else {
                                                    $paymentPrice += $payment2->price;
                                                }

                                                if (is_null($payment2->account_id) && $payment2->cash_type == 'check') {
                                                    $collectionPrice += $payment2->price;
                                                }
                                            }

                                            $contractTaxPrice = 0;
                                            $totalTaxPrice = 0;
                                            $contractPrice = 0;
                                            $tax = 0;
                                            foreach($contract->factors as $factor) {
                                                $price = 0;
                                                $taxf = 0;
                                                $taxItem = 0;

                                                if (!$factor->contractProducts->isEmpty()) {
                                                    foreach ($factor->contractProducts as $product) {
                                                        $taxItem = \App\Models\Tax::where('year', jdate($factor->date)->getYear())->first();
                                                        $price += $product->price * $product->pivot->quantity;
                                                    }

                                                    $taxf = $price * $taxItem->rate / 100.0;
                                                    $tax += $taxf;

                                                    $contractTaxPrice += $price + $taxf;
                                                    $leftTaxPrice = $contractTaxPrice - $paymentPrice;
                                                    $contractPrice += $price;
                                                }

                                            }
                                        }
                                    @endphp
                                    <tr class="text-black text-xs text-center">
                                        <td class="border border-black border-t-0 border-r p-1">
                                            @if($contract->type == 'official')
                                                {{ number_format($contractTaxPrice ?? 0) }}
                                            @else
                                                {{ number_format($contractPrice ?? 0) }}
                                            @endif
                                        </td>
                                        <td class="border border-black border-t-0 border-l p-1">
                                            @if($contract->type == 'official')
                                                {{ number_format($tax ?? 0) }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="border border-black border-t-0 border-l p-1">
                                            {{ number_format($contractPrice ?? 0) }}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mb-4">
                                <p class="text-sm font-medium text-black mb-2">پرداخت های مشتری : </p>
                                <table class="table-auto w-full border-collapse">
                                    <thead>
                                    <tr class="text-black border border-x border-black text-xs bg-sky-100">
                                        <th scope="col" class="p-1 rounded-tr-lg" style="border-left: 1px solid black">
                                            ردیف
                                        </th>
                                        <th scope="col" class="p-1" style="border-left: 1px solid black">
                                            تاریخ وصول
                                        </th>
                                        <th scope="col" class="p-1" style="border-left: 1px solid black">
                                            نوع پرداخت
                                        </th>
                                        <th scope="col" class="p-1" style="border-left: 1px solid black">
                                            شرح
                                        </th>
                                        <th scope="col" class="p-1" style="border-left: 1px solid black">
                                            مبلغ (تومان)
                                        </th>
                                        <th scope="col" class="p-1" style="border-left: 1px solid black">
                                            بابت
                                        </th>
                                        <th scope="col" class="p-1">
                                            حساب واریزی
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($contract->payments as $payment)
                                        <tr class="text-black text-xs text-center">
                                            <td class="border border-black border-t-0 border-r p-1">
                                                {{ $loop->index + 1 }}
                                            </td>
                                            <td class="border border-black border-t-0 border-l p-1">
                                                @if(!is_null($payment->date))
                                                    {{ jdate($payment->date)->format('Y/m/d') }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="border border-black border-t-0 border-l p-1">
                                                @switch($payment->cash_type)
                                                    @case('check')
                                                        چک
                                                        @break
                                                    @case('cash')
                                                        نقدی
                                                        @break
                                                    @case('no_cash')
                                                        غیر نقدی
                                                        @break
                                                    @case('clearing')
                                                        تهاتر
                                                        @break
                                                    @case('currency')
                                                        ارزی
                                                        @break
                                                @endswitch
                                            </td>
                                            <td class="border border-black border-t-0 border-l p-1">
                                                {{ $payment->text ?? '-' }}
                                            </td>
                                            <td class="border border-black border-t-0 border-l p-1">
                                                <div class="flex items-center justify-center">
                                                    {{ number_format($payment->price) }}
                                                    @if($payment->type == 'return')
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                             viewBox="0 0 24 24"
                                                             stroke-width="1.5" stroke="currentColor"
                                                             class="w-4 h-4 text-red-500">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="M18 12H6"/>
                                                        </svg>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="border border-black border-t-0 border-l p-1">
                                                @switch($payment->type)
                                                    @case('prepayment')
                                                        پیش پرداخت
                                                        @break
                                                    @case('interim_payment')
                                                        میان پرداخت
                                                        @break
                                                    @case('clearing')
                                                        تسویه
                                                        @break
                                                    @case('discount')
                                                        تخفیف (اضافه مانده)
                                                        @break
                                                    @case('recoupment')
                                                        مفاصا حساب
                                                        @break
                                                    @case('tax')
                                                        مالیات
                                                        @break
                                                    @case('work')
                                                        حسن انجام کار
                                                        @break
                                                    @case('return')
                                                        <span class="bg-red-500 text-white rounded-lg py-1 px-4">
                                                            عودت
                                                        </span>
                                                        @break
                                                @endswitch
                                            </td>
                                            <td class="border border-black border-t-0 border-l p-1">
                                                @if(!is_null($payment->account_id) && $payment->account_id != '0')
                                                    {{ $payment->account->bank }} | {{ $payment->account->branch }}
                                                    | {{ $payment->account->account_number }}
                                                @elseif($payment->account_id == '0')
                                                    سایر
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mb-4">
                                <p class="text-sm font-medium text-black mb-2">نتایج : </p>
                                <table class="table-auto w-full border-collapse">
                                    <thead>
                                    <tr class="text-black border border-x border-black text-xs bg-sky-100">
                                        <th scope="col" class="p-1 rounded-tr-lg" style="border-left: 1px solid black">
                                            مجموع پرداخت ها (تومان)
                                        </th>
                                        <th scope="col" class="p-1" style="border-left: 1px solid black">
                                            بدهی مشتری (تومان)
                                        </th>
                                        <th scope="col" class="p-1" style="border-left: 1px solid black">
                                            وصول نشده ها (تومان)
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        if ($contract->factors->isEmpty()) {
                                            $contractPrice = 0;
                                            $paymentPrice = 0;
                                            $leftPrice = 0;
                                            $collectionPrice = 0;

                                            foreach ($contract->products as $product) {
                                                $contractPrice += $product->price * $product->quantity;
                                            }

                                            foreach ($contract->payments()->where('confirm', 1)->get() as $payment2) {
                                                if ($payment2->type == 'return') {
                                                    $paymentPrice -= $payment2->price;
                                                } else {
                                                    $paymentPrice += $payment2->price;
                                                }

                                                if (is_null($payment2->account_id) && $payment2->cash_type == 'check') {
                                                    $collectionPrice += $payment2->price;
                                                }
                                            }

                                            $taxItem = \App\Models\Tax::where('year', jdate($contract->created_at)->getYear())->first();

                                            $tax = $contractPrice * $taxItem->rate / 100;
                                            $contractTaxPrice = $contractPrice + $tax;

                                            $leftPrice = $contractPrice - $paymentPrice;
                                            $leftTaxPrice = $contractTaxPrice - $paymentPrice;
                                        } else {
                                            $paymentPrice = 0;
                                            $collectionPrice = 0;
                                            foreach ($contract->payments()->where('confirm', 1)->get() as $payment2) {
                                                if ($payment2->type == 'return') {
                                                    $paymentPrice -= $payment2->price;
                                                } else {
                                                    $paymentPrice += $payment2->price;
                                                }

                                                if (is_null($payment2->account_id) && $payment2->cash_type == 'check') {
                                                    $collectionPrice += $payment2->price;
                                                }
                                            }

                                            $contractTaxPrice = 0;
                                            $totalTaxPrice = 0;
                                            $contractPrice = 0;
                                            $tax = 0;
                                            foreach($contract->factors as $factor) {
                                                $price = 0;
                                                $taxf = 0;
                                                $taxItem = 0;

                                                if (!$factor->contractProducts->isEmpty()) {
                                                    foreach ($factor->contractProducts as $product) {
                                                        $taxItem = \App\Models\Tax::where('year', jdate($factor->date)->getYear())->first();
                                                        $price += $product->price * $product->pivot->quantity;
                                                    }

                                                    $taxf = $price * $taxItem->rate / 100.0;
                                                    $tax += $taxf;

                                                    $contractTaxPrice += $price + $taxf;
                                                    $leftTaxPrice = $contractTaxPrice - $paymentPrice;
                                                    $contractPrice += $price;
                                                }

                                            }
                                        }
                                    @endphp
                                    <tr class="text-black text-xs text-center">
                                        <td class="border border-black border-t-0 border-r p-1">
                                            {{ number_format($paymentPrice ?? 0) }}
                                        </td>
                                        <td class="border border-black border-t-0 border-l p-1">
                                            @if($contract->type == 'official')
                                                {{ number_format($leftTaxPrice ?? 0) }}
                                            @else
                                                {{ number_format($leftPrice ?? 0) }}
                                            @endif
                                        </td>
                                        <td class="border border-black border-t-0 border-l p-1">
                                            {{ number_format($collectionPrice ?? 0) }}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
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
