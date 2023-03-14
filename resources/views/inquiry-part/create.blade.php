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
            function changeUnit1(event, part) {
                let value = event.target.value;
                let input2 = document.getElementById('inputQuantity2' + part.id);
                let inputValue = document.getElementById('inputUnitValue' + part.id);
                let operator1 = part.operator2;
                let formula1 = part.formula2;
                let result = 0;

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
                let result = 0;

                result = eval(value + operator2 + formula2);
                input1.value = Intl.NumberFormat().format(result);
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
        @if($inquiry->submit)
            <a href="{{ route('inquiries.submitted') }}" class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="breadcrumb-svg"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div class="mr-2">
                    <p class="breadcrumb-p">
                        استعلام های منتظر قیمت
                    </p>
                </div>
            </a>
        @else
            <a href="{{ route('inquiries.index') }}" class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="breadcrumb-svg"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div class="mr-2">
                    <p class="breadcrumb-p">
                        لیست استعلام ها
                    </p>
                </div>
            </a>
        @endif
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                 class="breadcrumb-svg-arrow">
                <path fill-rule="evenodd"
                      d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                      clip-rule="evenodd"/>
            </svg>
        </div>
        <a href="{{ route('inquiries.parts.index',$inquiry->id) }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    قطعات تکی استعلام {{ $inquiry->name }}
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
                    افزودن قطعه جدید
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
                    افزودن قطعه به استعلام {{ $inquiry->name }}
                </p>
            </div>
        </div>
        <div class="flex items-center space-x-4 space-x-reverse">
            <a href="{{ route('inquiries.parts.index',$inquiry->id) }}" class="page-info-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span class="mr-2">قطعات استعلام {{ $inquiry->name }}</span>
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
            @if(request()->has('search') || request()->has('category1') || request()->has('category2') || request()->has('category3'))
                <div>
                    <a href="{{ route('inquiries.parts.create',$inquiry->id) }}" class="form-detail-btn text-xs">
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
                            @if(in_array($part->id,$inquiry->products->pluck('part_id')->toArray()))
                                <p class="text-red-600">{{ $part->name }}</p>
                            @else
                                {{ $part->name }}
                            @endif
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ $part->unit }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ number_format($part->price) }}
                        </td>
                        <td class="table-tr-td border-t-0 border-r-0">
                            <div class="inline-flex" x-data="{open:false}">
                                <button type="button" class="table-success-btn" @click="open=!open">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M12 4.5v15m7.5-7.5h-15"/>
                                    </svg>
                                    افزودن به استعلام
                                </button>
                                <div class="relative z-10" x-show="open" x-cloak>
                                    <div class="modal-backdrop"></div>
                                    <div class="fixed z-10 inset-0 overflow-y-auto">
                                        <div class="modal">
                                            <div class="modal-body">
                                                <div class="bg-white dark:bg-slate-800 p-4">
                                                    <div class="mb-4 flex justify-between items-center">
                                                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                            اضافه کردن قطعه به استعلام {{ $inquiry->name }}
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
                                                    <form method="POST" class="mt-6"
                                                          action="{{ route('inquiries.parts.store',[$inquiry->id,$part->id]) }}">
                                                        @csrf
                                                        <div class="mb-4">
                                                            <label class="form-label" for="inputQuantity">
                                                                تعداد قطعه
                                                                @if(!is_null($part->unit2))
                                                                    <span class="text-xs font-bold">
                                                                        ( واحد : {{ $part->unit }} / {{ $part->unit2 }} )
                                                                    </span>
                                                                @endif
                                                            </label>
                                                            <input type="text" class="input-text w-1/2" name="quantity"
                                                                   id="inputQuantity{{ $part->id }}"
                                                                   placeholder="{{ $part->unit }}"
                                                                   onkeyup="changeUnit1(event,{{ $part }})">
                                                            @if(!is_null($part->unit2))
                                                                /
                                                                <input type="text" class="input-text w-1/3"
                                                                       name="quantity2"
                                                                       id="inputQuantity2{{ $part->id }}"
                                                                       placeholder="{{ $part->unit2 }}"
                                                                       onkeyup="changeUnit2(event,{{ $part }})">
                                                            @endif
                                                        </div>
                                                        <div class="mb-4">
                                                            <label class="form-label" for="inputTag">
                                                                تگ
                                                            </label>
                                                            <input type="text" class="input-text" name="tag"
                                                                   id="inputTag"
                                                                   placeholder="تگ / شماره سریال و...">
                                                        </div>
                                                        <div class="mb-4">
                                                            <label class="form-label" for="inputType">
                                                                نوع قطعه
                                                            </label>
                                                            <select name="type" id="inputType" class="input-text">
                                                                <option value="">انتخاب کنید</option>
                                                                <option value="setup">قطعات یدکی راه اندازی</option>
                                                                <option value="years">قطعات یدکی دو سالانه</option>
                                                                <option value="control">قطعات کنترلی</option>
                                                                <option value="power_cable">لیست کابل قدرت</option>
                                                                <option value="control_cable">لیست کابل کنترلی</option>
                                                                <option value="pipe">لیست لوله و اتصالات</option>
                                                                <option value="install_setup_price">
                                                                    دستمزد نصب و راه اندازی
                                                                </option>
                                                                <option value="setup_price">دستمزد راه اندازی</option>
                                                                <option value="supervision">دستمزد نظارت</option>
                                                                <option value="transport">هزینه حمل</option>
                                                                <option value="other">سایر تجهیزات</option>
                                                            </select>
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

        <div class="mt-4 hidden md:block">
            {{ $parts->links() }}
        </div>

        <!-- Mobile List -->
        <div class="block md:hidden">
            @foreach($parts as $part)
                <div class="bg-white rounded-md p-4 border border-gray-200 shadow-md mb-4 relative">
                <span
                    class="absolute right-2 top-2 p-2 w-6 h-6 rounded-full bg-indigo-300 text-black text-xs grid place-content-center font-bold">
                    {{ $loop->index+1 }}
                </span>
                    <div class="space-y-4">
                        <p class="text-xs text-black text-center font-bold">
                            {{ $part->name }}
                        </p>
                        <p class="text-xs text-black text-center">
                            واحد : {{ $part->unit }}
                        </p>
                        @if($part->price)
                            <p class="text-xs text-black text-center font-medium">
                                قیمت : {{ number_format($part->price) }} تومان
                            </p>
                        @else
                            <p class="text-xs text-red-600 text-center font-medium">
                                منتظر قیمت گذاری
                            </p>
                        @endif

                        @php
                            $code = '';
                            foreach($part->categories as $category){
                                $code = $code . $category->code;
                            }
                        @endphp
                        <p class="text-xs text-black text-center">
                            کد : {{ $part->code . "-" . $code }}
                        </p>
                        <div class="flex w-full justify-center">
                            <div class="inline-flex" x-data="{open:false}">
                                <button type="button" class="form-submit-btn text-xs" @click="open=!open">
                                    افزودن به استعلام {{ $inquiry->name }}
                                </button>
                                <div class="relative z-50" x-show="open" x-cloak>
                                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                                    <div class="fixed z-10 inset-0 overflow-y-auto">
                                        <div
                                            class="flex items-center justify-center min-h-full p-4 text-center">
                                            <form method="POST"
                                                  action="{{ route('inquiries.parts.store',[$inquiry->id,$part->id]) }}"
                                                  class="relative bg-white rounded-lg text-right overflow-hidden shadow-xl transform transition-all my-8 md:max-w-lg w-full">
                                                @csrf
                                                <div class="bg-white p-4">
                                                    <div class="mt-3 text-center sm:mt-0 sm:text-right">
                                                        <h3 class="text-lg font-medium text-gray-900 border-b border-gray-300 pb-3">
                                                            تعداد قطعه
                                                        </h3>
                                                        <div class="mt-4">
                                                            <label class="block mb-2 text-sm font-bold"
                                                                   for="inputQuantity">
                                                                تعداد قطعه
                                                            </label>
                                                            <input type="text" class="input-text" name="quantity"
                                                                   id="inputQuantity">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="bg-gray-100 px-4 py-2">
                                                    <button type="submit" class="form-submit-btn">
                                                        ثبت
                                                    </button>
                                                    <button type="button" class="form-cancel-btn"
                                                            @click="open = !open">
                                                        انصراف
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
            @endforeach

            <div class="mt-4 block md:hidden">
                {{ $parts->links() }}
            </div>
        </div>
    </div>
</x-layout>
