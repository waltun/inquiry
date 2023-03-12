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
                    مشاهده قیمت و جزئیات استعلام {{ $inquiry->name }}
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
                    مشاهده جزئیات و قیمت استعلام {{ $inquiry->name }}
                </p>
            </div>
        </div>
        <div class="flex items-center space-x-4 space-x-reverse">
            <a href="{{ route('inquiries.print',$inquiry->id) }}"
               class="page-gray-btn"
               target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-5 h-5 ml-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z"/>
                </svg>
                پرینت
            </a>
        </div>
    </div>

    <!-- Content -->
    <div class="mt-4">
        <!-- Info -->
        <div class="mb-4 mt-8">
            <div class="flex items-center space-x-4 space-x-reverse justify-center">
                <p class="bg-myBlue-300 py-2 px-4 rounded-lg text-sm text-white">
                    نام پروژه : {{ $inquiry->name }}
                </p>
                <p class="bg-myBlue-300 py-2 px-4 rounded-lg text-sm text-white">
                    شماره استعلام : {{ "INQ-" . $inquiry->inquiry_number }}
                </p>
                <p class="bg-myBlue-300 py-2 px-4 rounded-lg text-sm text-white">
                    @php
                        $user = \App\Models\User::where('id',$inquiry->user_id)->first();
                    @endphp
                    مسئول پروژه : {{ $user->name }}
                </p>
            </div>
        </div>

        <!-- Copy & Correction -->
        @if(!is_null($inquiry->correction_id) || !is_null($inquiry->copy_id))
            @can('users')
                <div class="my-4 bg-red-500 p-2 rounded-md">
                    @if(!is_null($inquiry->correction_id))
                        @php
                            $correctionInquiry = \App\Models\Inquiry::find($inquiry->correction_id)
                        @endphp
                        <p class="text-sm font-bold text-white">
                            توجه : این استعلام، درخواست اصلاح استعلام {{ $inquiry->name }}
                            - {{ $inquiry->inquiry_number }}
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

        @php
            $finalPrice = 0;
            $products = $inquiry->products()->where('group_id','!=',0)->where('model_id','!=',0)->get();
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
                    @if($product->copy_model == '0' && $product->model_custom_name)
                        <div class="mb-4 -mt-4 flex justify-end">
                            <form action="{{ route('inquiries.addToModell',$product->id) }}"
                                  method="POST">
                                @csrf
                                <button class="form-detail-btn text-xs" type="submit">
                                    افزودن به مدل‌ها استاندارد
                                </button>
                            </form>
                        </div>
                    @endif
                    <table class="w-full border-collapse">
                        <thead>
                        <tr class="table-th-tr whitespace-normal">
                            <th class="p-4 rounded-tr-lg">ردیف</th>
                            <th class="p-4">نام قطعه</th>
                            <th class="p-4">واحد</th>
                            <th class="p-4">وزن</th>
                            @if(auth()->user()->role == 'admin')
                                <th class="p-4">قیمت واحد</th>
                            @endif
                            <th class="p-4"> مقادیر</th>
                            @if(auth()->user()->role == 'admin')
                                <th class="p-4 rounded-tl-lg">جمع کل</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($product->amounts()->orderBy('sort','ASC')->get() as $amount)
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
                                        {{ number_format($amount->price) }} تومان
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
                                        {{ number_format($amount->price * $amount->value) }} تومان
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        @if(auth()->user()->role == 'admin')
                            <tr class="table-tb-tr group">
                                <td class="table-tr-td border-t-0 text-black font-medium" colspan="{{ $colspan }}">
                                    جمع قیمت ماتریال یک دستگاه
                                </td>
                                <td class="table-tr-td border-t-0 text-green-600 font-medium">
                                    {{ number_format($totalPrice) }} تومان
                                </td>
                            </tr>
                        @endif
                        @if($product->percent > 0)
                            @if(auth()->user()->role == 'admin')
                                <tr class="table-tb-tr group">
                                    <td class="table-tr-td border-t-0 text-black font-medium" colspan="{{ $colspan }}">
                                        ضریب ثبت شده
                                    </td>
                                    <td class="table-tr-td border-t-0 text-green-600 font-medium">
                                        {{ $product->percent }}
                                    </td>
                                </tr>
                            @endif
                            <tr class="table-tb-tr group">
                                <td class="table-tr-td border-t-0 text-black font-medium" colspan="{{ $colspan }}">
                                    قیمت دستگاه با اعمال ضریب
                                </td>
                                <td class="table-tr-td border-t-0 text-green-600 font-medium">
                                    {{ number_format($totalPrice * $product->percent) }} تومان
                                </td>
                            </tr>
                        @endif
                        <tr class="table-tb-tr group">
                            <td class="table-tr-td border-t-0 text-black font-medium" colspan="{{ $colspan }}">
                                تعداد
                            </td>
                            <td class="table-tr-td border-t-0 text-green-600 font-medium">
                                {{ $product->quantity }}
                            </td>
                        </tr>
                        <tr class="table-tb-tr group">
                            <td class="table-tr-td border-t-0 text-black font-medium" colspan="{{ $colspan }}">
                                قیمت کل
                            </td>
                            <td class="table-tr-td border-t-0 text-green-600 font-medium">
                                {{ number_format($totalPrice * $product->percent * $product->quantity) }} تومان
                            </td>
                        </tr>
                        <tr class="table-tb-tr group">
                            <td class="table-tr-td border-t-0 text-black font-medium" colspan="{{ $colspan }}">
                                وزن دستگاه
                            </td>
                            <td class="table-tr-td border-t-0 text-green-600 font-medium">
                                {{ $weight }} کیلوگرم
                            </td>
                        </tr>
                        <tr class="table-tb-tr group">
                            <td class="table-tr-td border-t-0 text-black font-medium" colspan="{{ $colspan }}">
                                تاییدیه قیمت توسط
                            </td>
                            <td class="table-tr-td border-t-0 text-green-600 font-medium">
                                @if(!is_null($product->percent_by))
                                    @php
                                        $user = \App\Models\User::where('id',$product->percent_by)->first();
                                    @endphp
                                    {{ $user->name }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            @endforeach
        @endif

        <!-- Parts List -->
        @if(!$inquiry->products()->where('part_id','!=',0)->get()->isEmpty())
            @foreach($inquiry->products()->where('part_id','!=',0)->orderBy('sort','ASC')->get() as $product)
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
                                <th class="p-4 rounded-tl-lg">قیمت</th>
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
                                    @case('setup_price')
                                        دستمزد راه‌اندازی و نصب
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
                            @can('detail-inquiry')
                                <td class="table-tr-td border-t-0 border-r-0">
                                    {{ number_format($product->part_price) }} تومان
                                </td>
                            @endcan
                        </tr>
                        @if($product->percent > 0)
                            @if(auth()->user()->role == 'admin')
                                <tr class="table-tb-tr">
                                    <td class="table-tr-td border-t-0 text-black font-medium" colspan="{{ $colspan2 }}">
                                        ضریب ثبت شده
                                    </td>
                                    <td class="table-tr-td border-t-0 text-green-600 font-medium">
                                        {{ $product->percent }}
                                    </td>
                                </tr>
                            @endif
                            <tr class="table-tb-tr">
                                <td class="table-tr-td border-t-0 text-black font-medium" colspan="{{ $colspan2 }}">
                                    قیمت قطعه با اعمال ضریب
                                </td>
                                <td class="table-tr-td border-t-0 text-green-600 font-medium">
                                    {{ number_format($product->price) }} تومان
                                </td>
                            </tr>
                        @endif
                        <tr class="table-tb-tr">
                            <td class="table-tr-td border-t-0 text-black font-medium" colspan="{{ $colspan2 }}">
                                تعداد
                            </td>
                            <td class="table-tr-td border-t-0 text-green-600 font-medium">
                                {{ $product->quantity }}
                            </td>
                        </tr>
                        <tr class="table-tb-tr">
                            <td class="table-tr-td border-t-0 text-black font-medium" colspan="{{ $colspan2 }}">
                                قیمت کل
                            </td>
                            <td class="table-tr-td border-t-0 text-green-600 font-medium">
                                {{ number_format($product->price * $product->quantity) }} تومان
                            </td>
                        </tr>
                        <tr class="table-tb-tr">
                            <td class="table-tr-td border-t-0 text-black font-medium" colspan="{{ $colspan2 }}">
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
            @if($inquiry->price > 0)
                <p class="bg-myGreen-100 text-white px-6 py-3 rounded-lg font-bold text-xl">
                    قیمت نهایی کل استعلام : {{ number_format($inquiry->price) }} تومان
                </p>
            @else
                <p class="bg-myGreen-100 text-white px-6 py-3 rounded-lg font-bold text-xl">
                    قیمت نهایی کل استعلام : {{ number_format($finalPrice) }} تومان
                </p>
            @endif
        </div>

        <!-- Inquiry Description -->
        <div class="card">
            <div class="card-header">
                <p class="card-title text-lg">
                    شرایط استعلام
                </p>
            </div>
            <div class="leading-7 text-sm text-gray-700 test-decimal mr-4">
                @if($inquiry->description)
                    {!! $inquiry->description !!}
                @else
                    <p class="text-sm text-center text-lg text-red-600 font-bold">
                        شرایطی برای این استعلام تعیین نشده است!
                    </p>
                @endif
            </div>
        </div>

        <!-- Inquiry Dates -->
        @can('detail-inquiry')
            <div class="md:grid grid-cols-3 gap-4 mt-4">
                <div class="card">
                    <p class="text-sm font-bold text-black text-center">
                        ایجاد استعلام : {{ jdate($inquiry->created_at)->format('%A, %d %B %Y') }}
                    </p>
                    <p class="text-sm font-bold text-black text-center">
                        ساعت : {{ jdate($inquiry->created_at)->format('H:i:s') }}
                    </p>
                </div>
                <div class="card">
                    <p class="text-sm font-bold text-black text-center">
                        آخرین بروزرسانی استعلام : {{ jdate($inquiry->updated_at)->format('%A, %d %B %Y') }}
                    </p>
                    <p class="text-sm font-bold text-black text-center">
                        ساعت : {{ jdate($inquiry->updated_at)->format('H:i:s') }}
                    </p>
                </div>
                <div class="card">
                    @if($inquiry->archive_at)
                        <p class="text-sm font-bold text-black text-center">
                            آرشیو استعلام : {{ jdate($inquiry->archive_at)->format('%A, %d %B %Y') }}
                        </p>
                        <p class="text-sm font-bold text-black text-center">
                            ساعت : {{ jdate($inquiry->archive_at)->format('H:i:s') }}
                        </p>
                    @else
                        <p class="text-sm font-bold text-red-600 text-center">
                            آرشیو استعلام : هنوز ثبت نشده!
                        </p>
                    @endif
                </div>
            </div>
        @endcan
    </div>
</x-layout>
