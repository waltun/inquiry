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
                        تنظیمات نمایش رنگ برای قیمت
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
                        ویرایش تنظیمات نمایش رنگ برای قیمت
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
    <form method="POST" action="{{ route('settings.price-color.update',$setting->id) }}" class="md:grid grid-cols-2 gap-4 mt-4">
        @csrf
        @method('PATCH')

        <div class="col-span-2 bg-white shadow-sm p-4 rounded-md border border-gray-200 mb-4 md:mb-0">
            <p class="md:text-sm text-xs text-black font-bold border-b-2 border-teal-400 pb-3">مشخصات کلی</p>

            <div class="mt-4">
                <label for="inputPriceColorType" class="block mb-2 md:text-sm text-xs text-black">
                    اساس نمایش رنگ‌ها در قیمت گذاری
                </label>
                <select name="price_color_type" id="inputPriceColorType" class="input-text">
                    <option value="">انتخاب کنید</option>
                    <option value="hour" {{ $setting->price_color_type == 'hour' ? 'selected' : '' }}>
                        ساعت
                    </option>
                    <option value="day" {{ $setting->price_color_type == 'day' ? 'selected' : '' }}>
                        روز
                    </option>
                    <option value="month" {{ $setting->price_color_type == 'month' ? 'selected' : '' }}>
                        ماه
                    </option>
                </select>
            </div>

            <div class="mt-4">
                <label for="inputPriceColorMidTime" class="block mb-2 md:text-sm text-xs text-black">
                    مدت زمان میانی تغییر رنگ بخش قیمت گذاری بر اساس انتخاب بالا (زرد رنگ)
                </label>
                <input type="text" class="input-text" id="inputPriceColorMidTime" name="price_color_mid_time"
                       placeholder="مثلا : 2 یا 24 یا 1" value="{{ $setting->price_color_mid_time }}">
            </div>

            <div class="mt-4">
                <label for="inputPriceColorLastTime" class="block mb-2 md:text-sm text-xs text-black">
                    مدت زمان نهایی تغییر رنگ بخش قیمت گذاری بر اساس انتخاب بالا (قرمز رنگ)
                </label>
                <input type="text" class="input-text" id="inputPriceColorLastTime" name="price_color_last_time"
                       placeholder="مثلا : 2 یا 24 یا 1" value="{{ $setting->price_color_last_time }}">
            </div>

            <div class="mt-4">
                <label for="inputActive" class="block mb-2 md:text-sm text-xs text-black">
                    نوع
                </label>
                <select name="active" id="inputActive" class="input-text">
                    <option value="">انتخاب کنید</option>
                    <option value="1" {{ $setting->active == '1' ? 'selected' : '' }}>فعال</option>
                    <option value="0" {{ $setting->active == '0' ? 'selected' : '' }}>غیر فعال</option>
                </select>
            </div>

        </div>

        <div class="col-span-2 space-x-2 space-x-reverse">
            <button type="submit" class="form-edit-btn">
                ویرایش تنظیمات
            </button>
            <a href="{{ route('settings.price-color.index') }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>
