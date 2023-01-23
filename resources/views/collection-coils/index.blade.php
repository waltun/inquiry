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
                        مدیریت مجموعه های کویل و دمپر
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Navigation Btn -->
    <div class="mt-4 flex justify-between items-center space-x-4 space-x-reverse">
        <div>
            <p class="text-lg text-black font-bold">
                لیست مجموعه های کویل و دمپر
            </p>
        </div>
        <div>
            <a href="{{ route('parts.index') }}" class="form-detail-btn text-xs">لیست قطعات</a>
            <a href="{{ route('collections.index') }}" class="form-edit-btn text-xs">لیست مجموعه ها</a>
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
                    <a href="{{ route('collectionCoil.index') }}" class="form-detail-btn text-xs">
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
                        استعلام مربوطه
                    </th>
                    <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                        واحد
                    </th>
                    <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                        قیمت
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
                @foreach($parts as $part)
                    @php
                        if(!is_null($part->inquiry_id)) {
                            $inquiry = \App\Models\Inquiry::find($part->inquiry_id);
                        }
                    @endphp
                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <input type="checkbox" value="{{ $part->id }}"
                                   class="checkboxes w-4 h-4 focus:ring-blue-500 focus:ring-2 focus:ring-offset-1 mx-auto block">
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-black text-center" dir="ltr">{{ $part->name }}</p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-black text-center" dir="ltr">
                                @if(isset($inquiry))
                                    @if(!is_null($inquiry->inquiry_number))
                                        INQ-{{ $inquiry->inquiry_number }} ({{ $inquiry->name }})
                                    @else
                                        {{ $inquiry->name }}
                                    @endif
                                @else
                                    {{ $inquiry->name }}
                                @endif
                            </p>
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
                                    منتظر ثبت مقادیر
                                </p>
                            @endif
                        </td>
                        <td class="px-4 py-3 space-x-3 space-x-reverse whitespace-nowrap">
                            <a href="{{ route('collections.amounts',$part->id) }}" class="form-submit-btn text-xs">
                                مقادیر
                            </a>
                        </td>
                        <td class="px-4 py-3 space-x-3 space-x-reverse whitespace-nowrap">
                            <form action="{{ route('collections.destroy',$part->id) }}" method="POST"
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

        <!-- Delete All Button -->
        <div class="mt-4">
            <button type="button" class="deleteAllBtn form-cancel-btn">
                حذف موارد انتخاب شده
            </button>
        </div>

        <!-- Pagination -->
        <div class="my-4 md:block hidden">
            {{ $parts->links() }}
        </div>

        <!-- Parts count -->
        <div class="mt-4 mb-4">
            <p class="text-sm font-bold text-indigo-600 underline underline-offset-4">
                تعداد کل قطعات مجموعه کویل سازی
                : {{ \App\Models\Part::where('collection',true)->where('coil',true)->count() }}
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
                        <p class="text-xs text-green-600 text-center font-medium">
                            @if($part->price)
                                قیمت : {{ number_format($part->price) }}
                            @else
                                قیمت : منتظر ثبت مقادیر
                            @endif
                        </p>
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
                            <a href="{{ route('collections.parts',$part->id) }}" class="form-detail-btn text-xs">
                                قطعات
                            </a>
                            <a href="{{ route('collections.amounts',$part->id) }}" class="form-submit-btn text-xs">
                                مقادیر
                            </a>
                            <form action="{{ route('collections.replicate',$part->id) }}" method="POST"
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
        </div>
    </div>
</x-layout>
