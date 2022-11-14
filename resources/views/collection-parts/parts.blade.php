<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script>
            function deletePartFromCollectionPart(parentPart, child) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '/collection-parts/' + parentPart + '/' + child + '/' + 'destroy-part',
                    success: function () {
                        location.reload();
                    }
                });
            }
        </script>
        <script>
            function changeUnit1(event, part) {
                let value = event.target.value;
                let input2 = document.getElementById('inputUnit' + part.id);
                let inputValue = document.getElementById('inputUnitValue' + part.id);
                let operator1 = part.operator2;
                let formula1 = part.formula2;
                let result = 0;

                result = eval(value + operator1 + formula1);
                input2.value = Intl.NumberFormat().format(result);
                inputValue.value = Intl.NumberFormat().format(result);
            }

            function changeUnit2(event, part) {
                let value = event.target.value;
                let input1 = document.getElementById('inputValue' + part.id);
                let inputValue = document.getElementById('inputUnitValue' + part.id);
                let operator2 = part.operator1;
                let formula2 = part.formula1;
                let result = 0;

                result = eval(value + operator2 + formula2);
                input1.value = Intl.NumberFormat().format(result);
                inputValue.value = value;
            }
        </script>
        <script>
            function changePart(event, part) {
                let id = event.target.value;
                let section = document.getElementById('groupPartList' + part);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('inquiries.product.changePart') }}',
                    data: {
                        id: id,
                    },
                    success: function (res) {
                        let parts = res.data;
                        section.innerHTML = `
                            <select class="input-text" onchange="changePart(event,${part})" id="inputCategory${part}">
                                    ${
                            parts.map(function (part) {
                                return `<option value="${part.id}">${part.name}</option>`
                            })
                        }
                            </select>`
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
                        لیست قطعات مجموعه {{ $parentPart->name }}
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Navigation Btn -->
    <div class="mt-4 md:flex justify-between items-center md:space-x-4 space-x-reverse">
        <div class="mb-4 md:mb-0">
            <p class="text-lg font-bold text-black">
                لیست قطعات مجموعه <span class="text-red-600">{{ $parentPart->name }}</span>
            </p>
        </div>
        <div class="space-x-2 space-x-reverse">
            <a href="{{ route('collections.index') }}" class="form-detail-btn text-xs">لیست مجموعه ها</a>
            <a href="{{ route('collections.create',$parentPart->id) }}" class="form-submit-btn text-xs">
                افزودن قطعه
            </a>
        </div>
    </div>

    <!-- Content -->
    <div class="mt-4">
        <!-- Laptop List -->
        <form method="POST" action="{{ route('collections.changeParts',$parentPart->id) }}">
            @csrf

            <div class="bg-white shadow overflow-x-auto rounded-lg hidden md:block">
                <table class="min-w-full">
                    <thead>
                    <tr class="bg-sky-200">
                        <th scope="col"
                            class="px-4 py-3 text-sm font-bold text-gray-800 text-center rounded-r-md">
                            #
                        </th>
                        <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                            دسته بندی
                        </th>
                        <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                            نام
                        </th>
                        <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                            واحد
                        </th>
                        <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                            مقادیر
                        </th>
                        <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                            قیمت
                        </th>
                        <th scope="col" class="relative px-4 py-3 rounded-l-md">
                            <span class="sr-only">اقدامات</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($parentPart->children as $child)
                        @php
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

                            if ($child->price_updated_at < $lastTime && $child->price > 0) {
                                $color = 'bg-red-500';
                            }
                            if ($child->price_updated_at > $lastTime && $child->price_updated_at > $midTime && $child->price > 0) {
                                $color = 'bg-green-500';
                            }
                            if ($child->price_updated_at > $lastTime && $child->price_updated_at < $midTime && $child->price > 0) {
                                $color = 'bg-yellow-500';
                            }
                            if ($child->price_updated_at < $lastTime && $child->price == 0) {
                                $color = 'bg-red-600';
                            }

                            $category = $child->categories[1];
                            $selectedCategory = $child->categories[2];
                        @endphp
                        <tr>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <p class="text-sm text-gray-500 text-center">{{ $loop->index + 1 }}</p>
                            </td>
                            <td class="px-4 py-3">
                                <select name="" id="inputCategory{{ $child->id }}" class="input-text"
                                        onchange="changePart(event,{{ $child->id }})">
                                    @foreach($category->children as $child2)
                                        <option
                                            value="{{ $child2->id }}" {{ $child2->id == $selectedCategory->id ? 'selected' : '' }}>
                                            {{ $child2->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                @php
                                    $selectedPart = \App\Models\Part::find($child->id);
                                    $lastCategory = $selectedPart->categories()->latest()->first();
                                    $categoryParts = $lastCategory->parts;
                                @endphp
                                <select name="part_ids[]" class="input-text" id="groupPartList{{ $child->id }}"
                                        onchange="showCalculateButton('{{ $child->id }}')">
                                    @foreach($categoryParts as $part2)
                                        <option
                                            value="{{ $part2->id }}" {{ $part2->id == $child->id ? 'selected' : '' }}>
                                            {{ $part2->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <p class="text-sm text-black text-center">
                                    {{ $child->unit }}
                                    @if(!is_null($child->unit2))
                                        / {{ $child->unit2 }}
                                    @endif
                                </p>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <input type="text" name="values[]" id="inputValue{{ $child->id }}"
                                       class="input-text w-20 text-center" onkeyup="changeUnit1(event,{{ $child }})"
                                       value="{{ $child->pivot->value ?? '' }}">
                                @if(!is_null($child->unit2))
                                    <input type="text" id="inputUnit{{ $child->id }}"
                                           class="input-text w-20 text-center" onkeyup="changeUnit2(event,{{ $child }})"
                                           placeholder="{{ $child->unit2 }}" value="{{ $child->pivot->value2 }}">
                                @endif
                                <input type="hidden" name="units[]" id="inputUnitValue{{ $child->id }}"
                                       value="{{ $child->pivot->value2 }}">
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap {{ $color ?? '' }}">
                                @if($child->price)
                                    <p class="text-sm text-black font-medium text-center {{ $color ? 'text-white' : 'text-red-600' }}">
                                        {{ number_format($child->price) }} تومان
                                    </p>
                                @else
                                    <p class="text-sm font-medium text-center {{ $color ? 'text-white' : 'text-red-600' }}">
                                        منتظر قیمت گذاری
                                    </p>
                                @endif
                            </td>
                            <td class="px-4 py-3 space-x-3 space-x-reverse">
                                <button class="form-cancel-btn text-xs" type="button"
                                        onclick="deletePartFromCollectionPart({{ $parentPart->id }},{{ $child->id }})">
                                    حذف از مجموعه
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="my-4">
                <button type="submit" class="form-submit-btn">
                    ثبت مقادیر
                </button>
            </div>

        </form>

        <!-- Mobile List -->
        <div class="block md:hidden">
            @foreach($parentPart->children as $childPart)
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

                        @if($childPart->price)
                            <p class="text-xs text-black font-medium text-center">
                                قیمت : {{ number_format($childPart->price) }} تومان
                            </p>
                        @else
                            <p class="text-xs text-red-600 font-medium text-center">
                                منتظر قیمت گذاری
                            </p>
                        @endif

                        @php
                            $code = '';
                            foreach($childPart->categories as $category){
                                $code = $code . $category->code;
                            }
                        @endphp
                        <p class="text-xs text-black text-center">
                            کد : {{ $childPart->code . "-" . $code }}
                        </p>
                        <div class="flex w-full justify-center">
                            <form action="{{ route('collections.destroy',[$parentPart->id,$childPart->id]) }}"
                                  method="POST"
                                  class="inline">
                                @csrf
                                @method('DELETE')

                                <button class="form-cancel-btn text-xs"
                                        onclick="return confirm('قطعه از مجموعه حذف شود ؟')">
                                    حذف از مجموعه {{ $parentPart->name }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
