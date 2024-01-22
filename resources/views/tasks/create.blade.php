<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/date-picker/persianDatepicker.min.js') }}"></script>
        <script>
            $("#inputDate").persianDatepicker({
                format: 'Y/m/d'
            })
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
        <a href="{{ route('tasks.index') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="breadcrumb-svg" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    مدیریت تسک ها
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
                    ایجاد تسک جدید
                </p>
            </div>
        </div>
    </div>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('tasks.store') }}" class="md:grid grid-cols-2 gap-4 mt-4">
        @csrf

        <div class="card">
            <div class="card-header">
                <p class="card-title">مشخصات کلی</p>
            </div>

            <div class="mt-4">
                <label for="inputTitle" class="form-label">موضوع تسکی که باید انجام بشه</label>
                <input type="text" id="inputTitle" name="title" class="input-text"
                       placeholder="مثال : تکمیل دیتاشیت پروژه ها" value="{{ old('title') }}">
            </div>

            <div class="mt-4">
                <label for="inputDate" class="form-label">تاریخی که این تسک باید انجام بشه</label>
                <input type="text" id="inputDate" name="date" class="input-text"
                       placeholder="برای انتخاب تاریخ کلیک کنید" value="{{ old('date') }}">
            </div>

            <div class="mt-4">
                <label for="inputLevel" class="form-label">سطح اهمیت این تسک</label>
                <select name="level" id="inputLevel" class="input-text">
                    <option value="">انتخاب کنید</option>
                    <option value="high" {{ old('level') == 'high' ? 'selected' : '' }}>
                        اهمیت بالا
                    </option>
                    <option value="medium" {{ old('level') == 'medium' ? 'selected' : '' }}>
                        اهمیت متوسط
                    </option>
                    <option value="low" {{ old('level') == 'low' ? 'selected' : '' }}>
                        اهمیت کم
                    </option>
                </select>
            </div>

            <div class="mt-4">
                <label for="inputReceiver" class="form-label">کاربر دریافت کننده</label>
                <select name="receiver_id" id="inputReceiver" class="input-text">
                    <option value="">انتخاب کنید</option>
                    @foreach($receivers as $receiver)
                        <option value="{{ $receiver->id }}" {{ old('receiver_id') == $receiver->id ? 'selected' : '' }}>
                            {{ $receiver->name }}
                        </option>
                    @endforeach
                </select>
            </div>

        </div>

        <div class="card">
            <div class="card-header">
                <p class="card-title">توضیحات</p>
            </div>

            <div class="mt-4">
                <label for="inputDescription" class="form-label">توضیحات مربوط به این تسک برای کاربر</label>
                <textarea name="description" id="inputDescription"
                          class="input-text resize-none h-64">{{ old('description') }}</textarea>
            </div>
        </div>

        <div class="flex items-center space-x-4 space-x-reverse">
            <button type="submit" class="form-submit-btn" id="submit-button">
                ثبت تسک
            </button>
            <a href="{{ route('tasks.index') }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>
