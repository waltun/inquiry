<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $parentPart->name }}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="font-IRANSans">
<!-- Content -->
<div class="p-2 m-2">
    <!-- Collection Date -->
    <div class="bg-white border border-gray-300 rounded-md py-4 px-6 mb-4 space-y-4">
        <p class="text-center font-bold text-base">
            تاریخ امروز : {{ jdate(now())->format('%A, %d %B %Y') }}
        </p>
    </div>

    @php
        $totalPrice = 0;
        $totalWeight = 0;
    @endphp

    <div class="bg-white mb-4">
        <div class="mb-4">
            <p class="text-center text-sm text-black font-bold">
                لیست قطعات {{ $parentPart->name }}
            </p>
        </div>
        <table class="border-collapse border border-gray-400 w-full">
            <thead>
            <tr>
                <th class="border border-gray-300 p-4 text-xs">نام قطعه</th>
                <th class="border border-gray-300 p-4 text-xs">واحد قطعه</th>
                <th class="border border-gray-300 p-4 text-xs">وزن قطعه (کلیوگرم)</th>
                <th class="border border-gray-300 p-4 text-xs">قیمت واحد (تومان)</th>
                <th class="border border-gray-300 p-4 text-xs">مقادیر</th>
                <th class="border border-gray-300 p-4 text-xs">جمع کل (تومان)</th>
            </tr>
            </thead>
            <tbody>

            @foreach($parentPart->children as $child)
                @php
                    $totalPrice += $child->price * $child->pivot->value;
                    $totalWeight += $child->weight * $child->pivot->value;
                @endphp
                <tr>
                    <td class="border border-gray-300 p-4 text-xs text-center">
                        {{ $child->name }}
                    </td>
                    <td class="border border-gray-300 p-4 text-xs text-center">
                        {{ $child->unit }}
                        @if(!is_null($child->unit2))
                            /
                            {{ $child->unit2 }}
                        @endif
                    </td>
                    <td class="border border-gray-300 p-4 text-xs text-center">
                        {{ $child->weight }}
                    </td>
                    <td class="border border-gray-300 p-4 text-xs text-center ">
                        {{ number_format($child->price) }}
                    </td>
                    <td class="border border-gray-300 p-4 text-xs text-center">
                        {{ $child->pivot->value }}
                        @if($child->pivot->value2)
                            /
                            {{ $child->pivot->value2 }}
                        @endif
                    </td>
                    <td class="border border-gray-300 p-4 text-xs text-center ">
                        {{ number_format($child->price * $child->pivot->value) }}
                    </td>
                </tr>
            @endforeach
            <tr>
                <td class="border border-gray-300 p-4 text-sm text-center font-bold" colspan="5">
                    وزن دستگاه (کیلوگرم)
                </td>
                <td class="border border-gray-300 p-4 text-sm text-center text-black font-bold">
                    {{ $totalWeight }}
                </td>
            </tr>
            <tr>
                <td class="border border-gray-300 p-4 text-sm text-center font-bold" colspan="5">
                    قیمت کل (تومان)
                </td>
                <td class="border border-gray-300 p-4 text-sm text-center text-black font-bold">
                    {{ number_format($totalPrice) }}
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    window.print()
</script>

</body>
</html>
