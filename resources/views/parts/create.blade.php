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
                            <select class="input-text" onchange="getCategory2()" id="inputCategory2" name="categories[]">
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
                            <select class="input-text" name="categories[]" id="inputCategory3">
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
                        ایجاد قطعه جدید
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Alert -->
    <div class="mt-4">
        <div class="bg-yellow-500 rounded-md p-4" x-data="{ open:false }">
            <div class="flex justify-between items-center cursor-pointer" @click="open = !open">
                <p class="text-xs md:text-sm text-black">نکات قابل توجه</p>
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="md:h-5 md:w-5 h-4 w-4 transition-transform transform text-black"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" :class="{'rotate-180' : open}">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"/>
                </svg>
            </div>
            <div class="bg-yellow-500 rounded-b-md mt-4" x-show="open" x-cloak>
                <ul class="list-disc mr-4 space-y-2">
                    <li class="text-xs md:text-sm text-black">تمامی فیلد های موجود برای اضافه کردن کاربر جدید ضروری می
                        باشد.
                    </li>
                    <li class="text-xs md:text-sm text-black">شماره تماس 11 رقم و با صفر شروع می شود.</li>
                    <li class="text-xs md:text-sm text-black">رمز عبور حداقل باید 8 رقم یا حرف باشد.</li>
                    <li class="text-xs md:text-sm text-black">کد ملی باید 10 رقم و فقط شامل عدد باشد.</li>
                    <li class="text-xs md:text-sm text-black">
                        در انتخاب نقش کاربر دقت کنید، چون هر نقش دسترسی های مختلفی دارد (البته این قسمت قابل ویرایش می
                        باشد).
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('parts.store') }}" class="md:grid grid-cols-2 gap-4 mt-4">
        @csrf

        <div class="bg-white shadow-sm p-4 rounded-md border border-gray-200 mb-4 md:mb-0">
            <p class="md:text-sm text-xs text-black font-bold border-b-2 border-teal-400 pb-3">مشخصات کلی</p>

            <div class="mt-4">
                <label for="inputName" class="block mb-2 md:text-sm text-xs text-black">نام قطعه</label>
                <input type="text" id="inputName" name="name" class="input-text"
                       placeholder="مثال : ورق گالوانیزه به ضخامت 0.3" value="{{ old('name') }}">
            </div>

            <div class="mt-4">
                <label for="inputCollection" class="block mb-2 md:text-sm text-xs text-black">قطعه مجموعه ای</label>
                <select name="collection" id="inputCollection" class="input-text">
                    <option value="false" {{ old('collection') == 'false' ? 'selected' : '' }}>نباشد</option>
                    <option value="true" {{ old('collection') == 'true' ? 'selected' : '' }}>باشد</option>
                </select>
            </div>

        </div>

        <div class="bg-white shadow-sm p-4 rounded-md border border-gray-200 mb-4 md:mb-0">
            <p class="md:text-sm text-xs text-black font-bold border-b-2 border-teal-400 pb-3">دسته بندی</p>

            <div class="mt-4">
                <label for="inputCategory1" class="block mb-2 md:text-sm text-xs text-black">دسته بندی قطعه</label>
                <select name="categories[]" id="inputCategory1" class="input-text" onchange="getCategory1()">
                    <option value="">انتخاب کنید</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4" id="categorySection1">

            </div>
            <div class="mt-4" id="categorySection2">

            </div>
        </div>

        <div class="bg-white shadow-sm p-4 rounded-md border border-gray-200 mb-4 md:mb-0 col-span-2">
            <p class="md:text-sm text-xs text-black font-bold border-b-2 border-teal-400 pb-3">واحد و تبدیل واحد</p>

            <div class="grid grid-cols-2 gap-4">
                <div class="mt-4">
                    <label for="inputUnit" class="block mb-2 md:text-sm text-xs text-black">واحد اول قطعه</label>
                    <input type="text" id="inputUnit" name="unit" class="input-text" placeholder="مثال : کیلوگرم"
                           value="{{ old('unit') }}">
                </div>

                <div class="mt-4">
                    <label for="inputUnit2" class="block mb-2 md:text-sm text-xs text-black">واحد دوم قطعه</label>
                    <input type="text" id="inputUnit2" name="unit2" class="input-text" placeholder="مثال : متر"
                           value="{{ old('unit2') }}">
                </div>

                <div class="mt-4 flex items-center space-x-4 space-x-reverse">
                    <p class="md:text-sm text-xs text-black whitespace-nowrap">
                        واحد اول = واحد دوم
                    </p>
                    <select name="operator1" id="inputOperator1" class="input-text w-20">
                        <option value="*">x</option>
                        <option value="/">/</option>
                        <option value="+">+</option>
                        <option value="-">-</option>
                    </select>
                    <input type="text" class="input-text" id="inputFormula1" name="formula1">
                </div>

                <div class="mt-4 flex items-center space-x-4 space-x-reverse">
                    <p class="md:text-sm text-xs text-black whitespace-nowrap">
                        واحد دوم = واحد اول
                    </p>
                    <select name="operator2" id="inputOperator2" class="input-text w-20">
                        <option value="*">x</option>
                        <option value="/">/</option>
                        <option value="+">+</option>
                        <option value="-">-</option>
                    </select>
                    <input type="text" class="input-text" id="inputFormula2" name="formula2">
                </div>
            </div>

        </div>

        <div class="col-span-2 space-x-2 space-x-reverse">
            <button type="submit" class="form-submit-btn">
                ثبت قطعه
            </button>
            <a href="{{ route('parts.index') }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>
