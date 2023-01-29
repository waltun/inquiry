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
                    <a href="{{ route('settings.index') }}"
                       class="mr-2 text-xs md:text-sm font-medium text-gray-500 hover:text-gray-900">
                        تنظیمات
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
                    <a href="{{ route('settings.price-color.index') }}"
                       class="mr-2 text-xs md:text-sm font-medium text-gray-500 hover:text-gray-900">
                        تنظیمات دکمه‌های حذف
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
                        ویرایش تنظیمات دکمه‌های حذف
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
    <form method="POST" action="{{ route('settings.delete-button.update',$deleteButton->id) }}"
          class="md:grid grid-cols-2 gap-4 mt-4">
        @csrf
        @method('PATCH')

        <div class="col-span-2 bg-white shadow-sm p-4 rounded-md border border-gray-200 mb-4 md:mb-0">
            <p class="md:text-sm text-xs text-black font-bold border-b-2 border-teal-400 pb-3">مشخصات کلی</p>
            <div class="mt-4">
                <label for="inputParts" class="block mb-2 md:text-sm text-xs text-black">
                    دکمه های حذف بخش قطعات
                </label>
                <select name="parts" id="inputParts" class="input-text w-1/3">
                    <option value="">انتخاب کنید</option>
                    <option value="1" {{ $deleteButton->parts ? 'selected' : '' }}>
                        نمایش
                    </option>
                    <option value="0" {{ !$deleteButton->parts ? 'selected' : '' }}>
                        عدم نمایش
                    </option>
                </select>
            </div>
            <div class="mt-4">
                <label for="inputCollectionParts" class="block mb-2 md:text-sm text-xs text-black">
                    دکمه های حذف بخش کالاهای نیم ساخته
                </label>
                <select name="collection_parts" id="inputCollectionParts" class="input-text w-1/3">
                    <option value="">انتخاب کنید</option>
                    <option value="1" {{ $deleteButton->collection_parts ? 'selected' : '' }}>
                        نمایش
                    </option>
                    <option value="0" {{ !$deleteButton->collection_parts ? 'selected' : '' }}>
                        عدم نمایش
                    </option>
                </select>
            </div>
            <div class="mt-4">
                <label for="inputCollectionCoil" class="block mb-2 md:text-sm text-xs text-black">
                    دکمه های حذف بخش کویل و دمپر و مبدل و تابلو
                </label>
                <select name="collection_coil" id="inputCollectionCoil" class="input-text w-1/3">
                    <option value="">انتخاب کنید</option>
                    <option value="1" {{ $deleteButton->collection_coil ? 'selected' : '' }}>
                        نمایش
                    </option>
                    <option value="0" {{ !$deleteButton->collection_coil ? 'selected' : '' }}>
                        عدم نمایش
                    </option>
                </select>
            </div>
            <div class="mt-4">
                <label for="inputUsers" class="block mb-2 md:text-sm text-xs text-black">
                    دکمه های حذف بخش کاربران
                </label>
                <select name="users" id="inputUsers" class="input-text w-1/3">
                    <option value="">انتخاب کنید</option>
                    <option value="1" {{ $deleteButton->users ? 'selected' : '' }}>
                        نمایش
                    </option>
                    <option value="0" {{ !$deleteButton->users ? 'selected' : '' }}>
                        عدم نمایش
                    </option>
                </select>
            </div>
            <div class="mt-4">
                <label for="inputInquiries" class="block mb-2 md:text-sm text-xs text-black">
                    دکمه های حذف بخش استعلام ها
                </label>
                <select name="inquiries" id="inputInquiries" class="input-text w-1/3">
                    <option value="">انتخاب کنید</option>
                    <option value="1" {{ $deleteButton->inquiries ? 'selected' : '' }}>
                        نمایش
                    </option>
                    <option value="0" {{ !$deleteButton->inquiries ? 'selected' : '' }}>
                        عدم نمایش
                    </option>
                </select>
            </div>
            <div class="mt-4">
                <label for="inputActive" class="block mb-2 md:text-sm text-xs text-black">
                    نوع
                </label>
                <select name="active" id="inputActive" class="input-text w-1/3">
                    <option value="">انتخاب کنید</option>
                    <option value="1" {{ $deleteButton->active ? 'selected' : '' }}>فعال</option>
                    <option value="0" {{ !$deleteButton->active ? 'selected' : '' }}>غیر فعال</option>
                </select>
            </div>
        </div>

        <div class="col-span-2 space-x-2 space-x-reverse">
            <button type="submit" class="form-edit-btn">
                ویرایش تنظیمات
            </button>
            <a href="{{ route('settings.delete-button.index') }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>
