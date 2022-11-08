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
        <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
        <script>
            $(".inputAmount").select2({
                tags: true
            });
        </script>
        <script>
            function showCalculateButton(id) {
                let productId = '{{ $product->id }}'
                let selectedId = document.getElementById("groupPartList" + id).value;
                let fancoilSection = document.getElementById("fancoilSection" + id);
                let warmWaterSection = document.getElementById("warmWaterSection" + id);
                let coldWaterSection = document.getElementById("coldWaterSection" + id);
                let condensorSection = document.getElementById("condensorSection" + id);
                let evaperatorSection = document.getElementById("evaperatorSection" + id);

                let damperTazeSection = document.getElementById("damperTazeSection" + id);
                let damperRaftSection = document.getElementById("damperRaftSection" + id);
                let damperBargashtSection = document.getElementById("damperBargashtSection" + id);
                let damperExastSection = document.getElementById("damperExastSection" + id);

                //Coil Fancoil
                //Coil Fancoil
                if (selectedId === '170') {
                    let fancoilRoute = "/calculate/coil/fancoil/" + 170 + "/" + productId;
                    fancoilSection.classList.remove('hidden')
                    fancoilSection.classList.add('block')
                    fancoilSection.innerHTML = `
                        <a href="${fancoilRoute}"
                           class="form-submit-btn text-xs">
                            محاسبه کویل فن کویل سقفی یا زمینی
                        </a>
                        `
                } else {
                    fancoilSection.classList.remove('block')
                    fancoilSection.classList.add('hidden')
                    fancoilSection.innerHTML = ""
                }
                //Coil Warm Water
                if (selectedId === '169') {
                    let warmWaterRoute = "/calculate/coil/water-warm/" + 169 + "/" + productId;
                    warmWaterSection.classList.remove('hidden')
                    warmWaterSection.classList.add('block')
                    warmWaterSection.innerHTML = `
                        <a href="${warmWaterRoute}"
                           class="form-submit-btn text-xs">
                            محاسبه کویل آبگرم
                        </a>
                        `
                } else {
                    warmWaterSection.classList.remove('block')
                    warmWaterSection.classList.add('hidden')
                    warmWaterSection.innerHTML = ""
                }
                //Coil Cold Water
                if (selectedId === '168') {
                    let coldWaterRoute = "/calculate/coil/water-cold/" + 168 + "/" + productId;
                    coldWaterSection.classList.remove('hidden')
                    coldWaterSection.classList.add('block')
                    coldWaterSection.innerHTML = `
                        <a href="${coldWaterRoute}"
                           class="form-submit-btn text-xs">
                            محاسبه کویل آبسرد
                        </a>
                        `
                } else {
                    coldWaterSection.classList.remove('block')
                    coldWaterSection.classList.add('hidden')
                    coldWaterSection.innerHTML = ""
                }
                //Coil Condensor
                if (selectedId === '167') {
                    let condensorRoute = "/calculate/coil/condensor/" + 167 + "/" + productId;
                    condensorSection.classList.remove('hidden')
                    condensorSection.classList.add('block')
                    condensorSection.innerHTML = `
                        <a href="${condensorRoute}"
                           class="form-submit-btn text-xs">
                            محاسبه کویل کندانسوری
                        </a>
                        `
                } else {
                    condensorSection.classList.remove('block')
                    condensorSection.classList.add('hidden')
                    condensorSection.innerHTML = ""
                }
                //Coil DX
                if (selectedId === '150') {
                    let evaperatorRoute = "/calculate/coil/evaperator/" + 150 + "/" + productId;
                    evaperatorSection.classList.remove('hidden')
                    evaperatorSection.classList.add('block')
                    evaperatorSection.innerHTML = `
                        <a href="${evaperatorRoute}"
                           class="form-submit-btn text-xs">
                            محاسبه کویل اواپراتوری DX
                        </a>
                        `
                } else {
                    evaperatorSection.classList.remove('block')
                    evaperatorSection.classList.add('hidden')
                    evaperatorSection.innerHTML = ""
                }

                //Damper Exast
                if (selectedId === '149') {
                    let damperExastRoute = "/calculate/damperExast/" + 149 + "/" + productId;
                    damperExastSection.classList.remove('hidden')
                    damperExastSection.classList.add('block')
                    damperExastSection.innerHTML = `
                        <a href="${damperExastRoute}"
                           class="form-submit-btn text-xs">
                            محاسبه دمپر اگزاست
                        </a>
                        `
                } else {
                    if (damperExastSection) {
                        damperExastSection.classList.remove('block')
                        damperExastSection.classList.add('hidden')
                        damperExastSection.innerHTML = ""
                    }
                }
                //Damper Raft
                if (selectedId === '148') {
                    let damperRaftRoute = "/calculate/damperRaft/" + 148 + "/" + productId;
                    damperRaftSection.classList.remove('hidden')
                    damperRaftSection.classList.add('block')
                    damperRaftSection.innerHTML = `
                        <a href="${damperRaftRoute}"
                           class="form-submit-btn text-xs">
                            محاسبه دمپر رفت
                        </a>
                        `
                } else {
                    if (damperRaftSection) {
                        damperRaftSection.classList.remove('block')
                        damperRaftSection.classList.add('hidden')
                        damperRaftSection.innerHTML = ""
                    }
                }
                //Damper Bargasht
                if (selectedId === '147') {
                    let damperBargashtRoute = "/calculate/damperBargasht/" + 147 + "/" + productId;
                    damperBargashtSection.classList.remove('hidden')
                    damperBargashtSection.classList.add('block')
                    damperBargashtSection.innerHTML = `
                        <a href="${damperBargashtRoute}"
                           class="form-submit-btn text-xs">
                            محاسبه دمپر برگشت
                        </a>
                        `
                } else {
                    if (damperBargashtSection) {
                        damperBargashtSection.classList.remove('block')
                        damperBargashtSection.classList.add('hidden')
                        damperBargashtSection.innerHTML = ""
                    }
                }
                //Damper Taze
                if (selectedId === '146') {
                    let damperTazeRoute = "/calculate/damperTaze/" + 146 + "/" + productId;
                    damperTazeSection.classList.remove('hidden')
                    damperTazeSection.classList.add('block')
                    damperTazeSection.innerHTML = `
                        <a href="${damperTazeRoute}"
                           class="form-submit-btn text-xs">
                            محاسبه دمپر تازه
                        </a>
                        `
                } else {
                    if (damperTazeSection) {
                        damperTazeSection.classList.remove('block')
                        damperTazeSection.classList.add('hidden')
                        damperTazeSection.innerHTML = ""
                    }
                }
            }

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
                        let value = document.getElementById('inputUnit' + cid).value;
                        let input = document.getElementById('inputAmount' + cid);
                        let inputValue = document.getElementById('inputUnitValue' + cid);

                        let operator2 = part.operator1;
                        let formula2 = part.formula1;
                        let result = 0;

                        result = eval(value + operator2 + formula2);
                        input.value = Intl.NumberFormat().format(result);
                        inputValue.value = value;
                    }
                });
            }
        </script>
        <script>
            function storeInquiryPrice(part, inquiry) {
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
                        location.reload();
                    }
                });
            }
        </script>
        <script>
            function changeBorder(event, id) {
                let value = event.target.value;
                let input = document.getElementById("inputAmount" + id);
                if (value == '0') {
                    input.classList.add('border-yellow-500');
                } else {
                    input.classList.remove('border-yellow-500');
                }
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
                        input2.value = Intl.NumberFormat().format(result);
                        inputValue.value = Intl.NumberFormat().format(result);
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
                        input1.value = Intl.NumberFormat().format(result);
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
                جزئیات محصول <span class="text-red-600">{{ $group->name }} - {{ $modell->name }}</span>
            </p>
        </div>
        <div class="flex md:justify-end space-x-2 space-x-reverse">
            <a href="{{ route('inquiries.product.index',$inquiry->id) }}" class="form-detail-btn text-xs">
                لیست محصولات استعلام
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
            <p class="font-bold text-red-600 md:text-lg text-sm text-center">
                مدل : {{ $product->model_custom_name ?? $modell->name }}
            </p>
        </div>
    </div>

    <!-- Laptop List -->
    <form method="POST" action="{{ route('inquiries.product.storeAmounts',$product->id) }}"
          class="mt-4 md:block hidden">
        @csrf
        <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4">
            <table class="border-collapse border border-gray-400 w-full">
                <thead>
                <tr>
                    <th class="border border-gray-300 p-4 text-sm">ردیف</th>
                    <th class="border border-gray-300 p-4 text-sm">دسته بندی</th>
                    <th class="border border-gray-300 p-4 text-sm">نام قطعه</th>
                    <th class="border border-gray-300 p-4 text-sm">واحد قطعه</th>
                    <th class="border border-gray-300 p-4 text-sm">مقادیر</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $showPivotPrice = 0;
                    $showAmountPrice = 0;
                @endphp
                @if($amounts->isEmpty() && !$modell->parts->isEmpty())
                    @foreach($modell->parts()->orderBy('sort','ASC')->get() as $index => $part)
                        @php
                            $showPivotPrice += $part->price * $part->pivot->value;
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
                                    $color = 'bg-red-500';
                                }
                                if ($part->price_updated_at > $lastTime && $part->price_updated_at > $midTime && $part->price > 0) {
                                    $color = 'bg-white';
                                }
                                if ($part->price_updated_at > $lastTime && $part->price_updated_at < $midTime && $part->price > 0) {
                                    $color = 'bg-yellow-500';
                                }
                                if ($part->price_updated_at < $lastTime && $part->price == 0) {
                                    $color = 'bg-red-600';
                                }
                            }

                            if (!in_array($part->id,$specials) && $part->collection == '1') {
                                foreach ($part->children as $child) {
                                    if ($child->price_updated_at < $lastTime && $child->price > 0) {
                                        $color = 'bg-red-500';
                                    }
                                    if ($child->price_updated_at < $lastTime && $child->price == 0) {
                                        $color = 'bg-red-600';
                                    }
                                }
                            }

                            $category = $part->categories[1];
                            $selectedCategory = $part->categories[2];
                        @endphp
                        <tr class="{{ $color ?? 'bg-white' }}">
                            <td class="border border-gray-300 p-4 text-sm text-center">
                                <input type="text" class="input-text w-14 text-center"
                                       value="{{ $part->pivot->sort ?? 0 }}"
                                       name="sorts[]" id="partSort{{ $part->id }}">
                            </td>
                            <td class="border border-gray-300 p-4">
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
                            <td class="border border-gray-300 p-4 text-sm text-center flex items-center">
                                @php
                                    $selectedPart = Part::find($part->id);
                                    $lastCategory = $selectedPart->categories()->latest()->first();
                                    $categoryParts = $lastCategory->parts;
                                @endphp
                                <select name="part_ids[]" class="input-text" id="groupPartList{{ $part->id }}"
                                        onchange="showCalculateButton('{{ $part->id }}'); changeFormula(event,{{ $part->id }});">
                                    @foreach($categoryParts as $part2)
                                        @if(!session()->has('selectedPart' . $part2->id))
                                            <option
                                                value="{{ $part2->id }}" {{ $part2->id == $part->id ? 'selected' : '' }}>
                                                {{ $part2->name }}
                                            </option>
                                        @else
                                            <option
                                                value="{{ $part2->id }}" {{ $part2->id == session()->get('selectedPart' . $part2->id) ? 'selected' : '' }}>
                                                {{ $part2->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @if(in_array($part->id,$specials))
                                    <div class="whitespace-nowrap mr-2">
                                        @switch($part->id)
                                            @case(150)
                                                @if(session()->has('price'.$part->id))
                                                    <span class="form-detail-btn text-xs">
                                                    محاسبه شد
                                                </span>
                                                @else
                                                    <a href="{{ route('calculateCoil.evaperator.index',[$part->id,$product->id]) }}"
                                                       class="form-submit-btn text-xs">
                                                        محاسبه {{ $part->name }}
                                                    </a>
                                                @endif
                                                @break
                                            @case(167)
                                                @if(session()->has('price'.$part->id))
                                                    <a href="#" class="form-detail-btn text-xs">
                                                        محاسبه شد
                                                    </a>
                                                @else
                                                    <a href="{{ route('calculateCoil.condensor.index',[$part->id,$product->id]) }}"
                                                       class="form-submit-btn text-xs">
                                                        محاسبه {{ $part->name }}
                                                    </a>
                                                @endif
                                                @break
                                            @case(168)
                                                @if(session()->has('price'.$part->id))
                                                    <a href="#" class="form-detail-btn text-xs">
                                                        محاسبه شد
                                                    </a>
                                                @else
                                                    <a href="{{ route('calculateCoil.waterCold.index',[$part->id,$product->id]) }}"
                                                       class="form-submit-btn text-xs">
                                                        محاسبه {{ $part->name }}
                                                    </a>
                                                @endif
                                                @break
                                            @case(169)
                                                @if(session()->has('price'.$part->id))
                                                    <a href="#" class="form-detail-btn text-xs">
                                                        محاسبه شد
                                                    </a>
                                                @else
                                                    <a href="{{ route('calculateCoil.waterWarm.index',[$part->id,$product->id]) }}"
                                                       class="form-submit-btn text-xs">
                                                        محاسبه {{ $part->name }}
                                                    </a>
                                                @endif
                                                @break
                                            @case(170)
                                                @if(session()->has('price'.$part->id))
                                                    <a href="#" class="form-detail-btn text-xs">
                                                        محاسبه شد
                                                    </a>
                                                @else
                                                    <a href="{{ route('calculateCoil.fancoil.index',[$part->id,$product->id]) }}"
                                                       class="form-submit-btn text-xs">
                                                        محاسبه {{ $part->name }}
                                                    </a>
                                                @endif
                                                @break

                                            @case(146)
                                                @if(session()->has('price'.$part->id))
                                                    <a href="#" class="form-detail-btn text-xs">
                                                        محاسبه شد
                                                    </a>
                                                @else
                                                    <a href="{{ route('calculateDamper.taze.index',[$part->id,$product->id]) }}"
                                                       class="form-submit-btn text-xs">
                                                        محاسبه {{ $part->name }}
                                                    </a>
                                                @endif
                                                @break
                                            @case(148)
                                                @if(session()->has('price'.$part->id))
                                                    <a href="#" class="form-detail-btn text-xs">
                                                        محاسبه شد
                                                    </a>
                                                @else
                                                    <a href="{{ route('calculateDamper.raft.index',[$part->id,$product->id]) }}"
                                                       class="form-submit-btn text-xs">
                                                        محاسبه {{ $part->name }}
                                                    </a>
                                                @endif
                                                @break
                                            @case(147)
                                                @if(session()->has('price'.$part->id))
                                                    <a href="#" class="form-detail-btn text-xs">
                                                        محاسبه شد
                                                    </a>
                                                @else
                                                    <a href="{{ route('calculateDamper.bargasht.index',[$part->id,$product->id]) }}"
                                                       class="form-submit-btn text-xs">
                                                        محاسبه {{ $part->name }}
                                                    </a>
                                                @endif
                                                @break
                                            @case(149)
                                                @if(session()->has('price'.$part->id))
                                                    <a href="#" class="form-detail-btn text-xs">
                                                        محاسبه شد
                                                    </a>
                                                @else
                                                    <a href="{{ route('calculateDamper.exast.index',[$part->id,$product->id]) }}"
                                                       class="form-submit-btn text-xs">
                                                        محاسبه {{ $part->name }}
                                                    </a>
                                                @endif
                                                @break
                                        @endswitch
                                    </div>
                                @endif
                                <div class="whitespace-nowrap mr-2">
                                    <div id="fancoilSection{{ $part->id }}" class="hidden">

                                    </div>
                                    <div id="warmWaterSection{{ $part->id }}" class="hidden">

                                    </div>
                                    <div id="coldWaterSection{{ $part->id }}" class="hidden">

                                    </div>
                                    <div id="condensorSection{{ $part->id }}" class="hidden">

                                    </div>
                                    <div id="evaperatorSection{{ $part->id }}" class="hidden">

                                    </div>

                                    <div id="damperTazeSection{{ $part->id }}" class="hidden">

                                    </div>
                                    <div id="damperRaftSection{{ $part->id }}" class="hidden">

                                    </div>
                                    <div id="damperBargashtSection{{ $part->id }}" class="hidden">

                                    </div>
                                    <div id="damperExastSection{{ $part->id }}" class="hidden">

                                    </div>
                                </div>
                            </td>
                            <td class="border border-gray-300 p-4 text-sm text-center">
                                @if(is_null($part->unit2))
                                    {{ $part->unit }}
                                @else
                                    {{ $part->unit }} / {{ $part->unit2 }}
                                @endif
                            </td>
                            <td class="border border-gray-300 p-4 flex items-center">
                                <input type="text" name="modellAmounts[]" id="inputAmount{{ $part->id }}"
                                       class="input-text w-20 {{ $part->pivot->value == '0' ? 'border-yellow-500' : '' }}"
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
                                    @if($color == 'bg-red-500' || $color == 'bg-red-600' || $part->price == '0')
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
                                            <button type="button"
                                                    onclick="storeInquiryPrice({{ $part->id }},{{ $inquiry->id }})"
                                                    class="text-xs font-bold text-white underline underline-offset-4 whitespace-nowrap mr-2">
                                                درخواست بروزرسانی قیمت
                                            </button>
                                        @else
                                            <p class="text-xs font-bold text-white whitespace-nowrap mr-2">
                                                درخواست ارسال شد
                                            </p>
                                        @endif
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    @foreach($amounts as $amount)
                        @php
                            $part = Part::find($amount->part_id);
                            $showAmountPrice += $part->price * $amount->value;
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
								    $color = 'bg-red-500';
                                }
                                if ($part->price_updated_at > $lastTime && $part->price_updated_at > $midTime && $part->price > 0) {
                                    $color = 'bg-white';
                                }
                                if ($part->price_updated_at > $lastTime && $part->price_updated_at < $midTime && $part->price > 0) {
                                    $color = 'bg-yellow-500';
                                }
                                if ($part->price_updated_at < $lastTime && $part->price == 0) {
                                    $color = 'bg-red-600';
                                }
                            }

                            if (!in_array($part->id,$specials) && $part->collection == '1') {
                                    foreach ($part->children as $child) {
                                        if ($child->price_updated_at < $lastTime && $child->price > 0) {
                                            $color = 'bg-red-500';
                                        }
                                        if ($child->price_updated_at < $lastTime && $child->price == 0) {
                                            $color = 'bg-red-600';
                                        }
                                    }
                                }

                            $category = $part->categories[1];
                            $selectedCategory = $part->categories[2];
                        @endphp
                        <tr class="{{ $color ?? 'bg-white' }}">
                            <td class="border border-gray-300 p-4 text-sm text-center">
                                <input type="text" class="input-text w-14 text-center" value="{{ $amount->sort ?? 0 }}"
                                       name="sorts[]" id="partSort{{ $part->id }}">
                            </td>
                            <td class="border border-gray-300 p-4">
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
                            <td class="border border-gray-300 p-4 text-sm text-center flex items-center">
                                @php
                                    $lastCategory = $part->categories()->latest()->first();
                                    $categoryParts = $lastCategory->parts;
                                @endphp
                                <select name="part_ids[]" class="input-text" id="groupPartList{{ $part->id }}"
                                        onchange="showCalculateButton('{{ $part->id }}'); changeFormula(event,{{ $part->id }});">
                                    @foreach($categoryParts as $part2)
                                        @if(!session()->has('selectedPart' . $part2->id))
                                            <option
                                                value="{{ $part2->id }}" {{ $part2->id == $part->id ? 'selected' : '' }}>
                                                {{ $part2->name }}
                                            </option>
                                        @else
                                            <option
                                                value="{{ $part2->id }}" {{ $part2->id == session()->get('selectedPart' . $part2->id) ? 'selected' : '' }}>
                                                {{ $part2->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @if(in_array($part->id,$specials))
                                    <div class="whitespace-nowrap mr-2">
                                        @switch($part->id)
                                            @case(150)
                                                @if(session()->has('price'.$part->id))
                                                    <span class="form-detail-btn text-xs">
                                                    محاسبه شد
                                                </span>
                                                @else
                                                    <a href="{{ route('calculateCoil.evaperator.index',[$part->id,$product->id]) }}"
                                                       class="form-submit-btn text-xs">
                                                        محاسبه {{ $part->name }}
                                                    </a>
                                                @endif
                                                @break
                                            @case(167)
                                                @if(session()->has('price'.$part->id))
                                                    <a href="#" class="form-detail-btn text-xs">
                                                        محاسبه شد
                                                    </a>
                                                @else
                                                    <a href="{{ route('calculateCoil.condensor.index',[$part->id,$product->id]) }}"
                                                       class="form-submit-btn text-xs">
                                                        محاسبه {{ $part->name }}
                                                    </a>
                                                @endif
                                                @break
                                            @case(168)
                                                @if(session()->has('price'.$part->id))
                                                    <a href="#" class="form-detail-btn text-xs">
                                                        محاسبه شد
                                                    </a>
                                                @else
                                                    <a href="{{ route('calculateCoil.waterCold.index',[$part->id,$product->id]) }}"
                                                       class="form-submit-btn text-xs">
                                                        محاسبه {{ $part->name }}
                                                    </a>
                                                @endif
                                                @break
                                            @case(169)
                                                @if(session()->has('price'.$part->id))
                                                    <a href="#" class="form-detail-btn text-xs">
                                                        محاسبه شد
                                                    </a>
                                                @else
                                                    <a href="{{ route('calculateCoil.waterWarm.index',[$part->id,$product->id]) }}"
                                                       class="form-submit-btn text-xs">
                                                        محاسبه {{ $part->name }}
                                                    </a>
                                                @endif
                                                @break
                                            @case(170)
                                                @if(session()->has('price'.$part->id))
                                                    <a href="#" class="form-detail-btn text-xs">
                                                        محاسبه شد
                                                    </a>
                                                @else
                                                    <a href="{{ route('calculateCoil.fancoil.index',[$part->id,$product->id]) }}"
                                                       class="form-submit-btn text-xs">
                                                        محاسبه {{ $part->name }}
                                                    </a>
                                                @endif
                                                @break

                                            @case(146)
                                                @if(session()->has('price'.$part->id))
                                                    <a href="#" class="form-detail-btn text-xs">
                                                        محاسبه شد
                                                    </a>
                                                @else
                                                    <a href="{{ route('calculateDamper.taze.index',[$part->id,$product->id]) }}"
                                                       class="form-submit-btn text-xs">
                                                        محاسبه {{ $part->name }}
                                                    </a>
                                                @endif
                                                @break
                                            @case(148)
                                                @if(session()->has('price'.$part->id))
                                                    <a href="#" class="form-detail-btn text-xs">
                                                        محاسبه شد
                                                    </a>
                                                @else
                                                    <a href="{{ route('calculateDamper.raft.index',[$part->id,$product->id]) }}"
                                                       class="form-submit-btn text-xs">
                                                        محاسبه {{ $part->name }}
                                                    </a>
                                                @endif
                                                @break
                                            @case(147)
                                                @if(session()->has('price'.$part->id))
                                                    <a href="#" class="form-detail-btn text-xs">
                                                        محاسبه شد
                                                    </a>
                                                @else
                                                    <a href="{{ route('calculateDamper.bargasht.index',[$part->id,$product->id]) }}"
                                                       class="form-submit-btn text-xs">
                                                        محاسبه {{ $part->name }}
                                                    </a>
                                                @endif
                                                @break
                                            @case(149)
                                                @if(session()->has('price'.$part->id))
                                                    <a href="#" class="form-detail-btn text-xs">
                                                        محاسبه شد
                                                    </a>
                                                @else
                                                    <a href="{{ route('calculateDamper.exast.index',[$part->id,$product->id]) }}"
                                                       class="form-submit-btn text-xs">
                                                        محاسبه {{ $part->name }}
                                                    </a>
                                                @endif
                                                @break
                                        @endswitch
                                    </div>
                                @endif
                                <div class="whitespace-nowrap mr-2">
                                    <div id="fancoilSection{{ $part->id }}" class="hidden">

                                    </div>
                                    <div id="warmWaterSection{{ $part->id }}" class="hidden">

                                    </div>
                                    <div id="coldWaterSection{{ $part->id }}" class="hidden">

                                    </div>
                                    <div id="condensorSection{{ $part->id }}" class="hidden">

                                    </div>
                                    <div id="evaperatorSection{{ $part->id }}" class="hidden">

                                    </div>
                                </div>
                            </td>
                            <td class="border border-gray-300 p-4 text-sm text-center">
                                @if(is_null($part->unit2))
                                    {{ $part->unit }}
                                @else
                                    <span id="unitSection">
                                        {{ $part->unit }} / {{ $part->unit2 }}
                                    </span>
                                @endif
                            </td>
                            <td class="border border-gray-300 p-4 flex items-center">
                                <input type="text" name="amounts[]" id="inputAmount{{ $part->id }}"
                                       class="input-text w-20 {{ $amount->value == '0' ? 'border-yellow-500' : '' }}"
                                       value="{{ $amount->value }}" onkeyup="changeUnit1(event,{{ $part->id }})">
                                @if(!is_null($part->unit2))
                                    <p class="mr-2">/</p>
                                    <input type="text" id="inputUnit{{ $part->id }}"
                                           class="input-text w-20 mr-2" placeholder="{{ $part->unit2 }}"
                                           onkeyup="changeUnit2(event,{{ $part->id }})" value="{{ $amount->value2 }}">
                                @endif
                                <input type="hidden" name="units[]" id="inputUnitValue{{ $part->id }}"
                                       value="{{ $amount->value2 }}">
                                @if(!in_array($part->id,$specials))
                                    @php
                                        $parents = [];
                                    @endphp
                                    @if($color == 'bg-red-500' || $color == 'bg-red-600')
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
                                            <button type="button"
                                                    onclick="storeInquiryPrice({{ $part->id }},{{ $inquiry->id }})"
                                                    class="text-xs font-bold text-white underline underline-offset-4 whitespace-nowrap mr-2">
                                                درخواست بروزرسانی قیمت
                                            </button>
                                        @else
                                            <p class="text-xs font-bold text-white whitespace-nowrap mr-2">
                                                درخواست ارسال شد
                                            </p>
                                        @endif
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
            @can('users')
                @if($product->percent == 0)
                    <div class="mt-4 flex justify-end">
                        @if($showPivotPrice != 0)
                            <p class="text-base font-bold text-white bg-green-500 px-6 py-1 rounded-md">
                                قیمت : {{ number_format($showPivotPrice) }} تومان
                            </p>
                        @endif
                        @if($showAmountPrice != 0)
                            <p class="text-base font-bold text-white bg-green-500 px-6 py-1 rounded-md">
                                قیمت : {{ number_format($showAmountPrice) }} تومان
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
                انصراف
            </a>
        </div>
    </form>
</x-layout>
