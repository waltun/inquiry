<x-layout>
    @php
        $selectedCoding = null;
        if (request()->has('coding')) {
            $selectedCoding = \App\Models\System\Coding::find(request('coding'));
        }
    @endphp

    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/date-picker/persianDatepicker.min.js') }}"></script>
        <script>
            $("#inputDate").persianDatepicker({
                formatDate: "YYYY-MM-DD",
            });
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
    </x-slot>

    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="{{ route('dashboard') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-5 h-5 text-gray-500">
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
        <a href="{{ route('purchase.index') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    لیست خرید اقلام
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
                      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    ویرایش آیتم
                </p>
            </div>
        </div>
    </div>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <!-- Edit Store form -->
    <form method="POST" action="{{ route('purchase.update',$purchase->id) }}" class="mt-6 space-y-4">
        @csrf
        @method('PATCH')

        @if(is_null($purchase->coding_id) || request()->has('coding'))
            <input type="hidden" name="coding_id" value="{{ $selectedCoding->id ?? '' }}">
        @else
            @php
                $currentCoding = \App\Models\System\Coding::find($purchase->coding_id);
            @endphp
            <input type="hidden" name="coding_id" value="{{ $currentCoding->id ?? '' }}">
        @endif


        <div class="card">
            <div class="mb-4 flex justify-end items-center">
                <div class="flex items-center">
                    <label for="inputDate"
                           class="form-label whitespace-nowrap ml-2 mt-2">
                        تاریخ درخواست
                    </label>
                    <input type="text" name="date" id="inputDate" class="input-text" value="{{ $date }}"
                           placeholder="تاریخ ثبت">
                </div>
            </div>
            <table class="w-full">
                <thead>
                <tr class="text-xs border border-gray-400 text-center bg-sky-200">
                    <th class="p-1">کدینگ</th>
                    <th class="p-1 border-r border-gray-400">شرح</th>
                    <th class="p-1 border-r border-gray-400">تعداد</th>
                    <th class="p-1 border-r border-gray-400">واحد</th>
                </tr>
                </thead>
                <tbody>
                <tr class="text-xs border border-gray-400 text-center">
                    <td class="p-1">
                        <!-- Select Coding -->
                        <div
                            class="flex justify-center items-center" {{ request()->has('page') || request()->has('category1') || request()->has('search') ? 'x-data={open:true}' : 'x-data={open:false}' }}>
                            <button type="button"
                                    class="flex items-center text-xs font-bold text-indigo-500"
                                    @click="open = !open">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke-width="1.5"
                                     stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </button>

                            <!-- Select Coding Modal -->
                            <div class="relative z-20" x-show="open" x-cloak>
                                <div class="modal-backdrop"></div>
                                <div class="fixed z-50 inset-0 overflow-y-auto">
                                    <div class="modal">
                                        <div class="modal-body">
                                            <div class="bg-white dark:bg-slate-800 p-4">
                                                <div class="mb-4 flex justify-between items-center">
                                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                        انتخاب محصول/قطعه از کدینگ
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
                                                <div class="grid grid-cols-4 gap-4">
                                                    <form>
                                                        <div class="flex rounded-md shadow-sm">
                                                            <input type="text" name="search"
                                                                   id="inputSearch2"
                                                                   class="input-text rounded-l-none"
                                                                   placeholder="جستجو..."
                                                                   value="{{ request('search') }}">
                                                            <button type="button" onclick="searchText()"
                                                                    class="inline-flex items-center rounded-l-lg border border-gray-200 border-r-0 bg-white px-3 text-sm text-gray-500">
                                                                <svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    fill="none" viewBox="0 0 24 24"
                                                                    stroke-width="1.5"
                                                                    stroke="currentColor"
                                                                    class="w-6 h-6">
                                                                    <path stroke-linecap="round"
                                                                          stroke-linejoin="round"
                                                                          d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </form>
                                                    <form class="col-span-3 grid grid-cols-3 gap-4"
                                                          id="category-search">
                                                        <div>
                                                            <select name="category1"
                                                                    id="inputCategory1"
                                                                    class="input-text"
                                                                    onchange="getCategory1()">
                                                                <option value="">انتخاب کنید
                                                                </option>
                                                                @foreach($categories as $category)
                                                                    <option
                                                                        value="{{ $category->id }}" {{ request('category1') == $category->id ? 'selected' : '' }}>
                                                                        {{ $category->code }}
                                                                        - {{ $category->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div id="categorySection1">
                                                            @if(request()->has('category2'))
                                                                @php
                                                                    $category2 = \App\Models\System\SystemCategory::find(request('category1'))->children;
                                                                @endphp
                                                                <select name="category2"
                                                                        id="inputCategory2"
                                                                        class="input-text"
                                                                        onchange="getCategory2()">
                                                                    <option value="">انتخاب کنید
                                                                    </option>
                                                                    @foreach($category2 as $category)
                                                                        <option
                                                                            value="{{ $category->id }}" {{ request('category2') == $category->id ? 'selected' : '' }}>
                                                                            {{ $category->code }}
                                                                            - {{ $category->name }}
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
                                                                <select name="category3"
                                                                        id="inputCategory3"
                                                                        class="input-text"
                                                                        onchange="submitCategoryForm()">
                                                                    <option value="">انتخاب کنید
                                                                    </option>
                                                                    @foreach($category3 as $category)
                                                                        <option
                                                                            value="{{ $category->id }}" {{ request('category3') == $category->id ? 'selected' : '' }}>
                                                                            {{ $category->code }}
                                                                            - {{ $category->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            @endif
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="mt-6 space-y-4">
                                                    <!-- Table -->
                                                    <div class="overflow-x-auto rounded-lg">
                                                        <table class="w-full border-collapse">
                                                            <thead>
                                                            <tr class="table-th-tr">
                                                                <th scope="col"
                                                                    class="p-2 rounded-tr-lg">
                                                                    #
                                                                </th>
                                                                <th scope="col" class="p-2">
                                                                    کد
                                                                </th>
                                                                <th scope="col" class="p-2">
                                                                    نام
                                                                </th>
                                                                <th scope="col" class="p-2">
                                                                    واحد
                                                                </th>
                                                                <th scope="col" class="p-2">
                                                                    <span class="sr-only"></span>
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($codings as $coding2)
                                                                <tr class="table-tb-tr group">
                                                                    <td class="table-tr-td border-t-0">
                                                                        {{ $loop->index + 1 }}
                                                                    </td>
                                                                    <td class="table-tr-td border-t-0 border-x-0 text-red-600 text-right">
                                                                        {{ $coding2->code }}
                                                                    </td>
                                                                    <td class="table-tr-td border-t-0 border-x-0 text-right">
                                                                        {{ $coding2->name }}
                                                                    </td>
                                                                    <td class="table-tr-td border-t-0 border-r-0">
                                                                        {{ $coding2->unit }}
                                                                    </td>
                                                                    <td class="table-tr-td border-t-0 border-r-0">
                                                                        <div
                                                                            class="flex justify-center">
                                                                            <a href="{{ route('purchase.edit',$purchase->id) }}?coding={{ $coding2->id }}"
                                                                               class="table-dropdown-copy">
                                                                                <svg
                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                    fill="none"
                                                                                    viewBox="0 0 24 24"
                                                                                    stroke-width="1.5"
                                                                                    stroke="currentColor"
                                                                                    class="w-4 h-4 ml-1">
                                                                                    <path
                                                                                        stroke-linecap="round"
                                                                                        stroke-linejoin="round"
                                                                                        d="M12 4.5v15m7.5-7.5h-15"/>
                                                                                </svg>
                                                                                انتخاب
                                                                            </a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <div class="mt-4">
                                                        {{ $codings->links() }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="p-1 border-r border-gray-400">
                        @if(is_null($purchase->coding_id) || request()->has('coding'))
                            <input type="text" name="name" id="inputName"
                                   value="{{ $selectedCoding->name ?? $purchase->title }}"
                                   class="input-text" placeholder="نام قطعه / کالا">
                        @else
                            @php
                                $currentCoding = \App\Models\System\Coding::find($purchase->coding_id);
                            @endphp
                            <input type="text" name="title" id="inputTitle"
                                   value="{{ $currentCoding->name }}"
                                   class="input-text" placeholder="نام قطعه / کالا">
                        @endif
                    </td>
                    <td class="p-1 border-r border-gray-400">
                        <input type="text" name="request_quantity" id="inputRequestQuantity" class="input-text w-20 text-center"
                               placeholder="تعداد" value="{{ $purchase->request_quantity }}">
                    </td>
                    <td class="p-1 border-r border-gray-400">
                        @if(is_null($purchase->coding_id) || request()->has('coding'))
                            <select name="unit" id="inputUnit"
                                    class="input-text py-1.5 w-20">
                                <option
                                    value="عدد" {{ $selectedCoding ? ($selectedCoding->unit == 'عدد' ? 'selected' : '') : '' }}>
                                    عدد
                                </option>
                                <option
                                    value="دستگاه" {{ $selectedCoding ? ($selectedCoding->unit == 'دستگاه' ? 'selected' : '') : '' }}>
                                    دستگاه
                                </option>
                                <option
                                    value="متر" {{ $selectedCoding ? ($selectedCoding->unit == 'متر' ? 'selected' : '') : '' }}>
                                    متر
                                </option>
                                <option
                                    value="کیلوگرم" {{ $selectedCoding ? ($selectedCoding->unit == 'کیلوگرم' ? 'selected' : '') : '' }}>
                                    کیلوگرم
                                </option>
                                <option
                                    value="شاخه" {{ $selectedCoding ? ($selectedCoding->unit == 'شاخه' ? 'selected' : '') : '' }}>
                                    شاخه
                                </option>
                                <option
                                    value="برگ" {{ $selectedCoding ? ($selectedCoding->unit == 'برگ' ? 'selected' : '') : '' }}>
                                    برگ
                                </option>
                                <option
                                    value="بسته" {{ $selectedCoding ? ($selectedCoding->unit == 'بسته' ? 'selected' : '') : '' }}>
                                    بسته
                                </option>
                                <option
                                    value="لیتر" {{ $selectedCoding ? ($selectedCoding->unit == 'لیتر' ? 'selected' : '') : '' }}>
                                    لیتر
                                </option>
                                <option
                                    value="کپسول" {{ $selectedCoding ? ($selectedCoding->unit == 'کپسول' ? 'selected' : '') : '' }}>
                                    کپسول
                                </option>
                                <option
                                    value="مترمربع" {{ $selectedCoding ? ($selectedCoding->unit == 'مترمربع' ? 'selected' : '') : '' }}>
                                    مترمربع
                                </option>
                                <option
                                    value="حلقه" {{ $selectedCoding ? ($selectedCoding->unit == 'حلقه' ? 'selected' : '') : '' }}>
                                    حلقه
                                </option>
                                <option
                                    value="جفت" {{ $selectedCoding ? ($selectedCoding->unit == 'جفت' ? 'selected' : '') : '' }}>
                                    جفت
                                </option>
                                <option
                                    value="دست" {{ $selectedCoding ? ($selectedCoding->unit == 'دست' ? 'selected' : '') : '' }}>
                                    دست
                                </option>
                                <option
                                    value="سری" {{ $selectedCoding ? ($selectedCoding->unit == 'سری' ? 'selected' : '') : '' }}>
                                    سری
                                </option>
                            </select>
                        @else
                            @php
                                $currentCoding = \App\Models\System\Coding::find($purchase->coding_id);
                            @endphp
                            <select name="unit" id="inputUnit"
                                    class="input-text py-1.5 w-20">
                                <option
                                    value="عدد" {{  $currentCoding->unit == 'عدد' ? 'selected' : '' }}>
                                    عدد
                                </option>
                                <option
                                    value="دستگاه" {{ $currentCoding->unit == 'دستگاه' ? 'selected' : '' }}>
                                    دستگاه
                                </option>
                                <option
                                    value="متر" {{ $currentCoding->unit == 'متر' ? 'selected' : '' }}>
                                    متر
                                </option>
                                <option
                                    value="کیلوگرم" {{ $currentCoding->unit == 'کیلوگرم' ? 'selected' : '' }}>
                                    کیلوگرم
                                </option>
                                <option
                                    value="شاخه" {{ $currentCoding->unit == 'شاخه' ? 'selected' : '' }}>
                                    شاخه
                                </option>
                                <option
                                    value="برگ" {{ $currentCoding->unit == 'برگ' ? 'selected' : '' }}>
                                    برگ
                                </option>
                                <option
                                    value="بسته" {{ $currentCoding->unit == 'بسته' ? 'selected' : '' }}>
                                    بسته
                                </option>
                                <option
                                    value="لیتر" {{ $currentCoding->unit == 'لیتر' ? 'selected' : '' }}>
                                    لیتر
                                </option>
                                <option
                                    value="کپسول" {{ $currentCoding->unit == 'کپسول' ? 'selected' : '' }}>
                                    کپسول
                                </option>
                                <option
                                    value="مترمربع" {{ $currentCoding->unit == 'مترمربع' ? 'selected' : '' }}>
                                    مترمربع
                                </option>
                                <option
                                    value="حلقه" {{ $currentCoding->unit == 'حلقه' ? 'selected' : '' }}>
                                    حلقه
                                </option>
                                <option
                                    value="جفت" {{ $currentCoding->unit == 'جفت' ? 'selected' : '' }}>
                                    جفت
                                </option>
                                <option
                                    value="دست" {{ $currentCoding->unit == 'دست' ? 'selected' : '' }}>
                                    دست
                                </option>
                                <option
                                    value="سری" {{ $currentCoding->unit == 'سری' ? 'selected' : '' }}>
                                    سری
                                </option>
                            </select>
                        @endif

                    </td>
                </tr>
                <tr class="text-xs text-center">
                    <td></td>
                </tr>
                <tr class="text-xs text-center">
                    <td></td>
                    <td></td>
                    <td class="p-1 border border-gray-400">
                        <div class="flex items-center">
                            <label for="inputDescription" class="form-label whitespace-nowrap mb-0 ml-2">توضیحات</label>
                            <input type="text" name="description" id="inputDescription" class="input-text"
                                   placeholder="توضیحات" value="{{ $purchase->description }}">
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="flex items-center space-x-4 space-x-reverse">
            <button type="submit" class="form-edit-btn">
                بروزرسانی کالا
            </button>
            <a href="{{ route('purchase.index') }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>
