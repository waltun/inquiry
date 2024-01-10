<x-layout>
    <x-slot name="js">
        <script>
            function searchForm() {
                let form = document.getElementById('search-form');
                form.submit();
            }
        </script>
    </x-slot>

    <!-- Breadcrumb -->
    <div class="flex items-center space-x-2 space-x-reverse overflow-x-auto md:overflow-hidden">
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
            <svg xmlns="http://www.w3.org/2000/svg" class="breadcrumb-svg-active" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    مدیریت استعلام ها
                </p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="md:flex items-center justify-between mt-8 space-y-4 md:space-y-0">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 dark:text-white" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div class="mr-2 flex items-center">
                <p class="font-bold text-2xl text-black dark:text-white">
                    لیست استعلام ها
                </p>

                @if(request()->has('search') || request()->has('marketer'))
                    <a href="{{ route('inquiries.index') }}"
                       class="text-sm font-medium text-indigo-500 underline underline-offset-4 mr-4">
                        پاکسازی جستجو
                    </a>
                @endif
            </div>
        </div>
        <div class="flex items-center space-x-4 space-x-reverse">
            <a href="{{ route('inquiries.create') }}" class="page-success-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                <span class="mr-2">ایجاد استعلام جدید</span>
            </a>
        </div>
    </div>

    <!-- Search -->
    <div class="mt-4">
        <form method="GET" action="" class="mt-4 md:grid grid-cols-4 gap-4 space-y-4 md:space-y-0" id="search-form">
            <div class="mb-4">
                <input type="text" id="inputSearch" class="input-text" name="search"
                       placeholder="جستجو + اینتر" value="{{ request('search') }}">
            </div>
            <div class="mb-4">
                <select name="user_id" id="inputManager" class="input-text" onchange="searchForm()">
                    <option value="">انتخاب مسئول پروژه</option>
                    @foreach(\App\Models\User::all() as $user)
                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <select name="group_id" id="inputGroup" class="input-text" onchange="searchForm()">
                    <option value="">جستجو براساس دسته</option>
                    @foreach($groups as $group)
                        <option
                                value="{{ $group->id }}" {{ $group->id == request()->get('group_id') ? 'selected' : '' }}>
                            {{ $group->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <select name="model_id" id="inputModell" class="input-text" onchange="searchForm()">
                    <option value="">جستجو براساس مدل</option>
                    @foreach($modells as $modell)
                        <option
                                value="{{ $modell->id }}" {{ $modell->id == request()->get('model_id') ? 'selected' : '' }}>
                            {{ $modell->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        <!-- Content -->
        <div class="space-y-4">
            <div class="overflow-x-auto rounded-lg hidden md:block">
                <table class="md:w-full border-collapse">
                    <thead>
                    <tr class="table-th-tr">
                        <th scope="col" class="p-2 rounded-tr-lg">
                            شماره استعلام
                        </th>
                        <th scope="col" class="p-2">
                            نام پروژه
                        </th>
                        <th scope="col" class="p-2">
                            مسئول پروژه
                        </th>
                        <th scope="col" class="p-2">
                            بازاریاب
                        </th>
                        <th scope="col" class="p-2">
                            تاریخ
                        </th>
                        <th scope="col" class="p-2">
                            <span class="sr-only">محصولات</span>
                        </th>
                        <th scope="col" class="p-2">
                            <span class="sr-only">اقدامات</span>
                        </th>
                        <th scope="col" class="p-2">
                            <span class="sr-only">ثبت نهایی</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($inquiries as $inquiry)
                        @php
                            $color = '';
                            $twoDays = \Carbon\Carbon::now()->subDays(2);
                            $oneDay = \Carbon\Carbon::now()->subDay();
                            if ($inquiry->created_at < $twoDays) {
                                $color = 'text-red-500';
                            }
                            if ($inquiry->created_at > $twoDays && $inquiry->created_at < $oneDay) {
                                $color = 'text-yellow-500';
                            }
                        @endphp
                        <tr class="table-tb-tr group {{ $loop->even ? 'bg-sky-100' : '' }}">
                            <td class="table-tr-td border-t-0 border-l-0">
                                <p class="{{ $color ?? 'text-gray-500' }}">
                                    @if($inquiry->inquiry_number)
                                        {{ "INQ-" . $inquiry->inquiry_number }}
                                    @else
                                        استعلام موقت
                                    @endif
                                </p>
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                {{ $inquiry->name }}
                            </td>
                            @php
                                $user = \App\Models\User::find($inquiry->user_id);
                            @endphp
                            <td class="table-tr-td border-t-0 border-x-0">
                                {{ $user->name }}
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                {{ $inquiry->marketer }}
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                {{ jdate($inquiry->created_at)->format('%A, %d %B %Y') }}
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                <div class="flex justify-center items-center space-x-2 space-x-reverse">
                                    @if($inquiry->type == 'product' || $inquiry->type == 'both')
                                        @can('inquiry-products')
                                            <a href="{{ route('inquiries.product.index',$inquiry->id) }}"
                                               class="table-warning-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="w-4 h-4 ml-1" fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
                                                </svg>
                                                محصولات
                                            </a>
                                        @endcan
                                    @endif
                                    @if($inquiry->type == 'part' || $inquiry->type == 'both')
                                        @can('inquiry-parts')
                                            <a href="{{ route('inquiries.parts.index',$inquiry->id) }}"
                                               class="table-info-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="w-4 h-4 ml-1" fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>

                                                قطعات تکی
                                            </a>
                                        @endcan
                                    @endif
                                </div>
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0 whitespace-nowrap">
                                <div class="flex items-center justify-center space-x-4 space-x-reverse relative"
                                     x-data="{open:false}">
                                    <button @click="open = !open">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/>
                                        </svg>
                                    </button>
                                    <div x-show="open" @click.away="open = false" class="table-dropdown -top-16 left-8"
                                         x-cloak>
                                        @can('inquiry-datasheet')
                                            <a href="{{ route('inquiries.printDatasheet',$inquiry->id) }}"
                                               class="table-dropdown-edit" target="_blank">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"></path>
                                                </svg>
                                                دیتاشیت
                                            </a>
                                        @endcan
                                        @can('inquiry-description')
                                            <a href="{{ route('inquiries.description',$inquiry->id) }}"
                                               class="table-dropdown-description">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M3.75 6.75h16.5M3.75 12h16.5M12 17.25h8.25"/>
                                                </svg>
                                                شرایط استعلام
                                            </a>
                                        @endcan
                                        @can('copy-inquiry')
                                            <form action="{{ route('inquiries.copy',$inquiry->id) }}" method="POST"
                                                  class="table-dropdown-copy">
                                                @csrf
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5A3.375 3.375 0 006.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0015 2.25h-1.5a2.251 2.251 0 00-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 00-9-9z"/>
                                                </svg>
                                                <button onclick="return confirm('استعلام کپی شود ؟')">
                                                    کپی
                                                </button>
                                            </form>
                                        @endcan
                                        @can('referral-inquiry')
                                            <div x-data="{open:false}">
                                                <button class="table-dropdown-description" @click="open = !open">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3"/>
                                                    </svg>
                                                    ارجاع
                                                </button>
                                                <div class="relative z-10" x-show="open" x-cloak>
                                                    <div class="modal-backdrop"></div>
                                                    <div class="fixed z-10 inset-0 overflow-y-auto">
                                                        <div class="modal">
                                                            <div class="modal-body">
                                                                <form method="POST"
                                                                      class="bg-white dark:bg-slate-800 p-4"
                                                                      action="{{ route('inquiries.tmpReferral',$inquiry->id) }}">
                                                                    @csrf
                                                                    <div class="mb-4 flex justify-between items-center">
                                                                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                                            ارجاع استعلام به شخص دیگر
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
                                                                            <label for="inputUser" class="form-label">
                                                                                انتخاب کاربر
                                                                            </label>
                                                                            <select name="user_id" id="inputUser"
                                                                                    class="input-text">
                                                                                @foreach(\App\Models\User::all() as $user)
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
                                        @can('referral-inquiry')
                                            <div x-data="{open:false}">
                                                <button class="table-dropdown-copy" @click="open = !open">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/>
                                                    </svg>
                                                    تغییر مسئول پروژه
                                                </button>
                                                <div class="relative z-10" x-show="open" x-cloak>
                                                    <div class="modal-backdrop"></div>
                                                    <div class="fixed z-10 inset-0 overflow-y-auto">
                                                        <div class="modal">
                                                            <div class="modal-body">
                                                                <form method="POST"
                                                                      class="bg-white dark:bg-slate-800 p-4"
                                                                      action="{{ route('inquiries.tmpReferral',$inquiry->id) }}">
                                                                    @csrf
                                                                    <div class="mb-4 flex justify-between items-center">
                                                                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                                            تغییر مسئول پروژه و انتخاب فرد دیگر
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
                                                                            <label for="inputUser" class="form-label">
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
                                        @can('edit-inquiry')
                                            <a href="{{ route('inquiries.edit',$inquiry->id) }}"
                                               class="table-dropdown-edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                                </svg>
                                                ویرایش
                                            </a>
                                        @endcan
                                        @if($delete->inquiries)
                                            @can('delete-inquiry')
                                                <form action="{{ route('inquiries.destroy',$inquiry->id) }}"
                                                      method="POST"
                                                      class="table-dropdown-delete">
                                                    @csrf
                                                    @method('DELETE')
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                                    </svg>
                                                    <button onclick="return confirm('استعلام حذف شود ؟')">
                                                        حذف
                                                    </button>
                                                </form>
                                            @endcan
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="table-tr-td border-r-0 border-r-0">
                                <div class="space-y-2">
                                    @can('submit-inquiry')
                                        <form action="{{ route('inquiries.submit',$inquiry->id) }}" method="POST"
                                              class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button class="table-success-btn"
                                                    onclick="return confirm('استعلام ثبت نهایی شود ؟')">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M4.5 12.75l6 6 9-13.5"/>
                                                </svg>
                                                ثبت نهایی
                                            </button>
                                        </form>
                                    @endcan
                                    @if($inquiry->message)
                                        <div x-data="{open:false}">
                                            <button type="button" class="table-delete-btn"
                                                    @click="open=!open">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                                اصلاحیه
                                            </button>
                                            <div class="relative z-10" x-show="open" x-cloak>
                                                <div class="modal-backdrop"></div>
                                                <div class="fixed z-10 inset-0 overflow-y-auto">
                                                    <div class="modal">
                                                        <div class="modal-body">
                                                            <div class="bg-white dark:bg-slate-800 p-4">
                                                                <div class="mb-4 flex justify-between items-center">
                                                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                                        اصلاحیه برای استعلام
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
                                                                        <p class="form-label">
                                                                            متن اصلاحیه
                                                                        </p>
                                                                        <div
                                                                                class="mt-2 border border-gray-200 rounded-lg p-4 dark:border-black">
                                                                            <p class="text-sm font-medium">
                                                                                {{ $inquiry->message }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                            class="flex justify-end items-center space-x-4 space-x-reverse">
                                                                        <button type="button" class="form-cancel-btn"
                                                                                @click="open = false">
                                                                            انصراف!
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-8 block md:hidden space-y-4">
                @foreach($inquiries as $inquiry)
                    <div class="p-4 rounded-lg shadow-search bg-white border border-sky-100 space-y-4">
                        <div class="flex items-center justify-between">
                            <p class="text-xs font-medium text-black whitespace-nowrap">شماره استعلام :</p>
                            <span class="border w-full mx-4 {{ $loop->odd ? 'border-sky-200' : 'border-red-200' }}"></span>
                            <p class="text-xs font-medium text-black whitespace-nowrap">
                                @if(is_null($inquiry->inquiry_number))
                                    استعلام موقت
                                @else
                                    {{ $inquiry->inquiry_number }}
                                @endif
                            </p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="text-xs font-medium text-black whitespace-nowrap">نام پروژه :</p>
                            <span class="border {{ $loop->odd ? 'border-sky-200' : 'border-red-200' }} w-full mx-4"></span>
                            <p class="text-xs font-medium text-black whitespace-nowrap">
                                {{ $inquiry->name }}
                            </p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="text-xs font-medium text-black whitespace-nowrap">مسئول پروژه :</p>
                            <span class="border {{ $loop->odd ? 'border-sky-200' : 'border-red-200' }} w-full mx-4"></span>
                            @php
                                $user = \App\Models\User::find($inquiry->user_id);
                            @endphp
                            <p class="text-xs font-medium text-black whitespace-nowrap">
                                {{ $user->name }}
                            </p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="text-xs font-medium text-black whitespace-nowrap">بازاریاب :</p>
                            <span class="border {{ $loop->odd ? 'border-sky-200' : 'border-red-200' }} w-full mx-4"></span>
                            <p class="text-xs font-medium text-black whitespace-nowrap">
                                {{ $inquiry->marketer }}
                            </p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="text-xs font-medium text-black whitespace-nowrap">تاریخ :</p>
                            <span class="border {{ $loop->odd ? 'border-sky-200' : 'border-red-200' }} w-full mx-4"></span>
                            <p class="text-xs font-medium text-black whitespace-nowrap">
                                {{ jdate($inquiry->created_at)->format('%A, %d %B %Y') }}
                            </p>
                        </div>
                        <div class="flex items-center border-t border-gray-300 pt-4 space-x-2 space-x-reverse">
                            @if($inquiry->type == 'product' || $inquiry->type == 'both')
                                @can('inquiry-products')
                                    <a href="{{ route('inquiries.product.index',$inquiry->id) }}"
                                       class="mobile-warning-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-4 h-4 ml-1" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
                                        </svg>
                                        محصولات
                                    </a>
                                @endcan
                            @endif
                            @if($inquiry->type == 'part' || $inquiry->type == 'both')
                                @can('inquiry-parts')
                                    <a href="{{ route('inquiries.parts.index',$inquiry->id) }}"
                                       class="mobile-info-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-4 h-4 ml-1" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        قطعات تکی
                                    </a>
                                @endcan
                            @endif
                            @can('submit-inquiry')
                                <form action="{{ route('inquiries.submit',$inquiry->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="mobile-success-btn"
                                            onclick="return confirm('استعلام ثبت نهایی شود ؟')">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M4.5 12.75l6 6 9-13.5"/>
                                        </svg>
                                        ثبت نهایی
                                    </button>
                                </form>
                            @endcan
                            <div class="flex items-center justify-center space-x-4 space-x-reverse relative"
                                 x-data="{open:false}">
                                <button @click="open = !open">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/>
                                    </svg>
                                </button>
                                <div x-show="open" @click.away="open = false"
                                     class="table-dropdown top-0 right-2 whitespace-nowrap"
                                     x-cloak>
                                    @can('inquiry-description')
                                        <a href="{{ route('inquiries.description',$inquiry->id) }}"
                                           class="table-dropdown-description">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M3.75 6.75h16.5M3.75 12h16.5M12 17.25h8.25"/>
                                            </svg>
                                            شرایط استعلام
                                        </a>
                                    @endcan
                                    @can('referral-inquiry')
                                        <div x-data="{open:false}">
                                            <button class="table-dropdown-description" @click="open = !open">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3"/>
                                                </svg>
                                                ارجاع
                                            </button>
                                            <div class="relative z-10" x-show="open" x-cloak>
                                                <div class="modal-backdrop"></div>
                                                <div class="fixed z-10 inset-0 overflow-y-auto">
                                                    <div class="modal">
                                                        <div class="modal-body">
                                                            <form method="POST" class="bg-white dark:bg-slate-800 p-4"
                                                                  action="{{ route('inquiries.tmpReferral',$inquiry->id) }}">
                                                                @csrf
                                                                <div class="mb-4 flex justify-between items-center">
                                                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                                        ارجاع استعلام به شخص دیگر
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
                                                                        <label for="inputUser" class="form-label">
                                                                            انتخاب کاربر
                                                                        </label>
                                                                        <select name="user_id" id="inputUser"
                                                                                class="input-text">
                                                                            @foreach(\App\Models\User::all() as $user)
                                                                                <option
                                                                                        value="{{ $user->id }}">{{ $user->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div
                                                                            class="flex justify-end items-center space-x-4 space-x-reverse">
                                                                        <button type="submit" class="form-submit-btn">
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
                                    @can('edit-inquiry')
                                        <a href="{{ route('inquiries.edit',$inquiry->id) }}"
                                           class="table-dropdown-edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                            </svg>
                                            ویرایش
                                        </a>
                                    @endcan
                                    @if($delete->inquiries)
                                        @can('delete-inquiry')
                                            <form action="{{ route('inquiries.destroy',$inquiry->id) }}" method="POST"
                                                  class="table-dropdown-delete">
                                                @csrf
                                                @method('DELETE')
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                                </svg>
                                                <button onclick="return confirm('استعلام حذف شود ؟')">
                                                    حذف
                                                </button>
                                            </form>
                                        @endcan
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {!! $inquiries->links() !!}
            </div>
        </div>

        <!-- Submitted & Priced inquiries -->
        <div class="grid grid-cols-2 gap-4 sticky bottom-4 mt-6">
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
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-6 h-6 text-white group-hover:text-myBlue-100"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
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
