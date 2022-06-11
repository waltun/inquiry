<div class="fixed w-64 md:flex hidden h-full" id="sidebar">
    <aside class="bg-white overflow-y-auto flex flex-col flex-grow border-l border-gray-200"
           id="sidebar-content-layout">
        <span class="hidden justify-end pt-2 pl-2" id="sidebar-close-icon">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-7 w-7 bg-red-500 rounded-full text-white p-1 cursor-pointer" fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </span>
        <!-- Logo -->
        <div class="px-4 py-2 flex items-center justify-center border-b border-gray-200">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-600" viewBox="0 0 20 20"
                     fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"
                          clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="pr-2">
                <p class="font-bold text-xl">نام شرکت</p>
            </div>
        </div>

        <!-- Nav items -->
        <div class="p-2 space-y-1">

            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}"
               class="flex items-center text-gray-500 p-2 hover:bg-gray-100 rounded-md hover:text-black
                        {{ isActive(['dashboard'],'menu-active') }}">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>
                <span class="text-sm px-2">داشبورد</span>
            </a>

            <!-- Users -->
            @can('users')
                <div x-data="{open:false}">
                    <div
                        class="flex items-center text-gray-500 p-2 hover:bg-gray-100 rounded-md hover:text-black cursor-pointer
                            {{ isActive(['users.index','users.create','users.edit','users.deleted'],'menu-active') }}"
                        @click="open = !open">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div class="flex justify-between w-full items-center">
                            <span class="text-sm px-2">بخش کاربران</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform transform"
                                 viewBox="0 0 20 20" fill="currentColor"
                                 :class="{'rotate-180' : open}">
                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-1 bg-gray-50 rounded-md p-2" x-show="open" x-cloak>
                        <a href="{{ route('users.index') }}" class="block text-sm text-gray-600 py-2 px-4 hover:bg-gray-100
                            hover:text-black rounded-md {{ isActive('users.index','menu-active') }}">
                            مدیریت کاربران
                        </a>
                        <a href="{{ route('users.create') }}" class="block text-sm text-gray-600 py-2 px-4 hover:bg-gray-100
                            hover:text-black rounded-md {{ isActive('users.create','menu-active') }}">
                            ایجاد کاربر جدید
                        </a>
                        <a href="{{ route('users.deleted') }}" class="block text-sm text-gray-600 py-2 px-4 hover:bg-gray-100
                            hover:text-black rounded-md {{ isActive('users.deleted','menu-active') }}">
                            کاربران حذف شده
                        </a>
                    </div>
                </div>
            @endcan

            <!-- Groups -->
            @can('groups')
                <div x-data="{open:false}">
                    <div
                        class="flex items-center text-gray-500 p-2 hover:bg-gray-100 rounded-md hover:text-black cursor-pointer
                            {{ isActive(['groups.index','groups.create','groups.edit','modells.index','modells.create','modells.edit'],'menu-active') }}"
                        @click="open = !open">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"/>
                            </svg>
                        </div>
                        <div class="flex justify-between w-full items-center">
                            <span class="text-sm px-2">بخش گروه ها</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform transform"
                                 viewBox="0 0 20 20" fill="currentColor"
                                 :class="{'rotate-180' : open}">
                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-1 bg-gray-50 rounded-md p-2" x-show="open" x-cloak>
                        <a href="{{ route('groups.index') }}" class="block text-sm text-gray-600 py-2 px-4 hover:bg-gray-100
                            hover:text-black rounded-md {{ isActive('groups.index','menu-active') }}">
                            مدیریت گروه ها
                        </a>
                        <a href="{{ route('groups.create') }}" class="block text-sm text-gray-600 py-2 px-4 hover:bg-gray-100
                            hover:text-black rounded-md {{ isActive('groups.create','menu-active') }}">
                            ایجاد گروه جدید
                        </a>
                    </div>
                </div>
            @endcan

            <!-- Parts -->
            @canany(['parts','part-price'])
                <div x-data="{open:false}">
                    <div
                        class="flex items-center text-gray-500 p-2 hover:bg-gray-100 rounded-md hover:text-black cursor-pointer
                            {{ isActive(['parts.index','parts.create','parts.edit','parts.price.index','parts.price.edit'],'menu-active') }}"
                        @click="open = !open">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div class="flex justify-between w-full items-center">
                            <span class="text-sm px-2">بخش قطعات</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform transform"
                                 viewBox="0 0 20 20" fill="currentColor"
                                 :class="{'rotate-180' : open}">
                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-1 bg-gray-50 rounded-md p-2" x-show="open" x-cloak>
                        @can('parts')
                            <a href="{{ route('parts.index') }}" class="block text-sm text-gray-600 py-2 px-4 hover:bg-gray-100
                            hover:text-black rounded-md {{ isActive('parts.index','menu-active') }}">
                                مدیریت قطعات
                            </a>
                            <a href="{{ route('parts.create') }}" class="block text-sm text-gray-600 py-2 px-4 hover:bg-gray-100
                            hover:text-black rounded-md {{ isActive('parts.create','menu-active') }}">
                                ایجاد قطعه
                            </a>
                        @endcan
                        @can('part-price')
                            <a href="{{ route('parts.price.index') }}" class="block text-sm text-gray-600 py-2 px-4 hover:bg-gray-100
                            hover:text-black rounded-md {{ isActive(['parts.price.index','parts.price.edit'],'menu-active') }}">
                                بخش قیمت گذاری
                            </a>
                        @endcan
                    </div>
                </div>
            @endcanany

            <!-- Inquiries -->
            @canany(['inquiries','create-inquiry','inquiry-value','inquiry-detail'])
                <div x-data="{open:false}">
                    <div
                        class="flex items-center text-gray-500 p-2 hover:bg-gray-100 rounded-md hover:text-black cursor-pointer
                            {{ isActive(['inquiries.index','inquiries.create','inquiries.edit','inquiries.show','inquiries.amounts'],'menu-active') }}"
                        @click="open = !open">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                        <div class="flex justify-between w-full items-center">
                            <span class="text-sm px-2">بخش استعلام ها</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform transform"
                                 viewBox="0 0 20 20" fill="currentColor"
                                 :class="{'rotate-180' : open}">
                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-1 bg-gray-50 rounded-md p-2" x-show="open" x-cloak>
                        <a href="{{ route('inquiries.index') }}" class="block text-sm text-gray-600 py-2 px-4 hover:bg-gray-100
                            hover:text-black rounded-md {{ isActive('inquiries.index','menu-active') }}">
                            مدیریت استعلام ها
                        </a>
                        @can('create-inquiry')
                            <a href="{{ route('inquiries.create') }}" class="block text-sm text-gray-600 py-2 px-4 hover:bg-gray-100
                            hover:text-black rounded-md {{ isActive('inquiries.create','menu-active') }}">
                                ایجاد استعلام
                            </a>
                        @endcan
                    </div>
                </div>
            @endcanany
        </div>
    </aside>
</div>
