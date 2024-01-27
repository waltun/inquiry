<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/date-picker/persianDatepicker.min.js') }}"></script>
        <script>
            $("#inputSendDate").persianDatepicker({
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
        <a href="{{ route('serials.index') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5zM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0113.5 9.375v-4.5z"/>
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M6.75 6.75h.75v.75h-.75v-.75zM6.75 16.5h.75v.75h-.75v-.75zM16.5 6.75h.75v.75h-.75v-.75zM13.5 13.5h.75v.75h-.75v-.75zM13.5 19.5h.75v.75h-.75v-.75zM19.5 13.5h.75v.75h-.75v-.75zM19.5 19.5h.75v.75h-.75v-.75zM16.5 16.5h.75v.75h-.75v-.75z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    لیست شماره سریال محصولات
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
                    ویرایش شماره سریال {{ $serial->number }}
                </p>
            </div>
        </div>
    </div>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <!-- Create User form -->
    <form action="{{ route('serials.update',$serial->id) }}" method="post" class="mt-11">
        @csrf
        @method('PATCH')

        <div class="card">
            <div class="card-header">
                <p class="card-title">
                    خریدار و مدل محصول
                </p>
            </div>
            <div class="mb-4 grid grid-cols-12 gap-4 items-center">
                <div class="col-span-2">
                    <label for="inputBuyer" class="form-label">
                        <span class="font-bold text-red-600">* </span>خریدار :
                    </label>
                </div>
                <div class="col-span-10">
                    <input type="text" name="buyer" id="inputBuyer" class="input-text" placeholder="نام خریدار"
                           value="{{ old('buyer') ?? $serial->buyer }}">
                </div>
            </div>
            <div class="grid grid-cols-12 gap-4 items-center">
                <div class="col-span-2">
                    <label for="inputModel" class="form-label">
                        <span class="font-bold text-red-600">* </span>مدل دستگاه :
                    </label>
                </div>
                <div class="col-span-10">
                    <input type="text" name="model" id="inputModel" class="input-text" placeholder="مدل دستگاه"
                           value="{{ old('model') ?? $serial->model }}">
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <p class="card-title">
                    مشخصات کلی
                </p>
            </div>
            <div class="mb-4 grid grid-cols-12 gap-4 items-center">
                <div class="col-span-2">
                    <label for="inputYear" class="form-label">
                        <span class="font-bold text-red-600">* </span>سال تولید :
                    </label>
                </div>
                <div class="col-span-10">
                    <input type="text" name="year" id="inputYear" class="input-text"
                           placeholder="سال تولید (کامل) : 1402" value="{{ old('year') ?? $serial->year }}">
                </div>
            </div>
            <div class="mb-4 grid grid-cols-12 gap-4 items-center">
                <div class="col-span-2">
                    <label for="inputSerial" class="form-label">
                        <span class="font-bold text-red-600">* </span>شماره سریال :
                    </label>
                </div>
                <div class="col-span-10">
                    <input type="text" name="serial" id="inputSerial" class="input-text"
                           placeholder="شماره سریال (فقط عدد)" value="{{ old('serial') ?? $serial->serial }}">
                </div>
            </div>
            <div class="grid grid-cols-12 gap-4 items-center">
                <div class="col-span-2">
                    <label for="inputNumber" class="form-label">
                        <span class="font-bold text-red-600">* </span>شماره قرارداد :
                    </label>
                </div>
                <div class="col-span-10">
                    <input type="text" name="number" id="inputNumber" class="input-text"
                           placeholder="شماره قرارداد (فقط عدد)" value="{{ old('number') ?? $serial->number }}">
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <p class="card-title">
                    تاریخ و نوع
                </p>
            </div>
            <div class="mb-4 grid grid-cols-12 gap-4 items-center">
                <div class="col-span-2">
                    <label for="inputType" class="form-label">
                        <span class="font-bold text-red-600">* </span>نوع قرارداد :
                    </label>
                </div>
                <div class="col-span-10">
                    <select name="type" id="inputType" class="input-text">
                        <option value="">انتخاب کنید</option>
                        <option value="official" {{ $serial->type == 'official' ? 'selected' : '' }}>
                            رسمی
                        </option>
                        <option value="operational" {{ $serial->type == 'operational' ? 'selected' : '' }}>
                            عملکردی
                        </option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-4 items-center">
                <div class="col-span-2">
                    <label for="inputSendDate" class="form-label">
                        تاریخ ارسال :
                    </label>
                </div>
                <div class="col-span-10">
                    <input type="text" name="send_date" id="inputSendDate" class="input-text" value="{{ $date }}">
                </div>
            </div>
        </div>

        <div class="flex space-x-4 space-x-reverse sticky bottom-4 z-50">
            <button type="submit" class="form-edit-btn">
                بروزرسانی شماره سریال
            </button>
            <a href="{{ route('serials.index') }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>
