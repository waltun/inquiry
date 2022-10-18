<!doctype html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>پرینت استعلام</title>

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
                تاریخ استعلام : {{ jdate($inquiry->created_at)->format('%A, %d %B %Y') }}
            </p>
        </div>
        <div class="flex justify-between items-center">
            <p class="text-black text-sm">
                مسئول پروژه : {{ $inquiry->manager }}
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
                        foreach($product->amounts as $amount)
                        {
                            $part = \App\Models\Part::find($amount->part_id);
                            if ($amount->price > 0) {
                                $totalPrice += ($part->price * $amount->value) + ($amount->price * $amount->value);
                            } else {
                                $totalPrice += ($part->price * $amount->value);
                            }
                        }
                        $productFinalPrice += ($totalPrice * $product->percent) * $product->quantity;
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
                    <td class="border border-gray-300 p-4 text-sm text-center text-black">
                        {{ number_format($productFinalPrice) }}
                    </td>
                </tr>
            </table>
        </div>
    @endif

    <hr>

    <!-- Laptop List Parts -->
    @if(!$inquiry->products()->where('part_id','!=',0)->get()->isEmpty())
        <div class="bg-white my-4">
            <div class="mb-4">
                <p class="text-sm text-sm text-center">لیست قطعات تکی</p>
            </div>
            <table class="border-collapse border border-gray-400 w-full">
                <thead>
                <tr>
                    <th class="border border-gray-300 p-4 text-xs">ردیف</th>
                    <th class="border border-gray-300 p-4 text-xs">کد قطعه</th>
                    <th class="border border-gray-300 p-4 text-xs">نام قطعه</th>
                    <th class="border border-gray-300 p-4 text-xs">تعداد</th>
                    <th class="border border-gray-300 p-4 text-xs">قیمت واحد (تومان)</th>
                    <th class="border border-gray-300 p-4 text-xs">قیمت کل (تومان)</th>
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
                        <td class="border border-gray-300 p-4 text-xs text-center">
                            {{ $loop->index + 1 }}
                        </td>
                        <td class="border border-gray-300 p-4 text-xs text-center">
                            {{ $part->code }}
                        </td>
                        <td class="border border-gray-300 p-4 text-xs text-center">
                            {{ $part->name }}
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
                    <td class="border border-gray-300 p-4 text-sm text-center" colspan="5">
                        قیمت کل (تومان)
                    </td>
                    <td class="border border-gray-300 p-4 text-sm text-center text-black">
                        {{ number_format($partFinalPrice) }}
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
