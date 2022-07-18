<x-layout>

    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script>
            let valueSection = [];
            let totalPriceSection = [];
            let inputTotalPrice = [];
            for (let i = 0; i < 12; i++) {
                valueSection[i] = document.getElementById('valueSection' + i);
                totalPriceSection[i] = document.getElementById('totalPriceSection' + i);
                inputTotalPrice[i] = document.getElementById('inputTotalPrice' + i);
            }

            function calculate() {
                let debiHavaRaft = parseFloat(document.getElementById("inputDebiHavaRaft").value);
                let soratRaft = parseFloat(document.getElementById("inputSoratRaft").value);
                let tedadPare = parseFloat(document.getElementById("inputTedadPare").value);

                let toolePareSection = document.getElementById("toolePare");
                let finalPriceSection = document.getElementById("finalPriceSection");
                let inputFinalPrice = document.getElementById('inputFinalPrice');

                //Formula
                let toolePareResult = (((debiHavaRaft / 800) / 10.7639) / tedadPare) * 1000;
                toolePareSection.innerText = toolePareResult.toFixed(1);

                let profilPareHaResult = ((tedadPare * toolePareResult) / 100);

                let profilSotoonHaResult = ((2 * (6 + (tedadPare * 10)) + 2 * (6 + toolePareResult)) / 100) * 0.85;

                let profilBalaPayinResult = (((toolePareResult * 2) + 6) / 100) * 0.85;

                let charkhDandeResult;
                if (toolePareResult <= 120) {
                    charkhDandeResult = tedadPare
                } else {
                    charkhDandeResult = tedadPare * 2;
                }

                let keshoyiRastResult = charkhDandeResult;

                let keshoyiChapResult = charkhDandeResult;

                let dastgireDamperResult;
                if (toolePareResult <= 120) {
                    dastgireDamperResult = 1;
                } else {
                    dastgireDamperResult = 2;
                }

                let kharAhaniDastgireResult = dastgireDamperResult;

                let pvcChapResult = charkhDandeResult;

                let pvcRastResult = charkhDandeResult;

                let pin4PahlooResult = charkhDandeResult * 2;

                let gerdiResult = charkhDandeResult;

                let navarHavaBandiResult = profilPareHaResult + profilSotoonHaResult;

                valueSection[0].innerText = pvcChapResult.toFixed(4);
                totalPriceSection[0].innerText = Intl.NumberFormat().format(inputTotalPrice[0].value * pvcChapResult);
                let price0 = inputTotalPrice[0].value * pvcChapResult;

                valueSection[1].innerText = pvcRastResult.toFixed(4);
                totalPriceSection[1].innerText = Intl.NumberFormat().format(inputTotalPrice[1].value * pvcRastResult);
                let price1 = inputTotalPrice[1].value * pvcRastResult;

                valueSection[2].innerText = navarHavaBandiResult.toFixed(4);
                totalPriceSection[2].innerText = Intl.NumberFormat().format(inputTotalPrice[2].value * navarHavaBandiResult);
                let price2 = inputTotalPrice[2].value * navarHavaBandiResult;

                valueSection[3].innerText = gerdiResult.toFixed(4);
                totalPriceSection[3].innerText = Intl.NumberFormat().format(inputTotalPrice[3].value * gerdiResult);
                let price3 = inputTotalPrice[3].value * gerdiResult;

                valueSection[4].innerText = pin4PahlooResult.toFixed(4);
                totalPriceSection[4].innerText = Intl.NumberFormat().format(inputTotalPrice[4].value * pin4PahlooResult);
                let price4 = inputTotalPrice[4].value * pin4PahlooResult;

                valueSection[5].innerText = dastgireDamperResult.toFixed(4);
                totalPriceSection[5].innerText = Intl.NumberFormat().format(inputTotalPrice[5].value * dastgireDamperResult);
                let price5 = inputTotalPrice[5].value * dastgireDamperResult;

                valueSection[6].innerText = keshoyiChapResult.toFixed(4);
                totalPriceSection[6].innerText = Intl.NumberFormat().format(inputTotalPrice[6].value * keshoyiChapResult);
                let price6 = inputTotalPrice[6].value * keshoyiChapResult;

                valueSection[7].innerText = keshoyiRastResult.toFixed(4);
                totalPriceSection[7].innerText = Intl.NumberFormat().format(inputTotalPrice[7].value * keshoyiRastResult);
                let price7 = inputTotalPrice[7].value * keshoyiRastResult;

                valueSection[8].innerText = charkhDandeResult.toFixed(4);
                totalPriceSection[8].innerText = Intl.NumberFormat().format(inputTotalPrice[8].value * charkhDandeResult);
                let price8 = inputTotalPrice[8].value * charkhDandeResult;

                valueSection[9].innerText = profilBalaPayinResult.toFixed(4);
                totalPriceSection[9].innerText = Intl.NumberFormat().format(inputTotalPrice[9].value * profilBalaPayinResult);
                let price9 = inputTotalPrice[9].value * profilBalaPayinResult;

                finalPrice = price0 + price1 + price2 + price3 + price4 + price5 + price6 + price7 + price8 + price9

                finalPriceSection.innerText = Intl.NumberFormat().format(finalPrice);
                inputFinalPrice.value = finalPrice;
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
            <div class="mb-4 border-b border-gray-300 pb-3 flex justify-between items-center">
                <div>
                    <p class="text-lg text-black">
                        اطلاعات ورودی {{ $part->name }}
                    </p>
                </div>
                <div>
                    <p class="bg-indigo-500 rounded-md px-6 py-2 text-sm font-bold text-white">
                        طول پره :
                        <span id="toolePare"></span>
                        سانتیمتر
                    </p>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block mb-2 text-sm font-bold" for="inputDebiHavaRaft">دبی هوای رفت</label>
                    <input type="text" class="input-text" id="inputDebiHavaRaft" onkeyup="calculate()">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-bold" for="inputSoratRaft">
                        سرعت هوا روی دمپر رفت
                    </label>
                    <input type="text" class="input-text" id="inputSoratRaft" onkeyup="calculate()"
                           value="1000">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-bold" for="inputTedadPare">
                        تعداد پره
                    </label>
                    <input type="text" class="input-text" id="inputTedadPare" onkeyup="calculate()">
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <form method="POST" action="{{ route('calculate.coil.store',$part->id) }}" class="mt-4">
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
            <a href="{{ route('inquiries.index') }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>
