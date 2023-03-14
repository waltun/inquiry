<x-layout>
    <!-- Breadcrumb -->
    <div class="flex items-center space-x-2 space-x-reverse">
        <a href="{{ route('dashboard') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0l4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0l-5.571 3-5.571-3"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    داشبورد
                </p>
            </div>
        </a>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                 class="breadcrumb-svg-arrow">
                <path fill-rule="evenodd"
                      d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                      clip-rule="evenodd"/>
            </svg>
        </div>
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg-active">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V13.5zm0 2.25h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V18zm2.498-6.75h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V13.5zm0 2.25h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V18zm2.504-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V18zm2.498-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zM8.25 6h7.5v2.25h-7.5V6zM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 002.25 2.25h10.5a2.25 2.25 0 002.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0012 2.25z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    محاسبه قیمت انواع دمپر
                </p>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="mt-4">
        <div class="grid grid-cols-4 gap-4">
            <a href="{{ route('separate.damper.taze',$taze->id) }}"
               class="block p-8 rounded-lg shadow-lg border border-gray-200 group hover:bg-indigo-700 hover:shadow-2xl hover:border-transparent">
                <div class="mb-4">
                    <img src="{{ asset('images/damper.png') }}" alt="" class="w-full mx-auto">
                </div>
                <div class="mb-8">
                    <p class="text-base font-bold text-black group-hover:text-white text-center">
                        {{ $taze->name }}
                    </p>
                </div>
                <div class="flex justify-center">
                    <button type="button" class="table-success-btn group-hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-4 h-4 ml-1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                        </svg>
                        محاسبه قیمت
                    </button>
                </div>
            </a>

            <a href="{{ route('separate.damper.raft',$raft->id) }}"
               class="block p-8 rounded-lg shadow-lg border border-gray-200 group hover:bg-indigo-700 hover:shadow-2xl hover:border-transparent">
                <div class="mb-4">
                    <img src="{{ asset('images/damper.png') }}" alt="" class="w-full mx-auto">
                </div>
                <div class="mb-8">
                    <p class="text-base font-bold text-black group-hover:text-white text-center">
                        {{ $raft->name }}
                    </p>
                </div>
                <div class="flex justify-center">
                    <button type="button" class="table-success-btn group-hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-4 h-4 ml-1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                        </svg>
                        محاسبه قیمت
                    </button>
                </div>
            </a>

            <a href="{{ route('separate.damper.bargasht',$bargasht->id) }}"
               class="block p-8 rounded-lg shadow-lg border border-gray-200 group hover:bg-indigo-700 hover:shadow-2xl hover:border-transparent">
                <div class="mb-4">
                    <img src="{{ asset('images/damper.png') }}" alt="" class="w-full mx-auto">
                </div>
                <div class="mb-8">
                    <p class="text-base font-bold text-black group-hover:text-white text-center">
                        {{ $bargasht->name }}
                    </p>
                </div>
                <div class="flex justify-center">
                    <button type="button" class="table-success-btn group-hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-4 h-4 ml-1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                        </svg>
                        محاسبه قیمت
                    </button>
                </div>
            </a>

            <a href="{{ route('separate.damper.exast',$exast->id) }}"
               class="block p-8 rounded-lg shadow-lg border border-gray-200 group hover:bg-indigo-700 hover:shadow-2xl hover:border-transparent">
                <div class="mb-4">
                    <img src="{{ asset('images/damper.png') }}" alt="" class="w-full mx-auto">
                </div>
                <div class="mb-8">
                    <p class="text-base font-bold text-black group-hover:text-white text-center">
                        {{ $exast->name }}
                    </p>
                </div>
                <div class="flex justify-center">
                    <button type="button" class="table-success-btn group-hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-4 h-4 ml-1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                        </svg>
                        محاسبه قیمت
                    </button>
                </div>
            </a>
        </div>
    </div>
</x-layout>
