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
                            <label for="inputCategory" class="block mb-2 md:text-sm text-xs text-black">زیر دسته</label>
                            <select class="input-text text-xs" onchange="getCategory2()" id="inputCategory2" name="category2">
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
                            <select class="input-text text-xs" name="category3" id="inputCategory3">
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
    </x-slot>

    <!-- Breadcrumb -->
    <nav class="flex bg-gray-100 p-4 rounded-md overflow-x-auto whitespace-nowrap" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-2 space-x-reverse">
            <li class="inline-flex items-center">
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center text-xs md:text-sm text-gray-500 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20"
                         fill="currentColor">
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                    داشبورد
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                              clip-rule="evenodd"/>
                    </svg>
                    <a href="{{ route('parts.index') }}"
                       class="mr-2 text-xs md:text-sm font-medium text-gray-500 hover:text-gray-900">
                        مدیریت قطعات
                    </a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                              clip-rule="evenodd"/>
                    </svg>
                    <span class="mr-2 text-xs md:text-sm font-medium text-gray-400">
                        مدیریت قیمت قطعات
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Search -->
    <div class="mt-4 grid grid-cols-3 gap-4">
        <div class="bg-white p-4 shadow-md rounded-md border border-gray-200">
            <form>
                <div class="mb-4">
                    <label for="inputSearch" class="block mb-2 md:text-sm text-xs text-black">
                        جستجو براساس نام
                    </label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <input type="text" name="search" id="inputSearch" class="input-text rounded-none rounded-r-md"
                               placeholder="مثال : پیچ" value="{{ request('search') }}">
                        <button type="submit"
                                class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-sm text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                @if(request()->has('search'))
                    <div>
                        <a href="{{ route('parts.price.index') }}"
                           class="bg-yellow-500 inline-block p-1 rounded-full text-white shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3"/>
                            </svg>
                        </a>
                    </div>
                @endif
            </form>
        </div>
        <div class="bg-white p-4 shadow-md rounded-md border border-gray-200">
            <form>
                <div class="mb-4">
                    <label for="inputSearchPrice" class="block mb-2 md:text-sm text-xs text-black">
                        جستجو براساس قیمت
                    </label>
                    <select name="price" id="inputSearchPrice" class="input-text">
                        <option value="">انتخاب کنید</option>
                        <option value="no-price" {{ request('price') == '0' ? 'selected' : '' }} class="bg-red-600">
                            قطعات فاقد قیمت
                        </option>
                        <option value="success-price"
                                {{ request('price') == '1' ? 'selected' : '' }} class="bg-green-500">
                            قطعات قیمت به روز
                        </option>
                        <option value="expired-price"
                                {{ request('price') == '1' ? 'selected' : '' }} class="bg-red-400">
                            قطعات قیمت منقضی شده
                        </option>
                        <option value="mid-price" {{ request('price') == '1' ? 'selected' : '' }} class="bg-yellow-500">
                            قطعات قیمت مشکوک
                        </option>
                    </select>
                </div>
                <div class="flex items-center justify-end">
                    <button type="submit"
                            class="rounded-full bg-gray-200 p-1 text-black shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                        </svg>
                    </button>
                    @if(request()->has('price'))
                        <div class="mx-2">
                            <a href="{{ route('parts.price.index') }}"
                               class="bg-yellow-500 block p-1 rounded-full text-white shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3"/>
                                </svg>
                            </a>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-black underline-offset-4 underline">
                                تعداد :
                            </p>
                        </div>
                    @endif
                </div>
            </form>
        </div>
        <div class="bg-white p-4 shadow-md rounded-md border border-gray-200">
            <form class="grid grid-cols-3 gap-2">
                <div>
                    <label for="inputCategory1" class="block mb-2 md:text-sm text-xs text-black">دسته بندی
                        قطعه</label>
                    <select name="category1" id="inputCategory1" class="input-text text-xs" onchange="getCategory1()">
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
                <div class="col-span-3 flex justify-end space-x-2 space-x-reverse">
                    <button type="submit"
                            class="rounded-full bg-gray-200 p-1 text-black shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                        </svg>
                    </button>
                    @if(request()->has('category1') || request()->has('category2') || request()->has('category3'))
                        <div>
                            <a href="{{ route('parts.price.index') }}"
                               class="bg-yellow-500 block p-1 rounded-full text-white shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3"/>
                                </svg>
                            </a>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="mt-4">
        <p class="text-sm font-bold text-red-500">
            * توجه : در صورت عدم تغییر قیمت در بازه زمانی تعریف شده، فقط دکمه بروزرسانی زده شود.
        </p>
    </div>

    <!-- Content -->
    <div class="mt-4">
        <!-- Laptop List -->
        <form action="{{ route('parts.price.update') }}" method="POST"
              class="overflow-x-auto rounded-lg hidden md:block">
            @csrf
            @method('PATCH')

            <table class="min-w-full bg-white shadow border border-gray-200">
                <thead>
                <tr class="bg-sky-200">
                    <th scope="col"
                        class="px-4 py-3 text-sm font-bold text-gray-800 text-center rounded-r-md">
                        ردیف
                    </th>
                    <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                        نام
                    </th>
                    <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                        قیمت قبلی
                    </th>
                    <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                        قیمت (تومان)
                    </th>
                    <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                        آخرین بروزرسانی
                    </th>
                    <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                        <span class="sr-only">بروزرسانی تاریخ</span>
                    </th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-300">
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
                            $color = 'bg-red-500';
                        }
                        if ($part->price_updated_at > $lastTime && $part->price_updated_at > $midTime && $part->price > 0) {
                            $color = 'bg-green-500';
                        }
                        if ($part->price_updated_at > $lastTime && $part->price_updated_at < $midTime && $part->price > 0) {
                            $color = 'bg-yellow-500';
                        }
                        if ($part->price_updated_at < $lastTime && $part->price == 0) {
                            $color = 'bg-red-600';
                        }
                    @endphp
                    <tr class="{{ $color }}">
                        <td class="px-4 py-1 whitespace-nowrap">
                            <p class="text-sm text-gray-500 text-center">{{ $loop->index + 1 }}</p>
                        </td>
                        <td class="px-4 py-1 whitespace-nowrap">
                            <p class="text-sm text-black text-center font-medium">{{ $part->name }}</p>
                        </td>
                        <td class="px-4 py-1 whitespace-nowrap">
                            @if($part->old_price > 0)
                                <p class="text-sm text-black text-center font-medium">
                                    {{ number_format($part->old_price) }} تومان
                                </p>
                            @else
                                <p class="text-sm text-black text-center font-medium">
                                    قیمت قبلی ثبت نشده!
                                </p>
                            @endif
                        </td>
                        <td class="px-4 py-1 whitespace-nowrap">
                            <input type="text" class="input-text w-44 py-0.5" id="inputPrice{{ $part->id }}"
                                   name="prices[]"
                                   value="{{ $part->price ?? '' }}" onkeyup="showPrice({{ $part->id }})">
                            <span class="text-sm text-black text-center font-medium" id="priceSection{{ $part->id }}">
                                {{ number_format($part->price) ?? '0' }} تومان
                            </span>
                            <input type="hidden" name="parts[]" value="{{ $part->id }}">
                        </td>
                        <td class="px-4 py-1 whitespace-nowrap">
                            <p class="text-sm text-black text-center">
                                {{ jdate($part->price_updated_at)->format('%A, %d %B %Y') }}
                            </p>
                        </td>
                        <td class="px-4 py-1 whitespace-nowrap">
                            <button type="button" class="form-detail-btn text-xs" onclick="updateDate({{ $part->id }})">
                                بروزرسانی تاریخ
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                <button type="submit" class="form-submit-btn">
                    ثبت قیمت
                </button>
            </div>

            <div class="mt-4 ml-2">
                {{ $parts->links() }}
            </div>

        </form>

        <!-- Mobile List -->
        <form action="{{ route('parts.price.update') }}" class="block md:hidden" method="POST">
            @csrf
            @method('PATCH')

            @foreach($parts as $part)
                <div class="bg-white rounded-md p-4 border border-gray-200 shadow-md mb-4 relative z-30">
                    <span
                        class="absolute right-2 top-2 p-2 w-6 h-6 rounded-full bg-indigo-300 text-black text-xs grid place-content-center font-bold">
                        {{ $loop->index + 1 }}
                    </span>
                    <div class="space-y-4">
                        <p class="text-xs text-black text-center font-bold">
                            {{ $part->name }}
                        </p>
                        <p class="text-xs text-black text-center">
                            واحد : {{ $part->unit }}
                        </p>
                        <div>
                            <input type="text" name="prices[]" class="input-text" id="inputPrice{{ $part->id }}"
                                   value="{{ $part->price ?? '' }}" onkeyup="showPrice({{ $part->id }})">
                            <input type="hidden" value="{{ $part->id }}" name="parts[]">
                        </div>
                        <p class="text-xs text-green-600 font-medium text-center" id="priceSection{{ $part->id }}">
                            {{ number_format($part->price) ?? '0' }} تومان
                        </p>
                        <p class="text-xs text-black text-center">
                            اخرین بروزرسانی : {{ jdate($part->price_updated_at)->format('%A, %d %B %Y') }}
                        </p>
                    </div>
                </div>
            @endforeach

            <div class="mt-4">
                <button type="submit" class="form-submit-btn">
                    ثبت قیمت
                </button>
            </div>
        </form>
    </div>
</x-layout>
