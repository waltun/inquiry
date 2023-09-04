<x-layout>
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
                     stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                <span class="mr-2">ایجاد پرداخت بازاریابی</span>
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
                            {{ jdate($payment->date)->format('Y/m/d') }}
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
                            {{ $marketerAccount->bank_name }} | {{ $marketerAccount->shaba_number }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            <input type="hidden" value="{{ $payment->id }}" name="payments[]">
                            <select name="confirms[]" id="inputConfirm{{ $payment->id }}" class="input-text">
                                <option value="1" {{ $payment->confirm ? 'selected' : '' }}>
                                    تایید
                                </option>
                                <option value="0" {{ !$payment->confirm ? 'selected' : '' }}>
                                    عدم تایید
                                </option>
                            </select>
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

                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="mt-4 flex justify-between items-center">
                <a href="{{ route('contracts.marketings.index', $marketing->contract_id) }}" class="page-warning-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-4 h-4 ml-1">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15 15l6-6m0 0l-6-6m6 6H9a6 6 0 000 12h3"/>
                    </svg>
                    بازگشت
                </a>
                @if(!$marketing->payments->isEmpty())
                    <button type="submit" class="form-submit-btn">
                        ثبت تاییدیه
                    </button>
                @endif
            </div>
        </form>
    </div>

    @php
        $leftPrice = $marketing->price - $marketing->payments->sum('price');
    @endphp

    <div class="mt-8 grid grid-cols-3 gap-4">
        <div class="p-4 rounded-lg shadow bg-indigo-500">
            <p class="text-base text-white text-center font-bold">
                مبلغ کل بازاریابی : {{ number_format($marketing->price) }} تومان
            </p>
        </div>
        <div class="p-4 rounded-lg shadow bg-green-500">
            <p class="text-base text-white text-center font-bold">
                مجموع پرداخت ها : {{ number_format($marketing->payments->sum('price')) }} تومان
            </p>
        </div>
        <div class="p-4 rounded-lg shadow bg-red-500">
            <p class="text-base text-white text-center font-bold">
                مانده حساب : {{ number_format($leftPrice) }} تومان
            </p>
        </div>
    </div>
</x-layout>
