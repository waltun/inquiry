<x-layout>
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
                    مدیریت وظیفه های ارسالی
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
                    لیست وظیفه های ارسالی
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

    <div class="mt-4 space-y-4 block md:hidden">
        @foreach($sentTasks as $sentTask)
            <div class="rounded-md shadow border border-indigo-500 relative {{ $sentTask->done ? 'bg-green-100' : 'bg-white' }}">
                <div class="absolute w-7 h-7 rounded-full bg-sky-200 top-2 right-2 grid place-content-center">
                    <p class="text-sm font-medium">
                        {{ $loop->index + 1 }}
                    </p>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center justify-end space-x-2 space-x-reverse p-4">
                        <div>
                            <p class="text-xs font-bold text-black">
                                {{ jdate($sentTask->date)->format('Y/m/d') }}
                            </p>
                        </div>
                        @switch($sentTask->level)
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
                        <p class="text-xs font-medium text-black text-center {{ $sentTask->done ? 'line-through text-gray-500' : '' }}">
                            شرح : {{ $sentTask->title }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-black text-center">
                            ارسال شده برای : {{ $sentTask->receiver->name }}
                        </p>
                    </div>
                    @if($sentTask->description)
                        <div>
                            <p class="text-xs font-medium text-black text-center">
                                توضیحات : {{ $sentTask->description }}
                            </p>
                        </div>
                    @endif
                    @if($sentTask->done_at)
                        <div>
                            <p class="text-xs font-medium text-black text-center">
                                تاریخ انجام شدن :
                                {{ jdate($sentTask->done_at)->format('Y/m/d H:i') }}
                            </p>
                        </div>
                    @endif
                    <div
                        class="flex items-center justify-between p-2 bg-gray-200 rounded-b-md border-t border-gray-400">
                        <div>
                            <a href="{{ route('tasks.edit',$sentTask->id) }}"
                               class="page-info-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor"
                                     class="w-4 h-4 ml-1">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                </svg>
                                ویرایش
                            </a>
                        </div>
                        <div>
                            <form action="{{ route('tasks.destroy',$sentTask->id) }}"
                                  method="POST"
                                  class="page-delete-btn">
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
                        </div>
                        <div>
                            @if($sentTask->done)
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
