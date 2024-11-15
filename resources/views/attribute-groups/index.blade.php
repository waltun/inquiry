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
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg-active">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    مدیریت دسته بندی های مشخصات فنی
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
                      d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
            </svg>
            <div class="mr-2">
                <p class="font-bold text-2xl text-black dark:text-white">
                    لیست دسته بندی های مشخصه فنی
                </p>
            </div>
        </div>
        <div class="flex items-center space-x-4 space-x-reverse" x-data="{open : false}">
            <button type="button" class="page-success-btn" @click="open = !open">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                <span class="mr-2">ایجاد دسته بندی جدید</span>
            </button>

            <div class="relative z-10" x-show="open" x-cloak>
                <div class="modal-backdrop"></div>
                <div class="fixed z-10 inset-0 overflow-y-auto">
                    <div class="modal">
                        <div class="modal-body">
                            <div class="bg-white dark:bg-slate-800 p-4">
                                <div class="mb-4 flex justify-between items-center">
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                        ایجاد دسته بندی جدید برای مشخصات فنی
                                    </h3>
                                    <button type="button" @click="open = false">
                                        <span class="modal-close">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 fill="none"
                                                 viewBox="0 0 24 24"
                                                 stroke-width="1.5"
                                                 stroke="currentColor"
                                                 class="w-5 h-5 dark:text-white">
                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                                <form class="mt-6" method="POST"
                                      action="{{ route('attribute-groups.store') }}">
                                    @csrf
                                    <div class="mb-4">
                                        <label class="form-label" for="inputName">
                                            نام دسته بندی
                                        </label>
                                        <input type="text" name="name" id="inputName" class="input-text py-2"
                                               value="{{ old('name') }}"
                                               placeholder="نام نمایشی دسته بندی را وارد کنید">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="inputSort">
                                            Sort
                                        </label>
                                        <input type="text" name="sort" id="inputSort" class="input-text py-2"
                                               value="{{ old('sort') }}"
                                               placeholder="اولویت نمایش">
                                    </div>
                                    <div class="flex justify-end items-center space-x-4 space-x-reverse">
                                        <button type="submit" class="form-submit-btn">
                                            ثبت
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <!-- Content -->
    <div class="mt-4 space-y-4">
        <div class="mt-8 overflow-x-auto rounded-lg">
            <table class="w-full border-collapse">
                <thead>
                <tr class="table-th-tr">
                    <th scope="col" class="p-2 rounded-tr-lg">
                        Sort
                    </th>
                    <th scope="col" class="p-2">
                        نام
                    </th>
                    <th scope="col" class="p-2 rounded-tl-lg">
                        <span class="sr-only">اقدامات</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($groups as $group)
                    <tr class="table-tb-tr group {{ $loop->even ? 'bg-sky-100' : '' }}">
                        <td class="table-tr-td border-t-0 border-l-0">
                            {{ $group->sort }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ $group->name }}
                        </td>
                        <td class="table-tr-td border-t-0 border-r-0">
                            <div class="flex items-center space-x-4 space-x-reverse">
                                <form action="{{ route('attribute-groups.destroy',$group->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="table-dropdown-delete"
                                            onclick="return confirm('نقش حذف شود ؟')">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                        </svg>
                                        حذف
                                    </button>
                                </form>
                                <div x-data="{open : false}">
                                    <button type="button" class="table-dropdown-edit" @click="open = !open">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                        </svg>
                                        ویرایش
                                    </button>
                                    <div class="relative z-10" x-show="open" x-cloak>
                                        <div class="modal-backdrop"></div>
                                        <div class="fixed z-10 inset-0 overflow-y-auto">
                                            <div class="modal">
                                                <div class="modal-body">
                                                    <div class="bg-white dark:bg-slate-800 p-4">
                                                        <div class="mb-4 flex justify-between items-center">
                                                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                                ویرایش دسته بندی {{ $group->name }}
                                                            </h3>
                                                            <button type="button" @click="open = false">
                                                                <span class="modal-close">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                         fill="none"
                                                                         viewBox="0 0 24 24"
                                                                         stroke-width="1.5"
                                                                         stroke="currentColor"
                                                                         class="w-5 h-5 dark:text-white">
                                                                        <path stroke-linecap="round"
                                                                              stroke-linejoin="round"
                                                                              d="M6 18L18 6M6 6l12 12"/>
                                                                    </svg>
                                                                </span>
                                                            </button>
                                                        </div>
                                                        <form class="mt-6" method="POST"
                                                              action="{{ route('attribute-groups.update',$group->id) }}">
                                                            @csrf
                                                            @method('PATCH')

                                                            <div class="mb-4">
                                                                <label class="form-label" for="inputName">
                                                                    نام دسته بندی
                                                                </label>
                                                                <input type="text" name="name" id="inputName{{ $group->id }}"
                                                                       class="input-text py-2"
                                                                       value="{{ old('name') ?? $group->name }}"
                                                                       placeholder="نام نمایشی دسته بندی را وارد کنید">
                                                            </div>
                                                            <div class="mb-4">
                                                                <label class="form-label" for="inputName">
                                                                    Sort
                                                                </label>
                                                                <input type="text" name="sort" id="inputSort{{ $group->id }}"
                                                                       class="input-text py-2"
                                                                       value="{{ old('sort') ?? $group->sort }}"
                                                                       placeholder="اولویت نمایش">
                                                            </div>
                                                            <div
                                                                class="flex justify-end items-center space-x-4 space-x-reverse">
                                                                <button type="submit" class="form-edit-btn">
                                                                    بروزرسانی
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="my-4 md:block hidden">
            {{ $groups->links() }}
        </div>
    </div>
</x-layout>
