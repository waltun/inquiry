<x-layout>
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
                        جزئیات استعلام {{ $inquiry->name }} به شماره استعلام {{ $inquiry->inquiry_number }}
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Navigation Btn -->
    <div class="my-4 md:flex justify-between items-center">
        <div class="mb-4 md:mb-0">
            @if($inquiry->archive_at)
                <span class="bg-red-500 rounded-md px-6 py-1 text-sm text-white">
                    وضعیت استعلام : آرشیو شده
                </span>
            @else
                <span class="bg-indigo-500 rounded-md px-6 py-1 text-sm text-white">
                    وضعیت استعلام : در حال انجام
                </span>
            @endif
        </div>
        <div class="whitespace-nowrap overflow-x-auto py-4">
            <a href="{{ route('inquiries.index') }}" class="form-detail-btn text-xs">لیست استعلام ها</a>
            <a href="{{ route('inquiries.priced') }}" class="form-submit-btn text-xs">استعلام های قیمت گذاری شده</a>
            <a href="{{ route('inquiries.submitted') }}" class="form-edit-btn text-xs">استعلام های منتظر قیمت</a>
        </div>
    </div>

    <!-- Print -->
    <div>
        <a href="{{ route('inquiries.print',$inquiry->id) }}" class="form-percent-btn inline-flex items-center"
           target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-5 h-5 ml-2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z"/>
            </svg>
            پرینت
        </a>
    </div>

    <!-- Content -->
    <div class="mt-4">
        <!-- Inquiry Details -->
        <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4">
            <div class="md:flex justify-between items-center space-y-4 md:space-y-0">
                <p class="font-bold text-black md:text-lg text-sm text-center">
                    نام پروژه : {{ $inquiry->name }}
                </p>
                <p class="font-bold text-black md:text-lg text-sm text-center">
                    شماره استعلام : {{ "INQ-" . $inquiry->inquiry_number }}
                </p>
                <p class="font-bold text-black md:text-lg text-sm text-center">
                    مسئول پروژه : {{ $inquiry->manager }}
                </p>
            </div>
        </div>

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
        @endphp

            <!-- Product List -->
        @if(!$inquiry->products()->where('group_id','!=',0)->where('model_id','!=',0)->get()->isEmpty())
            @foreach($inquiry->products()->where('group_id','!=',0)->where('model_id','!=',0)->orderBy('sort','ASC')->get() as $product)
                @php
                    $group = \App\Models\Group::find($product->group_id);
                    $modell = \App\Models\Modell::find($product->model_id);
                    $finalPrice += $product->price;
                    $totalPrice = 0;
                    $weight = 0;
                @endphp
                <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4 hidden md:block">
                    <div class="mb-4 flex justify-between items-center">
                        <p class="text-center text-lg font-black font-bold">
                            لیست قطعات و قیمت محصول
                            <span class="text-red-600">{{ $modell->parent->name }}</span> -
                            <span class="text-red-600">{{ $product->model_custom_name ?? $modell->name }}</span>
                        </p>
                        @if($product->model_custom_name)
                            @if($product->copy_model == '0')
                                <form action="{{ route('inquiries.addToModell',$product->id) }}"
                                      method="POST">
                                    @csrf
                                    <button class="form-detail-btn text-xs" type="submit">
                                        افزودن به مدل‌ها استاندارد
                                    </button>
                                </form>
                            @else
                                <p class="text-sm font-bold text-gray-600">
                                    این مدل به مدل‌های استاندارد اضافه شده است
                                </p>
                            @endif
                        @endif
                    </div>
                    <table class="border-collapse border border-gray-400 w-full">
                        <thead class="sticky top-2">
                        <tr class="bg-indigo-200">
                            <th class="border border-white p-4 text-sm">نام قطعه</th>
                            <th class="border border-white p-4 text-sm">واحد</th>
                            <th class="border border-white p-4 text-sm">وزن</th>
                            @can('detail-inquiry')
                                <th class="border border-white p-4 text-sm">قیمت واحد</th>
                            @endcan
                            <th class="border border-white p-4 text-sm"> مقادیر</th>
                            @can('detail-inquiry')
                                <th class="border border-white p-4 text-sm">جمع کل</th>
                            @endcan
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($product->amounts()->orderBy('sort','ASC')->get() as $amount)
                            @php
                                $part = \App\Models\Part::find($amount->part_id);
                                $totalPrice += ($amount->price * $amount->value);
                                $weight += $amount->weight * $amount->value;
                            @endphp
                            <tr>
                                <td class="border border-gray-300 p-4 text-sm text-center">
                                    {{ $part->name }}
                                </td>
                                <td class="border border-gray-300 p-4 text-sm text-center">
                                    {{ $part->unit }}
                                    @if(!is_null($part->unit2))
                                        / {{ $part->unit2 }}
                                    @endif
                                </td>
                                <td class="border border-gray-300 p-4 text-sm text-center">
                                    {{ $part->weight }}
                                </td>
                                @can('detail-inquiry')
                                    <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                                        {{ number_format($amount->price) }} تومان
                                    </td>
                                @endcan
                                <td class="border border-gray-300 p-4 text-sm text-center">
                                    {{ $amount->value }}
                                    @if(!is_null($amount->value2))
                                        / {{ $amount->value2 }}
                                    @endif
                                </td>
                                @can('detail-inquiry')
                                    <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                                        {{ number_format($amount->price * $amount->value) }} تومان
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                        @can('detail-inquiry')
                            <tr>
                                <td class="border border-gray-300 p-4 text-lg text-center font-bold"
                                    colspan="{{ $colspan }}">
                                    جمع قیمت ماتریال یک دستگاه
                                </td>
                                <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                                    {{ number_format($totalPrice) }} تومان
                                </td>
                            </tr>
                        @endcan
                        @if($product->percent > 0)
                            @can('detail-inquiry')
                                <tr>
                                    <td class="border border-gray-300 p-4 text-lg text-center font-bold"
                                        colspan="{{ $colspan }}">
                                        ضریب ثبت شده
                                    </td>
                                    <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                                        {{ $product->percent }}
                                    </td>
                                </tr>
                            @endcan
                            <tr>
                                <td class="border border-gray-300 p-4 text-lg text-center font-bold"
                                    colspan="{{ $colspan }}">
                                    قیمت دستگاه با اعمال ضریب
                                </td>
                                <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                                    {{ number_format($totalPrice * $product->percent) }} تومان
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <td class="border border-gray-300 p-4 text-lg text-center font-bold"
                                colspan="{{ $colspan }}">
                                تعداد
                            </td>
                            <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                                {{ $product->quantity }}
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 p-4 text-lg text-center font-bold"
                                colspan="{{ $colspan }}">
                                قیمت کل
                            </td>
                            <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                                {{ number_format($totalPrice * $product->percent * $product->quantity) }} تومان
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 p-4 text-lg text-center font-bold"
                                colspan="{{ $colspan }}">
                                وزن دستگاه
                            </td>
                            <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                                {{ $weight }} کیلوگرم
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
                <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4 hidden md:block">
                    <div class="mb-4">
                        <p class="text-center text-lg font-black font-bold">
                            تک قطعه <span class="text-red-600">{{ $part->name }}</span>
                        </p>
                    </div>
                    <table class="border-collapse border border-gray-400 w-full">
                        <thead class="sticky top-2">
                        <tr class="bg-indigo-200">
                            <th class="border border-white p-4 text-sm">نام قطعه</th>
                            <th class="border border-white p-4 text-sm">نوع قطعه</th>
                            <th class="border border-white p-4 text-sm">واحد قطعه</th>
                            <th class="border border-white p-4 text-sm">وزن قطعه</th>
                            @can('detail-inquiry')
                                <th class="border border-white p-4 text-sm">قیمت</th>
                            @endcan
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="border border-gray-300 p-4 text-sm text-center">
                                {{ $part->name }}
                            </td>
                            <td class="border border-gray-300 p-4 text-sm text-center">
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
                            <td class="border border-gray-300 p-4 text-sm text-center">
                                {{ $part->unit }}
                            </td>
                            <td class="border border-gray-300 p-4 text-sm text-center">
                                {{ $part->weight }} کیلوگرم
                            </td>
                            @can('detail-inquiry')
                                <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                                    {{ number_format($product->part_price) }} تومان
                                </td>
                            @endcan
                        </tr>
                        @if($product->percent > 0)
                            @can('detail-inquiry')
                                <tr>
                                    <td class="border border-gray-300 p-4 text-lg text-center font-bold"
                                        colspan="{{ $colspan2 }}">
                                        ضریب ثبت شده
                                    </td>
                                    <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                                        {{ $product->percent }}
                                    </td>
                                </tr>
                            @endcan
                            <tr>
                                <td class="border border-gray-300 p-4 text-lg text-center font-bold"
                                    colspan="{{ $colspan2 }}">
                                    قیمت قطعه با اعمال ضریب
                                </td>
                                <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                                    {{ number_format($product->price) }} تومان
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <td class="border border-gray-300 p-4 text-lg text-center font-bold"
                                colspan="{{ $colspan2 }}">
                                تعداد
                            </td>
                            <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                                {{ $product->quantity }}
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 p-4 text-lg text-center font-bold"
                                colspan="{{ $colspan2 }}">
                                قیمت کل
                            </td>
                            <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                                {{ number_format($product->price * $product->quantity) }} تومان
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 p-4 text-lg text-center font-bold"
                                colspan="{{ $colspan2 }}">
                                وزن
                            </td>
                            <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                                {{ $totalWeight }} کیلوگرم
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            @endforeach
        @endif

        <!-- Final Inquiry Price -->
        <div class="bg-green-500 p-4 rounded-md shadow-md mt-4 sticky bottom-4">
            @if($inquiry->price > 0)
                <p class="md:text-xl text-lg text-black font-bold text-center">
                    قیمت نهایی کل استعلام : {{ number_format($inquiry->price) }} تومان
                </p>
            @else
                <p class="text-xl text-black font-bold text-center">
                    قیمت نهایی کل استعلام : {{ number_format($finalPrice) }} تومان
                </p>
            @endif
        </div>

        <!-- Inquiry Description -->
        <div class="mt-4 bg-white rounded-md p-4 border border-gray-200 shadow-md">
            <div class="mb-4">
                <p class="text-lg font-bold text-black border-b pb-3 border-gray-400">
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
                <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4 space-y-2">
                    <p class="text-sm font-bold text-black text-center">
                        ایجاد استعلام : {{ jdate($inquiry->created_at)->format('%A, %d %B %Y') }}
                    </p>
                    <p class="text-sm font-bold text-black text-center">
                        ساعت : {{ jdate($inquiry->created_at)->format('H:i:s') }}
                    </p>
                </div>
                <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4 space-y-2">
                    <p class="text-sm font-bold text-black text-center">
                        آخرین بروزرسانی استعلام : {{ jdate($inquiry->updated_at)->format('%A, %d %B %Y') }}
                    </p>
                    <p class="text-sm font-bold text-black text-center">
                        ساعت : {{ jdate($inquiry->updated_at)->format('H:i:s') }}
                    </p>
                </div>
                <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4 space-y-2">
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
