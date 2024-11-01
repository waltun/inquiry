<x-layout>
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
                      d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    قرارداد {{ $contract->name }} - {{ $contract->number }}
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
                    محاسبه قیمت دمپر هوای تازه
                </p>
            </div>
        </div>
    </div>

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
        <form method="POST" action="{{ route('contracts.calculateTazeDamper', $contract->id) }}"
              class="bg-white rounded-md shadow-md border border-gray-200 py-4 px-6">
            @csrf
            <div class="mb-4 border-b border-gray-300 pb-3 flex justify-between items-center">
                <div>
                    <p class="text-lg text-black">
                        اطلاعات ورودی {{ $part->name }}
                    </p>
                </div>
            </div>
            <div class="grid grid-cols-5 gap-4">
                <div>
                    <label class="block mb-2 text-sm font-bold" for="inputDebiHavaTaze">دبی هوای تازه (CFM)</label>
                    <input type="text" class="input-text" id="inputDebiHavaTaze" name="debi_hava_taze"
                           value="{{ !is_null($inputs) ? $inputs['debi_hava_taze'] : '' }}">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-bold" for="inputSoratTaze">
                        سرعت هوا روی دمپر (FPM)
                    </label>
                    <input type="text" class="input-text" id="inputSoratTaze" name="sorat_hava"
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
        <form method="POST" action="{{ route('contracts.calculateDamper.store', [$contract->id, $part->id, $product->id, $part2->id]) }}" class="mt-4">
            @csrf

            @php
                $inputs['type'] = "Taze";
            @endphp

            <input type="hidden" name="inputs" value="{{ json_encode($inputs) }}">

            @if($sotoonVasat > 0)
                <input type="hidden" name="dimensions" value="{{ $toolePare + 3 }} * {{ $ertefa }}">
            @else
                <input type="hidden" name="dimensions" value="{{ $toolePare }} * {{ $ertefa }}">
            @endif

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
