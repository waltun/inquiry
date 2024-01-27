<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/date-picker/persianDatepicker.min.js') }}"></script>
        <script>
            $("#inputDate").persianDatepicker({
                formatDate: "YYYY-MM-DD",
            });
        </script>
    </x-slot>
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('plugins/date-picker/persianDatepicker-default.css') }}">
    </x-slot>

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
        <a href="{{ route('letters.index') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    لیست ارسال مراسلات
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
                    ویرایش مکاتبه {{ $letter->title }}
                </p>
            </div>
        </div>
    </div>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <!-- Create User form -->
    <form action="{{ route('letters.update',$letter->id) }}" method="post" class="mt-11">
        @csrf
        @method('PATCH')

        <div class="card">
            <div class="card-header">
                <p class="card-title">
                    مشخصات کلی
                </p>
            </div>
            <div class="mb-4 grid grid-cols-12 gap-4 items-center">
                <div class="col-span-2">
                    <label for="inputTitle" class="form-label">
                        <span class="font-bold text-red-600">* </span>عنوان
                    </label>
                </div>
                <div class="col-span-10">
                    <input type="text" name="title" id="inputTitle" class="input-text" placeholder="شرح"
                           value="{{ old('title') ?? $letter->title }}">
                </div>
            </div>
            <div class="grid grid-cols-12 gap-4 items-center">
                <div class="col-span-2">
                    <label for="inputMethod" class="form-label">
                        <span class="font-bold text-red-600">* </span>حامل نامه
                    </label>
                </div>
                <div class="col-span-10">
                    <input type="text" name="method" id="inputMethod" class="input-text" placeholder="روش ارسال نامه"
                           value="{{ old('method') ?? $letter->method }}">
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <p class="card-title">
                    ثبت کننده و دسته بندی
                </p>
            </div>
            <div class="mb-4 grid grid-cols-12 gap-4 items-center">
                <div class="col-span-2">
                    <label for="inputRegistrar" class="form-label">
                        <span class="font-bold text-red-600">* </span>ثبت کننده
                    </label>
                </div>
                <div class="col-span-10">
                    <select name="registrar" id="inputRegistrar" class="input-text">
                        <option value="">انتخاب کنید</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $letter->user_id == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-4 items-center">
                <div class="col-span-2">
                    <label for="inputCategory" class="form-label">
                        <span class="font-bold text-red-600">* </span>دسته بندی
                    </label>
                </div>
                <div class="col-span-10">
                    <select name="category" id="inputCategory" class="input-text">
                        <option value="">انتخاب کنید</option>
                        <option value="پیش فاکتور" {{ $letter->category == 'پیش فاکتور' ? 'selected' : '' }}>
                            پیش فاکتور
                        </option>
                        <option value="معرفی نامه" {{ $letter->category == 'معرفی نامه' ? 'selected' : '' }}>
                            معرفی نامه
                        </option>
                        <option value="مکاتبات اداری" {{ $letter->category == 'مکاتبات اداری' ? 'selected' : '' }}>
                            مکاتبات اداری
                        </option>
                        <option value="مکاتبات با مشتریان" {{ $letter->category == 'مکاتبات با مشتریان' ? 'selected' : '' }}>
                            مکاتبات با مشتریان
                        </option>
                        <option value="اعلام پایان ساخت" {{ $letter->category == 'اعلام پایان ساخت' ? 'selected' : '' }}>
                            اعلام پایان ساخت
                        </option>
                        <option value="سایر" {{ $letter->category == 'سایر' ? 'selected' : '' }}>
                            سایر
                        </option>
                    </select>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <p class="card-title">
                    تاریخ
                </p>
            </div>
            <div class="grid grid-cols-12 gap-4 items-center">
                <div class="col-span-2">
                    <label for="inputDate" class="form-label">
                        <span class="font-bold text-red-600">* </span>تاریخ نامه
                    </label>
                </div>
                <div class="col-span-10">
                    <input type="text" name="date" id="inputDate" class="input-text" value="{{ $date }}">
                </div>
            </div>
        </div>

        <div class="flex space-x-4 space-x-reverse sticky bottom-4 z-50">
            <button type="submit" class="form-edit-btn">
                بروزرسانی مکاتبه
            </button>
            <a href="{{ route('letters.index') }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>
