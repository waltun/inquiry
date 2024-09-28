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
                                    شرکت تهویه آذرباد
                                </p>
                            </th>
                            <th scope="col" class="p-1" style="border-left: 1px solid black">
                                <p class="text-2xl">
                                    Exit List
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
                                    {{ $exit->number }}
                                </p>
                            </th>
                            <th scope="col" class="p-1" style="border-left: 1px solid black">
                                <p class="text-sm">
                                    {{ jdate($exit->created_at)->format('Y/m/d') }}
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
        <!-- Footer -->
        <tfoot>
        <tr>
            <td>
                <footer class="flex items-end fixed bottom-0 z-50 w-full">
                    <div class="w-64 h-12 bg-[#cf3b61] flex items-center justify-center z-30"
                         style="border-top-left-radius: 2.5rem">
                        <p class="text-sm font-bold text-white">
                            www.tahviehazarbad.com
                        </p>
                    </div>
                    <div class="w-36 h-10 bg-[#005a96] absolute -top-6 z-10"
                         style="border-top-left-radius: 2rem"></div>
                    <div class="w-full bg-[#005a96] mb-0 -mr-2 p-1">
                        <div class="flex items-center mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                 class="w-5 h-5 text-white">
                                <path fill-rule="evenodd"
                                      d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <p class="text-xs text-white font-medium mr-1 text-justify">
                                استان البرز، ماهدشت، خیابان سرداران، شهرک صنعتی خوارزمی، خیابان ششم شمالی، پلاک 39
                            </p>
                        </div>
                    </div>
                    <div class="absolute right-56 -top-4 p-2">
                        <div class="grid grid-cols-3 gap-4">
                            <div class="flex items-center justify-end">
                                <p class="text-xs text-black font-medium ml-2 text-justify">
                                    info@tahviehazarbad.com
                                </p>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                     class="w-6 h-6 flex-shrink-0 text-white bg-gray-600 rounded-md p-1">
                                    <path
                                            d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z"/>
                                    <path
                                            d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z"/>
                                </svg>
                            </div>
                            <div class="flex items-center justify-end">
                                <p class="text-xs text-black font-medium ml-2 text-justify">
                                    09224924765
                                </p>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                     class="w-6 h-6 flex-shrink-0 text-white bg-gray-600 rounded-md p-1">
                                    <path d="M10.5 18.75a.75.75 0 000 1.5h3a.75.75 0 000-1.5h-3z"/>
                                    <path fill-rule="evenodd"
                                          d="M8.625.75A3.375 3.375 0 005.25 4.125v15.75a3.375 3.375 0 003.375 3.375h6.75a3.375 3.375 0 003.375-3.375V4.125A3.375 3.375 0 0015.375.75h-6.75zM7.5 4.125C7.5 3.504 8.004 3 8.625 3H9.75v.375c0 .621.504 1.125 1.125 1.125h2.25c.621 0 1.125-.504 1.125-1.125V3h1.125c.621 0 1.125.504 1.125 1.125v15.75c0 .621-.504 1.125-1.125 1.125h-6.75A1.125 1.125 0 017.5 19.875V4.125z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="flex items-center justify-end">
                                <p class="text-xs text-black font-medium ml-2 text-justify">
                                    02144411345
                                </p>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                     class="w-6 h-6 flex-shrink-0 text-white bg-[#cf3b61] rounded-md p-1">
                                    <path fill-rule="evenodd"
                                          d="M1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </footer>
                <div class="block mt-20 w-full"></div>
            </td>
        </tr>
        </tfoot>
        <!-- Main -->
        <tbody>
        <tr>
            <td>
                <div class="relative">
                    <div class="card border-0 mb-0">
                        <div class="mt-2">
                            <div>
                                <table class="table-auto w-full border-collapse">
                                    <thead>
                                    <tr class="text-black border border-x-2 border-black text-xs">
                                        <th scope="col" class="p-1 rounded-tr-lg"
                                            style="border-left: 1px solid black">
                                            ردیف
                                        </th>
                                        <th scope="col" class="p-1" style="border-left: 1px solid black">
                                            اقلام خروجی
                                        </th>
                                        <th scope="col" class="p-1" style="border-left: 1px solid black">
                                            تعداد تحویل شده
                                        </th>
                                        <th scope="col" class="p-1" style="border-left: 1px solid black">
                                            واحد
                                        </th>
                                        <th scope="col" class="p-1" style="border-left: 1px solid black">
                                            تعداد عودت شده
                                        </th>
                                        <th scope="col" class="p-1" style="border-left: 1px solid black">
                                            تاریخ عودت
                                        </th>
                                        <th scope="col" class="p-1" style="border-left: 1px solid black">
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
                                            <td class="border border-black border-t-0 border-r-2 p-1">
                                                {{ $count }}
                                            </td>
                                            <td class="border border-black border-t-0 border-l p-1">
                                                {{ !is_null($item->coding_id) ? $coding->name : $item->name }}
                                            </td>
                                            <td class="border border-black border-t-0 border-l p-1">
                                                {{ $item->quantity }}
                                            </td>
                                            <td class="border border-black border-t-0 border-l p-1">
                                                {{ !is_null($item->coding_id) ? $coding->unit : $item->unit }}
                                            </td>
                                            <td class="border border-black border-t-0 border-l p-1">
                                                {{ $item->return_quantity ?? 'منتظر عودت' }}
                                            </td>
                                            <td class="border border-black border-t-0 border-l p-1">
                                                @if(!is_null($item->return_date))
                                                    {{ jdate($item->return_date)->format('Y/m/d') }}
                                                @else
                                                    منتظر عودت
                                                @endif
                                            </td>
                                            <td class="border border-l-2 border-black border-t-0 p-1">
                                                {{ $item->description ?? '-' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-16">
                                <div class="grid grid-cols-12">
                                    <div
                                        class="col-span-1 border border-l-0 border-black mb-8 grid items-center justify-center">
                                        <p class="text-center -rotate-90 whitespace-nowrap text-sm font-medium">
                                            نام، امضا و تاریخ
                                        </p>
                                    </div>
                                    <div class="col-span-11">
                                        <table class="table-fixed w-full border-collapse mb-8">
                                            <thead>
                                            <tr class="text-black border border-black text-xs">
                                                <th scope="col" class="p-1 rounded-tr-lg"
                                                    style="border-left: 1px solid black" colspan="3">
                                                    نمایندگان فروشنده
                                                </th>
                                                <th scope="col" class="p-1" style="border-left: 1px solid black"
                                                    colspan="3">
                                                    نمایندگان خریدار
                                                </th>
                                            </tr>
                                            <tr class="text-black border border-black text-xs">
                                                <th scope="col" class="p-1 rounded-tr-lg"
                                                    style="border-left: 1px solid black">
                                                    کنترل کیفی
                                                </th>
                                                <th scope="col" class="p-1" style="border-left: 1px solid black">
                                                    انبار
                                                </th>
                                                <th scope="col" class="p-1" style="border-left: 1px solid black">
                                                    مدیر
                                                </th>

                                                <th scope="col" class="p-1 rounded-tr-lg"
                                                    style="border-left: 1px solid black">
                                                    نماینده یک
                                                </th>
                                                <th scope="col" class="p-1" style="border-left: 1px solid black">
                                                    نماینده دو
                                                </th>
                                                <th scope="col" class="p-1" style="border-left: 1px solid black">
                                                    نماینده سه
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr class="text-black text-xs text-center">
                                                <td class="p-8 border border-black">
                                                    <div class="flex items-center justify-center">
                                                        <p class="text-gray-200">
                                                            نام و امضا
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="p-8 border border-black">
                                                    <div class="flex items-center justify-center">
                                                        <p class="text-gray-200">
                                                            نام و امضا
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="p-8 border border-black">
                                                    <div class="flex items-center justify-center">
                                                        <p class="text-gray-200">
                                                            نام و امضا
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="p-8 border border-black">
                                                    <div class="flex items-center justify-center">
                                                        <p class="text-gray-200">
                                                            نام و امضا
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="p-8 border border-black">
                                                    <div class="flex items-center justify-center">
                                                        <p class="text-gray-200">
                                                            نام و امضا
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="p-8 border border-black">
                                                    <div class="flex items-center justify-center">
                                                        <p class="text-gray-200">
                                                            نام و امضا
                                                        </p>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="text-black text-xs text-center">
                                                <td class="p-4 border border-black">
                                                    <div class="flex items-center justify-center">
                                                        <p class="text-gray-200">
                                                            تاریخ
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="p-4 border border-black">
                                                    <div class="flex items-center justify-center">
                                                        <p class="text-gray-200">
                                                            تاریخ
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="p-4 border border-black">
                                                    <div class="flex items-center justify-center">
                                                        <p class="text-gray-200">
                                                            تاریخ
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="p-4 border border-black">
                                                    <div class="flex items-center justify-center">
                                                        <p class="text-gray-200">
                                                            تاریخ
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="p-4 border border-black">
                                                    <div class="flex items-center justify-center">
                                                        <p class="text-gray-200">
                                                            تاریخ
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="p-4 border border-black">
                                                    <div class="flex items-center justify-center">
                                                        <p class="text-gray-200">
                                                            تاریخ
                                                        </p>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
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
