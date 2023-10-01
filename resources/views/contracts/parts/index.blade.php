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
        <a href="{{ route('inquiries.priced') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    استعلام های قیمت گذاری شده
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
                      d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    مشاهده قیمت و جزئیات استعلام
                </p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="flex items-center justify-between mt-8">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-8 h-8 dark:text-white">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <div class="mr-2">
                <p class="font-bold text-2xl text-black dark:text-white">
                    قطعات محصولات قرارداد {{ $contract->name }}
                </p>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="mt-4">
        @php
            $finalPrice = 0;
            $products = $contract->products()->where('group_id','!=',0)->where('model_id','!=',0)->get();
        @endphp

            <!-- Product List -->
        @if(!$products->isEmpty())
            @foreach($products as $product)
                @php
                    $modell = \App\Models\Modell::find($product->model_id);
                    $finalPrice += $product->price;
                    $totalPrice = 0;
                    $weight = 0;
                @endphp
                <div class="card">
                    <div class="card-header">
                        <p class="card-title text-lg">
                            لیست قطعات و قیمت محصول
                            <span class="text-red-600">{{ $modell->parent->name }}</span> -
                            <span class="text-red-600">{{ $product->model_custom_name ?? $modell->name }}</span>
                        </p>
                    </div>
                    <table class="w-full border-collapse">
                        <thead>
                        <tr class="table-th-tr whitespace-normal">
                            <th class="p-4 rounded-tr-lg">ردیف</th>
                            <th class="p-4">نام قطعه</th>
                            <th class="p-4">واحد</th>
                            <th class="p-4">وزن</th>
                            @if(auth()->user()->role == 'admin')
                                <th class="p-4">قیمت واحد (تومان)</th>
                            @endif
                            <th class="p-4"> مقادیر</th>
                            @if(auth()->user()->role == 'admin')
                                <th class="p-4 rounded-tl-lg">جمع کل (تومان)</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $amounts = \App\Models\Amount::where('product_id', $product->product_id)->get();
                            dd($product->product_id);
                        @endphp
                        @foreach($amounts as $amount)
                            @php
                                $part = \App\Models\Part::find($amount->part_id);
                                $totalPrice += ($amount->price * $amount->value);
                                $weight += $amount->weight * $amount->value;
                            @endphp
                            <tr class="table-tb-tr group whitespace-normal">
                                <td class="table-tr-td border-t-0 border-l-0">
                                    {{ $loop->index + 1 }}
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    {{ $part->name }}
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    {{ $part->unit }}
                                    @if(!is_null($part->unit2))
                                        / {{ $part->unit2 }}
                                    @endif
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    {{ $part->weight }}
                                </td>
                                @if(auth()->user()->role == 'admin')
                                    <td class="table-tr-td border-t-0 border-x-0 whitespace-nowrap">
                                        {{ number_format($amount->price) }}
                                    </td>
                                @endif
                                <td class="table-tr-td border-t-0 border-x-0">
                                    {{ $amount->value }}
                                    @if(!is_null($amount->value2))
                                        / {{ $amount->value2 }}
                                    @endif
                                </td>
                                @if(auth()->user()->role == 'admin')
                                    <td class="table-tr-td border-t-0 border-r-0">
                                        {{ number_format($amount->price * $amount->value) }}
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        @if(auth()->user()->role == 'admin')
                            <tr class="table-tb-tr group">
                                <td class="table-tr-td border-t-0 text-black font-medium">
                                    جمع قیمت ماتریال یک دستگاه
                                </td>
                                <td class="table-tr-td border-t-0 text-green-600 font-medium">
                                    {{ number_format($totalPrice) }} تومان
                                </td>
                            </tr>
                        @endif
                        @if($product->percent > 0)
                            <tr class="table-tb-tr group">
                                <td class="table-tr-td border-t-0 text-black font-medium">
                                    قیمت دستگاه
                                </td>
                                <td class="table-tr-td border-t-0 text-green-600 font-medium">
                                    {{ number_format($totalPrice * $product->percent) }} تومان
                                </td>
                            </tr>
                        @endif
                        <tr class="table-tb-tr group">
                            <td class="table-tr-td border-t-0 text-black font-medium">
                                تعداد
                            </td>
                            <td class="table-tr-td border-t-0 text-green-600 font-medium">
                                {{ $product->quantity }}
                            </td>
                        </tr>
                        <tr class="table-tb-tr group">
                            <td class="table-tr-td border-t-0 text-black font-medium">
                                قیمت کل
                            </td>
                            <td class="table-tr-td border-t-0 text-green-600 font-medium">
                                {{ number_format($totalPrice * $product->percent * $product->quantity) }} تومان
                            </td>
                        </tr>
                        <tr class="table-tb-tr group">
                            <td class="table-tr-td border-t-0 text-black font-medium">
                                وزن دستگاه
                            </td>
                            <td class="table-tr-td border-t-0 text-green-600 font-medium">
                                {{ $weight }} کیلوگرم
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            @endforeach
        @endif

        <!-- Parts List -->
        @if(!$contract->products()->where('part_id','!=',0)->get()->isEmpty())
            @foreach($contract->products()->where('part_id','!=',0)->orderBy('sort','ASC')->get() as $product)
                @php
                    $finalPrice += $product->price;
                    $part = \App\Models\Part::find($product->part_id);
                    $totalWeight = $product->weight * $product->quantity;
                @endphp
                <div class="card">
                    <div class="card-header">
                        <p class="card-title text-lg">
                            تک قطعه <span class="text-red-600">{{ $part->name }}</span>
                        </p>
                    </div>
                    <table class="w-full border-collapse">
                        <thead>
                        <tr class="table-th-tr">
                            <th class="p-4 rounded-tr-lg">نام قطعه</th>
                            <th class="p-4">نوع قطعه</th>
                            <th class="p-4">واحد قطعه</th>
                            <th class="p-4">وزن قطعه</th>
                            @if(auth()->user()->role == 'admin')
                                <th class="p-4 rounded-tl-lg">قیمت (تومان)</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="table-tb-tr group">
                            <td class="table-tr-td border-t-0 border-l-0">
                                {{ $part->name }}
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                @switch($part->type)
                                    @case('setup')
                                        قطعات یدکی راه اندازی
                                        @break
                                    @case('years')
                                        قطعات یدکی دوسالانه
                                        @break
                                    @case('control')
                                        قطعات کنترلی
                                        @break
                                    @case('power_cable')
                                        قطعات کابل قدرت
                                        @break
                                    @case('control_cable')
                                        قطعات کابل کنترلی
                                        @break
                                    @case('pipe')
                                        قطعات لوله و اتصالات
                                        @break
                                    @case('install_setup_price')
                                        دستمزد نصب و راه اندازی
                                        @break
                                    @case('setup_price')
                                        دستمزد راه اندازی
                                        @break
                                    @case('supervision')
                                        دستمزد نظارت
                                        @break
                                    @case('transport')
                                        هزینه حمل
                                        @break
                                    @case('other')
                                        سایر تجهیزات
                                        @break
                                    @case('setup_one')
                                        قطعات راه اندازی
                                        @break
                                    @case('install')
                                        قطعات نصب
                                        @break
                                    @case('cable')
                                        اقلام کابل کشی
                                        @break
                                    @case('canal')
                                        اقلام کانال کشی
                                        @break
                                    @case('copper_piping')
                                        دستمزد لوله کشی مسی
                                        @break
                                    @case('carbon_piping')
                                        دستمزد لوله کشی کربن استیل
                                        @break
                                    @case('')
                                        -
                                        @break
                                @endswitch
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                {{ $part->unit }}
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                {{ $part->weight }} کیلوگرم
                            </td>
                            <td class="table-tr-td border-t-0 border-r-0">
                                {{ number_format($product->part_price) }} تومان
                            </td>
                        </tr>
                        @if($product->percent > 0)
                            <tr class="table-tb-tr">
                                <td class="table-tr-td border-t-0 text-black font-medium">
                                    قیمت قطعه
                                </td>
                                <td class="table-tr-td border-t-0 text-green-600 font-medium">
                                    {{ number_format($product->price) }}
                                </td>
                            </tr>
                        @endif
                        <tr class="table-tb-tr">
                            <td class="table-tr-td border-t-0 text-black font-medium">
                                تعداد
                            </td>
                            <td class="table-tr-td border-t-0 text-green-600 font-medium">
                                {{ $product->quantity }}
                            </td>
                        </tr>
                        <tr class="table-tb-tr">
                            <td class="table-tr-td border-t-0 text-black font-medium">
                                قیمت کل
                            </td>
                            <td class="table-tr-td border-t-0 text-green-600 font-medium">
                                {{ number_format($product->price * $product->quantity) }} تومان
                            </td>
                        </tr>
                        <tr class="table-tb-tr">
                            <td class="table-tr-td border-t-0 text-black font-medium">
                                وزن
                            </td>
                            <td class="table-tr-td border-t-0 text-green-600 font-medium">
                                {{ $totalWeight }} کیلوگرم
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            @endforeach
        @endif

        <!-- Final Inquiry Price -->
        <div class="my-6 flex justify-end sticky bottom-4">
            <p class="bg-myGreen-100 text-white px-6 py-3 rounded-lg font-bold text-xl">
                قیمت نهایی قرارداد : {{ number_format($contract->price) }} تومان
            </p>
        </div>
    </div>
</x-layout>
