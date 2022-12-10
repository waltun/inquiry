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
            <li>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                              clip-rule="evenodd"/>
                    </svg>
                    <a href="{{ route('collections.index') }}"
                       class="mr-2 text-xs md:text-sm font-medium text-gray-500 hover:text-gray-900">
                        مدیریت مجموعه ها
                    </a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                              clip-rule="evenodd"/>
                    </svg>
                    <span class="mr-2 text-xs md:text-sm font-medium text-gray-400">
                        تعیین مقادیر مجموعه {{ $parentPart->name }}
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Navigation Btn -->
    <div class="mt-4 md:flex justify-between items-center">
        <div class="mb-4 md:mb-0">
            <p class="md:text-lg text-sm font-bold text-black">
                مقادیر مجموعه {{ $parentPart->name }}
            </p>
        </div>
        <div>
            <a href="{{ route('collections.index') }}" class="form-detail-btn text-xs">لیست مجموعه ها</a>
        </div>
    </div>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <!-- Laptop List -->
    <form method="POST" action="{{ route('collections.storeAmounts',$parentPart->id) }}" class="mt-4 hidden md:block">
        @csrf
        @method('PATCH')
        <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4">
            <table class="border-collapse border border-gray-400 w-full">
                <thead>
                <tr>
                    <th class="border border-gray-300 p-4 text-sm">کد قطعه</th>
                    <th class="border border-gray-300 p-4 text-sm">نام قطعه</th>
                    <th class="border border-gray-300 p-4 text-sm">واحد قطعه</th>
                    <th class="border border-gray-300 p-4 text-sm">مقادیر</th>
                </tr>
                </thead>
                <tbody>
                @foreach($parentPart->children()->orderBy('sort','ASC')->get() as $childPart)
                    @php
                        $code = '';
                        foreach($childPart->categories as $category){
                            $code = $code . $category->code;
                        }

                        if ($setting) {
                            if($setting->price_color_type == 'month') {
                                $lastTime = \Carbon\Carbon::now()->subMonth($setting->price_color_last_time);
                                $midTime = \Carbon\Carbon::now()->subMonth($setting->price_color_mid_time);
                            }
                            if($setting->price_color_type == 'day') {
                                $lastTime = \Carbon\Carbon::now()->subDay($setting->price_color_last_time);
                                $midTime = \Carbon\Carbon::now()->subDay($setting->price_color_mid_time);
                            }
                            if($setting->price_color_type == 'hour') {
                                $lastTime = \Carbon\Carbon::now()->subHour($setting->price_color_last_time);
                                $midTime = \Carbon\Carbon::now()->subHour($setting->price_color_mid_time);
                            }
                        }

                        if ($childPart->updated_at < $lastTime && $childPart->price > 0) {
                            $color = 'bg-red-500';
                        }
                        if ($childPart->updated_at > $lastTime && $childPart->updated_at < $midTime && $childPart->price > 0) {
                            $color = 'bg-yellow-500';
                        }
                        if ($childPart->updated_at < $lastTime && $childPart->price == 0) {
                            $color = 'bg-red-600';
                        }
                    @endphp
                    <tr class="{{ $color ?? 'bg-white' }}">
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            {{ $code . "-" . $childPart->code }}
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            {{ $childPart->name }}
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            {{ $childPart->unit }}
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                            <input type="text" name="values[]" id="inputValue{{ $childPart->id }}" class="input-text"
                                   value="{{ $childPart->pivot->value ?? '' }}">
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="space-x-2 space-x-reverse">
            <button type="submit" class="form-submit-btn">
                ثبت مقادیر
            </button>
            <a href="{{ route('collections.index') }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>

    <!-- Mobile List -->
    <form method="POST" action="{{ route('collections.storeAmounts',$parentPart->id) }}" class="mt-4 block md:hidden">
        @csrf
        @method('PATCH')
        <div class="md:hidden block">
            @foreach($parentPart->children as $childPart)
                @php
                    $code = '';
                    foreach($childPart->categories as $category){
                        $code = $code . $category->code;
                    }
                @endphp
                <div class="bg-white rounded-md p-4 border border-gray-200 shadow-md mb-4 relative z-30">
                    <span
                        class="absolute right-2 top-2 p-2 w-6 h-6 rounded-full bg-indigo-300 text-black text-xs grid place-content-center font-bold">
                            {{ $loop->index+1 }}
                    </span>
                    <div class="space-y-4">
                        <p class="text-xs text-black font-bold text-center">
                            {{ $childPart->name }}
                        </p>
                        <p class="text-xs text-black text-center">
                            واحد : {{ $childPart->unit }}
                        </p>
                        <p class="text-xs text-black text-center">
                            کد : {{ $childPart->code . "-" . $code }}
                        </p>
                        <input type="text" name="values[]" id="inputValue{{ $childPart->id }}" class="input-text"
                               value="{{ $childPart->pivot->value ?? '' }}">
                    </div>
                </div>
            @endforeach
        </div>
        <div class="space-x-2 space-x-reverse">
            <button type="submit" class="form-submit-btn">
                ثبت مقادیر
            </button>
            <a href="{{ route('collections.index') }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>
