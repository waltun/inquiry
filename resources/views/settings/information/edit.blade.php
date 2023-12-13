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
        <a href="{{ route('information.index') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"></path>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    تنظیمات سربرگ پیش فاکتور
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
                    ویرایش سربرگ {{ $information->title }}
                </p>
            </div>
        </div>
    </div>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('information.update', $information->id) }}" class="mt-4 md:grid grid-cols-3 gap-4">
        @csrf
        @method('PATCH')

        <div class="card">
            <div class="card-header">
                <p class="card-title">مشخصات کلی</p>
            </div>

            <div class="mt-4">
                <label for="inputTitle" class="form-label">
                    عنوان
                </label>
                <input type="text" class="input-text" id="inputTitle" name="title"
                       placeholder="مثلا : تهویه آذرباد" value="{{ old('title', $information->title) }}">
            </div>

            <div class="mt-4">
                <label for="inputTitleEn" class="form-label">
                    عنوان انگلیسی
                </label>
                <input type="text" class="input-text" id="inputTitleEn" name="title_en"
                       placeholder="مثلا : TAHVIEH AZARBAD" value="{{ old('title_en', $information->title_en) }}">
            </div>

            <div class="mt-4">
                <label for="inputWebsite" class="form-label">
                    آدرس وب سایت
                </label>
                <input type="text" class="input-text" id="inputWebsite" name="website"
                       placeholder="مثلا : tahviehazarbad.com" value="{{ old('website', $information->website) }}">
            </div>

        </div>

        <div class="card">
            <div class="card-header">
                <p class="card-title">اطلاعات تماس</p>
            </div>

            <div class="mt-4">
                <label for="inputPhone" class="form-label">
                    شماره همراه
                </label>
                <input type="text" class="input-text" id="inputPhone" name="phone"
                       placeholder="مثلا : 09123456789" value="{{ old('phone', $information->phone) }}">
            </div>

            <div class="mt-4">
                <label for="inputTelephone" class="form-label">
                    شماره شرکت
                </label>
                <input type="text" class="input-text" id="inputTelephone" name="telephone"
                       placeholder="مثلا : 02122334455" value="{{ old('telephone', $information->telephone) }}">
            </div>

            <div class="mt-4">
                <label for="inputEmail" class="form-label">
                    ایمیل
                </label>
                <input type="text" class="input-text" id="inputEmail" name="email"
                       placeholder="مثلا : info@tahviehazarbad.ir" value="{{ old('email', $information->email) }}">
            </div>

        </div>

        <div class="card">
            <div class="card-header">
                <p class="card-title">اطلاعات بیشتر</p>
            </div>

            <div class="mt-4">
                <label for="inputLogo" class="form-label">
                    انتخاب لوگو
                </label>
                <input type="file" class="input-text" id="inputLogo" name="logo" value="{{ old('logo', $information->logo) }}">
            </div>

            <div class="mt-4">
                <label for="inputAddress" class="form-label">
                    آدرس
                </label>
                <input type="text" class="input-text" id="inputAddress" name="address"
                       placeholder="مثلا : پونک" value="{{ old('address', $information->address) }}">
            </div>

            <div class="mt-4">
                <label for="inputHeader" class="form-label">
                    نمایش هدر و فوتر در صفحه پرینت
                </label>
                <select name="header" id="inputHeader" class="input-text">
                    <option value="">انتخاب کنید</option>
                    <option value="1" {{ old('header', $information->header) == '1' ? 'selected' : '' }}>نمایش</option>
                    <option value="0" {{ old('header', $information->header) == '0' ? 'selected' : '' }}>عدم نمایش</option>
                </select>
            </div>

            <div class="mt-4">
                <label for="inputActive" class="form-label">
                    فعال بودن این هدر
                </label>
                <select name="active" id="inputActive" class="input-text">
                    <option value="">انتخاب کنید</option>
                    <option value="1" {{ old('active', $information->active) == '1' ? 'selected' : '' }}>فعال باشد</option>
                    <option value="0" {{ old('active', $information->active) == '0' ? 'selected' : '' }}>فعال نباشد</option>
                </select>
            </div>

        </div>

        <div class="col-span-3">
            <div class="flex items-center space-x-4 space-x-reverse">
                <button type="submit" class="form-edit-btn">
                    بروزرسانی سربرگ
                </button>
                <a href="{{ route('information.index') }}" class="form-cancel-btn">
                    انصراف
                </a>
            </div>
        </div>
    </form>

    <div class="mt-4">
        <p class="text-sm font-bold text-red-600">
            * توجه : تنها یک سربرگ "فعال" مورد قبول است، اگر سربرگ فعالی دارید این سربرگ را "فعال نباشد" انتخاب کنید.
        </p>
    </div>
</x-layout>
