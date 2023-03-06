<div class="fixed w-0 flex h-full" id="sidebar">
    <aside class="aside sidebar">
        <!-- Logo -->
        <div class="py-8 px-4 flex items-center justify-between">
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" target="_blank">
                    <img src="{{ asset('images/azarbad.png') }}" alt="" class="h-10">
                </a>
                <a href="{{ route('dashboard') }}" class="pr-2" target="_blank">
                    <p class="font-bold text-lg dark:text-white text-black">آذرباد</p>
                </a>
            </div>
            <div>
                <span class="text-xs font-medium rounded-3xl bg-myYellow-100 text-white p-2 shadow-yellow">
                    استعلام قیمت
                </span>
            </div>
        </div>

        <!-- Nav items -->
        <div class="mt-6 px-8 space-y-4">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" class="aside-items">
                <!-- Section Name -->
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor"
                         class="w-5 h-5 dark:text-white {{ isActive('admin.dashboard','menu-active') }}">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0l4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0l-5.571 3-5.571-3"/>
                    </svg>
                    <p class="text-base mr-2.5 dark:text-white {{ isActive('admin.dashboard','menu-active') }}">
                        داشبورد
                    </p>
                </div>

                <!-- Down Icon -->
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                         class="w-5 h-5 dark:text-white {{ isActive('admin.dashboard','menu-active') }}">
                        <path fill-rule="evenodd"
                              d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                              clip-rule="evenodd"/>
                    </svg>
                </div>

                <!-- Right Color when active -->
                <span
                    class="absolute h-7 bg-myBlue-100 rounded-md shadow-aside-active -right-9 {{ isActive('admin.dashboard','w-2.5') }}"></span>
            </a>

            <!-- Categories -->
            @php
                $categoryRoutes = [
                    'categories.index','categories.create','categories.edit'
                ];
            @endphp
            <a href="{{ route('categories.index') }}" class="aside-items">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5 dark:text-white {{ isActive($categoryRoutes,'menu-active') }}"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <p class="text-base mr-2.5 dark:text-white {{ isActive($categoryRoutes,'menu-active') }}">
                        دسته بندی قطعات
                    </p>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                         class="w-5 h-5 dark:text-white {{ isActive($categoryRoutes,'menu-active') }}">
                        <path fill-rule="evenodd"
                              d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                              clip-rule="evenodd"/>
                    </svg>
                </div>

                <!-- Right Color when active -->
                <span
                    class="absolute h-7 bg-myBlue-100 rounded-md shadow-aside-active -right-9 {{ isActive($categoryRoutes,'w-2.5') }}"></span>
            </a>

            <!-- Parts -->
            @php
                $partRoutes = [
                    'parts.index','parts.create','parts.edit'
                ];
            @endphp
            <a href="{{ route('parts.index') }}" class="aside-items">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5 dark:text-white {{ isActive($partRoutes,'menu-active') }}" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <p class="text-base mr-2.5 dark:text-white {{ isActive($partRoutes,'menu-active') }}">
                        قطعات
                    </p>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                         class="w-5 h-5 dark:text-white {{ isActive($partRoutes,'menu-active') }}">
                        <path fill-rule="evenodd"
                              d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                              clip-rule="evenodd"/>
                    </svg>
                </div>

                <!-- Right Color when active -->
                <span
                    class="absolute h-7 bg-myBlue-100 rounded-md shadow-aside-active -right-9 {{ isActive($partRoutes,'w-2.5') }}"></span>
            </a>

            <!-- Collections -->
            @php
                $collectionRoutes = [
                    'collections.index','collections.parts','parts.edit'
                ];
            @endphp
            <a href="{{ route('collections.index') }}" class="aside-items">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5 dark:text-white {{ isActive($collectionRoutes,'menu-active') }}" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                    </svg>
                    <p class="text-base mr-2.5 dark:text-white {{ isActive($collectionRoutes,'menu-active') }}">
                        کالاهای نیم ساخته
                    </p>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                         class="w-5 h-5 dark:text-white {{ isActive($collectionRoutes,'menu-active') }}">
                        <path fill-rule="evenodd"
                              d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                              clip-rule="evenodd"/>
                    </svg>
                </div>

                <!-- Right Color when active -->
                <span
                    class="absolute h-7 bg-myBlue-100 rounded-md shadow-aside-active -right-9 {{ isActive($collectionRoutes,'w-2.5') }}"></span>
            </a>

            <!-- Groups & Models -->
            @php
                $productRoutes = [
                    'groups.index','groups.edit','groups.create','modells.edit','modells.parts','modells.create'
                ];
            @endphp
            <a href="{{ route('groups.index') }}" class="aside-items">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5 dark:text-white {{ isActive($productRoutes,'menu-active') }}" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
                    </svg>
                    <p class="text-base mr-2.5 dark:text-white {{ isActive($productRoutes,'menu-active') }}">
                        محصولات و مدل ها
                    </p>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                         class="w-5 h-5 dark:text-white {{ isActive($productRoutes,'menu-active') }}">
                        <path fill-rule="evenodd"
                              d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                              clip-rule="evenodd"/>
                    </svg>
                </div>

                <!-- Right Color when active -->
                <span
                    class="absolute h-7 bg-myBlue-100 rounded-md shadow-aside-active -right-9 {{ isActive($productRoutes,'w-2.5') }}"></span>
            </a>

            <!-- Inquiries -->
            @php
                $inquiryRoutes = [
                    'inquiries.index','inquiries.product.index','inquiries.product.amounts','inquiries.parts.index'
                ];
            @endphp
            <a href="{{ route('inquiries.index') }}" class="aside-items">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5 dark:text-white {{ isActive($inquiryRoutes,'menu-active') }}" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-base mr-2.5 dark:text-white {{ isActive($inquiryRoutes,'menu-active') }}">
                        استعلام ها
                    </p>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                         class="w-5 h-5 dark:text-white {{ isActive($inquiryRoutes,'menu-active') }}">
                        <path fill-rule="evenodd"
                              d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                              clip-rule="evenodd"/>
                    </svg>
                </div>

                <!-- Right Color when active -->
                <span
                    class="absolute h-7 bg-myBlue-100 rounded-md shadow-aside-active -right-9 {{ isActive($inquiryRoutes,'w-2.5') }}"></span>
            </a>

            <!-- Pricing -->
            @php
                $pricingRoutes = [
                    'parts.price.index'
                ];
            @endphp
            <a href="{{ route('parts.price.index') }}" class="aside-items">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor"
                         class="w-5 h-5 dark:text-white {{ isActive($pricingRoutes,'menu-active') }}">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"></path>
                    </svg>
                    <p class="text-base mr-2.5 dark:text-white {{ isActive($pricingRoutes,'menu-active') }}">
                        قیمت گذاری
                    </p>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                         class="w-5 h-5 dark:text-white {{ isActive($pricingRoutes,'menu-active') }}">
                        <path fill-rule="evenodd"
                              d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                              clip-rule="evenodd"/>
                    </svg>
                </div>

                <!-- Right Color when active -->
                <span
                    class="absolute h-7 bg-myBlue-100 rounded-md shadow-aside-active -right-9 {{ isActive($pricingRoutes,'w-2.5') }}"></span>
            </a>

            <!-- Pricing Request -->
            @php
                $pricingRequestRoutes = [
                    'inquiryPrice.index'
                ];
            @endphp
            <a href="{{ route('inquiryPrice.index') }}" class="aside-items">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor"
                         class="w-5 h-5 dark:text-white {{ isActive($pricingRequestRoutes,'menu-active') }}">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"></path>
                    </svg>
                    <p class="text-base mr-2.5 dark:text-white {{ isActive($pricingRequestRoutes,'menu-active') }}">
                        درخواست های بروزرسانی
                    </p>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                         class="w-5 h-5 dark:text-white {{ isActive($pricingRequestRoutes,'menu-active') }}">
                        <path fill-rule="evenodd"
                              d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                              clip-rule="evenodd"/>
                    </svg>
                </div>

                <!-- Right Color when active -->
                <span
                    class="absolute h-7 bg-myBlue-100 rounded-md shadow-aside-active -right-9 {{ isActive($pricingRequestRoutes,'w-2.5') }}"></span>
            </a>

            <!-- Pricing Request -->
            @php
                $calculateRoutes = [
                    'collectionCoil.index'
                ];
            @endphp
            <a href="{{ route('collectionCoil.index') }}" class="aside-items">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor"
                         class="w-5 h-5 dark:text-white {{ isActive($calculateRoutes,'menu-active') }}">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V13.5zm0 2.25h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V18zm2.498-6.75h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V13.5zm0 2.25h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V18zm2.504-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V18zm2.498-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zM8.25 6h7.5v2.25h-7.5V6zM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 002.25 2.25h10.5a2.25 2.25 0 002.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0012 2.25z"></path>
                    </svg>
                    <p class="text-base mr-2.5 dark:text-white {{ isActive($calculateRoutes,'menu-active') }}">
                        لیست محاسباتی ها
                    </p>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                         class="w-5 h-5 dark:text-white {{ isActive($calculateRoutes,'menu-active') }}">
                        <path fill-rule="evenodd"
                              d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                              clip-rule="evenodd"/>
                    </svg>
                </div>

                <!-- Right Color when active -->
                <span
                    class="absolute h-7 bg-myBlue-100 rounded-md shadow-aside-active -right-9 {{ isActive($calculateRoutes,'w-2.5') }}"></span>
            </a>

            <!-- Users -->
            @php
                $userRoutes = [
                    'users.index','users.create','users.edit'
                ];
            @endphp
            <a href="{{ route('users.index') }}" class="aside-items">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor"
                         class="w-5 h-5 dark:text-white {{ isActive($userRoutes,'menu-active') }}">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
                    </svg>
                    <p class="text-base mr-2.5 dark:text-white {{ isActive($userRoutes,'menu-active') }}">
                        کاربران
                    </p>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                         class="w-5 h-5 dark:text-white {{ isActive($userRoutes,'menu-active') }}">
                        <path fill-rule="evenodd"
                              d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                              clip-rule="evenodd"/>
                    </svg>
                </div>

                <!-- Right Color when active -->
                <span
                    class="absolute h-7 bg-myBlue-100 rounded-md shadow-aside-active -right-9 {{ isActive($userRoutes,'w-2.5') }}"></span>
            </a>

        </div>

        <!-- Logout -->
        <div class="bg-white dark:bg-slate-900 sticky bottom-0.5 p-4">
            <form class="flex h-full w-full items-center justify-center" method="post" action="{{ route('logout') }}">
                @csrf
                <button class="logout-aside-btn" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd"
                              d="M10 2a.75.75 0 01.75.75v7.5a.75.75 0 01-1.5 0v-7.5A.75.75 0 0110 2zM5.404 4.343a.75.75 0 010 1.06 6.5 6.5 0 109.192 0 .75.75 0 111.06-1.06 8 8 0 11-11.313 0 .75.75 0 011.06 0z"
                              clip-rule="evenodd"/>
                    </svg>
                    <span class="mr-2">
                    خروج از حساب کاربری
                </span>
                </button>
            </form>
        </div>

    </aside>
</div>
