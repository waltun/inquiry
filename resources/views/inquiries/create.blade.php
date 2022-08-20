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
            <li aria-current="page">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                              clip-rule="evenodd"/>
                    </svg>
                    <span class="mr-2 text-xs md:text-sm font-medium text-gray-400">
                        ایجاد استعلام جدید
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
    <form method="POST" action="{{ route('inquiries.store') }}" class="md:grid grid-cols-2 gap-4 mt-4">
        @csrf

        <div class="bg-white shadow-sm p-4 rounded-md border border-gray-200 mb-4 md:mb-0">
            <p class="md:text-sm text-xs text-black font-bold border-b-2 border-teal-400 pb-3">مشخصات کلی</p>

            <div class="mt-4">
                <label for="inputName" class="block mb-2 md:text-sm text-xs text-black">نام پروژه</label>
                <input type="text" id="inputName" name="name" class="input-text"
                       placeholder="مثال : پروژه نفتی جنوب" value="{{ old('name') }}">
            </div>

        </div>

        <div class="bg-white shadow-sm p-4 rounded-md border border-gray-200 mb-4 md:mb-0">
            <p class="md:text-sm text-xs text-black font-bold border-b-2 border-teal-400 pb-3">بازاریاب</p>

            <div class="mt-4">
                <label for="inputMarketer" class="block mb-2 md:text-sm text-xs text-black">نام بازاریاب</label>
                <input type="text" id="inputMarketer" name="marketer" class="input-text"
                       placeholder="مثال : احمد رضایی" value="{{ old('marketer') }}">
            </div>
        </div>

        <div class="col-span-2 space-x-2 space-x-reverse">
            <button type="submit" class="form-submit-btn">
                ثبت استعلام
            </button>
            <a href="{{ route('inquiries.index') }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>
