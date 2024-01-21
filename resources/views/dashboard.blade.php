<x-layout>
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

    <div x-data="{tab : 'inquiry'}" class="mb-8">
        <div class="border-b border-indigo-400 dark:border-black mt-6">
            <ul class="flex md:flex-wrap -mb-px text-sm font-medium text-center text-gray-600 whitespace-nowrap overflow-x-auto">
                <li class="ml-2">
                    <button x-on:click="tab = 'inquiry'" type="button"
                            class="inline-flex p-4 text-myBlue-100 group rounded-t-lg dark:text-white"
                            :class="{ 'text-myBlue-100 border border-indigo-400 bg-gray-100 dark:bg-slate-900': tab === 'inquiry' }"
                            aria-current="page">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-5 h-5 ml-2 text-blue-600"
                             :class="{ 'text-blue-700': tab === 'inquiry' }">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 3.75H6.912a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H15M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859M12 3v8.25m0 0l-3-3m3 3l3-3"/>
                        </svg>

                        بخش استعلام ها
                    </button>
                </li>
                <li class="ml-2">
                    <button x-on:click="tab = 'contract'" type="button"
                            class="inline-flex p-4 text-myBlue-100 group rounded-t-lg dark:text-white"
                            :class="{ 'text-myBlue-100 border border-indigo-400 bg-gray-100 dark:bg-slate-900': tab === 'contract' }"
                            aria-current="page">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-5 h-5 ml-2 text-blue-600"
                             :class="{ 'text-blue-700': tab === 'contract' }">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                        </svg>

                        بخش قرارداد ها
                    </button>
                </li>
                <li class="ml-2">
                    <button x-on:click="tab = 'customers'" type="button"
                            class="inline-flex p-4 text-myBlue-100 group rounded-t-lg dark:text-white"
                            :class="{ 'text-myBlue-100 border border-indigo-400 bg-gray-100 dark:bg-slate-900': tab === 'customers' }"
                            aria-current="page">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-5 h-5 ml-2 text-blue-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
                        </svg>
                        بخش مشتریان
                    </button>
                </li>
                <li class="ml-2">
                    <button x-on:click="tab = 'financial'" type="button"
                            class="inline-flex p-4 text-myBlue-100 group rounded-t-lg dark:text-white"
                            :class="{ 'text-myBlue-100 border border-indigo-400 bg-gray-100 dark:bg-slate-900': tab === 'financial' }"
                            aria-current="page">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-5 h-5 ml-2 text-blue-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                        </svg>
                        بخش مالی
                    </button>
                </li>
                <li class="ml-2">
                    <button x-on:click="tab = 'price'" type="button"
                            class="inline-flex p-4 text-myBlue-100 group rounded-t-lg dark:text-white"
                            :class="{ 'text-myBlue-100 border border-indigo-400 bg-gray-100 dark:bg-slate-900': tab === 'price' }"
                            aria-current="page">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-5 h-5 ml-2 text-blue-600"
                             :class="{ 'text-blue-700': tab === 'price' }">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>

                        بخش قیمت گذاری
                    </button>
                </li>
                <li class="ml-2">
                    <button x-on:click="tab = 'calculate'" type="button"
                            class="inline-flex p-4 text-myBlue-100 group rounded-t-lg dark:text-white"
                            :class="{ 'text-myBlue-100 border border-indigo-400 bg-gray-100 dark:bg-slate-900': tab === 'calculate' }"
                            aria-current="page">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-5 h-5 ml-2 text-blue-600"
                             :class="{ 'text-blue-700': tab === 'calculate' }">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V13.5zm0 2.25h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V18zm2.498-6.75h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V13.5zm0 2.25h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V18zm2.504-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V18zm2.498-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zM8.25 6h7.5v2.25h-7.5V6zM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 002.25 2.25h10.5a2.25 2.25 0 002.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0012 2.25z"/>
                        </svg>

                        بخش محاسباتی ها
                    </button>
                </li>
                <li class="ml-2">
                    <button x-on:click="tab = 'admin'" type="button"
                            class="inline-flex p-4 rounded-t-lg dark:text-white"
                            :class="{ 'text-myBlue-100 border border-indigo-400 bg-gray-100 dark:bg-slate-900': tab === 'admin' }">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-5 h-5 ml-2 text-blue-600"
                             :class="{ 'text-blue-700': tab === 'admin' }">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z"/>
                        </svg>

                        بخش مدیریت
                    </button>
                </li>
                <li class="ml-2">
                    <button x-on:click="tab = 'current-price'" type="button"
                            class="inline-flex p-4 text-myBlue-100 group rounded-t-lg dark:text-white"
                            :class="{ 'text-myBlue-100 border border-indigo-400 bg-gray-100 dark:bg-slate-900': tab === 'current-price' }"
                            aria-current="page">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-5 h-5 ml-2 text-blue-600"
                             :class="{ 'text-blue-700': tab === 'current-price' }">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/>
                        </svg>

                        قیمت لحظه ای محصولات
                    </button>
                </li>
            </ul>
        </div>

        <div x-show="tab === 'inquiry'"
             class="border border-indigo-400 dark:border-black border-t-0 rounded-b-lg px-4 py-6" x-cloak>
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
                                <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
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

            <div class="md:grid grid-cols-2 gap-4 space-y-4 md:space-y-0 mt-4">
                <a href="{{ route('invoices.index') }}" class="dashboard-cards group">
                    <div class="flex items-center">
                        <div class="dashboard-card-icon bg-gray-600 dark:bg-slate-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                            </svg>
                        </div>
                        <div class="mr-4">
                            <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
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
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                            </svg>
                        </div>
                        <div class="mr-4">
                            <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
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
             class="border border-indigo-400 dark:border-black border-t-0 rounded-b-lg px-4 py-6" x-cloak>
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
                                <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
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
                                <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
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
                    <a href="{{ route('contracts.analyze-parts.shopping-parts') }}" class="dashboard-cards group">
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
                                <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
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

        <div x-show="tab === 'customers'"
             class="border border-indigo-400 dark:border-black border-t-0 rounded-b-lg px-4 py-6" x-cloak>
            <div class="md:grid grid-cols-2 gap-4 space-y-4 md:space-y-0">
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
                                <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
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
                                <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
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

        <div x-show="tab === 'financial'"
             class="border border-indigo-400 dark:border-black border-t-0 rounded-b-lg px-4 py-6" x-cloak>
            <div class="md:grid grid-cols-2 gap-4 space-y-4 md:space-y-0">
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
                                <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
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
                                     stroke="currentColor" class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                                </svg>
                            </div>
                            <div class="mr-4">
                                <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
                                    حساب ها
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

            <div class="md:grid grid-cols-2 gap-4 space-y-4 md:space-y-0 mt-4">
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
                                <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
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
                                <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
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
            </div>
        </div>

        <div x-show="tab === 'price'"
             class="border border-indigo-400 dark:border-black border-t-0 rounded-b-lg px-4 py-6" x-cloak>
            <div class="md:grid grid-cols-2 gap-4 space-y-4 md:space-y-0">
                @can('part-price')
                    <a href="{{ route('parts.price.index') }}" class="dashboard-cards group">
                        <div class="flex items-center">
                            <div class="dashboard-card-icon bg-pink-400 dark:bg-slate-800">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="currentColor" class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/>
                                </svg>
                            </div>
                            <div class="mr-4">
                                <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
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
                                     stroke="currentColor" class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/>
                                </svg>
                            </div>
                            <div class="mr-4">
                                <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
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
                            <span class="w-3 h-3 rounded-full bg-myRed-200 absolute -right-0.5 -top-0.5"></span>
                            <span
                                class="w-3 h-3 rounded-full bg-myRed-200 absolute -right-0.5 -top-0.5 animate-ping"></span>
                        @endif
                    </a>
                @endcan
            </div>
        </div>

        <div x-show="tab === 'calculate'"
             class="border border-indigo-400 dark:border-black border-t-0 rounded-b-lg px-4 py-6" x-cloak>
            <div class="md:grid grid-cols-4 gap-4 space-y-4 md:space-y-0">
                @can('separate-calculate-coils')
                    <a href="{{ route('separate.coil.index') }}" class="dashboard-cards group">
                        <div class="flex items-center">
                            <div class="dashboard-card-icon bg-gray-600 dark:bg-slate-800">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="currentColor" class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V13.5zm0 2.25h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V18zm2.498-6.75h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V13.5zm0 2.25h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V18zm2.504-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V18zm2.498-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zM8.25 6h7.5v2.25h-7.5V6zM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 002.25 2.25h10.5a2.25 2.25 0 002.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0012 2.25z"/>
                                </svg>
                            </div>
                            <div class="mr-4">
                                <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
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
                                     stroke="currentColor" class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V13.5zm0 2.25h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V18zm2.498-6.75h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V13.5zm0 2.25h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V18zm2.504-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V18zm2.498-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zM8.25 6h7.5v2.25h-7.5V6zM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 002.25 2.25h10.5a2.25 2.25 0 002.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0012 2.25z"/>
                                </svg>
                            </div>
                            <div class="mr-4">
                                <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
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
                                     stroke="currentColor" class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V13.5zm0 2.25h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V18zm2.498-6.75h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V13.5zm0 2.25h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V18zm2.504-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V18zm2.498-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zM8.25 6h7.5v2.25h-7.5V6zM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 002.25 2.25h10.5a2.25 2.25 0 002.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0012 2.25z"/>
                                </svg>
                            </div>
                            <div class="mr-4">
                                <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
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
                                     stroke="currentColor" class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V13.5zm0 2.25h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V18zm2.498-6.75h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V13.5zm0 2.25h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V18zm2.504-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V18zm2.498-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zM8.25 6h7.5v2.25h-7.5V6zM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 002.25 2.25h10.5a2.25 2.25 0 002.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0012 2.25z"/>
                                </svg>
                            </div>
                            <div class="mr-4">
                                <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
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

        <div x-show="tab === 'admin'"
             class="border border-indigo-400 dark:border-black border-t-0 rounded-b-lg px-4 py-6" x-cloak>
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
                                <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
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
                                <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
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
                                <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
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
            </div>

            <div class="md:grid grid-cols-3 gap-4 space-y-4 md:space-y-0 mt-4">
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
                                <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
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
                                <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
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
                                <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
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
            </div>

            <div class="md:grid grid-cols-3 gap-4 space-y-4 md:space-y-0 mt-4">
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
                                <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
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
                                     stroke="currentColor" class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M13.5 10.5V6.75a4.5 4.5 0 119 0v3.75M3.75 21.75h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H3.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                                </svg>
                            </div>
                            <div class="mr-4">
                                <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
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
                                <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
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

                @can('settings')
                    <a href="{{ route('settings.index') }}" class="dashboard-cards group">
                        <div class="flex items-center">
                            <div class="dashboard-card-icon bg-gray-400 dark:bg-slate-800">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor"
                                     class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div class="mr-4">
                                <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
                                    بخش تنظیمات
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

                @can('todos')
                    <a href="{{ route('todos.index') }}" class="dashboard-cards group">
                        <div class="flex items-center">
                            <div class="dashboard-card-icon bg-green-500 dark:bg-slate-800">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor"
                                     class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z"/>
                                </svg>
                            </div>
                            <div class="mr-4">
                                <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
                                    بخش کارهای روزانه
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
             class="border border-indigo-400 dark:border-black border-t-0 rounded-b-lg px-4 py-6"
             x-cloak>
            @can('current-price')
                <a href="{{ route('products.currentPrice') }}" class="dashboard-cards group">
                    <div class="flex items-center">
                        <div class="dashboard-card-icon bg-yellow-600 dark:bg-slate-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6 text-white group-hover:text-myBlue-100">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/>
                            </svg>
                        </div>
                        <div class="mr-4">
                            <p class="font-bold text-black text-base group-hover:text-white dark:text-white">
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

    <div class="grid grid-cols-2 gap-4">
        <div class="card">
            <div class="card-header">
                <p class="card-title">کارهای روزانه</p>
            </div>

            <div class="overflow-x-auto rounded-lg hidden md:block">
                <table class="md:w-full border-collapse">
                    <thead>
                    <tr class="table-th-tr">
                        <th scope="col" class="p-2 rounded-tr-lg">
                            #
                        </th>
                        <th scope="col" class="p-2">
                            عنوان
                        </th>
                        <th scope="col" class="p-2">
                            تاریخ
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
                    @foreach($todos as $todo)
                        <tr class="table-tb-tr group hover:font-bold hover:text-red-600 {{ $loop->even ? 'bg-sky-100' : '' }}">
                            <td class="table-tr-td border-t-0 border-l-0">
                                {{ $loop->index + 1 }}
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0 {{ $todo->done ? 'line-through opacity-50' : '' }}">
                                {{ $todo->title }}
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0 {{ $todo->done ? 'line-through opacity-50' : '' }}">
                                {{ jdate($todo->date)->format('Y/m/d') }}
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
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
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
</x-layout>
