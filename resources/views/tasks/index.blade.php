<x-layout>
    <x-slot name="js">
        <script>
            function filterTask() {
                let form = document.getElementById('taskForm');
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
                    مدیریت وظیفه ها
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
                    لیست وظیفه ها
                </p>
            </div>
        </div>
        <div class="flex items-center space-x-4 space-x-reverse">
            <a href="{{ route('tasks.create') }}" class="page-success-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                <span class="mr-2">ایجاد وظیفه جدید</span>
            </a>
        </div>
    </div>

    <!-- Desktop -->
    <div class="mt-4 hidden md:block">
        <div x-data="{tab : 'sent-tasks'}" class="mb-8">
            <div class="border-b border-indigo-400 dark:border-black">
                <ul class="flex md:flex-wrap -mb-px text-sm font-medium text-center text-gray-600 whitespace-nowrap overflow-x-auto">
                    <li class="ml-2">
                        <button x-on:click="tab = 'sent-tasks'" type="button"
                                class="inline-flex p-4 text-myBlue-100 group rounded-t-lg dark:text-white"
                                :class="{ 'text-myBlue-100 border border-indigo-400 bg-gray-100 dark:bg-slate-900': tab === 'sent-tasks' }"
                                aria-current="page">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-5 h-5 ml-2 text-blue-600"
                                 :class="{ 'text-blue-700': tab === 'sent-tasks' }">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"/>
                            </svg>

                            وظیفه هایی که شما برای بقیه ارسال کردید
                        </button>
                    </li>
                    <li class="ml-2">
                        <button x-on:click="tab = 'received-tasks'" type="button"
                                class="inline-flex p-4 text-myBlue-100 group rounded-t-lg dark:text-white"
                                :class="{ 'text-myBlue-100 border border-indigo-400 bg-gray-100 dark:bg-slate-900': tab === 'received-tasks' }"
                                aria-current="page">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-5 h-5 ml-2 text-blue-600"
                                 :class="{ 'text-blue-700': tab === 'received-tasks' }">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                            </svg>

                            وظیفه های ارسال شده برای شما
                        </button>
                    </li>
                </ul>
            </div>

            <div x-show="tab === 'sent-tasks'"
                 class="rounded-b-lg px-4 py-6" x-cloak>
                <form method="get" action="" class="flex justify-end mb-4" id="taskForm">
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <select name="receiver_id" id="inputReciever" class="input-text" onchange="filterTask()">
                                <option value="">انتخاب کاربر</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ request('receiver_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <select name="level" id="inputLevel" class="input-text" onchange="filterTask()">
                                <option value="">انتخاب سطح اهمیت</option>
                                <option value="high" {{ request('level') == 'high' ? 'selected' : '' }}>
                                    اهمیت بالا
                                </option>
                                <option value="medium" {{ request('level') == 'medium' ? 'selected' : '' }}>
                                    اهمیت متوسط
                                </option>
                                <option value="low" {{ request('level') == 'low' ? 'selected' : '' }}>
                                    اهمیت کم
                                </option>
                            </select>
                        </div>
                        @if(request()->has('receiver_id') || request()->has('level'))
                            <div>
                                <a href="{{ route('tasks.index') }}" class="text-indigo-500 underline underline-offset-4 text-xs">
                                    پاکسازی فیلتر
                                </a>
                            </div>
                        @endif
                    </div>
                </form>
                <div class="overflow-x-auto rounded-lg">
                    @if(!$sentTasks->isEmpty())
                        <table class="md:w-full border-collapse">
                            <thead>
                            <tr class="table-th-tr">
                                <th scope="col" class="p-2">
                                    تاریخ
                                </th>
                                <th scope="col" class="p-2">
                                    عنوان
                                </th>
                                <th scope="col" class="p-2">
                                    ارسال شده برای
                                </th>
                                <th scope="col" class="p-2">
                                    سطح اهمیت
                                </th>
                                <th scope="col" class="p-2">
                                    توضیحات
                                </th>
                                <th scope="col" class="p-2">
                                    فایل
                                </th>
                                <th scope="col" class="p-2">
                                    تاریخ انجام شده
                                </th>
                                <th scope="col" class="p-2">
                                    <span class="sr-only">اقدامات</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sentTasks as $sentTask)
                                <tr class="table-tb-tr group hover:font-bold hover:text-red-600 {{ $loop->even ? 'bg-sky-100' : '' }} whitespace-normal">
                                    <td class="table-tr-td border-t-0 border-l-0">
                                        {{ jdate($sentTask->date)->format('Y/m/d') }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0 {{ $sentTask->done ? 'line-through opacity-50' : '' }}">
                                        {{ $sentTask->title }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0 {{ $sentTask->done ? 'line-through opacity-50' : '' }}">
                                        {{ $sentTask->receiver->name }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0 {{ $sentTask->done ? 'line-through opacity-50' : '' }}">
                                        @switch($sentTask->level)
                                            @case('high')
                                                <div class="bg-red-500 text-white px-2 inline rounded-md shadow">
                                                    بالا
                                                </div>
                                                @break
                                            @case('medium')
                                                <div class="bg-yellow-500 text-white px-2 inline rounded-md shadow">
                                                    متوسط
                                                </div>
                                                @break
                                            @case('low')
                                                <div class="bg-gray-500 text-white px-2 inline rounded-md shadow">
                                                    پایین
                                                </div>
                                                @break
                                        @endswitch
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0 {{ $sentTask->done ? 'line-through opacity-50' : '' }}">
                                        {{ $sentTask->description ?? '-' }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        @php
                                            $extension = explode('.',$sentTask->file);
                                        @endphp
                                        @if(!is_null($sentTask->file))
                                            @if($extension[1] == 'pdf' || $extension[1] == 'docx' || $extension[1] == 'doc')
                                                <div class="flex justify-center items-center">
                                                    <a href="{{ $sentTask->file }}" class="table-dropdown-copy" download>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                                                        </svg>
                                                        دانلود فایل
                                                    </a>
                                                </div>
                                            @elseif($extension[1] == 'jpg' || $extension[1] == 'png' || $extension[1] == 'jpeg')
                                                <img src="{{ $sentTask->file }}" alt="" class="w-10 h-10 rounded-md mx-auto border border-gray-200 cursor-pointer"
                                                     onclick="this.requestFullscreen()">
                                            @else
                                                <div class="flex justify-center items-center">
                                                    <a href="{{ $sentTask->file }}" class="table-dropdown-copy" download>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                                                        </svg>
                                                        دانلود فایل
                                                    </a>
                                                </div>
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0 {{ $sentTask->done ? 'opacity-50' : '' }}">
                                        @if($sentTask->done_at)
                                            {{ jdate($sentTask->done_at)->format('Y/m/d H:i') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="table-tr-td border-t-0 border-r-0 whitespace-nowrap">
                                        <div class="flex items-center space-x-4 space-x-reverse justify-center">
                                            @if($sentTask->reply)
                                                <div x-data="{open: false}">
                                                    <button type="button" @click="open = !open"
                                                            class="table-info-btn">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                                        </svg>
                                                        مشاهده پاسخ
                                                    </button>

                                                    <!-- Reply Modal -->
                                                    <div class="relative z-10" x-show="open" x-cloak>
                                                        <div class="modal-backdrop"></div>
                                                        <div class="fixed z-10 inset-0 overflow-y-auto">
                                                            <div class="modal">
                                                                <div class="modal-body">
                                                                    <div class="bg-white dark:bg-slate-800 p-4">
                                                                        <div class="mb-4 flex justify-between items-center">
                                                                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                                                مشاهده پاسخ وظیفه
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
                                                                        <div class="mt-6 whitespace-normal">
                                                                            <div class="mt-4 p-4 border border-gray-200 rounded-lg">
                                                                                <p class="text-sm font-medium text-black leading-6">
                                                                                    {{ $sentTask->reply }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($sentTask->done)
                                                <span class="bg-green-500 px-2 rounded-md text-white">
                                                    انجام شده
                                                </span>
                                            @endif
                                            <div
                                                class="flex items-center justify-center space-x-4 space-x-reverse relative"
                                                x-data="{open:false}">
                                                <button @click="open = !open">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/>
                                                    </svg>
                                                </button>
                                                <div x-show="open" @click.away="open = false"
                                                     class="table-dropdown -top-4 -right-9"
                                                     x-cloak>
                                                    @can('edit-task')
                                                        <a href="{{ route('tasks.edit',$sentTask->id) }}"
                                                           class="table-dropdown-edit">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                 viewBox="0 0 24 24"
                                                                 stroke-width="1.5" stroke="currentColor"
                                                                 class="w-4 h-4 ml-1">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                                            </svg>
                                                            ویرایش
                                                        </a>
                                                    @endcan
                                                    @can('delete-task')
                                                        <form action="{{ route('tasks.destroy',$sentTask->id) }}"
                                                              method="POST"
                                                              class="table-dropdown-delete">
                                                            @csrf
                                                            @method('DELETE')
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                 viewBox="0 0 24 24"
                                                                 stroke-width="1.5" stroke="currentColor"
                                                                 class="w-4 h-4 ml-1">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                                            </svg>
                                                            <button onclick="return confirm('وظیفه حذف شود ؟')">
                                                                حذف
                                                            </button>
                                                        </form>
                                                    @endcan
                                                    <form action="{{ route('tasks.review',$sentTask->id) }}"
                                                          method="POST"
                                                          class="table-dropdown-restore">
                                                        @csrf
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                             viewBox="0 0 24 24" stroke-width="1.5"
                                                             stroke="currentColor" class="w-4 h-4 ml-1">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/>
                                                        </svg>
                                                        <button onclick="return confirm('وظیفه بازنگری شود ؟')">
                                                            بازنگری
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="bg-yellow-500 py-2 rounded-md shadow">
                            <p class="text-center text-black text-xs font-medium">
                                شما وظیفه جدیدی برای کسی ایجاد نکردید
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <div x-show="tab === 'received-tasks'"
                 class="rounded-b-lg px-4 py-6" x-cloak>
                <div class="overflow-x-auto rounded-lg hidden md:block">
                    @if(!$receivedTasks->isEmpty())
                        <table class="md:w-full border-collapse">
                            <thead>
                            <tr class="table-th-tr">
                                <th scope="col" class="p-2">
                                    تاریخ
                                </th>
                                <th scope="col" class="p-2">
                                    عنوان
                                </th>
                                <th scope="col" class="p-2">
                                    از طرف
                                </th>
                                <th scope="col" class="p-2">
                                    سطح اهمیت
                                </th>
                                <th scope="col" class="p-2">
                                    توضیحات
                                </th>
                                <th scope="col" class="p-2">
                                    فایل
                                </th>
                                <th scope="col" class="p-2">
                                    تاریخ انجام شده
                                </th>
                                <th scope="col" class="p-2">
                                    <span class="sr-only">اقدامات</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($receivedTasks as $receivedTask)
                                <tr class="table-tb-tr group hover:font-bold hover:text-red-600 {{ $loop->even ? 'bg-sky-100' : '' }} whitespace-normal">
                                    <td class="table-tr-td border-t-0 border-l-0">
                                        {{ jdate($receivedTask->date)->format('Y/m/d') }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0 {{ $receivedTask->done ? 'line-through opacity-50' : '' }}">
                                        {{ $receivedTask->title }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0 {{ $receivedTask->done ? 'line-through opacity-50' : '' }}">
                                        {{ $receivedTask->user->name }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0 {{ $receivedTask->done ? 'line-through opacity-50' : '' }}">
                                        @switch($receivedTask->level)
                                            @case('high')
                                                <div class="bg-red-500 text-white px-2 inline rounded-md shadow">
                                                    بالا
                                                </div>
                                                @break
                                            @case('medium')
                                                <div class="bg-yellow-500 text-white px-2 inline rounded-md shadow">
                                                    متوسط
                                                </div>
                                                @break
                                            @case('low')
                                                <div class="bg-gray-500 text-white px-2 inline rounded-md shadow">
                                                    پایین
                                                </div>
                                                @break
                                        @endswitch
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0 {{ $receivedTask->done ? 'line-through opacity-50' : '' }}">
                                        {{ $receivedTask->description ?? '-' }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0">
                                        @php
                                            $extension = explode('.',$receivedTask->file);
                                        @endphp
                                        @if(!is_null($receivedTask->file))
                                            @if($extension[1] == 'pdf' || $extension[1] == 'docx' || $extension[1] == 'doc')
                                                <div class="flex justify-center items-center">
                                                    <a href="{{ $receivedTask->file }}" class="table-dropdown-copy" download>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                                                        </svg>
                                                        دانلود فایل
                                                    </a>
                                                </div>
                                            @elseif($extension[1] == 'jpg' || $extension[1] == 'png' || $extension[1] == 'jpeg')
                                                <img src="{{ $receivedTask->file }}" alt="" class="w-10 h-10 rounded-md mx-auto border border-gray-200 cursor-pointer"
                                                     onclick="this.requestFullscreen()">
                                            @else
                                                <div class="flex justify-center items-center">
                                                    <a href="{{ $receivedTask->file }}" class="table-dropdown-copy" download>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                                                        </svg>
                                                        دانلود فایل
                                                    </a>
                                                </div>
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0 {{ $receivedTask->done ? 'opacity-50' : '' }}">
                                        @if($receivedTask->done_at)
                                            {{ jdate($receivedTask->done_at)->format('Y/m/d H:i') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="table-tr-td border-t-0 border-r-0 whitespace-nowrap">
                                        <div class="flex items-center space-x-4 space-x-reverse justify-center">
                                            @if(!$receivedTask->done)
                                                <a href="{{ route('tasks.reply', $receivedTask->id) }}" class="table-dropdown-restore text-xs">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/>
                                                    </svg>
                                                    پاسخ
                                                </a>

                                                <form action="{{ route('tasks.mark-as-done', $receivedTask->id) }}"
                                                      method="POST"
                                                      class="table-success-btn">
                                                    @csrf
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="m4.5 12.75 6 6 9-13.5"/>
                                                    </svg>
                                                    <button onclick="return confirm('وظیفه تمام شود ؟')">
                                                        اتمام کار
                                                    </button>
                                                </form>
                                            @else
                                                <span class="bg-green-500 px-2 rounded-md text-white">
                                                    انجام شده
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="bg-yellow-500 py-2 rounded-md shadow">
                            <p class="text-center text-black text-xs font-medium">
                                شما وظیفه جدیدی ندارید
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile -->
    <div class="mt-4 space-y-4 block md:hidden">
        @foreach($receivedTasks as $receivedTask)
            <div class="bg-white rounded-md shadow border border-indigo-500 relative">
                <div class="absolute w-7 h-7 rounded-full bg-sky-200 top-2 right-2 grid place-content-center">
                    <p class="text-sm font-medium">
                        {{ $loop->index + 1 }}
                    </p>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center justify-end space-x-2 space-x-reverse p-4">
                        <div>
                            <p class="text-xs font-bold text-black">
                                {{ jdate($receivedTask->date)->format('Y/m/d') }}
                            </p>
                        </div>
                        @switch($receivedTask->level)
                            @case('high')
                                <div class="bg-red-500 text-white px-2 py-1 inline rounded-md shadow">
                                    <p class="text-xs">
                                        اهمیت بالا
                                    </p>
                                </div>
                                @break
                            @case('medium')
                                <div class="bg-yellow-500 text-white px-2 py-1 inline rounded-md shadow">
                                    <p class="text-xs">
                                        اهمیت متوسط
                                    </p>
                                </div>
                                @break
                            @case('low')
                                <div class="bg-gray-500 text-white px-2 py-1 inline rounded-md shadow">
                                    <p class="text-xs">
                                        اهمیت پایین
                                    </p>
                                </div>
                                @break
                        @endswitch
                    </div>
                    <div>
                        <p class="text-xs font-medium text-black text-center">
                            شرح : {{ $receivedTask->title }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-black text-center">
                            از طرف : {{ $receivedTask->user->name }}
                        </p>
                    </div>
                    @if($receivedTask->description)
                        <div>
                            <p class="text-xs font-medium text-black text-center">
                                توضیحات : {{ $receivedTask->description }}
                            </p>
                        </div>
                    @endif
                    @if($receivedTask->done_at)
                        <div>
                            <p class="text-xs font-medium text-black text-center">
                                تاریخ انجام شدن :
                                {{ jdate($receivedTask->done_at)->format('Y/m/d H:i') }}
                            </p>
                        </div>
                    @endif
                    <div class="flex items-center justify-between p-2 bg-gray-200 rounded-b-md border-t border-gray-400">
                        <div>
                            <a href="{{ route('tasks.reply',$receivedTask->id) }}"
                               class="page-info-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/>
                                </svg>
                                پاسخ
                            </a>
                        </div>
                        <div>
                            @if(!$receivedTask->done)
                                <form action="{{ route('tasks.mark-as-done', $receivedTask->id) }}"
                                      method="POST"
                                      class="page-success-btn">
                                    @csrf
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="m4.5 12.75 6 6 9-13.5"/>
                                    </svg>
                                    <button onclick="return confirm('وظیفه تمام شود ؟')">
                                        اتمام کار
                                    </button>
                                </form>
                            @else
                                <span class="bg-green-500 px-2 rounded-md text-white text-xs">
                                    انجام شده
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-layout>
