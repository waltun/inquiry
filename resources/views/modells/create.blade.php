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
                    <a href="{{ route('groups.index') }}"
                       class="mr-2 text-xs md:text-sm font-medium text-gray-500 hover:text-gray-900">
                        مدیریت گروه ها
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
                    <a href="{{ route('modells.index',$group->id) }}"
                       class="mr-2 text-xs md:text-sm font-medium text-gray-500 hover:text-gray-900">
                        لیست مدل های گروه {{ $group->name }}
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
                        ایجاد مدل جدید برای گروه {{ $group->name }}
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('modells.store',$group->id) }}" class="md:grid grid-cols-2 gap-4 mt-4">
        @csrf

        <div class="col-span-2 flex justify-center">
            <span
                class="text-lg text-center font-bold text-black bg-white p-4 rounded-md shadow-md border border-gray-200">
                شما در حال ایجاد مدل جدید برای گروه <span class="text-red-600">{{ $group->name }}</span> با کد <span
                    class="text-red-600">{{ $group->code }}</span> می باشید
            </span>
        </div>

        <div class="bg-white shadow-sm p-4 rounded-md border border-gray-200 mb-4 md:mb-0">
            <p class="md:text-sm text-xs text-black font-bold border-b-2 border-teal-400 pb-3">مشخصات کلی</p>
            <div class="mt-4">
                <label for="inputName" class="block mb-2 md:text-sm text-xs text-black">نام مدل</label>
                <input type="text" id="inputName" name="name" class="input-text" placeholder="مثال : 200"
                       value="{{ old('name') }}">
            </div>
            @if(request()->has('parent'))
                <div class="mt-4">
                    <label for="inputParent" class="block mb-2 md:text-sm text-xs text-black">
                        مدل مرتبط
                    </label>
                    @php
                        $modell = \App\Models\Modell::find(request('parent'));
                    @endphp
                    <input type="text" class="input-text bg-gray-200 cursor-not-allowed"
                           value="{{ $modell->name }}" disabled>
                    <input type="hidden" name="parent_id" value="{{ $modell->id }}">
                </div>
            @endif
        </div>

        <div class="bg-white shadow-sm p-4 rounded-md border border-gray-200 mb-4 md:mb-0">
            <p class="md:text-sm text-xs text-black font-bold border-b-2 border-teal-400 pb-3">کد</p>
            <div class="mt-4">
                <label for="inputCode" class="block mb-2 md:text-sm text-xs text-black">کد مدل</label>
                <input type="text" id="inputCode" name="code" class="input-text" placeholder="مثال : 01"
                       value="{{ $code }}">
            </div>

            <div class="mt-4">
                <label for="inputPercent" class="block mb-2 md:text-sm text-xs text-black">ضریب پیش فرض</label>
                <input type="text" id="inputPercent" name="percent" class="input-text" placeholder="مثال : 1.6"
                       value="{{ old('percent') }}">
            </div>

            <div class="mt-4">
                <label for="inputPercent" class="block mb-2 md:text-sm text-xs text-black">محصول استاندارد</label>
                <select name="standard" id="inputStandard" class="input-text">
                    <option value="">انتخاب کنید</option>
                    <option value="0">نباشد</option>
                    <option value="1">باشد</option>
                </select>
            </div>
        </div>

        <div class="col-span-2 space-x-2 space-x-reverse">
            <button type="submit" class="form-submit-btn">
                ثبت مدل
            </button>
            <a href="{{ route('modells.index',$group->id) }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>
