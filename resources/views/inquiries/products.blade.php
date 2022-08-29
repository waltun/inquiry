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
                        محصولات استعلام {{ $inquiry->name }} به شماره استعلام {{ $inquiry->inquiry_number }}
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Navigation Btn -->
    <div class="my-4 md:flex justify-between">
        <div class="mb-4 md:mb-0">
            <p class="text-lg text-black font-bold">
                مشاهده قیمت محصولات
            </p>
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


        <!-- Laptop List Products -->
        <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4 hidden md:block">
            <div class="mb-4">
                <p class="text-sm font-bold text-xl text-center">لیست محصولات</p>
            </div>
            <table class="border-collapse border border-gray-400 w-full">
                <thead>
                <tr>
                    <th class="border border-gray-300 p-4 text-sm">ردیف</th>
                    <th class="border border-gray-300 p-4 text-sm">کد محصول</th>
                    <th class="border border-gray-300 p-4 text-sm">گروه محصول</th>
                    <th class="border border-gray-300 p-4 text-sm">مدل محصول</th>
                    <th class="border border-gray-300 p-4 text-sm">تعداد</th>
                    <th class="border border-gray-300 p-4 text-sm">قیمت واحد</th>
                    <th class="border border-gray-300 p-4 text-sm">قیمت کل</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $productFinalPrice = 0;
                @endphp
                @foreach($inquiry->products()->where('group_id','!=',0)->where('model_id','!=',0)->get() as $product)
                    @php
                        $group = \App\Models\Group::find($product->group_id);
                        $modell = \App\Models\Modell::find($product->model_id);
                        $totalGroupPrice = 0;
                        $totalModellPrice = 0;
                        if (!$group->parts->isEmpty()) {
                            foreach($group->parts as $part)
                        {
                            $amount = $product->amounts()->where('part_id',$part->id)->first();
                            if ($amount){
                                if ($amount->price > 0){
                                $totalGroupPrice += ($part->price * $amount->value) + ($amount->price * $amount->value);
                            } else {
                                $totalGroupPrice += ($part->price * $amount->value);
                            }
                            }
                        }
                        }

                        if(!$modell->parts->isEmpty())
                        {
                            foreach($modell->parts as $part)
                            {
                                $amount = $product->amounts()->where('part_id',$part->id)->first();
                                if ($amount){
                                    if ($amount->price > 0){
                                    $totalModellPrice += ($part->price * $amount->value) + ($amount->price * $amount->value);
                                } else {
                                    $totalModellPrice += ($part->price * $amount->value);
                                }
                                }
                            }
                        }
                        $totalPrice = $totalModellPrice + $totalGroupPrice;
                        $productFinalPrice += ($totalPrice * $product->percent) * $product->quantity;
                    @endphp
                    <tr>
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            {{ $loop->index + 1 }}
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            {{ $group->code }}-{{ $modell->code}}
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            {{ $group->name }}
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            {{ $modell->name }}
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            {{ $product->quantity }}
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                            {{ number_format($product->price) }} تومان
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                            {{ number_format($product->price * $product->quantity) }} تومان
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tr>
                    <td class="border border-gray-300 p-4 text-lg text-center font-bold" colspan="6">
                        قیمت کل
                    </td>
                    <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                        {{ number_format($productFinalPrice) }} تومان
                    </td>
                </tr>
            </table>
        </div>


        <!-- Laptop List Parts -->
        <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4 hidden md:block">
            <div class="mb-4">
                <p class="text-sm font-bold text-xl text-center">لیست قطعات تکی</p>
            </div>
            <table class="border-collapse border border-gray-400 w-full">
                <thead>
                <tr>
                    <th class="border border-gray-300 p-4 text-sm">ردیف</th>
                    <th class="border border-gray-300 p-4 text-sm">کد قطعه</th>
                    <th class="border border-gray-300 p-4 text-sm">نام قطعه</th>
                    <th class="border border-gray-300 p-4 text-sm">تعداد</th>
                    <th class="border border-gray-300 p-4 text-sm">قیمت واحد</th>
                    <th class="border border-gray-300 p-4 text-sm">قیمت کل</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $partFinalPrice = 0;
                @endphp
                @foreach($inquiry->products()->where('part_id','!=',0)->get() as $product)
                    @php
                        $part = \App\Models\Part::find($product->part_id);
                        $partFinalPrice += $product->price * $product->quantity;
                    @endphp
                    <tr>
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            {{ $loop->index + 1 }}
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            {{ $part->code }}
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            {{ $part->name }}
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            {{ $product->quantity }}
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                            {{ number_format($product->price) }} تومان
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                            {{ number_format($product->price * $product->quantity) }} تومان
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tr>
                    <td class="border border-gray-300 p-4 text-lg text-center font-bold" colspan="5">
                        قیمت کل
                    </td>
                    <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                        {{ number_format($partFinalPrice) }} تومان
                    </td>
                </tr>
            </table>
        </div>


        <!-- Mobile List -->
        <div class="block md:hidden shadow-md border border-gray-200 rounded-md p-4 bg-white mb-4">
            @foreach($inquiry->products()->where('group_id','!=',0)->where('model_id','!=',0)->get() as $product)
                @php
                    $group = \App\Models\Group::find($product->group_id);
                    $modell = \App\Models\Modell::find($product->model_id);
                    $totalGroupPrice = 0;
                    $totalModellPrice = 0;
                    foreach($group->parts as $part)
                    {
                        $amount = $product->amounts()->where('part_id',$part->id)->first();
                        if ($amount){
                            if ($amount->price > 0){
                            $totalGroupPrice += ($part->price * $amount->value) + ($amount->price * $amount->value);
                        } else {
                            $totalGroupPrice += ($part->price * $amount->value);
                        }
                        }
                    }
                    if(!$modell->parts->isEmpty())
                    {
                        foreach($modell->parts as $part)
                        {
                            $amount = $product->amounts()->where('part_id',$part->id)->first();
                            if ($amount){
                                if ($amount->price > 0){
                                $totalModellPrice += ($part->price * $amount->value) + ($amount->price * $amount->value);
                            } else {
                                $totalModellPrice += ($part->price * $amount->value);
                            }
                            }
                        }
                    }
                    $totalPrice = $totalModellPrice + $totalGroupPrice;
                    $productFinalPrice += ($totalPrice * $product->percent) * $product->quantity;
                @endphp
                <div class="p-2 border border-gray-300 rounded-md shadow-sm bg-gray-100 mb-4">
                    <div class="space-y-4">
                        <p class="text-xs text-black text-center font-bold">
                            گروه : {{ $group->name }}
                        </p>
                        <p class="text-xs text-black text-center font-bold">
                            مدل : {{ $modell->name }}
                        </p>
                        <p class="text-xs text-gray-600 text-center">
                            کد : {{ $modell->code . "-" . $group->code }}
                        </p>
                        <p class="text-xs text-black text-center font-medium">
                            قیمت واحد : {{ number_format($totalPrice * $product->percent) }} تومان
                        </p>
                        <p class="text-xs text-black text-center font-bold">
                            تعداد : {{ $product->quantity }}
                        </p>
                        <p class="text-xs text-black text-center font-medium">
                            قیمت کل : {{ number_format(($totalPrice * $product->percent) * $product->quantity) }} تومان
                        </p>
                    </div>
                </div>
            @endforeach

            <div class="flex justify-between items-center mb-2 border border-gray-500 rounded-md p-2">
                <p class="text-base font-medium text-black">
                    قیمت کل
                </p>
                @if($inquiry->price > 0)
                    <p class="text-base font-medium text-green-600">
                        {{ number_format($inquiry->price) }} تومان
                    </p>
                @else
                    <p class="text-base font-medium text-green-600">
                        {{ number_format($productFinalPrice) }} تومان
                    </p>
                @endif
            </div>

        </div>

        <div class="bg-green-500 p-4 rounded-md shadow-md mt-4 sticky bottom-4">
            @if($inquiry->price > 0)
                <p class="text-xl text-black font-bold text-center">
                    قیمت نهایی کل استعلام : {{ number_format($inquiry->price) }} تومان
                </p>
            @else
                <p class="text-xl text-black font-bold text-center">
                    قیمت نهایی کل استعلام : {{ number_format($partFinalPrice + $productFinalPrice) }} تومان
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
