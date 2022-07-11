<x-layout>

    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script>
            //Value sections
            let valueSection = [];
            let totalPriceSection = [];
            let inputTotalPrice = [];
            for (let i = 0; i < 18; i++) {
                valueSection[i] = document.getElementById('valueSection' + i);
                totalPriceSection[i] = document.getElementById('totalPriceSection' + i);
                inputTotalPrice[i] = document.getElementById('inputTotalPrice' + i);
            }

            let finalPrice = 0;

            function calculate() {
                let tooleCoil = parseFloat(document.getElementById('inputTooleCoil').value);
                let tedadRadif = parseFloat(document.getElementById('inputTedadRadif').value);
                let tedadLooleDarRadif = parseFloat(document.getElementById('inputTedadLooleDarRadif').value);
                let looleMessiId = document.getElementById('inputLooleMessi').value;
                let tedadMadarLoole = parseFloat(document.getElementById('inputTedadMadarLoole').value);
                let finCoilId = document.getElementById('inputFin').value;
                let finDarInch = parseFloat(document.getElementById('inputFinDarInch').value);
                let zekhamatFrame = parseFloat(document.getElementById('inputZekhamatFrame').value);
                let tedadSoorakhPakhshKon = parseFloat(document.getElementById('inputTedadSoorakhPakhshKon').value);
                let noePoosheshZedeKhordegi = document.getElementById('inputNoePoosheshZedeKhordegi').value

                //-----------------
                sendDataLooleMessi(looleMessiId);
                sendDataFinCoil(finCoilId);
                //-----------------

                //TODO:: put if for each loole messi zekhamat
                let gamDarRadif = 32.5;
                //TODO:: put if for each loole messi zekhamat
                let gamDarErtefa = 37.5;
                //TODO: find zekhamat fin
                let zekhamatFin = 0.15;

                let looleMessiResult = (tooleCoil + 100) / 1000 * tedadRadif * tedadLooleDarRadif * 0.217;

                //TODO: put if for each coil type and change formula
                let tedadUResult = (tedadRadif * tedadLooleDarRadif) - tedadMadarLoole;

                let ertefaFinResult = tedadLooleDarRadif * 37.5;

                //TODO: check 25.4 and 10
                let tedadFinMasrafiResult = (tooleCoil / 25.4) * finDarInch + 10;

                let vaznFinAlResult = ((ertefaFinResult * (gamDarRadif * tedadRadif) * zekhamatFin) * 2.7 * tedadFinMasrafiResult) / 1000000;

                let vaznFinCuResult = ((ertefaFinResult * (gamDarRadif * tedadRadif) * zekhamatFin) * 9.78 * tedadFinMasrafiResult) / 1000000;

                let vaznFinGoldResult = vaznFinAlResult;

                //TODO: check 70
                let toolVaraghSheetResult = ertefaFinResult + 70;

                //TODO: check 130
                let arzVaraghSheetResult = (tedadRadif * gamDarRadif) + 130

                let masahatSheetResult = toolVaraghSheetResult * arzVaraghSheetResult / 1000000;

                let toolVaraghFrameResult = tooleCoil + 70;

                let arzVaraghFrameResult = arzVaraghSheetResult;

                let masahatFrameBalaPayinResult = toolVaraghFrameResult * arzVaraghFrameResult / 1000000;

                let vaznVaraghMasrafiResult = (masahatFrameBalaPayinResult + masahatSheetResult) * zekhamatFrame * 7.8 * 2;

                //TODO: check 2
                let toolCollectorResult = tedadLooleDarRadif * gamDarErtefa * 2;

                //TODO: check 150 and 2
                let toolHeaderResult = 150 * 2;

                //TODO: check 2.7 and 2
                let vaznNoghreMasrafiResult = (2.7 * tedadLooleDarRadif * tedadRadif * 2) / 1000;

                //TODO: check 2 and 4.2
                let vaznBerenjMasrafiResult = ((tedadMadarLoole * 2) * 4.2) / 1000;

                //TODO: check 2 and 0.002
                let flaksMayeMasrafiResult = ((tedadRadif * tedadLooleDarRadif * 2) + (tedadMadarLoole * 2)) * 0.002;

                //TODO: check 0.2
                let poosheshZedeKhordegiResult;
                if (noePoosheshZedeKhordegi === '1') {
                    poosheshZedeKhordegiResult = ((ertefaFinResult * tooleCoil / 1000000) * tedadRadif) * 0.2;
                } else {
                    poosheshZedeKhordegiResult = 0;
                }

                let tinerResult = poosheshZedeKhordegiResult * 2;

                //TODO: check 0.8 and 74
                let looleMesiMortabetPakhshKonResult = tedadSoorakhPakhshKon * 0.8 * 74 / 1000;

                //--------------------
                valueSection[0].innerText = tedadUResult.toFixed(4);
                totalPriceSection[0].innerText = Intl.NumberFormat().format(inputTotalPrice[0].value * tedadUResult);
                let price0 = inputTotalPrice[0].value * tedadUResult;

                valueSection[1].innerText = looleMesiMortabetPakhshKonResult.toFixed(4);
                totalPriceSection[1].innerText = Intl.NumberFormat().format(inputTotalPrice[1].value * looleMesiMortabetPakhshKonResult);
                let price1 = inputTotalPrice[1].value * looleMesiMortabetPakhshKonResult;

                valueSection[2].innerText = vaznVaraghMasrafiResult.toFixed(4);
                totalPriceSection[2].innerText = Intl.NumberFormat().format(inputTotalPrice[2].value * vaznVaraghMasrafiResult);
                let price2 = inputTotalPrice[2].value * vaznVaraghMasrafiResult;

                valueSection[4].innerText = 2;
                totalPriceSection[4].innerText = Intl.NumberFormat().format(inputTotalPrice[4].value * 2);
                let price4 = inputTotalPrice[4].value * 2;

                valueSection[5].innerText = 2;
                totalPriceSection[5].innerText = Intl.NumberFormat().format(inputTotalPrice[5].value * 2);
                let price5 = inputTotalPrice[5].value * 2;

                valueSection[6].innerText = poosheshZedeKhordegiResult.toFixed(4);
                totalPriceSection[6].innerText = Intl.NumberFormat().format(inputTotalPrice[6].value * poosheshZedeKhordegiResult);
                let price6 = inputTotalPrice[6].value * poosheshZedeKhordegiResult;

                valueSection[7].innerText = tinerResult.toFixed(4);
                totalPriceSection[7].innerText = Intl.NumberFormat().format(inputTotalPrice[7].value * tinerResult);
                let price7 = inputTotalPrice[7].value * tinerResult;

                valueSection[8].innerText = 1;
                totalPriceSection[8].innerText = Intl.NumberFormat().format(inputTotalPrice[8].value * 1);
                let price8 = inputTotalPrice[8].value * 1;

                valueSection[9].innerText = flaksMayeMasrafiResult.toFixed(4);
                totalPriceSection[9].innerText = Intl.NumberFormat().format(inputTotalPrice[9].value * flaksMayeMasrafiResult);
                let price9 = inputTotalPrice[9].value * flaksMayeMasrafiResult;

                valueSection[10].innerText = 0.2;
                totalPriceSection[10].innerText = Intl.NumberFormat().format(inputTotalPrice[10].value * 0.2);
                let price10 = inputTotalPrice[10].value * 0.2;

                valueSection[11].innerText = 1;
                totalPriceSection[11].innerText = Intl.NumberFormat().format(inputTotalPrice[11].value * 1);
                let price11 = inputTotalPrice[11].value * 1;

                valueSection[14].innerText = 20;
                totalPriceSection[14].innerText = Intl.NumberFormat().format(inputTotalPrice[14].value * 20);
                let price14 = inputTotalPrice[14].value * 20;

                valueSection[16].innerText = looleMessiResult.toFixed(4);
                totalPriceSection[16].innerText = Intl.NumberFormat().format(inputTotalPrice[16].value * looleMessiResult);
                let price16 = inputTotalPrice[16].value * looleMessiResult;

                valueSection[17].innerText = vaznFinAlResult.toFixed(4);
                totalPriceSection[17].innerText = Intl.NumberFormat().format(inputTotalPrice[17].value * vaznFinAlResult);
                let price17 = inputTotalPrice[17].value * vaznFinAlResult;

                let finalPriceSection = document.getElementById('finalPriceSection');
                let inputFinalPrice = document.getElementById('inputFinalPrice');

                finalPrice = price0 + price1 + price2 + price4 + price5 + price6 + price7 + price8 + price9
                    + price10 + price11 + price14 + price16 + price17;

                finalPriceSection.innerText = Intl.NumberFormat().format(finalPrice);
                inputFinalPrice.value = finalPrice;
            }

            function sendDataLooleMessi(id) {
                let looleMessiNameSection = document.getElementById('nameSection16');
                let looleMessiPriceSection = document.getElementById('priceSection16');
                let looleMessiUnitSection = document.getElementById('unitSection16');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('calculate.getData') }}',
                    data: {
                        id: id,
                    },
                    success: function (res) {
                        looleMessiNameSection.innerText = res.data.name;
                        looleMessiPriceSection.innerText = Intl.NumberFormat().format(res.data.price);
                        looleMessiUnitSection.innerText = res.data.unit;
                        document.getElementById('inputTotalPrice16').value = res.data.price
                    }
                });
            }

            function sendDataFinCoil(id) {
                let finCoilNameSection = document.getElementById('nameSection17');
                let finCoilPriceSection = document.getElementById('priceSection17');
                let finCoilUnitSection = document.getElementById('unitSection17');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('calculate.getData') }}',
                    data: {
                        id: id,
                    },
                    success: function (res) {
                        finCoilNameSection.innerText = res.data.name;
                        finCoilPriceSection.innerText = Intl.NumberFormat().format(res.data.price);
                        finCoilUnitSection.innerText = res.data.unit;
                        document.getElementById('inputTotalPrice17').value = res.data.price
                    }
                });
            }
        </script>
    </x-slot>

    <!-- Breadcrumb -->
    <nav class="flex bg-gray-100 p-4 rounded-md" aria-label="Breadcrumb">
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
            <li aria-current="page">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                              clip-rule="evenodd"/>
                    </svg>
                    <span class="mr-2 text-xs md:text-sm font-medium text-gray-400">
                        محاسبه قیمت کویل
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <div class="my-4">
        <div class="bg-white rounded-md shadow-md border border-gray-200 py-4 px-6">
            <div class="mb-4 border-b border-gray-300 pb-3">
                <p class="text-lg text-black">
                    اطلاعات ورودی {{ $part->name }}
                </p>
            </div>
            <div class="grid grid-cols-4 gap-4">
                <div>
                    <label class="block mb-2 text-sm font-bold" for="inputLooleMessi">لوله مسی کویل</label>
                    <select name="" id="inputLooleMessi" class="input-text" onchange="calculate()">
                        <option value="">انتخاب کنید</option>
                        <option value="{{ \App\Models\Part::where('code','5805')->first()->id }}">
                            {{ \App\Models\Part::where('code','5805')->first()->name }}
                        </option>
                        <option value="{{ \App\Models\Part::where('code','58063')->first()->id }}">
                            {{ \App\Models\Part::where('code','58063')->first()->name }}
                        </option>
                        <option value="{{ \App\Models\Part::where('code','3804')->first()->id }}">
                            {{ \App\Models\Part::where('code','3804')->first()->name }}
                        </option>
                        <option value="{{ \App\Models\Part::where('code','3805')->first()->id }}">
                            {{ \App\Models\Part::where('code','3805')->first()->name }}
                        </option>
                        <option value="{{ \App\Models\Part::where('code','38035')->first()->id }}">
                            {{ \App\Models\Part::where('code','38035')->first()->name }}
                        </option>
                    </select>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-bold" for="inputFin">فین کویل</label>
                    <select name="" id="inputFin" class="input-text" onchange="calculate()">
                        <option value="">انتخاب کنید</option>
                        <option value="{{ \App\Models\Part::where('code','130130')->first()->id }}">
                            {{ \App\Models\Part::where('code','130130')->first()->name }}
                        </option>
                        <option value="{{ \App\Models\Part::where('code','140140')->first()->id }}">
                            {{ \App\Models\Part::where('code','140140')->first()->name }}
                        </option>
                        <option value="{{ \App\Models\Part::where('code','150150')->first()->id }}">
                            {{ \App\Models\Part::where('code','150150')->first()->name }}
                        </option>
                        <option value="{{ \App\Models\Part::where('code','1301301')->first()->id }}">
                            {{ \App\Models\Part::where('code','1301301')->first()->name }}
                        </option>
                        <option value="{{ \App\Models\Part::where('code','1501501')->first()->id }}">
                            {{ \App\Models\Part::where('code','1501501')->first()->name }}
                        </option>
                        <option value="{{ \App\Models\Part::where('code','1001001')->first()->id }}">
                            {{ \App\Models\Part::where('code','1001001')->first()->name }}
                        </option>
                    </select>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-bold" for="inputTedadRadif">تعداد ردیف کویل</label>
                    <select name="" id="inputTedadRadif" class="input-text" onchange="calculate()">
                        <option value="">انتخاب کنید</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="6">6</option>
                        <option value="8">8</option>
                    </select>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-bold" for="inputFinDarInch">فین در اینچ</label>
                    <select name="" id="inputFinDarInch" class="input-text" onchange="calculate()">
                        <option value="">انتخاب کنید</option>
                        <option value="8">8</option>
                        <option value="10">10</option>
                        <option value="12">12</option>
                        <option value="14">14</option>
                    </select>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-bold" for="inputKham">خم کویل</label>
                    <select name="" id="inputKham" class="input-text">
                        <option value="">انتخاب کنید</option>
                        <option value="0">ندارد</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-bold" for="inputTedadMadar">تعداد مدار کویل</label>
                    <select name="" id="inputTedadMadar" class="input-text">
                        <option value="">انتخاب کنید</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="6">6</option>
                        <option value="8">8</option>
                    </select>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-bold" for="inputZekhamatFrame">ضخامت فریم کویل</label>
                    <select name="" id="inputZekhamatFrame" class="input-text" onchange="calculate()">
                        <option value="">انتخاب کنید</option>
                        <option value="1">ورق گالوانیزه به ضخامت 1 میلیمتر</option>
                        <option value="1.25">ورق گالوانیزه به ضخامت 1.25 میلیمتر</option>
                        <option value="1.5">ورق گالوانیزه به ضخامت 1.5 میلیمتر</option>
                        <option value="2">ورق گالوانیزه به ضخامت 2 میلیمتر</option>
                        <option value="2.5">ورق گالوانیزه به ضخامت 2.5 میلیمتر</option>
                        <option value="3">ورق گالوانیزه به ضخامت 3 میلیمتر</option>
                        <option value="4">ورق گالوانیزه به ضخامت 4 میلیمتر</option>
                    </select>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-bold" for="inputNoePoosheshZedeKhordegi">نوع پوشش ضد
                        خوردگی</label>
                    <select name="" id="inputNoePoosheshZedeKhordegi" class="input-text" onchange="calculate()">
                        <option value="">انتخاب کنید</option>
                        <option value="0">ندارد</option>
                        <option value="1">هرسایت</option>
                    </select>
                </div>

                <div class="col-span-2">
                    <label class="block mb-2 text-sm font-bold" for="inputCollectorAhani">هدر و کلکتور آهنی</label>
                    <select name="" id="inputCollectorAhani" class="input-text">
                        <option value="">انتخاب کنید</option>
                        <option value="0">کلکتور آهنی سایز 1 اینچ</option>
                        <option value="1">کلکتور آهنی سایز 1/4-1 اینچ</option>
                        <option value="2">کلکتور آهنی سایز 1/2-1 اینچ</option>
                        <option value="3">کلکتور آهنی سایز 2 اینچ</option>
                        <option value="4">کلکتور آهنی سایز 1/2-2 اینچ</option>
                        <option value="5">کلکتور آهنی سایز 3 اینچ</option>
                        <option value="6">کلکتور آهنی سایز 4 اینچ</option>
                    </select>
                </div>

                <div class="col-span-2">
                    <label class="block mb-2 text-sm font-bold" for="inputCollectorMessi">هدر و کلکتور مسی</label>
                    <select name="" id="inputCollectorMessi" class="input-text">
                        <option value="">انتخاب کنید</option>
                        <option value="0">کلکتور مسی سایز 3/8 اینچ</option>
                        <option value="1">کلکتور مسی سایز 1/2 اینچ</option>
                        <option value="2">کلکتور مسی سایز 5/8 اینچ</option>
                        <option value="3">کلکتور مسی سایز 7/8 اینچ</option>
                        <option value="4">کلکتور مسی سایز 1/8-1 اینچ</option>
                        <option value="5">کلکتور مسی سایز 3/8-1 اینچ</option>
                        <option value="6">کلکتور مسی سایز 5/8-1 اینچ</option>
                        <option value="7">کلکتور مسی سایز 1/8-2 اینچ</option>
                        <option value="8">کلکتور مسی سایز 5/8-2 اینچ</option>
                        <option value="9">کلکتور مسی سایز 1/8-3 اینچ</option>
                        <option value="10">کلکتور مسی سایز 5/8-3 اینچ</option>
                        <option value="11">کلکتور مسی سایز 1/8-4 اینچ</option>
                    </select>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-bold" for="inputTooleCoil">طول کویل (اینچ)</label>
                    <input type="text" class="input-text" id="inputTooleCoil" value="0" onkeyup="calculate()">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-bold" for="inputTedadLooleDarRadif">تعداد لوله در ردیف</label>
                    <input type="text" class="input-text" id="inputTedadLooleDarRadif" value="0" onkeyup="calculate()">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-bold" for="inputTedadMogheyiatLooleDarRadif">
                        تعداد موقعیت یک لوله در ردیف
                    </label>
                    <input type="text" class="input-text" id="inputTedadMogheyiatLooleDarRadif">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-bold" for="inputTedadMadarLoole">تعداد مدار لوله</label>
                    <input type="text" class="input-text" id="inputTedadMadarLoole" value="0" onkeyup="calculate()">
                </div>

                <div class="col-span-4">
                    <label class="block mb-2 text-sm font-bold" for="inputTedadSoorakhPakhshKon">
                        تعداد سوراخ پخش کن
                    </label>
                    <input type="text" class="input-text" id="inputTedadSoorakhPakhshKon" value="0"
                           onkeyup="calculate()">
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <form method="POST" action="{{ route('calculate.store',$part->id) }}" class="mt-4">
        @csrf

        <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4">
            <table class="border-collapse border border-gray-400 w-full">
                <thead class="sticky top-1 bg-gray-200 z-50 shadow-md">
                <tr>
                    <th class="border border-gray-300 p-4 text-sm">ردیف</th>
                    <th class="border border-gray-300 p-4 text-sm">شرح</th>
                    <th class="border border-gray-300 p-4 text-sm">مقدار / سایز</th>
                    <th class="border border-gray-300 p-4 text-sm">واحد</th>
                    <th class="border border-gray-300 p-4 text-sm">قیمت واحد</th>
                    <th class="border border-gray-300 p-4 text-sm">قیمت کل</th>
                </tr>
                </thead>
                <tbody>
                @foreach($part->children as $index => $child)
                    <tr>
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            {{ $loop->index + 1 }}
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center" id="nameSection{{ $index }}">
                            {{ $child->name }}
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center" id="valueSection{{ $index }}">
                            0
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center" id="unitSection{{ $index }}">
                            {{ $child->unit }}
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            <span id="priceSection{{ $index }}">{{ number_format($child->price) }}</span>
                            <input type="hidden" name="" id="inputTotalPrice{{ $index }}" value="{{ $child->price }}">
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center" id="totalPriceSection{{ $index }}">

                        </td>
                    </tr>
                @endforeach

                <tr>
                    <td class="border border-gray-300 p-4 text-lg font-bold text-center" colspan="4">
                        قیمت نهایی
                    </td>
                    <td class="border border-gray-300 p-4 text-lg font-bold text-center text-green-600" colspan="2">
                        <span id="finalPriceSection"></span>
                        <input type="hidden" name="final_price" id="inputFinalPrice">
                    </td>
                </tr>

                </tbody>
            </table>
        </div>

        <div class="space-x-2 space-x-reverse">
            <button type="submit" class="form-submit-btn">
                ثبت مقادیر
            </button>
            <a href="#" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>
