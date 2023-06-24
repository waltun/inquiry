@php
    use App\Models\Amount;
    use App\Models\InquiryPrice;
    use App\Models\Part;
    use App\Models\Special;
    use Carbon\Carbon;
@endphp
<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script>
            function multiFunctions(event, part, cid) {
                changePrice(event, part);

                changeFormula(event, cid);
            }
        </script>
        <script>
            function changeFormula(event, cid) {
                let id = event.target.value;

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
                        if (part.unit2 != null) {
                            let inputUnit = document.getElementById('inputUnit' + cid);
                            if (inputUnit) {
                                let value = inputUnit.value;
                                let input = document.getElementById('inputAmount' + cid);
                                let inputValue = document.getElementById('inputUnitValue' + cid);

                                let operator2 = part.operator1;
                                let formula2 = part.formula1;
                                let result = 0;

                                result = eval(value + operator2 + formula2);
                                let formatResult = Intl.NumberFormat().format(result);
                                input.value = formatResult.replace(',', '');
                                inputValue.value = value;
                            }
                        }
                    }
                });
            }
        </script>
        <script>
            function storeInquiryPrice(part, inquiry) {
                let successUpdatePrice = document.getElementById('successUpdatePrice' + part);
                let updatePriceBtn = document.getElementById('updatePriceBtn' + part);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '/inquiry-price/' + part + '/' + inquiry + '/' + 'store',
                    data: {
                        part_id: part,
                        inquiry_id: inquiry
                    },
                    success: function () {
                        successUpdatePrice.classList.remove('hidden');
                        updatePriceBtn.classList.add('hidden');
                    }
                });
            }
        </script>
        <script>
            function changeUnit1(event, cid) {

                let id = document.getElementById('groupPartList' + cid).value;

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
                        let input2 = document.getElementById('inputUnit' + cid);
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

                let id = document.getElementById('groupPartList' + cid).value;

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
                        part: part,
                        product: '{{ $product->id }}'
                    },
                    success: function (res) {
                        let parts = res.data;
                        section.innerHTML = `
                        <select class="input-text" onchange="changePart(event,${part}) changePrice(event,${part})" id="inputCategory${part}">
                            ${
                            parts.map(function (part) {
                                return `<option value="${part.id}">${part.name}</option>`
                            })
                        }
                        </select>`
                    }
                });
            }

            function changePrice(event, part) {
                let id = event.target.value;
                let priceSection = document.getElementById('changePriceSection' + part);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('inquiries.product.changePrice') }}',
                    data: {
                        id: id,
                    },
                    success: function (res) {
                        priceSection.innerText = Intl.NumberFormat().format(res.price);
                    }
                });
            }
        </script>
        <script>
            function deletePartFromAmount(id) {
                if (confirm('قطعه حذف شود ؟')) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'DELETE',
                        url: '/inquiries/' + id + '/destroy-amount',
                        success: function () {
                            location.reload();
                        }
                    });
                }
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
        @if($inquiry->submit)
            <a href="{{ route('inquiries.submitted') }}" class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="breadcrumb-svg"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div class="mr-2">
                    <p class="breadcrumb-p">
                        استعلام های منتظر قیمت
                    </p>
                </div>
            </a>
        @else
            <a href="{{ route('inquiries.index') }}" class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="breadcrumb-svg"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div class="mr-2">
                    <p class="breadcrumb-p">
                        لیست استعلام ها
                    </p>
                </div>
            </a>
        @endif
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                 class="breadcrumb-svg-arrow">
                <path fill-rule="evenodd"
                      d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                      clip-rule="evenodd"/>
            </svg>
        </div>
        <a href="{{ route('inquiries.product.index',$inquiry->id) }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="breadcrumb-svg" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    محصولات استعلام {{ $inquiry->name }}
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
                      d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9zm3.75 11.625a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    جزئیات محصول
                </p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="flex items-center justify-between mt-8">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-7 h-7 dark:text-white">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9zm3.75 11.625a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"></path>
            </svg>
            <div class="mr-2">
                <p class="font-bold text-xl text-black dark:text-white">
                    جزئیات محصول
                </p>
            </div>
        </div>
        <div class="flex items-center space-x-4 space-x-reverse">
            <a href="{{ route('inquiries.product.index',$inquiry->id) }}" class="page-warning-btn">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
                </svg>
                <span class="mr-2">
                    محصولات استعلام {{ $inquiry->name }}
                </span>
            </a>
        </div>
    </div>

    <!-- Errors -->
    <div class="my-4">
        <x-errors/>
    </div>

    <!-- Info -->
    <div class="mt-6 flex items-center space-x-4 space-x-reverse">
        <p class="bg-myBlue-300 py-2 px-4 rounded-lg text-sm text-white">
            دسته : {{ $modell->parent->name }}
        </p>
        <p class="bg-myBlue-300 py-2 px-4 rounded-lg text-sm text-white">
            مدل : {{ $product->model_custom_name ?? $modell->name }}
        </p>
        @can('inquiry-add-to-model')
            @if($product->model_custom_name && !$product->amounts->isEmpty())
                @if($product->copy_model == '0')
                    <form action="{{ route('inquiries.addToModell',$product->id) }}"
                          method="POST" onclick="return confirm('این مدل به مدل های استاندارد اضافه شود ؟')">
                        @csrf
                        <button class="page-gray-btn" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-4 h-4 ml-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                            </svg>
                            افزودن به مدل‌های استاندارد
                        </button>
                    </form>
                @endif
            @endif
        @endcan
        <p class="bg-myBlue-300 py-2 px-4 rounded-lg text-sm text-white">
            مشخصه : {{ $product->property }}
        </p>
    </div>

    <form method="POST" action="{{ route('inquiries.product.storeAmounts',$product->id) }}" class="mt-4 space-y-4">
        @csrf
        <div class="mt-8 overflow-x-auto rounded-lg">
            <table class="w-full border-collapse">
                <thead class="bg-indigo-300">
                <tr class="table-th-tr">
                    <th scope="col" class="p-2 rounded-tr-lg">
                        ردیف
                    </th>
                    <th scope="col" class="p-2">
                        دسته بندی
                    </th>
                    <th scope="col" class="p-2">
                        نام
                    </th>
                    @if(auth()->user()->role == 'admin')
                        <th scope="col" class="p-2">
                            قیمت (تومان)
                        </th>
                    @endif
                    <th scope="col" class="p-2">
                        واحد
                    </th>
                    <th scope="col" class="p-2">
                        مقادیر
                    </th>
                    @if(auth()->user()->role == 'admin')
                        <th scope="col" class="p-2">
                            قیمت کل (تومان)
                        </th>
                    @endif
                    @if(!$amounts->isEmpty())
                        <th scope="col" class="p-2">
                            حذف
                        </th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @php
                    $showPivotPrice = 0;
                    $showAmountPrice = 0;
                    $amountWeight = 0;
                    $partWeight = 0;
                @endphp
                @if($amounts->isEmpty() && !$modell->parts->isEmpty())
                    @foreach($modell->parts()->orderBy('sort','ASC')->get() as $index => $part)
                        @php
                            $showPivotPrice += $part->price * $part->pivot->value;
                            $partWeight += $part->weight * $part->pivot->value;
                            $color = '';
                            switch ($setting->price_color_type) {
                                case 'month' :
                                    $lastTime = Carbon::now()->subMonth($setting->price_color_last_time);
                                    $midTime = Carbon::now()->subMonth($setting->price_color_mid_time);
                                    break;
                                case 'day' :
                                    $lastTime = Carbon::now()->subDay($setting->price_color_last_time);
                                    $midTime = Carbon::now()->subDay($setting->price_color_mid_time);
                                    break;
                                case 'hour' :
                                    $lastTime = Carbon::now()->subHour($setting->price_color_last_time);
                                    $midTime = Carbon::now()->subHour($setting->price_color_mid_time);
                                    break;
                            }

                            if ($part->collection == '0') {
                                if ($part->price_updated_at < $lastTime && $part->price > 0) {
								    $color = 'text-red-500';
                                }
                                if ($part->price_updated_at > $lastTime && $part->price_updated_at > $midTime && $part->price > 0) {
                                    $color = 'text-black';
                                }
                                if ($part->price_updated_at < $lastTime && $part->price == 0) {
                                    $color = 'text-red-600';
                                }
                            }

                            foreach ($part->children as $child) {
                                if ($child->price_updated_at < $lastTime && $child->price > 0) {
                                     $color = 'text-red-500';
                                }
                                 if ($child->price_updated_at < $lastTime && $child->price == 0) {
                                     $color = 'text-red-600';
                                 }
                            }

                            $category = $part->categories[1];
                            $selectedCategory = $part->categories[2];
                        @endphp
                        <tr class="table-tb-tr group {{ $loop->even ? 'bg-sky-100' : '' }}">
                            <td class="table-tr-td border-t-0 border-l-0">
                                <input type="text" class="input-text w-14 text-center"
                                       value="{{ $part->pivot->sort ?? 0 }}"
                                       name="sorts[]" id="partSort{{ $part->id }}">
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
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
                            <td class="table-tr-td border-t-0 border-x-0">
                                @php
                                    $lastCategory = $part->categories()->latest()->first();
                                    if ((in_array($part->id,$specials) && !$part->standard) || ($part->coil && !$part->standard)) {
                                        $categoryParts = $lastCategory->parts()->where('product_id',$product->id)->get();
                                        if ($categoryParts->isEmpty()) {
                                            $categoryParts[] = $lastCategory->parts()->first();
                                        }
                                    } else {
                                        $categoryParts = $lastCategory->parts;
                                    }
                                @endphp
                                <div class="flex items-center space-x-2 space-x-reverse">
                                    <select name="part_ids[]" class="input-text" id="groupPartList{{ $part->id }}"
                                            onchange="multiFunctions(event,{{ $part->id }},{{ $part->id }})">
                                        @foreach($categoryParts as $part2)
                                            @if(!session()->has('selectedPart' . $part2->id))
                                                <option
                                                    value="{{ $part2->id }}" {{ $part2->id == $part->id ? 'selected' : '' }}>
                                                    {{ $part2->name }}
                                                </option>
                                            @else
                                                <option
                                                    value="{{ $part2->id }}" {{ $part2->product_id == $product->id ? 'selected' : '' }}>
                                                    {{ $part2->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @if($part->coil == '1' && $part->collection == '1' && !$part->standard)
                                        @switch($lastCategory->id)
                                            @case('400')
                                                <span class="hidden">DX Coil</span>
                                                <a href="{{ route('calculateCoil.evaperator.index',[150,$product->id]) }}"
                                                   class="table-success-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                                    </svg>
                                                    محاسبه
                                                </a>
                                                @break
                                            @case('402')
                                                <span class="hidden">Condensor Coil</span>
                                                <a href="{{ route('calculateCoil.condensor.index',[167,$product->id]) }}"
                                                   class="table-success-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                                    </svg>
                                                    محاسبه
                                                </a>
                                                @break
                                            @case('404')
                                                <span class="hidden">Water Cold Coil</span>
                                                <a href="{{ route('calculateCoil.waterCold.index',[168,$product->id]) }}"
                                                   class="table-success-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                                    </svg>
                                                    محاسبه
                                                </a>
                                                @break
                                            @case('406')
                                                <span class="hidden">Water Warm Coil</span>
                                                <a href="{{ route('calculateCoil.waterWarm.index',[169,$product->id]) }}"
                                                   class="table-success-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                                    </svg>
                                                    محاسبه
                                                </a>
                                                @break
                                            @case('408')
                                                <span class="hidden">Fancoil Coil</span>
                                                <a href="{{ route('calculateCoil.fancoil.index',[170,$product->id]) }}"
                                                   class="table-success-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                                    </svg>
                                                    محاسبه
                                                </a>
                                                @break

                                            @case('469')
                                                <span class="hidden">Evaporator Converter</span>
                                                <a href="{{ route('calculateConverter.evaporator.index',[1194,$product->id]) }}"
                                                   class="table-success-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                                    </svg>
                                                    محاسبه
                                                </a>
                                                @break
                                            @case('531')
                                                <span class="hidden">Condensor Converter</span>
                                                <a href="{{ route('calculateConverter.condensor.index',[1301,$product->id]) }}"
                                                   class="table-success-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                                    </svg>
                                                    محاسبه
                                                </a>
                                                @break

                                            @case('232')
                                                <span class="hidden">Damper Raft</span>
                                                <a href="{{ route('calculateDamper.raft.index',[148,$product->id]) }}"
                                                   class="table-success-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                                    </svg>
                                                    محاسبه
                                                </a>
                                                @break
                                            @case('275')
                                                <span class="hidden">Damper Taze</span>
                                                <a href="{{ route('calculateDamper.taze.index',[146,$product->id]) }}"
                                                   class="table-success-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                                    </svg>
                                                    محاسبه
                                                </a>
                                                @break
                                            @case('276')
                                                <span class="hidden">Damper Bargasht</span>
                                                <a href="{{ route('calculateDamper.bargasht.index',[147,$product->id]) }}"
                                                   class="table-success-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                                    </svg>
                                                    محاسبه
                                                </a>
                                                @break
                                            @case('277')
                                                <span class="hidden">Damper Exast</span>
                                                <a href="{{ route('calculateDamper.exast.index',[149,$product->id]) }}"
                                                   class="table-success-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                                    </svg>
                                                    محاسبه
                                                </a>
                                                @break

                                            @case('492')
                                                <span class="hidden">Chiller Electrical</span>
                                                <a href="{{ route('calculateElectrical.chiller.index',[2144,$product->id]) }}"
                                                   class="table-success-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                                    </svg>
                                                    محاسبه
                                                </a>
                                                @break
                                            @case('493')
                                                <span class="hidden">Mini Chiller Electrical</span>
                                                <a href="{{ route('calculateElectrical.mini.index',[2264,$product->id]) }}"
                                                   class="table-success-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                                    </svg>
                                                    محاسبه
                                                </a>
                                                @break
                                            @case('494')
                                                <span class="hidden">Panel Electrical</span>
                                                <a href="{{ route('calculateElectrical.panel.index',[1879,$product->id]) }}"
                                                   class="table-success-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                                    </svg>
                                                    محاسبه
                                                </a>
                                                @break
                                            @case('495')
                                                <span class="hidden">Air Condition Electrical</span>
                                                <a href="{{ route('calculateElectrical.air.index',[2249,$product->id]) }}"
                                                   class="table-success-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                                    </svg>
                                                    محاسبه
                                                </a>
                                                @break
                                            @case('496')
                                                <span class="hidden">Zent Electrical</span>
                                                <a href="{{ route('calculateElectrical.zent.index',[2256,$product->id]) }}"
                                                   class="table-success-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                                    </svg>
                                                    محاسبه
                                                </a>
                                                @break
                                        @endswitch
                                    @endif
                                    @if($part->coil == '1' && !$part->standard && !in_array($part->id,$specials))
                                        <a href="{{ route('collections.amounts',$part->id) }}" target="_blank"
                                           class="table-info-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            مشاهده جزئیات
                                        </a>
                                    @endif
                                </div>
                            </td>
                            @if(auth()->user()->role == 'admin')
                                <td class="table-tr-td border-t-0 border-x-0 {{ $color }}">
                                    <span id="changePriceSection{{ $part->id }}">
                                        {{ number_format($part->price) }}
                                    </span>
                                </td>
                            @endif
                            <td class="table-tr-td border-t-0 border-x-0">
                                @if(is_null($part->unit2))
                                    {{ $part->unit }}
                                @else
                                    {{ $part->unit }} / {{ $part->unit2 }}
                                @endif
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                <div class="flex items-center">
                                    <input type="text" name="modellAmounts[]" id="inputAmount{{ $part->id }}"
                                           class="input-text w-24" value="{{ $part->pivot->value }}"
                                           onkeyup="changeUnit1(event,{{ $part->id }})">
                                    @if(!is_null($part->unit2))
                                        <p class="mr-2">/</p>
                                        <input type="text" id="inputUnit{{ $part->id }}"
                                               class="input-text w-20 mr-2" placeholder="{{ $part->unit2 }}"
                                               onkeyup="changeUnit2(event,{{ $part->id }})"
                                               value="{{ $part->pivot->value2 }}">
                                    @endif

                                    <input type="hidden" name="units[]" id="inputUnitValue{{ $part->id }}"
                                           value="{{ $part->pivot->value2 }}">
                                    @if(!in_array($part->id,$specials))
                                        @php
                                            $parents = [];
                                        @endphp
                                        @if($color == 'text-red-500' || $color == 'text-red-600' || $part->price == '0')
                                            @php
                                                $inquiryPriceIds = InquiryPrice::where('part_id', $part->id)->pluck('part_id')->toArray();
                                                $parentIds = Part::whereIn('id', InquiryPrice::all()->pluck('part_id'))->whereHas('parents')->pluck('id')->flatten()->toArray();
                                            @endphp
                                            @if(!in_array($part->id, $inquiryPriceIds) && !in_array($part->id, $parentIds))
                                                <button type="button" class="mr-2" id="updatePriceBtn{{ $part->id }}"
                                                        onclick="storeInquiryPrice({{ $part->id }},{{ $inquiry->id }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         title="ارسال درخواست بروزرسانی قیمت"
                                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                         class="w-6 h-6 text-red-600">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286zm0 13.036h.008v.008H12v-.008z"/>
                                                    </svg>
                                                </button>
                                            @else
                                                <p class="mr-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                         class="w-6 h-6 text-red-600">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                </p>
                                            @endif
                                            <p class="mr-2 hidden" id="successUpdatePrice{{ $part->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                     class="w-6 h-6 text-red-600">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            </p>
                                        @endif
                                    @endif
                                </div>
                            </td>
                            @if(auth()->user()->role == 'admin')
                                <td class="table-tr-td border-t-0 border-r-0 {{ $color }}">
                                    {{ number_format($part->price * $part->pivot->value) }}
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @else
                    @foreach($amounts as $amount)
                        @php
                            $part = Part::find($amount->part_id);
                            $showAmountPrice += $part->price * $amount->value;
                            $amountWeight += $amount->weight * $amount->value;
                            $color = '';

                            switch ($setting->price_color_type) {
                                case 'month' :
                                    $lastTime = Carbon::now()->subMonth($setting->price_color_last_time);
                                    $midTime = Carbon::now()->subMonth($setting->price_color_mid_time);
                                    break;
                                case 'day' :
                                    $lastTime = Carbon::now()->subDay($setting->price_color_last_time);
                                    $midTime = Carbon::now()->subDay($setting->price_color_mid_time);
                                    break;
                                case 'hour' :
                                    $lastTime = Carbon::now()->subHour($setting->price_color_last_time);
                                    $midTime = Carbon::now()->subHour($setting->price_color_mid_time);
                                    break;
                            }

                            if ($part->collection == '0') {
                                if ($part->price_updated_at < $lastTime && $part->price > 0) {
								    $color = 'text-red-500';
                                }
                                if ($part->price_updated_at > $lastTime && $part->price_updated_at > $midTime && $part->price > 0) {
                                    $color = 'text-black';
                                }
                                if ($part->price_updated_at < $lastTime && $part->price == 0) {
                                    $color = 'text-red-600';
                                }
                            }

                            foreach ($part->children as $child) {
                                if ($child->price_updated_at < $lastTime && $child->price > 0) {
                                    $color = 'text-red-500';
                                }
                                if ($child->price_updated_at < $lastTime && $child->price == 0) {
                                    $color = 'text-red-600';
                                }
                           }

                            $category = $part->categories[1];
                            $selectedCategory = $part->categories[2];
                        @endphp
                        <tr class="table-tb-tr group {{ $loop->even ? 'bg-sky-100' : '' }}">
                            <td class="table-tr-td border-t-0 border-l-0">
                                <input type="text" class="input-text w-14 text-center" value="{{ $amount->sort ?? 0 }}"
                                       name="sorts[]" id="partSort{{ $part->id }}">
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                <select name="" id="inputCategory{{ $part->id }}" class="input-text w-20"
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
                                    $lastCategory = $part->categories()->latest()->first();
                                    if ((in_array($part->id,$specials) && !$part->standard) || ($part->coil && !$part->standard)) {
                                        $categoryParts = $lastCategory->parts()->where('product_id',$product->id)->get();
                                        if ($categoryParts->isEmpty()) {
                                            $categoryParts[] = $lastCategory->parts()->first();
                                        }
                                    } else {
                                        $categoryParts = $lastCategory->parts;
                                    }
                                @endphp
                                <div class="flex items-center space-x-2 space-x-reverse">
                                    <select name="part_ids[]" class="input-text" id="groupPartList{{ $part->id }}"
                                            onchange="multiFunctions(event,{{ $part->id }},{{ $part->id }},{{ $part->id }})">
                                        @foreach($categoryParts as $part2)
                                            @if(!session()->has('selectedPart' . $part2->id))
                                                <option
                                                    value="{{ $part2->id }}" {{ $part2->id == $part->id ? 'selected' : '' }}>
                                                    {{ $part2->name }}
                                                </option>
                                            @else
                                                <option
                                                    value="{{ $part2->id }}" {{ $part2->product_id == $product->id ? 'selected' : '' }}>
                                                    {{ $part2->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @if($part->coil == '1' && $part->collection == '1' && !$part->standard)
                                        @switch($lastCategory->id)
                                            @case('400')
                                                <span class="hidden">DX Coil</span>
                                                <a href="{{ route('calculateCoil.evaperator.index',[150,$product->id]) }}"
                                                   class="table-success-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                         class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                                    </svg>
                                                    محاسبه
                                                </a>
                                                @break
                                            @case('402')
                                                <span class="hidden">Condensor Coil</span>
                                                <a href="{{ route('calculateCoil.condensor.index',[167,$product->id]) }}"
                                                   class="table-success-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                         class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                                    </svg>
                                                    محاسبه
                                                </a>
                                                @break
                                            @case('404')
                                                <span class="hidden">Water Cold Coil</span>
                                                <a href="{{ route('calculateCoil.waterCold.index',[168,$product->id]) }}"
                                                   class="table-success-btn" onclick="test(event)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                         class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                                    </svg>
                                                    محاسبه
                                                </a>
                                                @break
                                            @case('406')
                                                <span class="hidden">Water Warm Coil</span>
                                                <a href="{{ route('calculateCoil.waterWarm.index',[169,$product->id]) }}"
                                                   class="table-success-btn" onclick="test(event)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                         class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                                    </svg>
                                                    محاسبه
                                                </a>
                                                @break
                                            @case('408')
                                                <span class="hidden">Fancoil Coil</span>
                                                <a href="{{ route('calculateCoil.fancoil.index',[170,$product->id]) }}"
                                                   class="table-success-btn" onclick="test(event)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                         class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                                    </svg>
                                                    محاسبه
                                                </a>
                                                @break

                                            @case('469')
                                                <span class="hidden">Evaporator Converter</span>
                                                <a href="{{ route('calculateConverter.evaporator.index',[1194,$product->id]) }}"
                                                   class="table-success-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                         class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                                    </svg>
                                                    محاسبه
                                                </a>
                                                @break
                                            @case('531')
                                                <span class="hidden">Condensor Converter</span>
                                                <a href="{{ route('calculateConverter.condensor.index',[1301,$product->id]) }}"
                                                   class="table-success-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                         class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                                    </svg>
                                                    محاسبه
                                                </a>
                                                @break

                                            @case('232')
                                                <span class="hidden">Damper Raft</span>
                                                <a href="{{ route('calculateDamper.raft.index',[148,$product->id]) }}"
                                                   class="table-success-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                         class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                                    </svg>
                                                    محاسبه
                                                </a>
                                                @break
                                            @case('275')
                                                <span class="hidden">Damper Taze</span>
                                                <a href="{{ route('calculateDamper.taze.index',[146,$product->id]) }}"
                                                   class="table-success-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                         class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                                    </svg>
                                                    محاسبه
                                                </a>
                                                @break
                                            @case('276')
                                                <span class="hidden">Damper Bargasht</span>
                                                <a href="{{ route('calculateDamper.bargasht.index',[147,$product->id]) }}"
                                                   class="table-success-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                         class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                                    </svg>
                                                    محاسبه
                                                </a>
                                                @break
                                            @case('277')
                                                <span class="hidden">Damper Exast</span>
                                                <a href="{{ route('calculateDamper.exast.index',[149,$product->id]) }}"
                                                   class="table-success-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                         class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                                    </svg>
                                                    محاسبه
                                                </a>
                                                @break

                                            @case('492')
                                                <span class="hidden">Chiller Electrical</span>
                                                <a href="{{ route('calculateElectrical.chiller.index',[2144,$product->id]) }}"
                                                   class="table-success-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                         class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                                    </svg>
                                                    محاسبه
                                                </a>
                                                @break
                                            @case('493')
                                                <span class="hidden">Mini Chiller Electrical</span>
                                                <a href="{{ route('calculateElectrical.mini.index',[2264,$product->id]) }}"
                                                   class="table-success-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                         class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                                    </svg>
                                                    محاسبه
                                                </a>
                                                @break
                                            @case('494')
                                                <span class="hidden">Panel Electrical</span>
                                                <a href="{{ route('calculateElectrical.panel.index',[1879,$product->id]) }}"
                                                   class="table-success-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                         class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                                    </svg>
                                                    محاسبه
                                                </a>
                                                @break
                                            @case('495')
                                                <span class="hidden">Air Condition Electrical</span>
                                                <a href="{{ route('calculateElectrical.air.index',[2249,$product->id]) }}"
                                                   class="table-success-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                         class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                                    </svg>
                                                    محاسبه
                                                </a>
                                                @break
                                            @case('496')
                                                <span class="hidden">Zent Electrical</span>
                                                <a href="{{ route('calculateElectrical.zent.index',[2256,$product->id]) }}"
                                                   class="table-success-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                         class="w-4 h-4 ml-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
                                                    </svg>
                                                    محاسبه
                                                </a>
                                                @break
                                        @endswitch
                                    @endif
                                    @if($part->coil == '1' && !$part->standard && !in_array($part->id,$specials))
                                        <a href="{{ route('collections.amounts',$part->id) }}" target="_blank"
                                           class="table-info-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            جزئیات
                                        </a>
                                    @endif
                                </div>
                            </td>
                            @if(auth()->user()->role == 'admin')
                                <td class="table-tr-td border-t-0 border-x-0">
                                <span id="changePriceSection{{ $part->id }}" class="{{ $color }}">
                                    {{ number_format($part->price) }}
                                </span>
                                </td>
                            @endif
                            <td class="table-tr-td border-t-0 border-x-0">
                                @if(is_null($part->unit2))
                                    {{ $part->unit }}
                                @else
                                    <span id="unitSection">
                                        {{ $part->unit }} / {{ $part->unit2 }}
                                    </span>
                                @endif
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                <div class="flex items-center">
                                    <input type="text" name="amounts[]" id="inputAmount{{ $part->id }}"
                                           class="input-text w-24" value="{{ $amount->value }}"
                                           onkeyup="changeUnit1(event,{{ $part->id }})">
                                    @if(!is_null($part->unit2))
                                        <p class="mr-2">/</p>
                                        <input type="text" id="inputUnit{{ $part->id }}"
                                               class="input-text w-20 mr-2" placeholder="{{ $part->unit2 }}"
                                               onkeyup="changeUnit2(event,{{ $part->id }})"
                                               value="{{ $amount->value2 }}">
                                    @endif

                                    <input type="hidden" name="units[]" id="inputUnitValue{{ $part->id }}"
                                           value="{{ $amount->value2 }}">
                                    @php
                                        $parents = [];
                                    @endphp
                                    @if($color == 'text-red-500' || $color == 'text-red-600')
                                        @php
                                            $inquiryPriceIds = InquiryPrice::where('part_id', $part->id)->pluck('part_id')->toArray();
                                            $parentIds = Part::whereIn('id', InquiryPrice::all()->pluck('part_id'))->whereHas('parents')->pluck('id')->flatten()->toArray();
                                        @endphp
                                        @if(!in_array($part->id, $inquiryPriceIds) && !in_array($part->id, $parentIds))
                                            <button type="button" class="mr-2" id="updatePriceBtn{{ $part->id }}"
                                                    onclick="storeInquiryPrice({{ $part->id }},{{ $inquiry->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                     title="ارسال درخواست بروزرسانی قیمت"
                                                     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                     class="w-5 h-5 text-red-600">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286zm0 13.036h.008v.008H12v-.008z"/>
                                                </svg>
                                            </button>
                                        @else
                                            <p class="mr-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                     class="w-5 h-5 text-red-600">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            </p>
                                        @endif
                                        <p class="mr-2 hidden" id="successUpdatePrice{{ $part->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                 class="w-5 h-5 text-red-600">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </p>
                                    @endif
                                </div>
                            </td>
                            @if(auth()->user()->role == 'admin')
                                <td class="table-tr-td border-t-0 border-x-0 {{ $color }}">
                                    {{ number_format($part->price * $amount->value) }}
                                </td>
                            @endif
                            @if(!$amounts->isEmpty())
                                <td class="table-tr-td border-t-0 border-r-0">
                                    <button type="button" onclick="deletePartFromAmount({{ $amount->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-red-500">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                        </svg>
                                    </button>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    @if(!$amounts->isEmpty())
                        <tr class="table-tb-tr group">
                            <td class="table-tr-td border-t-0 border-t-0"
                                colspan="{{ $inquiry->submit ? '11' : '10' }}">
                                <div class="flex justify-between items-center">
                                    <a href="{{ route('inquiries.newPart.create',$product->id) }}"
                                       class="w-8 h-8 rounded-full bg-green-500 block grid place-content-center mr-6"
                                       title="افزودن قطعه جدید">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="2"
                                             stroke="currentColor" class="w-6 h-6 text-white">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M12 4.5v15m7.5-7.5h-15"></path>
                                        </svg>
                                    </a>
                                    @if(auth()->user()->role == 'admin')
                                        @if($showPivotPrice != 0)
                                            <div class="flex items-center space-x-4 space-x-reverse">
                                                <p class="table-price-label">
                                                    قیمت کل : {{ number_format($showPivotPrice) }} تومان
                                                </p>
                                                <p class="table-weight-label">
                                                    وزن دستگاه : {{ number_format($partWeight) }} کیلوگرم
                                                </p>
                                            </div>
                                        @endif
                                    @endif
                                    @if(auth()->user()->role == 'admin')
                                        @if($showAmountPrice != 0)
                                            <div class="flex items-center space-x-4 space-x-reverse">
                                                <p class="table-price-label">
                                                    قیمت کل : {{ number_format($showAmountPrice) }} تومان
                                                </p>
                                                <p class="table-weight-label">
                                                    وزن دستگاه : {{ number_format($amountWeight) }} کیلوگرم
                                                </p>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endif
                @endif
                </tbody>
            </table>
        </div>
        <div class="sticky bottom-4 flex items-center justify-between">
            <div class="flex items-center space-x-2 space-x-reverse">
                <button type="submit" class="form-submit-btn">
                    ثبت مقادیر
                </button>
                <a href="{{ route('inquiries.product.index',$inquiry->id) }}" class="form-cancel-btn">
                    انصراف
                </a>
            </div>
        </div>
    </form>
</x-layout>
