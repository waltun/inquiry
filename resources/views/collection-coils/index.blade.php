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
                    url: '{{ route('parts.getCategory') }}',
                    data: {
                        id: id,
                    },
                    success: function (res) {
                        if (res.data != null) {
                            section.innerHTML = `
                            <label for="inputCategory" class="block mb-2 md:text-sm text-xs text-black">زیر دسته</label>
                            <select class="input-text" onchange="getCategory2()" id="inputCategory2" name="category2">
                                <option value="">انتخاب کنید</option>
                                    ${
                                res.data.map(function (category) {
                                    return `<option value="${category.id}">${category.name}</option>`
                                })
                            }
                            </select>`
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
                    url: '{{ route('parts.getCategory') }}',
                    data: {
                        id: id,
                    },
                    success: function (res) {
                        if (res.data != null) {
                            section.innerHTML = `
                            <label for="inputCategory3" class="block mb-2 md:text-sm text-xs text-black">زیر دسته</label>
                            <select class="input-text" name="category3" id="inputCategory3">
                                <option value="">انتخاب کنید</option>
                                    ${
                                res.data.map(function (category) {
                                    return `<option value="${category.id}">${category.name}</option>`
                                })
                            }
                            </select>`;
                        }
                    }
                });
            }
        </script>

        <script>
            $(".deleteAllBtn").on('click', function () {
                let ids = [];
                $(".checkboxes:checked").each(function () {
                    ids.push($(this).val());
                });

                if (ids.length <= 0) {
                    alert("لطفا موارد مورد نظر را انتخاب کنید")
                } else {
                    $.ajax({
                        url: '{{ route('collectionCoil.multiDelete') }}',
                        type: 'POST',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {
                            ids: ids,
                        },
                        success: function () {
                            alert("قطعات مورد نظر با موفقیت حذف شدند");
                            location.reload();
                        }
                    });
                }
            });
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
            <svg xmlns="http://www.w3.org/2000/svg" class="breadcrumb-svg-active" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    مدیریت مجموعه‌های محاسبه ای
                </p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="flex items-center justify-between mt-8">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 dark:text-white" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
            </svg>
            <div class="mr-2">
                <p class="font-bold text-2xl text-black dark:text-white">
                    لیست مجموعه‌های محاسبه ای
                </p>
            </div>
        </div>
        <div class="flex items-center space-x-4 space-x-reverse">
            <a href="{{ route('collections.index') }}" class="page-info-btn">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                </svg>
                <span class="mr-2">کالاهای نیم ساخته</span>
            </a>
            <a href="{{ route('parts.index') }}" class="page-warning-btn">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span class="mr-2">قطعات معمولی</span>
            </a>
        </div>
    </div>

    <!-- Search -->
    <div
        class="card-search" {{ request()->has('search') || request()->has('category1') || request()->has('category2') || request()->has('category3') ? 'x-data={open:true}' : 'x-data={open:false}' }}>
        <div class="card-header-search" @click="open = !open">
            <p class="card-title">
                جستجو
            </p>
            <div class="card-title-search">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-6 h-6 transition" :class="{'rotate-180' : open}">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                </svg>
            </div>
        </div>
        <div class="grid grid-cols-4 gap-4 pb-7" x-show="open" x-cloak>
            <form class="col-span-1 card">
                <div class="mb-4">
                    <label for="inputSearch" class="form-label">
                        جستجو براساس نام
                    </label>
                    <input type="text" id="inputSearch" name="search" class="input-text" placeholder="مثال : پیچ"
                           value="{{ request('search') }}">
                </div>
                <div class="flex justify-end">
                    <button class="form-submit-btn" type="submit">
                        جستجو
                    </button>
                </div>
            </form>

            <form class="card col-span-3 grid grid-cols-3 gap-4">
                <div>
                    <label for="inputCategory1" class="form-label">
                        دسته بندی قطعه
                    </label>
                    <select name="category1" id="inputCategory1" class="input-text" onchange="getCategory1()">
                        <option value="" selected>انتخاب کنید</option>
                        @foreach($categories as $category)
                            <option
                                value="{{ $category->id }}" {{ request('category1') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div id="categorySection1">
                    @if(request()->has('category2'))
                        @php
                            $category2 = \App\Models\Category::find(request('category1'))->children;
                        @endphp
                        <label for="inputCategory2" class="block mb-2 md:text-sm text-xs text-black">زیردسته
                            اول</label>
                        <select name="category2" id="inputCategory2" class="input-text" onchange="getCategory2()">
                            <option value="">انتخاب کنید</option>
                            @foreach($category2 as $category)
                                <option
                                    value="{{ $category->id }}" {{ request('category2') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    @endif
                </div>
                <div id="categorySection2">
                    @if(request()->has('category3'))
                        @php
                            $category3 = \App\Models\Category::find(request('category2'))->children;
                        @endphp
                        <label for="inputCategory3" class="block mb-2 md:text-sm text-xs text-black">زیردسته
                            دوم</label>
                        <select name="category3" id="inputCategory3" class="input-text">
                            <option value="">انتخاب کنید</option>
                            @foreach($category3 as $category)
                                <option
                                    value="{{ $category->id }}" {{ request('category3') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    @endif
                </div>

                <div class="col-span-3 flex justify-end">
                    <button type="submit" class="form-submit-btn">جستجو</button>
                </div>
            </form>
            @if(request()->has('search') || request()->has('category1') || request()->has('category2') || request()->has('category3'))
                <div>
                    <a href="{{ route('collectionCoil.index') }}" class="form-detail-btn text-xs">
                        پاکسازی جستجو
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Content -->
    <div class="mt-4 space-y-4">
        <div class="mt-8 overflow-x-auto rounded-lg">
            <table class="w-full border-collapse">
                <thead>
                <tr class="table-th-tr">
                    <th scope="col" class="p-4 rounded-tr-lg">
                        #
                    </th>
                    <th scope="col" class="p-4">
                        نام
                    </th>
                    <th scope="col" class="p-4">
                        استعلام مربوطه
                    </th>
                    <th scope="col" class="p-4">
                        واحد
                    </th>
                    <th scope="col" class="p-4">
                        قیمت (تومان)
                    </th>
                    <th scope="col" class="p-4">
                        <span class="sr-only">مقادیر</span>
                    </th>
                    <th scope="col" class="p-4 rounded-tl-lg">
                        <span class="sr-only">اقدامات</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                @if(!request()->has('search') && !request()->has('category1') && !request()->has('category2') && !request()->has('category3') && !request()->has('page'))
                    @foreach(\App\Models\Special::all() as $special)
                        @php
                            $part = \App\Models\Part::find($special->part_id);
                        @endphp
                        <tr class="table-tb-tr group">
                            <td class="table-tr-td border-t-0 border-l-0">
                                <input type="checkbox" value="{{ $part->id }}"
                                       class="checkboxes w-4 h-4 focus:ring-blue-500 focus:ring-2 focus:ring-offset-1 mx-auto block">
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                {{ $part->name }}
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                -
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                {{ $part->unit }}
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                -
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                <a href="{{ route('collections.amounts',$part->id) }}" class="table-success-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"/>
                                    </svg>
                                    مقادیر
                                </a>
                            </td>
                            <td class="table-tr-td border-t-0 border-r-0">
                                @if($delete->collection_coil)
                                    <form action="{{ route('collections.destroy',$part->id) }}" method="POST"
                                          class="table-delete-btn">
                                        @csrf
                                        @method('DELETE')
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                        </svg>
                                        <button onclick="return confirm('قطعه حذف شود ؟')">
                                            حذف
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif

                @foreach($parts as $part)
                    @php
                            if(!is_null($part->inquiry_id)) {
                            $inquiry = \App\Models\Inquiry::find($part->inquiry_id);
                        }
                    @endphp
                    <tr class="table-tb-tr group">
                        <td class="table-tr-td border-t-0 border-l-0">
                            <input type="checkbox" value="{{ $part->id }}"
                                   class="checkboxes w-4 h-4 focus:ring-blue-500 focus:ring-2 focus:ring-offset-1 mx-auto block">
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ $part->name }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            @if(isset($inquiry))
                                @if(!is_null($inquiry->inquiry_number))
                                    INQ-{{ $inquiry->inquiry_number }} ({{ $inquiry->name }})
                                @else
                                    {{ $inquiry->name }}
                                @endif
                            @else
                                -
                            @endif
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ $part->unit }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            @if($part->price)
                                {{ number_format($part->price) }}
                            @else
                                <p class="text-red-600">
                                    منتظر ثبت مقادیر
                                </p>
                            @endif
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            <a href="{{ route('collections.amounts',$part->id) }}" class="table-success-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"/>
                                </svg>
                                مقادیر
                            </a>
                        </td>
                        <td class="table-tr-td border-t-0 border-r-0">
                            <div class="flex justify-center items-center relative" x-data="{open:false}">
                                <button @click="open = !open">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/>
                                    </svg>
                                </button>

                                <div x-show="open" @click.away="open = false" class="table-dropdown -top-6 -right-28"
                                     x-cloak>
                                    @if($delete->collection_coil)
                                        <form action="{{ route('collections.destroy',$part->id) }}" method="POST"
                                              class="table-delete-btn">
                                            @csrf
                                            @method('DELETE')
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                            </svg>
                                            <button onclick="return confirm('قطعه حذف شود ؟')">
                                                حذف
                                            </button>
                                        </form>
                                    @endif
                                    <div x-data="{open:false}">
                                        <button class="table-success-btn" @click="open = !open">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                                            </svg>
                                            استاندارد سازی
                                        </button>

                                        <div class="relative z-10" x-show="open" x-cloak>
                                            <div class="modal-backdrop"></div>
                                            <div class="fixed z-10 inset-0 overflow-y-auto">
                                                <div class="modal">
                                                    <div class="modal-body">
                                                        <div class="bg-white dark:bg-slate-800 p-4">
                                                            <div class="mb-4 flex justify-between items-center">
                                                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                                    استاندارد سازی قطعه مجموعه ای
                                                                </h3>
                                                                <button type="button" @click="open = false">
                                                                    <span class="modal-close">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                             fill="none"
                                                                             viewBox="0 0 24 24"
                                                                             stroke-width="1.5"
                                                                             stroke="currentColor"
                                                                             class="w-5 h-5 dark:text-white">
                                                                            <path stroke-linecap="round"
                                                                                  stroke-linejoin="round"
                                                                                  d="M6 18L18 6M6 6l12 12"/>
                                                                        </svg>
                                                                    </span>
                                                                </button>
                                                            </div>
                                                            <form class="mt-6" method="POST"
                                                                  action="{{ route('collectionCoil.standard',$part->id) }}">
                                                                @csrf
                                                                <div class="mb-4">
                                                                    <label for="inputName" class="form-label">
                                                                        نام قطعه
                                                                    </label>
                                                                    <input type="text" class="input-text" name="name"
                                                                           value="{{ $part->name }}">
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
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Delete All Button -->
        @if(!$parts->isEmpty())
            <div class="mt-4">
                <button type="button" class="deleteAllBtn form-cancel-btn">
                    حذف موارد انتخاب شده
                </button>
            </div>
        @endif

        <!-- Pagination -->
        <div class="my-4">
            {{ $parts->links() }}
        </div>

        <!-- Parts count -->
        <div class="mt-4 mb-4">
            <p class="text-sm font-bold text-indigo-600 underline underline-offset-4">
                تعداد کل قطعات مجموعه کویل سازی
                : {{ \App\Models\Part::where('collection',true)->where('coil',true)->count() }}
            </p>
        </div>
    </div>
</x-layout>
