<nav class="header">
    <!-- Right -->
    <div class="flex items-center">
        <!-- Open & Close Menu -->
        <div class="header-toggle-menu" id="toggleMenuBtn">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-5 h-5 text-gray-500" id="menu-icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-5 h-5 text-gray-500 hidden" id="close-icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>

        </div>

        <!-- Notifications -->
        <a href="{{ route('notifications.index') }}" class="header-notification">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-5 h-5 text-gray-500 dark:text-gray-200">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0M3.124 7.5A8.969 8.969 0 015.292 3m13.416 0a8.969 8.969 0 012.168 4.5"/>
            </svg>
            <span class="w-3 h-3 rounded-full bg-myRed-200 absolute -right-0.5 -top-0.5"></span>
            <span class="w-3 h-3 rounded-full bg-myRed-200 absolute -right-0.5 -top-0.5 animate-ping"></span>
        </a>

        <!-- Toggle Dark -->
        <div id="toggleDarkBtn" class="header-dark-mode">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-5 h-5 text-gray-500 hidden" id="dark-icon">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z"/>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-5 h-5 text-gray-500 dark:text-gray-200 hidden" id="light-icon">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/>
            </svg>
        </div>

        <!-- Search -->
        <div class="mr-5 flex items-center relative">
            <input type="text"
                   class="w-56 bg-white dark:bg-slate-700 dark:border-black rounded-lg shadow-search px-4 py-2.5 text-xs border border-gray-200 dark:text-white"
                   placeholder="جستجوی کلمه مورد نظر">
            <button class="absolute left-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-5 h-5 text-gray-600 dark:text-gray-300">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Left -->
    <div class="flex items-center cursor-pointer">
        <div class="w-11 h-11 border-2 border-myBlue-100 rounded-full flex items-center justify-center">
            <img src="{{ asset('images/admin/user.png') }}" alt="" class="w-9 h-9">
        </div>
        <div class="mr-2">
            <p class="text-xs font-medium text-gray-700 dark:text-gray-200">{{ auth()->user()->name }}</p>
            <span class="text-xs text-gray-500 dark:text-gray-300">مدیریت</span>
        </div>
        <div class="mr-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                 class="w-5 h-5 text-gray-500 dark:text-gray-300">
                <path fill-rule="evenodd"
                      d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                      clip-rule="evenodd"/>
            </svg>
        </div>
    </div>
</nav>
