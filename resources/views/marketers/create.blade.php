<x-layout>
    <!-- Breadcrumb -->
    <div class="flex items-center space-x-2 space-x-reverse whitespace-nowrap">
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
        <a href="{{ route('marketers.index') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    بازاریاب ها
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
                    ایجاد بازاریاب جدید
                </p>
            </div>
        </div>
    </div>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('marketers.store') }}" class="mt-4 md:grid grid-cols-3 gap-4">
        @csrf

        <div class="col-span-3">
            <div class="card">
                <div class="card-header">
                    <p class="card-title">
                        مشخصات بازاریاب
                    </p>
                </div>

                <div class="mb-4">
                    <label for="inputName" class="form-label">
                        نام
                    </label>
                    <input type="text" id="inputName" name="name" class="input-text" value="{{ old('name') }}"
                           placeholder="مثلا : رضا رضایی">
                </div>

                <div class="mb-4">
                    <label for="inputPhone" class="form-label">
                        شماره تماس
                    </label>
                    <input type="text" id="inputPhone" name="phone" class="input-text" value="{{ old('phone') }}"
                           placeholder="مثلا : 09123456789">
                </div>

                <div class="mb-4">
                    <label for="inputNation" class="form-label">
                        کد ملی
                    </label>
                    <input type="text" id="inputNation" name="nation" class="input-text" value="{{ old('nation') }}"
                           placeholder="مثلا : 1111111111">
                </div>

            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <p class="card-title">
                    مشخصات حساب اول
                </p>
            </div>

            <div class="mb-4">
                <label for="inputBankName1" class="form-label">
                    نام بانک
                </label>
                <input type="text" id="inputBankName1" name="bank_name1" class="input-text"
                       value="{{ old('bank_name1') }}"
                       placeholder="مثلا : بانک سپه">
            </div>

            <div class="mb-4">
                <label for="inputAccountNumber1" class="form-label">
                    شماره حساب
                </label>
                <input type="text" id="inputAccountNumber1" name="account_number1" class="input-text"
                       value="{{ old('account_number1') }}"
                       placeholder="مثلا : 5112300457">
            </div>

            <div class="mb-4">
                <label for="inputCardNumber1" class="form-label">
                    شماره کارت
                </label>
                <input type="text" id="inputCardNumber1" name="card_number1" class="input-text"
                       value="{{ old('card_number1') }}"
                       placeholder="مثلا : 6219861900523902">
            </div>

            <div class="mb-4">
                <label for="inputShabaNumber1" class="form-label">
                    شماره شبا
                </label>
                <input type="text" id="inputShabaNumber1" name="shaba_number1" class="input-text"
                       value="{{ old('shaba_number1') }}"
                       placeholder="مثلا : IR26542100000054119874">
            </div>

            <div class="mb-4">
                <label for="inputAccountName1" class="form-label">
                    نام دارنده حساب
                </label>
                <input type="text" id="inputAccountName1" name="account_name1" class="input-text"
                       value="{{ old('account_name1') }}"
                       placeholder="مثلا : علی رضایی">
            </div>

        </div>

        <div class="card">
            <div class="card-header">
                <p class="card-title">
                    مشخصات حساب دوم
                </p>
            </div>

            <div class="mb-4">
                <label for="inputBankName2" class="form-label">
                    نام بانک
                </label>
                <input type="text" id="inputBankName2" name="bank_name2" class="input-text"
                       value="{{ old('bank_name2') }}"
                       placeholder="مثلا : بانک سپه">
            </div>

            <div class="mb-4">
                <label for="inputAccountNumber2" class="form-label">
                    شماره حساب
                </label>
                <input type="text" id="inputAccountNumber2" name="account_number2" class="input-text"
                       value="{{ old('account_number2') }}"
                       placeholder="مثلا : 5112300457">
            </div>

            <div class="mb-4">
                <label for="inputCardNumber2" class="form-label">
                    شماره کارت
                </label>
                <input type="text" id="inputCardNumber2" name="card_number2" class="input-text"
                       value="{{ old('card_number2') }}"
                       placeholder="مثلا : 6219861900523902">
            </div>

            <div class="mb-4">
                <label for="inputShabaNumber2" class="form-label">
                    شماره شبا
                </label>
                <input type="text" id="inputShabaNumber2" name="shaba_number2" class="input-text"
                       value="{{ old('shaba_number2') }}"
                       placeholder="مثلا : IR26542100000054119874">
            </div>

            <div class="mb-4">
                <label for="inputAccountName2" class="form-label">
                    نام دارنده حساب
                </label>
                <input type="text" id="inputAccountName2" name="account_name2" class="input-text"
                       value="{{ old('account_name2') }}"
                       placeholder="مثلا : علی رضایی">
            </div>

        </div>

        <div class="card">
            <div class="card-header">
                <p class="card-title">
                    مشخصات حساب سوم
                </p>
            </div>

            <div class="mb-4">
                <label for="inputBankName3" class="form-label">
                    نام بانک
                </label>
                <input type="text" id="inputBankName3" name="bank_name3" class="input-text"
                       value="{{ old('bank_name3') }}"
                       placeholder="مثلا : بانک سپه">
            </div>

            <div class="mb-4">
                <label for="inputAccountNumber3" class="form-label">
                    شماره حساب
                </label>
                <input type="text" id="inputAccountNumber3" name="account_number3" class="input-text"
                       value="{{ old('account_number3') }}"
                       placeholder="مثلا : 5112300457">
            </div>

            <div class="mb-4">
                <label for="inputCardNumber3" class="form-label">
                    شماره کارت
                </label>
                <input type="text" id="inputCardNumber3" name="card_number3" class="input-text"
                       value="{{ old('card_number3') }}"
                       placeholder="مثلا : 6219861900523902">
            </div>

            <div class="mb-4">
                <label for="inputShabaNumber3" class="form-label">
                    شماره شبا
                </label>
                <input type="text" id="inputShabaNumber3" name="shaba_number3" class="input-text"
                       value="{{ old('shaba_number3') }}"
                       placeholder="مثلا : IR26542100000054119874">
            </div>

            <div class="mb-4">
                <label for="inputAccountName3" class="form-label">
                    نام دارنده حساب
                </label>
                <input type="text" id="inputAccountName3" name="account_name3" class="input-text"
                       value="{{ old('account_name3') }}"
                       placeholder="مثلا : علی رضایی">
            </div>

        </div>

        <div class="col-span-3">
            <div class="flex items-center space-x-4 space-x-reverse">
                <button type="submit" class="form-submit-btn" id="submit-button">
                    ثبت بازاریاب
                </button>
                <a href="{{ route('marketers.index') }}" class="form-cancel-btn">
                    انصراف
                </a>
            </div>
        </div>
    </form>
</x-layout>
