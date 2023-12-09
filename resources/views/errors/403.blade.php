<x-layout>
    <!-- Breadcrumb -->
    <nav class="flex bg-gray-100 p-4 rounded-md overflow-x-auto whitespace-nowrap" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-2 space-x-reverse">
            <li class="inline-flex items-center">
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center text-xs md:text-sm text-gray-500 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20"
                         fill="currentColor">
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                    داشبورد
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                              clip-rule="evenodd"/>
                    </svg>
                    <span class="mr-2 text-xs md:text-sm font-medium text-gray-400">
                        عدم دسترسی
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="flex items-center justify-center mt-20">
        <div>
            <div class="mb-10 flex justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-24 h-24 text-red-500">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286zm0 13.036h.008v.008H12v-.008z"/>
                </svg>
            </div>
            <div class="mb-6">
                <p class="text-2xl font-bold text-black text-center">
                    عدم دسترسی به این صفحه !
                </p>
            </div>
            <div class="mb-10">
                <p class="text-gray-700 leading-6 text-center">
                    متاسفانه شما دسترسی های لازم برای این صفحه را ندارید.
                </p>
            </div>
            <div class="flex justify-center">
                @if(auth()->user()->role == 'client')
                    <a href="{{ route('clients.dashboard', auth()->user()->id) }}" class="form-detail-btn">
                        بازگشت به پنل مشتریان
                    </a>
                @else
                    <a href="{{ route('dashboard') }}" class="form-detail-btn">
                        بازگشت به داشبورد
                    </a>
                @endif
            </div>
        </div>
    </div>
</x-layout>
