<nav class="header relative">
    <!-- Right -->
    <div class="flex items-center">
        <!-- Open & Close Menu -->
        <div class="header-toggle-menu" id="toggleMenuBtn">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-5 h-5 text-white" id="menu-icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-5 h-5 text-white hidden" id="close-icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>

        </div>

        <!-- Notifications -->
        <a href="{{ route('notifications.index') }}" class="header-notification hidden md:block">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-5 h-5 text-white dark:text-gray-200">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0M3.124 7.5A8.969 8.969 0 015.292 3m13.416 0a8.969 8.969 0 012.168 4.5"/>
            </svg>
            <span class="w-3 h-3 rounded-full bg-myRed-200 absolute -right-0.5 -top-0.5"></span>
            <span class="w-3 h-3 rounded-full bg-myRed-200 absolute -right-0.5 -top-0.5 animate-ping"></span>
        </a>

        <!-- Toggle Dark -->
        <div id="toggleDarkBtn" class="header-dark-mode hidden md:block">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-5 h-5 text-white hidden" id="dark-icon">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z"/>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-5 h-5 text-white dark:text-gray-200 hidden" id="light-icon">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/>
            </svg>
        </div>

        <!-- Search -->
        <div class="mr-5 md:flex items-center relative hidden">
            <input type="text"
                   class="w-56 bg-white dark:bg-slate-700 dark:border-black rounded-lg shadow-search px-4 py-2.5 text-xs border border-white dark:text-white"
                   placeholder="جستجوی کلمه مورد نظر">
            <button class="absolute left-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-5 h-5 text-gray-600 dark:text-gray-300">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                </svg>
            </button>
        </div>

        <div class="mr-5">
            <p class="text-white text-sm font-medium">
                امروز : {{ jdate(now())->format('%A, %d %B %Y') }}
            </p>
        </div>

        <div class="mr-5 border border-white px-4 py-1 rounded-md relative hidden md:block">
            <a href="{{ route('inquiryPrice.index') }}" class="text-sm font-bold text-white"
               target="_blank">
                درخواست های بروزرسانی قیمت
            </a>
            @if(!\App\Models\InquiryPrice::all()->isEmpty())
                <span class="w-3 h-3 rounded-full bg-myRed-200 absolute -right-0.5 -top-0.5"></span>
                <span
                    class="w-3 h-3 rounded-full bg-myRed-200 absolute -right-0.5 -top-0.5 animate-ping"></span>
            @endif
        </div>

        <div class="mr-5 border border-white px-4 py-1 rounded-md relative hidden md:block">
            <a href="https://cp117.netafraz.com/roundcube/" class="text-sm font-bold text-white" target="_blank">
                دسترسی به Webmail
            </a>
        </div>
    </div>

    <div x-data="{open:false}">
        <!-- Left -->
        <div class="flex items-center cursor-pointer relative" @click="open = !open">
            <div class="w-11 h-11 border-2 border-myBlue-100 rounded-full flex items-center justify-center">
                <img src="{{ asset('images/azarbad.png') }}" alt="" class="w-10">
            </div>
            <div class="mr-2">
                <p class="text-xs font-medium text-white dark:text-gray-200">{{ auth()->user()->name }}</p>
                <span class="text-xs text-white dark:text-gray-300">مدیریت</span>
            </div>
            <div class="mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                     class="w-5 h-5 text-white dark:text-gray-300">
                    <path fill-rule="evenodd"
                          d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                          clip-rule="evenodd"/>
                </svg>
            </div>
        </div>

        <!-- Dropdown -->
        <div class="absolute bg-white border border-mySky-100 left-10 top-20 rounded-lg shadow-search py-2"
             x-show="open">
            <div class="space-y-4">
                <div class="flex justify-center items-center px-6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-5 h-5 text-myBlue-300">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <a href="{{ route('settings.index') }}"
                       class="text-sm font-medium text-myBlue-300 hover:text-blue-600 mr-1">
                        تنظیمات
                    </a>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="flex justify-center items-center px-10">
                    @csrf
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-5 h-5 text-red-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/>
                    </svg>
                    <button type="submit" class="text-sm font-medium text-red-500 hover:text-red-600 mr-1">
                        خروج
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
