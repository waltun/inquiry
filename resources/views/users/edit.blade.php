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
        <a href="{{ route('users.index') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="breadcrumb-svg" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    مدیریت کاربران
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
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    ویرایش کاربر {{ $user->name }}
                </p>
            </div>
        </div>
    </div>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('users.update',$user->id) }}" class="md:grid grid-cols-2 gap-4 mt-4">
        @csrf
        @method('PATCH')

        <div class="card">
            <div class="card-header">
                <p class="card-title">مشخصات کلی</p>
            </div>

            <div class="mt-4">
                <label for="inputName" class="form-label">نام و نام خانوادگی</label>
                <input type="text" id="inputName" name="name" class="input-text" placeholder="مثال : رضا رضایی"
                       value="{{ $user->name ?? old('name') }}">
            </div>

            <div class="mt-4">
                <label for="inputEmail" class="form-label">ایمیل</label>
                <input type="email" id="inputEmail" name="email" class="input-text"
                       placeholder="مثال : example@gmail.com" value="{{ $user->email ?? old('email') }}">
            </div>

            <div class="mt-4">
                <label for="inputPhone" class="form-label">شماره تماس</label>
                <input type="number" id="inputPhone" name="phone" class="input-text hide-appearance"
                       placeholder="مثال : 09123456789" value="{{ $user->phone ?? old('phone') }}">
            </div>

            <div class="mt-4">
                <label for="inputInternal" class="form-label">داخلی مورد نظر</label>
                <input type="number" id="inputInternal" name="internal_number" class="input-text hide-appearance"
                       placeholder="مثال : 1" value="{{ old('internal_number') ?? $user->internal_number }}">
            </div>

        </div>

        <div class="card">
            <div class="card-header">
                <p class="card-title">رمز عبور</p>
            </div>

            <div class="mt-4">
                <label for="inputPassword" class="form-label">رمز عبور</label>
                <input type="password" id="inputPassword" name="password" class="input-text"
                       placeholder="حداقل 8 حرف یا کلمه">
            </div>

            <div class="mt-4">
                <label for="inputPasswordRepeat" class="form-label">تکرار رمزعبور</label>
                <input type="password" id="inputPasswordRepeat" name="password_confirmation" class="input-text"
                       placeholder="باید با رمز عبور یکی باشد">
            </div>

            <div class="mt-4">
                <p class="text-xs text-red-600 text-center selection:bg-fuchsia-300 selection:text-fuchsia-900">
                    فقط در صورتی که قصد تغییر رمز کاربر را دارید این قسمت را پر کنید، در غیر این صورت این قسمت را خالی
                    بگذارید
                </p>
            </div>

        </div>

        <div class="card">
            <div class="card-header">
                <p class="card-title">اطلاعات بیشتر</p>
            </div>

            <div class="mt-4">
                <label for="inputNation" class="form-label">کد ملی</label>
                <input type="number" id="inputNation" name="nation" class="input-text" placeholder="مثال : 0430521667"
                       value="{{ $user->nation ?? old('nation') }}">
            </div>

            <div class="mt-4">
                <label for="inputGender" class="form-label">جنسیت</label>
                <select name="gender" id="inputGender" class="input-text">
                    <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>مرد</option>
                    <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>زن</option>
                </select>
            </div>

        </div>

        <div class="card">
            <div class="card-header">
                <p class="card-title">نقش کاربر</p>
            </div>

            <div class="mt-4">
                <label for="inputRole" class="form-label">نقش (سِمَت)</label>
                <select name="role" id="inputRole" class="input-text">
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>
                        مدیر عامل
                    </option>
                    <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>
                        کارمند
                    </option>
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>
                        کاربر عادی
                    </option>
                </select>
            </div>

            <div class="mt-4">
                <label for="inputActive" class="form-label">تایید کاربر</label>
                <select name="active" id="inputActive" class="input-text">
                    <option value="">انتخاب کنید</option>
                    <option value="0" {{ $user->active == 0 ? 'selected' : '' }}>کاربر تایید نشده</option>
                    <option value="1" {{ $user->active == 1 ? 'selected' : '' }}>کاربر تایید شده</option>
                </select>
            </div>

        </div>

        <div class="flex items-center space-x-4 space-x-reverse sticky bottom-4">
            <button type="submit" class="form-edit-btn">
                بروزرسانی کاربر
            </button>
            <a href="{{ route('users.index') }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>
