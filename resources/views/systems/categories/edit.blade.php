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
        <a href="{{ route('system-categories.index') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="breadcrumb-svg" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    مدیریت دسته بندی ها
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
                    ویرایش دسته بندی {{ $system_category->name }}
                </p>
            </div>
        </div>
    </div>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <!-- Create User form -->
    <form action="{{ route('system-categories.update',$system_category->id) }}" method="post" class="mt-11">
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
                    <input type="text" name="name" id="inputName" class="input-text" placeholder="نام دسته بندی"
                           value="{{ old('name') ?? $system_category->name }}">
                </div>
            </div>
            <div class="mb-4 grid grid-cols-12 gap-4 items-center">
                <div class="col-span-2">
                    <label for="inputParent" class="form-label">
                        <span class="font-bold text-red-600">* </span>دسته مربوطه :
                    </label>
                </div>
                <div class="col-span-10">
                    @if(request()->has('parent'))
                        @php
                            $system_category = \App\Models\Category::find(request('parent'));
                        @endphp
                        <input type="text" class="input-text bg-gray-200 cursor-not-allowed" id="inputParent"
                               value="{{ $system_category->name }}" disabled>
                        <input type="hidden" name="parent_id" value="{{ $system_category->id }}">
                    @else
                        <select name="parent_id" id="inputParent" class="input-text">
                            <option value="0" {{ $system_category->parent_id == 0 ? 'selected' : '' }}>خودش</option>
                            @foreach($categories as $category2)
                                <option
                                    value="{{ $category2->id }}" {{ $system_category->parent_id == $category2->id ? 'selected' : '' }}>
                                    {{ $category2->name }}
                                </option>
                            @endforeach
                        </select>
                    @endif

                </div>
            </div>
            <div class="mb-4 grid grid-cols-12 gap-4 items-center">
                <div class="col-span-2">
                    <label for="inputCode" class="form-label">
                        <span class="font-bold text-red-600">* </span>کد :
                    </label>
                </div>
                <div class="col-span-10">
                    <input type="text" name="code" id="inputCode" class="input-text" placeholder="کد دسته بندی"
                           value="{{ old('code') ?? $system_category->code }}">
                </div>
            </div>
        </div>

        <div class="flex space-x-4 space-x-reverse sticky bottom-4 z-50">
            <button type="submit" class="form-edit-btn">
                بروزرسانی دسته بندی
            </button>
            <a href="{{ route('system-categories.index') }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>
