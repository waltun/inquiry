<x-layout>
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
        <a href="{{ route('separate.damper.index') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    محاسبه دمپر ها
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
                      d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V13.5zm0 2.25h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V18zm2.498-6.75h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V13.5zm0 2.25h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V18zm2.504-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V18zm2.498-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zM8.25 6h7.5v2.25h-7.5V6zM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 002.25 2.25h10.5a2.25 2.25 0 002.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0012 2.25z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    محاسبه {{ $part->name }}
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
        <form method="POST" action="{{ route('separate.damper.calculateBargasht') }}"
              class="bg-white rounded-md shadow-md border border-gray-200 py-4 px-6">
            @csrf
            <div class="mb-4 border-b border-gray-300 pb-3 flex justify-between items-center">
                <div>
                    <p class="text-lg text-black font-bold">
                        اطلاعات ورودی {{ $part->name }}
                    </p>
                </div>
            </div>
            <div class="grid grid-cols-5 gap-4">
                <div>
                    <label class="block mb-2 text-sm font-bold" for="inputDebiHavaBargasht">دبی هوای برگشت (CFM)</label>
                    <input type="text" class="input-text bg-sky-100" id="inputDebiHavaBargasht" name="debi_hava_bargasht"
                           value="{{ !is_null($inputs) ? $inputs['debi_hava_bargasht'] : '' }}">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-bold" for="inputSoratBargasht">
                        سرعت هوا روی دمپر (FPM)
                    </label>
                    <input type="text" class="input-text bg-sky-100" id="inputSoratBargasht" name="sorat_hava"
                           value="{{ !is_null($inputs) ? $inputs['sorat_hava'] : 800 }}">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-bold" for="inputTedadPare">
                        تعداد پره (عدد)
                    </label>
                    <input type="text" class="input-text bg-sky-100" id="inputTedadPare" name="tedad_pare"
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
        <form method="POST" action="{{ route('separate.damper.store',$part->id) }}" class="mt-4">
            @csrf

            <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4">
                <table class="w-full border-collapse">
                    <thead>
                    <tr class="table-th-tr">
                        <th class="p-4 rounded-tr-lg">ردیف</th>
                        <th class="p-4">شرح</th>
                        <th class="p-4">واحد</th>
                        <th class="p-4">مقدار / سایز</th>
                        <th class="p-4">قیمت واحد</th>
                        <th class="p-4 rounded-tl-lg">قیمت کل</th>
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
                        <tr class="table-tb-tr group">
                            <td class="table-tr-td border-t-0 border-l-0">
                                {{ $loop->index + 1 }}
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                {{ $child->name }}
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                {{ $child->unit }}
                                @if(!is_null($child->unit2))
                                    /
                                    {{ $child->unit2 }}
                                @endif
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                @if(!is_null($child->unit2))
                                    @php
                                        $string = $values[$index] . $child->operator1 . $child->formula1;
                                    @endphp
                                    {{ number_format(eval("return " . $string . ';'), 2) }}
                                    /
                                @endif
                                <span>{{ number_format($values[$index], 2) }}</span>
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                <span>{{ number_format($child->price) }}</span>
                            </td>
                            <td class="table-tr-td border-t-0 border-r-0">
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
                    <tr class="table-tb-tr group">
                        <td class="table-tr-td border-t-0" colspan="4">
                            <p class="text-lg font-bold">قیمت نهایی (تومان)</p>
                        </td>
                        <td class="table-tr-td border-t-0 border-r-0" colspan="2">
                            <span class="text-lg font-bold">{{ number_format($finalPrice) }}</span>
                            <input type="hidden" name="final_price" value="{{ $finalPrice }}">
                        </td>
                    </tr>
                    <tr class="table-tb-tr group">
                        <td class="table-tr-td border-t-0" colspan="4">
                            <p class="text-lg font-bold">وزن دستگاه (کلیوگرم)</p>
                        </td>
                        <td class="table-tr-td border-t-0 border-r-0" colspan="2">
                            <span class="text-lg font-bold">{{ round($finalWeight) }}</span>
                            <input type="hidden" name="weight" value="{{ $finalWeight }}">
                        </td>
                    </tr>
                    </tbody>
                </table>

                <div class="card mt-4">
                    <div class="card-header">
                        <p class="card-title">مشخصات</p>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold" for="inputCoilName">
                            نام دمپر مورد نظر
                        </label>
                        <input type="text" class="input-text" id="inputCoilName" name="name" dir="ltr" value="{{ $name }}">
                    </div>
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
