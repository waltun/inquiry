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
        <a href="{{ route('collectionCoil.index') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="breadcrumb-svg" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    مدیریت مجموعه‌های محاسبه ای
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
                      d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    تعیین مقادیر {{ $parentPart->name }}
                </p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="flex items-center justify-between mt-8">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-8 h-8 dark:text-white">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"/>
            </svg>
            <div class="mr-2">
                <p class="font-bold text-2xl text-black dark:text-white">
                    مقادیر مجموعه محاسبه ای {{ $parentPart->name }}
                </p>
            </div>
        </div>
        <div class="flex items-center space-x-4 space-x-reverse">
            <a href="{{ route('collectionCoil.index') }}" class="page-warning-btn">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
                </svg>
                <span class="mr-2">مجموعه های محاسبه ای</span>
            </a>
        </div>
    </div>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <form method="POST" action="{{ route('collections.storeAmounts',$parentPart->id) }}" class="mt-4 space-y-4">
        @csrf
        @method('PATCH')
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
                        نام قطعه
                    </th>
                    <th scope="col" class="p-4">
                        واحد قطعه
                    </th>
                    <th scope="col" class="p-4">
                        مقادیر
                    </th>
                    <th scope="col" class="p-4">
                        قیمت
                    </th>
                    <th scope="col" class="p-4 rounded-tl-lg">
                        قیمت کل
                    </th>
                </tr>
                </thead>
                <tbody>
                @php
                    $totalPrice = 0;
                    $totalWeight = 0;
                @endphp
                @foreach($parentPart->children()->orderBy('sort','ASC')->get() as $childPart)
                    @php
                        $category = $childPart->categories[1];
                        $selectedCategory = $childPart->categories[2];

                        $totalPrice += $childPart->price * $childPart->pivot->value;
                        $totalWeight += $childPart->weight * $childPart->pivot->value;
                    @endphp
                    <tr class="table-tb-tr group">
                        <td class="table-tr-td border-t-0 border-l-0">
                            <input type="text" class="input-text w-14 text-center" name="sorts[]"
                                   id="partSort{{ $childPart->id }}"
                                   value="{{ $childPart->pivot->sort == 0 ||  $childPart->pivot->sort == null ? $loop->index+1 : $childPart->pivot->sort }}">
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            <select name="" id="inputCategory{{ $childPart->id }}" class="input-text w-28"
                                    onchange="changePart(event,{{ $childPart->id }})">
                                @foreach($category->children as $child2)
                                    <option
                                        value="{{ $child2->id }}" {{ $child2->id == $selectedCategory->id ? 'selected' : '' }}>
                                        {{ $child2->name }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
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
                        <td class="table-tr-td border-t-0 border-x-0">
                            {{ $childPart->unit }}
                            @if(!is_null($childPart->unit2))
                                /
                                {{ $childPart->unit2 }}
                            @endif
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            <input type="text" name="values[]" id="inputValue{{ $childPart->id }}"
                                   class="input-text w-20 text-center" onkeyup="changeUnit1(event,{{ $childPart }})"
                                   value="{{ $childPart->pivot->value ?? '' }}">
                            @if(!is_null($childPart->unit2))
                                @php
                                    $string = $childPart->pivot->value . $childPart->operator2 . $childPart->formula2;
                                @endphp
                                /
                                <input type="text" id="inputUnit{{ $childPart->id }}"
                                       class="input-text w-20 text-center" onkeyup="changeUnit2(event,{{ $childPart }})"
                                       placeholder="{{ $childPart->unit2 }}" name="values2[]"
                                       value="{{ $childPart->pivot->value2 ?? number_format(eval("return " . $string . ';'), 2) }}">
                            @endif
                            <input type="hidden" name="units[]" id="inputUnitValue{{ $childPart->id }}"
                                   value="{{ $childPart->pivot->value2 }}">
                        </td>
                        <td class="table-tr-td border-t-0 border-x-0">
                            @if($childPart->price)
                                {{ number_format($childPart->price) }} تومان
                            @else
                                منتظر قیمت گذاری
                            @endif
                        </td>
                        <td class="table-tr-td border-t-0 border-r-0">
                            {{ number_format($childPart->price * $childPart->pivot->value) }} تومان
                        </td>
                    </tr>
                @endforeach
                <tr class="table-tb-tr group">
                    <td class="table-tr-td border-t-0" colspan="7">
                        <div class="flex items-center">
                            <input type="text" class="input-text text-center" value="{{ $parentPart->name }}" name="name">
                        </div>
                    </td>
                </tr>
                <tr class="table-tb-tr group">
                    <td class="table-tr-td border-t-0" colspan="7">
                        <div class="flex justify-end items-center space-x-4 space-x-reverse">
                            <p class="table-price-label">
                                قیمت کل : {{ number_format($totalPrice) }} تومان
                            </p>
                            <p class="table-weight-label">
                                وزن : {{ $totalWeight }} کیلوگرم
                            </p>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="flex justify-between items-center sticky bottom-4">
            <div class="flex items-center space-x-4 space-x-reverse">
                <button type="submit" class="form-submit-btn">
                    ثبت مقادیر
                </button>
                <a href="{{ route('collectionCoil.index') }}" class="form-cancel-btn">
                    انصراف
                </a>
            </div>
            <a href="{{ route('collections.print',$parentPart->id) }}"
               class="form-percent-btn inline-flex items-center"
               target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-5 h-5 ml-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z"/>
                </svg>
                پرینت
            </a>
        </div>
    </form>
</x-layout>
