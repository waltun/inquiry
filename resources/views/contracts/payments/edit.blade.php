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
                      d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    مدیریت حساب ها
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
                    ویرایش حساب {{ $account->account_number }}
                </p>
            </div>
        </div>
    </div>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('accounts.update',$account->id) }}" class="md:grid grid-cols-2 gap-4 mt-4">
        @csrf
        @method('PATCH')

        <div class="card">
            <div class="card-header">
                <p class="card-title">
                    مشخصات حساب
                </p>
            </div>

            <div class="mb-4">
                <label for="inputAccountNumber" class="form-label">شماره حساب</label>
                <input type="text" id="inputAccountNumber" name="account_number" class="input-text"
                       placeholder="مثال : 3200154467" value="{{ old('account_number', $account->account_number) }}">
            </div>

            <div class="mb-4">
                <label for="inputCardNumber" class="form-label">شماره کارت</label>
                <input type="text" id="inputCardNumber" name="card_number" class="input-text"
                       placeholder="مثال : 6219861900523902" value="{{ old('card_number', $account->card_number) }}">
            </div>

            <div class="mb-4">
                <label for="inputShabaNumber" class="form-label">شماره شبا</label>
                <input type="text" id="inputShabaNumber" name="shaba_number" class="input-text"
                       placeholder="مثال : IR98665220000152253"
                       value="{{ old('shaba_number', $account->shaba_number) }}">
            </div>

        </div>

        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    اطلاعات بانک
                </div>
            </div>

            <div class="mb-4">
                <label for="inputBank" class="form-label">نام باک</label>
                <input type="text" id="inputBank" name="bank" class="input-text"
                       placeholder="مثال : بانک سپه" value="{{ old('bank', $account->bank) }}">
            </div>

            <div class="mb-4">
                <label for="inputBranch" class="form-label">شعبه بانک</label>
                <input type="text" id="inputBranch" name="branch" class="input-text"
                       placeholder="مثال : شعبه سردار جنگل" value="{{ old('branch', $account->branch) }}">
            </div>

            <div class="mb-4">
                <label for="inputBranchCode" class="form-label">کد شعبه بانک</label>
                <input type="text" id="inputBranchCode" name="branch_code" class="input-text"
                       placeholder="مثال : 1354" value="{{ old('branch_code', $account->branch_code) }}">
            </div>

            <div class="mb-4">
                <label for="inputAddress" class="form-label">آدرس بانک</label>
                <input type="text" id="inputAddress" name="address" class="input-text"
                       placeholder="مثال : تهران، سردارجنگل، ..." value="{{ old('address', $account->address) }}">
            </div>
        </div>

        <div class="flex items-center space-x-4 space-x-reverse">
            <button type="submit" class="form-edit-btn" id="submit-button">
                بروزرسانی حساب
            </button>
            <a href="{{ route('accounts.index') }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>
