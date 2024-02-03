<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
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
                let form = document.getElementById('category-search');

                form.submit();
            }

            function getCategoryCreate1() {
                let id = document.getElementById('inputCategoryCreate1').value;
                let section = document.getElementById('categorySectionCreate1');

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
                            <label for="inputCategoryCreate2" class="form-label">دسته اصلی</label>
                            <select class="input-text" onchange="getCategoryCreate2()" id="inputCategoryCreate2" name="categories[]">
                                <option value="">انتخاب کنید</option>
                                    ${
                                res.data.map(function (category) {
                                    return `<option value="${category.id}">${category.name}</option>`
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

            function getCategoryCreate2() {
                let id = document.getElementById('inputCategoryCreate2').value;
                let section = document.getElementById('categorySectionCreate2');

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
                            <label for="inputCategoryCreate3" class="form-label">دسته فرعی</label>
                            <select class="input-text" name="categories[]" id="inputCategoryCreate3">
                                <option value="">انتخاب کنید</option>
                                    ${
                                res.data.map(function (category) {
                                    return `<option value="${category.id}">${category.name}</option>`
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
        </script>
    </x-slot>

    <!-- Breadcrumb -->
    <div class="breadcrumb">
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
                      d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    لیست کدینگ ها
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
                      d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
            </svg>
            <div class="mr-2 flex items-center space-x-4 space-x-reverse">
                <p class="font-bold text-lg text-black dark:text-white">
                    لیست کدینگ ها
                </p>
                @if(request()->has('sort') || request()->has('category1') || request()->has('category2') || request()->has('category3') || request()->has('search'))
                    <a href="{{ route('coding.index') }}" class="text-sm font-bold text-indigo-500 underline">
                        پاکسازی فیلتر
                    </a>
                @endif
            </div>
        </div>

        @can('export-coding')
            <div>
                <a href="{{ route('coding.exportPage') }}" class="page-success-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-5 h-5 ml-1">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                    </svg>
                    دریافت خروجی اکسل
                </a>
            </div>
        @endcan
    </div>

    <!-- Search -->
    <div class="mt-4">
        <div class="grid grid-cols-4 gap-8">
            <form class="col-span-1">
                    <input type="text" name="search" id="inputSearch" class="input-text"
                           placeholder="جستجو + اینتر" value="{{ request('search') }}">
            </form>
            <form class="col-span-3 grid grid-cols-3 gap-4" id="category-search">
                <div>
                    <select name="category1" id="inputCategory1" class="input-text" onchange="getCategory1()">
                        <option value="">انتخاب کنید</option>
                        @foreach($categories as $category)
                            <option
                                value="{{ $category->id }}" {{ request('category1') == $category->id ? 'selected' : '' }}>
                                {{ $category->code }} - {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div id="categorySection1">
                    @if(request()->has('category2'))
                        @php
                            $category2 = \App\Models\System\SystemCategory::find(request('category1'))->children;
                        @endphp
                        <select name="category2" id="inputCategory2" class="input-text" onchange="getCategory2()">
                            <option value="">انتخاب کنید</option>
                            @foreach($category2 as $category)
                                <option
                                    value="{{ $category->id }}" {{ request('category2') == $category->id ? 'selected' : '' }}>
                                    {{ $category->code }} - {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    @endif
                </div>
                <div id="categorySection2">
                    @if(request()->has('category3'))
                        @php
                            $category3 = \App\Models\System\SystemCategory::find(request('category2'))->children;
                        @endphp
                        <select name="category3" id="inputCategory3" class="input-text" onchange="submitCategoryForm()">
                            <option value="">انتخاب کنید</option>
                            @foreach($category3 as $category)
                                <option
                                    value="{{ $category->id }}" {{ request('category3') == $category->id ? 'selected' : '' }}>
                                    {{ $category->code }} - {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Errors -->
    <div class="mb-4">
        <x-errors/>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto rounded-lg">
        <table class="w-full border-collapse">
            <thead>
            <tr class="table-th-tr">
                <th scope="col" class="p-2 rounded-tr-lg">
                    #
                </th>
                @php
                    if (request()->has('search') || request()->has('category1') || request()->has('category2') || request()->has('category3')) {
                        $codeUrl = url()->full() . "&sort=code";
                        $nameUrl = url()->full() . "&sort=name";
                    } else {
                        $codeUrl = url()->full() . "?sort=code";
                        $nameUrl = url()->full() . "?sort=name";
                    }
                @endphp
                <th scope="col" class="p-2">
                    <div class="flex items-center justify-center">
                        کد
                        <a href="{{ $codeUrl }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-5 h-5 mr-2 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5"/>
                            </svg>
                        </a>
                    </div>
                </th>
                <th scope="col" class="p-2">
                    <div class="flex items-center justify-center">
                        نام
                        <a href="{{ $nameUrl }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-5 h-5 mr-2 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5"/>
                            </svg>
                        </a>
                    </div>
                </th>
                <th scope="col" class="p-2">
                    واحد
                </th>
                <th scope="col" class="p-2">
                    انبار مربوطه
                </th>
                <th scope="col" class="p-2">
                    تاریخ ایجاد
                </th>
                <th scope="col" class="p-2 rounded-tl-lg">
                    اقدامات
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($codings as $coding)
                <tr class="table-tb-tr group {{ $coding->copy == '1' ? 'bg-sky-200' : '' }} {{ $loop->even ? 'bg-sky-100' : '' }}">
                    <td class="table-tr-td border-t-0">
                        {{ $loop->index + 1 }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0 text-red-600 text-right">
                        {{ $coding->code }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0 text-right">
                        {{ $coding->name }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0">
                        {{ $coding->unit }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0">
                        {{ $coding->store }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0">
                        @if(!is_null($coding->created_at))
                            {{ jdate($coding->created_at)->format('%A, %d %B %Y') }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="table-tr-td border-t-0 border-r-0">
                        <div class="flex items-center justify-center space-x-4 space-x-reverse">
                            @can('edit-coding')
                                <div x-data="{open:false}">
                                    <button type="button" class="table-dropdown-edit" @click="open = !open">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                        </svg>
                                        ویرایش
                                    </button>

                                    <!-- Edit Coding Modal -->
                                    <div class="relative z-10" x-show="open" x-cloak>
                                        <div class="modal-backdrop"></div>
                                        <div class="fixed z-10 inset-0 overflow-y-auto">
                                            <div class="modal">
                                                <div class="modal-body">
                                                    <div class="bg-white dark:bg-slate-800 p-4">
                                                        <div class="mb-4 flex justify-between items-center">
                                                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                                ویرایش کدینگ {{ $coding->name }}
                                                            </h3>
                                                            <button type="button" @click="open = false">
                                                                <span class="modal-close">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                         viewBox="0 0 24 24"
                                                                         stroke-width="1.5" stroke="currentColor"
                                                                         class="w-5 h-5 dark:text-white">
                                                                        <path stroke-linecap="round"
                                                                              stroke-linejoin="round"
                                                                              d="M6 18L18 6M6 6l12 12"/>
                                                                    </svg>
                                                                </span>
                                                            </button>
                                                        </div>
                                                        <form method="POST"
                                                              action="{{ route('coding.update',$coding->id) }}"
                                                              class="mt-6 space-y-4">
                                                            @csrf
                                                            @method('PATCH')
                                                            <div class="mb-4 grid grid-cols-12 gap-4 items-center">
                                                                <div class="col-span-2">
                                                                    <label for="inputName" class="form-label">
                                                                        <span class="font-bold text-red-600">* </span>نام
                                                                        :
                                                                    </label>
                                                                </div>
                                                                <div class="col-span-10">
                                                                    <input type="text" name="name" id="inputName"
                                                                           class="input-text"
                                                                           placeholder="نام محصول/قطعه"
                                                                           value="{{ $coding->name }}">
                                                                </div>
                                                            </div>

                                                            <div class="mb-4 grid grid-cols-12 gap-4 items-center">
                                                                <div class="col-span-2">
                                                                    <label for="inputUnit" class="form-label">
                                                                        <span class="font-bold text-red-600">* </span>واحد
                                                                        :
                                                                    </label>
                                                                </div>
                                                                <div class="col-span-10">
                                                                    <input type="text" name="unit" id="inputUnit"
                                                                           class="input-text"
                                                                           placeholder="واحد محصول/قطعه"
                                                                           value="{{ $coding->unit }}">
                                                                </div>
                                                            </div>

                                                            <div class="mb-4 grid grid-cols-12 gap-4 items-center">
                                                                <div class="col-span-2">
                                                                    <label for="inputStore" class="form-label">
                                                                        <span class="font-bold text-red-600">* </span>
                                                                        انبار مرتبط :
                                                                    </label>
                                                                </div>
                                                                <div class="col-span-10">
                                                                    <select name="store" id="inputStore"
                                                                            class="input-text">
                                                                        <option value="">انتخاب کنید</option>
                                                                        <option
                                                                            value="10" {{ $coding->store == '10' ? 'selected' : '' }}>
                                                                            انبار مواد اولیه | 10
                                                                        </option>
                                                                        <option
                                                                            value="12" {{ $coding->store == '12' ? 'selected' : '' }}>
                                                                            انبار ملزومات | 12
                                                                        </option>
                                                                        <option
                                                                            value="14" {{ $coding->store == '14' ? 'selected' : '' }}>
                                                                            انبار محصولات | 14
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="mb-4 grid grid-cols-12 gap-4 items-center">
                                                                <div class="col-span-2">
                                                                    <label for="inputCode" class="form-label">
                                                                        <span class="font-bold text-red-600">* </span>کدینگ
                                                                        :
                                                                    </label>
                                                                </div>
                                                                <div class="col-span-10">
                                                                    <input type="text" name="code" id="inputCode"
                                                                           class="input-text"
                                                                           placeholder="کدینگ محصول/قطعه"
                                                                           value="{{ $coding->code }}">
                                                                </div>
                                                            </div>

                                                            <div
                                                                class="flex justify-end items-center space-x-4 space-x-reverse">
                                                                <button type="button" class="form-cancel-btn"
                                                                        @click="open = false">
                                                                    انصراف
                                                                </button>
                                                                <button type="submit" class="form-edit-btn">
                                                                    بروزرسانی کدینگ
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan

                            @canany(['copy-coding','delete-coding'])
                                <div class="flex items-center justify-center space-x-4 space-x-reverse relative mr-2" x-data="{open:false}">
                                    <button @click="open = !open">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/>
                                        </svg>
                                    </button>
                                    <div x-show="open" @click.away="open = false" x-cloak
                                         class="table-dropdown -top-12 -right-24">
                                        @can('copy-coding')
                                            <form action="{{ route('coding.replicate',$coding->id) }}" method="POST"
                                                  class="table-dropdown-copy">
                                                @csrf
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5A3.375 3.375 0 006.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0015 2.25h-1.5a2.251 2.251 0 00-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 00-9-9z"/>
                                                </svg>
                                                <button onclick="return confirm('کدینگ کپی شود ؟')">
                                                    کپی
                                                </button>
                                            </form>
                                        @endcan
                                        @can('delete-coding')
                                            <form action="{{ route('coding.destroy',$coding->id) }}" method="POST"
                                                  class="table-dropdown-delete">
                                                @csrf
                                                @method('DELETE')
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                                </svg>
                                                <button onclick="return confirm('کدینگ حذف شود ؟')">
                                                    حذف
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                            @endcanany
                        </div>
                    </td>
                </tr>
            @endforeach
            @can('create-coding')
                @if(request()->has('category1') && request()->has('category2') && request()->has('category3') && $codings->isEmpty())
                    <tr class="table-tb-tr group">
                        <td class="table-tr-td border-t-0 p-2" colspan="7">
                            <div x-data="{open:false}">
                                <button type="button" class="table-plus-btn" @click="open = !open">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M12 4.5v15m7.5-7.5h-15"/>
                                    </svg>
                                </button>

                                <!-- Create Coding Modal -->
                                <div class="relative z-10" x-show="open" x-cloak>
                                    <div class="modal-backdrop"></div>
                                    <div class="fixed z-10 inset-0 overflow-y-auto">
                                        <div class="modal">
                                            <div class="modal-body">
                                                <div class="bg-white dark:bg-slate-800 p-4">
                                                    <div class="mb-4 flex justify-between items-center">
                                                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                            ایجاد کدینگ جدید
                                                        </h3>
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
                                                    <form method="POST" action="{{ route('coding.store') }}"
                                                          class="mt-6 space-y-4">
                                                        @csrf
                                                        <div class="mb-4 grid grid-cols-12 gap-4 items-center">
                                                            <div class="col-span-2">
                                                                <label for="inputCategory" class="form-label">
                                                                    <span class="font-bold text-red-600">* </span>دسته
                                                                    بندی
                                                                    :
                                                                </label>
                                                            </div>
                                                            <div class="col-span-10 grid grid-cols-12 gap-4">
                                                                <div class="col-span-4">
                                                                    @php
                                                                        $category1 = \App\Models\Category::find(request('category1'));
                                                                    @endphp
                                                                    <input type="text" class="input-text bg-gray-100"
                                                                           value="{{ $category1->code }} - {{ $category1->name }}"
                                                                           disabled>
                                                                    <input type="hidden" name="categories[]"
                                                                           value="{{ $category1->id }}">
                                                                </div>
                                                                <div class="col-span-4" id="categorySectionCreate1">
                                                                    @if(request()->has('category2'))
                                                                        @php
                                                                            $category2 = \App\Models\Category::find(request('category2'));
                                                                        @endphp
                                                                        <input type="text"
                                                                               class="input-text bg-gray-100"
                                                                               value="{{ $category2->code }} - {{ $category2->name }}"
                                                                               disabled>
                                                                        <input type="hidden" name="categories[]"
                                                                               value="{{ $category2->id }}">
                                                                    @endif
                                                                </div>
                                                                <div class="col-span-4" id="categorySectionCreate2">
                                                                    @if(request()->has('category3'))
                                                                        @php
                                                                            $category3 = \App\Models\Category::find(request('category3'));
                                                                        @endphp
                                                                        <input type="text"
                                                                               class="input-text bg-gray-100"
                                                                               value="{{ $category3->code }} - {{ $category3->name }}"
                                                                               disabled>
                                                                        <input type="hidden" name="categories[]"
                                                                               value="{{ $category3->id }}">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mb-4 grid grid-cols-12 gap-4 items-center">
                                                            <div class="col-span-2">
                                                                <label for="inputName2" class="form-label">
                                                                    <span class="font-bold text-red-600">* </span>نام :
                                                                </label>
                                                            </div>
                                                            <div class="col-span-10">
                                                                <input type="text" name="name" id="inputName2"
                                                                       class="input-text w-72"
                                                                       placeholder="نام محصول/قطعه"
                                                                       value="{{ old('name') }}">
                                                            </div>
                                                        </div>

                                                        <div class="mb-4 grid grid-cols-12 gap-4 items-center">
                                                            <div class="col-span-2">
                                                                <label for="inputUnit2" class="form-label">
                                                                    <span class="font-bold text-red-600">* </span>واحد :
                                                                </label>
                                                            </div>
                                                            <div class="col-span-10">
                                                                <select name="unit" id="inputUnit2"
                                                                        class="input-text w-72">
                                                                    <option value="">انتخاب کنید</option>
                                                                    <option value="عدد">عدد</option>
                                                                    <option value="دستگاه">دستگاه</option>
                                                                    <option value="متر">متر</option>
                                                                    <option value="کیلوگرم">کیلوگرم</option>
                                                                    <option value="شاخه">شاخه</option>
                                                                    <option value="برگ">برگ</option>
                                                                    <option value="بسته">بسته</option>
                                                                    <option value="لیتر">لیتر</option>
                                                                    <option value="کپسول">کپسول</option>
                                                                    <option value="متر مربع">متر مربع</option>
                                                                    <option value="حلقه">حلقه</option>
                                                                    <option value="جفت">جفت</option>
                                                                    <option value="دست">دست</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="mb-4 grid grid-cols-12 gap-4 items-center">
                                                            <div class="col-span-2">
                                                                <label for="inputStore2" class="form-label">
                                                                    <span class="font-bold text-red-600">* </span>انبار
                                                                    مربوط :
                                                                </label>
                                                            </div>
                                                            <div class="col-span-10">
                                                                <div
                                                                    class="flex items-center space-x-4 space-x-reverse">
                                                                    <label for="storeMavad">
                                                                        <input type="radio" name="store" value="10"
                                                                               id="storeMavad">
                                                                        10 - انبار مواد اولیه
                                                                    </label>
                                                                    <label for="storeMalzoomat">
                                                                        <input type="radio" name="store" value="12"
                                                                               id="storeMalzoomat">
                                                                        12 - انبار ملزومات
                                                                    </label>
                                                                    <label for="storeProduct">
                                                                        <input type="radio" name="store" value="14"
                                                                               id="storeProduct">
                                                                        14 - انبار محصولات
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mb-4 grid grid-cols-12 gap-4 items-center">
                                                            <div class="col-span-2">
                                                                <label for="inputCode2" class="form-label">
                                                                    <span class="font-bold text-red-600">* </span>کد
                                                                    جدید :
                                                                </label>
                                                            </div>
                                                            <div class="col-span-10">
                                                                <div class="flex items-center">
                                                                    <input type="text" name="code" id="inputCode2"
                                                                           class="input-text w-36 bg-[#FDE7E3] text-red-600 text-sm"
                                                                           placeholder="کد جدید محصول/قطعه" value="001">
                                                                    <p class="text-sm">
                                                                        {{ $category1->code . $category2->code . $category3->code }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="flex justify-end items-center space-x-4 space-x-reverse">
                                                            <button type="submit" class="form-submit-btn">
                                                                ثبت
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endif
            @endcan
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $codings->links() }}
    </div>
</x-layout>
