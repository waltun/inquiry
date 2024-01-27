<x-layout>
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
        <a href="{{ route('coding.index') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    لیست کدینگ انبار
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
                    ویرایش کدینگ {{ $coding->name }}
                </p>
            </div>
        </div>
    </div>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <!-- Create User form -->
    <form action="{{ route('coding.update',$coding->id) }}" method="post" class="mt-11">
        @csrf
        @method('PATCH')

        <div class="card">
            <div class="card-header">
                <p class="card-title">
                    مشخصات کلی
                </p>
            </div>
            <div class="mb-4 grid grid-cols-12 gap-4 items-center">
                <div class="col-span-2">
                    <label for="inputName" class="form-label">
                        <span class="font-bold text-red-600">* </span>نام :
                    </label>
                </div>
                <div class="col-span-10">
                    <input type="text" name="name" id="inputName" class="input-text" placeholder="نام محصول/قطعه"
                           value="{{ old('name') ?? $coding->name }}">
                </div>
            </div>
            <div class="mb-4 grid grid-cols-12 gap-4 items-center">
                <div class="col-span-2">
                    <label for="inputUnit" class="form-label">
                        <span class="font-bold text-red-600">* </span>واحد :
                    </label>
                </div>
                <div class="col-span-10">
                    <input type="text" name="unit" id="inputUnit" class="input-text" placeholder="واحد محصول/قطعه"
                           value="{{ old('unit') ?? $coding->unit }}">
                </div>
            </div>
            <div class="mb-4 grid grid-cols-12 gap-4 items-center">
                <div class="col-span-2">
                    <label for="inputStore" class="form-label">
                        <span class="font-bold text-red-600">* </span>انبار مربوطه :
                    </label>
                </div>
                <div class="col-span-10">
                    <select name="store" id="inputStore" class="input-text">
                        <option value="">انتخاب کنید</option>
                        <option value="10" {{ $coding->store == '10' ? 'selected' : '' }}>
                            انبار مواد اولیه | 10
                        </option>
                        <option value="12" {{ $coding->store == '12' ? 'selected' : '' }}>
                            انبار ملزومات | 12
                        </option>
                        <option value="14" {{ $coding->store == '14' ? 'selected' : '' }}>
                            انبار محصولات | 14
                        </option>
                    </select>
                </div>
            </div>
            <div class="mb-4 grid grid-cols-12 gap-4 items-center">
                <div class="col-span-2">
                    <label for="inputCode" class="form-label">
                        <span class="font-bold text-red-600">* </span>کدینگ :
                    </label>
                </div>
                <div class="col-span-10">
                    <input type="text" name="code" id="inputCode" class="input-text" placeholder="کدینگ محصول/قطعه"
                           value="{{ old('code') ?? $coding->code }}">
                </div>
            </div>
        </div>

        <div class="flex space-x-4 space-x-reverse sticky bottom-4 z-50">
            <button type="submit" class="form-edit-btn">
                بروزرسانی کدینگ
            </button>
            <a href="{{ route('coding.index') }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>
