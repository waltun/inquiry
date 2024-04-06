<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
        <script>
            $("#inputInvoice").select2();
        </script>
    </x-slot>
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
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
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg-active">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    مشاهده قرارداد {{ $contract->name }} - {{ $contract->customer->name }} - CNT-{{ $contract->number }}
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
                      d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <div class="mr-2">
                <p class="font-bold text-2xl text-black dark:text-white">
                    قرارداد {{ $contract->name }} - CNT-{{ $contract->number }}
                </p>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="mt-4 space-y-4">
        <div class="p-4 rounded-md shadow border border-indigo-400 bg-white">
            <div class="mb-4">
                <span class="px-6 py-1 rounded-md text-center bg-yellow-400 text-xs font-bold text-black">
                    فروش
                </span>
            </div>
            @php
                $saleSuccessCount = 0;
            @endphp
            <div class="grid grid-cols-6 gap-4">
                <a href="{{ route('contracts.invoices.index', $contract->id) }}"
                   class="p-2 rounded-2xl shadow flex items-center justify-between border border-gray-300 {{ $contract->invoices->isEmpty() ? 'bg-opacity-50 border-opacity-50 bg-gray-300' : 'bg-green-400' }}">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z"/>
                        </svg>
                        <div class="mr-2">
                            <p class="font-bold text-black text-xs {{ $contract->invoices->isEmpty() ? 'text-opacity-40' : '' }}">
                                پیش فاکتور
                            </p>
                        </div>
                    </div>
                    <div>
                        @if($contract->invoices->isEmpty())
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                 class="w-5 h-5 text-gray-600 text-opacity-40">
                                <path fill-rule="evenodd"
                                      d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                      clip-rule="evenodd"/>
                            </svg>
                        @else
                            @php
                                $saleSuccessCount++;
                            @endphp
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-5 h-5 text-gray-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                            </svg>
                        @endif
                    </div>
                </a>

                <a href="{{ route('contracts.contract.index', $contract->id) }}"
                   class="p-2 rounded-2xl shadow flex items-center justify-between border border-gray-300 {{ is_null($contract->file) ? 'border-opacity-50 bg-opacity-50 bg-gray-300' : 'bg-green-400' }}">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <p class="font-bold text-black text-xs {{ is_null($contract->file) ? 'text-opacity-40' : '' }}">
                                قرارداد
                            </p>
                        </div>
                    </div>
                    <div>
                        @if(is_null($contract->file))
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                 class="w-5 h-5 text-gray-600 text-opacity-40">
                                <path fill-rule="evenodd"
                                      d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                      clip-rule="evenodd"/>
                            </svg>
                        @else
                            @php
                                $saleSuccessCount++;
                            @endphp
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-5 h-5 text-gray-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                            </svg>
                        @endif
                    </div>
                </a>

                <a href="{{ route('contracts.customer.index', $contract->id) }}"
                   class="p-2 rounded-2xl shadow flex items-center justify-between border border-gray-300 {{ is_null($contract->customer_id) ? 'bg-opacity-50 border-opacity-50 bg-gray-300' : 'bg-green-400' }}">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                        </svg>
                        <div class="mr-2">
                            <p class="font-bold text-black text-xs {{ is_null($contract->customer_id) ? 'text-opacity-40' : '' }}">
                                اطلاعات مشتری
                            </p>
                        </div>
                    </div>
                    <div>
                        @if(is_null($contract->customer_id))
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                 class="w-5 h-5 text-gray-600 text-opacity-40">
                                <path fill-rule="evenodd"
                                      d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                      clip-rule="evenodd"/>
                            </svg>
                        @else
                            @php
                                $saleSuccessCount++;
                            @endphp
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-5 h-5 text-gray-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                            </svg>
                        @endif

                    </div>
                </a>

                <a href="{{ route('contracts.products', $contract->id) }}"
                   class="p-2 rounded-2xl shadow flex items-center justify-between border border-gray-300 {{ $contract->products->isEmpty() ? 'bg-opacity-50 border-opacity-50 bg-gray-300' : 'bg-green-400' }}">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 4.5v15m6-15v15m-10.875 0h15.75c.621 0 1.125-.504 1.125-1.125V5.625c0-.621-.504-1.125-1.125-1.125H4.125C3.504 4.5 3 5.004 3 5.625v12.75c0 .621.504 1.125 1.125 1.125Z"/>
                        </svg>
                        <div class="mr-2">
                            <p class="font-bold text-black text-xs {{ $contract->products->isEmpty() ? 'text-opacity-40' : '' }}">
                                لیست محصولات و اقلام
                            </p>
                        </div>
                    </div>
                    <div>
                        @if($contract->products->isEmpty())
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                 class="w-5 h-5 text-gray-600 text-opacity-40">
                                <path fill-rule="evenodd"
                                      d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                      clip-rule="evenodd"/>
                            </svg>
                        @else
                            @php
                                $saleSuccessCount++;
                            @endphp
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-5 h-5 text-gray-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                            </svg>
                        @endif

                    </div>
                </a>
                @php
                    $amountStatus = true;
                    foreach ($contract->products as $product) {
                        if (!$product->spareAmounts->isEmpty()) {
                            $amountStatus = false;
                        }
                    }
                @endphp
                <a href="{{ route('contracts.parts.index', $contract->id) }}"
                   class="p-2 rounded-2xl shadow flex items-center justify-between border border-gray-300 {{ $amountStatus ? 'bg-opacity-50 border-opacity-50 bg-gray-300' : 'bg-green-400' }}">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z"/>
                        </svg>
                        <div class="mr-2">
                            <p class="font-bold text-black text-xs {{ $amountStatus ? 'text-opacity-40' : '' }}">
                                ریز آنالیز قطعات محصولات
                            </p>
                        </div>
                    </div>
                    <div>
                        @if($amountStatus)
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                 class="w-5 h-5 text-gray-600">
                                <path fill-rule="evenodd"
                                      d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                      clip-rule="evenodd"/>
                            </svg>
                        @else
                            @php
                                $saleSuccessCount++;
                            @endphp
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-5 h-5 text-gray-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                            </svg>
                        @endif
                    </div>
                </a>
            </div>

            @php
                $salePercent = $saleSuccessCount / 5 * 100;
            @endphp
            <div
                class="flex items-center justify-between mt-4 space-x-4 space-x-reverse p-2 rounded-md border border-yellow-400">
                <p class="text-xs font-bold text-black">وضعیت</p>
                <div class="w-full bg-gray-200 rounded-full">
                    <div class="bg-blue-600 text-xs font-medium text-white text-center p-0.5 leading-none rounded-full"
                         style="width: {{ $salePercent }}%">
                        {{ number_format($salePercent) }}%
                    </div>
                </div>
            </div>
        </div>

        <div class="p-4 rounded-md shadow border border-indigo-400 bg-white">
            <div class="mb-4 flex items-center justify-between">
                <span class="px-6 py-1 rounded-md text-center bg-yellow-400 text-xs font-bold text-black">
                    مالی
                </span>

                <div class="flex items-center space-x-4 space-x-reverse">
                    @if($contract->marketings->isEmpty())
                        <a href="{{ route('contracts.marketings.create', $contract->id) }}" class="page-info-btn py-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                            </svg>
                            <span class="mr-2">ایجاد بازاریابی</span>
                        </a>
                    @endif

                    @if($contract->guarantees->isEmpty())
                        <a href="{{ route('contracts.guarantees.create', $contract->id) }}" class="page-info-btn py-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                            </svg>
                            <span class="mr-2">ایجاد تضمین</span>
                        </a>
                    @endif
                </div>
            </div>
            <div class="grid grid-cols-6 gap-4">
                @php
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

                    $leftPricePayment = $contractPrice - $paymentPrice;
                    $leftTaxPricePayment = $contractTaxPrice - $paymentPrice;
                @endphp
                <a href="{{ route('contracts.payments.index', $contract->id) }}"
                   class="p-2 rounded-2xl shadow border border-gray-300 {{ $contract->payments->isEmpty() ? 'bg-opacity-50 border-opacity-50 bg-gray-300' : 'bg-green-400' }}">
                    <div class="flex items-center justify-between border-b border-white pb-2">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z"/>
                            </svg>
                            <div class="mr-2">
                                <p class="font-bold text-black text-xs {{ $contract->payments->isEmpty() ? 'text-opacity-40' : '' }}">
                                    پرداخت ها
                                </p>
                            </div>
                        </div>
                        <div>
                            @if($contract->payments->isEmpty())
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                     class="w-5 h-5 text-gray-600 text-opacity-40">
                                    <path fill-rule="evenodd"
                                          d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                          clip-rule="evenodd"/>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="currentColor" class="w-5 h-5 text-gray-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                                </svg>
                            @endif
                        </div>
                    </div>
                    <div class="mt-2 space-y-2">
                        <p class="text-xs text-black">
                            پرداخت شده : {{ number_format($paymentPrice) }} تومان
                        </p>
                        @if($contract->type == 'official')
                            <p class="text-xs text-black">
                                مانده : {{ number_format($leftTaxPricePayment) }} تومان
                            </p>
                        @else
                            <p class="text-xs text-black">
                                مانده : {{ number_format($leftPricePayment) }} تومان
                            </p>
                        @endif
                    </div>
                </a>

                @if(!$contract->marketings->isEmpty())
                    @php
                        $price = 0;
                        foreach ($contract->marketings as $marketing) {
                            foreach ($marketing->payments()->where('confirm', 1)->where('date', '!=', null)->get() as $payment) {
                                $price += $payment->price;
                            }
                        }

                        $leftPriceMarketing = $contract->marketings->sum('price') - $price;
                    @endphp
                    <a href="{{ route('contracts.marketings.index', $contract->id) }}"
                       class="p-2 rounded-2xl shadow border border-gray-300 {{ $contract->marketings->isEmpty() ? 'bg-opacity-50 border-opacity-50 bg-gray-300' : 'bg-green-400' }}">
                        <div class="flex items-center justify-between border-b border-white pb-2">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                     stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46"/>
                                </svg>
                                <div class="mr-2">
                                    <p class="font-bold text-black text-xs {{ $contract->marketings->isEmpty() ? 'text-opacity-40' : '' }}">
                                        بازاریابی
                                    </p>
                                </div>
                            </div>
                            <div>
                                @if($contract->marketings->isEmpty())
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                         class="w-5 h-5 text-gray-600 text-opacity-40">
                                        <path fill-rule="evenodd"
                                              d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor" class="w-5 h-5 text-gray-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                                    </svg>
                                @endif

                            </div>
                        </div>
                        <div class="mt-2 space-y-2">
                            <p class="text-xs text-black">
                                پرداخت شده : {{ number_format($price) }} تومان
                            </p>
                            <p class="text-xs text-black">
                                مانده : {{ number_format($leftPriceMarketing) }} تومان
                            </p>
                        </div>
                    </a>
                @endif

                @if(!$contract->guarantees->isEmpty())
                    <a href="{{ route('contracts.guarantees.index', $contract->id) }}"
                       class="p-2 rounded-2xl shadow flex items-center justify-between border border-gray-300 {{ $contract->guarantees->isEmpty() ? 'bg-opacity-50 border-opacity-50 bg-gray-300' : 'bg-green-400' }}">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>
                            </svg>
                            <div class="mr-2">
                                <p class="font-bold text-black text-xs {{ $contract->guarantees->isEmpty() ? 'text-opacity-40' : '' }}">
                                    تضامین
                                </p>
                            </div>
                        </div>
                        <div>
                            @if($contract->guarantees->isEmpty())
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                     class="w-5 h-5 text-gray-600 text-opacity-40">
                                    <path fill-rule="evenodd"
                                          d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                          clip-rule="evenodd"/>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="currentColor" class="w-5 h-5 text-gray-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                                </svg>
                            @endif

                        </div>
                    </a>
                @endif

                @if(!$contract->products()->where('group_id','!=',0)->where('model_id','!=',0)->get()->isEmpty())
                    <a href="{{ route('contracts.exclusive-code.index', $contract->id) }}"
                       class="p-2 rounded-2xl shadow flex items-center justify-between border border-gray-300 {{ $contract->products()->where('group_id','!=',0)->where('model_id','!=',0)->get()->contains('code', null) ? 'bg-opacity-50 border-opacity-50 bg-gray-300' : 'bg-green-400' }}">
                        <div class="flex items-center">
                            <div class="mr-4">
                                <p class="font-bold text-black text-xs {{ $contract->products()->where('group_id','!=',0)->where('model_id','!=',0)->get()->contains('code', null) ? 'text-opacity-40' : '' }}">
                                    اخذ کد اختصاصی
                                </p>
                            </div>
                        </div>
                        <div>
                            @if($contract->products()->where('group_id','!=',0)->where('model_id','!=',0)->get()->contains('code', null))
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                     class="w-5 h-5 text-gray-600 text-opacity-40">
                                    <path fill-rule="evenodd"
                                          d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                          clip-rule="evenodd"/>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="currentColor" class="w-5 h-5 text-gray-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                                </svg>
                            @endif

                        </div>
                    </a>
                @endif

                <a href="{{ route('contracts.invoices.index', $contract->id) }}"
                   class="p-2 rounded-2xl bg-gray-300 shadow flex items-center justify-between border border-gray-300 bg-opacity-50 border-opacity-50">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <p class="font-bold text-black text-xs group-hover:text-white dark:text-white text-opacity-40">
                                فاکتور رسمی
                            </p>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             class="w-5 h-5 text-gray-600 group-hover:text-gray-200 dark:text-white text-opacity-40">
                            <path fill-rule="evenodd"
                                  d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                </a>

                <a href="{{ route('contracts.invoices.index', $contract->id) }}"
                   class="p-2 rounded-2xl bg-gray-300 shadow flex items-center justify-between border border-gray-300 bg-opacity-50 border-opacity-50">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <p class="font-bold text-black text-xs group-hover:text-white dark:text-white text-opacity-40">
                                مفاصا حساب
                            </p>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             class="w-5 h-5 text-gray-600 group-hover:text-gray-200 dark:text-white text-opacity-40">
                            <path fill-rule="evenodd"
                                  d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                </a>
            </div>

            <div
                class="flex items-center justify-between mt-4 space-x-4 space-x-reverse p-2 rounded-md border border-yellow-400">
                <p class="text-xs font-bold text-black">وضعیت</p>
                <div class="w-full bg-gray-200 rounded-full">
                    <div class="bg-blue-600 text-xs font-medium text-white text-center p-0.5 leading-none rounded-full"
                         style="width: 40%">
                        40%
                    </div>
                </div>
            </div>
        </div>

        <div class="p-4 rounded-md shadow border border-indigo-400 bg-white">
            <div class="mb-4 flex items-center justify-between">
                <span class="px-6 py-1 rounded-md text-center bg-yellow-400 text-xs font-bold text-black">
                    کارخانه
                </span>

                @if($contract->packings->isEmpty())
                    <a href="{{ route('packings.create', $contract->id) }}" class="page-info-btn py-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                        </svg>
                        <span class="mr-2">ایجاد پکینگ</span>
                    </a>
                @endif
            </div>
            <div class="grid grid-cols-6 gap-4">
                <a href="{{ route('contracts.recipe.index', $contract->id) }}"
                   class="p-2 rounded-2xl shadow flex items-center justify-between border border-gray-300 {{ !$contract->recipe ? 'bg-opacity-50 border-opacity-50 bg-gray-300' : 'bg-green-400' }}">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z"/>
                        </svg>
                        <div class="mr-2">
                            <p class="font-bold text-black text-xs {{ !$contract->recipe ? 'text-opacity-40' : '' }}">
                                دستور ساخت
                            </p>
                        </div>
                    </div>
                    <div>
                        @if(!$contract->recipe)
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                 class="w-5 h-5 text-gray-600 text-opacity-40">
                                <path fill-rule="evenodd"
                                      d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                      clip-rule="evenodd"/>
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor" class="w-5 h-5 text-gray-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                            </svg>
                        @endif

                    </div>
                </a>

                <a href="{{ route('contracts.invoices.index', $contract->id) }}"
                   class="p-2 rounded-2xl bg-gray-300 shadow flex items-center justify-between border border-gray-300 bg-opacity-50 border-opacity-50">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <p class="font-bold text-black text-xs group-hover:text-white dark:text-white text-opacity-40">
                                زمان شروع و پایان ساخت
                            </p>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             class="w-5 h-5 text-gray-600 group-hover:text-gray-200 dark:text-white text-opacity-40">
                            <path fill-rule="evenodd"
                                  d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                </a>

                <a href="{{ route('contracts.invoices.index', $contract->id) }}"
                   class="p-2 rounded-2xl bg-gray-300 shadow flex items-center justify-between border border-gray-300 bg-opacity-50 border-opacity-50">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <p class="font-bold text-black text-xs group-hover:text-white dark:text-white text-opacity-40">
                                تدارکات
                            </p>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             class="w-5 h-5 text-gray-600 group-hover:text-gray-200 dark:text-white text-opacity-40">
                            <path fill-rule="evenodd"
                                  d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                </a>

                <a href="{{ route('contracts.invoices.index', $contract->id) }}"
                   class="p-2 rounded-2xl bg-gray-300 shadow flex items-center justify-between border border-gray-300 bg-opacity-50 border-opacity-50">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <p class="font-bold text-black text-xs group-hover:text-white dark:text-white text-opacity-40">
                                کنترل کیفیت
                            </p>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             class="w-5 h-5 text-gray-600 group-hover:text-gray-200 dark:text-white text-opacity-40">
                            <path fill-rule="evenodd"
                                  d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                </a>

                <a href="{{ route('contracts.invoices.index', $contract->id) }}"
                   class="p-2 rounded-2xl bg-gray-300 shadow flex items-center justify-between border border-gray-300 bg-opacity-50 border-opacity-50">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <p class="font-bold text-black text-xs group-hover:text-white dark:text-white text-opacity-40">
                                مدارک تایید شده
                            </p>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             class="w-5 h-5 text-gray-600 group-hover:text-gray-200 dark:text-white text-opacity-40">
                            <path fill-rule="evenodd"
                                  d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                </a>

                <a href="{{ route('contracts.invoices.index', $contract->id) }}"
                   class="p-2 rounded-2xl bg-gray-300 shadow flex items-center justify-between border border-gray-300 bg-opacity-50 border-opacity-50">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <p class="font-bold text-black text-xs group-hover:text-white dark:text-white text-opacity-40">
                                پایان ساخت
                            </p>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             class="w-5 h-5 text-gray-600 group-hover:text-gray-200 dark:text-white text-opacity-40">
                            <path fill-rule="evenodd"
                                  d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                </a>

                <a href="{{ route('contracts.invoices.index', $contract->id) }}"
                   class="p-2 rounded-2xl bg-gray-300 shadow flex items-center justify-between border border-gray-300 bg-opacity-50 border-opacity-50">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <p class="font-bold text-black text-xs group-hover:text-white dark:text-white text-opacity-40">
                                صدور پلاک و شماره سریال
                            </p>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             class="w-5 h-5 text-gray-600 group-hover:text-gray-200 dark:text-white text-opacity-40">
                            <path fill-rule="evenodd"
                                  d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                </a>

                @if(!$contract->packings->isEmpty())
                    <a href="{{ route('packings.index', $contract->id) }}"
                       class="p-2 rounded-2xl shadow flex items-center justify-between border border-gray-300 {{ $contract->packings->isEmpty() ? 'bg-opacity-50 border-opacity-50 bg-gray-300' : 'bg-green-400' }}">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5"/>
                            </svg>
                            <div class="mr-2">
                                <p class="font-bold text-black text-xs {{ $contract->packings->isEmpty() ? 'text-opacity-40' : '' }}">
                                    پکینگ لیست
                                </p>
                            </div>
                        </div>
                        <div>
                            @if($contract->packings->isEmpty())
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                     class="w-5 h-5 text-gray-600 text-opacity-40">
                                    <path fill-rule="evenodd"
                                          d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                          clip-rule="evenodd"/>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="currentColor" class="w-5 h-5 text-gray-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                                </svg>
                            @endif

                        </div>
                    </a>
                @endif

                <a href="{{ route('contracts.invoices.index', $contract->id) }}"
                   class="p-2 rounded-2xl bg-gray-300 shadow flex items-center justify-between border border-gray-300 bg-opacity-50 border-opacity-50">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <p class="font-bold text-black text-xs group-hover:text-white dark:text-white text-opacity-40">
                                مجوز خروج
                            </p>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             class="w-5 h-5 text-gray-600 group-hover:text-gray-200 dark:text-white text-opacity-40">
                            <path fill-rule="evenodd"
                                  d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                </a>

                <a href="{{ route('contracts.invoices.index', $contract->id) }}"
                   class="p-2 rounded-2xl bg-gray-300 shadow flex items-center justify-between border border-gray-300 bg-opacity-50 border-opacity-50">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <p class="font-bold text-black text-xs group-hover:text-white dark:text-white text-opacity-40">
                                بارگیری و حمل
                            </p>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             class="w-5 h-5 text-gray-600 group-hover:text-gray-200 dark:text-white text-opacity-40">
                            <path fill-rule="evenodd"
                                  d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                </a>

                <a href="{{ route('contracts.invoices.index', $contract->id) }}"
                   class="p-2 rounded-2xl bg-gray-300 shadow flex items-center justify-between border border-gray-300 bg-opacity-50 border-opacity-50">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <p class="font-bold text-black text-xs group-hover:text-white dark:text-white text-opacity-40">
                                آپلود تصاویر ساخت
                            </p>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             class="w-5 h-5 text-gray-600 group-hover:text-gray-200 dark:text-white text-opacity-40">
                            <path fill-rule="evenodd"
                                  d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                </a>
            </div>

            <div
                class="flex items-center justify-between mt-4 space-x-4 space-x-reverse p-2 rounded-md border border-yellow-400">
                <p class="text-xs font-bold text-black">وضعیت</p>
                <div class="w-full bg-gray-200 rounded-full">
                    <div class="bg-blue-600 text-xs font-medium text-white text-center p-0.5 leading-none rounded-full"
                         style="width: 15%">
                        15%
                    </div>
                </div>
            </div>
        </div>

        <div class="p-4 rounded-md shadow border border-indigo-400 bg-white">
            <div class="mb-4">
                <span class="px-6 py-1 rounded-md text-center bg-yellow-400 text-xs font-bold text-black">
                    مشتری
                </span>
            </div>
            <div class="grid grid-cols-6 gap-4">
                <a href="{{ route('contracts.invoices.index', $contract->id) }}"
                   class="p-2 rounded-2xl bg-gray-300 shadow flex items-center justify-between border border-gray-300 bg-opacity-50 border-opacity-50">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <p class="font-bold text-black text-xs group-hover:text-white dark:text-white text-opacity-40">
                                دیتاشیت نهایی
                            </p>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             class="w-5 h-5 text-gray-600 group-hover:text-gray-200 dark:text-white text-opacity-40">
                            <path fill-rule="evenodd"
                                  d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                </a>

                <a href="{{ route('contracts.invoices.index', $contract->id) }}"
                   class="p-2 rounded-2xl bg-gray-300 shadow flex items-center justify-between border border-gray-300 bg-opacity-50 border-opacity-50">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <p class="font-bold text-black text-xs group-hover:text-white dark:text-white text-opacity-40">
                                زمان شروع و پایان گارانتی
                            </p>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             class="w-5 h-5 text-gray-600 group-hover:text-gray-200 dark:text-white text-opacity-40">
                            <path fill-rule="evenodd"
                                  d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                </a>

                <a href="{{ route('contracts.invoices.index', $contract->id) }}"
                   class="p-2 rounded-2xl bg-gray-300 shadow flex items-center justify-between border border-gray-300 bg-opacity-50 border-opacity-50">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <p class="font-bold text-black text-xs group-hover:text-white dark:text-white text-opacity-40">
                                شرایط گارانتی
                            </p>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             class="w-5 h-5 text-gray-600 group-hover:text-gray-200 dark:text-white text-opacity-40">
                            <path fill-rule="evenodd"
                                  d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                </a>

                <a href="{{ route('contracts.invoices.index', $contract->id) }}"
                   class="p-2 rounded-2xl bg-gray-300 shadow flex items-center justify-between border border-gray-300 bg-opacity-50 border-opacity-50">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <p class="font-bold text-black text-xs group-hover:text-white dark:text-white text-opacity-40">
                                چک لیست های نصب
                            </p>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             class="w-5 h-5 text-gray-600 group-hover:text-gray-200 dark:text-white text-opacity-40">
                            <path fill-rule="evenodd"
                                  d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                </a>

                <a href="{{ route('contracts.invoices.index', $contract->id) }}"
                   class="p-2 rounded-2xl bg-gray-300 shadow flex items-center justify-between border border-gray-300 bg-opacity-50 border-opacity-50">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <p class="font-bold text-black text-xs group-hover:text-white dark:text-white text-opacity-40">
                                چک لیست های راه‌اندازی
                            </p>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             class="w-5 h-5 text-gray-600 group-hover:text-gray-200 dark:text-white text-opacity-40">
                            <path fill-rule="evenodd"
                                  d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                </a>

                <a href="{{ route('contracts.invoices.index', $contract->id) }}"
                   class="p-2 rounded-2xl bg-gray-300 shadow flex items-center justify-between border border-gray-300 bg-opacity-50 border-opacity-50">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <p class="font-bold text-black text-xs group-hover:text-white dark:text-white text-opacity-40">
                                چک لیست های بهره‌برداری
                            </p>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             class="w-5 h-5 text-gray-600 group-hover:text-gray-200 dark:text-white text-opacity-40">
                            <path fill-rule="evenodd"
                                  d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                </a>

                <a href="{{ route('contracts.invoices.index', $contract->id) }}"
                   class="p-2 rounded-2xl bg-gray-300 shadow flex items-center justify-between border border-gray-300 bg-opacity-50 border-opacity-50">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <p class="font-bold text-black text-xs group-hover:text-white dark:text-white text-opacity-40">
                                نامه های ارسال شده
                            </p>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             class="w-5 h-5 text-gray-600 group-hover:text-gray-200 dark:text-white text-opacity-40">
                            <path fill-rule="evenodd"
                                  d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                </a>

                <a href="{{ route('contracts.invoices.index', $contract->id) }}"
                   class="p-2 rounded-2xl bg-gray-300 shadow flex items-center justify-between border border-gray-300 bg-opacity-50 border-opacity-50">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <p class="font-bold text-black text-xs group-hover:text-white dark:text-white text-opacity-40">
                                نامه ها دریافت شده
                            </p>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             class="w-5 h-5 text-gray-600 group-hover:text-gray-200 dark:text-white text-opacity-40">
                            <path fill-rule="evenodd"
                                  d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                </a>
            </div>

            <div
                class="flex items-center justify-between mt-4 space-x-4 space-x-reverse p-2 rounded-md border border-yellow-400">
                <p class="text-xs font-bold text-black">وضعیت</p>
                <div class="w-full bg-gray-200 rounded-full">
                    <div class="bg-blue-600 text-xs font-medium text-white text-center p-0.5 leading-none rounded-full"
                         style="width: 90%">
                        90%
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
