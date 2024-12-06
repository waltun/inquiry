<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script>
            function destroyPayment(id) {
                if (confirm('پرداختی حذف شود ؟')) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('contracts.payments.destroy') }}',
                        data: {
                            id: id
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
    <div class="flex items-center space-x-2 space-x-reverse whitespace-nowrap">
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
                      d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    مدیریت پرداخت های قرارداد {{ $contract->name }}
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
                      d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/>
            </svg>
            <div class="mr-2">
                <p class="font-bold text-2xl text-black dark:text-white">
                    لیست پرداخت های قرارداد {{ $contract->name }} - {{ $contract->customer->name }} -
                    CNT-{{ $contract->number }}
                </p>
            </div>
        </div>
        <div class="flex items-center space-x-4 space-x-reverse">
            <a href="{{ route('contracts.payments.create', $contract->id) }}" class="page-success-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-4 h-4 ml-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                ایجاد پرداخت جدید
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
        <form method="POST" action="{{ route('contracts.payments.confirm', $contract->id) }}"
              class="mt-8 overflow-x-auto rounded-lg">
            @csrf
            <table class="w-full border-collapse">
                <thead>
                <tr class="table-th-tr">
                    <th scope="col" class="p-4 rounded-tr-lg">
                        #
                    </th>
                    <th scope="col" class="p-4">
                        تاریخ وصول
                    </th>
                    <th scope="col" class="p-4">
                        نوع پرداخت
                    </th>
                    <th scope="col" class="p-4">
                        شرح
                    </th>
                    <th scope="col" class="p-4">
                        مبلغ (تومان)
                    </th>
                    <th scope="col" class="p-4">
                        بابت
                    </th>
                    <th scope="col" class="p-4">
                        حساب واریزی
                    </th>
                    <th scope="col" class="p-4">
                        تاییدیه
                    </th>
                    <th scope="col" class="p-4 rounded-tl-lg">
                        <span class="sr-only">اقدامات</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($contract->payments as $payment)
                    <tr class="table-tb-tr group whitespace-normal {{ $loop->even ? 'bg-sky-100' : '' }}">
                        <td class="table-tr-td border-t-0 border-l-0">
                            {{ $loop->index + 1 }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            @if(!is_null($payment->date))
                                {{ jdate($payment->date)->format('Y/m/d') }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
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
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ $payment->text ?? '-' }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            <div class="flex items-center justify-center">
                                {{ number_format($payment->price) }}
                                @if($payment->type == 'return')
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-red-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6"/>
                                    </svg>
                                @endif
                            </div>
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
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
                        <td class="table-tr-td border-t-0 border-x-0">
                            @if(!is_null($payment->account_id) && $payment->account_id != '0')
                                {{ $payment->account->bank }} | {{ $payment->account->branch }}
                                | {{ $payment->account->account_number }}
                            @elseif($payment->account_id == '0')
                                سایر
                            @else
                                -
                            @endif
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            @if(auth()->user()->role == 'admin')
                                <input type="hidden" value="{{ $payment->id }}" name="payments[]">
                                <select name="confirms[]" id="inputConfirm{{ $payment->id }}" class="input-text">
                                    <option value="1" {{ $payment->confirm ? 'selected' : '' }}>
                                        تایید
                                    </option>
                                    <option value="0" {{ !$payment->confirm ? 'selected' : '' }}>
                                        عدم تایید
                                    </option>
                                </select>
                            @else
                                {{ $payment->confirm ? 'تایید شده' : 'تایید نشده' }}
                            @endif
                        </td>
                        <td class="table-tr-td border-t-0 border-r-0 whitespace-nowrap">
                            <div class="flex items-center justify-center space-x-4 space-x-reverse">
                                <a href="{{ route('contracts.payments.edit',$payment->id) }}"
                                   class="table-dropdown-edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                    </svg>
                                    ویرایش
                                </a>

                                <button type="button" onclick="destroyPayment({{ $payment->id }})"
                                        class="table-delete-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                    </svg>
                                    حذف
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            @if(auth()->user()->role == 'admin')
                <div class="mt-4 flex justify-end items-center">
                    @if(!$contract->payments->isEmpty() && auth()->user()->role == 'admin')
                        <button type="submit" class="form-submit-btn">
                            ثبت تاییدیه
                        </button>
                    @endif
                </div>
            @endif
        </form>
    </div>

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

    <div class="mt-8 grid grid-cols-4 gap-4">
        <div class="p-4 rounded-lg shadow bg-indigo-500">
            @if($contract->type == 'official')
                <p class="text-base text-white text-center font-bold">
                    مبلغ کل قرارداد با ارزش افزوده : {{ number_format($contractTaxPrice ?? 0) }} تومان
                </p>
            @else
                <p class="text-base text-white text-center font-bold">
                    مبلغ کل قرارداد : {{ number_format($contractPrice ?? 0) }} تومان
                </p>
            @endif
        </div>

        <div class="p-4 rounded-lg shadow bg-green-500">
            <p class="text-base text-white text-center font-bold">
                مجموع پرداخت‌ها : {{ number_format($paymentPrice ?? 0) }} تومان
            </p>
        </div>

        <div class="p-4 rounded-lg shadow bg-red-500">
            @if($contract->type == 'official')
                <p class="text-base text-white text-center font-bold">
                    بدهی مشتری : {{ number_format($leftTaxPrice ?? 0) }} تومان
                </p>
            @else
                <p class="text-base text-white text-center font-bold">
                    بدهی مشتری : {{ number_format($leftPrice ?? 0) }} تومان
                </p>
            @endif
        </div>

        <div class="p-4 rounded-lg shadow bg-yellow-500">
            <p class="text-base text-white text-center font-bold">
                وصول نشده‌ها : {{ number_format($collectionPrice ?? 0) }} تومان
            </p>
        </div>

        @if($contract->type == 'official')
            <div class="space-y-4">
                <p class="text-center text-sm underline underline-offset-4 text-gray-600">
                    مبلغ کل قرارداد بدون ارزش افزوده : {{ number_format($contractPrice ?? 0) }} تومان
                </p>
                <p class="text-center text-sm underline underline-offset-4 text-gray-600">
                    مبلغ ارزش افزوده : {{ number_format($tax ?? 0) }} تومان
                </p>
            </div>
        @endif
    </div>

    <div class="mt-4 flex justify-end">
        <a href="{{ route('contracts.payments.print', $contract->id) }}" class="page-info-btn" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-4 h-4 ml-1">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z"/>
            </svg>
            پرینت
        </a>
    </div>
</x-layout>
