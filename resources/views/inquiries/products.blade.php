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
                      d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"></path>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    مشاهده قیمت محصولات استعلام {{ $inquiry->name }}
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
                      d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"></path>
            </svg>
            <div class="mr-2">
                <p class="font-bold text-2xl text-black dark:text-white">
                    مشاهده قیمت محصولات استعلام {{ $inquiry->name }}
                </p>
            </div>
        </div>
        <div class="flex items-center space-x-4 space-x-reverse">
            <a href="{{ route('inquiries.products.print',$inquiry->id) }}"
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
        <div class="mb-4 mt-8 card bg-myBlue-300">
            <div class="flex items-center space-x-4 space-x-reverse justify-center">
                <p class="bg-white py-2 px-4 rounded-lg text-sm text-black">
                    نام پروژه : {{ $inquiry->name }}
                </p>
                <p class="bg-white py-2 px-4 rounded-lg text-sm text-black">
                    شماره استعلام : {{ "INQ-" . $inquiry->inquiry_number }}
                </p>
                <p class="bg-white py-2 px-4 rounded-lg text-sm text-black">
                    تاریخ قیمت گذاری : {{ jdate($inquiry->archive_at)->format('%A, %d %B %Y') }}
                </p>
                <p class="bg-white py-2 px-4 rounded-lg text-sm text-black">
                    @php
                        $user = \App\Models\User::where('id',$inquiry->user_id)->first();
                    @endphp
                    مسئول پروژه : {{ $user->name }}
                </p>
                @php
                    $percentProduct = $inquiry->products()->where('group_id','!=',0)->where('model_id','!=',0)->orderBy('sort','ASC')->first();
                    if ($percentProduct && !is_null($percentProduct->percent_by)) {
                        $percentUser = \App\Models\User::find($percentProduct->percent_by);
                    }
                @endphp
                @if($percentProduct && !is_null($percentProduct->percent_by))
                    <p class="bg-white py-2 px-4 rounded-lg text-sm text-black flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-5 h-5 ml-1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>

                        قیمت این استعلام توسط {{ $percentUser->name }} تایید شده است
                    </p>
                @endif
            </div>
        </div>

        <!-- Product List -->
        @php
            $productFinalPrice = 0;
        @endphp
        @if(!$inquiry->products()->where('group_id','!=',0)->where('model_id','!=',0)->orderBy('sort','ASC')->get()->isEmpty())
            <div class="card overflow-x-auto">
                <div class="card-header">
                    <p class="card-title text-lg">لیست محصولات</p>
                </div>
                <table class="w-full border-collapse">
                    <thead>
                    <tr class="table-th-tr">
                        <th class="p-4 rounded-tr-lg">ردیف</th>
                        <th class="p-4">مشخصه</th>
                        <th class="p-4">دسته محصول</th>
                        <th class="p-4">مدل محصول</th>
                        <th class="p-4">تگ</th>
                        <th class="p-4">وزن (کیلوگرم)</th>
                        <th class="p-4">تعداد</th>
                        <th class="p-4">قیمت واحد (تومان)</th>
                        <th class="p-4">قیمت کل (تومان)</th>
                        <th class="p-4 rounded-tl-lg">
                            <span class="sr-only">افزودن محصول</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($inquiry->products()->where('group_id','!=',0)->where('model_id','!=',0)->get() as $product)
                        @php
                            $group = \App\Models\Group::find($product->group_id);
                            $modell = \App\Models\Modell::find($product->model_id);
                            $totalPrice = 0;
                            $productFinalPrice += $product->price * $product->quantity;
                        @endphp
                        <tr class="table-tb-tr group {{ $loop->even ? 'bg-sky-100' : '' }}">
                            <td class="table-tr-td border-t-0 border-l-0">
                                {{ $loop->index + 1 }}
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                <div class="flex items-center justify-center relative" x-data="{ open: false}">
                                    <button type="button" @click="open = !open">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-yellow-500">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </button>
                                    <div
                                        class="p-2 rounded-md shadow-md absolute left-0 -top-6 bg-white border border-gray-200"
                                        x-show="open" @click.away="open = false">
                                        <p class="text-xs text-center text-black font-medium">
                                            {{ $product->property }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                {{ $modell->parent->name }}
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                {{ $product->model_custom_name ?? $modell->name }}
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                {{ $product->description ?? '-' }}
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                {{ $product->weight }}
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                {{ $product->quantity }}
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                {{ number_format($product->price) }}
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                {{ number_format($product->price * $product->quantity) }}
                            </td>
                            <td class="table-tr-td border-t-0 border-r-0">
                                <div class="flex items-center justify-center" x-data="{open: false}">
                                    <button class="table-dropdown-restore" type="button" @click="open = !open">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M7.5 7.5h-.75A2.25 2.25 0 004.5 9.75v7.5a2.25 2.25 0 002.25 2.25h7.5a2.25 2.25 0 002.25-2.25v-7.5a2.25 2.25 0 00-2.25-2.25h-.75m0-3l-3-3m0 0l-3 3m3-3v11.25m6-2.25h.75a2.25 2.25 0 012.25 2.25v7.5a2.25 2.25 0 01-2.25 2.25h-7.5a2.25 2.25 0 01-2.25-2.25v-.75"/>
                                        </svg>
                                    </button>

                                    <div class="relative z-10" x-show="open" x-cloak>
                                        <div class="modal-backdrop"></div>
                                        <div class="fixed z-10 inset-0 overflow-y-auto">
                                            <div class="modal">
                                                <div class="modal-body">
                                                    <form method="POST" class="bg-white dark:bg-slate-800 p-4"
                                                          action="{{ route('inquiries.addProductToInquiry',$product->id) }}">
                                                        @csrf
                                                        <div class="mb-4 flex justify-between items-center">
                                                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                                افزودن محصول به استعلام دیگر
                                                            </h3>
                                                            <button type="button" @click="open = false">
                                                                    <span class="modal-close">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                             fill="none"
                                                                             viewBox="0 0 24 24"
                                                                             stroke-width="1.5" stroke="currentColor"
                                                                             class="w-5 h-5 dark:text-white">
                                                                            <path stroke-linecap="round"
                                                                                  stroke-linejoin="round"
                                                                                  d="M6 18L18 6M6 6l12 12"/>
                                                                        </svg>
                                                                    </span>
                                                            </button>
                                                        </div>
                                                        <div class="mt-6">
                                                            <div class="mb-4">
                                                                <label for="inputInquiry" class="form-label">
                                                                    انتخاب استعلام
                                                                </label>
                                                                <select name="inquiry_id" id="inputInquiry"
                                                                        class="input-text">
                                                                    @foreach($inquiries as $inquiry2)
                                                                        <option
                                                                            value="{{ $inquiry2->id }}">{{ $inquiry2->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div
                                                                class="flex justify-end items-center space-x-4 space-x-reverse">
                                                                <button type="submit" class="form-submit-btn">
                                                                    ثبت
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="table-tb-tr group">
                        <td class="table-tr-td border-t-0" colspan="10">
                            <div class="flex justify-end">
                                <p class="table-price-label">
                                    جمع قیمت : {{ number_format($productFinalPrice) }} تومان
                                </p>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        @endif

        <!-- Part List -->
        @php
            $types = ['setup','years','control','power_cable','control_cable','pipe','install_setup_price','setup_price','supervision','transport','other','setup_one','install','cable','canal','copper_piping','carbon_piping', 'coil',null];
        @endphp
        @foreach($types as $type)
            @php
                $products = $inquiry->products()->where('part_id','!=',0)->where('type',$type)->orderBy('sort','ASC')->get();
            @endphp
            @if(!$products->isEmpty())
                <div class="card">
                    <div class="card-header">
                        <p class="card-title text-lg">
                            @switch($type)
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
                                @case('coil')
                                    انواع کویل
                                    @break
                                @case('')
                                    سایر تجهیزات (قطعات قبلی)
                                    @break
                            @endswitch
                        </p>
                    </div>
                    <table class="w-full border-collapse">
                        <thead>
                        <tr class="table-th-tr">
                            <th class="p-4 rounded-tr-lg">ردیف</th>
                            <th class="p-4">نام قطعه</th>
                            <th class="p-4">تعداد</th>
                            <th class="p-4">واحد</th>
                            <th class="p-4">قیمت واحد (تومان)</th>
                            <th class="p-4 rounded-tl-lg">قیمت کل (تومان)</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $partFinalPrice = 0;
                        @endphp
                        @foreach($products as $product)
                            @php
                                $part = \App\Models\Part::find($product->part_id);
                                $partFinalPrice += $product->price * $product->quantity;
                            @endphp
                            <tr class="table-tb-tr group {{ $loop->even ? 'bg-sky-100' : '' }}">
                                <td class="table-tr-td border-t-0 border-l-0">
                                    {{ $loop->index + 1 }}
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    {{ $part->name }}
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    {{ $product->quantity }}
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    {{ $part->unit }}
                                </td>
                                <td class="table-tr-td border-t-0 border-x-0">
                                    {{ number_format($product->price) }}
                                </td>
                                <td class="table-tr-td border-t-0 border-r-0">
                                    {{ number_format($product->price * $product->quantity) }}
                                </td>
                            </tr>
                        @endforeach
                        <tr class="table-tb-tr group">
                            <td class="table-tr-td border-t-0" colspan="6">
                                <div class="flex justify-end">
                                    <p class="table-price-label">
                                        جمع قیمت : {{ number_format($partFinalPrice) }} تومان
                                    </p>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            @endif
        @endforeach

        <!-- Final Inquiry Price -->
        <div class="my-6 flex justify-end sticky bottom-4">
            @if($inquiry->price > 0)
                <p class="bg-myGreen-100 text-white px-6 py-3 rounded-lg font-bold text-lg">
                    قیمت کل استعلام : {{ number_format($inquiry->price) }} تومان
                </p>
            @else
                <p class="bg-myGreen-100 text-white px-6 py-3 rounded-lg font-bold text-lg">
                    قیمت کل استعلام : {{ number_format($partFinalPrice + $productFinalPrice) }} تومان
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
            <div class="leading-7 text-sm text-gray-700 decimal-list mr-4">
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
        <div class="md:grid grid-cols-3 gap-4 mt-4 card">
            <div class="card bg-myBlue-300">
                <p class="text-sm font-bold text-white text-center dark:text-white">
                    ایجاد استعلام : {{ jdate($inquiry->created_at)->format('%A, %d %B %Y') }}
                </p>
                <p class="text-sm font-bold text-white text-center dark:text-white">
                    ساعت : {{ jdate($inquiry->created_at)->format('H:i:s') }}
                </p>
            </div>
            <div class="card bg-myBlue-300">
                <p class="text-sm font-bold text-white text-center dark:text-white">
                    آخرین بروزرسانی استعلام : {{ jdate($inquiry->updated_at)->format('%A, %d %B %Y') }}
                </p>
                <p class="text-sm font-bold text-white text-center dark:text-white">
                    ساعت : {{ jdate($inquiry->updated_at)->format('H:i:s') }}
                </p>
            </div>
            <div class="card bg-myBlue-300">
                @if($inquiry->archive_at)
                    <p class="text-sm font-bold text-white text-center dark:text-white">
                        آرشیو استعلام : {{ jdate($inquiry->archive_at)->format('%A, %d %B %Y') }}
                    </p>
                    <p class="text-sm font-bold text-white text-center dark:text-white">
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
