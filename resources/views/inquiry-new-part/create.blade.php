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
                input2.value = Intl.NumberFormat().format(result);
                inputValue.value = Intl.NumberFormat().format(result);
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
                    <a href="{{ route('inquiries.index') }}"
                       class="mr-2 text-xs md:text-sm font-medium text-gray-500 hover:text-gray-900">
                        مدیریت استعلام ها
                    </a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                              clip-rule="evenodd"/>
                    </svg>
                    <a href="{{ route('inquiries.product.amounts',$product->id) }}"
                       class="mr-2 text-xs md:text-sm font-medium text-gray-500 hover:text-gray-900">
                        تعیین مقادیر محصول
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
                        افزودن قطعه به محصول {{ $group->name }} - {{ $product->model_custom_name ?? $modell->name }}
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Navigation Btn -->
    <div class="mt-4 md:flex justify-between">
        <div class="mb-4 md:mb-0">
            <p class="text-lg font-bold text-black">
                افزودن قطعه به محصول <span
                    class="text-red-600">{{ $group->name }} - {{ $product->model_custom_name ?? $modell->name }}</span>
            </p>
        </div>
        <div class="space-x-2 space-x-reverse">
            <a href="{{ route('inquiries.product.amounts',$product->id) }}" class="form-detail-btn text-xs">
                جزئیات محصول {{ $group->name }} - {{ $product->model_custom_name ?? $modell->name }}
            </a>
            <a href="{{ route('inquiries.index') }}" class="form-edit-btn text-xs">
                لیست استعلام ها
            </a>
        </div>
    </div>

    <!-- Search -->
    <div class="mt-4">
        <div class="bg-white p-4 shadow-md rounded-md border border-gray-200">
            <div class="md:grid grid-cols-4 gap-4">
                <form class="col-span-1 bg-white rounded-md p-4 shadow-sm border border-gray-200 mb-4 md:mb-0">
                    <div class="mb-4">
                        <label for="inputSearch" class="block mb-2 md:text-sm text-xs text-black">
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

                <form
                    class="col-span-3 md:grid grid-cols-3 gap-4 bg-white rounded-md p-4 shadow-sm border border-gray-200 mb-4 md:mb-0">
                    <div>
                        <label for="inputCategory1" class="block mb-2 md:text-sm text-xs text-black">دسته بندی
                            قطعه</label>
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

            </div>

            @if(request()->has('search') || request()->has('category1') || request()->has('category2') || request()->has('category3'))
                <div class="mt-4">
                    <a href="{{ route('inquiries.newPart.create',$product->id) }}" class="form-detail-btn text-xs">
                        پاکسازی جستجو
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Content -->
    <div class="mt-4">
        <!-- Laptop List -->
        <div class="bg-white shadow overflow-x-auto rounded-lg hidden md:block">
            <table class="min-w-full">
                <thead>
                <tr class="bg-sky-200">
                    <th scope="col"
                        class="px-4 py-3 text-sm font-bold text-gray-800 text-center rounded-r-md">
                        #
                    </th>
                    <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                        نام
                    </th>
                    <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                        واحد
                    </th>
                    <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                        قیمت
                    </th>
                    <th scope="col" class="relative px-4 py-3 rounded-l-md">
                        <span class="sr-only">اقدامات</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($parts as $part)
                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-gray-500 text-center">{{ $loop->index + 1 }}</p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-black text-center font-medium">{{ $part->name }}</p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-black text-center">{{ $part->unit }}</p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            @if($part->price)
                                <p class="text-sm text-black text-center font-medium">
                                    {{ number_format($part->price) }} تومان
                                </p>
                            @else
                                <p class="text-sm text-red-600 text-center font-medium">
                                    منتظر قیمت گذاری
                                </p>
                            @endif
                        </td>
                        <td class="px-4 py-3 space-x-3 space-x-reverse whitespace-nowrap">
                            <div x-data="{open:false}">
                                <button class="form-submit-btn text-xs" @click="open=!open" type="button">
                                    افزودن
                                </button>
                                <div class="relative z-10" x-show="open" x-cloak>
                                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                                    <div class="fixed z-10 inset-0 overflow-y-auto">
                                        <div
                                            class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">
                                            <form method="POST"
                                                  action="{{ route('inquiries.newPart.store',[$product->id,$part->id]) }}"
                                                  class="relative bg-white rounded-lg text-right overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-lg sm:w-full">
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
