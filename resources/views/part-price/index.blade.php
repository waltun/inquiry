<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script>
            function showPrice(id) {
                let input = document.getElementById("inputPrice" + id);
                let section = document.getElementById("priceSection" + id);
                section.innerText = new Intl.NumberFormat().format(input.value) + ' تومان ';
            }

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
                            <select class="input-text text-xs" onchange="getCategory2()" id="inputCategory2" name="category2">
                                <option value="">انتخاب زیر دسته</option>
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
                            <select class="input-text text-xs" name="category3" id="inputCategory3" onchange="searchCategory()">
                                <option value="">انتخاب زیر دسته</option>
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
            function updateDate(id) {
                let url = window.location.href;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    method: 'PATCH',
                    url: '/parts/price/' + id + '/' + 'update-date',
                    data: {
                        id: id,
                    },
                    success: function (res) {
                        if (res.data === 'error') {
                            alert('قیمت برای این قطعه ثبت نشده است!')
                        } else {
                            location.href = url;
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
                        url: '{{ route('parts.price.multi-update-date') }}',
                        type: 'POST',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {
                            ids: ids,
                        },
                        success: function () {
                            alert("آیتم های مورد نظر با موفقیت بروزرسانی شدند");
                            location.reload();
                        }
                    });
                }
            });
        </script>
        <script>
            function searchCategory() {
                let form = document.getElementById('searchCategoryForm');
                form.submit();
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
                      d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"></path>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    بخش قیمت گذاری قطعات
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
                      d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"></path>
            </svg>
            <div class="mr-2 flex items-center">
                <p class="font-bold text-2xl text-black dark:text-white">
                    بخش قیمت گذاری قطعات
                </p>

                @if(request()->has('search') || request()->has('category1') || request()->has('category2') || request()->has('category3'))
                    <div class="mr-4">
                        <a href="{{ route('parts.price.index') }}" class="text-xs underline underline-offset-4 text-indigo-400 font-bold">
                            پاکسازی جستجو
                        </a>
                    </div>
                @endif
            </div>
        </div>
        <div class="flex items-center space-x-4 space-x-reverse">
            @can('collections')
                <a href="{{ route('collections.index') }}" class="page-warning-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                    </svg>
                    <span class="mr-2">کالاهای نیم ساخته</span>
                </a>
            @endcan
            @can('parts')
                <a href="{{ route('parts.index') }}" class="page-info-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="mr-2">قطعات معمولی</span>
                </a>
            @endcan
        </div>
    </div>

    <!-- Search -->
    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 mt-4">
        <div class="grid grid-cols-4 gap-4">
            <form class="col-span-1">
                <input type="text" id="inputSearch" name="search" class="input-text" placeholder="جستجو + اینتر"
                       value="{{ request('search') }}">
            </form>

            <form class="col-span-3 grid grid-cols-3 gap-4" id="searchCategoryForm">
                <select name="category1" id="inputCategory1" class="input-text" onchange="getCategory1()">
                    <option value="">انتخاب دسته بندی</option>
                    @foreach($categories as $category)
                        <option
                            value="{{ $category->id }}" {{ request('category1') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <div id="categorySection1">
                    @if(request()->has('category2'))
                        @php
                            $category2 = \App\Models\Category::find(request('category1'))->children;
                        @endphp
                        <select name="category2" id="inputCategory2" class="input-text" onchange="getCategory2()">
                            <option value="">انتخاب زیر دسته</option>
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
                        <select name="category3" id="inputCategory3" class="input-text" onchange="searchCategory()">
                            <option value="">انتخاب زیر دسته</option>
                            @foreach($category3 as $category)
                                <option
                                    value="{{ $category->id }}" {{ request('category3') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Content -->
    <form action="{{ route('parts.price.update') }}" method="POST" class="mt-4">
        @csrf
        @method('PATCH')

        <div class="mt-8 overflow-x-auto rounded-lg">
            <table class="w-full border-collapse">
                <thead>
                <tr class="table-th-tr">
                    <th scope="col" class="p-4 rounded-tr-lg">
                        ردیف
                    </th>
                    <th scope="col" class="p-4">
                        نام
                    </th>
                    <th scope="col" class="p-4">
                        واحد
                    </th>
                    <th scope="col" class="p-4">
                        قیمت قبلی
                    </th>
                    <th scope="col" class="p-4">
                        قیمت (تومان)
                    </th>
                    <th scope="col" class="p-4">
                        وزن (کیلوگرم)
                    </th>
                    <th scope="col" class="p-4">
                        آخرین بروزرسانی
                    </th>
                    <th scope="col" class="p-4 rounded-tl-lg">
                        <span class="sr-only">بروزرسانی تاریخ</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                @php
                    $color = '';
                    $time = null;
                @endphp
                @foreach($parts as $part)
                    @php
                        if ($setting) {
                            if($setting->price_color_type == 'month') {
                                $lastTime = \Carbon\Carbon::now()->subMonth($setting->price_color_last_time);
                                $midTime = \Carbon\Carbon::now()->subMonth($setting->price_color_mid_time);
                            }
                            if($setting->price_color_type == 'day') {
                                $lastTime = \Carbon\Carbon::now()->subDay($setting->price_color_last_time);
                                $midTime = \Carbon\Carbon::now()->subDay($setting->price_color_mid_time);
                            }
                            if($setting->price_color_type == 'hour') {
                                $lastTime = \Carbon\Carbon::now()->subHour($setting->price_color_last_time);
                                $midTime = \Carbon\Carbon::now()->subHour($setting->price_color_mid_time);
                            }
                        }

                        if ($part->price_updated_at < $lastTime && $part->price > 0) {
                            $color = 'text-red-500';
                        }
                        if ($part->price_updated_at < $lastTime && $part->price == 0) {
                            $color = 'text-red-600';
                        }
                        if ($part->price_updated_at > $lastTime && $part->price > 0) {
                            $color = 'text-black';
                        }
                    @endphp
                    <tr class="table-tb-tr group {{ $loop->even ? 'bg-sky-100' : '' }}">
                        <td class="table-tr-td border-t-0 border-l-0">
                            <input type="checkbox" value="{{ $part->id }}"
                                   class="checkboxes w-4 h-4 focus:ring-blue-500 focus:ring-2 focus:ring-offset-1 mx-auto block">
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0 whitespace-normal">
                            <p class="{{ $color }}">
                                {{ $part->name }}
                                @if($part->percent_submit)
                                    <br>
                                    <span class="text-xs text-black">(قیمت این محصول یک بار بیشتر از 50 درصد وارد شده، برای تایید دوباره قیمت را وارد کنید)</span>
                                @endif
                            </p>
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ $part->unit }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            @if($part->old_price > 0)
                                {{ number_format($part->old_price) }} تومان
                            @else
                                -
                            @endif
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            <div class="flex items-center space-x-2 space-x-reverse">
                                <input type="text" class="input-text text-center w-32" id="inputPrice{{ $part->id }}"
                                       name="prices[]" onkeyup="showPrice({{ $part->id }})"
                                       value="{{ $part->price ?? '' }}">
                                <span class="text-xs" id="priceSection{{ $part->id }}">
                                    {{ number_format($part->price) ?? '0' }} تومان
                                </span>
                                <input type="hidden" name="parts[]" value="{{ $part->id }}">
                            </div>
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            <input type="text" class="input-text w-16 text-center"
                                   id="inputWeight{{ $part->id }}"
                                   name="weights[]" value="{{ $part->weight }}">
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            @if(!is_null($part->price_updated_at))
                                {{ jdate($part->price_updated_at)->format('%A, %d %B %Y') }}
                            @else
                                ثبت نشده!
                            @endif
                        </td>
                        <td class="table-tr-td border-t-0 border-r-0">
                            <button type="button" class="table-warning-btn {{ $color }}"
                                    onclick="updateDate({{ $part->id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z"/>
                                </svg>
                                بروزرسانی
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="flex items-center space-x-4 space-x-reverse mt-4 sticky bottom-4">
            <button type="submit" class="form-submit-btn">
                ثبت قیمت
            </button>
            <button type="button" class="form-detail-btn deleteAllBtn">
                بروزرسانی تاریخ (انتخاب شده‌ها)
            </button>
        </div>

        <div class="mt-4 ml-2">
            {{ $parts->links() }}
        </div>
    </form>
</x-layout>
