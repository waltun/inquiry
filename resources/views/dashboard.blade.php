<x-layout>
    <x-slot name="js">
        <script>
            function filterTask() {
                let form = document.getElementById('taskForm');
                form.submit();
            }
        </script>
    </x-slot>

    <div class="flex items-center mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
             stroke="currentColor" class="w-7 h-7 dark:text-white">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0l4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0l-5.571 3-5.571-3"/>
        </svg>
        <p class="pr-2 font-bold text-black text-2xl dark:text-white">
            داشبورد
        </p>
    </div>

    @php
        $tax = \App\Models\Tax::where('year', jdate(now())->getYear())->first();
    @endphp

    @if(is_null($tax))
        <div class="bg-red-500 p-4 rounded-md shadow">
            <p class="text-center text-white font-medium text-sm">
                برای سال جدید ({{ jdate(now())->getYear() }}) ارزش افزوده جدیدی ثبت نشده، لطفا برای ثبت ارزش افزوده به
                لینک زیر مراجعه کنید.
            </p>
            <div class="flex justify-center mt-2">
                <a href="{{ route('taxes.index') }}"
                   class="text-sm font-medium text-indigo-500 underline underline-offset-4">
                    ثبت ارزش افزوده
                </a>
            </div>
        </div>
    @endif

    <div x-data="{tab : 'admin'}" class="mb-4 hidden md:block">
        <div class="border-b border-indigo-400 dark:border-black mt-6">
            <ul class="flex md:flex-wrap -mb-px text-sm font-medium text-center text-gray-600 whitespace-nowrap overflow-x-auto">
                <li class="ml-2">
                    <button x-on:click="tab = 'admin'" type="button"
                            class="inline-flex px-4 py-2 text-myBlue-100 group rounded-t-lg dark:text-white"
                            :class="{ 'text-myBlue-100 border border-indigo-400 bg-gray-100 dark:bg-slate-900': tab === 'admin' }"
                            aria-current="page">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-5 h-5 ml-2 text-blue-600"
                             :class="{ 'text-blue-700': tab === 'admin' }">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/>
                        </svg>

                        مدیریت
                    </button>
                </li>
                <li class="ml-2">
                    <button x-on:click="tab = 'sale'" type="button"
                            class="inline-flex px-4 py-2 text-myBlue-100 group rounded-t-lg dark:text-white"
                            :class="{ 'text-myBlue-100 border border-indigo-400 bg-gray-100 dark:bg-slate-900': tab === 'sale' }"
                            aria-current="page">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-5 h-5 ml-2 text-blue-600"
                             :class="{ 'text-blue-700': tab === 'sale' }">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="m9 14.25 6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0c1.1.128 1.907 1.077 1.907 2.185ZM9.75 9h.008v.008H9.75V9Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm4.125 4.5h.008v.008h-.008V13.5Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/>
                        </svg>

                        فروش
                    </button>
                </li>
                <li class="ml-2">
                    <button x-on:click="tab = 'financial'" type="button"
                            class="inline-flex px-4 py-2 text-myBlue-100 group rounded-t-lg dark:text-white"
                            :class="{ 'text-myBlue-100 border border-indigo-400 bg-gray-100 dark:bg-slate-900': tab === 'financial' }"
                            aria-current="page">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-5 h-5 ml-2 text-blue-600"
                             :class="{ 'text-blue-700': tab === 'financial' }">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z"/>
                        </svg>
                        مالی و حسابداری
                    </button>
                </li>

                <li class="ml-2">
                    <button x-on:click="tab = 'official'" type="button"
                            class="inline-flex px-4 py-2 text-myBlue-100 group rounded-t-lg dark:text-white"
                            :class="{ 'text-myBlue-100 border border-indigo-400 bg-gray-100 dark:bg-slate-900': tab === 'official' }"
                            aria-current="page">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-5 h-5 ml-2 text-blue-600"
                             :class="{ 'text-blue-700': tab === 'official' }">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z"/>
                        </svg>

                        اداری و کارگزینی
                    </button>
                </li>
                <li class="ml-2">
                    <button x-on:click="tab = 'tasks'" type="button"
                            class="inline-flex px-4 py-2 text-myBlue-100 group rounded-t-lg dark:text-white"
                            :class="{ 'text-myBlue-100 border border-indigo-400 bg-gray-100 dark:bg-slate-900': tab === 'tasks' }"
                            aria-current="page">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-5 h-5 ml-2 text-blue-600"
                             :class="{ 'text-blue-700': tab === 'tasks' }">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75"/>
                        </svg>
                        وظایف
                    </button>
                </li>
                <li class="ml-2">
                    <button x-on:click="tab = 'store'" type="button"
                            class="inline-flex px-4 py-2 text-myBlue-100 group rounded-t-lg dark:text-white"
                            :class="{ 'text-myBlue-100 border border-indigo-400 bg-gray-100 dark:bg-slate-900': tab === 'store' }"
                            aria-current="page">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-5 h-5 ml-2 text-blue-600"
                             :class="{ 'text-blue-700': tab === 'store' }">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z"/>
                        </svg>

                        انبار و تدارکات
                    </button>
                </li>
            </ul>
        </div>

        <div x-show="tab === 'admin'"
             class="border border-indigo-400 dark:border-black border-t-0 rounded-b-lg" x-cloak>
            <div class="flex" x-data="{tab : 'price'}">
                <ul class="flex-column space-y space-y-4 text-xs font-medium mb-0 bg-gray-200 p-2 rounded-r-md">
                    <li>
                        <button x-on:click="tab = 'price'"
                                class="inline-flex items-center px-4 py-2 text-black rounded-lg w-full whitespace-nowrap"
                                :class="{'bg-red-500 text-white': tab === 'price'}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor" class="w-4 h-4 ml-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z"/>
                            </svg>
                            قیمت گذاری ها
                        </button>
                    </li>
                    <li>
                        <button x-on:click="tab = 'parts'" :class="{ 'bg-red-500 text-white': tab === 'parts' }"
                                class="inline-flex items-center px-4 py-2 rounded-lg w-full whitespace-nowrap">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor" class="w-4 h-4 ml-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M4.5 12a7.5 7.5 0 0 0 15 0m-15 0a7.5 7.5 0 1 1 15 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077 1.41-.513m14.095-5.13 1.41-.513M5.106 17.785l1.15-.964m11.49-9.642 1.149-.964M7.501 19.795l.75-1.3m7.5-12.99.75-1.3m-6.063 16.658.26-1.477m2.605-14.772.26-1.477m0 17.726-.26-1.477M10.698 4.614l-.26-1.477M16.5 19.794l-.75-1.299M7.5 4.205 12 12m6.894 5.785-1.149-.964M6.256 7.178l-1.15-.964m15.352 8.864-1.41-.513M4.954 9.435l-1.41-.514M12.002 12l-3.75 6.495"/>
                            </svg>
                            مدیریت قطعات
                        </button>
                    </li>
                    <li>
                        <button x-on:click="tab = 'setting'" :class="{ 'bg-red-500 text-white': tab === 'setting' }"
                                class="inline-flex items-center px-4 py-2 rounded-lg w-full whitespace-nowrap">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor" class="w-4 h-4 ml-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"/>
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            </svg>
                            تنظیمات
                        </button>
                    </li>
                </ul>
                <div x-show="tab === 'price'"
                     class="p-4 bg-gray-50 text-medium text-gray-500 rounded-lg w-full">
                    <div class="flex items-center space-x-2 space-x-reverse mb-4">
                        <p class="text-xs text-indigo-600">تب مدیریت</p>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-3 h-3 text-indigo-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/>
                        </svg>
                        <p class="text-xs text-indigo-600">
                            قیمت گذاری ها
                        </p>
                    </div>
                    <div class="md:grid grid-cols-3 gap-4 space-y-4 md:space-y-0">
                        @can('part-price')
                            <a href="{{ route('parts.price.index') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-pink-400 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5"
                                             stroke="currentColor"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/>
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                            بخش قیمت گذاری
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

                        @can('inquiry-price')
                            <a href="{{ route('inquiryPrice.index') }}" class="dashboard-cards group relative">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-red-500 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5"
                                             stroke="currentColor"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/>
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                            درخواست های بروزرسانی قیمت
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
                                @if(!\App\Models\InquiryPrice::all()->isEmpty())
                                    <span
                                        class="w-3 h-3 rounded-full bg-myRed-200 absolute -right-0.5 -top-0.5"></span>
                                    <span
                                        class="w-3 h-3 rounded-full bg-myRed-200 absolute -right-0.5 -top-0.5 animate-ping"></span>
                                @endif
                            </a>
                        @endcan
                    </div>
                </div>
                <div x-show="tab === 'parts'"
                     class="p-4 bg-gray-50 text-medium text-gray-500 rounded-lg w-full">
                    <div class="flex items-center space-x-2 space-x-reverse mb-4">
                        <p class="text-xs text-indigo-600">تب مدیریت</p>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-3 h-3 text-indigo-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/>
                        </svg>
                        <p class="text-xs text-indigo-600">
                            مدیریت قطعات
                        </p>
                    </div>
                    <div class="md:grid grid-cols-3 gap-4 space-y-4 md:space-y-0">
                        @can('categories')
                            <a href="{{ route('categories.index') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-yellow-400 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100"
                                             fill="none" viewBox="0 0 24 24"
                                             stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                            دسته بندی قطعات
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

                        @can('parts')
                            <a href="{{ route('parts.index') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-red-400 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100"
                                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                            مدیریت قطعات
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

                        @can('collections')
                            <a href="{{ route('collections.index') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-blue-400 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100"
                                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                            مدیریت کالاهای نیم ساخته
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

                        @canany(['groups','models'])
                            <a href="{{ route('groups.index') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-pink-400 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100"
                                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"/>
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                            محصولات و مدل ها
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
                        @endcanany

                        @can('collection-coils')
                            <a href="{{ route('collectionCoil.index') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-gray-400 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100"
                                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"/>
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                            کویل و دمپر و مبدل و تابلوبرق
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

                        @can('attribute-groups')
                            <a href="{{ route('attribute-groups.index') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-blue-400 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                            دسته بندی های مشخصات فنی
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
                </div>
                <div x-show="tab === 'setting'"
                     class="p-4 bg-gray-50 text-medium text-gray-500 rounded-lg w-full">
                    <div class="flex items-center space-x-2 space-x-reverse mb-4">
                        <p class="text-xs text-indigo-600">تب مدیریت</p>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-3 h-3 text-indigo-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/>
                        </svg>
                        <p class="text-xs text-indigo-600">
                            مدیریت قطعات
                        </p>
                    </div>
                    <div class="md:grid grid-cols-3 gap-4 space-y-4 md:space-y-0">
                        @can('users')
                            <a href="{{ route('users.index') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-green-400 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100"
                                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                            کاربران
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

                        @can('roles')
                            <a href="{{ route('roles.index') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-yellow-500 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"></path>
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-sm group-hover:text-white dark:text-white">
                                            نقش ها
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

                        @can('permissions')
                            <a href="{{ route('permissions.index') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-red-500 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5"
                                             stroke="currentColor"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M13.5 10.5V6.75a4.5 4.5 0 119 0v3.75M3.75 21.75h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H3.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                            دسترسی ها
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

                        <a href="{{ route('recieved-leave.index') }}" class="dashboard-cards group">
                            <div class="flex items-center">
                                <div class="dashboard-card-icon bg-yellow-400 dark:bg-slate-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor"
                                         class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z"/>
                                    </svg>
                                </div>
                                <div class="mr-4">
                                    <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                        درخواست های مرخصی
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
                </div>
            </div>
        </div>

        <div x-show="tab === 'sale'"
             class="border border-indigo-400 dark:border-black border-t-0 rounded-b-lg" x-cloak>
            <div class="flex" x-data="{tab : 'customer'}">
                <ul class="flex-column space-y space-y-4 text-xs font-medium mb-0 bg-gray-200 p-2 rounded-r-md">
                    <li>
                        <button x-on:click="tab = 'customer'"
                                :class="{'bg-red-500 text-white': tab === 'customer'}"
                                class="inline-flex items-center px-4 py-2 text-black rounded-lg w-full whitespace-nowrap">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor" class="w-4 h-4 ml-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/>
                            </svg>
                            مشتریان
                        </button>
                    </li>
                    <li>
                        <button x-on:click="tab = 'inquiry'"
                                :class="{'bg-red-500 text-white': tab === 'inquiry'}"
                                class="inline-flex items-center px-4 py-2 rounded-lg w-full whitespace-nowrap">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor" class="w-4 h-4 ml-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605"/>
                            </svg>
                            استعلام ها
                        </button>
                    </li>
                    <li>
                        <button x-on:click="tab = 'contract'"
                                :class="{'bg-red-500 text-white': tab === 'contract'}"
                                class="inline-flex items-center px-4 py-2 rounded-lg w-full whitespace-nowrap">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor" class="w-4 h-4 ml-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z"/>
                            </svg>
                            قرارداد ها
                        </button>
                    </li>
                    <li>
                        <button x-on:click="tab = 'calculation'"
                                :class="{'bg-red-500 text-white': tab === 'calculation'}"
                                class="inline-flex items-center px-4 py-2 rounded-lg w-full whitespace-nowrap">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor" class="w-4 h-4 ml-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008Zm0 2.25h.008v.008H8.25V13.5Zm0 2.25h.008v.008H8.25v-.008Zm0 2.25h.008v.008H8.25V18Zm2.498-6.75h.007v.008h-.007v-.008Zm0 2.25h.007v.008h-.007V13.5Zm0 2.25h.007v.008h-.007v-.008Zm0 2.25h.007v.008h-.007V18Zm2.504-6.75h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V13.5Zm0 2.25h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V18Zm2.498-6.75h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V13.5ZM8.25 6h7.5v2.25h-7.5V6ZM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 0 0 2.25 2.25h10.5a2.25 2.25 0 0 0 2.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0 0 12 2.25Z"/>
                            </svg>
                            محاسباتی ها
                        </button>
                    </li>
                    <li>
                        <button x-on:click="tab = 'current-price'"
                                :class="{'bg-red-500 text-white': tab === 'current-price'}"
                                class="inline-flex items-center px-4 py-2 rounded-lg w-full whitespace-nowrap">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor" class="w-4 h-4 ml-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                            قیمت لحظه ای
                        </button>
                    </li>
                </ul>

                <div x-show="tab === 'customer'"
                     class="p-4 bg-gray-50 text-medium text-gray-500 rounded-lg w-full">
                    <div class="flex items-center space-x-2 space-x-reverse mb-4">
                        <p class="text-xs text-indigo-600">تب فروش</p>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-3 h-3 text-indigo-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/>
                        </svg>
                        <p class="text-xs text-indigo-600">
                            مشتریان
                        </p>
                    </div>
                    <div class="md:grid grid-cols-3 gap-4 space-y-4 md:space-y-0">
                        @can('contracts')
                            <a href="{{ route('client-invoices.index') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-yellow-600 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                            مشتریان استعلام‌ها
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

                        @can('customers')
                            <a href="{{ route('customers.index') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-red-500 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                            مشتریان قراردادها
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
                </div>
                <div x-show="tab === 'inquiry'"
                     class="p-4 bg-gray-50 text-medium text-gray-500 rounded-lg w-full">
                    <div class="flex items-center space-x-2 space-x-reverse mb-4">
                        <p class="text-xs text-indigo-600">تب فروش</p>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-3 h-3 text-indigo-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/>
                        </svg>
                        <p class="text-xs text-indigo-600">
                            استعلام ها
                        </p>
                    </div>
                    <div class="md:grid grid-cols-3 gap-4 space-y-4 md:space-y-0">
                        @can('inquiries')
                            <a href="{{ route('inquiries.index') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-yellow-600 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100"
                                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                            استعلام ها
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
                            <a href="{{ route('inquiries.submitted') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-myBlue-100 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100"
                                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
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
                            <a href="{{ route('inquiries.priced') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-myGreen-100 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100"
                                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
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

                        <a href="{{ route('invoices.index') }}" class="dashboard-cards group">
                            <div class="flex items-center">
                                <div class="dashboard-card-icon bg-gray-600 dark:bg-slate-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor"
                                         class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                    </svg>
                                </div>
                                <div class="mr-4">
                                    <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                        پیش فاکتور های در حال انجام
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

                        <a href="{{ route('invoices.final.index') }}" class="dashboard-cards group">
                            <div class="flex items-center">
                                <div class="dashboard-card-icon bg-green-500 dark:bg-slate-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor"
                                         class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                    </svg>
                                </div>
                                <div class="mr-4">
                                    <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                        پیش فاکتورهای نهایی
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
                </div>
                <div x-show="tab === 'contract'"
                     class="p-4 bg-gray-50 text-medium text-gray-500 rounded-lg w-full">
                    <div class="flex items-center space-x-2 space-x-reverse mb-4">
                        <p class="text-xs text-indigo-600">تب فروش</p>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-3 h-3 text-indigo-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/>
                        </svg>
                        <p class="text-xs text-indigo-600">
                            قرارداد ها
                        </p>
                    </div>
                    <div class="md:grid grid-cols-3 gap-4 space-y-4 md:space-y-0">
                        @can('contracts')
                            <a href="{{ route('contracts.index') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-yellow-600 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                        </svg>

                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                            قرارداد ها
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

                        @can('analyze-parts')
                            <a href="{{ route('contracts.analyze-parts.index') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-red-500 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                            آنالیز همه قطعات
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

                        @can('shopping-parts')
                            <a href="{{ route('contracts.analyze-parts.shopping-parts') }}"
                               class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-indigo-500 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"></path>
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                            قطعات خریداری شده
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
                </div>
                <div x-show="tab === 'calculation'"
                     class="p-4 bg-gray-50 text-medium text-gray-500 rounded-lg w-full">
                    <div class="flex items-center space-x-2 space-x-reverse mb-4">
                        <p class="text-xs text-indigo-600">تب فروش</p>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-3 h-3 text-indigo-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/>
                        </svg>
                        <p class="text-xs text-indigo-600">
                            محاسباتی ها
                        </p>
                    </div>
                    <div class="md:grid grid-cols-3 gap-4 space-y-4 md:space-y-0">
                        @can('separate-calculate-coils')
                            <a href="{{ route('separate.coil.index') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-gray-600 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5"
                                             stroke="currentColor"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V13.5zm0 2.25h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V18zm2.498-6.75h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V13.5zm0 2.25h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V18zm2.504-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V18zm2.498-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zM8.25 6h7.5v2.25h-7.5V6zM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 002.25 2.25h10.5a2.25 2.25 0 002.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0012 2.25z"/>
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                            محاسبه قیمت کویل
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

                        @can('separate-calculate-dampers')
                            <a href="{{ route('separate.damper.index') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-myGreen-100 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5"
                                             stroke="currentColor"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V13.5zm0 2.25h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V18zm2.498-6.75h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V13.5zm0 2.25h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V18zm2.504-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V18zm2.498-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zM8.25 6h7.5v2.25h-7.5V6zM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 002.25 2.25h10.5a2.25 2.25 0 002.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0012 2.25z"/>
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                            محاسبه قیمت دمپر
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

                        @can('separate-calculate-converters')
                            <a href="{{ route('separate.converter.index') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-myYellow-100 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5"
                                             stroke="currentColor"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V13.5zm0 2.25h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V18zm2.498-6.75h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V13.5zm0 2.25h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V18zm2.504-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V18zm2.498-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zM8.25 6h7.5v2.25h-7.5V6zM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 002.25 2.25h10.5a2.25 2.25 0 002.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0012 2.25z"/>
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                            محاسبه قیمت مبدل
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

                        @can('separate-calculate-electricals')
                            <a href="{{ route('separate.electrical.index') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-myBlue-100 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5"
                                             stroke="currentColor"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V13.5zm0 2.25h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V18zm2.498-6.75h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V13.5zm0 2.25h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V18zm2.504-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V18zm2.498-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zM8.25 6h7.5v2.25h-7.5V6zM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 002.25 2.25h10.5a2.25 2.25 0 002.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0012 2.25z"/>
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                            محاسبه قیمت تابلوبرق
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
                </div>
                <div x-show="tab === 'current-price'"
                     class="p-4 bg-gray-50 text-medium text-gray-500 rounded-lg w-full">
                    <div class="flex items-center space-x-2 space-x-reverse mb-4">
                        <p class="text-xs text-indigo-600">تب فروش</p>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-3 h-3 text-indigo-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/>
                        </svg>
                        <p class="text-xs text-indigo-600">
                            قیمت لحظه ای محصولات
                        </p>
                    </div>
                    <div class="md:grid grid-cols-3 gap-4 space-y-4 md:space-y-0">
                        @can('current-price')
                            <a href="{{ route('products.currentPrice') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-yellow-600 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5"
                                             stroke="currentColor"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/>
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                            مشاهده لیست قیمت لحظه ای محصولات استاندارد
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
                </div>
            </div>
        </div>

        <div x-show="tab === 'financial'"
             class="border border-indigo-400 dark:border-black border-t-0 rounded-b-lg" x-cloak>
            <div class="flex" x-data="{tab : 'finan'}">
                <ul class="flex-column space-y space-y-4 text-xs font-medium mb-0 bg-gray-200 p-2 rounded-r-md">
                    <li>
                        <button x-on:click="tab = 'finan'" :class="{'bg-red-500 text-white': tab === 'finan'}"
                                class="inline-flex items-center px-4 py-2 text-white rounded-lg w-full whitespace-nowrap">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor" class="w-4 h-4 ml-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z"/>
                            </svg>
                            مالی و حسابداری
                        </button>
                    </li>
                </ul>
                <div x-show="tab === 'finan'"
                     class="p-4 bg-gray-50 text-medium text-gray-500 rounded-lg w-full">
                    <div class="flex items-center space-x-2 space-x-reverse mb-4">
                        <p class="text-xs text-indigo-600">تب مالی و حسابداری</p>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-3 h-3 text-indigo-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/>
                        </svg>
                        <p class="text-xs text-indigo-600">
                            مالی و حسابداری
                        </p>
                    </div>
                    <div class="md:grid grid-cols-3 gap-4 space-y-4 md:space-y-0">
                        @can('marketers')
                            <a href="{{ route('marketers.index') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-gray-600 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                            بازاریاب ها
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

                        @can('accounts')
                            <a href="{{ route('accounts.index') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-indigo-600 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5"
                                             stroke="currentColor"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                            شماره حساب های شرکت
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

                        @can('marketings')
                            <a href="{{ route('marketings.index') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-yellow-500 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/>
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                            همه بازاریابی‌ها
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

                        @can('payments')
                            <a href="{{ route('payments.index') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-green-500 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/>
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                            همه پرداخت ها
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

                        @can('payments')
                            <a href="{{ route('guarantee.index') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-red-500 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"/>
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                            همه تضامین
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

                        @can('factors')
                            <a href="{{ route('all-factors.index') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-black dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                            همه فاکتور ها
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
                </div>
            </div>
        </div>

        <div x-show="tab === 'official'"
             class="border border-indigo-400 dark:border-black border-t-0 rounded-b-lg" x-cloak>
            <div class="flex" x-data="{tab : 'office'}">
                <ul class="flex-column space-y space-y-4 text-xs font-medium mb-0 bg-gray-200 p-2 rounded-r-md">
                    <li>
                        <button x-on:click="tab = 'office'" :class="{'bg-red-500 text-white': tab === 'office'}"
                                class="inline-flex items-center px-4 py-2 text-white rounded-lg w-full whitespace-nowrap">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor" class="w-4 h-4 ml-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z"/>
                            </svg>
                            اداری و کارگزینی
                        </button>
                    </li>
                </ul>
                <div x-show="tab === 'office'"
                     class="p-4 bg-gray-50 text-medium text-gray-500 rounded-lg w-full">
                    <div class="flex items-center space-x-2 space-x-reverse mb-4">
                        <p class="text-xs text-indigo-600">تب اداری و کارگزینی</p>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-3 h-3 text-indigo-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/>
                        </svg>
                        <p class="text-xs text-indigo-600">
                            اداری و کارگزینی
                        </p>
                    </div>
                    <div class="md:grid grid-cols-3 gap-4 space-y-4 md:space-y-0">
                        @can('phonebooks')
                            <a href="{{ route('phonebook.index') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-myBlue-300 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5"
                                             stroke="currentColor"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3"/>
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                            دفترچه تلفن
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

                        @can('letters')
                            <a href="{{ route('letters.index') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-myRed-300 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5"
                                             stroke="currentColor"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                            دفتر ارسال مراسلات
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

                        <a href="{{ route('leaves.index') }}" class="dashboard-cards group">
                            <div class="flex items-center">
                                <div class="dashboard-card-icon bg-pink-500 dark:bg-slate-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor"
                                         class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12"/>
                                    </svg>
                                </div>
                                <div class="mr-4">
                                    <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                        درخواست های مرخصی
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
                </div>
            </div>
        </div>

        <div x-show="tab === 'tasks'"
             class="border border-indigo-400 dark:border-black border-t-0 rounded-b-lg" x-cloak>
            <div class="flex" x-data="{tab : 'task'}">
                <ul class="flex-column space-y space-y-4 text-xs font-medium mb-0 bg-gray-200 p-2 rounded-r-md">
                    <li>
                        <button x-on:click="tab = 'task'" :class="{'bg-red-500 text-white': tab === 'task'}"
                                class="inline-flex items-center px-4 py-2 text-white rounded-lg w-full whitespace-nowrap">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor" class="w-4 h-4 ml-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75"/>
                            </svg>
                            کارهای روزانه و وظایف
                        </button>
                    </li>
                </ul>
                <div x-show="tab === 'task'"
                     class="p-4 bg-gray-50 text-medium text-gray-500 rounded-lg w-full">
                    <div class="flex items-center space-x-2 space-x-reverse mb-4">
                        <p class="text-xs text-indigo-600">تب وظایف</p>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-3 h-3 text-indigo-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/>
                        </svg>
                        <p class="text-xs text-indigo-600">
                            کارهای روزانه و وظایف
                        </p>
                    </div>
                    <div class="md:grid grid-cols-3 gap-4 space-y-4 md:space-y-0">
                        @can('todos')
                            <a href="{{ route('todos.index') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-indigo-600 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z"/>
                                        </svg>

                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                            بخش کار های روزانه
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

                        @can('tasks')
                            <a href="{{ route('tasks.index') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-red-500 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                            بخش وظایف
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
                </div>
            </div>
        </div>

        <div x-show="tab === 'store'"
             class="border border-indigo-400 dark:border-black border-t-0 rounded-b-lg" x-cloak>
            <div class="flex" x-data="{tab : 'stor'}">
                <ul class="flex-column space-y space-y-4 text-xs font-medium mb-0 bg-gray-200 p-2 rounded-r-md">
                    <li>
                        <button x-on:click="tab = 'stor'" :class="{'bg-red-500 text-white': tab === 'stor'}"
                                class="inline-flex items-center px-4 py-2 text-black rounded-lg w-full whitespace-nowrap">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor" class="w-4 h-4 ml-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z"/>
                            </svg>
                            انبار و تدارکات
                        </button>
                    </li>
                </ul>
                <div x-show="tab === 'stor'"
                     class="p-4 bg-gray-50 text-medium text-gray-500 rounded-lg w-full">
                    <div class="flex items-center space-x-2 space-x-reverse mb-4">
                        <p class="text-xs text-indigo-600">تب انبار و تدارکات</p>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-3 h-3 text-indigo-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/>
                        </svg>
                        <p class="text-xs text-indigo-600">
                            انبار و تدارکات
                        </p>
                    </div>
                    <div class="md:grid grid-cols-3 gap-4 space-y-4 md:space-y-0">
                        @can('serials')
                            <a href="{{ route('serials.index') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-gray-500 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5"
                                             stroke="currentColor"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5zM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0113.5 9.375v-4.5z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M6.75 6.75h.75v.75h-.75v-.75zM6.75 16.5h.75v.75h-.75v-.75zM16.5 6.75h.75v.75h-.75v-.75zM13.5 13.5h.75v.75h-.75v-.75zM13.5 19.5h.75v.75h-.75v-.75zM19.5 13.5h.75v.75h-.75v-.75zM19.5 19.5h.75v.75h-.75v-.75zM16.5 16.5h.75v.75h-.75v-.75z"/>
                                        </svg>

                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                            شماره سریال محصولات
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

                        @can('codings')
                            <a href="{{ route('coding.index') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-pink-500 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5"
                                             stroke="currentColor"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path>
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                            کدینگ انبار
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

                        @can('all-stores')
                            <a href="{{ route('stores.index') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-blue-600 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5"
                                             stroke="currentColor"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                            اقلام ورودی به کارخانه
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

                        @can('purchase')
                            <a href="{{ route('purchase.index') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-yellow-600 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75"/>
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                            درخواست خرید ها
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

                        @can('system-categories')
                            <a href="{{ route('system-categories.index') }}" class="dashboard-cards group">
                                <div class="flex items-center">
                                    <div class="dashboard-card-icon bg-green-500 dark:bg-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5"
                                             stroke="currentColor"
                                             class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M6 6.878V6a2.25 2.25 0 012.25-2.25h7.5A2.25 2.25 0 0118 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 004.5 9v.878m13.5-3A2.25 2.25 0 0119.5 9v.878m0 0a2.246 2.246 0 00-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0121 12v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6c0-.98.626-1.813 1.5-2.122"/>
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                            دسته بندی ها
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
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-4 bg-white shadow p-2 rounded-md border border-gray-200 hidden md:block">
        <div x-data="{tab : 'today-todo'}" class="mb-4">
            <div class="border-b border-indigo-400 dark:border-black">
                <ul class="flex md:flex-wrap -mb-px text-sm font-medium text-center text-gray-600 whitespace-nowrap overflow-x-auto">
                    <li class="ml-2">
                        <button x-on:click="tab = 'today-todo'" type="button"
                                class="inline-flex px-4 py-2 text-myBlue-100 group rounded-t-lg dark:text-white"
                                :class="{ 'text-myBlue-100 border border-indigo-400 bg-gray-100 dark:bg-slate-900': tab === 'today-todo' }"
                                aria-current="page">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor"
                                 :class="{ 'text-blue-700': tab === 'today-todo' }"
                                 class="w-5 h-5 ml-2 text-blue-600">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z"></path>
                            </svg>

                            کار های امروز
                        </button>
                    </li>
                    <li class="ml-2">
                        <button x-on:click="tab = 'all-todo'" type="button"
                                class="inline-flex px-4 py-2 text-myBlue-100 group rounded-t-lg dark:text-white"
                                :class="{ 'text-myBlue-100 border border-indigo-400 bg-gray-100 dark:bg-slate-900': tab === 'all-todo' }"
                                aria-current="page">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ml-2 text-blue-600"
                                 :class="{ 'text-blue-700': tab === 'all-todo' }">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>


                            کار های آتی
                        </button>
                    </li>
                </ul>
            </div>

            <div x-show="tab === 'today-todo'"
                 class="rounded-b-lg px-4 py-6 border border-indigo-400 border-t-0" x-cloak>
                <div class="overflow-x-auto rounded-lg hidden md:block">
                    @if(!$todayTodos->isEmpty())
                        <table class="md:w-full border-collapse">
                            <thead>
                            <tr class="table-th-tr">
                                <th scope="col" class="p-2 rounded-tr-lg">
                                    تاریخ
                                </th>
                                <th scope="col" class="p-2">
                                    عنوان
                                </th>
                                <th scope="col" class="p-2">
                                    توضیحات
                                </th>
                                <th scope="col" class="p-2">
                                    <span class="sr-only">اقدامات</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($todayTodos as $todo)
                                <tr class="table-tb-tr whitespace-normal group hover:font-bold hover:text-red-600 {{ $loop->even ? 'bg-sky-100' : '' }}">
                                    <td class="table-tr-td border-t-0 border-l-0">
                                        {{ jdate($todo->date)->format('Y/m/d') }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0 {{ $todo->done ? 'line-through opacity-50' : '' }}">
                                        {{ $todo->title }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-x-0 {{ $todo->done ? 'line-through opacity-50' : '' }}">
                                        {{ $todo->description ?? '-' }}
                                    </td>
                                    <td class="table-tr-td border-t-0 border-r-0 whitespace-nowrap">
                                        <div class="flex items-center space-x-4 space-x-reverse justify-center">
                                            @if(!$todo->done)
                                                <form action="{{ route('todos.mark-as-done', $todo->id) }}"
                                                      method="POST"
                                                      class="table-success-btn">
                                                    @csrf
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke-width="1.5" stroke="currentColor"
                                                         class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="m4.5 12.75 6 6 9-13.5"/>
                                                    </svg>
                                                    <button onclick="return confirm('کار تمام شود ؟')">
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
                        <div class="bg-green-500 px-4 py-1 rounded-md">
                            <p class="text-sm text-white text-center">
                                تبریک! شما همه کار های روزانه رو انجام دادید
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <div x-show="tab === 'all-todo'"
                 class="rounded-b-lg px-4 py-6 border border-indigo-400 border-t-0" x-cloak>
                <div class="overflow-x-auto rounded-lg hidden md:block">
                    <table class="md:w-full border-collapse">
                        <thead>
                        <tr class="table-th-tr">
                            <th scope="col" class="p-2 rounded-tr-lg">
                                تاریخ
                            </th>
                            <th scope="col" class="p-2">
                                عنوان
                            </th>
                            <th scope="col" class="p-2">
                                توضیحات
                            </th>
                            <th scope="col" class="p-2">
                                <span class="sr-only">اقدامات</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($allTodos as $todo)
                            <tr class="table-tb-tr whitespace-normal group hover:font-bold hover:text-red-600 {{ $loop->even ? 'bg-sky-100' : '' }}">
                                <td class="table-tr-td border-t-0 border-l-0">
                                    {{ jdate($todo->date)->format('Y/m/d') }}
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0 {{ $todo->done ? 'line-through opacity-50' : '' }}">
                                    {{ $todo->title }}
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0 {{ $todo->done ? 'line-through opacity-50' : '' }}">
                                    {{ $todo->description ?? '-' }}
                                </td>
                                <td class="table-tr-td border-t-0 border-r-0 whitespace-nowrap">
                                    <div class="flex items-center space-x-4 space-x-reverse justify-center">
                                        @if(!$todo->done)
                                            <form action="{{ route('todos.mark-as-done', $todo->id) }}"
                                                  method="POST"
                                                  class="table-success-btn">
                                                @csrf
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                     viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="m4.5 12.75 6 6 9-13.5"/>
                                                </svg>
                                                <button onclick="return confirm('کار تمام شود ؟')">
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
                </div>
            </div>
        </div>

        <div x-data="{tab : 'sent-tasks'}" class="mb-8">
            <div class="border-b border-indigo-400 dark:border-black">
                <ul class="flex md:flex-wrap -mb-px text-sm font-medium text-center text-gray-600 whitespace-nowrap overflow-x-auto">
                    <li class="ml-2">
                        <button x-on:click="tab = 'sent-tasks'" type="button"
                                class="inline-flex px-4 py-2 text-myBlue-100 group rounded-t-lg dark:text-white"
                                :class="{ 'text-myBlue-100 border border-indigo-400 bg-gray-100 dark:bg-slate-900': tab === 'sent-tasks' }"
                                aria-current="page">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5"
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
                                class="inline-flex px-4 py-2 text-myBlue-100 group rounded-t-lg dark:text-white"
                                :class="{ 'text-myBlue-100 border border-indigo-400 bg-gray-100 dark:bg-slate-900': tab === 'received-tasks' }"
                                aria-current="page">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5"
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

            <div x-show="tab === 'received-tasks'"
                 class="rounded-b-lg px-4 py-6 border border-indigo-400 border-t-0" x-cloak>
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
                                <tr class="table-tb-tr whitespace-normal group hover:font-bold hover:text-red-600 {{ $loop->even ? 'bg-sky-100' : '' }}">
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
                                                <div
                                                    class="bg-red-500 text-white px-2 inline rounded-md shadow">
                                                    بالا
                                                </div>
                                                @break
                                            @case('medium')
                                                <div
                                                    class="bg-yellow-500 text-white px-2 inline rounded-md shadow">
                                                    متوسط
                                                </div>
                                                @break
                                            @case('low')
                                                <div
                                                    class="bg-gray-500 text-white px-2 inline rounded-md shadow">
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

                                                <form
                                                    action="{{ route('tasks.mark-as-done', $receivedTask->id) }}"
                                                    method="POST"
                                                    class="table-success-btn">
                                                    @csrf
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke-width="1.5" stroke="currentColor"
                                                         class="w-4 h-4 ml-1">
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

            <div x-show="tab === 'sent-tasks'" class="rounded-b-lg px-4 py-6 border border-indigo-400 border-t-0"
                 x-cloak>
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
                                <a href="{{ route('dashboard') }}" class="text-indigo-500 underline underline-offset-4 text-xs">
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
                                <tr class="table-tb-tr whitespace-normal group hover:font-bold hover:text-red-600 {{ $loop->even ? 'bg-sky-100' : '' }}">
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
                                                <div
                                                    class="bg-red-500 text-white px-2 inline rounded-md shadow">
                                                    بالا
                                                </div>
                                                @break
                                            @case('medium')
                                                <div
                                                    class="bg-yellow-500 text-white px-2 inline rounded-md shadow">
                                                    متوسط
                                                </div>
                                                @break
                                            @case('low')
                                                <div
                                                    class="bg-gray-500 text-white px-2 inline rounded-md shadow">
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
                                                                            <div class="mt-4 p-4 rounded-lg border border-gray-200 leading-6">
                                                                                <p class="text-sm font-medium text-black">
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
                                                @if(auth()->user()->id == $sentTask->user_id)
                                                    <form action="{{ route('tasks.destroy', $sentTask->id) }}"
                                                          method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="table-delete-btn"
                                                                onclick="return confirm('وظیفه حذف شود ؟')">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                 viewBox="0 0 24 24"
                                                                 stroke-width="1.5" stroke="currentColor"
                                                                 class="w-4 h-4 ml-1">
                                                                <path stroke-linecap="round"
                                                                      stroke-linejoin="round"
                                                                      d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                                            </svg>
                                                            حذف
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('tasks.review', $sentTask->id) }}"
                                                          method="POST">
                                                        @csrf
                                                        <button type="submit" class="table-info-btn"
                                                                onclick="return confirm('وظیفه بازنگری شود ؟')">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                 viewBox="0 0 24 24" stroke-width="1.5"
                                                                 stroke="currentColor" class="w-4 h-4 ml-1">
                                                                <path stroke-linecap="round"
                                                                      stroke-linejoin="round"
                                                                      d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/>
                                                            </svg>
                                                            بازنگری
                                                        </button>
                                                    </form>
                                                @endif
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
                                شما وظیفه جدیدی برای کسی ایجاد نکردید
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile -->
    <div class="block md:hidden">
        <div class="space-y-4">
            @can('todos')
                <a href="{{ route('todos.index') }}" class="dashboard-cards group">
                    <div class="flex items-center">
                        <div class="dashboard-card-icon bg-red-500 dark:bg-slate-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z"></path>
                            </svg>

                        </div>
                        <div class="mr-4">
                            <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                بخش کار های روزانه
                            </p>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             class="w-5 h-5 text-gray-600 group-hover:text-gray-200 dark:text-white">
                            <path fill-rule="evenodd"
                                  d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </a>
            @endcan

            @can('tasks')
                <a href="{{ route('tasks.index') }}" class="dashboard-cards group">
                    <div class="flex items-center">
                        <div class="dashboard-card-icon bg-yellow-600 dark:bg-slate-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"></path>
                            </svg>
                        </div>
                        <div class="mr-4">
                            <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                بخش وظایف (دریافتی)
                            </p>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             class="w-5 h-5 text-gray-600 group-hover:text-gray-200 dark:text-white">
                            <path fill-rule="evenodd"
                                  d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </a>
            @endcan

            @can('tasks')
                <a href="{{ route('tasks.sent') }}" class="dashboard-cards group">
                    <div class="flex items-center">
                        <div class="dashboard-card-icon bg-yellow-600 dark:bg-slate-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"></path>
                            </svg>
                        </div>
                        <div class="mr-4">
                            <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                بخش وظایف (ارسالی)
                            </p>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             class="w-5 h-5 text-gray-600 group-hover:text-gray-200 dark:text-white">
                            <path fill-rule="evenodd"
                                  d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </a>
            @endcan

            @can('leaves')
                <a href="{{ route('leaves.index') }}" class="dashboard-cards group">
                    <div class="flex items-center">
                        <div class="dashboard-card-icon bg-indigo-600 dark:bg-slate-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12"></path>
                            </svg>
                        </div>
                        <div class="mr-4">
                            <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                بخش مرخصی ها
                            </p>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             class="w-5 h-5 text-gray-600 group-hover:text-gray-200 dark:text-white">
                            <path fill-rule="evenodd"
                                  d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </a>
            @endcan

            @if(auth()->user()->role == 'admin')
                <a href="{{ route('recieved-leave.index') }}" class="dashboard-cards group">
                    <div class="flex items-center">
                        <div class="dashboard-card-icon bg-yellow-400 dark:bg-slate-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor"
                                 class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z"></path>
                            </svg>
                        </div>
                        <div class="mr-4">
                            <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                درخواست های مرخصی (مدیریت)
                            </p>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             class="w-5 h-5 text-gray-600 group-hover:text-gray-200 dark:text-white">
                            <path fill-rule="evenodd"
                                  d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </a>
            @endif

            @can('purchase')
                <a href="{{ route('purchase.view') }}" class="dashboard-cards group">
                    <div class="flex items-center">
                        <div class="dashboard-card-icon bg-pink-400 dark:bg-slate-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor"
                                 class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/>
                            </svg>
                        </div>
                        <div class="mr-4">
                            <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                لیست اقلام خرید (تدارکات)
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

            @can('purchase')
                <a href="{{ route('purchase.index') }}" class="dashboard-cards group">
                    <div class="flex items-center">
                        <div class="dashboard-card-icon bg-yellow-600 dark:bg-slate-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75"></path>
                            </svg>
                        </div>
                        <div class="mr-4">
                            <p class="font-bold text-black text-sm group-hover:text-white dark:text-white">
                                درخواست خرید ها
                            </p>
                        </div>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             class="w-5 h-5 text-gray-600 group-hover:text-gray-200 dark:text-white">
                            <path fill-rule="evenodd"
                                  d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </a>
            @endcan
        </div>
    </div>

    <!-- Tasks Modal -->
    @if($showModal && !$receivedTasks->isEmpty())
        <div x-data="{open:true}">
            <div class="relative z-10" x-show="open" x-cloak>
                <div class="modal-backdrop"></div>
                <div class="fixed z-10 inset-0 overflow-y-auto">
                    <div class="modal">
                        <div class="modal-body">
                            <div class="bg-white dark:bg-slate-800 p-4">
                                <div class="mb-4 flex justify-between items-center">
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                        وظایف دریافتی شما که باید انجام دهید
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
                                <div class="mt-6">
                                    <div class="mb-4">
                                        <p class="text-xs font-medium text-red-600">
                                            * لطفا توجه داشته باشید این پیام، هر 3 ساعت برای یادآوری به شما نمایش داده
                                            می شود. پس برای عدم نمایش این پیام لطفا وظایف را انجام دهید.
                                        </p>
                                    </div>
                                    <table class="md:w-full border-collapse">
                                        <thead>
                                        <tr class="table-th-tr">
                                            <th scope="col" class="p-2 rounded-tr-lg">
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
                                            <th scope="col" class="p-2 rounded-tl-lg">
                                                توضیحات
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($receivedTasks as $receivedTask)
                                            <tr class="table-tb-tr group hover:font-bold hover:text-red-600 {{ $loop->even ? 'bg-sky-100' : '' }}">
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
                                                            <div
                                                                class="bg-red-500 text-white px-2 inline rounded-md shadow">
                                                                اهمیت بالا
                                                            </div>
                                                            @break
                                                        @case('medium')
                                                            <div
                                                                class="bg-yellow-500 text-white px-2 inline rounded-md shadow">
                                                                اهمیت متوسط
                                                            </div>
                                                            @break
                                                        @case('low')
                                                            <div
                                                                class="bg-gray-500 text-white px-2 inline rounded-md shadow">
                                                                اهمیت پایین
                                                            </div>
                                                            @break
                                                    @endswitch
                                                </td>
                                                <td class="table-tr-td border-t-0 border-r-0 {{ $receivedTask->done ? 'line-through opacity-50' : '' }}">
                                                    {{ $receivedTask->description ?? '-' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-layout>
