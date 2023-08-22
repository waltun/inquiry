<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/date-picker/persianDatepicker.min.js') }}"></script>
        <script>
            $("#inputBuildDate").persianDatepicker({
                formatDate: "YYYY-MM-DD",
            });
            $("#inputDeliveryDate").persianDatepicker({
                formatDate: "YYYY-MM-DD",
            });
            $("#inputStartContractDate").persianDatepicker({
                formatDate: "YYYY-MM-DD",
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
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg-active">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    پیش فاکتور های نهایی
                </p>
            </div>
        </div>
    </div>

    <!-- Search -->
    <div class="card-search" {{ request()->query() ? 'x-data={open:true}' : 'x-data={open:false}' }}>
        <div class="card-header-search" @click="open=!open">
            <p class="card-title">
                جستجو در پیش فاکتور ها
            </p>
            <div class="card-title-search">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-6 h-6 transition" :class="{'rotate-180' : open}">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                </svg>
            </div>
        </div>
        <form method="GET" action="" class="mt-4 md:grid grid-cols-4 gap-4 space-y-4 md:space-y-0" x-show="open"
              x-cloak>
            <div class="mb-4">
                <label for="inputInquiryNumber" class="form-label">شماره پیش فاکتور</label>
                <input type="text" id="inputInquiryNumber" class="input-text" name="inquiry_number"
                       placeholder="جستجو براساس شماره استعلام (بدون INQ)" value="{{ request('inquiry_number') }}">
            </div>
            <div class="mb-4">
                <label for="inputName" class="form-label">نام پروژه</label>
                <input type="text" id="inputName" class="input-text" name="name"
                       placeholder="جستجو براساس نام پروژه" value="{{ request('name') }}">
            </div>
            <div class="mb-4">
                <label for="inputManager" class="form-label">مسئول پروژه</label>
                <select name="user_id" id="inputManager" class="input-text">
                    <option value="">انتخاب کنید</option>
                    @foreach(\App\Models\User::all() as $user)
                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="inputMarketer" class="form-label">بازاریاب</label>
                <input type="text" id="inputMarketer" class="input-text" name="marketer"
                       placeholder="جستجو براساس بازاریاب" value="{{ request('marketer') }}">
            </div>
            <div class="col-span-4 flex justify-end space-x-2 space-x-reverse pb-4">
                <button class="form-submit-btn" type="submit">
                    جستجو
                </button>
                @if(request()->query())
                    <a href="{{ route('invoices.final.index') }}" class="form-detail-btn">
                        پاکسازی
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Navigation -->
    <div class="md:flex items-center justify-between mt-8 space-y-4 md:space-y-0">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-8 h-8 dark:text-white">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
            </svg>
            <div class="mr-2">
                <p class="font-bold text-2xl text-black dark:text-white">
                    لیست پیش فاکتور های نهایی
                </p>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="mt-4 space-y-4">
        <div class="mt-8 overflow-x-auto rounded-lg hidden md:block">
            <table class="w-full border-collapse">
                <thead>
                <tr class="table-th-tr">
                    <th scope="col" class="p-4 rounded-tr-lg">
                        شماره پیش فاکتور
                    </th>
                    <th scope="col" class="p-4">
                        نام پروژه
                    </th>
                    <th scope="col" class="p-4">
                        مسئول پروژه
                    </th>
                    <th scope="col" class="p-4">
                        بازاریاب
                    </th>
                    <th scope="col" class="p-4">
                        تاریخ
                    </th>
                    <th scope="col" class="p-4 rounded-tl-lg">
                        <span class="sr-only">اقدامات</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($invoices as $invoice)
                    <tr class="table-tb-tr group {{ $loop->even ? 'bg-sky-100' : '' }}">
                        <td class="table-tr-td border-t-0 border-l-0">
                            {{ "INV-" . $invoice->inquiry->inquiry_number }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ $invoice->inquiry->name }}
                        </td>
                        @php
                            $user = \App\Models\User::find($invoice->user_id);
                        @endphp
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ $user->name }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ $invoice->inquiry->marketer }}
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ jdate($invoice->created_at)->format('%A, %d %B %Y') }}
                        </td>
                        <td class="table-tr-td border-t-0 border-r-0">
                            <div class="flex items-center justify-center space-x-4 space-x-reverse relative"
                                 x-data="{open:false}">
                                <button @click="open = !open">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/>
                                    </svg>
                                </button>
                                <div x-show="open" @click.away="open = false" class="table-dropdown -top-12 right-12"
                                     x-cloak>
                                    <a href="{{ route('invoices.final.print',$invoice->id) }}"
                                       class="table-success-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z"/>
                                        </svg>
                                        پرینت
                                    </a>
                                    <a href="{{ route('invoices.final.datasheet',$invoice->id) }}"
                                       class="table-dropdown-copy text-xs">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                        </svg>
                                        دیتاشیت
                                    </a>
                                    <form method="POST" action="{{ route('invoices.final.restore',$invoice->id) }}">
                                        @csrf
                                        @method('PATCH')

                                        <button type="submit" class="table-info-btn"
                                                onclick="return confirm('پیش فاکتور بازگردانی شود ؟')">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 00-3.7-3.7 48.678 48.678 0 00-7.324 0 4.006 4.006 0 00-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3l-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 003.7 3.7 48.656 48.656 0 007.324 0 4.006 4.006 0 003.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3l-3 3"/>
                                            </svg>
                                            بازگردانی
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('invoices.destroy',$invoice->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="table-delete-btn"
                                                onclick="return confirm('پیش فاکتور حذف شود ؟')">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                            </svg>
                                            حذف
                                        </button>
                                    </form>
                                </div>
                                <div x-data="{open:false}">
                                    <button class="table-success-btn" type="button" @click="open = !open">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/>
                                        </svg>
                                        تبدیل به قرارداد
                                    </button>
                                    <div class="relative z-10" x-show="open" x-cloak>
                                        <div class="modal-backdrop"></div>
                                        <div class="fixed z-10 inset-0 overflow-y-auto">
                                            <div class="modal">
                                                <div class="modal-body">
                                                    <form method="POST"
                                                          class="bg-white dark:bg-slate-800 p-4"
                                                          action="{{ route('invoices.final.addToContract',$invoice->id) }}">
                                                        @csrf
                                                        <div class="mb-4 flex justify-between items-center">
                                                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                                تبدیل پیش فاکتور به قرارداد
                                                            </h3>
                                                            <button type="button" @click="open = false">
                                                                <span class="modal-close">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                         fill="none"
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
                                                        <div class="mt-6">
                                                            <div class="mb-4">
                                                                <label for="inputPeriod" class="form-label">
                                                                    مدت قرارداد
                                                                </label>
                                                                <input type="text" id="inputPeriod" name="period"
                                                                       class="input-text">
                                                            </div>
                                                            <div class="mb-4">
                                                                <label for="inputBuildDate" class="form-label">
                                                                    تاریخ شروع به ساخت
                                                                </label>
                                                                <input type="text" id="inputBuildDate" name="build_date"
                                                                       class="input-text">
                                                            </div>
                                                            <div class="mb-4">
                                                                <label for="inputDeliveryDate" class="form-label">
                                                                    تاریخ تحویل
                                                                </label>
                                                                <input type="text" id="inputDeliveryDate"
                                                                       name="delivery_date"
                                                                       class="input-text">
                                                            </div>
                                                            <div class="mb-4">
                                                                <label for="inputStartContractDate" class="form-label">
                                                                    تاریخ شروع قرارداد
                                                                </label>
                                                                <input type="text" id="inputStartContractDate"
                                                                       name="start_contract_date"
                                                                       class="input-text">
                                                            </div>
                                                            <div
                                                                class="flex justify-end items-center space-x-4 space-x-reverse">
                                                                <button type="submit"
                                                                        class="form-submit-btn">
                                                                    ثبت
                                                                </button>
                                                                <button type="button"
                                                                        class="form-cancel-btn"
                                                                        @click="open = false">
                                                                    انصراف!
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
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

        <div class="mt-4">
            {{ $invoices->links() }}
        </div>
    </div>

    <!-- Submitted & List inquiries -->
    <div class="mt-6 md:grid grid-cols-3 gap-4 space-y-4 md:space-y-0">
        @can('priced-inquiries')
            <a href="{{ route('inquiries.priced') }}" class="dashboard-cards group bg-sky-200">
                <div class="flex items-center">
                    <div class="dashboard-card-icon bg-yellow-600 dark:bg-slate-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                             stroke="currentColor" class="w-6 h-6 text-white group-hover:text-myBlue-100">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="mr-4">
                        <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
                            استعلام های قیمت گذاری شده
                        </p>
                    </div>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                         class="w-5 h-5 text-gray-600 group-hover:text-gray-200 dark:text-white">
                        <path fill-rule="evenodd"
                              d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                              clip-rule="evenodd"/>
                    </svg>
                </div>
            </a>
        @endcan

        <a href="{{ route('invoices.index') }}" class="dashboard-cards group bg-sky-200">
            <div class="flex items-center">
                <div class="dashboard-card-icon bg-yellow-600 dark:bg-slate-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6 text-white group-hover:text-myBlue-100">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                    </svg>
                </div>
                <div class="mr-4">
                    <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
                        پیش فاکتور های درحال انجام
                    </p>
                </div>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                     class="w-5 h-5 text-gray-600 group-hover:text-gray-200 dark:text-white">
                    <path fill-rule="evenodd"
                          d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                          clip-rule="evenodd"/>
                </svg>
            </div>
        </a>

        <a href="{{ route('invoices.final.index') }}" class="dashboard-cards group bg-sky-200">
            <div class="flex items-center">
                <div class="dashboard-card-icon bg-yellow-600 dark:bg-slate-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6 text-white group-hover:text-myBlue-100">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                    </svg>
                </div>
                <div class="mr-4">
                    <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
                        پیش فاکتور های نهایی
                    </p>
                </div>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                     class="w-5 h-5 text-gray-600 group-hover:text-gray-200 dark:text-white">
                    <path fill-rule="evenodd"
                          d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                          clip-rule="evenodd"/>
                </svg>
            </div>
        </a>
    </div>
</x-layout>
