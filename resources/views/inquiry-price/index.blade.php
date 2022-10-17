<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script>
            function showPrice(id) {
                let input = document.getElementById("inputPrice" + id);
                let section = document.getElementById("priceSection" + id);
                section.innerText = new Intl.NumberFormat().format(input.value) + ' تومان ';
            }
        </script>
    </x-slot>

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
                        درخواست های بروزرسانی قیمت
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Navigation Btn -->
    <div class="md:flex justify-between items-center mt-4">
        <div class="mb-4 md:mb-0">
            <p class="text-lg font-bold">لیست درخواست های بروزرسانی قیمت</p>
        </div>
        <div class="flex md:justify-end space-x-2 space-x-reverse">
            <a href="{{ route('parts.price.index') }}" class="form-detail-btn text-xs">بخش قیمت گذاری</a>
        </div>
    </div>

    <!-- Content -->
    <div class="mt-4">
        @foreach($inquiryPrices as $inquiryPrice)
            @php
                $part = \App\Models\Part::find($inquiryPrice->part_id);
                $inquiry = \App\Models\Inquiry::find($inquiryPrice->inquiry_id);
                $user = \App\Models\User::find($inquiryPrice->user_id);
            @endphp
            <div class="bg-white rounded-md p-4 shadow border border-gray-200 mb-4">
                <div class="flex items-center justify-between">
                    <p class="text-base font-bold text-black">
                        درخواست های استعلام {{ $inquiry->name }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</x-layout>
