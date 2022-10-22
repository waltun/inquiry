<!doctype html>
<html lang="fa" dir="rtl">
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
    <!-- Inquiry Details -->
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

    @php
        $finalPrice = 0;
    @endphp

        <!-- Laptop & Mobile Product List -->
    @if(!$inquiry->products()->where('group_id','!=',0)->where('model_id','!=',0)->get()->isEmpty())
        @foreach($inquiry->products()->where('group_id','!=',0)->where('model_id','!=',0)->get() as $product)
            @php
                $group = \App\Models\Group::find($product->group_id);
                $modell = \App\Models\Modell::find($product->model_id);
                $finalPrice += $product->price;
                $totalPrice = 0;
            @endphp
                <!-- Laptop Product List -->
            <div class="bg-white mb-4 border-b border-gray-300 pb-4">
                <div class="mb-4">
                    <p class="text-center text-sm text-black">
                        لیست قطعات و قیمت محصول
                        {{ $modell->parent->name }} - {{ $product->model_custom_name ?? $modell->name }}
                    </p>
                </div>
                <table class="border-collapse border border-gray-400 w-full">
                    <thead>
                    <tr>
                        <th class="border border-gray-300 p-4 text-xs">کد قطعه</th>
                        <th class="border border-gray-300 p-4 text-xs">نام قطعه</th>
                        <th class="border border-gray-300 p-4 text-xs">واحد قطعه</th>
                        @can('detail-inquiry')
                            <th class="border border-gray-300 p-4 text-xs">قیمت واحد (تومان)</th>
                        @endcan
                        <th class="border border-gray-300 p-4 text-xs">مقادیر</th>
                        @can('detail-inquiry')
                            <th class="border border-gray-300 p-4 text-xs">جمع کل (تومان)</th>
                        @endcan
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($product->amounts as $amount)
                        @php
                            $part = \App\Models\Part::find($amount->part_id);
                            if ($amount->price > 0){
                                $totalPrice += ($part->price * $amount->value) + ($amount->price * $amount->value);
                            } else {
                                $totalPrice += ($part->price * $amount->value);
                            }
                            $code = '';
                            foreach($part->categories as $category){
                                $code = $code . $category->code;
                            }
                        @endphp
                        <tr>
                            <td class="border border-gray-300 p-4 text-xs text-center">
                                {{ $code . "-" . $part->code }}
                            </td>
                            <td class="border border-gray-300 p-4 text-xs text-center">
                                {{ $part->name }}
                            </td>
                            <td class="border border-gray-300 p-4 text-xs text-center">
                                {{ $part->unit }}
                            </td>
                            @can('detail-inquiry')
                                <td class="border border-gray-300 p-4 text-xs text-center ">
                                    @if($amount->price > 0)
                                        {{ number_format($amount->price) }}
                                    @else
                                        {{ number_format($part->price) }}
                                    @endif
                                </td>
                            @endcan
                            <td class="border border-gray-300 p-4 text-xs text-center">
                                {{ $amount->value }}
                            </td>
                            @can('detail-inquiry')
                                <td class="border border-gray-300 p-4 text-xs text-center ">
                                    @if($amount->price > 0)
                                        {{ number_format($amount->price * $amount->value) }}
                                    @else
                                        {{ number_format($part->price * $amount->value) }}
                                    @endif
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                    @can('detail-inquiry')
                        <tr>
                            <td class="border border-gray-300 p-4 text-xs text-center "
                                colspan="{{ $colspan }}">
                                جمع قیمت ماتریال یک دستگاه (تومان)
                            </td>
                            <td class="border border-gray-300 p-4 text-xs text-center text-black">
                                {{ number_format($totalPrice) }}
                            </td>
                        </tr>
                    @endcan
                    @if($product->percent > 0)
                        @can('detail-inquiry')
                            <tr>
                                <td class="border border-gray-300 p-4 text-xs text-center"
                                    colspan="{{ $colspan }}">
                                    ضریب ثبت شده
                                </td>
                                <td class="border border-gray-300 p-4 text-xs text-center text-black">
                                    {{ $product->percent }}
                                </td>
                            </tr>
                        @endcan
                        <tr>
                            <td class="border border-gray-300 p-4 text-xs text-center"
                                colspan="{{ $colspan }}">
                                قیمت دستگاه با اعمال ضریب (تومان)
                            </td>
                            <td class="border border-gray-300 p-4 text-xs text-center text-black">
                                {{ number_format($totalPrice * $product->percent) }}
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td class="border border-gray-300 p-4 text-xs text-center"
                            colspan="{{ $colspan }}">
                            تعداد
                        </td>
                        <td class="border border-gray-300 p-4 text-xs text-center text-black">
                            {{ $product->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 p-4 text-sm text-center"
                            colspan="{{ $colspan }}">
                            قیمت کل (تومان)
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center text-black">
                            {{ number_format($totalPrice * $product->percent * $product->quantity) }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        @endforeach
    @endif
    <!-- Laptop & Mobile Parts List -->
    @if(!$inquiry->products()->where('part_id','!=',0)->get()->isEmpty())
        @foreach($inquiry->products()->where('part_id','!=',0)->get() as $product)
            @php
                $finalPrice += $product->price;
                $part = \App\Models\Part::find($product->part_id);
                $code = '';
                foreach($part->categories as $category){
                    $code = $code . $category->code;
                }
            @endphp
                <!-- Laptop Parts List -->
            <div class="bg-white mb-4 border-b border-gray-300 pb-4">
                <div class="mb-4">
                    <p class="text-center text-sm text-black">
                        تک قطعه {{ $part->name }}
                    </p>
                </div>
                <table class="border-collapse border border-gray-400 w-full">
                    <thead>
                    <tr>
                        <th class="border border-gray-300 p-4 text-xs">کد قطعه</th>
                        <th class="border border-gray-300 p-4 text-xs">نام قطعه</th>
                        <th class="border border-gray-300 p-4 text-xs">واحد قطعه</th>
                        @can('detail-inquiry')
                            <th class="border border-gray-300 p-4 text-xs">قیمت (تومان)</th>
                        @endcan
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="border border-gray-300 p-4 text-xs text-center">
                            {{ $code . "-" . $part->code }}
                        </td>
                        <td class="border border-gray-300 p-4 text-xs text-center">
                            {{ $part->name }}
                        </td>
                        <td class="border border-gray-300 p-4 text-xs text-center">
                            {{ $part->unit }}
                        </td>
                        @can('detail-inquiry')
                            <td class="border border-gray-300 p-4 text-xs text-center">
                                {{ number_format($part->price) }}
                            </td>
                        @endcan
                    </tr>
                    @if($product->percent > 0)
                        @can('detail-inquiry')
                            <tr>
                                <td class="border border-gray-300 p-4 text-xs text-center "
                                    colspan="{{ $colspan2 }}">
                                    ضریب ثبت شده
                                </td>
                                <td class="border border-gray-300 p-4 text-xs text-center text-black">
                                    {{ $product->percent }}
                                </td>
                            </tr>
                        @endcan
                        <tr>
                            <td class="border border-gray-300 p-4 text-xs text-center "
                                colspan="{{ $colspan2 }}">
                                قیمت قطعه با اعمال ضریب (تومان)
                            </td>
                            <td class="border border-gray-300 p-4 text-xs text-center text-black">
                                {{ number_format($product->price) }}
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td class="border border-gray-300 p-4 text-xs text-center "
                            colspan="{{ $colspan2 }}">
                            تعداد
                        </td>
                        <td class="border border-gray-300 p-4 text-xs text-center text-black">
                            {{ $product->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 p-4 text-sm text-center"
                            colspan="{{ $colspan2 }}">
                            قیمت کل (تومان)
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center text-black">
                            {{ number_format($product->price * $product->quantity) }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        @endforeach
    @endif

    <!-- Final Inquiry Price -->
    <div class="bg-white p-4 rounded-md mt-4 border border-gray-300">
        @if($inquiry->price > 0)
            <p class="text-lg text-black text-center">
                قیمت نهایی کل استعلام : {{ number_format($inquiry->price) }} تومان
            </p>
        @else
            <p class="text-lg text-black text-center">
                قیمت نهایی کل استعلام : {{ number_format($finalPrice) }} تومان
            </p>
        @endif
    </div>

    <!-- Inquiry Description -->
    <div class="mt-4 bg-white rounded-md p-4 border border-gray-300">
        <div class="mb-4">
            <p class="text-sm text-black">
                شرایط استعلام :
            </p>
        </div>
        <div class="leading-7 text-xs text-gray-700">
            @if($inquiry->description)
                {!! $inquiry->description !!}
            @else
                <p class="text-xs text-center text-xs text-red-600 ">
                    شرایطی برای این استعلام تعیین نشده است!
                </p>
            @endif
        </div>
    </div>

</div>

<script>

</script>

</body>
</html>
