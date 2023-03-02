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
    <div class="bg-white border border-gray-300 rounded-md py-4 px-6 mb-4 space-y-4">
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
    @if(!$inquiry->products()->where('group_id','!=',0)->where('model_id','!=',0)->get()->isEmpty())
        <div class="bg-white mb-4">
            <div class="mb-4">
                <p class="text-sm  text-center">لیست محصولات</p>
            </div>
            <table class="border-collapse border border-gray-400 w-full">
                <thead>
                <tr>
                    <th class="border border-gray-300 p-4 text-xs">ردیف</th>
                    <th class="border border-gray-300 p-4 text-xs">کد</th>
                    <th class="border border-gray-300 p-4 text-xs">دسته</th>
                    <th class="border border-gray-300 p-4 text-xs">مدل</th>
                    <th class="border border-gray-300 p-4 text-xs">تگ</th>
                    <th class="border border-gray-300 p-4 text-xs">وزن</th>
                    <th class="border border-gray-300 p-4 text-xs">تعداد</th>
                    <th class="border border-gray-300 p-4 text-xs">قیمت واحد (تومان)</th>
                    <th class="border border-gray-300 p-4 text-xs">قیمت کل (تومان)</th>
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
                        <td class="border border-gray-300 p-4 text-xs text-center">
                            {{ $loop->index + 1 }}
                        </td>
                        <td class="border border-gray-300 p-4 text-xs text-center">
                            {{ $group->code }}{{ $modell->parent->code }}{{ $modell->code}}
                        </td>
                        <td class="border border-gray-300 p-4 text-xs text-center">
                            {{ $modell->parent->name }}
                        </td>
                        <td class="border border-gray-300 p-4 text-xs text-center">
                            {{ $product->model_custom_name ?? $modell->name }}
                        </td>
                        <td class="border border-gray-300 p-4 text-xs text-center">
                            {{ $product->description }}
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            {{ $product->weight }}
                        </td>
                        <td class="border border-gray-300 p-4 text-xs text-center">
                            {{ $product->quantity }}
                        </td>
                        <td class="border border-gray-300 p-4 text-xs text-center">
                            {{ number_format($product->price) }}
                        </td>
                        <td class="border border-gray-300 p-4 text-xs text-center">
                            {{ number_format($product->price * $product->quantity) }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tr>
                    <td class="border border-gray-300 p-4 text-sm text-center" colspan="6">
                        قیمت کل (تومان)
                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center text-black" colspan="2">
                        {{ number_format($productFinalPrice) }}
                    </td>
                </tr>
            </table>
        </div>
    @endif

    <hr>

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
    <div class="p-4 rounded-md mt-4 border border-gray-200 bg-white">
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
