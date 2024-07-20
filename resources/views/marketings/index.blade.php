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
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg-active">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    مدیریت همه بازاریابی ها
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
                      d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/>
            </svg>
            <div class="mr-2">
                <p class="font-bold text-2xl text-black dark:text-white">
                    لیست همه بازاریابی ها
                </p>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="mt-4 space-y-4">
        <div class="mt-8 overflow-x-auto rounded-lg hidden md:block">
            <table class="w-full border-collapse">
                <thead>
                <tr class="table-th-tr">
                    <th scope="col" class="p-4 rounded-tr-lg">
                        شماره قرارداد
                    </th>
                    <th scope="col" class="p-4">
                        نام پروژه
                    </th>
                    <th scope="col" class="p-4">
                        مسئول پروژه
                    </th>
                    <th scope="col" class="p-4">
                        نام خریدار
                    </th>
                    <th scope="col" class="p-4">
                        مبلغ کل (تومان)
                    </th>
                    <th scope="col" class="p-4">
                        پرداخت ها (تومان)
                    </th>
                    <th scope="col" class="p-4">
                        مانده حساب (تومان)
                    </th>
                    <th scope="col" class="p-4">
                        درخواست ها (تومان)
                    </th>
                    <th scope="col" class="p-4 rounded-tl-lg">
                        <span class="sr-only">اقدامات</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                @php
                    $paymentPrice = 0;
                @endphp
                @foreach($marketings as $marketing)
                    @php
                        //$paymentPrice += $marketing->payments()->where('confirm', 'done')->where('date', '!=', null)->sum('price');

                        $price = 0;
                        foreach ($marketing->payments()->where('confirm', 'done')->where('date', '!=', null)->get() as $payment) {
                            if ($payment->type == 'return') {
                                $price -= $payment->price;
                                $paymentPrice -= $payment->price;
                            } else {
                                $price += $payment->price;
                                $paymentPrice += $payment->price;
                            }
                        }

                        $leftPriceMarketing = $marketing->price - $price;
                    @endphp
                    <tr class="table-tb-tr group {{ $loop->even ? 'bg-sky-100' : '' }}">
                        <td class="table-tr-td border-t-0 border-l-0">
                            {{ $marketing->contract->number ? "CNT-" . $marketing->contract->number : 'در حال انجام' }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ $marketing->contract->name }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ $marketing->contract->user->name }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ $marketing->contract->customer->name }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            <p class="text-green-600">
                                {{ number_format($marketing->price) }}
                            </p>
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            <p class="text-green-600">
                                {{ number_format($price) }}
                            </p>
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            <p class="text-red-600">
                                {{ number_format($leftPriceMarketing) }}
                            </p>
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            <p class="text-green-600">
                                {{ number_format($marketing->payments()->where('confirm', 'accepted')->where('date', '!=', null)->sum('price')) }}
                            </p>
                        </td>
                        <td class="table-tr-td border-t-0 border-r-0">
                            <div class="flex items-center justify-center space-x-4 space-x-reverse">
                                <a href="{{ route('contracts.marketings.payments.index', $marketing->id) }}"
                                   class="table-dropdown-copy">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    جزئیات
                                </a>

                                @if($marketing->payments->isEmpty())
                                    <p class="p-1 rounded-lg bg-red-500 text-white shadow-sm">
                                        منتظر ثبت درخواست
                                    </p>
                                @elseif(count($marketing->payments()->where('confirm', 'pending')->get()) > 0)
                                    <p class="p-1 rounded-lg bg-red-500 text-white shadow-sm">
                                        در انتظار تایید مدیر
                                    </p>
                                @elseif(count($marketing->payments()->where('confirm', 'accepted')->get()) > 0)
                                    <p class="p-1 rounded-lg bg-yellow-500 text-white shadow-sm">
                                        تایید شده - منتظر پرداخت
                                    </p>
                                @elseif(count($marketing->payments()->where('confirm', 'done')->where('date', '!=', null)->get()) > 0)
                                    <p class="py-1 px-2 rounded-lg bg-green-500 text-white shadow-sm">
                                        پرداخت شده
                                    </p>
                                @endif
                                @if(count($marketing->payments()->where('confirm', 1)->where('date', null)->get()) > 0)
                                    <p class="p-1 rounded-lg bg-red-500 text-white shadow-sm">
                                        منتظر ثبت تاریخ
                                    </p>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $marketings->links() }}
        </div>
    </div>

    <div class="mt-8 grid grid-cols-3 gap-4">
        <div class="p-4 rounded-lg shadow bg-indigo-500">
            <p class="text-base text-white text-center font-bold">
                مبلغ کل بازاریابی‌ها : {{ number_format($marketings->sum('price')) }} تومان
            </p>
        </div>
        <div class="p-4 rounded-lg shadow bg-green-500">
            <p class="text-base text-white text-center font-bold">
                مجموع همه پرداخت‌ها : {{ number_format($paymentPrice) }} تومان
            </p>
        </div>
        <div class="p-4 rounded-lg shadow bg-red-500">
            <p class="text-base text-white text-center font-bold">
                مانده همه حساب‌ها : {{ number_format($marketings->sum('price') - $paymentPrice) }} تومان
            </p>
        </div>
    </div>
</x-layout>
