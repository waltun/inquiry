<x-layout>
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
            <li aria-current="page">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                              clip-rule="evenodd"/>
                    </svg>
                    <span class="mr-2 text-xs md:text-sm font-medium text-gray-400">
                        مدیریت قطعات
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Navigation Btn -->
    <div class="mt-4 flex justify-between items-center space-x-4 space-x-reverse">
        <div>
            <p class="text-lg text-black font-bold">
                لیست قطعات
            </p>
        </div>
        <div>
            <a href="{{ route('parts.create') }}" class="form-submit-btn text-xs">ایجاد قطعه جدید</a>
            <a href="{{ route('collections.index') }}" class="form-detail-btn text-xs">لیست مجموعه ها</a>
        </div>
    </div>

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
                    <a href="{{ route('parts.index') }}" class="form-detail-btn text-xs">
                        پاکسازی جستجو
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Content -->
    <div class="mt-4 space-y-4">

        <!-- Laptop List -->
        <div class="shadow overflow-x-auto rounded-lg hidden md:block">
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
                            <p class="text-sm text-black text-center">{{ $part->name }}</p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-black text-center">{{ $part->unit }}</p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            @if($part->price)
                                <p class="text-sm text-black text-center">
                                    {{ number_format($part->price) }} تومان
                                </p>
                            @else
                                <p class="text-sm text-red-600 text-center">
                                    منتظر قیمت گذاری
                                </p>
                            @endif
                        </td>
                        @php
                            $code = '';
                            foreach($part->categories as $category){
                                $code = $code . $category->code;
                            }

                        @endphp
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-black text-center">
                                {{ $code . "-" . $part->code }}
                            </p>
                        </td>
                        <td class="px-4 py-3 space-x-3 space-x-reverse whitespace-nowrap">
                            <a href="{{ route('parts.edit',$part->id) }}" class="form-edit-btn text-xs">
                                ویرایش
                            </a>
                            <form action="{{ route('parts.replicate',$part->id) }}" method="POST"
                                  class="inline">
                                @csrf
                                <button class="form-detail-btn text-xs">
                                    کپی
                                </button>
                            </form>
                            <form action="{{ route('parts.destroy',$part->id) }}" method="POST"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="form-cancel-btn text-xs" onclick="return confirm('قطعه حذف شود ؟')">
                                    حذف
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="my-4 md:block hidden">
            {{ $parts->links() }}
        </div>

        <!-- Parts count -->
        <div class="my-4">
            <p class="text-sm font-bold text-indigo-600 underline underline-offset-4">
                تعداد کل قطعات : {{ \App\Models\Part::where('collection',false)->count() }}
            </p>
        </div>

        <!-- Mobile List -->
        <div class="block md:hidden">
            @foreach($parts as $part)
                <div class="bg-white rounded-md p-4 border border-gray-200 shadow-md mb-4 relative z-30">
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
                            <p class="text-xs text-green-600 text-center font-bold">
                                قیمت : {{ number_format($part->price) }}
                            </p>
                        @else
                            <p class="text-xs text-red-600 text-center">
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
                        <div class="flex w-full justify-between">
                            <a href="{{ route('parts.edit',$part->id) }}" class="form-edit-btn text-xs">
                                ویرایش
                            </a>
                            <form action="{{ route('parts.replicate',$part->id) }}" method="POST"
                                  class="inline">
                                @csrf
                                <button class="form-detail-btn text-xs">
                                    کپی
                                </button>
                            </form>
                            <form action="{{ route('parts.destroy',$part->id) }}" method="POST"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="form-cancel-btn text-xs" onclick="return confirm('قطعه حذف شود ؟')">
                                    حذف
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- Pagination -->
            <div class="mt-4">
                {{ $parts->links() }}
            </div>
        </div>
    </div>
</x-layout>
