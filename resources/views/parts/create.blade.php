<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script>
            function getCategory1() {
                let id = document.getElementById('inputCategory1').value;
                let section = document.getElementById('categorySection1');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('parts.getCategory') }}',
                    data: {
                        id: id,
                    },
                    success: function (res) {
                        if (res.data != null) {
                            section.innerHTML = `
                            <label for="inputCategory" class="form-label">زیر دسته</label>
                            <select class="input-text" onchange="getCategory2()" id="inputCategory2" name="categories[]">
                                <option value="">انتخاب کنید</option>
                                    ${
                                res.data.map(function (category) {
                                    return `<option value="${category.id}">${category.name}</option>`
                                })
                            }
                            </select>`
                        }
                    }
                });
            }

            function getCategory2() {
                let id = document.getElementById('inputCategory2').value;
                let section = document.getElementById('categorySection2');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('parts.getCategory') }}',
                    data: {
                        id: id,
                    },
                    success: function (res) {
                        if (res.data != null) {
                            section.innerHTML = `
                            <label for="inputCategory3" class="form-label">زیر دسته</label>
                            <select class="input-text" name="categories[]" id="inputCategory3">
                                <option value="">انتخاب کنید</option>
                                    ${
                                res.data.map(function (category) {
                                    return `<option value="${category.id}">${category.name}</option>`
                                })
                            }
                            </select>`
                        }
                    }
                });
            }
        </script>
        <script>
            function showPrice(event) {
                let value = event.target.value;
                let priceSection = document.getElementById('price');
                priceSection.innerText = Intl.NumberFormat('fa-IR').format(value);
            }
        </script>
        <script>
            let submitButton = document.getElementById('submit-button');
            submitButton.addEventListener('click', function () {
                submitButton.classList.add('hidden')
            });
        </script>
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
        <a href="{{ route('dashboard') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="breadcrumb-svg" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    مدیریت قطعات
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
                    ایجاد قطعه جدید
                </p>
            </div>
        </div>
    </div>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('parts.store') }}" class="md:grid grid-cols-2 gap-4 mt-4">
        @csrf

        <div class="card">
            <div class="card-header">
                <p class="card-title">
                    مشخصات کلی
                </p>
            </div>

            <div class="mb-4">
                <label for="inputName" class="form-label">نام قطعه</label>
                <input type="text" id="inputName" name="name" class="input-text"
                       placeholder="مثال : ورق گالوانیزه به ضخامت 0.3" value="{{ old('name') }}">
            </div>

            <div class="mb-4">
                <label for="inputNameEng" class="form-label">نام انگلیسی قطعه</label>
                <input type="text" id="inputNameEng" name="name_en" class="input-text"
                       placeholder="مثال : Aluminium" value="{{ old('name_en') }}">
            </div>

            <div class="mb-4">
                <label for="inputWeight" class="form-label">وزن قطعه (کیلوگرم)</label>
                <input type="text" id="inputWeight" name="weight" class="input-text"
                       placeholder="مثال : 120" value="{{ old('weight') }}">
            </div>

            <div class="mt-4">
                <label for="inputCollection" class="form-label">قطعه مجموعه ای</label>
                <select name="collection" id="inputCollection" class="input-text">
                    <option value="false" {{ old('collection') == 'false' ? 'selected' : '' }}>نباشد</option>
                    <option value="true" {{ old('collection') == 'true' ? 'selected' : '' }}>باشد</option>
                </select>
            </div>

            <div class="mt-4">
                <label for="inputExtract" class="form-label">
                    اکسترکت شدن قطعات زیرمجموعه در بخش قرارداد
                </label>
                <select name="extract" id="inputExtract" class="input-text">
                    <option value="0" {{ old('extract') == '0' ? 'selected' : '' }}>
                        اکسترکت نشود
                    </option>
                    <option value="1" {{ old('extract') == '1' ? 'selected' : '' }}>
                        اکسترکت شود
                    </option>
                </select>
            </div>

        </div>

        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    دسته بندی
                </div>
            </div>

            <div class="mb-4">
                <label for="inputCategory1" class="form-label">دسته بندی قطعه</label>
                <select name="categories[]" id="inputCategory1" class="input-text" onchange="getCategory1()">
                    <option value="">انتخاب کنید</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4" id="categorySection1">

            </div>
            <div class="mt-4" id="categorySection2">

            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <p class="card-title">
                    واحد و تبدیل واحد
                </p>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="inputUnit" class="form-label">واحد اول قطعه</label>
                    <input type="text" id="inputUnit" name="unit" class="input-text" placeholder="مثال : کیلوگرم"
                           value="{{ old('unit') }}">
                </div>

                <div class="mb-4">
                    <label for="inputUnit2" class="form-label">واحد دوم قطعه</label>
                    <input type="text" id="inputUnit2" name="unit2" class="input-text" placeholder="مثال : متر"
                           value="{{ old('unit2') }}">
                </div>

                <div class="mb-4 flex items-center space-x-4 space-x-reverse">
                    <p class="md:text-sm text-xs text-black whitespace-nowrap">
                        واحد اول = واحد دوم
                    </p>
                    <select name="operator1" id="inputOperator1" class="input-text w-20">
                        <option value="*">x</option>
                        <option value="/">/</option>
                        <option value="+">+</option>
                        <option value="-">-</option>
                    </select>
                    <input type="text" class="input-text" id="inputFormula1" name="formula1">
                </div>

                <div class="mb-4 flex items-center space-x-4 space-x-reverse">
                    <p class="md:text-sm text-xs text-black whitespace-nowrap">
                        واحد دوم = واحد اول
                    </p>
                    <select name="operator2" id="inputOperator2" class="input-text w-20">
                        <option value="*">x</option>
                        <option value="/">/</option>
                        <option value="+">+</option>
                        <option value="-">-</option>
                    </select>
                    <input type="text" class="input-text" id="inputFormula2" name="formula2">
                </div>
            </div>

        </div>

        <div class="card">
            <div class="card-header">
                <p class="card-title">
                    قیمت
                </p>
            </div>

            <div class="mt-4">
                <label for="inputPrice" class="form-label">قیمت قطعه</label>
                <input type="text" id="inputPrice" name="price" class="input-text" value="{{ old('price') }}"
                       onkeyup="showPrice(event)">
            </div>

            <div class="mt-2">
                <p class="text-center text-lg font-bold">
                    <span id="price">0</span>
                    تومان
                </p>
            </div>
        </div>

        <div class="flex items-center space-x-4 space-x-reverse">
            <button type="submit" class="form-submit-btn" id="submit-button">
                ثبت قطعه
            </button>
            <a href="{{ route('parts.index') }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>
