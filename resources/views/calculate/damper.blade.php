<x-layout>

    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
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
                    </p>
                </div>
            </div>
            <div class="grid grid-cols-4 gap-4">
                <div>
                    <label class="block mb-2 text-sm font-bold" for="inputDebiHavaRaft">دبی هوای رفت</label>
                    <input type="text" class="input-text" id="inputDebiHavaRaft" onkeyup="calculate()">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-bold" for="inputDebiHavaBargasht">دبی هوای برگشت</label>
                    <input type="text" class="input-text" id="inputDebiHavaBargasht" onkeyup="calculate()">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-bold" for="inputDebiHavaTaze">دبی هوای تازه</label>
                    <input type="text" class="input-text" id="inputDebiHavaTaze" onkeyup="calculate()">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-bold" for="inputDebiHavaExast">دبی هوای اگزاست</label>
                    <input type="text" class="input-text" id="inputDebiHavaExast" onkeyup="calculate()">
                </div>

                <div class="col-span-2">
                    <label class="block mb-2 text-sm font-bold" for="inputSoratTazeBargashtExast">
                        سرعت هوا روی دمپر تازه و برگشت و اگزاست
                    </label>
                    <input type="text" class="input-text" id="inputSoratTazeBargashtExast" onkeyup="calculate()">
                </div>

                <div class="col-span-2">
                    <label class="block mb-2 text-sm font-bold" for="inputSoratHavaDamperRaft">
                        سرعت هوا روی دمپر رفت
                    </label>
                    <input type="text" class="input-text" id="inputSoratHavaDamperRaft" onkeyup="calculate()">
                </div>

                <div class="col-span-4">
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
