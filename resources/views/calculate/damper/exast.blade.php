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
                        محاسبه قیمت دمپر
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
        $inputs = Session::get('inputs');
        $toolePare = Session::get('toolePare');
        $name = Session::get('name');
        $ertefa = Session::get('ertefa');
        $sotoonVasat = Session::get('sotoonVasat');
    @endphp

    <div class="my-4">
        <form method="POST" action="{{ route('calculateExastDamper') }}"
              class="bg-white rounded-md shadow-md border border-gray-200 py-4 px-6">
            @csrf
            <input type="hidden" name="serial" value="{{ $inquiry->inquiry_number }}">
            <div class="mb-4 border-b border-gray-300 pb-3 flex justify-between items-center">
                <div>
                    <p class="text-lg text-black">
                        اطلاعات ورودی {{ $part->name }}
                    </p>
                </div>
            </div>
            <div class="grid grid-cols-5 gap-4">
                <div>
                    <label class="block mb-2 text-sm font-bold" for="inputDebiHavaTaze">دبی هوای اگزاست (CFM)</label>
                    <input type="text" class="input-text" id="inputDebiHavaTaze" name="debi_hava_exast"
                           value="{{ !is_null($inputs) ? $inputs['debi_hava_exast'] : '' }}">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-bold" for="inputSoratExast">
                        سرعت هوا روی دمپر (FPM)
                    </label>
                    <input type="text" class="input-text" id="inputSoratExast" name="sorat_hava"
                           value="{{ !is_null($inputs) ? $inputs['sorat_hava'] : 800 }}">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-bold" for="inputTedadPare">
                        تعداد پره (عدد)
                    </label>
                    <input type="text" class="input-text" id="inputTedadPare" name="tedad_pare"
                           value="{{ !is_null($inputs) ? $inputs['tedad_pare'] : '' }}">
                </div>
                <div class="col-span-2">
                    <label class="block mb-2 text-sm font-bold" for="inputTedadPare">
                        ابعاد (CM)
                    </label>
                    <p class="bg-indigo-500 rounded-md px-6 py-2 text-sm text-white">
                        ابعاد داخلی دمپر :
                        @if(!is_null($toolePare) && !is_null($ertefa))
                            @if($sotoonVasat > 0)
                                {{ $toolePare + 3 }} * {{ $ertefa }} با ستون وسط دمپر
                            @else
                                {{ $toolePare }} * {{ $ertefa }}
                            @endif
                        @else
                            0
                        @endif
                    </p>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="form-submit-btn">
                    محاسبه
                </button>
            </div>
        </form>
    </div>

    <!-- Content -->
    @if(!is_null($values))
        <form method="POST" action="{{ route('calculateDamper.store',[$part->id,$product->id]) }}" class="mt-4">
            @csrf

            <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4">
                <table class="border-collapse border border-gray-400 w-full">
                    <thead class="sticky top-1 bg-gray-200 z-50 shadow-md">
                    <tr>
                        <th class="border border-gray-300 p-1 text-sm">ردیف</th>
                        <th class="border border-gray-300 p-1 text-sm">شرح</th>
                        <th class="border border-gray-300 p-1 text-sm">واحد</th>
                        <th class="border border-gray-300 p-1 text-sm">مقدار / سایز</th>
                        <th class="border border-gray-300 p-1 text-sm">قیمت واحد</th>
                        <th class="border border-gray-300 p-1 text-sm">قیمت کل</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $finalPrice = 0;
                        $finalWeight = 0;
                    @endphp
                    @foreach($part->children as $index => $child)
                        <input type="hidden" name="values[]" id="value{{ $index }}"
                               value="{{ $values[$index] }}">
                        <tr>
                            <td class="border border-gray-300 p-2 text-sm text-center">
                                {{ $loop->index + 1 }}
                            </td>
                            <td class="border border-gray-300 p-2 text-sm text-center">
                                {{ $child->name }}
                            </td>
                            <td class="border border-gray-300 p-2 text-sm text-center">
                                {{ $child->unit }}
                                @if(!is_null($child->unit2))
                                    /
                                    {{ $child->unit2 }}
                                @endif
                            </td>
                            <td class="border border-gray-300 p-2 text-sm text-center">
                                @if(!is_null($child->unit2))
                                    @php
                                        $string = $values[$index] . $child->operator1 . $child->formula1;
                                    @endphp
                                    {{ number_format(eval("return " . $string . ';'), 2) }}
                                    /
                                @endif
                                <span>{{ number_format($values[$index], 2) }}</span>
                            </td>
                            <td class="border border-gray-300 p-2 text-sm text-center">
                                <span>{{ number_format($child->price) }}</span>
                            </td>
                            <td class="border border-gray-300 p-2 text-sm text-center">
                                @if($child->unit2)
                                    <span>{{ number_format(eval("return " . $string . ';') * $child->price) }}</span>
                                @else
                                    <span>{{ number_format($values[$index] * $child->price) }}</span>
                                @endif
                            </td>
                        </tr>
                        @php
                            if ($child->unit2) {
                                $finalPrice += eval("return " . $string . ';') * $child->price;
                                $finalWeight += eval("return " . $string . ';') * $child->weight;
                            } else {
                                $finalPrice += $values[$index] * $child->price;
                                $finalWeight += $values[$index] * $child->weight;
                            }
                        @endphp
                    @endforeach

                    <tr>
                        <td class="border border-gray-300 p-2 text-lg font-bold text-center" colspan="4">
                            قیمت نهایی
                        </td>
                        <td class="border border-gray-300 p-2 text-lg font-bold text-center text-green-600" colspan="2">
                            <span>{{ number_format($finalPrice) }} تومان </span>
                            <input type="hidden" name="final_price" value="{{ $finalPrice }}">
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 p-2 text-lg font-bold text-center" colspan="4">
                            وزن دستگاه
                        </td>
                        <td class="border border-gray-300 p-2 text-lg font-bold text-center text-green-600" colspan="2">
                            <span>{{ round($finalWeight) }} کیلوگرم </span>
                            <input type="hidden" name="weight" value="{{ $finalWeight }}">
                        </td>
                    </tr>

                    </tbody>
                </table>

                <div class="my-4 bg-red-300 p-4 rounded-md shadow-md">
                    <label class="block mb-2 text-sm font-bold" for="inputCoilName">
                        نام دمپر مورد نظر
                    </label>
                    <input type="text" class="input-text" id="inputCoilName" name="name" dir="ltr" value="{{ $name }}">
                </div>

                <div class="mb-4">
                    <button type="submit" class="form-submit-btn">
                        ثبت مقادیر
                    </button>
                </div>

            </div>
        </form>
    @endif
</x-layout>
