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
                            <label for="inputCategory" class="form-label">زیر دسته</label>
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
                            <label for="inputCategory3" class="form-label">زیر دسته</label>
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
            function changeUnit1(event, part) {
                let value = event.target.value;
                let input2 = document.getElementById('inputQuantity2' + part.id);
                let inputValue = document.getElementById('inputUnitValue' + part.id);
                let operator1 = part.operator2;
                let formula1 = part.formula2;
                let result;

                result = eval(value + operator1 + formula1);
                let formatResult = Intl.NumberFormat().format(result);
                input2.value = formatResult.replace(',', '');
                inputValue.value = result;
            }

            function changeUnit2(event, part) {
                let value = event.target.value;
                let input1 = document.getElementById('inputQuantity' + part.id);
                let inputValue = document.getElementById('inputUnitValue' + part.id);
                let operator2 = part.operator1;
                let formula2 = part.formula1;
                let result;

                result = eval(value + operator2 + formula2);
                let formatResult = Intl.NumberFormat().format(result);
                input1.value = formatResult.replace(',', '');
                inputValue.value = value;
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
        <a href="{{ route('inquiries.index') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="breadcrumb-svg" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    لیست استعلام ها
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
        <a href="{{ route('inquiries.product.amounts',$product->id) }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9zm3.75 11.625a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"></path>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    جزئیات محصول استعلام
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
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    افزودن قطعه به محصول
                </p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="flex items-center justify-between mt-8">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-8 h-8 dark:text-white">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            <div class="mr-2">
                <p class="font-bold text-2xl text-black dark:text-white">
                    افزودن قطعه به محصول
                </p>
            </div>
        </div>
        <div class="flex items-center space-x-4 space-x-reverse">
            <a href="{{ route('inquiries.product.amounts',$product->id) }}" class="page-warning-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9zm3.75 11.625a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"></path>
                </svg>
                <span class="mr-2">جزئیات محصول</span>
            </a>
        </div>
    </div>

    <!-- Search -->
    <div
        class="card-search" {{ request()->has('search') || request()->has('category1') || request()->has('category2') || request()->has('category3') || request()->has('calculate') ? 'x-data={open:true}' : 'x-data={open:false}' }}>
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
            <form class="col-span-1 card">
                <div class="mb-4">
                    <label for="inputCalculate" class="form-label">
                        جستجوی محاسباتی ها
                    </label>
                    <select name="calculate" id="inputCalculate" class="input-text">
                        <option value="">انتخاب کنید</option>
                        <option value="1" {{ request()->has('calculate') ? 'selected' : '' }}>
                            نمایش فقط محاسباتی ها
                        </option>
                    </select>
                </div>
                <div class="flex justify-end">
                    <button class="form-submit-btn" type="submit">
                        جستجو
                    </button>
                </div>
            </form>
            <form class="card col-span-2 grid grid-cols-3 gap-4">
                <div>
                    <label for="inputCategory1" class="form-label">
                        دسته بندی قطعه
                    </label>
                    <select name="category1" id="inputCategory1" class="input-text" onchange="getCategory1()">
                        <option value="">انتخاب کنید</option>
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
            @if(request()->has('search') || request()->has('category1') || request()->has('category2') || request()->has('category3') || request()->has('calculate'))
                <div>
                    <a href="{{ route('parts.index') }}" class="form-detail-btn text-xs">
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
                        واحد
                    </th>
                    <th scope="col" class="p-4">
                        قیمت
                    </th>
                    <th scope="col" class="p-4 rounded-tl-lg">
                        <span class="sr-only">اقدامات</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($parts as $part)
                    <tr class="table-tb-tr group">
                        <td class="table-tr-td border-t-0 border-l-0">
                            {{ $loop->index + 1 }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ $part->name }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ $part->unit }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            @if($part->price)
                                {{ number_format($part->price) }} تومان
                            @else
                                منتظر قیمت گذاری
                            @endif
                        </td>
                        <td class="table-tr-td border-t-0 border-r-0">
                            <div x-data="{open:false}">
                                <button class="table-success-btn" @click="open=!open" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M12 4.5v15m7.5-7.5h-15"/>
                                    </svg>
                                    افزودن
                                </button>
                                <div class="relative z-10" x-show="open" x-cloak>
                                    <div class="modal-backdrop"></div>
                                    <div class="fixed z-10 inset-0 overflow-y-auto">
                                        <div class="modal">
                                            <div class="modal-body">
                                                <div class="bg-white dark:bg-slate-800 p-4">
                                                    <div class="mb-4 flex justify-between items-center">
                                                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                            افزودن قطعه جدید به قطعات تکی
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
                                                          action="{{ route('inquiries.newPart.store',[$product->id,$part->id]) }}">
                                                        @csrf
                                                        <div class="mb-4">
                                                            <label class="block mb-2 text-sm font-bold"
                                                                   for="inputQuantity">
                                                                تعداد قطعه
                                                                @if(!is_null($part->unit2))
                                                                    <span class="text-xs font-bold">
                                                                        ( واحد : {{ $part->unit }} / {{ $part->unit2 }} )
                                                                    </span>
                                                                @endif
                                                            </label>
                                                            <input type="text" class="input-text w-40" name="value"
                                                                   id="inputQuantity{{ $part->id }}"
                                                                   placeholder="{{ $part->unit }}"
                                                                   onkeyup="changeUnit1(event,{{ $part }})">
                                                            @if(!is_null($part->unit2))
                                                                /
                                                                <input type="text" class="input-text w-40"
                                                                       name="value2"
                                                                       id="inputQuantity2{{ $part->id }}"
                                                                       placeholder="{{ $part->unit2 }}"
                                                                       onkeyup="changeUnit2(event,{{ $part }})">
                                                            @endif
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
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $parts->links() }}
        </div>
    </div>
</x-layout>
