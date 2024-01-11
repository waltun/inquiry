<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Packing List</title>

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
                                <p class="text-4xl">
                                    Packing List
                                </p>
                            </th>
                            <th scope="col" class="p-1" style="border-left: 1px solid black">
                                <img src="{{ asset('images/azarbad.png') }}" alt="" class="w-24 mx-auto mb-2">
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
                                    {{ jdate($contract->updated_at)->format('Y/m/d') }}
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
                                تهران، پونک، خیابان سردار جنگل، بالاتر از میرزابابایی، نبش بن بست ده متری گلستان، پلاک
                                4، واحد 4
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
                            <div class="grid grid-cols-12">
                                @foreach($contract->packings as $packing)
                                    <div
                                        class="col-span-1 border-2 border-l-0 border-black mb-4 grid items-center justify-center bg-sky-100">
                                        <p class="text-center -rotate-90 whitespace-nowrap text-sm font-medium">
                                            {{ $packing->code }}
                                        </p>
                                    </div>
                                    <div class="col-span-11">
                                        <table class="table-fixed w-full border-collapse">
                                            <thead>
                                            <tr class="bg-sky-100 text-black border-2 border-black border-b-0 text-xs">
                                                <th scope="col" class="p-1" style="border-left: 1px solid black">
                                                    <p class="text-sm">
                                                        شرح : {{ $packing->name }}
                                                    </p>
                                                </th>
                                            </tr>
                                            </thead>
                                        </table>
                                        @if(!$packing->products->isEmpty())
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
                                                @foreach($packing->products()->where('group_id','!=',0)->where('model_id','!=',0)->get() as $product)
                                                    @php
                                                        $modell = \App\Models\Modell::find($product->model_id);
                                                    @endphp
                                                    <tr class="text-black text-xs text-center">
                                                        <td class="border border-black border-t-0 border-r-2 p-1">
                                                            {{ $loop->index + 1 }}
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
                                                            {{ $product->quantity }}
                                                        </td>
                                                        <td class="border border-l-2 border-black border-t-0 p-1">
                                                            <div class="mx-auto w-4 h-4 border border-black">

                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                @foreach($packing->products()->where('part_id','!=',0)->get() as $product)
                                                    @php
                                                        $part = \App\Models\Part::find($product->part_id);
                                                    @endphp
                                                    <tr class="text-black text-xs text-center">
                                                        <td class="border border-r-2 border-black border-t-0 border-l p-1">
                                                            {{ $loop->index + 1 }}
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
                                                            {{ $product->quantity }}
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
                                                    {{ $packing->length }}x{{ $packing->width }}x{{ $packing->height }}
                                                </td>
                                                <td class="border border-b-2 border-black border-t-0 border-l p-1 font-bold">
                                                    {{ $packing->weight }}
                                                </td>
                                                <td class="border border-b-2 border-black border-t-0 border-l-2 p-1 font-bold">
                                                    {{ $packing->length * $packing->width * $packing->height / 1000000 }}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                @endforeach
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
                                                    style="border-left: 1px solid black" colspan="2">
                                                    نمایندگان فروشنده
                                                </th>
                                                <th scope="col" class="p-1" style="border-left: 1px solid black"
                                                    colspan="4">
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
                                                    بازرس شخص ثالث
                                                </th>
                                                <th scope="col" class="p-1" style="border-left: 1px solid black">
                                                    نماینده خریدار
                                                </th>
                                                <th scope="col" class="p-1" style="border-left: 1px solid black">
                                                    نماینده کارفرما
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
    // window.onload = function () {
    //     window.print();
    // }
</script>

</body>
</html>
