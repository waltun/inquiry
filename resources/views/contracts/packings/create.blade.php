<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
        <script>
            $("#inputName").select2({
                tags: true
            });
            $("#inputType").select2({
                tags: true
            });
        </script>
    </x-slot>
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
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
                    قراردادها
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
        <a href="{{ route('contracts.show', $contract->id) }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    مشاهده قرارداد {{ $contract->name }}
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
        <a href="{{ route('packings.index', $contract->id) }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    مدیریت پکینگ لیست‌ها
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
                    ایجاد پکینگ جدید
                </p>
            </div>
        </div>
    </div>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('packings.store', $contract->id) }}" class="mt-4">
        @csrf

        <div class="card">
            <div class="card-header">
                <p class="card-title">
                    مشخصات کلی
                </p>
            </div>

            <div class="mb-4 grid grid-cols-3 gap-4">
                <div>
                    <label for="inputName" class="form-label">
                        نام بسته
                    </label>
                    <select name="name" id="inputName" class="input-text">
                        <option value="">انتخاب یا وارد کنید</option>
                        @foreach($names as $name)
                            <option value="{{ $name }}" {{ old('name') == $name ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                        <option
                            value="قطعات یدکی راه اندازی" {{ old('name') == 'قطعات یدکی راه اندازی' ? 'selected' : '' }}>
                            قطعات یدکی راه اندازی
                        </option>
                        <option value="قطعات راه اندازی" {{ old('name') == 'قطعات راه اندازی' ? 'selected' : '' }}>
                            قطعات راه اندازی
                        </option>
                        <option value="قطعات نصب" {{ old('name') == 'قطعات نصب' ? 'selected' : '' }}>
                            قطعات نصب
                        </option>
                        <option
                            value="قطعات یدکی دو سالانه" {{ old('name') == 'قطعات یدکی دو سالانه' ? 'selected' : '' }}>
                            قطعات یدکی دو سالانه
                        </option>
                        <option value="قطعات کنترلی" {{ old('name') == 'قطعات کنترلی' ? 'selected' : '' }}>
                            قطعات کنترلی
                        </option>
                        <option value="کابل قدرت" {{ old('name') == 'کابل قدرت' ? 'selected' : '' }}>
                            کابل قدرت
                        </option>
                        <option value="کابل کنترلی" {{ old('name') == 'کابل کنترلی' ? 'selected' : '' }}>
                            کابل کنترلی
                        </option>
                        <option value="اقلام کابل کشی" {{ old('name') == 'اقلام کابل کشی' ? 'selected' : '' }}>
                            اقلام کابل کشی
                        </option>
                        <option value="اقلام کانال کشی" {{ old('name') == 'اقلام کانال کشی' ? 'selected' : '' }}>
                            اقلام کانال کشی
                        </option>
                        <option value="لوله و اتصالات" {{ old('name') == 'لوله و اتصالات' ? 'selected' : '' }}>
                            لوله و اتصالات
                        </option>
                        <option value="انواع کویل" {{ old('name') == 'انواع کویل' ? 'selected' : '' }}>
                            انواع کویل
                        </option>
                    </select>
                </div>
                <div>
                    <label for="inputType" class="form-label">
                        نوع بسته بندی
                    </label>
                    <select name="type" id="inputType" class="input-text">
                        <option value="">انتخاب یا وارد کنید</option>
                        <option
                            value="کاور نایلون حباب دار با تسمه بندکشی" {{ old('type') == 'کاور نایلون حباب دار با تسمه بندکشی' ? 'selected' : '' }}>
                            کاور نایلون حباب دار با تسمه بندکشی
                        </option>
                        <option
                            value="پالت چوبی با روکش نایلون حباب دار و تسمه بندکشی" {{ old('type') == 'پالت چوبی با روکش نایلون حباب دار و تسمه بندکشی' ? 'selected' : '' }}>
                            پالت چوبی با روکش نایلون حباب دار و تسمه بندکشی
                        </option>
                        <option value="کارتن" {{ old('type') == 'کارتن' ? 'selected' : '' }}>
                            کارتن
                        </option>
                        <option value="باکس چوبی" {{ old('type') == 'باکس چوبی' ? 'selected' : '' }}>
                            باکس چوبی
                        </option>
                    </select>
                </div>
                <div>
                    <label for="inputWeight" class="form-label">وزن (KG)</label>
                    <input type="text" id="inputWeight" name="weight" class="input-text" value="{{ old('weight') }}"
                           placeholder="1452">
                </div>
            </div>

            <div class="mb-4 grid grid-cols-3 gap-4">
                <div>
                    <label for="inputLength" class="form-label">طول (CM)</label>
                    <input type="text" id="inputLength" name="length" class="input-text" value="{{ old('length') }}"
                           placeholder="77">
                </div>
                <div>
                    <label for="inputWidth" class="form-label">عرض (CM)</label>
                    <input type="text" id="inputWidth" name="width" class="input-text" value="{{ old('width') }}"
                           placeholder="82">
                </div>
                <div>
                    <label for="inputHeight" class="form-label">ارتفاع (CM)</label>
                    <input type="text" id="inputHeight" name="height" class="input-text" value="{{ old('height') }}"
                           placeholder="53">
                </div>
            </div>

        </div>

        <div class="flex items-center space-x-4 space-x-reverse">
            <button type="submit" class="form-submit-btn" id="submit-button">
                ثبت پکینگ
            </button>
            <a href="{{ route('packings.index', $contract->id) }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>
