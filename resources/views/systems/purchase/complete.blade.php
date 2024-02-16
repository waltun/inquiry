<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/date-picker/persianDatepicker.min.js') }}"></script>
        <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
        <script>
            $("#inputDocumentNumber").select2();
        </script>
        <script>
            $("#inputDate").persianDatepicker({
                formatDate: "YYYY-MM-DD",
            });

            $("#inputDateFactor").persianDatepicker({
                formatDate: "YYYY-MM-DD",
            });
        </script>
        <script>
            function submitForm() {
                let form = document.getElementById('search-form');
                form.submit();
            }
        </script>
        <script>
            function deleteStore(id) {
                if (confirm('آیتم لیست خرید حذف شود ؟')) {
                    if (confirm('آیا مطمئن هستید که آیتم لیست خرید حذف شود ؟')) {
                        if (confirm('لطفا حذف را تایید کنید!')) {
                            $.ajax({
                                url: '{{ route('purchase.destroy') }}',
                                type: 'DELETE',
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                data: {
                                    id: id,
                                },
                                success: function (res) {
                                    location.reload();
                                }
                            });
                        }
                    }
                }
            }
        </script>
        <script>
            function getCategory1() {
                let id = document.getElementById('inputCategory1').value;
                let section = document.getElementById('categorySection1');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('coding.category') }}',
                    data: {
                        id: id,
                    },
                    success: function (res) {
                        if (res.data != 'no-child') {
                            section.innerHTML = `
                            <select class="input-text" onchange="getCategory2()" id="inputCategory2" name="category2">
                                <option value="">انتخاب کنید</option>
                                    ${
                                res.data.map(function (category) {
                                    return `<option value="${category.id}">${category.code} - ${category.name}</option>`
                                })
                            }
                            </select>`
                        }
                        if (res.data == 'no-child') {
                            section.innerHTML = `
                                <p class="text-sm font-bold text-red-600 mt-3">زیردسته ای وجود ندارد!</p>
                            `
                        }
                    }
                });
            }

            function getCategory2() {
                let id = document.getElementById('inputCategory2').value;
                let section = document.getElementById('categorySection2');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('coding.category') }}',
                    data: {
                        id: id,
                    },
                    success: function (res) {
                        if (res.data != 'no-child') {
                            section.innerHTML = `
                            <select class="input-text" name="category3" id="inputCategory3" onchange="submitCategoryForm()">
                                <option value="">انتخاب کنید</option>
                                    ${
                                res.data.map(function (category) {
                                    return `<option value="${category.id}">${category.code} - ${category.name}</option>`
                                })
                            }
                            </select>`
                        }
                        if (res.data == 'no-child') {
                            section.innerHTML = `
                                <p class="text-sm font-bold text-red-600 mt-3">زیردسته ای وجود ندارد!</p>
                            `
                        }
                    }
                });
            }

            function submitCategoryForm() {
                let category1 = document.getElementById('inputCategory1');
                let category2 = document.getElementById('inputCategory2');
                let category3 = document.getElementById('inputCategory3');

                $.ajax({
                    url: '{{ route('purchase.searchCategory') }}',
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {
                        category1: category1.value,
                        category2: category2.value,
                        category3: category3.value,
                    },
                    success: function (res) {
                        let currentUrl = window.location.href;

                        let url = new URL(currentUrl);
                        url.searchParams.set('category1', res.category1);
                        url.searchParams.set('category2', res.category2);
                        url.searchParams.set('category3', res.category3);

                        window.location.href = url.href;
                    }
                });
            }

            function searchText() {
                let text = document.getElementById('inputSearch2');

                $.ajax({
                    url: '{{ route('purchase.searchText') }}',
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {
                        text: text.value,
                    },
                    success: function (res) {
                        let currentUrl = window.location.href;

                        let url = new URL(currentUrl);
                        url.searchParams.set('search', res.text);

                        window.location.href = url.href;
                    }
                });
            }
        </script>
    </x-slot>
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('plugins/date-picker/persianDatepicker-default.css') }}">
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
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg-active">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    لیست اقلام خریداری شده
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
                    لیست اقلام خریداری شده
                </p>
                @if(request()->has('search') || request()->has('status'))
                    <a href="{{ route('purchase.complete') }}"
                       class="text-sm font-bold underline underline-offset-4 text-indigo-500">
                        پاکسازی فیلتر
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Search -->
    <form class="grid grid-cols-4 gap-8 my-4" id="search-form">
        <div class="flex rounded-md shadow-sm">
            <input type="text" name="search2" id="inputSearch" class="input-text"
                   placeholder="جستجو + اینتر" value="{{ request('search2') }}">
        </div>
        <div>
            <select name="status" id="inputStatus" class="input-text" onchange="submitForm()">
                <option value="">انتخاب وضعیت</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                    در حال بررسی
                </option>
                <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>
                    تایید شده
                </option>
                <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>
                    رد شده
                </option>
                <option value="purchased" {{ request('status') == 'purchased' ? 'selected' : '' }}>
                    خریداری شده
                </option>
            </select>
        </div>
        <div>
            <select name="code" id="inputCode" class="input-text" onchange="submitForm()">
                <option value="">انتخاب کد</option>
                <option value="0" {{ request('code') == '0' ? 'selected' : '' }}>
                    اقلام بدون کد
                </option>
                <option value="1" {{ request('code') == '1' ? 'selected' : '' }}>
                    اقلام کد دار
                </option>
            </select>
        </div>
        <div>
            <select name="buy_location" id="inputBuyLocation" class="input-text" onchange="submitForm()">
                <option value="">انتخاب محل خرید</option>
                <option value="factory" {{ request('buy_location') == 'factory' ? 'selected' : '' }}>
                    کارخانه
                </option>
                <option value="office" {{ request('buy_location') == 'office' ? 'selected' : '' }}>
                    دفتر مرکزی
                </option>
            </select>
        </div>
    </form>

    <!-- Errors -->
    <div class="mb-4">
        <x-errors/>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto rounded-lg">
        <table class="w-full border-collapse">
            <thead>
            <tr class="table-th-tr whitespace-normal">
                <th scope="col" class="p-2">
                    #
                </th>
                <th scope="col" class="p-2">
                    شماره پرونده
                </th>
                <th scope="col" class="p-2">
                    تاریخ
                </th>
                <th scope="col" class="p-2">
                    کد کالا
                </th>
                <th scope="col" class="p-2">
                    شرح
                </th>
                <th scope="col" class="p-2">
                    تعداد درخواستی
                </th>
                <th scope="col" class="p-2">
                    وضعیت
                </th>
                <th scope="col" class="p-2">
                    تعداد تایید شده
                </th>
                <th scope="col" class="p-2">
                    واحد
                </th>
                <th scope="col" class="p-2">
                    درخواست کننده
                </th>
                <th scope="col" class="p-2">
                    محل خرید
                </th>
                <th scope="col" class="p-2">
                    توضیحات
                </th>
                <th scope="col" class="p-2">
                    <span class="sr-only">
                        اقدامات
                    </span>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($purchase as $purchas)
                <tr class="table-tb-tr whitespace-normal group bg-sky-200">
                    <td class="table-tr-td border-t-0">
                        {{ $loop->index + 1 }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0">
                        {{ $purchas->document_number ?? '-' }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0">
                        {{ jdate($purchas->date)->format('Y/m/d') }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0">
                        {{ !is_null($purchas->coding_id) ? $coding->code : '-' }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0">
                        {{ !is_null($purchas->coding_id) ? $coding->name : $purchas->title }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0">
                        {{ $purchas->request_quantity }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0">
                        @switch($purchas->status)
                            @case('pending')
                                در حال بررسی
                                @break
                            @case('accepted')
                                تایید شده
                                @break
                            @case('failed')
                                رد شده
                                @break
                            @case('purchased')
                                خریداری شده
                                @break
                        @endswitch
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0">
                        {{ $purchas->accepted_quantity }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0">
                        {{ !is_null($purchas->coding_id) ? $coding->unit : $purchas->unit }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0">
                        {{ $purchas->applicant }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0">
                        @if($purchas->buy_location == 'factory')
                            کارخانه
                        @else
                            دفتر مرکزی
                        @endif
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0">
                        {{ $purchas->description }}
                    </td>
                    <td class="table-tr-td border-t-0 border-r-0">
                        <div class="flex items-center justify-center space-x-2 space-x-reverse">
                            @can('add-to-store-purchase')
                                <button class="table-dropdown-copy" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M12 4.5v15m7.5-7.5h-15"/>
                                    </svg>
                                    <p class="text-xs mr-2">
                                        افزودن به اقلام ورودی
                                    </p>
                                </button>
                            @endcan
                            @can('delete-purchase')
                                <button class="table-dropdown-delete" type="button"
                                        onclick="deleteStore({{ $purchas->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                    </svg>
                                </button>
                            @endcan
                        </div>
                    </td>
                    <input type="hidden" name="purchase_ids[]" value="{{ $purchas->id }}" class="store-ids">
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt-4 flex items-center justify-end">
            @can('purchase')
                <a href="{{ route('purchase.index') }}" class="page-warning-btn">
                    لیست خرید اقلام
                </a>
            @endcan
        </div>
    </div>

    <div class="mt-4">
        {{ $purchase->links() }}
    </div>
</x-layout>
