<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>INV-{{ $invoice->inquiry->inquiry_number }}</title>

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
                <header class="flex fixed top-0 z-50 w-full">
                    <div class="w-36 h-14 bg-[#cf3b61] -mr-10" style="transform: skew(30deg)"></div>
                    <div class="w-96 h-14 bg-gray-100 mr-10" style="transform: skew(30deg)">
                        <div class="flex items-center space-x-2 justify-center" style="transform: skew(-30deg)">
                            <img src="{{ asset('images/azarbad.png') }}" alt="" class="w-24">
                            <div class="space-y-1">
                                <p class="text-sm font-medium text-myBlue-100 tracking-wider">تهویه آذرباد</p>
                                <p class="text-xs font-medium text-myBlue-100">Tahvieh Azarbad</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-40 h-14 bg-gray-100 mr-10" style="transform: skew(30deg)">
                        <div class="flex justify-between mx-3">
                            <div class="w-6 h-16 bg-[#cf3b61]"></div>
                            <div class="w-6 h-16 bg-[#005a96]"></div>
                        </div>
                    </div>
                    <div class="w-full h-5 bg-[#cf3b61]"></div>
                    <div class="absolute right-72 top-5 mr-16 p-1">
                        <div class="flex items-center justify-center whitespace-nowrap mt-2">
                            <p class="text-xs font-bold text-black mr-16">
                                تاریخ : {{ jdate($invoice->created_at)->format('Y/m/d') }}
                            </p>
                            <p class="text-xs font-bold text-black mr-8">
                                شماره : INV-{{ $invoice->inquiry->inquiry_number }}
                            </p>
                        </div>
                    </div>
                </header>
                <div class="block mb-20 w-full"></div>
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
                    <div class="mt-4 space-y-4" dir="ltr">
                        @php
                            $inquiry = $invoice->inquiry;
                            $products = $inquiry->products()->where('group_id','!=',0)->where('model_id','!=',0)->get();
                        @endphp

                        @foreach($products as $product)
                            @php
                                $childModell = \App\Models\Modell::find($product->model_id);
                                $modell = $childModell->parent;
                            @endphp
                            <div class="rounded-xl mx-4 border border-myBlue-100">
                                <div class="bg-[#005a96] p-1.5 rounded-t-lg">
                                    <p class="text-center text-white font-extrabold text-base">
                                        Datasheet for : {{ $product->model_custom_name }}
                                    </p>
                                </div>

                                <!-- Product attributes -->
                                <div class="px-4">
                                    @if(!$modell->attributes->isEmpty())
                                        <div class="bg-green-800 p-2 mt-2">
                                            <p class="text-sm font-bold text-center text-white">
                                                Product Information
                                            </p>
                                        </div>
                                        @php
                                            $attributeGroupIds = collect([]);
                                            $modell->attributes->map(function ($attr) use ($attributeGroupIds) {
                                                if ($attr->pivot->show_data == 1) {
                                                    $attributeGroupIds->push($attr->pivot->attribute_group_id);
                                                }
                                            });
                                            $uniqueAttributeGroupIds = $attributeGroupIds->unique();
                                            $attributeGroupIds = $attributeGroupIds->toArray();
                                        @endphp
                                        <div class="bg-white py-2">
                                            @foreach($uniqueAttributeGroupIds as $uniqueAttributeGroupId)
                                                @php
                                                    $keys = array_keys($attributeGroupIds, $uniqueAttributeGroupId);
                                                    $productsAttribute = $modell->attributes[$keys[0]];
                                                    $modelAttribute = \App\Models\AttributeGroup::find($productsAttribute->pivot->attribute_group_id);
                                                @endphp
                                                <div class="mb-0.5 whitespace-nowrap grid grid-cols-12">
                                                    <div class="col-span-2 bg-[#cf3b61] flex h-full items-center rounded-md">
                                                        <div class="py-1 px-2">
                                                            <p class="font-bold text-white" style="font-size: 11px">
                                                                {{ $modelAttribute->name }} :
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="ml-2 col-span-10 grid grid-cols-2 {{ $loop->first ? '' : 'border-t border-[#cf3b61]' }}">
                                                        @foreach($keys as $key)
                                                            @php
                                                                $productAttribute = $modell->attributes[$key];
                                                            @endphp
                                                            <div class="grid grid-cols-12 py-1">
                                                                <div class="col-span-5 flex items-center">
                                                                    <div class="w-2 h-2 bg-black flex-shrink-0 mr-1"></div>
                                                                    <p class="mt-0.5" style="font-size: 9px">
                                                                        {{ $productAttribute->name }} :
                                                                    </p>
                                                                </div>
                                                                <div class="col-span-3">
                                                                    <p class="mt-0.5" style="font-size: 9px">
                                                                        {{ $productsAttribute->unit != '-' ? $productsAttribute->unit : '' }}
                                                                    </p>
                                                                </div>
                                                                <div class="col-span-4">
                                                                    <p class="mt-0.5" style="font-size: 9px">
                                                                        @if(!$product->attributeValues->isEmpty())
                                                                            @foreach($productAttribute->values as $value)
                                                                                @if($product->attributeValues->contains($value))
                                                                                    {{ $value->value }}
                                                                                @endif
                                                                            @endforeach
                                                                        @else
                                                                            {{ $productAttribute->pivot->default_value }}
                                                                        @endif
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <!-- Part Attributes -->
                                <div class="px-4 grid grid-cols-2 gap-4">
                                    @php
                                        $midCategoryIds = collect([]);
                                        $partIds = collect([]);
                                        $amounts = collect([]);
                                        foreach ($product->amounts()->orderBy('sort', 'ASC')->get() as $amount) {
                                            $part = \App\Models\Part::find($amount->part_id);
                                            $partIds->push($part->id);
                                            $amounts->push($amount->value);
                                            $midCategory = $part->categories[1];
                                            $midCategoryIds->push($midCategory->id);
                                        }
                                        $uniqueMidCategoryIds = $midCategoryIds->unique()->toArray();
                                        $midCategoryIds = $midCategoryIds->toArray();
                                        $partIds = $partIds->toArray();

                                        $uniqueMidCategoryIds = array_values($uniqueMidCategoryIds);

                                        $evenItems = collect([]);
                                        $oddItems = collect([]);

                                        foreach ($uniqueMidCategoryIds as $key => $uniqueMidCategoryId) {
                                            if ($key % 2 == 0) {
                                                $evenItems->push($uniqueMidCategoryId);
                                            } else {
                                                $oddItems->push($uniqueMidCategoryId);
                                            }
                                        }
                                    @endphp
                                    @foreach([$evenItems, $oddItems] as $uniqueMidCategoryIds2)
                                        <div class="space-y-2">
                                            @foreach($uniqueMidCategoryIds2 as $uniqueMidCategoryId)
                                                @php
                                                    $keys = array_keys($midCategoryIds, $uniqueMidCategoryId);
                                                    $part = \App\Models\Part::find($partIds[$keys[0]]);
                                                    $midCategory = $part->categories[1];
                                                    $lastCategory = $part->categories->last();
                                                    $attributes = $lastCategory->attributes()->orderBy('sort', 'ASC')->get();
                                                    $display = false;
                                                    foreach($keys as $key){
                                                        $part = \App\Models\Part::find($partIds[$key]);
                                                        $lastCategory = $part->categories->last();
                                                        $attributes = $lastCategory->attributes()->orderBy('sort', 'ASC')->get();

                                                        if (!$attributes->isEmpty()) {
                                                            $display = true;
                                                            break;
                                                        }
                                                    }
                                                @endphp
                                                @if($display)
                                                    <div class="break-inside-avoid whitespace-nowrap">
                                                        <div class="bg-green-800 p-1.5">
                                                            <p class="font-bold text-center text-white text-sm">
                                                                {{ $midCategory->name_en ?? $midCategory->name }}
                                                            </p>
                                                        </div>
                                                        <div class="bg-white">
                                                            @php
                                                                $coilInput = null;
                                                            @endphp
                                                            @foreach($keys as $key)
                                                                @php
                                                                    $part = \App\Models\Part::find($partIds[$key]);
                                                                    if ($part->coil) {
                                                                        $coilInput = \App\Models\CoilInput::where('part_id', $part->id)->first();
                                                                    }
                                                                    $lastCategory = $part->categories->last();
                                                                    $attributes = $lastCategory->attributes()->orderBy('sort', 'ASC')->get();
                                                                    $amountValue = $amounts[$key];
                                                                @endphp
                                                                @if(!$attributes->isEmpty())
                                                                    <div class="mb-2">
                                                                        @if(!is_null($coilInput))
                                                                            @if(($coilInput->type == 'Fancoil' || $coilInput->type == 'Condensor') || $coilInput->type == 'Evaporator' || $coilInput->type == 'Cold' || $coilInput->type == 'Warm')
                                                                                <div class="grid grid-cols-3">
                                                                                    <div class="p-1">
                                                                                        <p class="text-xs font-medium text-black">
                                                                                            Tube :
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="p-1">
                                                                                        <p class="text-xs text-black">
                                                                                            -
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="p-1">
                                                                                        <p class="text-xs text-black">
                                                                                            {{ $coilInput->loole_messi }}
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="grid grid-cols-3">
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs font-medium text-black">
                                                                                            Fin :
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs text-black">
                                                                                            -
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs text-black">
                                                                                            {{ $coilInput->fin_coil }}
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="grid grid-cols-3">
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs font-medium text-black">
                                                                                            Number of Row :
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs text-black">
                                                                                            No.
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs text-black">
                                                                                            {{ $coilInput->tedad_radif_coil }}
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="grid grid-cols-3">
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs font-medium text-black">
                                                                                            Fin per Inch :
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs text-black">
                                                                                            FPI
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs text-black">
                                                                                            {{ $coilInput->fin_dar_inch }}
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="grid grid-cols-3">
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs font-medium text-black">
                                                                                            Frame :
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs text-black">
                                                                                            -
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs text-black">
                                                                                            {{ $coilInput->zekhamat_frame_coil }}
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="grid grid-cols-3">
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs font-medium text-black">
                                                                                            Coating :
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs text-black">
                                                                                            -
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs text-black">
                                                                                            {{ $coilInput->pooshesh_khordegi }}
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="grid grid-cols-3">
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs font-medium text-black">
                                                                                            Collector :
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs text-black">
                                                                                            -
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs text-black">
                                                                                            {{ $coilInput->collector_ahani }}
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="grid grid-cols-3">
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs font-medium text-black">
                                                                                            Collector :
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs text-black">
                                                                                            -
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs text-black">
                                                                                            {{ $coilInput->collector_messi }}
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="grid grid-cols-3">
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs font-medium text-black">
                                                                                            Electrod :
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs text-black">
                                                                                            -
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs text-black">
                                                                                            {{ $coilInput->electrod_noghre }}
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="grid grid-cols-3">
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs font-medium text-black">
                                                                                            Coil Type :
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs text-black">
                                                                                            -
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs text-black">
                                                                                            {{ $coilInput->noe_coil }}
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="grid grid-cols-3">
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs font-medium text-black">
                                                                                            Finned Length :
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs text-black">
                                                                                            -
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs text-black">
                                                                                            {{ $coilInput->toole_coil }}
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="grid grid-cols-3">
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs font-medium text-black">
                                                                                            Tube Height :
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs text-black">
                                                                                            No.
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs text-black">
                                                                                            {{ $coilInput->tedad_loole_dar_radif }}
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="grid grid-cols-3">
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs font-medium text-black">
                                                                                            Tube Height :
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs text-black">
                                                                                            -
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs text-black">
                                                                                            {{ $coilInput->tedad_mogheyiat_loole }}
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="grid grid-cols-3">
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs font-medium text-black">
                                                                                            Circuits :
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs text-black">
                                                                                            -
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="p-2">
                                                                                        <p class="text-xs text-black">
                                                                                            {{ $coilInput->tedad_madar_loole }}
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        @else
                                                                            <div class="grid grid-cols-12">
                                                                                @foreach($attributes as $attribute)
                                                                                    <div
                                                                                        class="p-0 col-span-4 {{ $loop->first ? 'mt-2' : '' }}">
                                                                                        <p class="text-black"
                                                                                           style="font-size: 9px">
                                                                                            {{ $attribute->name }} :
                                                                                        </p>
                                                                                    </div>
                                                                                    <div
                                                                                        class="p-0 col-span-2 {{ $loop->first ? 'mt-2' : '' }}">
                                                                                        <p class="text-black"
                                                                                           style="font-size: 9px">
                                                                                            {{ $attribute->unit != '-' ? $attribute->unit : '' }}
                                                                                        </p>
                                                                                    </div>
                                                                                    <div
                                                                                        class="p-0 col-span-6 {{ $loop->first ? 'mt-2' : '' }}">
                                                                                        <p class="text-black"
                                                                                           style="font-size: 9px">
                                                                                            @if(!$part->attributeValues->isEmpty())
                                                                                                @foreach($attribute->values as $value)
                                                                                                    @if($part->attributeValues->contains($value))
                                                                                                        {{ $value->value }}
                                                                                                    @endif
                                                                                                @endforeach
                                                                                            @endif
                                                                                        </p>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

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

