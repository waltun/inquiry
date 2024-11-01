<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Packing List - Marking</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="font-IRANSans">

<!-- Content -->
<div class="mx-auto" style="width: 21cm">
    <table style="page-break-after: always" class="w-full relative">
        <!-- Header -->
        <thead style="display: table-header-group">
        <tr>
            <th>
                <header class="flex fixed top-0 z-50 w-full p-5">
                    <table class="table-fixed w-full border-collapse">
                        <thead>
                        <tr class="text-black border-2 border-black text-xs">
                            <th scope="col" class="p-1 rounded-tr-lg"
                                style="border-left: 1px solid black">
                                <img src="{{ asset('images/azarbad.png') }}" alt="" class="w-24 mx-auto mb-2">
                                <p class="text-sm">
                                    فروشنده : شرکت تهویه آذرباد
                                </p>
                            </th>
                            <th scope="col" class="p-1" style="border-left: 1px solid black">
                                <p class="text-2xl">
                                    Marking
                                </p>
                            </th>
                            <th scope="col" class="p-1" style="border-left: 1px solid black">
                                <p class="text-sm">
                                    خریدار : {{ $contract->customer->name }}
                                </p>
                            </th>
                        </tr>
                        <tr class="text-black border-x-2 border border-black text-xs">
                            <th scope="col" class="p-1 rounded-tr-lg"
                                style="border-left: 1px solid black">
                                <p class="text-sm">
                                    صفحه
                                </p>
                            </th>
                            <th scope="col" class="p-1" style="border-left: 1px solid black">
                                <p class="text-sm">
                                    شماره سند
                                </p>
                            </th>
                            <th scope="col" class="p-1" style="border-left: 1px solid black">
                                <p class="text-sm">
                                    تاریخ
                                </p>
                            </th>
                        </tr>
                        <tr class="text-black border-2 border-t border-black text-xs">
                            <th scope="col" class="p-1 rounded-tr-lg"
                                style="border-left: 1px solid black">
                                <p class="text-sm">
                                    1 از 1
                                </p>
                            </th>
                            <th scope="col" class="p-1" style="border-left: 1px solid black">
                                <p class="text-sm">
                                    PL-{{ $contract->number }}
                                </p>
                            </th>
                            <th scope="col" class="p-1" style="border-left: 1px solid black">
                                <p class="text-sm">
                                    {{ jdate($packing->date)->format('Y/m/d') }}
                                </p>
                            </th>
                        </tr>
                        <tr class="text-black border-2 border-t border-black text-xs">
                            <th scope="col" class="p-1 rounded-tr-lg" colspan="3"
                                style="border-left: 1px solid black">
                                <p class="text-sm">
                                    نام پروژه : {{ $contract->name }}
                                </p>
                            </th>
                        </tr>
                        </thead>
                    </table>
                </header>
                <div class="block mb-64 w-full"></div>
            </th>
        </tr>
        </thead>

        <!-- Main -->
        <tbody>
        <tr>
            <td>
                <div class="relative">
                    <div class="card border-0 mb-0">
                        <div class="mt-2">
                            <div class="grid grid-cols-12">
                                <div
                                    class="col-span-1 border-2 border-l-0 border-black mb-4 grid items-center justify-center bg-sky-100
                                        {{ is_null($pack->length) || is_null($pack->width) || is_null($pack->height) ? 'h-full' : '' }}">
                                    <p class="text-center -rotate-90 whitespace-nowrap text-sm font-medium">
                                        {{ $pack->code }}
                                    </p>
                                </div>
                                <div class="col-span-11">
                                    <table class="table-fixed w-full border-collapse">
                                        <thead>
                                        <tr class="bg-sky-100 text-black border-2 border-black border-b-0 text-xs">
                                            <th scope="col" class="p-1" style="border-left: 1px solid black">
                                                <p class="text-sm">
                                                    شرح : {{ $pack->name }}
                                                </p>
                                            </th>
                                        </tr>
                                        </thead>
                                    </table>
                                    @if(!$pack->products->isEmpty())
                                        <table class="table-auto w-full border-collapse">
                                            <thead>
                                            <tr class="text-black border border-x-2 border-black text-xs">
                                                <th scope="col" class="p-1 rounded-tr-lg"
                                                    style="border-left: 1px solid black">
                                                    ردیف
                                                </th>
                                                <th scope="col" class="p-1" style="border-left: 1px solid black">
                                                    محصول / دستگاه / تجهیز
                                                </th>
                                                <th scope="col" class="p-1" style="border-left: 1px solid black">
                                                    مدل
                                                </th>
                                                <th scope="col" class="p-1" style="border-left: 1px solid black">
                                                    تگ
                                                </th>
                                                <th scope="col" class="p-1" style="border-left: 1px solid black">
                                                    واحد
                                                </th>
                                                <th scope="col" class="p-1" style="border-left: 1px solid black">
                                                    تعداد
                                                </th>
                                                <th scope="col" class="p-1" style="border-left: 1px solid black">
                                                    MRS
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $count = 0;
                                            @endphp
                                            @foreach($pack->products()->where('group_id','!=',0)->where('model_id','!=',0)->get() as $product)
                                                @php
                                                    $modell = \App\Models\Modell::find($product->model_id);
                                                    $count++;
                                                @endphp
                                                <tr class="text-black text-xs text-center">
                                                    <td class="border border-black border-t-0 border-r-2 p-1">
                                                        {{ $count }}
                                                    </td>
                                                    <td class="border border-black border-t-0 border-l p-1">
                                                        {{ $modell->parent->name }}
                                                    </td>
                                                    <td class="border border-black border-t-0 border-l p-1">
                                                        {{ $product->model_custom_name ?? $modell->name }}
                                                    </td>
                                                    <td class="border border-black border-t-0 border-l p-1">
                                                        {{ $product->description ?? '-' }}
                                                    </td>
                                                    <td class="border border-black border-t-0 border-l p-1">
                                                        دستگاه
                                                    </td>
                                                    <td class="border border-black border-t-0 border-l p-1">
                                                        {{ $product->pivot->quantity }}
                                                    </td>
                                                    <td class="border border-l-2 border-black border-t-0 p-1">
                                                        <div class="mx-auto w-4 h-4 border border-black">

                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @foreach($pack->products()->where('part_id','!=',0)->get() as $product)
                                                @php
                                                    $part = \App\Models\Part::find($product->part_id);
                                                    $count++;
                                                @endphp
                                                <tr class="text-black text-xs text-center">
                                                    <td class="border border-r-2 border-black border-t-0 border-l p-1">
                                                        {{ $count }}
                                                    </td>
                                                    <td class="border border-black border-t-0 border-l p-1">
                                                        {{ $part->name }}
                                                    </td>
                                                    <td class="border border-black border-t-0 border-l p-1">
                                                        -
                                                    </td>
                                                    <td class="border border-black border-t-0 border-l p-1">
                                                        -
                                                    </td>
                                                    <td class="border border-black border-t-0 border-l p-1">
                                                        {{ $part->unit }}
                                                    </td>
                                                    <td class="border border-black border-t-0 border-l p-1">
                                                        {{ $product->pivot->quantity }}
                                                    </td>
                                                    <td class="border border-black border-t-0 border-l-2 p-1">
                                                        <div class="mx-auto w-4 h-4 border border-black">

                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                    @if($pack->length && $pack->width && $pack->height)
                                        <table class="table-fixed w-full border-collapse mb-4">
                                            <thead>
                                            <tr class="text-black border border-x-2 border-black border-t-0 text-xs">
                                                <th scope="col" class="p-1 rounded-tr-lg"
                                                    style="border-left: 1px solid black">
                                                    ابعاد (CM)
                                                </th>
                                                <th scope="col" class="p-1" style="border-left: 1px solid black">
                                                    وزن (KG)
                                                </th>
                                                <th scope="col" class="p-1" style="border-left: 1px solid black">
                                                    حجم (M<sup>3</sup>)
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr class="text-black text-xs text-center">
                                                <td class="border border-r-2 border-b-2 border-black border-t-0 border-l p-1 font-bold">
                                                    {{ $pack->length }}x{{ $pack->width }}x{{ $pack->height }}
                                                </td>
                                                <td class="border border-b-2 border-black border-t-0 border-l p-1 font-bold">
                                                    {{ $pack->weight }}
                                                </td>
                                                <td class="border border-b-2 border-black border-t-0 border-l-2 p-1 font-bold">
                                                    {{ $pack->length * $pack->width * $pack->height / 1000000 }}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<script>
    window.onload = function () {
        window.print();
    }
</script>

</body>
</html>
