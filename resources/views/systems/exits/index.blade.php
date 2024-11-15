<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script>
            function destroyExit(id) {
                if (confirm('خروج موقت حذف شود ؟')) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('exits.destroy') }}',
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
        <script>
            function submitPrint(id) {
                let value = document.getElementById('inputPrintType' + id).value;
                location.href = '/exits/' + id + '/print?type=' + value;
            }
        </script>
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
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg-active">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    خروج موقت کالاها
                </p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="flex items-center justify-between mt-8">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-6 h-6 dark:text-white">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <div class="mr-2 flex items-center space-x-4 space-x-reverse">
                <p class="font-bold text-lg text-black dark:text-white">
                    لیست همه خروج موقت کالا ها
                </p>
                @if(request()->has('search') || request()->has('status') || request()->has('qc'))
                    <a href="{{ route('exits.index') }}"
                       class="text-sm font-bold underline underline-offset-4 text-indigo-500">
                        پاکسازی فیلتر
                    </a>
                @endif
            </div>
        </div>
        <div class="flex items-center space-x-4 space-x-reverse">
            <a href="{{ route('exits.create') }}" class="page-success-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-5 h-5 ml-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                ایجاد خروج موقت
            </a>
        </div>
    </div>

    <!-- Search -->
    <form class="grid grid-cols-7 gap-4 my-4" id="search-form">
        <div class="flex rounded-md shadow-sm">
            <input type="text" name="search2" id="inputSearch" class="input-text"
                   placeholder="جستجو + اینتر" value="{{ request('search2') }}">
        </div>
        <div>
            <select name="accepted" id="inputAccepted" class="input-text">
                <option value="">انتخاب تاییدیه</option>
                <option value="1" {{ request('accepted') == '1' ? 'selected' : '' }}>
                    تایید شده ها
                </option>
                <option value="0" {{ request('accepted') == '0' ? 'selected' : '' }}>
                    تایید نشده ها
                </option>
            </select>
        </div>
        <div>
            <select name="coding" id="inputCoding" class="input-text">
                <option value="">انتخاب نوع اقلام</option>
                <option value="1" {{ request('code') == '0' ? 'selected' : '' }}>
                    منتظر عودت ها
                </option>
                <option value="2" {{ request('code') == '1' ? 'selected' : '' }}>
                    عودت شده ها
                </option>
                <option value="0" {{ request('code') == '1' ? 'selected' : '' }}>
                    بدون اقلام ها
                </option>
            </select>
        </div>
        <div>
            <select name="type" id="inputType" class="input-text">
                <option value="">انتخاب نوع خروج ها</option>
                <option value="personal" {{ request('type') == 'personal' ? 'selected' : '' }}>
                    استفاده شخصی (امانت)
                </option>
                <option value="mission" {{ request('type') == 'mission' ? 'selected' : '' }}>
                    ماموریت
                </option>
                <option value="example" {{ request('type') == 'example' ? 'selected' : '' }}>
                    ارسال نمونه
                </option>
                <option value="repair" {{ request('type') == 'repair' ? 'selected' : '' }}>
                    ارسال جهت تعمیر
                </option>
                <option value="other" {{ request('type') == 'other' ? 'selected' : '' }}>
                    سایر
                </option>
            </select>
        </div>
        <div>
            <button type="submit" class="flex items-center justify-center w-8 h-8 rounded-md bg-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                     stroke="currentColor" class="w-5 h-5 text-white">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                </svg>
            </button>
        </div>
    </form>

    <!-- Errors -->
    <div class="mb-4">
        <x-errors/>
    </div>

    <!-- Table -->
    <form method="POST" action="{{ route('exits.accepted') }}" class="overflow-x-auto rounded-lg">
        @csrf

        <table class="w-full border-collapse">
            <thead>
            <tr class="table-th-tr whitespace-normal">
                <th scope="col" class="p-2">
                    شماره سند
                </th>
                <th scope="col" class="p-2">
                    تاریخ خروج
                </th>
                <th scope="col" class="p-2">
                    نوع خروج
                </th>
                <th scope="col" class="p-2">
                    خارج کننده
                </th>
                <th scope="col" class="p-2">
                    شماره خودرو
                </th>
                <th scope="col" class="p-2">
                    تلفن و آدرس
                </th>
                <th scope="col" class="p-2">
                    محل ماموریت
                </th>
                <th scope="col" class="p-2">
                    علت ماموریت
                </th>
                <th scope="col" class="p-2">
                    اشخاص اعزامی
                </th>
                <th scope="col" class="p-2">
                    اقلام خروجی
                </th>
                <th scope="col" class="p-2">
                    عودت شده
                </th>
                <th scope="col" class="p-2">
                    منتظر عودت
                </th>
                <th scope="col" class="p-2">
                    تاییدیه
                </th>
                <th scope="col" class="p-2">
                    <span class="sr-only">
                        اقدامات
                    </span>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($exits as $exit)
                @php
                    $noReturn = $exit->codingExits()->select('quantity')->sum('quantity') - $exit->codingExits()->where('return_quantity', '>', 0)->sum('return_quantity');
                    $returned = $exit->codingExits()->where('return_quantity', '>', 0)->sum('return_quantity');

                    $color = '';

                    if ($noReturn > $returned) {
                        $color = 'bg-red-200';
                    }

                    if ($noReturn == 0) {
                        $color = 'bg-green-200';
                    }

                    if ($noReturn > 0 && $exit->confirm_quantity == '1') {
                        $color = 'bg-green-200';
                    }

                    if ($noReturn > 0 && $exit->confirm_quantity == '0') {
                        $color = 'bg-red-200';
                    }

                    if ($exit->codingExits->isEmpty()) {
                        $color = 'bg-yellow-200';
                    }
                @endphp
                <input type="hidden" name="exits[]" value="{{ $exit->id }}">

                <tr class="table-tb-tr whitespace-normal group {{ $color }}">
                    <td class="table-tr-td border-t-0">
                        {{ $exit->number }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0">
                        {{ jdate($exit->exit_at)->format('Y/m/d') }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0">
                        @switch($exit->type)
                            @case('mission')
                                ماموریت
                                @break
                            @case('personal')
                                استفاده شخصی (امانت)
                                @break
                            @case('example')
                                ارسال نمونه
                                @break
                            @case('repair')
                                ارسال جهت تعمیر
                                @break
                            @case('other')
                                سایر
                                @break
                        @endswitch
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0">
                        {{ $exit->exiter }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0">
                        {{ $exit->car_number }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0">
                        {{ $exit->phone }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0">
                        {{ $exit->mission_location ?? '-' }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0">
                        {{ $exit->mission_reason ?? '-' }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0">
                        {{ $exit->mission_users ?? '-' }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0">
                        @can('exit-codings')
                            <div class="flex justify-center">
                                <a href="{{ route('exit-coding.index', $exit->id) }}" class="table-dropdown-copy">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                    </svg>
                                    <p class="text-xs mr-1">
                                        اقلام خروجی
                                    </p>
                                </a>
                            </div>
                        @endcan
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0">
                        {{ $returned }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0">
                        {{ $noReturn }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0">
                        <select name="accepted[]" id="inputAccepted{{ $exit->id }}" class="input-text">
                            <option value="0" {{ $exit->accepted == '0' ? 'selected' : '' }}>
                                تایید نشده
                            </option>
                            <option value="1" {{ $exit->accepted == '1' ? 'selected' : '' }}>
                                تایید شده
                            </option>
                        </select>
                    </td>
                    <td class="table-tr-td border-t-0 border-r-0">
                        <div class="flex items-center justify-center space-x-2 space-x-reverse">
                            @if($exit->accepted)
                                <div x-data="{open : false}">
                                    <button @click="open = !open" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z"/>
                                        </svg>
                                    </button>

                                    <!-- Print Type Modal -->
                                    <div class="relative z-10" x-show="open" x-cloak>
                                        <div class="modal-backdrop"></div>
                                        <div class="fixed z-50 inset-0 overflow-y-auto">
                                            <div class="modal">
                                                <div class="modal-body bg-sky-200">
                                                    <div class="bg-sky-100 dark:bg-slate-800 p-4">
                                                        <div class="mb-4 flex justify-between items-center">
                                                            <div class="flex items-center space-x-4 space-x-reverse">
                                                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                                    انتخاب نوع پرینت
                                                                </h3>
                                                            </div>
                                                            <button type="button" @click="open = false">
                                                            <span class="modal-close">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                     viewBox="0 0 24 24"
                                                                     stroke-width="1.5" stroke="currentColor"
                                                                     class="w-5 h-5 dark:text-white">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                          d="M6 18L18 6M6 6l12 12"/>
                                                                </svg>
                                                            </span>
                                                            </button>
                                                        </div>
                                                        <div class="mt-6 space-y-4">
                                                            <div class="mb-4">
                                                                <label for="inputPrintType{{ $exit->id }}"
                                                                       class="form-label">
                                                                    انتخاب سایز پرینت
                                                                </label>
                                                                <select name="type" id="inputPrintType{{ $exit->id }}"
                                                                        class="input-text">
                                                                    <option value="">انتخاب کنید</option>
                                                                    <option value="a4">پرینت در سایز A4</option>
                                                                    <option value="a5">پرینت در سایز A5</option>
                                                                </select>
                                                            </div>
                                                            <div class="flex justify-end">
                                                                <button type="button" class="form-submit-btn"
                                                                        onclick="submitPrint({{ $exit->id }})">
                                                                    ثبت و ادامه
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @can('edit-exit')
                                <a href="{{ route('exits.edit', $exit->id) }}" class="table-dropdown-edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                    </svg>
                                </a>
                            @endcan
                            @can('delete-exit')
                                <button class="table-dropdown-delete" type="button"
                                        onclick="destroyExit({{ $exit->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                    </svg>
                                </button>
                            @endcan
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt-4 flex justify-end">
            <button type="submit" class="form-submit-btn">
                ثبت تاییدیه
            </button>
        </div>
    </form>

    <div class="mt-4">
        {{ $exits->links() }}
    </div>
</x-layout>
