<x-layout>
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
                      d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    لیست ارسال مراسلات
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
                      d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
            </svg>
            <div class="mr-2">
                <p class="font-bold text-2xl text-black dark:text-white">
                    لیست ارسال مراسلات
                </p>
            </div>
        </div>
        @can('create-letter')
            <div>
                <a href="{{ route('letters.create') }}" class="page-success-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                    <span class="mr-2">ایجاد مکاتبه جدید</span>
                </a>
            </div>
        @endcan
    </div>

    <!-- Search -->
    <div
        class="card-search" {{ request()->has('search') || request()->has('category') ? 'x-data={open:true}' : 'x-data={open:false}' }}>
        <div class="card-header-search" @click="open = !open">
            <p class="card-title">
                جستجو
            </p>
            <div class="card-title-search">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-6 h-6 transition" :class="{'rotate-180' : open}">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                </svg>
            </div>
        </div>
        <div class="grid grid-cols-4 gap-4 pb-7" x-show="open" x-cloak>
            <form class="col-span-2 card">
                <div class="mb-4">
                    <label for="inputSearch2" class="form-label">
                        جستجو براساس عنوان، شماره و حامل نامه
                    </label>
                    <input type="text" id="inputSearch2" name="search" class="input-text"
                           placeholder="مثال : ورق گالوانیزه"
                           value="{{ request('search') }}">
                </div>
                <div class="flex justify-end">
                    <button class="form-submit-btn" type="submit">
                        جستجو
                    </button>
                </div>
            </form>
            <form class="col-span-2 card">
                <div class="mb-4">
                    <label for="inputCategory" class="form-label">
                        جستجو براساس دسته بندی نامه
                    </label>
                    <select name="category" id="inputCategory" class="input-text">
                        <option value="پیش فاکتور">
                            پیش فاکتور
                        </option>
                        <option value="معرفی نامه">
                            معرفی نامه
                        </option>
                        <option value="مکاتبات اداری">
                            مکاتبات اداری
                        </option>
                        <option value="مکاتبات با مشتریان">
                            مکاتبات با مشتریان
                        </option>
                        <option value="اعلام پایان ساخت">
                            اعلام پایان ساخت
                        </option>
                        <option value="سایر">
                            سایر
                        </option>
                    </select>
                </div>
                <div class="flex justify-end">
                    <button class="form-submit-btn" type="submit">
                        جستجو
                    </button>
                </div>
            </form>

            @if(request()->has('search') || request()->has('category'))
                <div>
                    <a href="{{ route('letters.index') }}" class="form-detail-btn text-xs">
                        پاکسازی جستجو
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Table -->
    <div class="mt-8 overflow-x-auto rounded-lg">
        <table class="w-full border-collapse">
            <thead>
            <tr class="table-th-tr">
                <th scope="col" class="p-4 rounded-tr-lg">
                    #
                </th>
                <th scope="col" class="p-4">
                    شماره نامه
                </th>
                <th scope="col" class="p-4">
                    تاریخ
                </th>
                <th scope="col" class="p-4">
                    عنوان
                </th>
                <th scope="col" class="p-4">
                    حامل نامه
                </th>
                <th scope="col" class="p-4">
                    ثبت کننده
                </th>
                <th scope="col" class="p-4">
                    کاربر
                </th>
                <th scope="col" class="p-4">
                    دسته بندی
                </th>
                <th scope="col" class="p-4 rounded-tl-lg">
                    اقدامات
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($letters as $letter)
                <tr class="table-tb-tr group">
                    <td class="table-tr-td border-t-0 border-l-0">
                        {{ $loop->index + 1 }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0">
                        {{ $letter->number }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0">
                        {{ jdate($letter->date)->format('%A, %d %B %Y') }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0">
                        {{ $letter->title }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0">
                        {{ $letter->method }}
                    </td>
                    @php
                        $registrarUser = \App\Models\User::find($letter->registrar);
                    @endphp
                    <td class="table-tr-td border-t-0 border-x-0">
                        {{ $registrarUser->name ?? '-' }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0">
                        {{ $letter->user->name ?? '-' }}
                    </td>
                    <td class="table-tr-td border-t-0 border-x-0">
                        {{ $letter->category }}
                    </td>
                    <td class="table-tr-td border-t-0 border-r-0">
                        <div class="flex items-center justify-center space-x-4 space-x-reverse relative mr-2" x-data="{open:false}">
                            <button @click="open = !open">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/>
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false" x-cloak
                                 class="table-dropdown -right-9 -top-4 whitespace-nowrap">
                                <a href="{{ route('letters.edit',$letter->id) }}"
                                   class="table-dropdown-edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                    </svg>
                                    ویرایش
                                </a>
                                <form action="{{ route('letters.destroy',$letter->id) }}" method="POST"
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
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>

    <div class="mt-4">
        {{ $letters->links() }}
    </div>
</x-layout>
