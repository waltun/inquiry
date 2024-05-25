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

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('contracts.marketings.payments.store', $marketing->id) }}" class="mt-4">
        @csrf

        <div class="card">
            <div class="card-header">
                <p class="card-title">
                    مشخصات کلی
                </p>
            </div>

            <div class="mb-4 flex justify-center">
                <p class="bg-indigo-500 rounded-lg px-6 py-2 text-white">
                    بازاریاب : {{ $marketing->marketer->name }}
                </p>
            </div>

            <div class="mb-4">
                <label for="inputPrice" class="form-label">
                    مبلغ (تومان)
                    <span class="mr-4 text-sm font-medium" id="priceSection">

                    </span>
                </label>
                <input type="text" id="inputPrice" name="price" class="input-text" value="{{ old('price') }}"
                       placeholder="مثلا : 10000000" onkeyup="showPrice(event)">
            </div>

            <div class="mb-4">
                <label for="inputDate" class="form-label">تاریخ واریز</label>
                <input type="text" id="inputDate" name="date" class="input-text" value="{{ old('date') }}"
                       placeholder="برای انتخاب تاریخ کلیک کنید">
            </div>

            <div class="mb-4">
                <label for="inputText" class="form-label">شرح</label>
                <input type="text" id="inputText" name="text" class="input-text" value="{{ old('text') }}"
                       placeholder="مثلا : چک دو ماهه به شماره 155555">
            </div>

            <div class="mb-4">
                <label for="inputAccount" class="form-label">انتخاب حساب بازاریاب</label>
                <select name="marketer_account_id" id="inputAccount" class="input-text">
                    <option value="">انتخاب کنید</option>
                    @foreach($accounts as $account)
                        <option value="{{ $account->id }}" {{ old('marketer_account_id') == $account->id ? 'selected' : '' }}>
                            {{ $account->bank_name }} به نام {{ $account->account_name }} | {{ $account->shaba_number }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="inputType" class="form-label">نوع پرداختی (اگر نیست خالی بگذارید)</label>
                <select name="type" id="inputType" class="input-text">
                    <option value="">انتخاب کنید</option>
                    <option value="return" {{ old('type') == 'return' ? 'selected' : '' }}>
                        عودت
                    </option>
                </select>
            </div>

        </div>

        <div class="flex items-center space-x-4 space-x-reverse">
            <button type="submit" class="form-submit-btn" id="submit-button">
                ثبت پرداخت بازاریابی
            </button>
            <a href="{{ route('contracts.marketings.payments.index', $marketing->id) }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>
