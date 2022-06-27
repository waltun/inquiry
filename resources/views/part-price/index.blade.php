<x-layout>
    <x-slot name="js">
        <script>
            function showPrice(id) {
                let input = document.getElementById("inputPrice" + id);
                let section = document.getElementById("priceSection" + id);
                section.innerText = new Intl.NumberFormat().format(input.value) + ' تومان ';
            }
        </script>
    </x-slot>
    <!-- Breadcrumb -->
    <nav class="flex bg-gray-100 p-4 rounded-md" aria-label="Breadcrumb">
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
    <div class="mt-4">
        <div class="bg-white p-4 shadow-md rounded-md border border-gray-200">
            <div class="md:grid grid-cols-3 gap-4">
                <form class="bg-white rounded-md p-4 shadow-sm border border-gray-200 mb-4 md:mb-0">
                    <div class="mb-4">
                        <label for="inputSearchCode" class="block mb-2 md:text-sm text-xs text-black">
                            جستجو براساس کد قطعه
                        </label>
                        <input type="text" id="inputSearchCode" name="code" class="input-text"
                               placeholder="مثال : 45" value="{{ request('code') }}">
                    </div>
                    <div class="flex justify-end">
                        <button class="form-submit-btn" type="submit">
                            جستجو
                        </button>
                    </div>
                </form>
                <form class="bg-white rounded-md p-4 shadow-sm border border-gray-200 mb-4 md:mb-0">
                    <div class="mb-4">
                        <label for="inputSearch" class="block mb-2 md:text-sm text-xs text-black">
                            جستجو براساس نام یا قیمت
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

                <form class="bg-white rounded-md p-4 shadow-sm border border-gray-200 mb-4 md:mb-0">
                    <div class="mb-4">
                        <label for="inputCategory" class="block mb-2 md:text-sm text-xs text-black">
                            جستجو براساس دسته بندی
                        </label>
                        <select name="category" id="inputCategory" class="input-text">
                            <option value="">انتخاب کنید</option>
                            @foreach($categories as $category)
                                <option
                                    value="{{ $category->id }}" {{ $category->id == request('category') ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button class="form-submit-btn" type="submit">
                            جستجو
                        </button>
                    </div>
                </form>
            </div>

            @if(request()->has('code') || request()->has('search') || request()->has('category'))
                <div class="mt-4">
                    <a href="{{ route('parts.price.index') }}" class="form-detail-btn text-xs">
                        پاکسازی جستجو
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Content -->
    <div class="mt-4">
        <!-- Laptop List -->
        <form action="{{ route('parts.price.update') }}" method="POST"
              class="overflow-x-auto rounded-lg hidden md:block">
            @csrf
            @method('PATCH')

            <table class="min-w-full bg-white shadow">
                <thead>
                <tr class="bg-sky-200">
                    <th scope="col"
                        class="px-4 py-3 text-sm font-bold text-gray-800 text-center rounded-r-md">
                        کد
                    </th>
                    <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                        نام
                    </th>
                    <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                        واحد
                    </th>
                    <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                        قیمت (تومان)
                    </th>
                    <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                        نمایش قیمت (تومان)
                    </th>
                    <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                        آخرین بروزرسانی
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($parts as $part)
                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-gray-500 text-center">{{ $part->code }}</p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-black text-center">{{ $part->name }}</p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-black text-center">{{ $part->unit }}</p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <input type="text" class="input-text" id="inputPrice{{ $part->id }}" name="prices[]"
                                   value="{{ $part->price ?? '' }}" onkeyup="showPrice({{ $part->id }})">
                            <input type="hidden" name="parts[]" value="{{ $part->id }}">
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-black text-center" id="priceSection{{ $part->id }}">
                                {{ number_format($part->price) ?? '0' }} تومان
                            </p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-black text-center">
                                {{ jdate($part->updated_at)->format('%A, %d %B %Y') }}
                            </p>
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

        </form>

        <!-- Mobile List -->
        <form action="{{ route('parts.price.update') }}" class="block md:hidden" method="POST">
            @csrf
            @method('PATCH')

            @foreach($parts as $part)
                <div class="bg-white rounded-md p-4 border border-gray-200 shadow-sm mb-4 relative z-30">
                    <span
                        class="absolute right-2 top-2 p-2 w-6 h-6 rounded-full bg-indigo-300 text-black text-xs grid place-content-center font-bold">
                        {{ $part->code }}
                    </span>
                    <div class="space-y-4">
                        <p class="text-xs text-black text-center">
                            نام : {{ $part->name }}
                        </p>
                        <p class="text-xs text-black text-center">
                            واحد : {{ $part->unit }}
                        </p>
                        <p class="text-xs text-black text-center">
                            <input type="text" name="prices[]" class="input-text" id="inputPrice{{ $part->id }}"
                                   value="{{ $part->price ?? '' }}">
                            <input type="hidden" value="{{ $part->id }}" name="parts[]">
                        </p>
                        <p class="text-xs text-black text-center">
                            اخرین بروزرسانی : {{ jdate($part->updated_at)->format('%A, %d %B %Y') }}
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
