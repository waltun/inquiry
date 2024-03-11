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
        <div class="flex items-center space-x-4 space-x-reverse">
            <a href="{{ route('contracts.marketings.create', $contract->id) }}" class="page-success-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                </svg>
                <span class="mr-2">ایجاد بازاریابی</span>
            </a>

            <a href="{{ route('contracts.guarantees.create', $contract->id) }}" class="page-success-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                </svg>
                <span class="mr-2">ایجاد تضمین</span>
            </a>

            <a href="{{ route('packings.create', $contract->id) }}" class="page-success-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                </svg>
                <span class="mr-2">ایجاد پکینگ</span>
            </a>
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
            <div class="grid grid-cols-6 gap-4">
                <a href="{{ route('contracts.invoices.index', $contract->id) }}"
                   class="p-2 rounded-2xl shadow flex items-center justify-between border border-gray-300 {{ $contract->invoices->isEmpty() ? 'bg-opacity-50 border-opacity-50 bg-gray-300' : 'bg-green-400' }}">
                    <div class="flex items-center">
                        <div class="mr-4">
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
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-5 h-5 text-gray-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                            </svg>
                        @endif
                    </div>
                </a>

                <a href="{{ route('contracts.invoices.index', $contract->id) }}"
                   class="p-2 rounded-2xl bg-gray-300 shadow flex items-center justify-between border border-gray-300 border-opacity-50 bg-opacity-50">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <p class="font-bold text-black text-xs text-opacity-40">
                                قرارداد
                            </p>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-5 h-5 text-gray-600 text-opacity-40">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                        </svg>
                    </div>
                </a>

                <a href="{{ route('contracts.invoices.index', $contract->id) }}"
                   class="p-2 rounded-2xl shadow flex items-center justify-between border border-gray-300 {{ is_null($contract->customer_id) ? 'bg-opacity-50 border-opacity-50 bg-gray-300' : 'bg-green-400' }}">
                    <div class="flex items-center">
                        <div class="mr-4">
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
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-5 h-5 text-gray-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                            </svg>
                        @endif

                    </div>
                </a>

                <a href="{{ route('contracts.invoices.index', $contract->id) }}"
                   class="p-2 rounded-2xl shadow flex items-center justify-between border border-gray-300 bg-gray-300 bg-opacity-50 border-opacity-50">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <p class="font-bold text-black text-xs text-opacity-40">
                                اطلاعات نمایندگان خریدار
                            </p>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             class="w-5 h-5 text-gray-600 text-opacity-40">
                            <path fill-rule="evenodd"
                                  d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                </a>

                <a href="{{ route('contracts.products', $contract->id) }}"
                   class="p-2 rounded-2xl shadow flex items-center justify-between border border-gray-300 {{ $contract->products->isEmpty() ? 'bg-opacity-50 border-opacity-50 bg-gray-300' : 'bg-green-400' }}">
                    <div class="flex items-center">
                        <div class="mr-4">
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
                        <div class="mr-4">
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
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-5 h-5 text-gray-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                            </svg>
                        @endif
                    </div>
                </a>
            </div>

            @php
                $saleCount = 6;
                $salePeice = 100 / 6;
            @endphp
            <div
                class="flex items-center justify-between mt-4 space-x-4 space-x-reverse p-2 rounded-md border border-yellow-400">
                <p class="text-xs font-bold text-black">وضعیت</p>
                <div class="w-full bg-gray-200 rounded-full">
                    <div class="bg-blue-600 text-xs font-medium text-white text-center p-0.5 leading-none rounded-full"
                         style="width: {{ $salePeice }}%">
                        {{ number_format($salePeice) }}%
                    </div>
                </div>
            </div>
        </div>

        <div class="p-4 rounded-md shadow border border-indigo-400 bg-white">
            <div class="mb-4">
                <span class="px-6 py-1 rounded-md text-center bg-yellow-400 text-xs font-bold text-black">
                    مالی
                </span>
            </div>
            <div class="grid grid-cols-6 gap-4">
                <a href="{{ route('contracts.invoices.index', $contract->id) }}"
                   class="p-2 rounded-2xl bg-gray-300 shadow flex items-center justify-between border border-gray-300 bg-opacity-50 border-opacity-50">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <p class="font-bold text-black text-xs group-hover:text-white dark:text-white text-opacity-40">
                                مبالغ قرارداد و آنالیز
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
                                پرداخت ها
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
                                تضامین
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
                                بازاریابی
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
                                اخذ کد اختصاصی
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
            <div class="mb-4">
                <span class="px-6 py-1 rounded-md text-center bg-yellow-400 text-xs font-bold text-black">
                    کارخانه
                </span>
            </div>
            <div class="grid grid-cols-6 gap-4">
                <a href="{{ route('contracts.invoices.index', $contract->id) }}"
                   class="p-2 rounded-2xl bg-gray-300 shadow flex items-center justify-between border border-gray-300 bg-opacity-50 border-opacity-50">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <p class="font-bold text-black text-xs group-hover:text-white dark:text-white text-opacity-40">
                                دستور ساخت
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

                <a href="{{ route('contracts.invoices.index', $contract->id) }}"
                   class="p-2 rounded-2xl bg-gray-300 shadow flex items-center justify-between border border-gray-300 bg-opacity-50 border-opacity-50">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <p class="font-bold text-black text-xs group-hover:text-white dark:text-white text-opacity-40">
                                پکینگ لیست
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
