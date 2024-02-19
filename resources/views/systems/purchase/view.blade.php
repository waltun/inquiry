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
                                success: function () {
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
                    لیست اقلامی که باید خریداری شوند
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
                    لیست اقلامی که باید خریداری شوند
                </p>
                @if(request()->has('search') || request()->has('buy_location'))
                    <a href="{{ route('purchase.view') }}"
                       class="text-sm font-bold underline underline-offset-4 text-indigo-500">
                        پاکسازی فیلتر
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Errors -->
    <div class="mb-4">
        <x-errors/>
    </div>

    <!-- Desktop Table -->
    <div class="overflow-x-auto rounded-lg hidden md:block">
        <table class="w-full border-collapse">
            <thead>
            <tr class="table-th-tr whitespace-normal">
                <th scope="col" class="p-2">
                    #
                </th>
                <th scope="col" class="p-2">
                    تاریخ
                </th>
                <th scope="col" class="p-2">
                    شرح
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
                    محل خرید
                </th>
                <th scope="col" class="p-2">
                    توضیحات
                </th>
                <th scope="col" class="p-2">
                    خرید
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($purchase as $purchas)
                @php
                    if (!is_null($purchas->coding_id)) {
                        $coding = \App\Models\System\Coding::find($purchas->coding_id);
                    }
                @endphp
                <tr class="table-tb-tr whitespace-normal group bg-green-200">
                    <td class="table-tr-td border-t-0">
                        {{ $loop->index + 1 }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0">
                        {{ jdate($purchas->date)->format('Y/m/d') }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0">
                        {{ !is_null($purchas->coding_id) ? $coding->name : $purchas->title }}
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
                        <div class="flex items-center justify-center">
                            <form action="{{ route('purchase.purchased', $purchas->id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <button type="submit" class="table-success-btn"
                                        onclick="return confirm('اقلام خریداری شد ؟')">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                                    </svg>
                                    خریداری شد
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Mobile -->
    <div class="mt-4 space-y-1">
        @foreach($purchase as $purchas)
            @php
                if (!is_null($purchas->coding_id)) {
                    $coding = \App\Models\System\Coding::find($purchas->coding_id);
                }
            @endphp
            <div class="{{ $purchas->important ? 'bg-red-200' : 'bg-green-200' }} rounded-lg shadow border border-myBlue-100 p-1 relative block md:hidden">
                <div class="absolute w-8 h-8 rounded-full bg-sky-200 top-4 right-4 grid place-content-center">
                    <p class="text-sm font-medium">
                        {{ $loop->index + 1 }}
                    </p>
                </div>
                <div>
                    <div class="flex items-center justify-between">
                        <p class="text-xs font-medium text-center mr-10">
                            {{ jdate($purchas->date)->format('Y/m/d') }}
                        </p>
                        <form action="{{ route('purchase.purchased', $purchas->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <button type="submit" class="page-info-btn p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                                </svg>
                                خریده شد
                            </button>
                        </form>
                    </div>
                    <p class="text-xs font-medium text-center">
                        کالا : {{ !is_null($purchas->coding_id) ? $coding->name : $purchas->title }}
                    </p>
                    <p class="text-xs font-medium text-center">
                        تعداد تایید شده
                        : {{ $purchas->accepted_quantity }} {{ !is_null($purchas->coding_id) ? $coding->unit : $purchas->unit }}
                    </p>
                    @if($purchas->description)
                        <p class="text-xs font-medium text-center">
                            توضیحات : {{ $purchas->description }}
                        </p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $purchase->links() }}
    </div>
</x-layout>
