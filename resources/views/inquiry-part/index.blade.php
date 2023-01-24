<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script>
            $(".multiPercentBtn").on('click', function () {
                let ids = [];
                let percent = $("#inputPercent").val();
                $(".checkboxes:checked").each(function () {
                    ids.push($(this).val());
                });

                if (ids.length <= 0) {
                    alert("لطفا موارد مورد نظر را انتخاب کنید")
                } else {
                    $.ajax({
                        url: '{{ route('inquiries.parts.multiPercent') }}',
                        type: 'POST',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {
                            ids: ids,
                            percent: percent
                        },
                        success: function () {
                            alert("محصولات مورد نظر با موفقیت ضریب گذاری شدند");
                            location.reload();
                        }
                    });
                }
            });
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
                    success: function (res) {
                        successUpdatePrice.classList.remove('hidden');
                        updatePriceBtn.classList.add('hidden');
                    }
                });
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
                        let value = document.getElementById('inputUnit' + cid).value;
                        let input = document.getElementById('inputAmount' + cid);
                        let inputValue = document.getElementById('inputUnitValue' + cid);

                        let operator2 = part.operator1;
                        let formula2 = part.formula1;
                        let result = 0;

                        result = eval(value + operator2 + formula2);
                        let formatResult = Intl.NumberFormat().format(result);
                        input.value = formatResult.replace(',', '');
                        inputValue.value = result;
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
                        let input1 = document.getElementById('inputQuantity' + cid);
                        let inputValue = document.getElementById('inputUnitValue' + cid);
                        let operator2 = part.operator1;
                        let formula2 = part.formula1;
                        let result = 0;

                        result = eval(value + operator2 + formula2);
                        let formatResult = Intl.NumberFormat().format(result);
                        input1.value = formatResult.replace(',', '');
                        inputValue.value = result;
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
        <script>
            function deletePartFromInquiry(inquiry, part) {
                if (confirm('قطعه حذف شود ؟')) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'DELETE',
                        url: '/inquiries/' + inquiry + '/' + part + '/destroy-part',
                        success: function () {
                            location.reload();
                        }
                    });
                }
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
                        لیست قطعات استعلام {{ $inquiry->name }} - {{ $inquiry->inquiry_number }}
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Navigation Btn -->
    <div class="mt-4 md:flex justify-between items-center">
        <div class="mb-4 md:mb-0">
            <p class="text-lg text-black font-bold">
                لیست قطعات استعلام {{ $inquiry->name }}
            </p>
        </div>
        <div class="space-x-2 space-x-reverse flex items-center">
            <div x-data="{open:false}">
                <button type="button" class="form-edit-btn text-xs" @click="open = !open">
                    افزودن کویل جدید به استعلام
                </button>
                <div class="relative z-10" x-show="open" x-cloak>
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                    <div class="fixed z-10 inset-0 overflow-y-auto">
                        <div
                            class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">
                            <form method="POST" action="{{ route('inquiryPart.coil.index',$inquiry->id) }}"
                                  class="relative bg-white rounded-lg text-right overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-lg sm:w-full">
                                @csrf
                                <div class="bg-white p-4">
                                    <div class="mt-3 text-center sm:mt-0 sm:text-right">
                                        <h3 class="text-lg font-medium text-gray-900 border-b border-gray-300 pb-3">
                                            محاسبه کویل جدید
                                        </h3>
                                        <div class="mt-4">
                                            <label class="block mb-2 text-sm font-bold" for="inputCoilType">
                                                انتخاب نوع کویل
                                            </label>
                                            <select name="coil_type" id="inputCoilType" class="input-text">
                                                <option value="">انتخاب کنید</option>
                                                <option value="fancoil">
                                                    کویل {{ \App\Models\Part::select('name')->where('id','170')->first()->name }}
                                                </option>
                                                <option value="warm">
                                                    کویل {{ \App\Models\Part::select('name')->where('id','169')->first()->name }}
                                                </option>
                                                <option value="cold">
                                                    کویل {{ \App\Models\Part::select('name')->where('id','168')->first()->name }}
                                                </option>
                                                <option value="condensor">
                                                    کویل {{ \App\Models\Part::select('name')->where('id','167')->first()->name }}
                                                </option>
                                                <option value="evaperator">
                                                    کویل {{ \App\Models\Part::select('name')->where('id','150')->first()->name }}
                                                </option>
                                                <option value="air">
                                                    {{ \App\Models\Part::select('name')->where('id','2249')->first()->name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-100 px-4 py-2">
                                    <button type="submit" class="form-submit-btn">
                                        ثبت
                                    </button>
                                    <button type="button" class="form-cancel-btn"
                                            @click="open = !open">
                                        انصراف
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div x-data="{open:false}">
                <button type="button" class="form-edit-btn text-xs" @click="open = !open">
                    افزودن تابلو محلی جدید به استعلام
                </button>
                <div class="relative z-10" x-show="open" x-cloak>
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                    <div class="fixed z-10 inset-0 overflow-y-auto">
                        <div
                            class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">
                            <form method="POST" action="{{ route('inquiryPart.electrical.index',$inquiry->id) }}"
                                  class="relative bg-white rounded-lg text-right overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-lg sm:w-full">
                                @csrf
                                <div class="bg-white p-4">
                                    <div class="mt-3 text-center sm:mt-0 sm:text-right">
                                        <h3 class="text-lg font-medium text-gray-900 border-b border-gray-300 pb-3">
                                            محاسبه تابلو محلی جدید
                                        </h3>
                                        <div class="mt-4">
                                            <label class="block mb-2 text-sm font-bold" for="inputElectricalType">
                                                انتخاب نوع تابلو محلی
                                            </label>
                                            <select name="electrical_type" id="inputElectricalType" class="input-text">
                                                <option value="">انتخاب کنید</option>
                                                <option value="air">
                                                    {{ \App\Models\Part::select('name')->where('id','2249')->first()->name }}
                                                </option>
                                                <option value="chiller">
                                                    {{ \App\Models\Part::select('name')->where('id','2144')->first()->name }}
                                                </option>
                                                <option value="panel">
                                                    {{ \App\Models\Part::select('name')->where('id','1879')->first()->name }}
                                                </option>
                                                <option value="zent">
                                                    {{ \App\Models\Part::select('name')->where('id','2256')->first()->name }}
                                                </option>
                                                <option value="mini">
                                                    {{ \App\Models\Part::select('name')->where('id','2264')->first()->name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-100 px-4 py-2">
                                    <button type="submit" class="form-submit-btn">
                                        ثبت
                                    </button>
                                    <button type="button" class="form-cancel-btn"
                                            @click="open = !open">
                                        انصراف
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div x-data="{open:false}">
                <button type="button" class="form-edit-btn text-xs" @click="open = !open">
                    افزودن دمپر جدید به استعلام
                </button>
                <div class="relative z-10" x-show="open" x-cloak>
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                    <div class="fixed z-10 inset-0 overflow-y-auto">
                        <div
                            class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">
                            <form method="POST" action="{{ route('inquiryPart.damper.index',$inquiry->id) }}"
                                  class="relative bg-white rounded-lg text-right overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-lg sm:w-full">
                                @csrf
                                <div class="bg-white p-4">
                                    <div class="mt-3 text-center sm:mt-0 sm:text-right">
                                        <h3 class="text-lg font-medium text-gray-900 border-b border-gray-300 pb-3">
                                            محاسبه دمپر جدید
                                        </h3>
                                        <div class="mt-4">
                                            <label class="block mb-2 text-sm font-bold" for="inputElectricalType">
                                                انتخاب نوع دمپر
                                            </label>
                                            <select name="damper_type" id="inputElectricalType" class="input-text">
                                                <option value="">انتخاب کنید</option>
                                                <option value="taze">
                                                    {{ \App\Models\Part::select('name')->where('id','146')->first()->name }}
                                                </option>
                                                <option value="bargasht">
                                                    {{ \App\Models\Part::select('name')->where('id','147')->first()->name }}
                                                </option>
                                                <option value="raft">
                                                    {{ \App\Models\Part::select('name')->where('id','148')->first()->name }}
                                                </option>
                                                <option value="exast">
                                                    {{ \App\Models\Part::select('name')->where('id','149')->first()->name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-100 px-4 py-2">
                                    <button type="submit" class="form-submit-btn">
                                        ثبت
                                    </button>
                                    <button type="button" class="form-cancel-btn"
                                            @click="open = !open">
                                        انصراف
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-errors/>

    @if(!is_null($inquiry->correction_id) || !is_null($inquiry->copy_id))
        @can('users')
            <div class="my-4 bg-red-500 p-2 rounded-md">
                @if(!is_null($inquiry->correction_id))
                    @php
                        $correctionInquiry = \App\Models\Inquiry::find($inquiry->correction_id)
                    @endphp
                    <p class="text-sm font-bold text-white">
                        توجه : این استعلام، درخواست اصلاح استعلام {{ $inquiry->name }} - {{ $inquiry->inquiry_number }}
                        است.
                    </p>
                @endif
                @if(!is_null($inquiry->copy_id))
                    @php
                        $correctionInquiry = \App\Models\Inquiry::find($inquiry->correction_id)
                    @endphp
                    <p class="text-sm font-bold text-white">
                        توجه : این استعلام، کپی شده از استعلام {{ $inquiry->name }} - {{ $inquiry->inquiry_number }}
                        است.
                    </p>
                @endif
            </div>
        @endcan
    @endif

    <!-- Content -->
    <div class="mt-4">
        <!-- Laptop List -->
        <form action="{{ route('inquiries.parts.storeAmounts',$inquiry->id) }}" method="POST">
            @csrf

            <div class="bg-white shadow overflow-x-auto rounded-lg hidden md:block">
                <table class="min-w-full">
                    <thead>
                    <tr class="bg-sky-200">
                        @if($inquiry->submit == '1')
                            <th scope="col"
                                class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                                #
                            </th>
                        @endif
                        <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                            Sort
                        </th>
                        <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                            دسته بندی
                        </th>
                        <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                            نام قطعه
                        </th>
                        <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                            تگ
                        </th>
                        <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                            قیمت واحد
                        </th>
                        <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                            واحد
                        </th>
                        <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                            تعداد
                        </th>
                        <th scope="col" class="relative px-4 py-3 rounded-l-md">
                            <span class="sr-only">اقدامات</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $color = '';
                        $totalPrice = 0;
                    @endphp
                    @foreach($inquiry->products()->where('part_id','!=',0)->orderBy('sort','ASC')->get() as $product)
                        @php
                            $part = \App\Models\Part::find($product->part_id);
                            $totalPrice += $part->price * $product->quantity;

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

                            if ($part->updated_at < $lastTime && $part->price > 0) {
                                $color = 'bg-red-500';
                            }
                            if ($part->updated_at > $lastTime && $part->updated_at < $midTime && $part->price > 0) {
                                $color = 'bg-yellow-500';
                            }
                            if ($part->updated_at < $lastTime && $part->price == 0) {
                                $color = 'bg-red-600';
                            }

                            $category = $part->categories[1];
                            $selectedCategory = $part->categories[2];
                        @endphp
                        <tr>
                            @if($inquiry->submit == '1')
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <input type="checkbox" value="{{ $product->id }}"
                                           class="checkboxes w-4 h-4 accent-blue-600 bg-gray-200 rounded border border-gray-300 focus:ring-blue-500 focus:ring-2 focus:ring-offset-1 mx-auto block">
                                </td>
                            @endif
                            <td class="px-4 py-3 whitespace-nowrap">
                                <p class="text-sm text-gray-600 text-center">{{ $product->sort }}</p>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
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
                            <td class="px-4 py-3 flex items-center {{ $color ?? 'bg-white' }}">
                                @php
                                    $selectedPart = \App\Models\Part::find($part->id);
                                    $lastCategory = $selectedPart->categories()->latest()->first();
                                    if ((in_array($part->id,$specials) && !$part->standard) || ($part->coil && !$part->standard)) {
                                        $categoryParts = $lastCategory->parts()->where('inquiry_id',$inquiry->id)->get();
                                        if ($categoryParts->isEmpty()) {
                                            $categoryParts[] = $lastCategory->parts()->first();
                                        }
                                    } else {
                                        $categoryParts = $lastCategory->parts;
                                    }
                                @endphp
                                <select name="part_ids[]" class="input-text" id="groupPartList{{ $part->id }}"
                                        onchange="showCalculateButton('{{ $part->id }}'); changeFormula(event,{{ $part->id }});">
                                    @foreach($categoryParts as $part2)
                                        <option
                                            value="{{ $part2->id }}" {{ $part2->id == $part->id ? 'selected' : '' }}>
                                            {{ $part2->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if($part->coil == '1' && !$part->standard && !in_array($part->id,$specials))
                                    <a href="{{ route('collections.amounts',$part->id) }}" target="_blank"
                                       class="text-xs mr-1 text-indigo-500 underline underline-offset-4 whitespace-nowrap">
                                        مشاهده جزئیات
                                    </a>
                                @endif
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <input type="text" name="tags[]" class="input-text" value="{{ $product->description }}"
                                       placeholder="تگ قطعه">
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <p class="text-sm text-black text-center">
                                    {{ number_format($part->price) }}
                                </p>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <p class="text-sm text-black text-center">
                                    {{ $part->unit }}
                                    @if(!is_null($part->unit2))
                                        / {{ $part->unit2 }}
                                    @endif
                                </p>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <input type="text" class="input-text w-20 text-center" value="{{ $product->quantity }}"
                                       name="quantities[]"
                                       id="inputQuantity{{ $part->id }}" onkeyup="changeUnit1(event,'{{ $part->id }}')">
                                @if(!is_null($part->unit2))
                                    <input type="text" class="input-text w-20 text-center"
                                           placeholder="{{ $part->unit2 }}"
                                           id="inputUnit{{ $part->id }}" onkeyup="changeUnit2(event,'{{ $part->id }}')"
                                           value="{{ $product->quantity2 }}">
                                @endif
                                <input type="hidden" id="inputUnitValue{{ $part->id }}"
                                       value="{{ $product->quantity2 }}"
                                       name="quantities2[]">
                            </td>
                            <td class="px-4 py-3 space-x-3 space-x-reverse whitespace-nowrap">
                                @can('percent-inquiry')
                                    @if($inquiry->submit)
                                        <a href="{{ route('inquiries.product.percent',$product->id) }}"
                                           class="form-percent-btn text-xs">
                                            ثبت ضریب
                                        </a>
                                    @endif
                                @endcan
                                <button type="button"
                                        onclick="deletePartFromInquiry('{{ $inquiry->id }}','{{ $part->id }}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                    </svg>
                                </button>
                                @if($product->percent > 0)
                                    <p class="text-sm font-bold text-green-600 inline">
                                        ضریب ثبت شده
                                    </p>
                                @endif
                                @php
                                    $parents = [];
                                @endphp
                                @if($color == 'bg-red-500' || $color == 'bg-red-600')
                                    @php
                                        $inquiryPrice = \App\Models\InquiryPrice::where('part_id',$part->id)->pluck('part_id')->all();
                                        $inquiryPrices = \App\Models\InquiryPrice::all()->pluck('part_id');
                                        foreach ($inquiryPrices as $item) {
                                            $inquiryPart = \App\Models\Part::find($item);
                                            if (!$inquiryPart->parents->isEmpty()) {
                                                $parents = $inquiryPart->parents->pluck('id')->toArray();
                                            }
                                        }
                                    @endphp
                                    @if(!in_array($part->id,$inquiryPrice) && !in_array($part->id,$parents))
                                        <button type="button" id="updatePriceBtn{{ $part->id }}"
                                                onclick="storeInquiryPrice({{ $part->id }},{{ $inquiry->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                 title="ارسال درخواست بروزرسانی قیمت"
                                                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                 class="w-6 h-6 text-red-500">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286zm0 13.036h.008v.008H12v-.008z"/>
                                            </svg>
                                        </button>
                                    @else
                                        <p class="inline">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                 class="w-6 h-6 text-red-500 inline">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </p>
                                    @endif
                                    <p class="inline hidden" id="successUpdatePrice{{ $part->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                             class="w-6 h-6 text-red-500 inline">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </p>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="flex justify-between items-center p-4">
                    <div>
                        <a href="{{ route('inquiries.parts.create',$inquiry->id) }}"
                           class="w-8 h-8 rounded-full bg-green-500 block grid place-content-center"
                           title="افزودن قطعه جدید">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                 stroke="currentColor" class="w-6 h-6 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                            </svg>
                        </a>
                    </div>
                    @can('users')
                        <div>
                            <p class="px-4 py-2 rounded-md bg-green-500 text-white text-sm font-bold">
                                قیمت کل : {{ number_format($totalPrice) }} تومان
                            </p>
                        </div>
                    @endcan
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="form-submit-btn">
                    ثبت مقادیر
                </button>
            </div>
        </form>

        @if($inquiry->submit)
            <div class="my-4" x-data="{open:false}">
                <button type="button" class="form-edit-btn" @click="open=!open">
                    ثبت ضریب چندتایی
                </button>
                <div class="relative z-50" x-show="open" x-cloak>
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                    <div class="fixed z-10 inset-0 overflow-y-auto">
                        <div
                            class="flex items-center justify-center min-h-full p-4 text-center">
                            <div
                                class="relative bg-white rounded-lg text-right overflow-hidden shadow-xl transform transition-all my-8 md:max-w-lg w-full">
                                <div class="bg-white p-4">
                                    <div class="mt-3 text-center sm:mt-0 sm:text-right">
                                        <h3 class="text-lg font-medium text-gray-900 border-b border-gray-300 pb-3">
                                            ثبت ضریب محصولات
                                        </h3>
                                        <div class="mt-4">
                                            <label class="block mb-2 text-sm font-bold" for="inputQuantity">
                                                ضریب
                                            </label>
                                            <input type="text" class="input-text" name="percent" id="inputPercent"
                                                   placeholder="بین 1 تا 2">
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-100 px-4 py-2">
                                    <button type="button" class="form-submit-btn multiPercentBtn">
                                        ثبت
                                    </button>
                                    <button type="button" class="form-cancel-btn"
                                            @click="open = !open">
                                        انصراف
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-layout>
