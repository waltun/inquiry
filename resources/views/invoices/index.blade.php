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
                      d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    پیش فاکتور ها
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
                    <a href="{{ route('invoices.index') }}" class="form-detail-btn">
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
                    لیست پیش فاکتور ها
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
                </tr>
                </thead>
                <tbody>
                @foreach($invoices as $invoice)
                    <tr class="table-tb-tr group">
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
                        <td class="table-tr-td border-t-0 border-r-0">
                            {{ jdate($invoice->created_at)->format('%A, %d %B %Y') }}
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
        @can('inquiries')
            <a href="{{ route('inquiries.index') }}" class="dashboard-cards group bg-sky-200">
                <div class="flex items-center">
                    <div class="dashboard-card-icon bg-yellow-600 dark:bg-slate-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white group-hover:text-myBlue-100"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="mr-4">
                        <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
                            لیست استعلام ها
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

        @can('submitted-inquiries')
            <a href="{{ route('inquiries.submitted') }}" class="dashboard-cards group bg-sky-200">
                <div class="flex items-center">
                    <div class="dashboard-card-icon bg-yellow-600 dark:bg-slate-800">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-6 h-6 text-white group-hover:text-myBlue-100"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="mr-4">
                        <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
                            استعلام های منتظر قیمت
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
    </div>
</x-layout>
