<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/date-picker/persianDatepicker.min.js') }}"></script>
        <script>
            $(".dates").persianDatepicker({
                formatDate: "YYYY/MM/DD",
            });
        </script>
    </x-slot>
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('plugins/date-picker/persianDatepicker-default.css') }}">
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
        <a href="{{ route('exits.index') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="breadcrumb-svg" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    مدیریت خروج موقت کالاها
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
                    اقلام خروجی خروج موقت سند {{ $exitt->number }}
                </p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="flex items-center justify-between mt-8">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-6 h-6 dark:text-white">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <div class="mr-2 flex items-center space-x-4 space-x-reverse">
                <p class="font-bold text-lg text-black dark:text-white">
                    لیست اهلام خروجی خروج موقت سند {{ $exitt->number }}
                </p>
            </div>
        </div>
        <div class="flex items-center space-x-4 space-x-reverse">
            <a href="{{ route('exit-coding.create', $exitt->id) }}" class="page-success-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-5 h-5 ml-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                افزودن اقلام خروجی جدید
            </a>
            <a href="{{ route('exits.index') }}" class="page-warning-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ml-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3"/>
                </svg>
                بازگشت
            </a>
        </div>
    </div>

    <div class="mt-4">
        <!-- Table -->
        <div class="overflow-x-auto rounded-lg">
            <table class="w-full border-collapse">
                <thead>
                <tr class="table-th-tr whitespace-normal">
                    <th scope="col" class="p-2">
                        #
                    </th>
                    <th scope="col" class="p-2">
                        نام اقلام خروجی
                    </th>
                    <th scope="col" class="p-2">
                        تعداد تحویل شده
                    </th>
                    <th scope="col" class="p-2">
                        واحد
                    </th>
                    <th scope="col" class="p-2">
                        ثبت عودت
                    </th>
                    <th scope="col" class="p-2">
                        تعداد عودت شده
                    </th>
                    <th scope="col" class="p-2">
                        تاریخ عودت
                    </th>
                    <th scope="col" class="p-2">
                        توضیحات
                    </th>
                    <th scope="col" class="p-2">
                    <span class="sr-only">
                        اقدامات
                    </span>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($codings as $myCoding)
                    @php
                        if (!is_null($myCoding->coding_id)) {
                            $coding = \App\Models\System\Coding::find($myCoding->coding_id);
                        }
                    @endphp
                    <tr class="table-tb-tr whitespace-normal group">
                        <td class="table-tr-td border-t-0">
                            {{ $loop->index + 1 }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ !is_null($myCoding->coding_id) ? $coding->name : $myCoding->name }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ $myCoding->quantity }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ !is_null($myCoding->coding_id) ? $coding->unit : $myCoding->unit }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            <div class="flex items-center justify-center" x-data="{open:false}">
                                <button type="button" class="table-success-btn" @click="open = !open">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15M9 12l3 3m0 0 3-3m-3 3V2.25"/>
                                    </svg>
                                    ثبت عودت
                                </button>

                                <!-- Return Modal -->
                                <div class="relative z-20" x-show="open" x-cloak>
                                    <div class="modal-backdrop"></div>
                                    <div class="fixed z-50 inset-0 overflow-y-auto">
                                        <div class="modal">
                                            <div class="modal-body">
                                                <div class="bg-white dark:bg-slate-800 p-4">
                                                    <div class="mb-4 flex justify-between items-center">
                                                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                            ثبت عودت
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
                                                    <form method="POST" action="{{ route('exit-coding.store-return', [$exitt->id, $myCoding->id]) }}" class="mt-6 space-y-4">
                                                        @csrf

                                                        <div class="mb-4">
                                                            <label for="inputQuantity" class="form-label">تعداد تحویل شده</label>
                                                            <input type="number" class="input-text bg-gray-100" disabled value="{{ $myCoding->quantity }}">
                                                        </div>
                                                        <div class="mb-4">
                                                            <label for="inputReturnQuantity{{ $myCoding->id }}" class="form-label">تعداد عودت شده</label>
                                                            <input type="number" class="input-text" value="{{ $myCoding->return_quantity ?? 0 }}" id="inputReturnQuantity{{ $myCoding->id }}"
                                                                   name="return_quantity">
                                                        </div>
                                                        @php
                                                            if (!is_null($myCoding->return_date)) {
                                                                $year = jdate($myCoding->return_date)->getYear();
                                                                $month = jdate($myCoding->return_date)->getMonth();
                                                                $day = jdate($myCoding->return_date)->getDay();
                                                                $date = $year . '/' . $month . '/' . $day;
                                                            } else {
                                                                $date = '';
                                                            }
                                                        @endphp
                                                        <div class="mb-4">
                                                            <label for="inputReturnDate{{ $myCoding->id }}" class="form-label">تاریخ عودت</label>
                                                            <input type="text" class="input-text dates" value="{{ $date }}" id="inputReturnDate{{ $myCoding->id }}" name="return_date">
                                                        </div>
                                                        <div class="mb-4">
                                                            <label for="inputDescription{{ $myCoding->id }}" class="form-label">توضیحات</label>
                                                            <input type="text" class="input-text" value="{{ $myCoding->description }}" id="inputDescription{{ $myCoding->id }}"
                                                                   name="description">
                                                        </div>
                                                        <div class="flex justify-end">
                                                            <button class="form-submit-btn">
                                                                ثبت عودت
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ $myCoding->return_quantity ?? 'منتظر عودت' }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            @if(!is_null($myCoding->return_date))
                                {{ jdate($myCoding->return_date)->format('Y/m/d') }}
                            @else
                                منتظر عودت
                            @endif
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ $myCoding->description ?? '-' }}
                        </td>
                        <td class="table-tr-td border-t-0 border-r-0">
                            <div class="flex items-center justify-center space-x-2 space-x-reverse">
                                @can('edit-exit-coding')
                                    <a href="{{ route('exit-coding.edit', [$exitt->id, $myCoding->id]) }}" class="table-dropdown-edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                        </svg>
                                    </a>
                                @endcan
                                @can('delete-exit-coding')
                                    <form action="{{ route('exit-coding.destroy', [$exitt->id, $myCoding->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button class="table-dropdown-delete" type="submit" onclick="return confirm('محصول از لیست حذف شود ؟')">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                            </svg>
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
