<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>

        <script>
            function deletePayment(id) {
                if (confirm('پرداخت حذف شود ؟')) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('contracts.marketings.payments.destroy') }}',
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

    <!-- Navigation -->
    <div class="flex items-center justify-between mt-8">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-8 h-8 dark:text-white">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 110-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 01-1.44-4.282m3.102.069a18.03 18.03 0 01-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 018.835 2.535M10.34 6.66a23.847 23.847 0 008.835-2.535m0 0A23.74 23.74 0 0018.795 3m.38 1.125a23.91 23.91 0 011.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 001.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 010 3.46"/>
            </svg>
            <div class="mr-2">
                <p class="font-bold text-2xl text-black dark:text-white">
                    لیست پرداخت های بازاریاب {{ $marketing->marketer->name }}
                </p>
            </div>
        </div>
        <div class="flex items-center space-x-4 space-x-reverse">
            <a href="{{ route('contracts.marketings.payments.create', $marketing->id) }}" class="page-success-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-4 h-4 ml-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                ایجاد پرداخت بازاریابی
            </a>
            <a href="{{ route('contracts.marketings.index', $marketing->contract_id) }}"
               class="page-warning-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-4 h-4 ml-1">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15 15l6-6m0 0l-6-6m6 6H9a6 6 0 000 12h3"/>
                </svg>
                بازگشت
            </a>
        </div>
    </div>

    <!-- Content -->
    <div class="mt-4 space-y-4">
        <form method="POST" action="{{ route('contracts.marketings.payments.confirm', $marketing->id) }}"
              class="mt-8 overflow-x-auto rounded-lg">
            @csrf
            <table class="w-full border-collapse">
                <thead>
                <tr class="table-th-tr">
                    <th scope="col" class="p-4 rounded-tr-lg">
                        #
                    </th>
                    <th scope="col" class="p-4">
                        تاریخ
                    </th>
                    <th scope="col" class="p-4">
                        شرح
                    </th>
                    <th scope="col" class="p-4">
                        مبلغ (تومان)
                    </th>
                    <th scope="col" class="p-4">
                        حساب واریزی بازاریاب
                    </th>
                    <th scope="col" class="p-4">
                        نوع
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
                @foreach($marketing->payments as $payment)
                    <tr class="table-tb-tr group {{ $loop->even ? 'bg-sky-100' : '' }}">
                        <td class="table-tr-td border-t-0 border-l-0">
                            {{ $loop->index + 1 }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ $payment->date ? jdate($payment->date)->format('Y/m/d') : '-' }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ $payment->text ?? '-' }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ number_format($payment->price) }}
                        </td>
                        @php
                            $marketerAccount = \App\Models\MarketerAccount::find($payment->marketer_account_id);
                        @endphp
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ $marketerAccount->bank_name }} | {{ $marketerAccount->shaba_number }} - {{ $marketerAccount->account_name }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            @switch($payment->type)
                                @case('return')
                                    عودت
                                    @break
                                @default
                                    -
                                    @break
                            @endswitch
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            @if(auth()->user()->role == 'admin')
                                <input type="hidden" value="{{ $payment->id }}" name="payments[]">
                                <select name="confirms[]" id="inputConfirm{{ $payment->id }}" class="input-text">
                                    <option value="accepted" {{ $payment->confirm == 'accepted' ? 'selected' : '' }}>
                                        تایید شده از سمت مدیر
                                    </option>
                                    <option value="pending" {{ $payment->confirm == 'pending' ? 'selected' : '' }}>
                                        در انتظار تایید مدیر
                                    </option>
                                    <option value="done" {{ $payment->confirm == 'done' ? 'selected' : '' }}>
                                        پرداخت شده
                                    </option>
                                </select>
                            @else
                                @switch($payment->confirm)
                                    @case('pending')
                                        در انتظار تایید مدیر
                                        @break
                                    @case('accepted')
                                        تایید شده از سمت مدیر
                                        @break
                                    @case('done')
                                        پرداخت شده
                                        @break
                                @endswitch
                            @endif
                        </td>
                        <td class="table-tr-td border-t-0 border-r-0 whitespace-nowrap">
                            <div class="flex items-center justify-center space-x-4 space-x-reverse">
                                <a href="{{ route('contracts.marketings.payments.edit', $payment->id) }}"
                                   class="table-dropdown-edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                    </svg>
                                    ویرایش
                                </a>

                                <button class="table-delete-btn" type="button" onclick="deletePayment({{ $payment->id }})">
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

            <div class="mt-4 flex justify-between items-center">
                <div class="flex items-center justify-center space-x-4 space-x-reverse">
                    <a href="{{ route('marketings.index') }}" class="page-info-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-4 h-4 ml-1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"></path>
                        </svg>
                        همه بازاریابی ها
                    </a>
                </div>
                @if(!$marketing->payments->isEmpty() && auth()->user()->role == 'admin')
                    <button type="submit" class="page-success-btn">
                        ثبت تاییدیه
                    </button>
                @endif
            </div>
        </form>
    </div>

    @php
        $sumPayment = 0;
        $acceptedPayment = 0;

        foreach ($marketing->payments()->where('confirm', 'done')->where('date', '!=', null)->get() as $marketPayment) {
            if ($marketPayment->type == 'return') {
                $sumPayment -= $marketPayment->price;
            } else {
                $sumPayment += $marketPayment->price;
            }
        }

        foreach ($marketing->payments()->where('confirm', 'accepted')->where('date', '!=', null)->get() as $marketPayment) {
            if ($marketPayment->type == 'return') {
                $acceptedPayment -= $marketPayment->price;
            } else {
                $acceptedPayment += $marketPayment->price;
            }
        }

        $leftPrice = $marketing->price - $sumPayment;
    @endphp

    <div class="mt-8 grid grid-cols-4 gap-4">
        <div class="p-4 rounded-lg shadow bg-indigo-500">
            <p class="text-base text-white text-center font-bold">
                مبلغ کل بازاریابی : {{ number_format($marketing->price) }} تومان
            </p>
        </div>
        <div class="p-4 rounded-lg shadow bg-green-500">
            <p class="text-base text-white text-center font-bold">
                مجموع پرداخت ها
                : {{ number_format($sumPayment) }}
                تومان
            </p>
        </div>
        <div class="p-4 rounded-lg shadow bg-red-500">
            <p class="text-base text-white text-center font-bold">
                مانده حساب : {{ number_format($leftPrice) }} تومان
            </p>
        </div>
        <div class="p-4 rounded-lg shadow bg-yellow-500">
            <p class="text-base text-white text-center font-bold">
                مجموع درخواست ها
                : {{ number_format($acceptedPayment) }}
                تومان
            </p>
        </div>
    </div>

    <div class="mt-4 space-y-4">
        <p class="text-sm font-bold text-red-600">
            * برای محاسبه پرداخت‌ها و مانده حساب (تایید نهایی)، علاوه بر تاییدیه مدیر، تاریخ واریزی (توسط مدیر مالی) هم
            باید ثبت شود.
        </p>
    </div>
</x-layout>
