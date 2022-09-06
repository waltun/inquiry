<x-layout>
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

    @php
        $values = Session::get('values');
        $selectedParts = Session::get('selectedParts');
        $inputs = Session::get('inputs');
        $satheCoil = Session::get('satheCoil');
    @endphp

    <form method="POST" action="{{ route('calculateWarmCoil') }}">
        @csrf
        <div class="my-4">
            <div class="bg-white rounded-md shadow-md border border-gray-200 py-4 px-6">
                <div class="mb-4 border-b border-gray-300 pb-3 flex justify-between items-center">
                    <div>
                        <p class="text-lg text-black">
                            اطلاعات ورودی {{ $part->name }}
                        </p>
                    </div>
                    <div class="flex items-center space-x-4 space-x-reverse">
                        <p class="bg-indigo-500 rounded-md px-6 py-2 text-sm font-bold text-white">
                            سطح کویل :
                            <span id="satheCoil">0.00</span>
                        </p>
                        <p class="bg-green-500 rounded-md px-6 py-2 text-sm font-bold text-white">
                            قیمت نهایی :
                            <span id="finalPriceTopSection">0</span>
                            تومان
                        </p>
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-4">
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputLooleMessi">لوله مسی کویل</label>
                        <select name="loole_messi" id="inputLooleMessi" class="input-text bg-yellow-300">
                            <option value="">انتخاب کنید</option>
                            <option value="{{ \App\Models\Part::where('id','53')->first()->id }}">
                                {{ \App\Models\Part::where('id','53')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','54')->first()->id }}">
                                {{ \App\Models\Part::where('id','54')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','55')->first()->id }}">
                                {{ \App\Models\Part::where('id','55')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','56')->first()->id }}">
                                {{ \App\Models\Part::where('id','56')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','57')->first()->id }}">
                                {{ \App\Models\Part::where('id','57')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','58')->first()->id }}">
                                {{ \App\Models\Part::where('id','58')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','59')->first()->id }}">
                                {{ \App\Models\Part::where('id','59')->first()->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputFin">فین کویل</label>
                        <select name="fin_coil" id="inputFin" class="input-text bg-yellow-300">
                            <option value="">انتخاب کنید</option>
                            <option value="{{ \App\Models\Part::where('id','60')->first()->id }}">
                                {{ \App\Models\Part::where('id','60')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','61')->first()->id }}">
                                {{ \App\Models\Part::where('id','61')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','62')->first()->id }}">
                                {{ \App\Models\Part::where('id','62')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','63')->first()->id }}">
                                {{ \App\Models\Part::where('id','63')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','64')->first()->id }}">
                                {{ \App\Models\Part::where('id','64')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','65')->first()->id }}">
                                {{ \App\Models\Part::where('id','65')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','66')->first()->id }}">
                                {{ \App\Models\Part::where('id','66')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','67')->first()->id }}">
                                {{ \App\Models\Part::where('id','67')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','68')->first()->id }}">
                                {{ \App\Models\Part::where('id','68')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','69')->first()->id }}">
                                {{ \App\Models\Part::where('id','69')->first()->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTedadRadif">تعداد ردیف کویل</label>
                        <select name="tedad_radif_coil" id="inputTedadRadif" class="input-text bg-yellow-300">
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
                        <select name="fin_dar_inch" id="inputFinDarInch" class="input-text bg-yellow-300">
                            <option value="">انتخاب کنید</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputKham">خم کویل</label>
                        <select name="kham" id="inputKham" class="input-text bg-yellow-300">
                            <option value="0">ندارد</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label class="block mb-2 text-sm font-bold" for="inputZekhamatFrame">ضخامت فریم کویل</label>
                        <select name="zekhamat_frame_coil" id="inputZekhamatFrame" class="input-text bg-yellow-300">
                            <option value="">انتخاب کنید</option>
                            <option value="{{ \App\Models\Part::where('id','1')->first()->id }}">
                                {{ \App\Models\Part::where('id','1')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','2')->first()->id }}">
                                {{ \App\Models\Part::where('id','2')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','3')->first()->id }}">
                                {{ \App\Models\Part::where('id','3')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','4')->first()->id }}">
                                {{ \App\Models\Part::where('id','4')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','5')->first()->id }}">
                                {{ \App\Models\Part::where('id','5')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','7')->first()->id }}">
                                {{ \App\Models\Part::where('id','7')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','8')->first()->id }}">
                                {{ \App\Models\Part::where('id','8')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','9')->first()->id }}">
                                {{ \App\Models\Part::where('id','9')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','10')->first()->id }}">
                                {{ \App\Models\Part::where('id','10')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','11')->first()->id }}">
                                {{ \App\Models\Part::where('id','11')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','12')->first()->id }}">
                                {{ \App\Models\Part::where('id','12')->first()->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputNoePoosheshZedeKhordegi">
                            نوع پوشش ضد خوردگی
                        </label>
                        <select name="pooshesh_khordegi" id="inputNoePoosheshZedeKhordegi"
                                class="input-text bg-yellow-300">
                            <option value="0">ندارد</option>
                            <option value="1">هرسایت</option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label class="block mb-2 text-sm font-bold" for="inputCollectorAhani">هدر و کلکتور آهنی</label>
                        <select name="collector_ahani" id="inputCollectorAhani" class="input-text bg-yellow-300">
                            <option value="0">ندارد</option>
                            <option value="{{ \App\Models\Part::where('id','70')->first()->id }}">
                                {{ \App\Models\Part::where('id','70')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','71')->first()->id }}">
                                {{ \App\Models\Part::where('id','71')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','72')->first()->id }}">
                                {{ \App\Models\Part::where('id','72')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','73')->first()->id }}">
                                {{ \App\Models\Part::where('id','73')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','74')->first()->id }}">
                                {{ \App\Models\Part::where('id','74')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','75')->first()->id }}">
                                {{ \App\Models\Part::where('id','75')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','76')->first()->id }}">
                                {{ \App\Models\Part::where('id','76')->first()->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputCollectorMessi">هدر و کلکتور مسی</label>
                        <select name="collector_messi" id="inputCollectorMessi" class="input-text bg-yellow-300">
                            <option value="0">ندارد</option>
                            <option value="{{ \App\Models\Part::where('id','77')->first()->id }}">
                                {{ \App\Models\Part::where('id','77')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','78')->first()->id }}">
                                {{ \App\Models\Part::where('id','78')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','79')->first()->id }}">
                                {{ \App\Models\Part::where('id','79')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','80')->first()->id }}">
                                {{ \App\Models\Part::where('id','80')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','81')->first()->id }}">
                                {{ \App\Models\Part::where('id','81')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','82')->first()->id }}">
                                {{ \App\Models\Part::where('id','82')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','83')->first()->id }}">
                                {{ \App\Models\Part::where('id','83')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','84')->first()->id }}">
                                {{ \App\Models\Part::where('id','84')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','85')->first()->id }}">
                                {{ \App\Models\Part::where('id','85')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','86')->first()->id }}">
                                {{ \App\Models\Part::where('id','86')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','87')->first()->id }}">
                                {{ \App\Models\Part::where('id','87')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','88')->first()->id }}">
                                {{ \App\Models\Part::where('id','88')->first()->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputElectrodNoghre">
                            الکترود نقره
                        </label>
                        <select name="electrod_noghre" id="inputElectrodNoghre" class="input-text bg-yellow-300">
                            <option value="">
                                انتخاب کنید
                            </option>
                            <option value="{{ \App\Models\Part::where('id','104')->first()->id }}">
                                {{ \App\Models\Part::where('id','104')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','105')->first()->id }}">
                                {{ \App\Models\Part::where('id','105')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','108')->first()->id }}">
                                {{ \App\Models\Part::where('id','108')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','413')->first()->id }}">
                                {{ \App\Models\Part::where('id','413')->first()->name }}
                            </option>
                            <option value="{{ \App\Models\Part::where('id','109')->first()->id }}">
                                {{ \App\Models\Part::where('id','109')->first()->name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTooleCoil">طول کویل (اینچ)</label>
                        <input name="toole_coil" type="text" class="input-text bg-yellow-300" id="inputTooleCoil">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTedadLooleDarRadif">
                            تعداد لوله در ردیف
                        </label>
                        <input name="tedad_loole_dar_radif" type="text" class="input-text bg-yellow-300"
                               id="inputTedadLooleDarRadif">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTedadMogheyiatLooleDarRadif">
                            تعداد موقعیت یک لوله در ردیف
                        </label>
                        <input type="text" class="input-text bg-yellow-300" id="inputTedadMogheyiatLooleDarRadif"
                               name="tedad_mogheyiat_loole">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold" for="inputTedadMadarLoole">تعداد مدار لوله</label>
                        <input type="text" class="input-text bg-yellow-300" id="inputTedadMadarLoole"
                               name="tedad_madar_loole">
                    </div>
                </div>
            </div>
        </div>

        <div class="space-x-2 space-x-reverse">
            <button type="submit" class="form-submit-btn">
                محاسبه
            </button>
        </div>
    </form>

    <!-- Content -->
    <div class="mt-4">
        @if(!is_null($values))
            <form method="POST" action="{{ route('calculateCoil.storeWaterWarm',[$part->id,$product->id]) }}"
                  class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4">
                @csrf
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
                    @php
                        $finalPrice = 0;
                    @endphp
                    @foreach($part->children as $index => $child)
                        <input type="hidden" name="values[]" id="value{{ $index }}"
                               value="{{ $values[$index] }}">
                        <tr>
                            @if(!is_null($selectedParts))
                                @php
                                    $keys = array_keys($selectedParts);
                                @endphp
                                @if(in_array($index,$keys))
                                    @foreach($keys as $key)
                                        @if($key == $index)
                                            <td class="border border-gray-300 p-4 text-sm text-center">
                                                {{ $index + 1 }}
                                            </td>
                                            <td class="border border-gray-300 p-4 text-sm text-center">
                                                {{ $selectedParts[$index]->name }}
                                            </td>
                                            <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                                                @if(!is_null($values))
                                                    <span>{{ number_format($values[$index], 2) }}</span>
                                                @endif
                                            </td>
                                            <td class="border border-gray-300 p-4 text-sm text-center">
                                                {{ $selectedParts[$index]->unit }}
                                            </td>
                                            <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                                                <span>{{ number_format($selectedParts[$index]->price) }}</span>
                                            </td>
                                            <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                                                @if(!is_null($values))
                                                    {{ number_format($values[$index] * $selectedParts[$index]->price) }}
                                                @endif
                                            </td>
                                        @endif
                                    @endforeach
                                    @php
                                        $finalPrice += $values[$index] * $selectedParts[$index]->price;
                                    @endphp
                                    <input type="hidden" name="parts[]" id="part{{ $index }}"
                                           value="{{ $selectedParts[$index]->id }}">
                                @else
                                    <td class="border border-gray-300 p-4 text-sm text-center">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="border border-gray-300 p-4 text-sm text-center">
                                        {{ $child->name }}
                                    </td>
                                    <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                                        <span>{{ number_format($values[$index], 2) }}</span>
                                    </td>
                                    <td class="border border-gray-300 p-4 text-sm text-center">
                                        {{ $child->unit }}
                                    </td>
                                    <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                                        <span>{{ number_format($child->price) }}</span>
                                    </td>
                                    <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                                        {{ number_format($values[$index] * $child->price) }}
                                    </td>
                                    @php
                                        $finalPrice += $values[$index] * $child->price;
                                    @endphp
                                @endif
                            @endif
                        </tr>
                    @endforeach
                    <tr>
                        <td class="border border-gray-300 p-4 text-lg font-bold text-center" colspan="4">
                            قیمت نهایی
                        </td>
                        <td class="border border-gray-300 p-4 text-lg font-bold text-center text-green-600" colspan="2">
                            <span>{{ number_format($finalPrice) }}</span>
                            <input type="hidden" name="final_price" value="{{ $finalPrice }}">
                        </td>
                    </tr>
                    </tbody>
                </table>

                <div class="my-4 bg-red-300 p-4 rounded-md shadow-md">
                    <label class="block mb-2 text-sm font-bold" for="inputCoilName">
                        نام کویل مورد نظر
                    </label>
                    <input type="text" class="input-text" id="inputCoilName" name="name"
                           placeholder="مثلا کویل فن کویلی 200cfm فین در اینچ 2">
                </div>

                <div class="mb-4">
                    <button type="submit" class="form-submit-btn">
                        ثبت مقادیر
                    </button>
                </div>

            </form>
        @endif
    </div>
</x-layout>
