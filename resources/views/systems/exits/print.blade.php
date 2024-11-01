<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Exits</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="font-IRANSans">

<!-- Content -->
<div class="mx-auto" style="width: 14.85cm">
    <table style="page-break-after: always" class="w-full relative">
        <!-- Header -->
        <thead style="display: table-header-group">
        <tr>
            <th>
                <header class="flex fixed top-0 z-50 w-full p-5">
                    <table class="table-fixed w-full border-collapse">
                        <thead>
                        <tr class="text-black border-x-2 border border-black text-xs">
                            <th scope="col" class="p-1 rounded-tr-lg"
                                style="border-left: 1px solid black">
                                <img src="{{ asset('images/azarbad.png') }}" alt="" class="w-24 mx-auto mb-2">
                                <p class="text-sm">
                                    شرکت تهویه آذرباد
                                </p>
                            </th>
                            <th scope="col" class="p-1" style="border-left: 1px solid black">
                                <p class="text-lg">
                                    {{ $exit->type == 'mission' ? 'برگه ماموریت' : 'برگه خروج موقت' }}
                                </p>
                            </th>
                            <th scope="col" class="p-1" style="border-left: 1px solid black">
                                <p class="text-xs mb-1">
                                    شماره سند : {{ $exit->number }}
                                </p>
                                <p class="text-xs">
                                    تاریخ : {{ jdate($exit->exit_at)->format('Y/m/d') }}
                                </p>
                            </th>
                        </tr>
                        </thead>
                    </table>
                </header>
                <div class="block mb-32 w-full"></div>
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
                            <div class="mb-2">
                                <p class="text-xs font-medium">
                                    علت خروج : {{ $exit->description }}
                                </p>
                            </div>
                            <div>
                                <table class="table-auto w-full border-collapse">
                                    <thead>
                                    <tr class="text-black border border-x-2 border-gray-400 text-xs">
                                        <th scope="col" class="p-1 rounded-tr-lg" style="border-left: 1px solid gray">
                                            #
                                        </th>
                                        <th scope="col" class="p-1" style="border-left: 1px solid gray">
                                            شرح کالا (اقلام خروجی)
                                        </th>
                                        <th scope="col" class="p-1" style="border-left: 1px solid gray">
                                            تعداد
                                        </th>
                                        <th scope="col" class="p-1" style="border-left: 1px solid gray">
                                            واحد
                                        </th>
                                        <th scope="col" class="p-1" style="border-left: 1px solid gray">
                                            توضیحات
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $count = 0;
                                    @endphp
                                    @foreach($exit->codingExits as $item)
                                        @php
                                            if (!is_null($item->coding_id)) {
                                                $coding = \App\Models\System\Coding::find($item->coding_id);
                                            }
                                            $count++;
                                        @endphp
                                        <tr class="text-black text-xs text-center">
                                            <td class="border border-gray-400 border-t-0 border-r-2 p-1">
                                                {{ $count }}
                                            </td>
                                            <td class="border border-gray-400 border-t-0 border-l p-1 text-right">
                                                {{ !is_null($item->coding_id) ? $coding->name : $item->name }}
                                            </td>
                                            <td class="border border-gray-400 border-t-0 border-l p-1">
                                                {{ $item->quantity }}
                                            </td>
                                            <td class="border border-gray-400 border-t-0 border-l p-1">
                                                {{ !is_null($item->coding_id) ? $coding->unit : $item->unit }}
                                            </td>
                                            <td class="border border-l-2 border-gray-400 border-t-0 p-1">
                                                {{ $item->description ?? '-' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-2">
                                <div class="grid grid-cols-2 mb-4">
                                    <div class="border border-black border-b-0 border-l-0 p-2">
                                        <p class="text-xs font-medium">
                                            تنظیم کننده : انبار
                                        </p>
                                    </div>
                                    <div class="border border-black border-b-0 p-2">
                                        <p class="text-xs font-medium">
                                            خارج کننده : {{ $exit->exiter }}
                                        </p>
                                    </div>
                                    <div class="border border-black border-l-0 border-t-0 p-4">

                                    </div>
                                    <div class="border border-black border-t-0 p-4">

                                    </div>
                                </div>
                                <div class="mb-4">
                                    <p class="text-xs font-medium">
                                        شماره خودرو : {{ $exit->car_number }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs font-medium">
                                        آدرس و شماره تلفن : {{ $exit->phone }}
                                    </p>
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
