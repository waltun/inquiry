<x-layout>
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="{{ route('dashboard') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-5 h-5 text-gray-500">
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
        <a href="{{ route('phonebook.index') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    لیست دفترچه تلفن
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
                    ایجاد شماره جدید
                </p>
            </div>
        </div>
    </div>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <!-- Create User form -->
    <form action="{{ route('phonebook.store') }}" method="post" class="mt-6 grid grid-cols-2 gap-4">
        @csrf

        <div class="card bg-sky-100">
            <div class="mb-4 grid grid-cols-12 gap-4 items-center">
                <div class="col-span-2">
                    <label for="inputTitle" class="form-label text-center">
                        <span class="font-bold text-red-600">* </span>شرح :
                    </label>
                </div>
                <div class="col-span-10">
                    <input type="text" name="title" id="inputTitle" class="input-text" placeholder="شرح"
                           value="{{ old('title') }}">
                </div>
            </div>
            <div class="mb-4 grid grid-cols-12 gap-4 items-center">
                <div class="col-span-2">
                    <label for="inputActivity" class="form-label text-center">
                        <span class="font-bold text-red-600">* </span>نوع فعالیت :
                    </label>
                </div>
                <div class="col-span-10">
                    <input type="text" name="activity" id="inputActivity" class="input-text" placeholder="نوع فعالیت"
                           value="{{ old('activity') }}">
                </div>
            </div>
            <div class="mb-4 grid grid-cols-12 gap-4 items-center">
                <div class="col-span-2">
                    <label for="inputPhone1" class="form-label text-center">
                        تلفن 1 :
                    </label>
                </div>
                <div class="col-span-10">
                    <input type="text" name="phone1" id="inputPhone1" class="input-text" placeholder="تلفن اول"
                           value="{{ old('phone1') }}">
                </div>
            </div>
            <div class="mb-4 grid grid-cols-12 gap-4 items-center">
                <div class="col-span-2">
                    <label for="inputPhone2" class="form-label text-center">
                        تلفن 2 :
                    </label>
                </div>
                <div class="col-span-10">
                    <input type="text" name="phone2" id="inputPhone2" class="input-text" placeholder="تلفن دوم"
                           value="{{ old('phone2') }}">
                </div>
            </div>
            <div class="mb-4 grid grid-cols-12 gap-4 items-center">
                <div class="col-span-2">
                    <label for="inputMobile1" class="form-label text-center">
                        موبایل 1 :
                    </label>
                </div>
                <div class="col-span-10">
                    <input type="text" name="mobile1" id="inputMobile1" class="input-text" placeholder="تلفن همراه اول"
                           value="{{ old('mobile1') }}">
                </div>
            </div>
            <div class="mb-4 grid grid-cols-12 gap-4 items-center">
                <div class="col-span-2">
                    <label for="inputMobile2" class="form-label text-center">
                        موبایل 2 :
                    </label>
                </div>
                <div class="col-span-10">
                    <input type="text" name="mobile2" id="inputMobile2" class="input-text" placeholder="تلفن همراه دوم"
                           value="{{ old('mobile2') }}">
                </div>
            </div>
            <div class="grid grid-cols-12 gap-4 items-center">
                <div class="col-span-2">
                    <label for="inputEmail" class="form-label text-center">
                        ایمیل :
                    </label>
                </div>
                <div class="col-span-10">
                    <input type="text" name="email" id="inputEmail" class="input-text" placeholder="ایمیل"
                           value="{{ old('email') }}">
                </div>
            </div>
        </div>

        <div class="card bg-sky-100">
            <div class="grid grid-cols-12 gap-4 items-start">
                <div class="col-span-2">
                    <label for="inputDescription" class="form-label text-center">
                        توضیحات :
                    </label>
                </div>
                <div class="col-span-10">
                    <textarea name="description" id="inputDescription"
                              class="input-text h-32 resize-none">{{ old('description') }}</textarea>
                </div>
            </div>
            <div class="mb-4 grid grid-cols-12 gap-4 items-start">
                <div class="col-span-2">
                    <label for="inputAddress" class="form-label text-center">
                        آدرس :
                    </label>
                </div>
                <div class="col-span-10">
                    <textarea name="address" id="inputAddress"
                              class="input-text h-32 resize-none">{{ old('address') }}</textarea>
                </div>
            </div>
            <div class="mb-4 grid grid-cols-12 gap-4 items-center">
                <div class="col-span-2">
                    <label for="inputPostal" class="form-label text-center">
                        کد پستی :
                    </label>
                </div>
                <div class="col-span-10">
                    <input type="text" name="postal" id="inputPostal" class="input-text" placeholder="کد پستی"
                           value="{{ old('postal') }}">
                </div>
            </div>
        </div>

        <div class="col-span-2 card bg-sky-100">
            <div class="flex items-center justify-center space-x-8 space-x-reverse">
                <div class="mt-1">
                    <p class="form-label">
                        <span class="text-red-600"> * </span> دسته بندی :
                    </p>
                </div>
                <div class="flex items-center">
                    <input type="radio" id="inputCategory1" value="مشتریان" name="category">
                    <label for="inputCategory1" class="form-label mb-0 mr-1">
                        مشتریان
                    </label>
                </div>

                <div class="flex items-center">
                    <input type="radio" id="inputCategory2" value="تامین کنندگان" name="category">
                    <label for="inputCategory2" class="form-label mb-0 mr-1">
                        تامین کنندگان
                    </label>
                </div>

                <div class="flex items-center">
                    <input type="radio" id="inputCategory3" value="مهندسین مشاور" name="category">
                    <label for="inputCategory3" class="form-label mb-0 mr-1">
                        مهندسین مشاور
                    </label>
                </div>

                <div class="flex items-center">
                    <input type="radio" id="inputCategory4" value="تبلیغات" name="category">
                    <label for="inputCategory4" class="form-label mb-0 mr-1">
                        تبلیغات
                    </label>
                </div>

                <div class="flex items-center">
                    <input type="radio" id="inputCategory5" value="همکاران" name="category">
                    <label for="inputCategory5" class="form-label mb-0 mr-1">
                        همکاران
                    </label>
                </div>

                <div class="flex items-center">
                    <input type="radio" id="inputCategory6" value="بانک" name="category">
                    <label for="inputCategory6" class="form-label mb-0 mr-1">
                        بانک
                    </label>
                </div>

                <div class="flex items-center">
                    <input type="radio" id="inputCategory7" value="بیمه" name="category">
                    <label for="inputCategory7" class="form-label mb-0 mr-1">
                        بیمه
                    </label>
                </div>

                <div class="flex items-center">
                    <input type="radio" id="inputCategory8" value="ادارات دولتی" name="category">
                    <label for="inputCategory8" class="form-label mb-0 mr-1">
                        ادارات دولتی
                    </label>
                </div>

                <div class="flex items-center">
                    <input type="radio" id="inputCategory9" value="سایر" name="category">
                    <label for="inputCategory9" class="form-label mb-0 mr-1">
                        سایر
                    </label>
                </div>
            </div>
        </div>

        <div class="col-span-2 flex space-x-4 space-x-reverse sticky bottom-4 z-50">
            <button type="submit" class="form-submit-btn">
                ثبت
            </button>
            <a href="{{ route('phonebook.index') }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>
