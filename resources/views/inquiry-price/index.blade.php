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
        <script>
            function updateDate(id) {
                let url = window.location.href;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    method: 'PATCH',
                    url: '/inquiry-price/' + id + '/update-date',
                    data: {
                        id: id,
                    },
                    success: function (res) {
                        if (res.data === 'error') {
                            alert('قیمت برای این قطعه ثبت نشده است!')
                        } else {
                            location.href = url;
                        }
                    }
                });
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
        @php
            $color = '';
            $time = null;
        @endphp
        @foreach($inquiryPrices as $inquiryPrice)
            @php
                $inquiry = \App\Models\Inquiry::find($inquiryPrice->inquiry_id);
                $part = \App\Models\Part::find($inquiryPrice->part_id);
                $user = \App\Models\User::find($inquiryPrice->user_id);
                $parts = \App\Models\InquiryPrice::select('part_id')->where('inquiry_id',$inquiry->id)->get()->unique('part_id');
            @endphp
            <div class="bg-white rounded-md p-4 shadow border border-gray-200 mb-8">
                <div class="flex items-center justify-between border-b border-gray-200 pb-3">
                    <p class="text-sm font-bold text-black">
                        درخواست های استعلام {{ $inquiry->name }} - INQ-{{ $inquiry->inquiry_number }}
                    </p>
                    <p class="text-sm font-bold text-indigo-700">
                        تاریخ ارسال درخواست : {{ jdate($inquiryPrice->created_at)->format('%A, %d %B %Y - H:m') }}
                    </p>
                    <p class="text-sm font-bold text-red-600">
                        کاربر درخواست کننده : {{ $user->name }}
                    </p>
                </div>
                <form action="{{ route('inquiryPrice.update',$inquiry->id) }}" method="POST"
                      class="mt-4 overflow-x-auto">
                    @csrf
                    @method('PATCH')
                    <table class="min-w-full bg-white shadow">
                        <thead>
                        <tr class="bg-sky-200">
                            <th scope="col"
                                class="px-4 py-3 text-sm font-bold text-gray-800 text-center rounded-r-md">
                                ردیف
                            </th>
                            <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                                نام
                            </th>
                            <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                                واحد
                            </th>
                            <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                                قیمت قبلی
                            </th>
                            <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                                قیمت (تومان)
                            </th>
                            <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                                آخرین بروزرسانی
                            </th>
                            <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                                <span class="sr-only">بروزرسانی تاریخ</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300">
                        @foreach($parts as $item)
                            @php
                                $part = \App\Models\Part::find($item->part_id);
                            @endphp
                            <tr>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <p class="text-sm text-gray-500 text-center">{{ $loop->index + 1 }}</p>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <p class="text-sm text-black text-center font-medium">{{ $part->name }}</p>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <p class="text-sm text-black text-center font-medium">{{ $part->unit }}</p>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    @if($part->old_price > 0)
                                        <p class="text-sm text-black text-center font-medium">
                                            {{ number_format($part->old_price) }} تومان
                                        </p>
                                    @else
                                        <p class="text-sm text-black text-center font-medium">
                                            قیمت قبلی ثبت نشده!
                                        </p>
                                    @endif
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <input type="text" class="input-text w-44 py-0.5" id="inputPrice{{ $part->id }}"
                                           name="prices[]"
                                           value="{{ $part->price ?? '' }}" onkeyup="showPrice({{ $part->id }})">
                                    <span class="text-sm text-black text-center font-medium"
                                          id="priceSection{{ $part->id }}">
                                        {{ number_format($part->price) ?? '0' }} تومان
                                    </span>
                                    <input type="hidden" name="parts[]" value="{{ $part->id }}">
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <p class="text-sm text-black text-center">
                                        {{ jdate($part->price_updated_at)->format('%A, %d %B %Y') }}
                                    </p>
                                </td>
                                <td class="px-4 py-1 whitespace-nowrap">
                                    <button type="button" class="form-detail-btn text-xs"
                                            onclick="updateDate({{ $part->id }})">
                                        بروزرسانی تاریخ
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        <button type="submit" class="form-submit-btn">
                            ثبت قیمت
                        </button>
                    </div>
                </form>
            </div>
        @endforeach
    </div>
</x-layout>
