<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/date-picker/persianDatepicker.min.js') }}"></script>
        <script>
            $("#inputStartDate").persianDatepicker({
                formatDate: "YYYY/MM/DD",
            });
            $("#inputEndDate").persianDatepicker({
                formatDate: "YYYY/MM/DD",
            });
        </script>
    </x-slot>
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('plugins/date-picker/persianDatepicker-default.css') }}">
    </x-slot>

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
        <a href="{{ route('employees.index') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="breadcrumb-svg" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    مدیریت کارکنان
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
                    ایجاد کارمند جدید
                </p>
            </div>
        </div>
    </div>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('employees.store') }}" class="md:grid grid-cols-2 gap-4 mt-4">
        @csrf

        <div class="card">
            <div class="card-header">
                <p class="card-title">
                    مشخصات کلی
                </p>
            </div>

            <div class="mb-4">
                <label for="inputName" class="form-label">نام و نام خانوادگی</label>
                <input type="text" id="inputName" name="name" class="input-text"
                       placeholder="مثال : پوریا مستعان" value="{{ old('name') }}">
            </div>

            <div class="mb-4">
                <label for="inputNation" class="form-label">کد ملی</label>
                <input type="text" id="inputNation" name="nation" class="input-text"
                       placeholder="مثال : 0430142821" value="{{ old('nation') }}">
            </div>

            <div class="mb-4">
                <label for="inputLevel" class="form-label">سمت</label>
                <input type="text" id="inputLevel" name="level" class="input-text"
                       placeholder="مثال : مستخدم" value="{{ old('level') }}">
            </div>

            <div class="mb-4">
                <label for="inputInsurance" class="form-label">شماره بیمه</label>
                <input type="text" id="inputInsurance" name="insurance" class="input-text"
                       placeholder="مثال : 11111111" value="{{ old('insurance') }}">
            </div>

            <div class="mb-4">
                <label for="inputPhone" class="form-label">شماره تماس</label>
                <input type="text" id="inputPhone" name="phone" class="input-text"
                       placeholder="مثال : 09022228553" value="{{ old('phone') }}">
            </div>

        </div>

        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    مشخصات بیشتر
                </div>
            </div>

            <div class="mb-4">
                <label for="inputCart" class="form-label">شماره حساب</label>
                <input type="text" id="inputCart" name="cart" class="input-text"
                       placeholder="مثال : 6219861900523902" value="{{ old('cart') }}">
            </div>

            <div class="mb-4">
                <label for="inputEducation" class="form-label">تحصیلات</label>
                <input type="text" id="inputEducation" name="education" class="input-text"
                       placeholder="مثال : دیپلم" value="{{ old('education') }}">
            </div>

            <div class="mb-4">
                <label for="inputAddress" class="form-label">آدرس سکونت</label>
                <input type="text" id="inputAddress" name="address" class="input-text"
                       placeholder="مثال : تهران" value="{{ old('address') }}">
            </div>

            <div class="mb-4">
                <label for="inputStartDate" class="form-label">تاریخ استخدام</label>
                <input type="text" id="inputStartDate" name="start_date" class="input-text"
                       placeholder="برای انتخاب تاریخ کلیک کنید" value="{{ old('start_date') }}">
            </div>

            <div class="mb-4">
                <label for="inputEndDate" class="form-label">تاریخ ترک کار</label>
                <input type="text" id="inputEndDate" name="end_date" class="input-text"
                       placeholder="برای انتخاب تاریخ کلیک کنید" value="{{ old('end_date') }}">
            </div>
        </div>

        <div class="flex items-center space-x-4 space-x-reverse">
            <button type="submit" class="form-submit-btn" id="submit-button">
                ثبت کارمند
            </button>
            <a href="{{ route('employees.index') }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>
