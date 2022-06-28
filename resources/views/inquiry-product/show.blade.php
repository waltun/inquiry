<x-layout>
    <!-- Breadcrumb -->
    <nav class="flex bg-gray-100 p-4 rounded-md overflow-x-auto" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-2 space-x-reverse whitespace-nowrap">
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
                        جزئیات محصول
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Navigation Btn -->
    <div class="mt-4 flex justify-between space-x-4 space-x-reverse">
        <div>
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
        <div>
            <a href="{{ route('inquiries.product.index',$inquiry->id) }}" class="form-detail-btn text-xs">
                لیست محصولات استعلام
            </a>
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
                    شماره استعلام : {{ $inquiry->inquiry_number }}
                </p>
                <p class="font-bold text-black md:text-lg text-sm text-center">
                    مسئول پروژه : {{ $inquiry->manager }}
                </p>
            </div>
        </div>

        <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4">
            <div class="md:flex justify-around items-center space-y-4 md:space-y-0">
                <p class="font-bold text-red-600 md:text-lg text-sm text-center">
                    گروه : {{ $group->name }} با کد {{ $group->code }}
                </p>
                <p class="font-bold text-red-600 md:text-lg text-sm text-center">
                    مدل : {{ $modell->name }} با کد {{ $modell->code }}
                </p>
            </div>
        </div>

        <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4">

            <div class="mb-4">
                <p class="text-center text-sm font-black font-bold">
                    لیست قطعات و قیمت
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
                @foreach($group->parts as $part)
                    @php
                        $amount = $product->amounts()->where('part_id',$part->id)->first();
                        if ($amount){
                            $totalGroupPrice += ($part->price * $amount->value);
                        }
                    @endphp
                    <tr>
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            {{ $part->code }}
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
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            {{ $amount->value }}
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                            {{ number_format($part->price * $amount->value) }} تومان
                        </td>
                    </tr>
                @endforeach

                @if(!$modell->parts->isEmpty())
                    @foreach($modell->parts as $part)
                        @php
                            $amount = $product->amounts()->where('part_id',$part->id)->first();
                            if ($amount){
                                $totalModellPrice += ($part->price * $amount->value);
                            }
                        @endphp
                        <tr>
                            <td class="border border-gray-300 p-4 text-sm text-center">
                                {{ $part->code }}
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
                            <td class="border border-gray-300 p-4 text-sm text-center">
                                {{ $amount->value }}
                            </td>
                            <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                                {{ number_format($part->price * $amount->value) }} تومان
                            </td>
                        </tr>
                    @endforeach
                @endif
                @php
                    $totalPrice = $totalGroupPrice + $totalModellPrice;
                @endphp
                <tr>
                    <td class="border border-gray-300 p-4 text-lg text-center font-bold" colspan="5">
                        قیمت کل
                    </td>
                    <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                        {{ number_format($totalPrice) }} تومان
                    </td>
                </tr>
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
                        قیمت نهایی
                    </td>
                    <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                        {{ number_format($totalPrice * $product->quantity) }} تومان
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
                            قیمت نهایی
                        </td>
                        <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                            {{ number_format($product->price) }} تومان
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4 space-y-2">
                <p class="text-sm font-bold text-black text-center">
                    ایجاد محصول : {{ jdate($product->created_at)->format('%A, %d %B %Y') }}
                </p>
                <p class="text-sm font-bold text-black text-center">
                    ساعت : {{ jdate($product->created_at)->format('H:i:s') }}
                </p>
            </div>
            <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4 space-y-2">
                <p class="text-sm font-bold text-black text-center">
                    آخرین بروزرسانی محصول : {{ jdate($product->updated_at)->format('%A, %d %B %Y') }}
                </p>
                <p class="text-sm font-bold text-black text-center">
                    ساعت : {{ jdate($product->updated_at)->format('H:i:s') }}
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
