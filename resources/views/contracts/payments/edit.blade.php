<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/date-picker/persianDatepicker.min.js') }}"></script>
        <script>
            $("#inputDate").persianDatepicker({
                formatDate: "YYYY-MM-DD",
            });
        </script>
        <script>
            function showPrice(event) {
                let value = event.target.value;
                let priceSection = document.getElementById('priceSection');
                priceSection.innerText = Intl.NumberFormat('fa-IR').format(value) + ' تومان ';
            }
        </script>
    </x-slot>
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('plugins/date-picker/persianDatepicker-default.css') }}">
    </x-slot>

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
        <a href="{{ route('contracts.index') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    قرارداد ها
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
        <a href="{{ route('contracts.show', $payment->contract->id) }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    مشاهده قرارداد {{ $payment->contract->name }}
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
        <a href="{{ route('contracts.payments.index', $payment->contract->id) }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    مدیریت پرداخت های {{ $payment->contract->name }}
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
                    ویرایش پرداخت
                </p>
            </div>
        </div>
    </div>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('contracts.payments.update', $payment->id) }}" class="mt-4">
        @csrf
        @method('PATCH')

        <div class="card">
            <div class="card-header">
                <p class="card-title">
                    مشخصات کلی
                </p>
            </div>

            <div class="mb-4">
                <label for="inputCashType" class="form-label">نوع پرداختی</label>
                <select name="cash_type" id="inputCashType" class="input-text">
                    <option value="">انتخاب کنید</option>
                    <option value="check" {{ old('cash_type', $payment->cash_type) == 'check' ? 'selected' : '' }}>
                        چک
                    </option>
                    <option value="cash" {{ old('cash_type', $payment->cash_type) == 'cash' ? 'selected' : '' }}>
                        نقدی
                    </option>
                </select>
            </div>

            <div class="mb-4">
                <label for="inputPrice" class="form-label">
                    مبلغ واریزی (تومان)
                    <span class="mr-4 text-sm font-medium" id="priceSection">

                    </span>
                </label>
                <input type="text" id="inputPrice" name="price" class="input-text"
                       value="{{ old('price', $payment->price) }}"
                       placeholder="مثلا : 10000000" onkeyup="showPrice(event)">
            </div>

            <div class="mb-4">
                <label for="inputDate" class="form-label">تاریخ وصول / واریز</label>
                <input type="text" id="inputDate" name="date" class="input-text"
                       value="{{ old('date', $date) }}"
                       placeholder="برای انتخاب تاریخ کلیک کنید">
            </div>

            <div class="mb-4">
                <label for="inputText" class="form-label">شرح</label>
                <input type="text" id="inputText" name="text" class="input-text"
                       value="{{ old('text', $payment->text) }}"
                       placeholder="مثلا : چک دو ماهه به شماره 155555">
            </div>

            <div class="mb-4">
                <label for="inputType" class="form-label">بابت</label>
                <select name="type" id="inputType" class="input-text">
                    <option value="">انتخاب کنید</option>
                    <option value="prepayment" {{ old('type', $payment->type) == 'prepayment' ? 'selected' : '' }}>
                        پیش پرداخت
                    </option>
                    <option
                            value="interim_payment" {{ old('type', $payment->type) == 'interim_payment' ? 'selected' : '' }}>
                        میان پرداخت
                    </option>
                    <option value="clearing" {{ old('type', $payment->type) == 'clearing' ? 'selected' : '' }}>
                        تسویه
                    </option>
                    <option value="return" {{ old('type', $payment->type) == 'return' ? 'selected' : '' }}>
                        عودت
                    </option>
                </select>
            </div>

            <div class="mb-4">
                <label for="inputAccount" class="form-label">انتخاب حساب</label>
                <select name="account_id" id="inputAccount" class="input-text">
                    <option value="">انتخاب کنید</option>
                    @foreach($accounts as $account)
                        <option
                                value="{{ $account->id }}" {{ old('account_id', $payment->account_id) == $account->id ? 'selected' : '' }}>
                            {{ $account->bank }} | {{ $account->branch }} | {{ $account->account_number }}
                        </option>
                    @endforeach
                    <option value="0" {{ old('account_id', $payment->account_id) == "0" ? 'selected' : '' }}>
                        سایر
                    </option>
                </select>
            </div>

        </div>

        <div class="flex items-center space-x-4 space-x-reverse">
            <button type="submit" class="form-edit-btn" id="submit-button">
                بروزرسانی پرداخت
            </button>
            <a href="{{ route('contracts.payments.index', $payment->contract_id) }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>
