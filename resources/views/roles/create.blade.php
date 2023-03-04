<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
        <script>
            $("#inputPermissions").select2()
        </script>
    </x-slot>

    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
    </x-slot>

    <!-- Breadcrumb -->
    <nav class="flex bg-gray-100 p-4 rounded-md overflow-x-auto whitespace-nowrap" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-2 space-x-reverse">
            <li class="inline-flex items-center">
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center text-xs md:text-sm text-gray-500 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20"
                         fill="currentColor">
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                    داشبورد
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                              clip-rule="evenodd"/>
                    </svg>
                    <a href="{{ route('roles.index') }}"
                       class="mr-2 text-xs md:text-sm font-medium text-gray-500 hover:text-gray-900">
                        مدیریت نقش ها
                    </a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                              clip-rule="evenodd"/>
                    </svg>
                    <span class="mr-2 text-xs md:text-sm font-medium text-gray-400">
                        ایجاد نقش جدید
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('roles.store') }}" class="mt-4">
        @csrf

        <div class="bg-white shadow-sm p-4 rounded-md border border-gray-200 mb-4">
            <p class="md:text-sm text-xs text-black font-bold border-b-2 border-teal-400 pb-3">مشخصات کلی</p>

            <div class="mt-4">
                <label for="inputName" class="block mb-2 md:text-sm text-xs text-black">نام نقش</label>
                <input type="text" id="inputName" name="name" class="input-text"
                       placeholder="مثال : manage-user" value="{{ old('name') }}">
            </div>

            <div class="mt-4">
                <label for="inputLabel" class="block mb-2 md:text-sm text-xs text-black">توضیحات نقش</label>
                <input type="text" id="inputLabel" name="label" class="input-text"
                       placeholder="مثال : بخش کاربران" value="{{ old('label') }}">
            </div>

            <div class="mt-4">
                <label for="inputPermissions" class="block mb-2 md:text-sm text-xs text-black">دسترسی ها</label>
                <select name="permissions[]" id="inputPermissions" class="input-text" multiple>
                    @foreach($permissions as $permission)
                        <option value="{{ $permission->id }}">
                            {{ $permission->name }} | {{ $permission->label }}
                        </option>
                    @endforeach
                </select>
            </div>

        </div>

        <div class="space-x-2 space-x-reverse">
            <button type="submit" class="form-submit-btn">
                ثبت نقش
            </button>
            <a href="{{ route('roles.index') }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>
