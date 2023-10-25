<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script>
            function changePart(event, part, product) {
                let id = event.target.value;
                let section = document.getElementById('partList' + part);

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
                        part: part,
                        product: product
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
            function changeUnit1(event, cid) {

                let id = document.getElementById('partList' + cid).value;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('inquiries.product.getPart') }}',
                    data: {
                        id: id,
                    },
                    success: function (res) {
                        let part = res.data;
                        let value = event.target.value;
                        let input2 = document.getElementById('inputAmount2' + cid);
                        let inputValue = document.getElementById('inputUnitValue' + cid);
                        let operator1 = part.operator2;
                        let formula1 = part.formula2;
                        let result = 0;

                        result = eval(value + operator1 + formula1);
                        let formatResult = Intl.NumberFormat().format(result);
                        input2.value = formatResult.replace(',', '');
                        inputValue.value = result;
                    }
                });
            }

            function changeUnit2(event, cid) {

                let id = document.getElementById('partList' + cid).value;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('inquiries.product.getPart') }}',
                    data: {
                        id: id,
                    },
                    success: function (res) {
                        let part = res.data;
                        let value = event.target.value;
                        let input1 = document.getElementById('inputAmount' + cid);
                        let inputValue = document.getElementById('inputUnitValue' + cid);
                        let operator2 = part.operator1;
                        let formula2 = part.formula1;
                        let result = 0;

                        result = eval(value + operator2 + formula2);
                        let formatResult = Intl.NumberFormat().format(result);
                        input1.value = formatResult.replace(',', '');
                        inputValue.value = value;
                    }
                });
            }
        </script>
        <script>
            function deletePart(part_id, product_id) {
                if (confirm('قطعه حذف شود ؟')) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('contracts.parts.destroy') }}',
                        data: {
                            part_id: part_id,
                            product_id: product_id,
                        },
                        success: function (res) {
                            location.reload();
                        }
                    });
                }
            }
        </script>
    </x-slot>

    <!-- Breadcrumb -->
    <div class="flex items-center space-x-2 space-x-reverse whitespace-nowrap">
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
        <a href="{{ route('contracts.index') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    قراردادها
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
        <a href="{{ route('contracts.show', $contract->id) }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    مشاهده قرارداد {{ $contract->name }}
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
                      d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    قطعات محصولات قرارداد {{ $contract->name }}
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
                      d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <div class="mr-2">
                <p class="font-bold text-2xl text-black dark:text-white">
                    قطعات محصولات قرارداد {{ $contract->name }}
                </p>
            </div>
        </div>
        @if(!$contract->recipe)
            <form action="{{ route('contracts.parts.store-recipe', $contract->id) }}" method="POST">
                @csrf
                <button type="submit" class="page-success-btn" onclick="return confirm('دستور ساخت صادر شود ؟')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-4 h-4 ml-1">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
                    </svg>
                    صدور دستور ساخت
                </button>
            </form>
        @else
            <div class="flex items-center space-x-2 space-x-reverse">
                <p class="text-sm font-medium text-red-600">
                    دستور ساخت صادر شده
                </p>
                <span>|</span>
                <a href="{{ route('contracts.recipe.index', $contract->id) }}"
                   class="text-xs text-indigo-500 font-medium" target="_blank">
                    مشاهده
                </a>
                <span>|</span>
                <form action="{{ route('contracts.parts.destroy-recipe', $contract->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="text-xs text-red-500 font-medium"
                            onclick="return confirm('دستور ساخت حذف شود ؟')">
                        حذف
                    </button>
                </form>
            </div>
        @endif
    </div>

    <!-- Content -->
    <div class="mt-4">
        @php
            $products = $contract->products()->where('group_id','!=',0)->where('model_id','!=',0)->get();
        @endphp

            <!-- Product List -->
        @if(!$products->isEmpty())
            @foreach($products as $product)
                @php
                    $modell = \App\Models\Modell::find($product->model_id);
                    $weight = 0;
                @endphp
                <form method="POST" action="{{ route('contracts.parts.store-amounts', $contract->id) }}" class="card">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="card-header">
                        <p class="card-title text-lg">
                            لیست قطعات محصول
                            <span class="text-red-600">{{ $modell->parent->name }}</span> -
                            <span class="text-red-600">{{ $product->model_custom_name ?? $modell->name }}</span>
                        </p>
                    </div>
                    <table class="w-full border-collapse">
                        <thead>
                        <tr class="table-th-tr whitespace-nowrap">
                            <th class="p-4 rounded-tr-lg">ردیف</th>
                            <th class="p-4">دسته بندی</th>
                            <th class="p-4">نام قطعه</th>
                            <th class="p-4">واحد</th>
                            <th class="p-4">وزن</th>
                            <th class="p-4">مقادیر</th>
                            <th class="p-4 rounded-tl-lg">
                                <span class="sr-only">اقدامات</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($product->spareAmounts()->orderBy('sort', 'ASC')->get() as $amount)
                            @php
                                $part = \App\Models\Part::find($amount->part_id);
                                $weight += $amount->weight * $amount->value;

                                $category = $part->categories[1];
                                $selectedCategory = $part->categories[2];
                            @endphp
                            <tr class="table-tb-tr group whitespace-nowrap">
                                <td class="table-tr-td border-t-0 border-l-0">
                                    <input type="number" class="input-text text-center w-14" name="sorts[]"
                                           value="{{ $amount->sort }}">
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    <select id="inputCategory{{ $part->id }}" class="input-text w-32"
                                            onchange="changePart(event,{{ $part->id, $product->id }})">
                                        @foreach($category->children as $child)
                                            <option
                                                value="{{ $child->id }}" {{ $child->id == $selectedCategory->id ? 'selected' : '' }}>
                                                {{ $child->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                @php
                                    $lastCategory = $part->categories()->latest()->first();
                                    $categoryParts = $lastCategory->parts;
                                @endphp
                                <td class="table-tr-td border-t-0 border-x-0">
                                    <select name="part_ids[]" class="input-text" id="partList{{ $part->id }}">
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
                                    {{ $part->weight }}
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    <div class="flex items-center justify-center">
                                        <input type="text" name="amounts[]" id="inputAmount{{ $part->id }}"
                                               class="input-text w-24 text-center" value="{{ $amount->value }}"
                                               onkeyup="changeUnit1(event,{{ $part->id }})">
                                        @if(!is_null($part->unit2))
                                            <p class="mr-2">/</p>
                                            <input type="text" id="inputAmount2{{ $part->id }}"
                                                   class="input-text w-20 mr-2" placeholder="{{ $part->unit2 }}"
                                                   value="{{ $amount->value2 }}"
                                                   onkeyup="changeUnit2(event,{{ $part->id }})">
                                        @endif
                                        <input type="hidden" name="amounts2[]" id="inputUnitValue{{ $part->id }}"
                                               value="{{ $amount->value2 }}">
                                    </div>
                                </td>
                                <td class="table-tr-td border-t-0 border-r-0">
                                    <button class="table-delete-btn" type="button"
                                            onclick="deletePart({{ $part->id }},{{ $product->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        <tr class="table-tb-tr">
                            <td colspan="8" class="table-tr-td border-t-0">
                                <a href="{{ route('contracts.parts.add-part', [$contract->id, $product->id]) }}"
                                   class="w-8 h-8 rounded-full bg-green-500 grid place-content-center mr-2"
                                   title="افزودن قطعه">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="2"
                                         stroke="currentColor" class="w-6 h-6 text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M12 4.5v15m7.5-7.5h-15"></path>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="mt-4 sticky bottom-4">
                        <button type="submit" class="page-success-btn">
                            ثبت مقادیر
                        </button>
                    </div>
                </form>
            @endforeach
        @endif

        <!-- Part List -->
        @php
            $types = ['setup','years','control','power_cable','control_cable','pipe','install_setup_price','setup_price','supervision','transport','other','setup_one','install','cable','canal','copper_piping','carbon_piping',null];
        @endphp
        @foreach($types as $type)
            @php
                $products = $contract->products()->where('part_id','!=',0)->where('type',$type)->get();
            @endphp
            @if(!$products->isEmpty())
                <div class="card">
                    <div class="card-header">
                        <p class="card-title text-lg">
                            @switch($type)
                                @case('setup')
                                    قطعات یدکی راه اندازی
                                    @break
                                @case('years')
                                    قطعات یدکی دوسالانه
                                    @break
                                @case('control')
                                    قطعات کنترلی
                                    @break
                                @case('power_cable')
                                    قطعات کابل قدرت
                                    @break
                                @case('control_cable')
                                    قطعات کابل کنترلی
                                    @break
                                @case('pipe')
                                    قطعات لوله و اتصالات
                                    @break
                                @case('install_setup_price')
                                    دستمزد نصب و راه اندازی
                                    @break
                                @case('setup_price')
                                    دستمزد راه اندازی
                                    @break
                                @case('supervision')
                                    دستمزد نظارت
                                    @break
                                @case('transport')
                                    هزینه حمل
                                    @break
                                @case('other')
                                    سایر تجهیزات
                                    @break
                                @case('setup_one')
                                    قطعات راه اندازی
                                    @break
                                @case('install')
                                    قطعات نصب
                                    @break
                                @case('cable')
                                    اقلام کابل کشی
                                    @break
                                @case('canal')
                                    اقلام کانال کشی
                                    @break
                                @case('copper_piping')
                                    دستمزد لوله کشی مسی
                                    @break
                                @case('carbon_piping')
                                    دستمزد لوله کشی کربن استیل
                                    @break
                                @case('')
                                    سایر تجهیزات (قطعات قبلی)
                                    @break
                            @endswitch
                        </p>
                    </div>
                    <table class="w-full border-collapse">
                        <thead>
                        <tr class="table-th-tr">
                            <th class="p-4 rounded-tr-lg">ردیف</th>
                            <th class="p-4">نام قطعه</th>
                            <th class="p-4">واحد</th>
                            <th class="p-4 rounded-tl-lg">تعداد</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            @php
                                $part = \App\Models\Part::find($product->part_id);
                            @endphp
                            <tr class="table-tb-tr group whitespace-normal {{ $loop->even ? 'bg-sky-100' : '' }}">
                                <td class="table-tr-td border-t-0 border-l-0">
                                    {{ $loop->index + 1 }}
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    {{ $part->name }}
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    {{ $part->unit }}
                                </td>
                                <td class="table-tr-td border-t-0 border-r-0">
                                    {{ $product->quantity }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        @endforeach
    </div>
</x-layout>
