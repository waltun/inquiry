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

    <!-- Print Btn -->
    <div>
        <a href="{{ route('inquiries.products.print',$inquiry->id) }}" class="form-percent-btn inline-flex items-center"
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

        <!-- Info -->
        <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4">
            <div class="md:flex justify-between items-center space-y-4 md:space-y-0">
                <p class="font-bold text-black md:text-lg text-sm text-center">
                    نام پروژه : {{ $inquiry->name }}
                </p>
                <p class="font-bold text-black md:text-lg text-sm text-center">
                    شماره استعلام : {{ "INQ-" . $inquiry->inquiry_number }}
                </p>
                <p class="font-bold text-black md:text-lg text-sm text-center">
                    @php
                        $user = \App\Models\User::where('id',$inquiry->user_id)->first();
                    @endphp
                    مسئول پروژه : {{ $user->name }}
                </p>
            </div>
        </div>

        <!-- Laptop List Products -->
        @if(!$inquiry->products()->where('group_id','!=',0)->where('model_id','!=',0)->orderBy('sort','ASC')->get()->isEmpty())
            <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4 hidden md:block">
                <div class="mb-4">
                    <p class="text-sm font-bold text-xl text-center">لیست محصولات</p>
                </div>
                <table class="border-collapse border border-gray-400 w-full">
                    <thead>
                    <tr class="bg-indigo-200">
                        <th class="border border-white p-4 text-sm">ردیف</th>
                        <th class="border border-white p-4 text-sm">دسته محصول</th>
                        <th class="border border-white p-4 text-sm">مدل محصول</th>
                        <th class="border border-white p-4 text-sm">تگ</th>
                        <th class="border border-white p-4 text-sm">وزن</th>
                        <th class="border border-white p-4 text-sm">تعداد</th>
                        <th class="border border-white p-4 text-sm">قیمت واحد</th>
                        <th class="border border-white p-4 text-sm">قیمت کل</th>
                        <th class="border border-white p-4 text-sm">تاییدیه قیمت</th>
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
                            $totalPrice = 0;
                            $productFinalPrice += $product->price * $product->quantity;
                        @endphp
                        <tr>
                            <td class="border border-gray-300 p-4 text-sm text-center">
                                {{ $loop->index + 1 }}
                            </td>
                            <td class="border border-gray-300 p-4 text-sm text-center">
                                {{ $modell->parent->name }}
                            </td>
                            <td class="border border-gray-300 p-4 text-sm text-center">
                                {{ $product->model_custom_name ?? $modell->name }}
                            </td>
                            <td class="border border-gray-300 p-4 text-sm text-center">
                                {{ $product->description ?? '-' }}
                            </td>
                            <td class="border border-gray-300 p-4 text-sm text-center">
                                {{ $product->weight }}
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
                            <td class="border border-gray-300 p-4 text-sm text-center">
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
                    @endforeach
                    </tbody>
                    <tr>
                        <td class="border border-gray-300 p-4 text-lg text-center font-bold" colspan="7">
                            قیمت کل
                        </td>
                        <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                            {{ number_format($productFinalPrice) }} تومان
                        </td>
                    </tr>
                </table>
            </div>
        @endif

        <!-- Laptop List Parts -->
        @if(!$inquiry->products()->where('part_id','!=',0)->where('type','setup')->orderBy('sort','ASC')->get()->isEmpty())
            <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4 hidden md:block">
                <div class="mb-4">
                    <p class="text-sm font-bold text-xl text-center">لیست قطعات راه اندازی</p>
                </div>
                <table class="border-collapse border border-gray-400 w-full">
                    <thead>
                    <tr class="bg-indigo-200">
                        <th class="border border-white p-4 text-sm">ردیف</th>
                        <th class="border border-white p-4 text-sm">نام قطعه</th>
                        <th class="border border-white p-4 text-sm">تعداد</th>
                        <th class="border border-white p-4 text-sm">قیمت واحد</th>
                        <th class="border border-white p-4 text-sm">قیمت کل</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $partFinalPrice = 0;
                    @endphp
                    @foreach($inquiry->products()->where('part_id','!=',0)->where('type','setup')->orderBy('sort','ASC')->get() as $product)
                        @php
                            $part = \App\Models\Part::find($product->part_id);
                            $partFinalPrice += $product->price * $product->quantity;
                        @endphp
                        <tr>
                            <td class="border border-gray-300 p-4 text-sm text-center">
                                {{ $loop->index + 1 }}
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
                        <td class="border border-gray-300 p-4 text-lg text-center font-bold" colspan="4">
                            قیمت کل
                        </td>
                        <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                            {{ number_format($partFinalPrice) }} تومان
                        </td>
                    </tr>
                </table>
            </div>
        @endif

        @if(!$inquiry->products()->where('part_id','!=',0)->where('type','years')->orderBy('sort','ASC')->get()->isEmpty())
            <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4 hidden md:block">
                <div class="mb-4">
                    <p class="text-sm font-bold text-xl text-center">لیست قطعات دو سالانه</p>
                </div>
                <table class="border-collapse border border-gray-400 w-full">
                    <thead>
                    <tr class="bg-indigo-200">
                        <th class="border border-white p-4 text-sm">ردیف</th>
                        <th class="border border-white p-4 text-sm">نام قطعه</th>
                        <th class="border border-white p-4 text-sm">تعداد</th>
                        <th class="border border-white p-4 text-sm">قیمت واحد</th>
                        <th class="border border-white p-4 text-sm">قیمت کل</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $partFinalPrice = 0;
                    @endphp
                    @foreach($inquiry->products()->where('part_id','!=',0)->where('type','years')->orderBy('sort','ASC')->get() as $product)
                        @php
                            $part = \App\Models\Part::find($product->part_id);
                            $partFinalPrice += $product->price * $product->quantity;
                        @endphp
                        <tr>
                            <td class="border border-gray-300 p-4 text-sm text-center">
                                {{ $loop->index + 1 }}
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
                        <td class="border border-gray-300 p-4 text-lg text-center font-bold" colspan="4">
                            قیمت کل
                        </td>
                        <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                            {{ number_format($partFinalPrice) }} تومان
                        </td>
                    </tr>
                </table>
            </div>
        @endif

        @if(!$inquiry->products()->where('part_id','!=',0)->where('type','control')->orderBy('sort','ASC')->get()->isEmpty())
            <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4 hidden md:block">
                <div class="mb-4">
                    <p class="text-sm font-bold text-xl text-center">لیست قطعات کنترلی</p>
                </div>
                <table class="border-collapse border border-gray-400 w-full">
                    <thead>
                    <tr class="bg-indigo-200">
                        <th class="border border-white p-4 text-sm">ردیف</th>
                        <th class="border border-white p-4 text-sm">نام قطعه</th>
                        <th class="border border-white p-4 text-sm">تعداد</th>
                        <th class="border border-white p-4 text-sm">قیمت واحد</th>
                        <th class="border border-white p-4 text-sm">قیمت کل</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $partFinalPrice = 0;
                    @endphp
                    @foreach($inquiry->products()->where('part_id','!=',0)->where('type','control')->orderBy('sort','ASC')->get() as $product)
                        @php
                            $part = \App\Models\Part::find($product->part_id);
                            $partFinalPrice += $product->price * $product->quantity;
                        @endphp
                        <tr>
                            <td class="border border-gray-300 p-4 text-sm text-center">
                                {{ $loop->index + 1 }}
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
                        <td class="border border-gray-300 p-4 text-lg text-center font-bold" colspan="4">
                            قیمت کل
                        </td>
                        <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                            {{ number_format($partFinalPrice) }} تومان
                        </td>
                    </tr>
                </table>
            </div>
        @endif

        @if(!$inquiry->products()->where('part_id','!=',0)->where('type','power_cable')->orderBy('sort','ASC')->get()->isEmpty())
            <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4 hidden md:block">
                <div class="mb-4">
                    <p class="text-sm font-bold text-xl text-center">لیست قطعات کابل قدرت</p>
                </div>
                <table class="border-collapse border border-gray-400 w-full">
                    <thead>
                    <tr class="bg-indigo-200">
                        <th class="border border-white p-4 text-sm">ردیف</th>
                        <th class="border border-white p-4 text-sm">نام قطعه</th>
                        <th class="border border-white p-4 text-sm">تعداد</th>
                        <th class="border border-white p-4 text-sm">قیمت واحد</th>
                        <th class="border border-white p-4 text-sm">قیمت کل</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $partFinalPrice = 0;
                    @endphp
                    @foreach($inquiry->products()->where('part_id','!=',0)->where('type','power_cable')->orderBy('sort','ASC')->get() as $product)
                        @php
                            $part = \App\Models\Part::find($product->part_id);
                            $partFinalPrice += $product->price * $product->quantity;
                        @endphp
                        <tr>
                            <td class="border border-gray-300 p-4 text-sm text-center">
                                {{ $loop->index + 1 }}
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
                        <td class="border border-gray-300 p-4 text-lg text-center font-bold" colspan="4">
                            قیمت کل
                        </td>
                        <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                            {{ number_format($partFinalPrice) }} تومان
                        </td>
                    </tr>
                </table>
            </div>
        @endif

        @if(!$inquiry->products()->where('part_id','!=',0)->where('type','control_cable')->orderBy('sort','ASC')->get()->isEmpty())
            <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4 hidden md:block">
                <div class="mb-4">
                    <p class="text-sm font-bold text-xl text-center">لیست قطعات کابل کنترلی</p>
                </div>
                <table class="border-collapse border border-gray-400 w-full">
                    <thead>
                    <tr class="bg-indigo-200">
                        <th class="border border-white p-4 text-sm">ردیف</th>
                        <th class="border border-white p-4 text-sm">نام قطعه</th>
                        <th class="border border-white p-4 text-sm">تعداد</th>
                        <th class="border border-white p-4 text-sm">قیمت واحد</th>
                        <th class="border border-white p-4 text-sm">قیمت کل</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $partFinalPrice = 0;
                    @endphp
                    @foreach($inquiry->products()->where('part_id','!=',0)->where('type','control_cable')->orderBy('sort','ASC')->get() as $product)
                        @php
                            $part = \App\Models\Part::find($product->part_id);
                            $partFinalPrice += $product->price * $product->quantity;
                        @endphp
                        <tr>
                            <td class="border border-gray-300 p-4 text-sm text-center">
                                {{ $loop->index + 1 }}
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
                        <td class="border border-gray-300 p-4 text-lg text-center font-bold" colspan="4">
                            قیمت کل
                        </td>
                        <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                            {{ number_format($partFinalPrice) }} تومان
                        </td>
                    </tr>
                </table>
            </div>
        @endif

        @if(!$inquiry->products()->where('part_id','!=',0)->where('type','pipe')->orderBy('sort','ASC')->get()->isEmpty())
            <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4 hidden md:block">
                <div class="mb-4">
                    <p class="text-sm font-bold text-xl text-center">لیست قطعات لوله و اتصالات</p>
                </div>
                <table class="border-collapse border border-gray-400 w-full">
                    <thead>
                    <tr class="bg-indigo-200">
                        <th class="border border-white p-4 text-sm">ردیف</th>
                        <th class="border border-white p-4 text-sm">نام قطعه</th>
                        <th class="border border-white p-4 text-sm">تعداد</th>
                        <th class="border border-white p-4 text-sm">قیمت واحد</th>
                        <th class="border border-white p-4 text-sm">قیمت کل</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $partFinalPrice = 0;
                    @endphp
                    @foreach($inquiry->products()->where('part_id','!=',0)->where('type','pipe')->orderBy('sort','ASC')->get() as $product)
                        @php
                            $part = \App\Models\Part::find($product->part_id);
                            $partFinalPrice += $product->price * $product->quantity;
                        @endphp
                        <tr>
                            <td class="border border-gray-300 p-4 text-sm text-center">
                                {{ $loop->index + 1 }}
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
                        <td class="border border-gray-300 p-4 text-lg text-center font-bold" colspan="4">
                            قیمت کل
                        </td>
                        <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                            {{ number_format($partFinalPrice) }} تومان
                        </td>
                    </tr>
                </table>
            </div>
        @endif

        @if(!$inquiry->products()->where('part_id','!=',0)->where('type','setup_price')->orderBy('sort','ASC')->get()->isEmpty())
            <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4 hidden md:block">
                <div class="mb-4">
                    <p class="text-sm font-bold text-xl text-center">لیست قطعات دستمزد راه اندازی و نصب</p>
                </div>
                <table class="border-collapse border border-gray-400 w-full">
                    <thead>
                    <tr class="bg-indigo-200">
                        <th class="border border-white p-4 text-sm">ردیف</th>
                        <th class="border border-white p-4 text-sm">نام قطعه</th>
                        <th class="border border-white p-4 text-sm">تعداد</th>
                        <th class="border border-white p-4 text-sm">قیمت واحد</th>
                        <th class="border border-white p-4 text-sm">قیمت کل</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $partFinalPrice = 0;
                    @endphp
                    @foreach($inquiry->products()->where('part_id','!=',0)->where('type','setup_price')->orderBy('sort','ASC')->get() as $product)
                        @php
                            $part = \App\Models\Part::find($product->part_id);
                            $partFinalPrice += $product->price * $product->quantity;
                        @endphp
                        <tr>
                            <td class="border border-gray-300 p-4 text-sm text-center">
                                {{ $loop->index + 1 }}
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
                        <td class="border border-gray-300 p-4 text-lg text-center font-bold" colspan="4">
                            قیمت کل
                        </td>
                        <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                            {{ number_format($partFinalPrice) }} تومان
                        </td>
                    </tr>
                </table>
            </div>
        @endif

        @if(!$inquiry->products()->where('part_id','!=',0)->where('type','supervision')->orderBy('sort','ASC')->get()->isEmpty())
            <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4 hidden md:block">
                <div class="mb-4">
                    <p class="text-sm font-bold text-xl text-center">لیست قطعات دستمزد نظارت</p>
                </div>
                <table class="border-collapse border border-gray-400 w-full">
                    <thead>
                    <tr class="bg-indigo-200">
                        <th class="border border-white p-4 text-sm">ردیف</th>
                        <th class="border border-white p-4 text-sm">نام قطعه</th>
                        <th class="border border-white p-4 text-sm">تعداد</th>
                        <th class="border border-white p-4 text-sm">قیمت واحد</th>
                        <th class="border border-white p-4 text-sm">قیمت کل</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $partFinalPrice = 0;
                    @endphp
                    @foreach($inquiry->products()->where('part_id','!=',0)->where('type','supervision')->orderBy('sort','ASC')->get() as $product)
                        @php
                            $part = \App\Models\Part::find($product->part_id);
                            $partFinalPrice += $product->price * $product->quantity;
                        @endphp
                        <tr>
                            <td class="border border-gray-300 p-4 text-sm text-center">
                                {{ $loop->index + 1 }}
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
                        <td class="border border-gray-300 p-4 text-lg text-center font-bold" colspan="4">
                            قیمت کل
                        </td>
                        <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                            {{ number_format($partFinalPrice) }} تومان
                        </td>
                    </tr>
                </table>
            </div>
        @endif

        @if(!$inquiry->products()->where('part_id','!=',0)->where('type','transport')->orderBy('sort','ASC')->get()->isEmpty())
            <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4 hidden md:block">
                <div class="mb-4">
                    <p class="text-sm font-bold text-xl text-center">لیست قطعات هزینه حمل</p>
                </div>
                <table class="border-collapse border border-gray-400 w-full">
                    <thead>
                    <tr class="bg-indigo-200">
                        <th class="border border-white p-4 text-sm">ردیف</th>
                        <th class="border border-white p-4 text-sm">نام قطعه</th>
                        <th class="border border-white p-4 text-sm">تعداد</th>
                        <th class="border border-white p-4 text-sm">قیمت واحد</th>
                        <th class="border border-white p-4 text-sm">قیمت کل</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $partFinalPrice = 0;
                    @endphp
                    @foreach($inquiry->products()->where('part_id','!=',0)->where('type','transport')->orderBy('sort','ASC')->get() as $product)
                        @php
                            $part = \App\Models\Part::find($product->part_id);
                            $partFinalPrice += $product->price * $product->quantity;
                        @endphp
                        <tr>
                            <td class="border border-gray-300 p-4 text-sm text-center">
                                {{ $loop->index + 1 }}
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
                        <td class="border border-gray-300 p-4 text-lg text-center font-bold" colspan="4">
                            قیمت کل
                        </td>
                        <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                            {{ number_format($partFinalPrice) }} تومان
                        </td>
                    </tr>
                </table>
            </div>
        @endif

        @if(!$inquiry->products()->where('part_id','!=',0)->where('type','other')->orderBy('sort','ASC')->get()->isEmpty())
            <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4 hidden md:block">
                <div class="mb-4">
                    <p class="text-sm font-bold text-xl text-center">لیست سایر تجهیزات</p>
                </div>
                <table class="border-collapse border border-gray-400 w-full">
                    <thead>
                    <tr class="bg-indigo-200">
                        <th class="border border-white p-4 text-sm">ردیف</th>
                        <th class="border border-white p-4 text-sm">نام قطعه</th>
                        <th class="border border-white p-4 text-sm">تعداد</th>
                        <th class="border border-white p-4 text-sm">قیمت واحد</th>
                        <th class="border border-white p-4 text-sm">قیمت کل</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $partFinalPrice = 0;
                    @endphp
                    @foreach($inquiry->products()->where('part_id','!=',0)->where('type','other')->orderBy('sort','ASC')->get() as $product)
                        @php
                            $part = \App\Models\Part::find($product->part_id);
                            $partFinalPrice += $product->price * $product->quantity;
                        @endphp
                        <tr>
                            <td class="border border-gray-300 p-4 text-sm text-center">
                                {{ $loop->index + 1 }}
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
                        <td class="border border-gray-300 p-4 text-lg text-center font-bold" colspan="4">
                            قیمت کل
                        </td>
                        <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                            {{ number_format($partFinalPrice) }} تومان
                        </td>
                    </tr>
                </table>
            </div>
        @endif

        @if(!$inquiry->products()->where('part_id','!=',0)->where('type',null)->orderBy('sort','ASC')->get()->isEmpty())
            <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4 hidden md:block">
                <div class="mb-4">
                    <p class="text-sm font-bold text-xl text-center">لیست سایر تجهیزات (قطعات موجود از قبل)</p>
                </div>
                <table class="border-collapse border border-gray-400 w-full">
                    <thead>
                    <tr class="bg-indigo-200">
                        <th class="border border-white p-4 text-sm">ردیف</th>
                        <th class="border border-white p-4 text-sm">نام قطعه</th>
                        <th class="border border-white p-4 text-sm">تعداد</th>
                        <th class="border border-white p-4 text-sm">قیمت واحد</th>
                        <th class="border border-white p-4 text-sm">قیمت کل</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $partFinalPrice = 0;
                    @endphp
                    @foreach($inquiry->products()->where('part_id','!=',0)->where('type',null)->orderBy('sort','ASC')->get() as $product)
                        @php
                            $part = \App\Models\Part::find($product->part_id);
                            $partFinalPrice += $product->price * $product->quantity;
                        @endphp
                        <tr>
                            <td class="border border-gray-300 p-4 text-sm text-center">
                                {{ $loop->index + 1 }}
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
                        <td class="border border-gray-300 p-4 text-lg text-center font-bold" colspan="4">
                            قیمت کل
                        </td>
                        <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                            {{ number_format($partFinalPrice) }} تومان
                        </td>
                    </tr>
                </table>
            </div>
        @endif

        <!-- Final Inquiry Price -->
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
