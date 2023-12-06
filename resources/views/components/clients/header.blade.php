<header class="p-4 bg-myBlue-100">
    <div class="flex items-center justify-between">
        <div class="flex items-center md:space-x-4 space-x-reverse">
            <img src="{{ asset('images/azarbad.png') }}" alt="" class="md:w-24 w-20">
            <p class="md:text-xl text-sm font-medium text-white">
                پنل مشتریان شرکت تهویه آذرباد
            </p>
        </div>
        <div class="flex items-center md:space-x-2 space-x-1 space-x-reverse">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="md:w-10 md:h-10 w-6 h-6 text-white">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <p class="md:text-sm text-xs font-medium text-white">
                {{ auth()->user()->name }} خوش آمدید
            </p>
        </div>
    </div>
</header>
