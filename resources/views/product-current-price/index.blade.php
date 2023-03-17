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
                        مشاهده لیست قیمت لحظه ای محصولات استاندارد
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Navigation Btn -->
    <div class="mt-4 md:flex justify-between items-center md:mx-36">
        <div class="mb-4 md:mb-0">
            <p class="text-lg text-black font-bold">
                مشاهده لیست قیمت لحظه ای محصولات استاندارد
            </p>
        </div>

        <!-- Description -->
        <div x-data="{open:false}">
            <button type="button" class="form-submit-btn text-xs font-bold" @click="open=!open">
                مشاهده شرایط فروش
            </button>
            <div class="relative z-10" x-show="open" x-cloak>
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                <div class="fixed z-10 inset-0 overflow-y-auto">
                    <div
                        class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">
                        <div
                            class="relative bg-white rounded-lg text-right overflow-hidden shadow-xl transform transition-all sm:my-8 max-w-2xl">
                            <div class="bg-white p-4">
                                <div class="mt-3 text-center sm:mt-0 sm:text-right">
                                    <h3 class="text-lg font-medium text-gray-900 border-b border-gray-300 pb-3">
                                        مشاهده شرایط فروش
                                    </h3>
                                    <div class="mt-4 decimal-list">
                                        {!! \App\Models\CurrentPrice::first()->description !!}
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-100 px-4 py-2">
                                <button type="button" class="form-cancel-btn"
                                        @click="open = !open">
                                    انصراف
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Content -->
    <div class="mt-4 md:mx-36 space-y-4">
        <!-- Laptop List -->
        @foreach($modells->groupBy('group') as $groups => $modell)
            @php
                $group = json_decode($groups);
            @endphp
            <form method="POST" action="{{ route('products.currentPrice.store') }}"
                  class="p-4 border border-indigo-400 rounded-md">
                @csrf
                <div class="mb-4 bg-myBlue-300 rounded-lg p-2">
                    <p class="text-lg font-bold text-white text-center">
                        {{ $group->name }}
                    </p>
                </div>
                <div class="bg-white shadow overflow-x-auto rounded-lg">
                    <table class="min-w-full">
                        <thead>
                        <tr class="bg-green-100">
                            <th scope="col"
                                class="px-4 py-3 text-sm font-bold text-gray-800 text-center rounded-tr-md">
                                ردیف
                            </th>
                            <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                                نام محصول
                            </th>
                            @if(auth()->user()->role == 'admin')
                                <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                                    ضریب
                                </th>
                            @endif
                            <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                                قیمت (تومان)
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($modell as $model)
                            @php
                                $price = 0;
                                foreach ($model->parts as $part) {
                                    $price += $part->price * $part->pivot->value;
                                }

                                $finalPrice = $price * $model->percent;
                            @endphp
                            <tr class="hover:bg-gray-100 {{ $loop->index % 2 == 0 ? '' : 'bg-gray-200' }}">
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <p class="text-sm text-gray-500 text-center">
                                        {{ $loop->index + 1 }}
                                    </p>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <p class="text-sm text-black text-center font-medium">
                                        {{ $model->name }}
                                    </p>
                                    <input type="hidden" name="modells[]" value="{{ $model->id }}">
                                </td>
                                @if(auth()->user()->role == 'admin')
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <div class="flex justify-center">
                                            <input type="text" name="percents[]" id="inputPercent{{ $model->id }}"
                                                   class="input-text w-20 text-center" value="{{ $model->percent }}">
                                        </div>
                                    </td>
                                @endif
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <p class="text-sm text-black text-center font-medium">
                                        {{ number_format($finalPrice) }} تومان
                                    </p>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @if(auth()->user()->role == 'admin')
                    <div class="mt-4 flex items-center">
                        <button class="form-submit-btn">
                            ثبت ضریب
                        </button>
                    </div>
                @endif
            </form>
        @endforeach
    </div>
</x-layout>
