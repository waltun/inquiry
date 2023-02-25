<x-layout>
    @push('meta')
        <meta http-equiv="refresh" content="300">
    @endpush

    <!-- Breadcrumb -->
    <nav class="flex bg-gray-100 p-4 rounded-md" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-2 space-x-reverse">
            <li aria-current="page">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                         fill="currentColor">
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                    <span class="mr-2 text-xs md:text-sm font-medium text-gray-400">
                        داشبورد
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Quick Access -->
    <div class="lg:grid grid-cols-3 gap-4 mt-4 space-y-4 lg:space-y-0">
        @can('categories')
            <div class="bg-yellow-500 rounded-md p-4 shadow-md">
                <a href="{{ route('categories.index') }}" class="flex justify-between items-center group">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-black group-hover:text-white"
                             fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-lg text-black font-medium group-hover:text-white">
                            دسته بندی قطعات
                        </p>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-black group-hover:text-white"
                             fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </div>
                </a>
            </div>
        @endcan

        @can('parts')
            <div class="bg-green-500 rounded-md p-4 shadow-md">
                <a href="{{ route('parts.index') }}" class="flex justify-between items-center group">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-black group-hover:text-white"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-lg text-black font-medium group-hover:text-white">
                            مدیریت قطعات
                        </p>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-black group-hover:text-white"
                             fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </div>
                </a>
            </div>
        @endcan

        @can('collections')
            <div class="bg-indigo-500 rounded-md p-4 shadow-md">
                <a href="{{ route('collections.index') }}" class="flex justify-between items-center group">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-black group-hover:text-white"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-lg text-black font-medium group-hover:text-white">
                            مدیریت کالا های نیم ساخته
                        </p>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-black group-hover:text-white"
                             fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </div>
                </a>
            </div>
        @endcan

        @can('groups')
            <div class="bg-red-500 rounded-md p-4 shadow-md">
                <a href="{{ route('groups.index') }}" class="flex justify-between items-center group">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-black group-hover:text-white"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-lg text-black font-medium group-hover:text-white">
                            محصولات و مدل ها
                        </p>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-black group-hover:text-white"
                             fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </div>
                </a>
            </div>
        @endcan

        <div class="bg-blue-400 rounded-md p-4 shadow-md">
            <a href="{{ route('collectionCoil.index') }}" class="flex justify-between items-center group">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-black group-hover:text-white"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"/>
                    </svg>
                </div>
                <div>
                    <p class="text-lg text-black font-medium group-hover:text-white">
                        کویل و دمپر و مبدل و تابلوبرق
                    </p>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-black group-hover:text-white"
                         fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                </div>
            </a>
        </div>

        @can('users')
            <div class="bg-gray-300 rounded-md p-4 shadow-md">
                <a href="{{ route('users.index') }}" class="flex justify-between items-center group">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-black group-hover:text-white"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-lg text-black font-medium group-hover:text-white">
                            کاربران
                        </p>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-black group-hover:text-white"
                             fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </div>
                </a>
            </div>
        @endcan

        @can('inquiries')
            <div class="bg-teal-400 rounded-md p-4 shadow-md">
                <a href="{{ route('inquiries.index') }}" class="flex justify-between items-center group">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-black group-hover:text-white"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-lg text-black font-medium group-hover:text-white">
                            استعلام ها
                        </p>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-black group-hover:text-white"
                             fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </div>
                </a>
            </div>
        @endcan

        @can('submit-inquiry')
            <div class="bg-teal-500 rounded-md p-4 shadow-md">
                <a href="{{ route('inquiries.submitted') }}" class="flex justify-between items-center group">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-black group-hover:text-white"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-lg text-black font-medium group-hover:text-white">
                            استعلام های منتظر قیمت
                        </p>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-black group-hover:text-white"
                             fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </div>
                </a>
            </div>
        @endcan

        @can('priced-inquiry')
            <div class="bg-teal-600 rounded-md p-4 shadow-md">
                <a href="{{ route('inquiries.priced') }}" class="flex justify-between items-center group">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-black group-hover:text-white"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-lg text-black font-medium group-hover:text-white">
                            استعلام های قیمت گذاری شده
                        </p>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-black group-hover:text-white"
                             fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </div>
                </a>
            </div>
        @endcan

        @can('price')
            <div class="bg-blue-400 rounded-md p-4 shadow-md">
                <a href="{{ route('parts.price.index') }}" class="flex justify-between items-center group">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="h-8 w-8 text-black group-hover:text-white">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-lg text-black font-medium group-hover:text-white">
                            بخش قیمت گذاری
                        </p>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-black group-hover:text-white"
                             fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </div>
                </a>
            </div>

            <div class="bg-red-400 rounded-md p-4 shadow-md col-span-2">
                <a href="{{ route('inquiryPrice.index') }}" class="flex justify-between items-center group">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="h-8 w-8 text-black group-hover:text-white">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-lg text-black font-medium group-hover:text-white">
                            درخواست های بروزرسانی قیمت
                        </p>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-black group-hover:text-white"
                             fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </div>
                </a>
            </div>
        @endcan
    </div>

    <div class="grid grid-cols-4 gap-4 mt-4">
        <div class="bg-pink-500 rounded-md p-4 shadow-md">
            <a href="{{ route('separate.coil.index') }}" class="flex justify-between items-center group">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="h-8 w-8 text-black group-hover:text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V13.5zm0 2.25h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V18zm2.498-6.75h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V13.5zm0 2.25h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V18zm2.504-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V18zm2.498-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zM8.25 6h7.5v2.25h-7.5V6zM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 002.25 2.25h10.5a2.25 2.25 0 002.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0012 2.25z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-lg text-black font-medium group-hover:text-white">
                        محاسبه قیمت کویل
                    </p>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-black group-hover:text-white"
                         fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                </div>
            </a>
        </div>

        <div class="bg-pink-400 rounded-md p-4 shadow-md">
            <a href="{{ route('separate.damper.index') }}" class="flex justify-between items-center group">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="h-8 w-8 text-black group-hover:text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V13.5zm0 2.25h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V18zm2.498-6.75h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V13.5zm0 2.25h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V18zm2.504-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V18zm2.498-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zM8.25 6h7.5v2.25h-7.5V6zM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 002.25 2.25h10.5a2.25 2.25 0 002.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0012 2.25z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-lg text-black font-medium group-hover:text-white">
                        محاسبه قیمت دمپر
                    </p>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-black group-hover:text-white"
                         fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                </div>
            </a>
        </div>

        <div class="bg-pink-300 rounded-md p-4 shadow-md">
            <a href="{{ route('separate.converter.index') }}" class="flex justify-between items-center group">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="h-8 w-8 text-black group-hover:text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V13.5zm0 2.25h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V18zm2.498-6.75h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V13.5zm0 2.25h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V18zm2.504-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V18zm2.498-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zM8.25 6h7.5v2.25h-7.5V6zM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 002.25 2.25h10.5a2.25 2.25 0 002.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0012 2.25z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-lg text-black font-medium group-hover:text-white">
                        محاسبه قیمت مبدل
                    </p>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-black group-hover:text-white"
                         fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                </div>
            </a>
        </div>

        <div class="bg-pink-200 rounded-md p-4 shadow-md">
            <a href="{{ route('separate.electrical.index') }}" class="flex justify-between items-center group">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="h-8 w-8 text-black group-hover:text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V13.5zm0 2.25h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V18zm2.498-6.75h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V13.5zm0 2.25h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V18zm2.504-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V18zm2.498-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zM8.25 6h7.5v2.25h-7.5V6zM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 002.25 2.25h10.5a2.25 2.25 0 002.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0012 2.25z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-lg text-black font-medium group-hover:text-white">
                        محاسبه قیمت تابلو برق
                    </p>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-black group-hover:text-white"
                         fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                </div>
            </a>
        </div>

        <div class="bg-indigo-500 rounded-md p-4 shadow-md col-span-4">
            <a href="{{ route('products.currentPrice') }}" class="flex justify-between items-center group">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="h-8 w-8 text-black group-hover:text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/>
                    </svg>

                </div>
                <div>
                    <p class="text-lg text-black font-medium group-hover:text-white">
                        مشاهده لیست قیمت لحظه ای محصولات استاندارد
                    </p>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-black group-hover:text-white"
                         fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                </div>
            </a>
        </div>
    </div>

    <!-- Last Inquiries -->
    <div class="lg:grid grid-cols-2 gap-4 mt-4 space-y-4 lg:space-y-0">
        @can('inquiries')
            <div class="border border-gray-300 bg-white rounded-md shadow-md p-4">
                <div class="mb-4 border-b border-gray-200 pb-3">
                    <p class="text-sm font-bold text-black">
                        جدیدترین استعلام ها
                    </p>
                </div>
                @if(!$inquiries->isEmpty())
                    @foreach($inquiries as $inquiry)
                        <a href="{{ route('inquiries.index') }}"
                           class="block py-6 px-4 border border-gray-200 shadow-sm rounded-md">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3 space-x-reverse">
                                    <p class="text-sm text-gray-600">
                                        شماره : {{ "INQ-" . $inquiry->inquiry_number }}
                                    </p>
                                    <p class="text-sm text-black font-medium">
                                        پروژه : {{ $inquiry->name }}
                                    </p>
                                    <p class="text-sm text-black">
                                        مسئول پروژه : {{ $inquiry->marketer }}
                                    </p>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-gray-600" fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <p class="text-center text-red-600 font-medium">استعلام جدیدی وجود ندارد!</p>
                @endif
            </div>
        @endcan

        @can('submit-inquiry')
            <div class="border border-gray-300 bg-white rounded-md shadow-md p-4">
                <div class="mb-4 border-b border-gray-200 pb-3">
                    <p class="text-sm font-bold text-black">
                        آخرین استعلام های منتظر قیمت گذاری
                    </p>
                </div>
                @if(!$submitInquiries->isEmpty())
                    @foreach($submitInquiries as $inquiry)
                        <a href="{{ route('inquiries.submitted') }}"
                           class="block py-6 px-4 border border-gray-200 shadow-sm rounded-md">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3 space-x-reverse">
                                    <p class="text-sm text-gray-600">
                                        شماره : {{ "INQ-" . $inquiry->inquiry_number }}
                                    </p>
                                    <p class="text-sm text-black font-medium">
                                        پروژه : {{ $inquiry->name }}
                                    </p>
                                    <p class="text-sm text-black">
                                        مسئول پروژه : {{ $inquiry->marketer }}
                                    </p>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-gray-600" fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <p class="text-center text-red-600 font-medium">استعلام منتظر قیمتی وجود ندارد!</p>
                @endif
            </div>
        @endcan
    </div>

</x-layout>
