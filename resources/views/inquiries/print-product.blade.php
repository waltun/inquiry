<!doctype html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $inquiry->inquiry_number }}-{{ $inquiry->name }}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="font-IRANSans">
<!-- Content -->
<div class="p-2 m-2">
    <!-- Info -->
    <div class="border border-gray-300 rounded-md py-4 px-6 mb-4 space-y-4">
        <div class="flex justify-between items-center">
            <p class="text-black text-sm">
                نام پروژه : {{ $inquiry->name }}
            </p>
            <p class="text-black text-sm">
                تاریخ استعلام : {{ jdate($inquiry->updated_at)->format('%A, %d %B %Y') }}
            </p>
        </div>
        <div class="flex justify-between items-center">
            <p class="text-black text-sm">
                @php
                    $user = \App\Models\User::where('id',$inquiry->user_id)->first();
                @endphp
                مسئول پروژه : {{ $user->name }}
            </p>
            <p class="text-black text-sm">
                شماره استعلام : {{ "INQ-" . $inquiry->inquiry_number }}
            </p>
        </div>
    </div>

    <!-- Laptop List Products -->
    @if(!$inquiry->products()->where('group_id','!=',0)->where('model_id','!=',0)->orderBy('sort','ASC')->get()->isEmpty())
        <div class="py-4 px-6 mb-4 border border-gray-300 rounded-lg">
            <div class="mb-4">
                <p class="text-sm font-bold text-xl text-center">لیست محصولات</p>
            </div>
            <table class="border border-gray-400 w-full">
                <thead>
                <tr class="border border-gray-400">
                    <th class="border border-gray-400 p-4 text-sm">ردیف</th>
                    <th class="border border-gray-400 p-4 text-sm">دسته محصول</th>
                    <th class="border border-gray-400 p-4 text-sm">مدل محصول</th>
                    <th class="border border-gray-400 p-4 text-sm">تگ</th>
                    <th class="border border-gray-400 p-4 text-sm">وزن</th>
                    <th class="border border-gray-400 p-4 text-sm">تعداد</th>
                    <th class="border border-gray-400 p-4 text-sm">قیمت واحد</th>
                    <th class="border border-gray-400 p-4 text-sm">قیمت کل</th>
                    <th class="border border-gray-400 p-4 text-sm">تاییدیه قیمت</th>
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
                        <td class="border border-gray-400 p-4 text-sm text-center">
                            {{ $loop->index + 1 }}
                        </td>
                        <td class="border border-gray-400 p-4 text-sm text-center">
                            {{ $modell->parent->name }}
                        </td>
                        <td class="border border-gray-400 p-4 text-sm text-center">
                            {{ $product->model_custom_name ?? $modell->name }}
                        </td>
                        <td class="border border-gray-400 p-4 text-sm text-center">
                            {{ $product->description ?? '-' }}
                        </td>
                        <td class="border border-gray-400 p-4 text-sm text-center">
                            {{ $product->weight }}
                        </td>
                        <td class="border border-gray-400 p-4 text-sm text-center">
                            {{ $product->quantity }}
                        </td>
                        <td class="border border-gray-400 p-4 text-sm text-center font-bold">
                            {{ number_format($product->price) }} تومان
                        </td>
                        <td class="border border-gray-400 p-4 text-sm text-center font-bold">
                            {{ number_format($product->price * $product->quantity) }} تومان
                        </td>
                        <td class="border border-gray-400 p-4 text-sm text-center">
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
                    <td class="border border-gray-400 p-4 text-lg text-center font-bold" colspan="7">
                        قیمت کل
                    </td>
                    <td class="border border-gray-400 p-4 text-lg text-center font-bold text-green-600" colspan="2">
                        {{ number_format($productFinalPrice) }} تومان
                    </td>
                </tr>
            </table>
        </div>
    @endif

    <!-- Laptop List Parts -->
    @php
        $types = ['setup','years','control','power_cable','control_cable','pipe','install_setup_price','setup_price','supervision','transport','other','setup_one','install','cable','canal','copper_piping','carbon_piping',null];
    @endphp
    @foreach($types as $type)
        @php
            $products = $inquiry->products()->where('part_id','!=',0)->where('type',$type)->orderBy('sort','ASC')->get();
        @endphp
        @if(!$products->isEmpty())
            <div class="border border-gray-300 rounded-lg py-4 px-6 mb-4">
                <div class="mb-4">
                    <p class="text-sm font-bold text-xl text-center">
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
                            @case('')
                                سایر تجهیزات (قطعات قبلی)
                                @break
                        @endswitch
                    </p>
                </div>
                <table class="border border-gray-400 w-full">
                    <thead>
                    <tr>
                        <th class="border border-gray-400 p-4 text-sm">ردیف</th>
                        <th class="border border-gray-400 p-4 text-sm">نام قطعه</th>
                        <th class="border border-gray-400 p-4 text-sm">تعداد</th>
                        <th class="border border-gray-400 p-4 text-sm">قیمت واحد</th>
                        <th class="border border-gray-400 p-4 text-sm">قیمت کل</th>
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
                        <tr>
                            <td class="border border-gray-400 p-4 text-sm text-center">
                                {{ $loop->index + 1 }}
                            </td>
                            <td class="border border-gray-400 p-4 text-sm text-center">
                                {{ $part->name }}
                            </td>
                            <td class="border border-gray-400 p-4 text-sm text-center">
                                {{ $product->quantity }}
                            </td>
                            <td class="border border-gray-400 p-4 text-sm text-center font-bold">
                                {{ number_format($product->price) }} تومان
                            </td>
                            <td class="border border-gray-400 p-4 text-sm text-center font-bold">
                                {{ number_format($product->price * $product->quantity) }} تومان
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tr>
                        <td class="border border-gray-400 p-4 text-lg text-center font-bold" colspan="4">
                            قیمت کل
                        </td>
                        <td class="border border-gray-400 p-4 text-lg text-center font-bold text-green-600">
                            {{ number_format($partFinalPrice) }} تومان
                        </td>
                    </tr>
                </table>
            </div>
        @endif
    @endforeach

    <!-- Final Inquiry Price -->
    <div class="p-4 rounded-md mt-4 border border-gray-400">
        @if($inquiry->price > 0)
            <p class="text-lg text-black  text-center">
                قیمت نهایی کل استعلام : {{ number_format($inquiry->price) }} تومان
            </p>
        @else
            <p class="text-lg text-black  text-center">
                قیمت نهایی کل استعلام : {{ number_format($partFinalPrice + $productFinalPrice) }} تومان
            </p>
        @endif
    </div>

    <!-- Inquiry Description -->
    <div class="p-4 rounded-md mt-4 border border-gray-200 bg-white">
        <p class="mb-2 text-sm text-black">شرایط استعلام : </p>
        <p class="text-xs leading-7 text-black">
            {!! $inquiry->description !!}
        </p>
    </div>
</div>

<script>
    window.print()
</script>

</body>
</html>
