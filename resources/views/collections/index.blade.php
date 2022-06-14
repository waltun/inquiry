<x-layout>
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
            <li aria-current="page">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                              clip-rule="evenodd"/>
                    </svg>
                    <span class="mr-2 text-xs md:text-sm font-medium text-gray-400">
                        مدیریت مجموعه ها
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Navigation Btn -->
    <div class="mt-4 flex justify-between items-center space-x-4 space-x-reverse">
        <div>
            <p class="text-lg text-black font-bold">
                لیست مجموعه ها
            </p>
        </div>
        <div>
            <a href="{{ route('collections.create') }}" class="form-submit-btn text-xs">ایجاد مجموعه جدید</a>
        </div>
    </div>

    <!-- Search -->
    <div
        class="mt-4" {{ request()->has('code') || request()->has('search') ? "x-data={open:true}" : "x-data={open:false}" }}>
        <div class="bg-white p-4 shadow-md rounded-md border border-gray-200">
            <div class="flex justify-between items-center cursor-pointer" @click="open = !open">
                <p class="font-bold text-black">
                    جستجو بین مجموعه ها
                </p>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transform transition-transform" fill="none"
                     viewBox="0 0 24 24" :class="{'rotate-180' : open}"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                </svg>
            </div>

            <div class="mt-4 md:grid grid-cols-2 gap-4" x-show="open" x-cloak>
                <form class="bg-white rounded-md p-4 shadow-sm border border-gray-200 mb-4 md:mb-0">
                    <div class="mb-4">
                        <label for="inputSearchCode" class="block mb-2 md:text-sm text-xs text-black">
                            جستجو براساس کد قطعه
                        </label>
                        <input type="text" id="inputSearchCode" name="code" class="input-text"
                               placeholder="مثال : 500" value="{{ request('code') }}">
                    </div>
                    <div class="flex justify-end">
                        <button class="form-submit-btn" type="submit">
                            جستجو
                        </button>
                    </div>
                </form>
                <form class="bg-white rounded-md p-4 shadow-sm border border-gray-200 mb-4">
                    <div class="mb-4">
                        <label for="inputSearch" class="block mb-2 md:text-sm text-xs text-black">
                            جستجو براساس نام، واحد یا قیمت
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
            </div>

            @if(request()->has('code') || request()->has('search'))
                <div class="mt-4">
                    <a href="{{ route('collections.index') }}" class="form-detail-btn text-xs">
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
                    <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                        کد
                    </th>
                    <th scope="col" class="relative px-4 py-3">
                        <span class="sr-only">قطعات</span>
                    </th>
                    <th scope="col" class="relative px-4 py-3">
                        <span class="sr-only">مقادیر</span>
                    </th>
                    <th scope="col" class="relative px-4 py-3 rounded-l-md">
                        <span class="sr-only">اقدامات</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($collections as $collection)
                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-gray-500 text-center">{{ $loop->index + 1 }}</p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-black text-center">{{ $collection->name }}</p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-black text-center">{{ $collection->unit }}</p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            @if($collection->price)
                                <p class="text-sm text-black text-center">
                                    {{ number_format($collection->price) }} تومان
                                </p>
                            @else
                                <p class="text-sm text-red-600 text-center">
                                    منتظر ثبت قطعات
                                </p>
                            @endif
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-black text-center">{{ $collection->code }}</p>
                        </td>
                        <td class="px-4 py-3 space-x-3 space-x-reverse">
                            <a href="{{ route('collections.parts.index',$collection->id) }}"
                               class="form-submit-btn text-xs">
                                افزودن قطعه
                            </a>
                            <a href="{{ route('collections.parts',$collection->id) }}" class="form-detail-btn text-xs">
                                قطعات
                            </a>
                        </td>
                        <td class="px-4 py-3 space-x-3 space-x-reverse">
                            <a href="{{ route('collections.amounts',$collection->id) }}"
                               class="form-submit-btn text-xs">
                                مقادیر
                            </a>
                        </td>
                        <td class="px-4 py-3 space-x-3 space-x-reverse">
                            <a href="{{ route('collections.edit',$collection->id) }}" class="form-edit-btn text-xs">
                                ویرایش
                            </a>
                            <form action="{{ route('collections.destroy',$collection->id) }}" method="POST"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="form-cancel-btn text-xs" onclick="return confirm('مجموعه حذف شود ؟')">
                                    حذف
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile List -->
        <div class="block md:hidden">
            @foreach($collections as $collection)
                <div class="bg-white rounded-md p-4 border border-gray-200 shadow-sm mb-4 relative z-30">
                    <span
                        class="absolute right-2 top-2 p-2 w-6 h-6 rounded-full bg-indigo-300 text-black text-xs grid place-content-center font-bold">
                        {{ $loop->index+1 }}
                    </span>
                    <div class="space-y-4">
                        <p class="text-xs text-black text-center">
                            نام : {{ $collection->name }}
                        </p>
                        <p class="text-xs text-black text-center">
                            واحد : {{ $collection->unit }}
                        </p>
                        @if($collection->price)
                            <p class="text-xs text-black text-center">
                                قیمت : {{ number_format($collection->price) }} تومان
                            </p>
                        @else
                            <p class="text-xs text-red-600 text-center">
                                قیمت : منتظر ثبت قطعات
                            </p>
                        @endif
                        <p class="text-xs text-black text-center">
                            کد : {{ $collection->code }}
                        </p>
                        <div class="flex w-full justify-between">
                            <a href="{{ route('collections.edit',$collection->id) }}" class="form-edit-btn text-xs">
                                ویرایش
                            </a>
                            <a href="{{ route('collections.parts.index',$collection->id) }}" class="form-submit-btn text-xs">
                                افزودن قطعه
                            </a>
                            <a href="{{ route('collections.parts',$collection->id) }}" class="form-detail-btn text-xs">
                                قطعات
                            </a>
                            <a href="{{ route('collections.amounts',$collection->id) }}" class="form-edit-btn text-xs">
                                مقادیر
                            </a>
                            <form action="{{ route('collections.destroy',$collection->id) }}" method="POST"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="form-cancel-btn text-xs" onclick="return confirm('مجموعه حذف شود ؟')">
                                    حذف
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
