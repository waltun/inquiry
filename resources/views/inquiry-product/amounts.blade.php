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
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
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
                    <a href="{{ route('inquiries.index') }}"
                       class="mr-2 text-xs md:text-sm font-medium text-gray-500 hover:text-gray-900">
                        مدیریت استعلام ها
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
                        تعیین مقادیر محصول {{ $product->name }}
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Navigation Btn -->
    <div class="mt-4 md:flex justify-between">
        <div class="mb-4 md:mb-0">
            <p class="text-lg font-bold">
                جزئیات محصول <span
                    class="text-red-600">{{ $group->name }} - {{ $product->model_custom_name ?? $modell->name }}</span>
            </p>
        </div>
        <div class="flex md:justify-end space-x-2 space-x-reverse">
            <a href="{{ route('inquiries.product.index',$inquiry->id) }}" class="form-detail-btn text-xs">
                بازگشت به محصولات استعلام {{ $inquiry->name }}
            </a>
        </div>
    </div>

    <!-- Errors -->
    <div class="my-4">
        <x-errors/>
    </div>

    <!-- Info -->
    <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4">
        <div class="md:flex justify-around items-center space-y-4 md:space-y-0">
            <p class="font-bold text-red-600 md:text-lg text-sm text-center">
                دسته : {{ $modell->parent->name }}
            </p>
            <div class="flex items-center">
                <p class="font-bold text-red-600 md:text-lg text-sm text-center ml-2">
                    مدل : {{ $product->model_custom_name ?? $modell->name }}
                </p>
                @can('users')
                    @if($product->model_custom_name && !$product->amounts->isEmpty())
                        @if($product->copy_model == '0')
                            <form action="{{ route('inquiries.addToModell',$product->id) }}"
                                  method="POST" onclick="return confirm('این مدل به مدل های استاندارد اضافه شود ؟')">
                                @csrf
                                <button class="form-percent-btn text-xs" type="submit">
                                    افزودن به مدل های استاندارد
                                </button>
                            </form>
                        @else
                            <span class="text-xs font-bold text-gray-600">
                            (این مدل به مدل های استاندارد اضافه شده است)
                        </span>
                        @endif
                    @endif
                @endcan
            </div>
        </div>
    </div>

    <!-- Laptop List -->
    <form method="POST" action="{{ route('inquiries.product.storeAmounts',$product->id) }}"
          class="mt-4 md:block hidden">
        @csrf
        <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4">
            <table class="border-collapse border-gray-200 w-full">
                <thead class="bg-indigo-300">
                <tr>
                    <th class="p-2 text-sm border border-gray-300">ردیف</th>
                    <th class="p-2 text-sm border border-gray-300">دسته بندی</th>
                    <th class="p-2 text-sm border border-gray-300">نام</th>
                    <th class="p-2 text-sm border border-gray-300">قیمت</th>
                    <th class="p-2 text-sm border border-gray-300">واحد</th>
                    <th class="p-2 text-sm border border-gray-300">مقادیر</th>
                    <th class="p-2 text-sm border border-gray-300">قیمت کل</th>
                    @if(!$amounts->isEmpty())
                        <th class="p-2 text-sm border border-gray-300">حذف</th>
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
                            if ($setting) {
                                if($setting->price_color_type == 'month') {
                                    $lastTime = Carbon::now()->subMonth($setting->price_color_last_time);
                                    $midTime = Carbon::now()->subMonth($setting->price_color_mid_time);
                                }
                                if($setting->price_color_type == 'day') {
                                    $lastTime = Carbon::now()->subDay($setting->price_color_last_time);
                                    $midTime = Carbon::now()->subDay($setting->price_color_mid_time);
                                }
                                if($setting->price_color_type == 'hour') {
                                    $lastTime = Carbon::now()->subHour($setting->price_color_last_time);
                                    $midTime = Carbon::now()->subHour($setting->price_color_mid_time);
                                }
                            }

                            if(!in_array($part->id,$specials) && $part->collection == '0') {
                                if ($part->price_updated_at < $lastTime && $part->price > 0) {
                                    $color = 'text-red-500';
                                }
                                if ($part->price_updated_at > $lastTime && $part->price_updated_at > $midTime && $part->price > 0) {
                                    $color = 'tex-black';
                                }
                                if ($part->price_updated_at > $lastTime && $part->price_updated_at < $midTime && $part->price > 0) {
                                    $color = 'text-yellow-500';
                                }
                                if ($part->price_updated_at < $lastTime && $part->price == 0) {
                                    $color = 'text-red-600';
                                }
                            }

                            if (!in_array($part->id,$specials) && $part->collection == '1') {
                                foreach ($part->children as $child) {
                                    if ($child->price_updated_at < $lastTime && $child->price > 0) {
                                        $color = 'text-red-500';
                                    }
                                    if ($child->price_updated_at < $lastTime && $child->price == 0) {
                                        $color = 'text-red-600';
                                    }
                                }
                            }

                            $category = $part->categories[1];
                            $selectedCategory = $part->categories[2];
                        @endphp
                        <tr>
                            <td class="p-2 border border-gray-300">
                                <input type="text" class="input-text w-14 text-center"
                                       value="{{ $part->pivot->sort ?? 0 }}"
                                       name="sorts[]" id="partSort{{ $part->id }}">
                            </td>
                            <td class="p-2 border border-gray-300">
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
                            <td class="p-2 border border-gray-300 flex items-center">
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
                                               class="form-submit-btn text-xs mr-1">
                                                محاسبه
                                            </a>
                                            @break
                                        @case('402')
                                            <span class="hidden">Condensor Coil</span>
                                            <a href="{{ route('calculateCoil.condensor.index',[167,$product->id]) }}"
                                               class="form-submit-btn text-xs mr-1">
                                                محاسبه
                                            </a>
                                            @break
                                        @case('404')
                                            <span class="hidden">Water Cold Coil</span>
                                            <a href="{{ route('calculateCoil.waterCold.index',[168,$product->id]) }}"
                                               class="form-submit-btn text-xs mr-1">
                                                محاسبه
                                            </a>
                                            @break
                                        @case('406')
                                            <span class="hidden">Water Warm Coil</span>
                                            <a href="{{ route('calculateCoil.waterWarm.index',[169,$product->id]) }}"
                                               class="form-submit-btn text-xs mr-1">
                                                محاسبه
                                            </a>
                                            @break
                                        @case('408')
                                            <span class="hidden">Fancoil Coil</span>
                                            <a href="{{ route('calculateCoil.fancoil.index',[170,$product->id]) }}"
                                               class="form-submit-btn text-xs mr-1">
                                                محاسبه
                                            </a>
                                            @break

                                        @case('469')
                                            <span class="hidden">Evaporator Converter</span>
                                            <a href="{{ route('calculateConverter.evaporator.index',[1194,$product->id]) }}"
                                               class="form-submit-btn text-xs mr-1">
                                                محاسبه
                                            </a>
                                            @break

                                        @case('232')
                                            <span class="hidden">Damper Raft</span>
                                            <a href="{{ route('calculateDamper.raft.index',[148,$product->id]) }}"
                                               class="form-submit-btn text-xs mr-1">
                                                محاسبه
                                            </a>
                                            @break
                                        @case('275')
                                            <span class="hidden">Damper Taze</span>
                                            <a href="{{ route('calculateDamper.taze.index',[146,$product->id]) }}"
                                               class="form-submit-btn text-xs mr-1">
                                                محاسبه
                                            </a>
                                            @break
                                        @case('276')
                                            <span class="hidden">Damper Bargasht</span>
                                            <a href="{{ route('calculateDamper.bargasht.index',[147,$product->id]) }}"
                                               class="form-submit-btn text-xs mr-1">
                                                محاسبه
                                            </a>
                                            @break
                                        @case('277')
                                            <span class="hidden">Damper Exast</span>
                                            <a href="{{ route('calculateDamper.exast.index',[149,$product->id]) }}"
                                               class="form-submit-btn text-xs mr-1">
                                                محاسبه
                                            </a>
                                            @break

                                        @case('492')
                                            <span class="hidden">Chiller Electrical</span>
                                            <a href="{{ route('calculateElectrical.chiller.index',[2144,$product->id]) }}"
                                               class="form-submit-btn text-xs mr-1">
                                                محاسبه
                                            </a>
                                            @break
                                        @case('493')
                                            <span class="hidden">Mini Chiller Electrical</span>
                                            <a href="{{ route('calculateElectrical.mini.index',[2264,$product->id]) }}"
                                               class="form-submit-btn text-xs mr-1">
                                                محاسبه
                                            </a>
                                            @break
                                        @case('494')
                                            <span class="hidden">Panel Electrical</span>
                                            <a href="{{ route('calculateElectrical.panel.index',[1879,$product->id]) }}"
                                               class="form-submit-btn text-xs mr-1">
                                                محاسبه
                                            </a>
                                            @break
                                        @case('495')
                                            <span class="hidden">Air Condition Electrical</span>
                                            <a href="{{ route('calculateElectrical.air.index',[2249,$product->id]) }}"
                                               class="form-submit-btn text-xs mr-1">
                                                محاسبه
                                            </a>
                                            @break
                                        @case('496')
                                            <span class="hidden">Zent Electrical</span>
                                            <a href="{{ route('calculateElectrical.zent.index',[2256,$product->id]) }}"
                                               class="form-submit-btn text-xs mr-1">
                                                محاسبه
                                            </a>
                                            @break
                                    @endswitch
                                @endif
                                @if($part->coil == '1' && !$part->standard && !in_array($part->id,$specials))
                                    <a href="{{ route('collections.amounts',$part->id) }}" target="_blank"
                                       class="text-xs mr-1 text-indigo-500 underline underline-offset-4 whitespace-nowrap">
                                        مشاهده جزئیات
                                    </a>
                                @endif
                            </td>
                            <td class="p-2 text-sm text-center border border-gray-300 {{ $color ?? '' }}">
                                <span id="changePriceSection{{ $part->id }}">
                                    {{ number_format($part->price) }}
                                </span>
                            </td>
                            <td class="p-2 text-sm text-center border border-gray-300">
                                @if(is_null($part->unit2))
                                    {{ $part->unit }}
                                @else
                                    {{ $part->unit }} / {{ $part->unit2 }}
                                @endif
                            </td>
                            <td class="p-2 border border-gray-300">
                                <div class="flex items-center">
                                    <input type="text" name="modellAmounts[]" id="inputAmount{{ $part->id }}"
                                           class="input-text w-24 {{ $part->pivot->value == '0' ? 'border-yellow-500' : '' }}"
                                           value="{{ $part->pivot->value }}"
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
                                                $inquiryPrice = InquiryPrice::where('part_id',$part->id)->pluck('part_id')->all();
                                                $inquiryPrices = InquiryPrice::all()->pluck('part_id');
                                                foreach ($inquiryPrices as $item) {
                                                    $inquiryPart = Part::find($item);
                                                    if (!$inquiryPart->parents->isEmpty()) {
                                                        $parents = $inquiryPart->parents->pluck('id')->toArray();
                                                    }
                                                }
                                            @endphp
                                            @if(!in_array($part->id,$inquiryPrice) && !in_array($part->id,$parents))
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
                            <td class="p-2 text-sm text-center border border-gray-300 {{ $color ?? '' }}">
                                {{ number_format($part->price * $part->pivot->value) }}
                            </td>
                        </tr>
                    @endforeach
                @else
                    @foreach($amounts as $amount)
                        @php
                            $part = Part::find($amount->part_id);
                            $showAmountPrice += $part->price * $amount->value;
                            $amountWeight += $amount->weight * $amount->value;
                            $color = '';
                            if ($setting) {
                                if($setting->price_color_type == 'month') {
                                    $lastTime = Carbon::now()->subMonth($setting->price_color_last_time);
                                    $midTime = Carbon::now()->subMonth($setting->price_color_mid_time);
                                }
                                if($setting->price_color_type == 'day') {
                                    $lastTime = Carbon::now()->subDay($setting->price_color_last_time);
                                    $midTime = Carbon::now()->subDay($setting->price_color_mid_time);
                                }
                                if($setting->price_color_type == 'hour') {
                                    $lastTime = Carbon::now()->subHour($setting->price_color_last_time);
                                    $midTime = Carbon::now()->subHour($setting->price_color_mid_time);
                                }
                            }

                            if (!in_array($part->id,$specials) && $part->collection == '0') {
                                if ($part->price_updated_at < $lastTime && $part->price > 0) {
								    $color = 'text-red-500';
                                }
                                if ($part->price_updated_at > $lastTime && $part->price_updated_at > $midTime && $part->price > 0) {
                                    $color = 'text-black';
                                }
                                if ($part->price_updated_at > $lastTime && $part->price_updated_at < $midTime && $part->price > 0) {
                                    $color = 'text-yellow-500';
                                }
                                if ($part->price_updated_at < $lastTime && $part->price == 0) {
                                    $color = 'text-red-600';
                                }
                            }

                            if (!in_array($part->id,$specials) && $part->collection == '1') {
                                    foreach ($part->children as $child) {
                                        if ($child->price_updated_at < $lastTime && $child->price > 0) {
                                            $color = 'text-red-500';
                                        }
                                        if ($child->price_updated_at < $lastTime && $child->price == 0) {
                                            $color = 'text-red-600';
                                        }
                                    }
                                }

                            $category = $part->categories[1];
                            $selectedCategory = $part->categories[2];
                        @endphp
                        <tr>
                            <td class="border border-gray-300 p-2">
                                <input type="text" class="input-text w-14 text-center" value="{{ $amount->sort ?? 0 }}"
                                       name="sorts[]" id="partSort{{ $part->id }}">
                            </td>
                            <td class="border border-gray-300 p-2">
                                <select name="" id="inputCategory{{ $part->id }}" class="input-text"
                                        onchange="changePart(event,{{ $part->id }})">
                                    @foreach($category->children as $child)
                                        <option
                                            value="{{ $child->id }}" {{ $child->id == $selectedCategory->id ? 'selected' : '' }}>
                                            {{ $child->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="border border-gray-300 p-2 flex items-center">
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
                                               class="form-submit-btn text-xs mr-1">
                                                محاسبه
                                            </a>
                                            @break
                                        @case('402')
                                            <span class="hidden">Condensor Coil</span>
                                            <a href="{{ route('calculateCoil.condensor.index',[167,$product->id]) }}"
                                               class="form-submit-btn text-xs mr-1">
                                                محاسبه
                                            </a>
                                            @break
                                        @case('404')
                                            <span class="hidden">Water Cold Coil</span>
                                            <a href="{{ route('calculateCoil.waterCold.index',[168,$product->id]) }}"
                                               class="form-submit-btn text-xs mr-1">
                                                محاسبه
                                            </a>
                                            @break
                                        @case('406')
                                            <span class="hidden">Water Warm Coil</span>
                                            <a href="{{ route('calculateCoil.waterWarm.index',[169,$product->id]) }}"
                                               class="form-submit-btn text-xs mr-1">
                                                محاسبه
                                            </a>
                                            @break
                                        @case('408')
                                            <span class="hidden">Fancoil Coil</span>
                                            <a href="{{ route('calculateCoil.fancoil.index',[170,$product->id]) }}"
                                               class="form-submit-btn text-xs mr-1">
                                                محاسبه
                                            </a>
                                            @break

                                        @case('469')
                                            <span class="hidden">Evaporator Converter</span>
                                            <a href="{{ route('calculateConverter.evaporator.index',[1194,$product->id]) }}"
                                               class="form-submit-btn text-xs mr-1">
                                                محاسبه
                                            </a>
                                            @break

                                        @case('232')
                                            <span class="hidden">Damper Raft</span>
                                            <a href="{{ route('calculateDamper.raft.index',[148,$product->id]) }}"
                                               class="form-submit-btn text-xs mr-1">
                                                محاسبه
                                            </a>
                                            @break
                                        @case('275')
                                            <span class="hidden">Damper Taze</span>
                                            <a href="{{ route('calculateDamper.taze.index',[146,$product->id]) }}"
                                               class="form-submit-btn text-xs mr-1">
                                                محاسبه
                                            </a>
                                            @break
                                        @case('276')
                                            <span class="hidden">Damper Bargasht</span>
                                            <a href="{{ route('calculateDamper.bargasht.index',[147,$product->id]) }}"
                                               class="form-submit-btn text-xs mr-1">
                                                محاسبه
                                            </a>
                                            @break
                                        @case('277')
                                            <span class="hidden">Damper Exast</span>
                                            <a href="{{ route('calculateDamper.exast.index',[149,$product->id]) }}"
                                               class="form-submit-btn text-xs mr-1">
                                                محاسبه
                                            </a>
                                            @break

                                        @case('492')
                                            <span class="hidden">Chiller Electrical</span>
                                            <a href="{{ route('calculateElectrical.chiller.index',[2144,$product->id]) }}"
                                               class="form-submit-btn text-xs mr-1">
                                                محاسبه
                                            </a>
                                            @break
                                        @case('493')
                                            <span class="hidden">Mini Chiller Electrical</span>
                                            <a href="{{ route('calculateElectrical.mini.index',[2264,$product->id]) }}"
                                               class="form-submit-btn text-xs mr-1">
                                                محاسبه
                                            </a>
                                            @break
                                        @case('494')
                                            <span class="hidden">Panel Electrical</span>
                                            <a href="{{ route('calculateElectrical.panel.index',[1879,$product->id]) }}"
                                               class="form-submit-btn text-xs mr-1">
                                                محاسبه
                                            </a>
                                            @break
                                        @case('495')
                                            <span class="hidden">Air Condition Electrical</span>
                                            <a href="{{ route('calculateElectrical.air.index',[2249,$product->id]) }}"
                                               class="form-submit-btn text-xs mr-1">
                                                محاسبه
                                            </a>
                                            @break
                                        @case('496')
                                            <span class="hidden">Zent Electrical</span>
                                            <a href="{{ route('calculateElectrical.zent.index',[2256,$product->id]) }}"
                                               class="form-submit-btn text-xs mr-1">
                                                محاسبه
                                            </a>
                                            @break
                                    @endswitch
                                @endif
                                @if($part->coil == '1' && !$part->standard && !in_array($part->id,$specials))
                                    <a href="{{ route('collections.amounts',$part->id) }}" target="_blank"
                                       class="text-xs mr-1 text-indigo-500 underline underline-offset-4 whitespace-nowrap">
                                        مشاهده جزئیات
                                    </a>
                                @endif
                            </td>
                            <td class="border border-gray-300 p-2 text-sm text-center {{ $color ?? '' }}">
                                <span id="changePriceSection{{ $part->id }}">
                                    {{ number_format($part->price) }}
                                </span>
                            </td>
                            <td class="border border-gray-300 p-2 text-sm text-center">
                                @if(is_null($part->unit2))
                                    {{ $part->unit }}
                                @else
                                    <span id="unitSection">
                                        {{ $part->unit }} / {{ $part->unit2 }}
                                    </span>
                                @endif
                            </td>
                            <td class="border border-gray-300 p-2">
                                <div class="flex items-center">
                                    <input type="text" name="amounts[]" id="inputAmount{{ $part->id }}"
                                           class="input-text w-24 {{ $amount->value == '0' ? 'border-yellow-500' : '' }}"
                                           value="{{ $amount->value }}" onkeyup="changeUnit1(event,{{ $part->id }})">
                                    @if(!is_null($part->unit2))
                                        <p class="mr-2">/</p>
                                        <input type="text" id="inputUnit{{ $part->id }}"
                                               class="input-text w-20 mr-2" placeholder="{{ $part->unit2 }}"
                                               onkeyup="changeUnit2(event,{{ $part->id }})"
                                               value="{{ $amount->value2 }}">
                                    @endif

                                    <input type="hidden" name="units[]" id="inputUnitValue{{ $part->id }}"
                                           value="{{ $amount->value2 }}">
                                    @if(!in_array($part->id,$specials))
                                        @php
                                            $parents = [];
                                        @endphp
                                        @if($color == 'text-red-500' || $color == 'text-red-600')
                                            @php
                                                $inquiryPrice = InquiryPrice::where('part_id',$part->id)->pluck('part_id')->all();
                                                $inquiryPrices = InquiryPrice::all()->pluck('part_id');
                                                    foreach ($inquiryPrices as $item) {
                                                        $inquiryPart = Part::find($item);
                                                        if (!$inquiryPart->parents->isEmpty()) {
                                                            $parents = $inquiryPart->parents->pluck('id')->toArray();
                                                        } else {
                                                            $parents = [];
                                                        }
                                                    }
                                            @endphp
                                            @if(!in_array($part->id,$inquiryPrice) && !in_array($part->id,$parents))
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
                            <td class="p-2 text-sm text-center border border-gray-300 {{ $color ?? '' }}">
                                {{ number_format($part->price * $amount->value) }}
                            </td>
                            @if(!$amounts->isEmpty())
                                <td class="border border-gray-300 p-2 text-sm text-center">
                                    <button type="button" onclick="deletePartFromAmount({{ $amount->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                        </svg>
                                    </button>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    @if(!$amounts->isEmpty())
                        <tr>
                            <td class="border border-gray-300 p-2" colspan="8">
                                <a href="{{ route('inquiries.newPart.create',$product->id) }}"
                                   class="w-8 h-8 rounded-full bg-green-500 block grid place-content-center mr-2"
                                   title="افزودن قطعه جدید">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="2" stroke="currentColor" class="w-6 h-6 text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M12 4.5v15m7.5-7.5h-15"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endif
                @endif
                </tbody>
            </table>
            @can('users')
                @if($product->percent == 0)
                    <div class="mt-4 flex justify-end space-x-2 space-x-reverse">
                        @if($showPivotPrice != 0)
                            <p class="text-base font-bold text-white bg-green-500 px-6 py-1 rounded-md">
                                قیمت : {{ number_format($showPivotPrice) }} تومان
                            </p>
                            <p class="text-base font-bold text-white bg-gray-500 px-6 py-1 rounded-md">
                                وزن دستگاه : {{ $partWeight }} کلیوگرم
                            </p>
                        @endif
                        @if($showAmountPrice != 0)
                            <p class="text-base font-bold text-white bg-green-500 px-6 py-1 rounded-md">
                                قیمت : {{ number_format($showAmountPrice) }} تومان
                            </p>
                            <p class="text-base font-bold text-white bg-gray-500 px-6 py-1 rounded-md">
                                وزن دستگاه : {{ $amountWeight }} کیلوگرم
                            </p>
                        @endif
                    </div>
                @endif
            @endcan
        </div>
        <div class="space-x-2 space-x-reverse">
            <button type="submit" class="form-submit-btn">
                ثبت مقادیر
            </button>
            <a href="{{ route('inquiries.index') }}" class="form-cancel-btn">
                انصراف (خروج)
            </a>
        </div>
    </form>
</x-layout>
