<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script>
            function deletePartFromModell(modell, part) {
                if (confirm('قطعه حذف شود ؟')) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'DELETE',
                        url: '/models/' + modell + '/' + part + '/' + 'destroy-part',
                        success: function () {
                            location.reload();
                        }
                    });
                }
            }
        </script>
        <script>
            function changeUnit1(event, part) {
                let value = event.target.value;
                let input2 = document.getElementById('partUnit' + part.id);
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
                let input1 = document.getElementById('partValue' + part.id);
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
            function searchParts(event) {
                let value = event.target.value;
                let currentUrl = '{{ url()->current() }}';
                let url = new URL(currentUrl);

                if (value == 'sort') {
                    url.searchParams.append('sort_type', 'sort');
                }
                if (value == 'name') {
                    url.searchParams.append('sort_type', 'name');
                }
                if (value == 'unit') {
                    url.searchParams.append('sort_type', 'unit');
                }
                if (value == 'price') {
                    url.searchParams.append('sort_type', 'price');
                }

                window.location.href = url.href;
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
                    <a href="{{ route('groups.index') }}"
                       class="mr-2 text-xs md:text-sm font-medium text-gray-500 hover:text-gray-900">
                        مدیریت گروه ها
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
                        لیست قطعات مدل {{ $modell->name }}
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Navigation Btn -->
    <div class="mt-4 md:flex justify-between items-center">
        <div class="mb-4 md:mb-0">
            <p class="text-lg font-bold text-black">
                لیست قطعات مدل <span class="text-red-600">{{ $modell->name }}</span>
            </p>
        </div>
        <div class="flex items-center space-x-2 space-x-reverse">
            <p class="text-xs text-black font-medium">
                مرتب سازی بر اساس :
            </p>
            <select name="sort_type" id="inputSort" class="input-text w-24 py-1" onchange="searchParts(event)">
                <option value="sort" {{ request('sort_type') == 'sort' ? 'selected' : '' }}>
                    ردیف
                </option>
                <option value="name" {{ request('sort_type') == 'name' ? 'selected' : '' }}>
                    نام
                </option>
                <option value="unit" {{ request('sort_type') == 'unit' ? 'selected' : '' }}>
                    واحد
                </option>
                <option value="price" {{ request('sort_type') == 'price' ? 'selected' : '' }}>
                    قیمت
                </option>
            </select>
            <form action="" method="get">
                <div class="flex rounded-md shadow-sm">
                    <input type="text" name="search" id="inputSearch" class="input-text rounded-none rounded-r-md"
                           placeholder="مثال : پیچ" value="{{ request('search') }}">
                    <button type="submit"
                            class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-sm text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
        <div class="space-x-2 space-x-reverse flex items-center">
            <a href="{{ route('modells.parts.index',$modell->id) }}" class="form-submit-btn text-xs">
                افزودن قطعه
            </a>
        </div>
    </div>

    <!-- Content -->
    <div class="mt-4">
        <!-- Laptop List -->
        <form method="POST" action="{{ route('modells.partValues',$modell->id) }}"
              class="hidden md:block">
            @csrf
            <div class="bg-white shadow overflow-x-auto rounded-lg">
                <table class="min-w-full">
                    <thead>
                    <tr class="bg-sky-200">
                        <th scope="col"
                            class="px-4 py-2 text-sm font-bold text-gray-800 text-center rounded-r-md">
                            ردیف
                        </th>
                        <th scope="col" class="px-4 py-2 text-sm font-bold text-gray-800 text-center">
                            دسته بندی
                        </th>
                        <th scope="col" class="px-4 py-2 text-sm font-bold text-gray-800 text-center">
                            نام
                        </th>
                        <th scope="col" class="px-4 py-2 text-sm font-bold text-gray-800 text-center">
                            واحد
                        </th>
                        <th scope="col" class="px-4 py-2-sm font-bold text-gray-800 text-center">
                            مقدار
                        </th>
                        <th scope="col" class="px-4 py-2 text-sm font-bold text-gray-800 text-center">
                            قیمت
                        </th>
                        <th scope="col" class="px-4 py-2 text-sm font-bold text-gray-800 text-center">
                            قیمت کل
                        </th>
                        <th scope="col" class="relative px-4 py-2 rounded-l-md">
                            <span class="sr-only">اقدامات</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $totalWeight = 0;
                        $totalPrice = 0;
                    @endphp
                    @foreach($parts as $part)
                        @php
                            $category = $part->categories[1];
                            $selectedCategory = $part->categories[2];

                            $totalWeight += $part->weight * $part->pivot->value;
                            $totalPrice += $part->price * $part->pivot->value;
                        @endphp
                        <tr>
                            <td class="px-4 py-0.5 whitespace-nowrap">
                                <input type="text" class="input-text w-14 text-center" name="sorts[]"
                                       id="partSort{{ $part->id }}"
                                       value="{{ $part->pivot->sort }}">
                            </td>
                            <td class="px-4 py-0.5">
                                <select id="inputCategory{{ $part->id }}" class="input-text"
                                        onchange="changePart(event,{{ $part->id }})">
                                    @foreach($category->children as $child)
                                        <option
                                            value="{{ $child->id }}" {{ $child->id == $selectedCategory->id ? 'selected' : '' }}>
                                            {{ $child->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-4 py-0.5 whitespace-nowrap">
                                @php
                                    $selectedPart = \App\Models\Part::find($part->id);
                                    $lastCategory = $selectedPart->categories()->latest()->first();
                                    $categoryParts = $lastCategory->parts;
                                @endphp
                                <select name="part_ids[]" class="input-text" id="groupPartList{{ $part->id }}">
                                    @foreach($categoryParts as $part2)
                                        <option
                                            value="{{ $part2->id }}" {{ $part2->id == $part->id ? 'selected' : '' }}>
                                            {{ $part2->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-4 py-0.5 whitespace-nowrap">
                                <p class="text-sm text-black text-center">
                                    {{ $part->unit }}
                                    @if(!is_null($part->unit2))
                                        / {{ $part->unit2 }}
                                    @endif
                                </p>
                            </td>
                            <td class="px-4 py-0.5 whitespace-nowrap">
                                <input type="text" class="input-text w-20 text-center" name="values[]"
                                       id="partValue{{ $part->id }}" onkeyup="changeUnit1(event,{{ $part }})"
                                       value="{{ $part->pivot->value }}">
                                @if(!is_null($part->unit2))
                                    <input type="text" class="input-text w-20 text-center" id="partUnit{{ $part->id }}"
                                           placeholder="{{ $part->unit2 }}" onkeyup="changeUnit2(event,{{ $part }})"
                                           value="{{ $part->pivot->value2 }}">
                                @endif
                                <input type="hidden" name="units[]" id="inputUnitValue{{ $part->id }}"
                                       value="{{ $part->pivot->value2 }}">
                            </td>
                            <td class="px-4 py-0.5 whitespace-nowrap">
                                @if($part->price)
                                    <p class="text-sm text-black text-center font-medium">
                                        {{ number_format($part->price) }}
                                    </p>
                                @else
                                    <p class="text-sm text-red-600 text-center font-medium">
                                        منتظر قیمت گذاری
                                    </p>
                                @endif
                            </td>
                            <td class="px-4 py-0.5 whitespace-nowrap">
                                <p class="text-sm text-black text-center font-medium">
                                    {{ number_format($part->price * $part->pivot->value) }}
                                </p>
                            </td>
                            <td class="px-4 py-0.5 space-x-3 space-x-reverse">
                                <button onclick="deletePartFromModell({{ $modell->id }},{{ $part->id }})" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="p-4 pt-0 flex justify-between items-center">
                    <div>
                        <a href="{{ route('modells.parts.index',$modell->id) }}"
                           class="w-8 h-8 rounded-full bg-green-500 block grid place-content-center mr-2"
                           title="افزودن قطعه جدید">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="2" stroke="currentColor" class="w-6 h-6 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 4.5v15m7.5-7.5h-15"/>
                            </svg>
                        </a>
                    </div>
                    <div class="space-y-2">
                        <p class="text-sm bg-green-500 px-4 py-1 rounded-md font-bold text-white">
                            قیمت کل : {{ number_format($totalPrice) }} تومان
                        </p>
                        <p class="text-sm bg-gray-500 px-4 py-1 rounded-md font-bold text-white">
                            وزن : {{ $totalWeight }} کیلوگرم
                        </p>
                    </div>
                </div>
            </div>
            <div class="my-4">
                <button type="submit" class="form-submit-btn">
                    ثبت مقادیر
                </button>
            </div>
        </form>

        <!-- Mobile List -->
        <form method="POST" action="{{ route('modells.partValues',$modell->id) }}"
              class="block md:hidden">
            @csrf
            <div>
                @foreach($modell->parts as $part)
                    <div class="bg-white rounded-md p-4 border border-gray-200 shadow-md mb-4 relative z-30">
                <span
                    class="absolute right-2 top-2 p-2 w-6 h-6 rounded-full bg-indigo-300 text-black text-xs grid place-content-center font-bold">
                    {{ $loop->index+1 }}
                </span>
                        <div class="space-y-4">
                            <p class="text-xs text-black text-center font-bold">
                                {{ $part->name }}
                            </p>
                            <p class="text-xs text-black text-center">
                                واحد : {{ $part->unit }}
                            </p>
                            @if($part->price)
                                <p class="text-xs text-black text-center font-medium">
                                    قیمت : {{ number_format($part->price) }} تومان
                                </p>
                            @else
                                <p class="text-xs text-red-600 text-center font-medium">
                                    منتظر قیمت گذاری
                                </p>
                            @endif
                            <p class="text-xs text-black text-center">
                                کد : {{ $part->code }}
                            </p>
                            <div>
                                <input type="text" class="input-text" name="values[]" id="partValue{{ $part->id }}"
                                       value="{{ $part->pivot->value }}">
                            </div>
                            <div class="flex w-full justify-center">
                                <button class="form-cancel-btn text-xs"
                                        onclick="deletePartFromModell({{ $modell->id }},{{ $part->id }})">
                                    حذف از مدل {{ $modell->name }}
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="my-4">
                <button type="submit" class="form-submit-btn">
                    ثبت مقادیر
                </button>
            </div>
        </form>
    </div>
</x-layout>
