<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
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
                        part: part
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
        <script>
            function changeUnit1(event, part) {
                let value = event.target.value;
                let input2 = document.getElementById('inputUnit' + part.id);
                let inputValue = document.getElementById('inputUnitValue' + part.id);
                let operator1 = part.operator2;
                let formula1 = part.formula2;
                let result = 0;

                result = eval(value + operator1 + formula1);
                let formatResult = Intl.NumberFormat().format(result);
                input2.value = formatResult.replace(',', '');
                inputValue.value = result;
            }

            function changeUnit2(event, part) {
                let value = event.target.value;
                let input1 = document.getElementById('inputValue' + part.id);
                let inputValue = document.getElementById('inputUnitValue' + part.id);
                let operator2 = part.operator1;
                let formula2 = part.formula1;
                let result = 0;

                result = eval(value + operator2 + formula2);
                let formatResult = Intl.NumberFormat().format(result);
                input1.value = formatResult.replace(',', '');
                inputValue.value = value;
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
                    <th class="border border-gray-300 p-4 text-sm">ردیف</th>
                    <th class="border border-gray-300 p-4 text-sm">دسته بندی</th>
                    <th class="border border-gray-300 p-4 text-sm">نام قطعه</th>
                    <th class="border border-gray-300 p-4 text-sm">واحد قطعه</th>
                    <th class="border border-gray-300 p-4 text-sm">مقادیر</th>
                    <th class="border border-gray-300 p-4 text-sm">قیمت</th>
                </tr>
                </thead>
                <tbody>
                @foreach($parentPart->children()->orderBy('sort','ASC')->get() as $childPart)
                    @php
                        $category = $childPart->categories[1];
                        $selectedCategory = $childPart->categories[2];
                    @endphp
                    <tr>
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            <input type="text" class="input-text w-14 text-center" name="sorts[]"
                                   id="partSort{{ $childPart->id }}"
                                   value="{{ $childPart->pivot->sort == 0 ||  $childPart->pivot->sort == null ? $loop->index+1 : $childPart->pivot->sort }}">
                        </td>
                        <td class="border border-gray-300 px-4 py-1">
                            <select name="" id="inputCategory{{ $childPart->id }}" class="input-text"
                                    onchange="changePart(event,{{ $childPart->id }})">
                                @foreach($category->children as $child2)
                                    <option
                                        value="{{ $child2->id }}" {{ $child2->id == $selectedCategory->id ? 'selected' : '' }}>
                                        {{ $child2->name }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            @php
                                $selectedPart = \App\Models\Part::find($childPart->id);
                                $lastCategory = $selectedPart->categories()->latest()->first();
                                $categoryParts = $lastCategory->parts;
                            @endphp
                            <select name="part_ids[]" class="input-text" id="groupPartList{{ $childPart->id }}">
                                @foreach($categoryParts as $part2)
                                    <option
                                        value="{{ $part2->id }}" {{ $part2->id == $childPart->id ? 'selected' : '' }}>
                                        {{ $part2->name }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center whitespace-nowrap">
                            <input type="text" name="values[]" id="inputValue{{ $childPart->id }}"
                                   class="input-text w-20 text-center" onkeyup="changeUnit1(event,{{ $childPart }})"
                                   value="{{ $childPart->pivot->value ?? '' }}">
                            @if(!is_null($childPart->unit2))
                                /
                                <input type="text" id="inputUnit{{ $childPart->id }}"
                                       class="input-text w-20 text-center" onkeyup="changeUnit2(event,{{ $childPart }})"
                                       placeholder="{{ $childPart->unit2 }}" value="{{ $childPart->pivot->value2 }}">
                            @endif
                            <input type="hidden" name="units[]" id="inputUnitValue{{ $childPart->id }}"
                                   value="{{ $childPart->pivot->value2 }}">
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                            <input type="text" name="values[]" id="inputValue{{ $childPart->id }}" class="input-text"
                                   value="{{ $childPart->pivot->value ?? '' }}">
                        </td>
                        <td class="border border-gray-300 px-4 py-1 whitespace-nowrap">
                            @if($childPart->price)
                                <p class="text-sm text-black font-medium text-center">
                                    {{ number_format($childPart->price) }} تومان
                                </p>
                            @else
                                <p class="text-sm font-medium text-center">
                                    منتظر قیمت گذاری
                                </p>
                            @endif
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
