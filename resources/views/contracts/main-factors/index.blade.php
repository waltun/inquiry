<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script>
            function destroyFactor(id) {
                if (confirm('فاکتور حذف شود ؟')) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('contracts.main-factors.destroy') }}',
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
                    مدیریت فاکتور های قیمت {{ $contract->name }}
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
                    لیست فاکتور های قیمت قرارداد {{ $contract->name }}
                </p>
            </div>
        </div>
        <div class="flex items-center space-x-4 space-x-reverse">
            <a href="{{ route('main-factors.create', $contract->id) }}" class="page-success-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-4 h-4 ml-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                ایجاد فاکتور قیمت جدید
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
        <form method="POST" action="{{ route('contracts.main-factors.confirm', $contract->id) }}" class="mt-8 overflow-x-auto rounded-lg">
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
                        شماره
                    </th>
                    <th scope="col" class="p-4">
                        ایجاد کننده
                    </th>
                    <th scope="col" class="p-4">
                        قیمت کل فاکتور (تومان)
                    </th>
                    <th scope="col" class="p-4">
                        ارزش افزوده (تومان)
                    </th>
                    <th scope="col" class="p-4">
                        قیمت کل بدون ارزش افزوده (تومان)
                    </th>
                    <th scope="col" class="p-4">
                        درصد ارزش افزوده
                    </th>
                    <th scope="col" class="p-4">
                        فایل
                    </th>
                    <th scope="col" class="p-4">
                        محصولات
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
                @php
                    $totalPrice = 0;
                    $totalTaxPrice = 0;
                @endphp
                @foreach($factors as $factor)
                    @php
                        $price = 0;
                        $tax = 0;
                        $taxItem = 0;
                        if (!$factor->contractProducts->isEmpty()) {
                            foreach ($factor->contractProducts as $product) {
                            $taxItem = \App\Models\Tax::where('year', jdate($factor->date)->getYear())->first();
                            $price += $product->price * $product->pivot->quantity;
                        }
                            $tax = $price * $taxItem->rate / 100.0;
                            $totalTaxPrice += $tax;

                            $totalPrice += $price + $tax;
                        }
                    @endphp
                    <tr class="table-tb-tr group {{ $loop->even ? 'bg-sky-100' : '' }}">
                        <td class="table-tr-td border-t-0 border-l-0">
                            {{ $loop->index + 1 }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ jdate($factor->date)->format('Y/m/d') }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ $factor->number }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ $factor->user->name }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ number_format($price + $tax) }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ number_format($tax) }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ number_format($price) }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ $taxItem ? $taxItem->rate : '0' }}%
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            @if($factor->file)
                                @php
                                    $extension = explode('.',$factor->file);
                                @endphp
                                @if($extension[1] == 'pdf' || $extension[1] == 'docx' || $extension[1] == 'doc')
                                    <div class="flex items-center justify-center">
                                        <a href="{{ $factor->file }}" class="table-dropdown-copy" download>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                                            </svg>
                                            دانلود فایل
                                        </a>
                                    </div>
                                @elseif($extension[1] == 'jpg' || $extension[1] == 'png' || $extension[1] == 'jpeg')
                                    <img src="{{ $factor->file }}" alt="" class="w-10 h-10 rounded-md mx-auto border border-gray-200 cursor-pointer"
                                         onclick="this.requestFullscreen()">
                                @else
                                    <div class="flex justify-center items-center">
                                        <a href="{{ $factor->file }}" class="table-dropdown-copy" download>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                                            </svg>
                                            دانلود فایل
                                        </a>
                                    </div>
                                @endif
                            @else
                                -
                            @endif
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            <div class="flex items-center justify-center">
                                <a href="{{ route('contracts.main-factors.products.index', [$contract->id, $factor->id]) }}" class="table-warning-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                    </svg>
                                    مشاهده
                                </a>
                            </div>
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            @if(auth()->user()->role == 'admin')
                                <input type="hidden" value="{{ $factor->id }}" name="factors[]">
                                <select name="confirms[]" id="inputConfirm{{ $factor->id }}" class="input-text">
                                    <option value="1" {{ $factor->confirm ? 'selected' : '' }}>
                                        تایید
                                    </option>
                                    <option value="0" {{ !$factor->confirm ? 'selected' : '' }}>
                                        عدم تایید
                                    </option>
                                </select>
                            @else
                                {{ $factor->confirm ? 'تایید شده' : 'تایید نشده' }}
                            @endif
                        </td>
                        <td class="table-tr-td border-t-0 border-r-0 whitespace-nowrap">
                            <div class="flex items-center justify-center space-x-4 space-x-reverse">
                                <a href="{{ route('main-factors.edit',[$contract->id, $factor->id]) }}"
                                   class="table-dropdown-edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                    </svg>
                                    ویرایش
                                </a>

                                <button type="button" onclick="destroyFactor({{ $factor->id }})" class="table-delete-btn">
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
                <a href="{{ route('all-factors.index') }}" class="page-warning-btn">
                    مشاهده همه فاکتور ها
                </a>
                <button class="form-submit-btn">
                    ثبت تاییدیه
                </button>
            </div>

            <div class="mt-8 grid grid-cols-3 gap-4 mb-6">
                <div>
                    <div class="bg-green-500 p-4 rounded-t-lg">
                        <p class="text-sm font-bold text-white text-center">
                            قیمت کل فاکتور ها (با ارزش افزوده)
                        </p>
                    </div>
                    <div class="bg-white p-4 rounded-b-lg shadow">
                        <p class="font-bold text-black text-center">
                            {{ number_format($totalPrice) }} تومان
                        </p>
                    </div>
                </div>

                <div>
                    <div class="bg-gray-500 p-4 rounded-t-lg">
                        <p class="text-sm font-bold text-white text-center">
                            مبلغ ارزش افزوده
                        </p>
                    </div>
                    <div class="bg-white p-4 rounded-b-lg shadow">
                        <p class="font-bold text-black text-center">
                            {{ number_format($totalTaxPrice) }} تومان
                        </p>
                    </div>
                </div>

                <div>
                    <div class="bg-indigo-500 p-4 rounded-t-lg">
                        <p class="text-sm font-bold text-white text-center">
                            مبلغ فاکتور ها (بدون ارزش افزوده)
                        </p>
                    </div>
                    <div class="bg-white p-4 rounded-b-lg shadow">
                        <p class="font-bold text-black text-center">
                            {{ number_format($totalPrice - $totalTaxPrice) }} تومان
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-layout>
