<x-layout>
    <!-- Breadcrumb -->
    <div class="flex items-center space-x-2 space-x-reverse">
        <a href="{{ route('dashboard') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0l4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0l-5.571 3-5.571-3"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    داشبورد
                </p>
            </div>
        </a>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                 class="breadcrumb-svg-arrow">
                <path fill-rule="evenodd"
                      d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                      clip-rule="evenodd"/>
            </svg>
        </div>
        <a href="{{ route('settings.index') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    تنظیمات
                </p>
            </div>
        </a>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                 class="breadcrumb-svg-arrow">
                <path fill-rule="evenodd"
                      d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                      clip-rule="evenodd"/>
            </svg>
        </div>
        <a href="{{ route('settings.delete-button.index') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    تنظیمات دکمه‌های حذف
                </p>
            </div>
        </a>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                 class="breadcrumb-svg-arrow">
                <path fill-rule="evenodd"
                      d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                      clip-rule="evenodd"/>
            </svg>
        </div>
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg-active">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    ایجاد تنظیمات جدید
                </p>
            </div>
        </div>
    </div>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('settings.delete-button.store') }}" class="mt-4">
        @csrf

        <div class="card">
            <div class="card-header">
                <p class="card-title">مشخصات کلی</p>
            </div>

            <div class="mt-4">
                <label for="inputCategories" class="form-label">
                    دکمه های حذف بخش دسته بندی ها
                </label>
                <select name="categories" id="inputCategories" class="input-text">
                    <option value="">انتخاب کنید</option>
                    <option value="1">
                        نمایش
                    </option>
                    <option value="0">
                        عدم نمایش
                    </option>
                </select>
            </div>

            <div class="mt-4">
                <label for="inputProducts" class="form-label">
                    دکمه های حذف بخش محصولات و مدل ها
                </label>
                <select name="products" id="inputProducts" class="input-text">
                    <option value="">انتخاب کنید</option>
                    <option value="1">
                        نمایش
                    </option>
                    <option value="0">
                        عدم نمایش
                    </option>
                </select>
            </div>

            <div class="mt-4">
                <label for="inputParts" class="form-label">
                    دکمه های حذف بخش قطعات
                </label>
                <select name="parts" id="inputParts" class="input-text">
                    <option value="">انتخاب کنید</option>
                    <option value="1">
                        نمایش
                    </option>
                    <option value="0">
                        عدم نمایش
                    </option>
                </select>
            </div>

            <div class="mt-4">
                <label for="inputCollectionParts" class="form-label">
                    دکمه های حذف بخش کالاهای نیم ساخته
                </label>
                <select name="collection_parts" id="inputCollectionParts" class="input-text">
                    <option value="">انتخاب کنید</option>
                    <option value="1">
                        نمایش
                    </option>
                    <option value="0">
                        عدم نمایش
                    </option>
                </select>
            </div>

            <div class="mt-4">
                <label for="inputCollectionCoil" class="form-label">
                    دکمه های حذف بخش کویل و دمپر و مبدل و تابلو
                </label>
                <select name="collection_coil" id="inputCollectionCoil" class="input-text">
                    <option value="">انتخاب کنید</option>
                    <option value="1">
                        نمایش
                    </option>
                    <option value="0">
                        عدم نمایش
                    </option>
                </select>
            </div>

            <div class="mt-4">
                <label for="inputUsers" class="form-label">
                    دکمه های حذف بخش کاربران
                </label>
                <select name="users" id="inputUsers" class="input-text">
                    <option value="">انتخاب کنید</option>
                    <option value="1">
                        نمایش
                    </option>
                    <option value="0">
                        عدم نمایش
                    </option>
                </select>
            </div>

            <div class="mt-4">
                <label for="inputInquiries" class="form-label">
                    دکمه های حذف بخش استعلام ها
                </label>
                <select name="inquiries" id="inputInquiries" class="input-text">
                    <option value="">انتخاب کنید</option>
                    <option value="1">
                        نمایش
                    </option>
                    <option value="0">
                        عدم نمایش
                    </option>
                </select>
            </div>

            <div class="mt-4">
                <label for="inputActive" class="form-label">
                    نوع
                </label>
                <select name="active" id="inputActive" class="input-text">
                    <option value="">انتخاب کنید</option>
                    <option value="1">فعال</option>
                    <option value="0">غیر فعال</option>
                </select>
            </div>

        </div>

        <div class="flex items-center space-x-4 space-x-reverse">
            <button type="submit" class="form-submit-btn">
                ثبت تنظیمات
            </button>
            <a href="{{ route('settings.delete-button.index') }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>
