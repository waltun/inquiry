<x-layout>
    <x-slot name="js">
        <script>
            let submitButton = document.getElementById('submit-button');
            submitButton.addEventListener('click',function (){
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
        <a href="{{ route('categories.index') }}" class="flex items-center">
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
                    ایجاد دسته بندی جدید
                </p>
            </div>
        </div>
    </div>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('categories.store') }}" class="md:grid grid-cols-2 gap-4 mt-4">
        @csrf

        <div class="card">
            <div class="card-header">
                <p class="card-title">مشخصات کلی</p>
            </div>
            <div class="mt-4">
                <label for="inputName" class="form-label">نام دسته بندی</label>
                <input type="text" id="inputName" name="name" class="input-text" placeholder="مثال : پیچ"
                       value="{{ old('name') }}">
            </div>
            @if(request()->has('parent'))
                <div class="mt-4">
                    <label for="inputParent" class="form-label">
                        دسته بندی مرتبط
                    </label>
                    @php
                        $category = \App\Models\Category::find(request('parent'));
                    @endphp
                    <input type="text" class="input-text bg-gray-200 cursor-not-allowed"
                           value="{{ $category->name }}" disabled>
                    <input type="hidden" name="parent_id" value="{{ $category->id }}">
                </div>
            @else
                <div class="mt-4">
                    <label for="inputParent" class="form-label">دسته بندی
                        مرتبط</label>
                    <select name="parent_id" id="inputParent" class="input-text">
                        <option value="0">خودش</option>
                        @foreach($categories as $category)
                            <option
                                value="{{ $category->id }}" {{ old('parent_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }} | {{ $category->code }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif
        </div>

        <div class="card">
           <div class="card-header">
               <p class="card-title">کد</p>
           </div>
            <div class="mt-4">
                <label for="inputCode" class="form-label">کد دسته بندی</label>
                <input type="text" id="inputCode" name="code" class="input-text" placeholder="مثال : 1010 (4 رقم)"
                       value="{{ $code }}">
            </div>
        </div>

        <div class="flex items-center space-x-4 space-x-reverse">
            <button type="submit" class="form-submit-btn" id="submit-button">
                ثبت دسته بندی
            </button>
            <a href="{{ route('categories.index') }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>
