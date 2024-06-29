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
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    ویرایش دسته بندی {{ $category->name }}
                </p>
            </div>
        </div>
    </div>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('categories.update',$category->id) }}" class="md:grid grid-cols-2 gap-4 mt-4" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="card">
            <div class="card-header">
                <p class="card-title">مشخصات کلی</p>
            </div>
            <div class="mt-4">
                <label for="inputName" class="form-label">نام دسته بندی</label>
                <input type="text" id="inputName" name="name" class="input-text" placeholder="مثال : پیچ"
                       value="{{ old('name') ?? $category->name }}">
            </div>
            <div class="mt-4">
                <label for="inputNameEn" class="form-label">نام انگلیسی دسته بندی</label>
                <input type="text" id="inputNameEn" name="name_en" class="input-text" placeholder="مثال : Filters"
                       value="{{ old('name_en') ?? $category->name_en }}">
            </div>
            <div class="mt-4">
                <label for="inputParent" class="form-label">دسته بندی مرتبط</label>
                <select name="parent_id" id="inputParent" class="input-text">
                    <option value="0">خودش</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $category->parent_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }} | {{ $cat->code }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <p class="card-title">کد و تصویر</p>
            </div>

            <div class="mt-4">
                <label for="inputCode" class="form-label">کد دسته بندی</label>
                <input type="text" id="inputCode" name="code" class="input-text" placeholder="مثال : 1010 (4 رقم)"
                       value="{{ $category->code }}">
            </div>

            <div class="mt-4">
                <label for="inputImage" class="form-label">تصویر دسته بندی</label>
                <input type="file" id="inputImage" name="image" class="input-text" value="{{ old('image', $category->image) }}">
            </div>
        </div>

        <div class="flex items-center space-x-4 space-x-reverse">
            <button type="submit" class="form-edit-btn">
                بروزرسانی دسته بندی
            </button>
            <a href="{{ url(session('prev-url', route('categories.index'))) }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>
