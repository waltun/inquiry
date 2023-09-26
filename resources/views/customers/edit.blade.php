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
        <a href="{{ route('customers.index') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    مدیریت مشتریان
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
                    ایجاد مشتری جدید
                </p>
            </div>
        </div>
    </div>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('customers.update', $customer->id) }}" class="md:grid grid-cols-3 gap-4 mt-4">
        @csrf
        @method('PATCH')

        <div class="card">
            <div class="card-header">
                <p class="card-title">
                    مشخصات مشتری
                </p>
            </div>

            <div class="mb-4">
                <label for="inputName" class="form-label">نوع مشتری</label>
                <select name="type" id="inputType" class="input-text">
                    <option value="real" {{ old('type', $customer->type) == 'real' ? 'selected' : '' }}>
                        حقیقی
                    </option>
                    <option value="legal" {{ old('type', $customer->type) == 'legal' ? 'selected' : '' }}>
                        حقوقی
                    </option>
                </select>
            </div>

            <div class="mb-4">
                <label for="inputName" class="form-label">نام</label>
                <input type="text" id="inputName" name="name" class="input-text"
                       placeholder="مثال : علی" value="{{ old('name', $customer->name) }}">
            </div>

            <div class="mb-4">
                <label for="inputNation" class="form-label">شناسه ملی / شماره ملی</label>
                <input type="text" id="inputNation" name="nation" class="input-text"
                       placeholder="مثال : 0123456789" value="{{ old('nation', $customer->nation) }}">
            </div>

            <div class="mb-4">
                <label for="inputRegistrationNumber" class="form-label">شماره ثبت شرکت</label>
                <input type="text" id="inputRegistrationNumber" name="registration_number" class="input-text"
                       placeholder="مثال : 55522015" value="{{ old('registration_number', $customer->registration_number) }}">
            </div>

        </div>

        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    اطلاعات تماس
                </div>
            </div>

            <div class="mb-4">
                <label for="inputPhone" class="form-label">شماره موبایل</label>
                <input type="text" id="inputPhone" name="phone" class="input-text"
                       placeholder="مثال : 09123456789" value="{{ old('phone', $customer->phone) }}">
            </div>

            <div class="mb-4">
                <label for="inputSocialPhone" class="form-label">شماره موبایل شبکه های اجتماعی</label>
                <input type="text" id="inputSocialPhone" name="social_phone" class="input-text"
                       placeholder="مثال : 09123456789" value="{{ old('social_phone', $customer->social_phone) }}">
            </div>

            <div class="mb-4">
                <label for="inputTelephone" class="form-label">شماره ثابت</label>
                <input type="text" id="inputTelephone" name="telephone" class="input-text"
                       placeholder="مثال : 02122334455" value="{{ old('telephone', $customer->telephone) }}">
            </div>

            <div class="mb-4">
                <label for="inputEmail" class="form-label">ایمیل</label>
                <input type="text" id="inputEmail" name="email" class="input-text"
                       placeholder="مثال : example@gmail.com" value="{{ old('email', $customer->email) }}">
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <p class="card-title">
                    آدرس مشتری
                </p>
            </div>

            <div class="mb-4">
                <label for="inputPostal" class="form-label">کد پستی</label>
                <input type="text" id="inputPostal" name="postal" class="input-text"
                       placeholder="مثال : 0123456789" value="{{ old('postal', $customer->postal) }}">
            </div>

            <div class="mb-4">
                <label for="inputAddress" class="form-label">آدرس مشتری</label>
                <input type="text" id="inputAddress" name="address" class="input-text"
                       value="{{ old('address', $customer->address) }}" placeholder="مثال : تهران">
            </div>
        </div>

        <div class="flex items-center space-x-4 space-x-reverse">
            <button type="submit" class="form-edit-btn" id="submit-button">
                بروزرسانی مشتری
            </button>
            <a href="{{ route('customers.index') }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>
