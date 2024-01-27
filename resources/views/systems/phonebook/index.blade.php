<x-layout>
    <x-slot name="js">
        <script>
            function changeCategory() {
                let form = document.getElementById('category-search');
                form.submit();
            }
        </script>
    </x-slot>

    <!-- Breadcrumb -->
    <div class="breadcrumb">
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
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg-active">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    لیست دفترچه تلفن
                </p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="flex items-center justify-between mt-8">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-8 h-8 dark:text-white">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3"/>
            </svg>
            <div class="mr-2 flex items-center space-x-4 space-x-reverse">
                <p class="font-bold text-lg text-black dark:text-white">
                    لیست دفترچه تلفن
                </p>
                @if(request()->has('search') || request()->has('category'))
                    <a href="{{ route('phonebook.index') }}" class="text-sm font-bold text-indigo-500 underline">
                        پاکسازی فیلتر
                    </a>
                @endif
            </div>
        </div>
        @can('create-phonebook')
            <div>
                <a href="{{ route('phonebook.create') }}" class="page-success-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                    <span class="mr-2">ایجاد شماره جدید</span>
                </a>
            </div>
        @endcan
    </div>

    <!-- Search -->
    <div class="grid grid-cols-4 gap-8 my-4 bg-sky-100 p-2 rounded-lg shadow dark:bg-slate-900">
        <form class="col-span-1">
            <div class="flex rounded-md shadow-sm">
                <input type="text" name="search" id="inputSearch" class="input-text rounded-l-none py-2.5"
                       placeholder="جستجو..." value="{{ request('search') }}">
                <button type="submit" class="search-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
                    </svg>
                </button>
            </div>
        </form>
        <form class="col-span-3 grid grid-cols-3 gap-4" id="category-search">
            <div>
                <select name="category" id="inputCategory" class="input-text" onchange="changeCategory()">
                    <option value="">انتخاب کنید</option>
                    <option value="مشتریان" {{ request('category') == 'مشتریان' ? 'selected' : '' }}>
                        مشتریان
                    </option>
                    <option value="تامین کنندگان" {{ request('category') == 'تامین کنندگان' ? 'selected' : '' }}>
                        تامین کنندگان
                    </option>
                    <option value="مهندسین مشاور" {{ request('category') == 'مهندسین مشاور' ? 'selected' : '' }}>
                        مهندسین مشاور
                    </option>
                    <option value="تبلیغات" {{ request('category') == 'تبلیغات' ? 'selected' : '' }}>
                        تبلیغات
                    </option>
                    <option value="همکاران" {{ request('category') == 'همکاران' ? 'selected' : '' }}>
                        همکاران
                    </option>
                    <option value="بانک" {{ request('category') == 'بانک' ? 'selected' : '' }}>
                        بانک
                    </option>
                    <option value="بیمه" {{ request('category') == 'بیمه' ? 'selected' : '' }}>
                        بیمه
                    </option>
                    <option value="ادارات دولتی" {{ request('category') == 'ادارات دولتی' ? 'selected' : '' }}>
                        ادارات دولتی
                    </option>
                    <option value="سایر" {{ request('category') == 'سایر' ? 'selected' : '' }}>
                        سایر
                    </option>
                </select>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="mt-8 overflow-x-auto rounded-lg">
        <table class="w-full border-collapse">
            <thead>
            <tr class="table-th-tr">
                <th scope="col" class="p-4 rounded-tr-lg">
                    #
                </th>
                <th scope="col" class="p-4 text-right">
                    دسته بندی
                </th>
                <th scope="col" class="p-4 text-right">
                    شرح
                </th>
                <th scope="col" class="p-4 text-right">
                    نوع فعالیت
                </th>
                <th scope="col" class="p-4">
                    تلفن اول
                </th>
                <th scope="col" class="p-4">
                    موبایل اول
                </th>
                <th scope="col" class="p-4 rounded-tl-lg">
                    اقدامات
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($phonebooks as $phonebook)
                <tr class="table-tb-tr group {{ $loop->even ? 'bg-sky-100' : '' }}">
                    <td class="table-tr-td border-t-0 border-l-0">
                        {{ $loop->index + 1 }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0 text-right">
                        {{ $phonebook->category }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0 text-right">
                        {{ $phonebook->title }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0 text-right">
                        {{ $phonebook->activity }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0">
                        {{ $phonebook->phone1 }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0">
                        {{ $phonebook->mobile1 }}
                    </td>
                    <td class="table-tr-td border-t-0 border-r-0 flex items-center space-x-4 space-x-reverse">
                        <div class="flex justify-center items-center w-full space-x-4 space-x-reverse">
                            <div class="table-parent-dropdown" x-data="{open:false}">
                                <button @click="open = !open">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/>
                                    </svg>
                                </button>
                                <div x-show="open" @click.away="open = false" x-cloak
                                     class="table-dropdown -top-10 -right-28">
                                    <a href="{{ route('phonebook.edit',$phonebook->id) }}"
                                       class="table-dropdown-edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                        </svg>
                                        ویرایش
                                    </a>
                                    <form action="{{ route('phonebook.destroy',$phonebook->id) }}" method="POST"
                                          class="table-dropdown-delete">
                                        @csrf
                                        @method('DELETE')
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                        </svg>
                                        <button onclick="return confirm('تلفن حذف شود ؟')">
                                            حذف
                                        </button>
                                    </form>
                                </div>
                            </div>

                            @can('show-phonebook')
                                <div x-data="{open:false}">
                                    <button type="button" class="table-questions" @click="open = !open">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5"
                                             stroke="currentColor" class="w-4 h-4 ml-1">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        جزئیات کامل
                                    </button>

                                    <!-- Phonebook Detail Modal -->
                                    <div class="relative z-10" x-show="open" x-cloak>
                                        <div class="modal-backdrop"></div>
                                        <div class="fixed z-10 inset-0 overflow-y-auto">
                                            <div class="modal">
                                                <div class="modal-body">
                                                    <div class="bg-white dark:bg-slate-800 p-4">
                                                        <div class="mb-4 flex justify-between items-center">
                                                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                                مشاهده جزئیات دفترچه تلفن
                                                            </h3>
                                                            <button type="button" @click="open = false">
                                                                <span class="modal-close">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                         viewBox="0 0 24 24"
                                                                         stroke-width="1.5" stroke="currentColor"
                                                                         class="w-5 h-5 dark:text-white">
                                                                        <path stroke-linecap="round"
                                                                              stroke-linejoin="round"
                                                                              d="M6 18L18 6M6 6l12 12"/>
                                                                    </svg>
                                                                </span>
                                                            </button>
                                                        </div>
                                                        <div class="mt-6 grid grid-cols-2 gap-4">
                                                            <div class="card bg-sky-100">
                                                                <div class="mb-4 grid grid-cols-12 gap-2 items-center">
                                                                    <div class="col-span-2">
                                                                        <p class="form-label text-left">شرح :</p>
                                                                    </div>
                                                                    <div class="col-span-10">
                                                                        <div class="input-div">
                                                                            {{ $phonebook->title ?? '-' }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-4 grid grid-cols-12 gap-4 items-center">
                                                                    <div class="col-span-2">
                                                                        <p class="form-label text-left">نوع :</p>
                                                                    </div>
                                                                    <div class="col-span-10">
                                                                        <div class="input-div">
                                                                            {{ $phonebook->activity ?? '-' }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-4 grid grid-cols-12 gap-4 items-center">
                                                                    <div class="col-span-2">
                                                                        <p class="form-label text-left">تلفن 1 :</p>
                                                                    </div>
                                                                    <div class="col-span-10">
                                                                        <div class="input-div">
                                                                            {{ $phonebook->phone1 ?? '-' }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-4 grid grid-cols-12 gap-4 items-center">
                                                                    <div class="col-span-2">
                                                                        <p class="form-label text-left">تلفن 2 :</p>
                                                                    </div>
                                                                    <div class="col-span-10">
                                                                        <div class="input-div">
                                                                            {{ $phonebook->phone2 ?? '-' }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-4 grid grid-cols-12 gap-4 items-center">
                                                                    <div class="col-span-2">
                                                                        <p class="form-label text-left">موبایل 1 :</p>
                                                                    </div>
                                                                    <div class="col-span-10">
                                                                        <div class="input-div">
                                                                            {{ $phonebook->mobile1 ?? '-' }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-4 grid grid-cols-12 gap-4 items-center">
                                                                    <div class="col-span-2">
                                                                        <p class="form-label text-left">موبایل 2 :</p>
                                                                    </div>
                                                                    <div class="col-span-10">
                                                                        <div class="input-div">
                                                                            {{ $phonebook->mobile2 ?? '-' }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="grid grid-cols-12 gap-4 items-center">
                                                                    <div class="col-span-2">
                                                                        <p class="form-label text-left">ایمیل :</p>
                                                                    </div>
                                                                    <div class="col-span-10">
                                                                        <div class="input-div">
                                                                            {{ $phonebook->email ?? '-' }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="card bg-sky-100">
                                                                <div class="mb-4 grid grid-cols-12 gap-4 items-start">
                                                                    <div class="col-span-2">
                                                                        <p class="form-label text-left">توضیحات :</p>
                                                                    </div>
                                                                    <div class="col-span-10">
                                                                        <div class="input-div h-32">
                                                                            {{ $phonebook->description ?? '-' }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-4 grid grid-cols-12 gap-4 items-start">
                                                                    <div class="col-span-2">
                                                                        <p class="form-label text-left">آدرس :</p>
                                                                    </div>
                                                                    <div class="col-span-10">
                                                                        <div class="input-div h-32">
                                                                            {{ $phonebook->address ?? '-' }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-4 grid grid-cols-12 gap-4 items-center">
                                                                    <div class="col-span-2">
                                                                        <p class="form-label text-left">کد پستی :</p>
                                                                    </div>
                                                                    <div class="col-span-10">
                                                                        <div class="input-div">
                                                                            {{ $phonebook->postal ?? '' }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-4 grid grid-cols-12 gap-4 items-center">
                                                                    <div class="col-span-2">
                                                                        <p class="form-label text-left">دسته بندی :</p>
                                                                    </div>
                                                                    <div class="col-span-10">
                                                                        <div class="input-div">
                                                                            {{ $phonebook->category }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                        </div>
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
</x-layout>
