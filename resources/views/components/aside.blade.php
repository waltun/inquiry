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
        <a href="{{ url('/') }}" class="px-4 py-2 flex items-center justify-center border-b border-gray-200">
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
        </a>

        <!-- Nav items -->
        <div class="p-2 space-y-1">

            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}"
               class="flex items-center text-gray-500 p-2 hover:bg-gray-100 rounded-md hover:text-black
                        {{ isActive(['dashboard']) }}">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>
                <span class="text-sm px-2">داشبورد</span>
            </a>

            <div class="border border-gray-300"></div>

            <!-- Categories -->
            @can('categories')
                <div x-data="{open:false}">
                    <div
                        class="flex items-center text-gray-500 p-2 hover:bg-gray-100 rounded-md hover:text-black cursor-pointer
                            {{ isActive(['categories.index','categories.create','categories.edit']) }}"
                        @click="open = !open">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                        <div class="flex justify-between w-full items-center">
                            <span class="text-sm px-2">دسته بندی قطعات</span>
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
                        <a href="{{ route('categories.index') }}" class="block text-sm text-gray-600 py-2 px-4 hover:bg-gray-100
                            hover:text-black rounded-md {{ isActive('categories.index') }}">
                            مدیریت دسته بندی ها
                        </a>
                        <a href="{{ route('categories.create') }}" class="block text-sm text-gray-600 py-2 px-4 hover:bg-gray-100
                            hover:text-black rounded-md {{ isActive('categories.create') }}">
                            ایجاد دسته بندی جدید
                        </a>
                    </div>
                </div>
            @endcan

            <!-- Parts -->
            @canany(['parts','collections','price'])
                <div x-data="{open:false}">
                    <div
                        class="flex items-center text-gray-500 p-2 hover:bg-gray-100 rounded-md hover:text-black cursor-pointer
                            {{ isActive(['parts.index','parts.create','parts.edit','collections.index','parts.price.index','parts.price.edit']) }}"
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
                            <span class="text-sm px-2">قطعات و کالای نیم ساخته</span>
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
                            hover:text-black rounded-md {{ isActive('parts.index') }}">
                                مدیریت قطعات
                            </a>
                            <a href="{{ route('parts.create') }}" class="block text-sm text-gray-600 py-2 px-4 hover:bg-gray-100
                            hover:text-black rounded-md {{ isActive('parts.create') }}">
                                ایجاد قطعه
                            </a>
                        @endcan
                        @can('collections')
                            <a href="{{ route('collections.index') }}" class="block text-sm text-gray-600 py-2 px-4 hover:bg-gray-100
                            hover:text-black rounded-md {{ isActive('collections.index') }}">
                                مدیریت کالا های نیم ساخته
                            </a>
                        @endcan
                        @can('price')
                            <a href="{{ route('parts.price.index') }}" class="block text-sm text-gray-600 py-2 px-4 hover:bg-gray-100
                            hover:text-black rounded-md {{ isActive(['parts.price.index','parts.price.edit']) }}">
                                بخش قیمت گذاری
                            </a>
                        @endcan
                    </div>
                </div>
            @endcanany

            <!-- Groups -->
            @can('groups')
                <div x-data="{open:false}">
                    <div
                        class="flex items-center text-gray-500 p-2 hover:bg-gray-100 rounded-md hover:text-black cursor-pointer
                            {{ isActive(['groups.index','groups.create','groups.edit','modells.index','modells.create','modells.edit']) }}"
                        @click="open = !open">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"/>
                            </svg>
                        </div>
                        <div class="flex justify-between w-full items-center">
                            <span class="text-sm px-2">محصولات و مدل ها</span>
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
                            hover:text-black rounded-md {{ isActive('groups.index') }}">
                            مدیریت محصولات
                        </a>
                        <a href="{{ route('groups.create') }}" class="block text-sm text-gray-600 py-2 px-4 hover:bg-gray-100
                            hover:text-black rounded-md {{ isActive('groups.create') }}">
                            ایجاد محصول جدید
                        </a>
                    </div>
                </div>
            @endcan

            <!-- Inquiries -->
            @canany(['inquiries','create-inquiry','submit-inquiry','priced-inquiry'])
                <div x-data="{open:false}">
                    <div
                        class="flex items-center text-gray-500 p-2 hover:bg-gray-100 rounded-md hover:text-black cursor-pointer
                            {{ isActive(['inquiries.index','inquiries.create','inquiries.edit','inquiries.show','inquiries.amounts','inquiries.submitted','inquiries.priced']) }}"
                        @click="open = !open">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="flex justify-between w-full items-center">
                            <span class="text-sm px-2">استعلام ها</span>
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
                        @can('inquiries')
                            <a href="{{ route('inquiries.index') }}" class="block text-sm text-gray-600 py-2 px-4 hover:bg-gray-100
                            hover:text-black rounded-md {{ isActive('inquiries.index') }}">
                                مدیریت استعلام ها
                            </a>
                        @endcan
                        @can('create-inquiry')
                            <a href="{{ route('inquiries.create') }}" class="block text-sm text-gray-600 py-2 px-4 hover:bg-gray-100
                            hover:text-black rounded-md {{ isActive('inquiries.create') }}">
                                ایجاد استعلام
                            </a>
                        @endcan
                        @can('submit-inquiry')
                            <a href="{{ route('inquiries.submitted') }}" class="block text-sm text-gray-600 py-2 px-4 hover:bg-gray-100
                            hover:text-black rounded-md {{ isActive('inquiries.submitted') }}">
                                استعلام های منتظر قیمت
                            </a>
                        @endcan
                        @can('priced-inquiry')
                            <a href="{{ route('inquiries.priced') }}" class="block text-sm text-gray-600 py-2 px-4 hover:bg-gray-100
                            hover:text-black rounded-md {{ isActive('inquiries.priced') }}">
                                استعلام های قیمت گذاری شده
                            </a>
                        @endcan
                    </div>
                </div>
            @endcanany

            <div class="border border-gray-300"></div>

            <!-- Collection coils -->
            @can('collections')
                <div x-data="{open:false}">
                    <div
                        class="flex items-center text-gray-500 p-2 hover:bg-gray-100 rounded-md hover:text-black cursor-pointer
                            {{ isActive(['collectionCoil.index']) }}"
                        @click="open = !open">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                            </svg>
                        </div>
                        <div class="flex justify-between w-full items-center">
                            <span class="text-sm px-2">لیست کویل و دمپر</span>
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
                        <a href="{{ route('collectionCoil.index') }}" class="block text-sm text-gray-600 py-2 px-4 hover:bg-gray-100
                            hover:text-black rounded-md {{ isActive('collectionCoil.index') }}">
                            مدیریت کویل و دمپر
                        </a>
                    </div>
                </div>
            @endcan

            <!-- Separate Calculate Coils -->
            <div x-data="{open:false}">
                <div
                    class="flex items-center text-gray-500 p-2 hover:bg-gray-100 rounded-md hover:text-black cursor-pointer
                            {{ isActive(['separate.coil.index']) }}"
                    @click="open = !open">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V13.5zm0 2.25h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V18zm2.498-6.75h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V13.5zm0 2.25h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V18zm2.504-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V18zm2.498-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zM8.25 6h7.5v2.25h-7.5V6zM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 002.25 2.25h10.5a2.25 2.25 0 002.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0012 2.25z"/>
                        </svg>
                    </div>
                    <div class="flex justify-between w-full items-center">
                        <span class="text-sm px-2">محاسبات قیمت کویل و دمپر  </span>
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
                    <a href="{{ route('separate.coil.index') }}" class="block text-sm text-gray-600 py-2 px-4 hover:bg-gray-100
                            hover:text-black rounded-md {{ isActive('separate.coil.index') }}">
                        قیمت کویل
                    </a>
                    <a href="{{ route('separate.damper.index') }}" class="block text-sm text-gray-600 py-2 px-4 hover:bg-gray-100
                            hover:text-black rounded-md {{ isActive('separate.coil.index') }}">
                        قیمت دمپر
                    </a>
                </div>
            </div>

            <div class="border border-gray-300"></div>

            <!-- Users -->
            @can('users')
                <div x-data="{open:false}">
                    <div
                        class="flex items-center text-gray-500 p-2 hover:bg-gray-100 rounded-md hover:text-black cursor-pointer
                            {{ isActive(['users.index','users.create','users.edit','users.deleted']) }}"
                        @click="open = !open">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div class="flex justify-between w-full items-center">
                            <span class="text-sm px-2">کاربران</span>
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
                            hover:text-black rounded-md {{ isActive('users.index') }}">
                            مدیریت کاربران
                        </a>
                        <a href="{{ route('users.create') }}" class="block text-sm text-gray-600 py-2 px-4 hover:bg-gray-100
                            hover:text-black rounded-md {{ isActive('users.create') }}">
                            ایجاد کاربر جدید
                        </a>
                        <a href="{{ route('users.deleted') }}" class="block text-sm text-gray-600 py-2 px-4 hover:bg-gray-100
                            hover:text-black rounded-md {{ isActive('users.deleted') }}">
                            کاربران حذف شده
                        </a>
                    </div>
                </div>
            @endcan
        </div>
    </aside>
</div>
