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
                let result;

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
                let result;

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
        <a href="{{ route('groups.index') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="breadcrumb-svg" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    مدیریت محصولات
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
            <svg xmlns="http://www.w3.org/2000/svg" class="breadcrumb-svg-active" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    قطعات مدل {{ $modell->name }}
                </p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="flex items-center justify-between mt-8">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 dark:text-white" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <div class="mr-2">
                <p class="font-bold text-2xl text-black dark:text-white">
                    لیست قطعات مدل {{ $modell->name }}
                </p>
            </div>
        </div>
        <div class="flex items-center space-x-4 space-x-reverse">
            <a href="{{ route('modells.parts.index',$modell->id) }}" class="page-success-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                <span class="mr-2">افزودن قطعه جدید</span>
            </a>
        </div>
    </div>

    <!-- Content -->
    <div class="mt-4 space-y-4">
        <form method="POST" action="{{ route('modells.partValues',$modell->id) }}">
            @csrf
            <div class="mt-8 overflow-x-auto rounded-lg">
                <table class="w-full border-collapse">
                    <thead>
                    <tr class="table-th-tr">
                        <th scope="col" class="p-4 rounded-tr-lg">
                            ردیف
                        </th>
                        <th scope="col" class="p-4">
                            دسته بندی
                        </th>
                        <th scope="col" class="p-4">
                            نام
                        </th>
                        <th scope="col" class="p-4">
                            واحد
                        </th>
                        <th scope="col" class="p-4">
                            مقدار
                        </th>
                        <th scope="col" class="p-4">
                            قیمت (تومان)
                        </th>
                        <th scope="col" class="p-4">
                            قیمت کل (تومان)
                        </th>
                        <th scope="col" class="p-4 rounded-tl-lg">
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
                        <tr class="table-tb-tr group {{ $loop->even ? 'bg-sky-100' : '' }}">
                            <td class="table-tr-td border-t-0 border-l-0">
                                <input type="text" class="input-text w-14 text-center" name="sorts[]"
                                       id="partSort{{ $part->id }}"
                                       value="{{ $part->pivot->sort }}">
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                <select id="inputCategory{{ $part->id }}" class="input-text w-24"
                                        onchange="changePart(event,{{ $part->id }})">
                                    @foreach($category->children as $child)
                                        <option
                                            value="{{ $child->id }}" {{ $child->id == $selectedCategory->id ? 'selected' : '' }}>
                                            {{ $child->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
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
                            <td class="table-tr-td border-t-0 border-x-0">
                                {{ $part->unit }}
                                @if(!is_null($part->unit2))
                                    / {{ $part->unit2 }}
                                @endif
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
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
                            <td class="table-tr-td border-t-0 border-x-0">
                                @if($part->price)
                                    {{ number_format($part->price) }}
                                @else
                                    منتظر قیمت گذاری
                                @endif
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                {{ number_format($part->price * $part->pivot->value) }}
                            </td>
                            <td class="table-tr-td border-t-0 border-r-0">
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
                    <tr class="table-tb-tr group">
                        <td class="table-tr-td border-t-0" colspan="8">
                            <div class="flex justify-between items-center">
                                <a href="{{ route('modells.parts.index',$modell->id) }}"
                                   class="w-8 h-8 rounded-full bg-green-500 block grid place-content-center mr-6"
                                   title="افزودن قطعه جدید">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="2"
                                         stroke="currentColor" class="w-6 h-6 text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M12 4.5v15m7.5-7.5h-15"></path>
                                    </svg>
                                </a>
                                <div class="flex items-center space-x-4 space-x-reverse">
                                    <p class="table-price-label">
                                        قیمت کل : {{ number_format($totalPrice) }} تومان
                                    </p>
                                    <p class="table-weight-label">
                                        وزن دستگاه : {{ number_format($totalWeight) }} کیلوگرم
                                    </p>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="my-4 sticky bottom-4">
                <button type="submit" class="form-submit-btn">
                    ثبت مقادیر
                </button>
            </div>
        </form>
    </div>
</x-layout>
