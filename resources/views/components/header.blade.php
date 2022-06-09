<nav class="flex justify-between shadow h-16 items-center px-4 bg-white">
    <button class="focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:rounded-md md:hidden"
            id="sidebar-open-icon">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-500" fill="none" viewBox="0 0 24 24"
             stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
        </svg>
    </button>
    <button onclick="toggleFullScreen()" class="focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-500" fill="none" viewBox="0 0 24 24"
             stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
        </svg>
    </button>

    <div class="flex items-center">
        <a href="#" class="pl-4 relative">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 text-yellow-600 bg-gray-100 rounded-full p-1"
                 fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
            </svg>
            <!-- Ping animation -->
            <span class="absolute top-1 h-2 w-2 rounded-full bg-yellow-500 opacity-90"></span>
            <span class="animate-ping absolute top-1 h-2 w-2 rounded-full bg-yellow-500 opacity-90"></span>
        </a>
        <div x-data="{open:false}" class="relative">
            <div class="flex items-center cursor-pointer" @click="open = !open">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-500" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div class="mr-2">
                    <p class="text-sm font-bold flex items-center">
                        {{ auth()->user()->name }}
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-5 w-5 text-gray-500 transition-transform transform" viewBox="0 0 20 20"
                             fill="currentColor" :class="{'rotate-180' : open}">
                            <path fill-rule="evenodd"
                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </p>
                    <span class="text-xs text-gray-500 font-bold">
                        @switch(auth()->user()->role)
                            @case('admin')
                                مدیریت
                                @break
                            @case('it')
                                بخش IT
                                @break
                            @case('user')
                                کاربر عادی
                                @break
                        @endswitch
                    </span>
                </div>
            </div>
            <div class="absolute w-48 bg-white shadow border border-gray-200 rounded-md p-2 top-14 -right-16"
                 x-show="open" x-cloak
                 @click.away="open = false">
                <a href="#"
                   class="px-4 py-2 text-xs md:text-sm block hover:bg-gray-50 rounded-md text-gray-600 hover:text-black flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="mr-1">تنظیمات</span>
                </a>
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit"
                            class="px-4 py-2 text-xs md:text-sm text-right w-full hover:bg-gray-50 rounded-md text-red-500 hover:text-red-700
                                flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span class="mr-1">
                            خروج
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
