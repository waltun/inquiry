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
    <div class="my-4 md:flex justify-between">
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
        <div class="whitespace-nowrap">
            <a href="{{ route('inquiries.index') }}" class="form-detail-btn text-xs">لیست استعلام ها</a>
            <a href="{{ route('inquiries.priced') }}" class="form-submit-btn text-xs">استعلام های قیمت گذاری شده</a>
            <a href="{{ route('inquiries.submitted') }}" class="form-edit-btn text-xs">استعلام های منتظر قیمت</a>
        </div>
    </div>

    <!-- Content -->
    <div class="mt-4">
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
        @php
            $finalPrice = 0;
        @endphp
        @foreach($inquiry->products()->where('group_id','!=',0)->where('model_id','!=',0)->get() as $product)
            @php
                $group = \App\Models\Group::find($product->group_id);
                $modell = \App\Models\Modell::find($product->model_id);
                $finalPrice += $product->price;
                $totalPrice = 0;
                $totalGroupPrice = 0;
                $totalModellPrice = 0;
            @endphp
                <!-- Laptop List -->
            <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4 hidden md:block">
                <div class="mb-4">
                    <p class="text-center text-lg font-black font-bold">
                        لیست قطعات و قیمت محصول <span class="text-red-600">{{ $group->name }}</span> - <span class="text-red-600">{{ $modell->name }}</span>
                    </p>
                </div>
                <table class="border-collapse border border-gray-400 w-full">
                    <thead>
                    <tr>
                        <th class="border border-gray-300 p-4 text-sm">کد قطعه</th>
                        <th class="border border-gray-300 p-4 text-sm">نام قطعه</th>
                        <th class="border border-gray-300 p-4 text-sm">واحد قطعه</th>
                        <th class="border border-gray-300 p-4 text-sm">قیمت واحد</th>
                        <th class="border border-gray-300 p-4 text-sm">مقادیر</th>
                        <th class="border border-gray-300 p-4 text-sm">جمع کل</th>
                    </tr>
                    </thead>
                    <tbody>

                    @if(!$group->parts->isEmpty())
                        @foreach($group->parts as $part)
                            @php
                                $amount = $product->amounts()->where('part_id',$part->id)->first();
                                if($amount){
                                    if ($amount->price > 0){
                                        $totalGroupPrice += ($part->price * $amount->value) + ($amount->price * $amount->value);
                                    } else {
                                        $totalGroupPrice += ($part->price * $amount->value);
                                    }
                                }
                                $code = '';
                                foreach($part->categories as $category){
                                    $code = $code . $category->code;
                                }
                            @endphp
                            @if($amount)
                                <tr>
                                    <td class="border border-gray-300 p-4 text-sm text-center">
                                        {{ $code . "-" . $part->code }}
                                    </td>
                                    <td class="border border-gray-300 p-4 text-sm text-center">
                                        {{ $part->name }}
                                    </td>
                                    <td class="border border-gray-300 p-4 text-sm text-center">
                                        {{ $part->unit }}
                                    </td>
                                    <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                                        @if($amount->price > 0)
                                            {{ number_format($amount->price) }} تومان
                                        @else
                                            {{ number_format($part->price) }} تومان
                                        @endif
                                    </td>
                                    <td class="border border-gray-300 p-4 text-sm text-center">
                                        {{ $amount->value }}
                                    </td>
                                    <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                                        @if($amount->price > 0)
                                            {{ number_format($amount->price * $amount->value) }} تومان
                                        @else
                                            {{ number_format($part->price * $amount->value) }} تومان
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                    @if(!$modell->parts->isEmpty())
                        @foreach($modell->parts as $part)
                            @php
                                $amount = $product->amounts()->where('part_id',$part->id)->first();
                                if($amount){
                                    if ($amount->price > 0){
                                        $totalModellPrice += ($part->price * $amount->value) + ($amount->price * $amount->value);
                                    } else {
                                        $totalModellPrice += ($part->price * $amount->value);
                                    }
                                }
                               $code = '';
                                foreach($part->categories as $category){
                                    $code = $code . $category->code;
                                }
                            @endphp
                            @if($amount)
                                <tr>
                                    <td class="border border-gray-300 p-4 text-sm text-center">
                                        {{ $code . "-" . $part->code }}
                                    </td>
                                    <td class="border border-gray-300 p-4 text-sm text-center">
                                        {{ $part->name }}
                                    </td>
                                    <td class="border border-gray-300 p-4 text-sm text-center">
                                        {{ $part->unit }}
                                    </td>
                                    <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                                        @if($amount->price > 0)
                                            {{ number_format($amount->price) }} تومان
                                        @else
                                            {{ number_format($part->price) }} تومان
                                        @endif
                                    </td>
                                    <td class="border border-gray-300 p-4 text-sm text-center">
                                        {{ $amount->value ?? '' }}
                                    </td>
                                    <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                                        @if($amount->price > 0)
                                            {{ number_format($amount->price * $amount->value) }} تومان
                                        @else
                                            {{ number_format($part->price * $amount->value) }} تومان
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                    @php
                        $totalPrice = $totalGroupPrice + $totalModellPrice;
                    @endphp

                    <tr>
                        <td class="border border-gray-300 p-4 text-lg text-center font-bold" colspan="5">
                            جمع قیمت ماتریال یک دستگاه
                        </td>
                        <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                            {{ number_format($totalPrice) }} تومان
                        </td>
                    </tr>
                    @if($product->percent > 0)
                        <tr>
                            <td class="border border-gray-300 p-4 text-lg text-center font-bold" colspan="5">
                                ضریب ثبت شده
                            </td>
                            <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                                {{ $product->percent }}
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 p-4 text-lg text-center font-bold" colspan="5">
                                قیمت دستگاه با اعمال ضریب
                            </td>
                            <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                                {{ number_format($totalPrice * $product->percent) }} تومان
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td class="border border-gray-300 p-4 text-lg text-center font-bold" colspan="5">
                            تعداد
                        </td>
                        <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                            {{ $product->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 p-4 text-lg text-center font-bold" colspan="5">
                            قیمت کل
                        </td>
                        <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                            {{ number_format($totalPrice * $product->percent * $product->quantity) }} تومان
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <!-- Mobile List -->
            <div class="block md:hidden shadow-md border border-gray-200 rounded-md p-4 bg-white mb-4">
                <div class="mb-4 border-b border-gray-200 pb-2">
                    <p class="text-center text-sm font-black font-bold">
                        لیست قطعات و قیمت محصول {{ $group->name }} - {{ $modell->name }}
                    </p>
                </div>
                @foreach($group->parts as $part)
                    @php
                        $amount = $product->amounts()->where('part_id',$part->id)->first();
                        if($amount){
                            if ($amount->price > 0){
                                $totalGroupPrice += ($part->price * $amount->value) + ($amount->price * $amount->value);
                            } else {
                                $totalGroupPrice += ($part->price * $amount->value);
                            }
                        }
                        $code = '';
                        foreach($part->categories as $category){
                            $code = $code . $category->code;
                        }
                    @endphp
                    @if($amount)
                        <div class="p-2 border border-gray-300 rounded-md shadow-sm bg-gray-100 mb-4">
                            <div class="space-y-4">
                                <p class="text-xs text-black text-center font-bold">
                                    {{ $part->name }}
                                </p>
                                <p class="text-xs text-black text-center">
                                    واحد : {{ $part->unit }}
                                </p>
                                <p class="text-xs text-black text-center font-medium">
                                    قیمت واحد :
                                    @if($amount->price > 0)
                                        {{ number_format($amount->price) }} تومان
                                    @else
                                        {{ number_format($part->price) }} تومان
                                    @endif
                                </p>
                                <p class="text-xs text-black text-center font-bold">
                                    مقدار : {{ $amount->value }}
                                </p>
                                <p class="text-xs text-black text-center font-medium">
                                    جمع کل :
                                    @if($amount->price > 0)
                                        {{ number_format($amount->price * $amount->value) }} تومان
                                    @else
                                        {{ number_format($part->price * $amount->value) }} تومان
                                    @endif
                                </p>
                            </div>
                        </div>
                    @endif
                @endforeach
                <div class="flex justify-between items-center mb-2 border border-gray-500 rounded-md p-2">
                    <p class="text-base font-medium text-black">
                        جمع قیمت ماتریال یک دستگاه
                    </p>
                    <p class="text-base font-medium text-green-600">
                        {{ number_format($totalPrice) }} تومان
                    </p>
                </div>
                @if($product->percent > 0)
                    <div class="flex justify-between items-center mb-2 border border-gray-500 rounded-md p-2">
                        <p class="text-base font-medium text-black">
                            ضریب ثبت شده
                        </p>
                        <p class="text-base font-medium text-green-600">
                            {{ $product->percent }}
                        </p>
                    </div>
                    <div class="flex justify-between items-center mb-2 border border-gray-500 rounded-md p-2">
                        <p class="text-base font-medium text-black">
                            قیمت دستگاه با اعمال ضریب
                        </p>
                        <p class="text-base font-medium text-green-600">
                            {{ number_format($totalPrice * $product->percent) }} تومان
                        </p>
                    </div>
                @endif
                <div class="flex justify-between items-center mb-2 border border-gray-500 rounded-md p-2">
                    <p class="text-base font-medium text-black">
                        تعداد
                    </p>
                    <p class="text-base font-medium text-green-600">
                        {{ $product->quantity }}
                    </p>
                </div>
                <div class="flex justify-between items-center mb-2 border border-gray-500 rounded-md p-2">
                    <p class="text-base font-medium text-black">
                        قیمت کل
                    </p>
                    <p class="text-base font-medium text-green-600">
                        {{ number_format($totalPrice * $product->percent * $product->quantity) }} تومان
                    </p>
                </div>
            </div>
        @endforeach

        @foreach($inquiry->products()->where('part_id','!=',0)->get() as $product)
            @php
                $finalPrice += $product->price;
                $part = \App\Models\Part::find($product->part_id);
                $code = '';
                foreach($part->categories as $category){
                    $code = $code . $category->code;
                }
            @endphp

            <!-- Laptop List -->
            <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4 hidden md:block">
                <div class="mb-4">
                    <p class="text-center text-lg font-black font-bold">
                        تک قطعه <span class="text-red-600">{{ $part->name }}</span>
                    </p>
                </div>
                <table class="border-collapse border border-gray-400 w-full">
                    <thead>
                    <tr>
                        <th class="border border-gray-300 p-4 text-sm">کد قطعه</th>
                        <th class="border border-gray-300 p-4 text-sm">نام قطعه</th>
                        <th class="border border-gray-300 p-4 text-sm">واحد قطعه</th>
                        <th class="border border-gray-300 p-4 text-sm">قیمت</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            {{ $code . "-" . $part->code }}
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            {{ $part->name }}
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            {{ $part->unit }}
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                            {{ number_format($part->price) }} تومان
                        </td>
                    </tr>
                    @if($product->percent > 0)
                        <tr>
                            <td class="border border-gray-300 p-4 text-lg text-center font-bold" colspan="3">
                                ضریب ثبت شده
                            </td>
                            <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                                {{ $product->percent }}
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 p-4 text-lg text-center font-bold" colspan="3">
                                قیمت دستگاه با اعمال ضریب
                            </td>
                            <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                                {{ number_format($product->price) }} تومان
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td class="border border-gray-300 p-4 text-lg text-center font-bold" colspan="3">
                            تعداد
                        </td>
                        <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                            {{ $product->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 p-4 text-lg text-center font-bold" colspan="3">
                            قیمت کل
                        </td>
                        <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                            {{ number_format($product->price * $product->quantity) }} تومان
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <!-- Mobile List -->
            <div class="block md:hidden shadow-md border border-gray-200 rounded-md p-4 bg-white mb-4">
                <div class="mb-4 border-b border-gray-200 pb-2">
                    <p class="text-center text-sm font-black font-bold">
                        لیست قطعات و قیمت محصول {{ $group->name }} - {{ $modell->name }}
                    </p>
                </div>
                @foreach($group->parts as $part)
                    @php
                        $amount = $product->amounts()->where('part_id',$part->id)->first();
                        if($amount){
                            if ($amount->price > 0){
                                $totalGroupPrice += ($part->price * $amount->value) + ($amount->price * $amount->value);
                            } else {
                                $totalGroupPrice += ($part->price * $amount->value);
                            }
                        }
                        $code = '';
                        foreach($part->categories as $category){
                            $code = $code . $category->code;
                        }
                    @endphp
                    @if($amount)
                        <div class="p-2 border border-gray-300 rounded-md shadow-sm bg-gray-100 mb-4">
                            <div class="space-y-4">
                                <p class="text-xs text-black text-center font-bold">
                                    {{ $part->name }}
                                </p>
                                <p class="text-xs text-black text-center">
                                    واحد : {{ $part->unit }}
                                </p>
                                <p class="text-xs text-black text-center font-medium">
                                    قیمت واحد :
                                    @if($amount->price > 0)
                                        {{ number_format($amount->price) }} تومان
                                    @else
                                        {{ number_format($part->price) }} تومان
                                    @endif
                                </p>
                                <p class="text-xs text-black text-center font-bold">
                                    مقدار : {{ $amount->value }}
                                </p>
                                <p class="text-xs text-black text-center font-medium">
                                    جمع کل :
                                    @if($amount->price > 0)
                                        {{ number_format($amount->price * $amount->value) }} تومان
                                    @else
                                        {{ number_format($part->price * $amount->value) }} تومان
                                    @endif
                                </p>
                            </div>
                        </div>
                    @endif
                @endforeach
                <div class="flex justify-between items-center mb-2 border border-gray-500 rounded-md p-2">
                    <p class="text-base font-medium text-black">
                        جمع قیمت ماتریال یک دستگاه
                    </p>
                    <p class="text-base font-medium text-green-600">
                        {{ number_format($totalPrice) }} تومان
                    </p>
                </div>
                @if($product->percent > 0)
                    <div class="flex justify-between items-center mb-2 border border-gray-500 rounded-md p-2">
                        <p class="text-base font-medium text-black">
                            ضریب ثبت شده
                        </p>
                        <p class="text-base font-medium text-green-600">
                            {{ $product->percent }}
                        </p>
                    </div>
                    <div class="flex justify-between items-center mb-2 border border-gray-500 rounded-md p-2">
                        <p class="text-base font-medium text-black">
                            قیمت دستگاه با اعمال ضریب
                        </p>
                        <p class="text-base font-medium text-green-600">
                            {{ number_format($totalPrice * $product->percent) }} تومان
                        </p>
                    </div>
                @endif
                <div class="flex justify-between items-center mb-2 border border-gray-500 rounded-md p-2">
                    <p class="text-base font-medium text-black">
                        تعداد
                    </p>
                    <p class="text-base font-medium text-green-600">
                        {{ $product->quantity }}
                    </p>
                </div>
                <div class="flex justify-between items-center mb-2 border border-gray-500 rounded-md p-2">
                    <p class="text-base font-medium text-black">
                        قیمت کل
                    </p>
                    <p class="text-base font-medium text-green-600">
                        {{ number_format($totalPrice * $product->percent * $product->quantity) }} تومان
                    </p>
                </div>
            </div>
        @endforeach

        <div class="bg-green-500 p-4 rounded-md shadow-md mt-4 sticky bottom-4">
            @if($inquiry->price > 0)
                <p class="text-xl text-black font-bold text-center">
                    قیمت نهایی کل استعلام : {{ number_format($inquiry->price) }} تومان
                </p>
            @else
                <p class="text-xl text-black font-bold text-center">
                    قیمت نهایی کل استعلام : {{ number_format($finalPrice) }} تومان
                </p>
            @endif
        </div>

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
    </div>
</x-layout>
