<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/date-picker/persianDatepicker.min.js') }}"></script>
        <script>
            function showBuildDate(id) {
                $("#inputBuildDate" + id).persianDatepicker({
                    formatDate: "YYYY-MM-DD",
                });
            }

            function showDeliveryDate(id) {
                $("#inputDeliveryDate" + id).persianDatepicker({
                    formatDate: "YYYY-MM-DD",
                });
            }

            function showContractDate(id) {
                $("#inputStartContractDate" + id).persianDatepicker({
                    formatDate: "YYYY-MM-DD",
                });
            }
        </script>
        <script>
            function searchForm() {
                let form = document.getElementById('search-form');
                form.submit();
            }
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
                    پیش فاکتورهای نهایی
                </p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="md:flex items-center justify-between mt-8 space-y-4 md:space-y-0">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-8 h-8 dark:text-white">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
            </svg>
            <div class="mr-2 flex items-center">
                <p class="font-bold text-2xl text-black dark:text-white">
                    لیست پیش فاکتور های نهایی
                </p>
                @if(request()->has('search') || request()->has('type'))
                    <a href="{{ route('invoices.final.index') }}"
                       class="text-sm font-medium text-indigo-500 underline underline-offset-4 mr-4">
                        پاکسازی جستجو
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Search -->
    <div class="mt-4">
        <form method="GET" action="" class="grid grid-cols-4 gap-4" id="search-form">
            <input type="text" id="inputSearch" class="input-text" name="search"
                   placeholder="جستجو نام و شماره و بازاریاب و... + اینتر" value="{{ request('search') }}">

            <select name="user_id" id="inputManager" class="input-text" onchange="searchForm()">
                <option value="">انتخاب مسئول پروژه</option>
                @foreach(\App\Models\User::all() as $user)
                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>

            <select name="contract" id="inputContract" class="input-text" onchange="searchForm()">
                <option value="">قرارداد صادر شده / نشده</option>
                <option value="1" {{ request('contract') == "1" ? 'selected' : '' }}>صادر شده</option>
                <option value="0" {{ request('contract') == "0" ? 'selected' : '' }}>صادر نشده</option>
            </select>
        </form>
    </div>

    <!-- Content -->
    <div class="mt-4 space-y-4">
        <div class="overflow-x-auto rounded-lg hidden md:block">
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
                    <th scope="col" class="p-4">
                        تاریخ مشاهده مشتری
                    </th>
                    <th scope="col" class="p-4">
                        قرارداد
                    </th>
                    <th scope="col" class="p-4 rounded-tl-lg">
                        <span class="sr-only">اقدامات</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($invoices as $invoice)
                    <tr class="table-tb-tr group hover:font-bold hover:text-red-600 {{ $loop->even ? 'bg-sky-100' : '' }}">
                        <td class="table-tr-td border-t-0 border-l-0">
                            <a href="{{ route('invoices.final.print',$invoice->id) }}">
                                INV-{{ $invoice->invoice_number ?: $invoice->inquiry->inquiry_number }}
                            </a>
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            <a href="{{ route('invoices.final.print',$invoice->id) }}">
                                {{ $invoice->inquiry->name }}
                            </a>
                        </td>
                        @php
                            $user = \App\Models\User::find($invoice->user_id);
                        @endphp
                        <td class="table-tr-td border-t-0 border-x-0">
                            <a href="{{ route('invoices.final.print',$invoice->id) }}">
                                {{ $user->name }}
                            </a>
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            <a href="{{ route('invoices.final.print',$invoice->id) }}">
                                {{ $invoice->inquiry->marketer }}
                            </a>
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            <a href="{{ route('invoices.final.print',$invoice->id) }}">
                                {{ jdate($invoice->created_at)->format('%A, %d %B %Y') }}
                            </a>
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            <a href="{{ route('invoices.final.print',$invoice->id) }}">
                                @if(!is_null($invoice->seen_at))
                                    {{ jdate($invoice->seen_at)->format('%A, %d %B %Y - H:i') }}
                                @else
                                    -
                                @endif
                            </a>
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            @if($invoice->contract)
                                <div class="flex items-center justify-center space-x-2 space-x-reverse">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-green-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                                    </svg>
                                </div>
                            @else
                                <div class="flex items-center justify-center space-x-2 space-x-reverse">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-red-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="table-tr-td border-t-0 border-r-0">
                            <div class="flex items-center justify-center">
                                <div class="flex items-center justify-center space-x-4 space-x-reverse relative mr-2"
                                     x-data="{open:false}">
                                    <button @click="open = !open">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/>
                                        </svg>
                                    </button>
                                    <div x-show="open" @click.away="open = false"
                                         class="table-dropdown -top-12 -right-36"
                                         x-cloak>
                                        <a href="{{ route('invoices.final.printDatasheet',$invoice->id) }}"
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
                                        @php
                                            $invoiceUser = $invoice->users()->latest()->first();
                                        @endphp
                                        @if($invoiceUser)
                                            <a href="{{ route('clients.dashboard', $invoiceUser) }}" target="_blank"
                                               class="table-dropdown-restore text-xs">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                                مشاهده پنل مشتری
                                            </a>
                                        @endif
                                        @if(auth()->user()->role == 'admin')
                                            @can('referral-inquiry')
                                                <div x-data="{open:false}">
                                                    <button class="table-dropdown-copy text-xs" @click="open = !open">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                             viewBox="0 0 24 24"
                                                             stroke-width="1.5" stroke="currentColor"
                                                             class="w-4 h-4 ml-1">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/>
                                                        </svg>
                                                        تغییر مسئول پیش فاکتور
                                                    </button>
                                                    <div class="relative z-10" x-show="open" x-cloak>
                                                        <div class="modal-backdrop"></div>
                                                        <div class="fixed z-10 inset-0 overflow-y-auto">
                                                            <div class="modal">
                                                                <div class="modal-body">
                                                                    <form method="POST"
                                                                          class="bg-white dark:bg-slate-800 p-4"
                                                                          action="{{ route('invoices.final.referral',$invoice->id) }}">
                                                                        @csrf
                                                                        <div
                                                                            class="mb-4 flex justify-between items-center">
                                                                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                                                تغییر مسئول پیش فاکتور و انتخاب فرد دیگر
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
                                                                                <label for="inputUser"
                                                                                       class="form-label">
                                                                                    انتخاب کاربر
                                                                                </label>
                                                                                <select name="user_id" id="inputUser"
                                                                                        class="input-text">
                                                                                    @foreach(\App\Models\User::where('role', 'staff')->orWhere('role', 'admin')->get() as $user)
                                                                                        <option
                                                                                            value="{{ $user->id }}">{{ $user->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div
                                                                                class="flex justify-end items-center space-x-4 space-x-reverse">
                                                                                <button type="submit"
                                                                                        class="form-submit-btn">
                                                                                    ثبت
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endcan
                                        @endif
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
