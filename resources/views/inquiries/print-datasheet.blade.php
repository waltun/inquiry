<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>INQ-{{ $inquiry->inquiry_number }}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        @page {
            @bottom-left {
                content: counter(page);
            }
        }
    </style>
</head>
<body class="font-IRANSans">

<!-- Content -->
<div class="mx-auto" style="width: 21cm">
    <table style="page-break-after: always;" class="w-full relative">
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
                            @if(!is_null($inquiry->archive_at))
                                <p class="text-xs font-bold text-black mr-16">
                                    تاریخ : {{ jdate($inquiry->archive_at)->format('Y/m/d') }}
                                </p>
                                <p class="text-xs font-bold text-black mr-8">
                                    شماره : INQ-{{ $inquiry->inquiry_number }}
                                </p>
                            @endif
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
                         style="border-top-left-radius: 2rem" id="counter">
                    </div>
                    <div class="w-full bg-[#005a96] mb-0 -mr-2 p-1">
                        <div class="flex items-center mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                 class="w-5 h-5 text-white">
                                <path fill-rule="evenodd"
                                      d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z"
                                      clip-rule="evenodd"/>
                            </svg>
                            <p class="text-xs text-white font-medium mr-1 text-justify">
                                پونک، ضلع شمالی مجتمع تجاری بوستان، خیابان کربلایی احمد، نبش کوچه اول، پلاک 2، طبقه
                                چهار، واحد 8
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
                            $products = $inquiry->products()->where('group_id','!=',0)->where('model_id','!=',0)->orderBy('sort','ASC')->get();
                        @endphp
                        @foreach($products as $product)
                            @php
                                $childModell = \App\Models\Modell::find($product->model_id);

                                if ($childModell->standard && !$childModell->attributes->isEmpty()) {
                                    $modell = $childModell;
                                } else {
                                    $modell = $childModell->parent;
                                }
                            @endphp
                            <div class="rounded-xl mx-4 border border-myBlue-100 mb-2 pb-2" style="page-break-before: always">
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

                                            $attributeGroups = \App\Models\AttributeGroup::whereIn('id', $attributeGroupIds->unique()->toArray())->get();
                                            $attributeGroupIds = $attributeGroupIds->toArray();
                                            $sortedAttributeGroups = $attributeGroups->sortBy('sort');
                                        @endphp
                                        <div class="bg-white py-2">
                                            @foreach($sortedAttributeGroups  as $sortedAttributeGroup)
                                                @php
                                                    $keys = array_keys($attributeGroupIds, $sortedAttributeGroup->id);

                                                    $productsAttribute = $modell->attributes->first(function ($attr) use ($sortedAttributeGroup) {
                                                        return $attr->pivot->attribute_group_id === $sortedAttributeGroup->id;
                                                    });

                                                    $modelAttribute = $sortedAttributeGroup;
                                                @endphp
                                                <div class="mb-0.5 grid grid-cols-12">
                                                    <div
                                                        class="col-span-2 bg-[#cf3b61] flex h-full items-center rounded-md">
                                                        <div class="py-0.5 px-2">
                                                            <p class="font-bold text-white text-xs">
                                                                {{ $modelAttribute->name ?? '-' }} :
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="ml-2 col-span-10 {{ $loop->first ? '' : 'border-t border-[#cf3b61]' }}">
                                                        @foreach($keys as $key)
                                                            @php
                                                                $productAttribute = $modell->attributes[$key];
                                                            @endphp
                                                            <div class="grid grid-cols-12 py-0.5">
                                                                <div class="col-span-4 flex items-center">
                                                                    <div
                                                                        class="w-2 h-2 bg-black flex-shrink-0 mr-1"></div>
                                                                    <p class="mt-0.5 text-xs font-medium text-black">
                                                                        {{ $productAttribute->name }} :
                                                                    </p>
                                                                </div>
                                                                <div class="col-span-2 flex items-center">
                                                                    <p class="text-xs font-medium text-black">
                                                                        {{ $productAttribute->pivot->unit ?? $productAttribute->unit }}
                                                                    </p>
                                                                </div>
                                                                <div class="col-span-6 flex items-center">
                                                                    <p class="text-xs font-medium text-black">
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
                                <div class="px-4">
                                    @php
                                        $midCategoryIds = collect([]);
                                        foreach ($product->amounts()->orderBy('sort', 'ASC')->get() as $amount) {
                                            $part = \App\Models\Part::find($amount->part_id);
                                            $midCategory = $part->categories[1];
                                            $lastCategory = $part->categories->last();
                                            if (!$lastCategory->attributes->isEmpty()) {
                                                $midCategoryIds->push($midCategory->id);
                                            }
                                        }
                                    @endphp
                                    <div class="space-y-2">
                                        @foreach($product->amounts()->orderBy('sort', 'ASC')->get() as $amount)
                                            @php
                                                $part = \App\Models\Part::find($amount->part_id);
                                                $categoryIds = [
                                                    496, 495, 494, 493, 492, 472, 471, 133, 132, 131, 130, 129, 128
                                                ];
                                                $lastCategoryId = $part->categories()->latest()->first()->id;
                                                $midCategory = $part->categories[1];
                                            @endphp
                                            @if(!$part->children->isEmpty() && $part->coil && in_array($lastCategoryId, $categoryIds))
                                                @if(!is_null($amount->value) && $amount->value > 0)
                                                    <div class="break-inside-avoid whitespace-nowrap">
                                                        <div class="border border-green-800">
                                                            <div class="bg-green-800 p-1.5 col-span-3 mb-2">
                                                                <p class="font-bold text-center text-white text-sm">
                                                                    {{ $midCategory->name_en ?? $midCategory->name }}
                                                                    {{ $lastCategory->name_en ? " - " . $lastCategory->name_en : '' }}
                                                                </p>
                                                            </div>
                                                            <div class="grid grid-cols-2">
                                                                @foreach($part->children()->wherePivot('head_part_id', null)->orderBy('sort', 'ASC')->get() as $children)
                                                                    @php
                                                                        $showData = false;
                                                                        foreach ($children->children()->where('head_part_id', $part->id)->orderBy('sort', 'ASC')->get() as $child) {
                                                                            if ($child->pivot->value > 0 && $child->pivot->datasheet) {
                                                                                $showData = true;
                                                                            }
                                                                        }
                                                                    @endphp
                                                                    @if($showData)
                                                                        <div class="mx-2 mb-2 border border-green-800 p-1">
                                                                            <div class="bg-green-800 p-1.5">
                                                                                <p class="font-bold text-center text-white text-sm">
                                                                                    {{ $children->name_en ?? $children->name }}
                                                                                </p>
                                                                            </div>
                                                                            @foreach($children->children()->where('head_part_id', $part->id)->orderBy('sort', 'ASC')->get() as $child)
                                                                                @if($child->pivot->value > 0 && $child->pivot->datasheet)
                                                                                    <div class="col-span-2 grid grid-cols-3">
                                                                                        <div class="p-0 col-span-2 flex items-center mt-1">
                                                                                            <div class="w-2 h-2 rounded-full border-2 border-black mb-1 mr-1"></div>
                                                                                            <p class="text-xs font-medium text-black">
                                                                                                {{ $child->name_en ?? 'ندارد' }}
                                                                                                :
                                                                                            </p>
                                                                                        </div>
                                                                                        <div class="p-0 col-span-1 mt-1">
                                                                                            <p class="text-xs font-medium text-black">
                                                                                                {{ number_format($child->pivot->value) }}
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            @endforeach
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @elseif(!$part->children->isEmpty() && !$part->coil && !in_array($lastCategoryId, $categoryIds))
                                                @if(!is_null($amount->value) && $amount->value > 0)
                                                    @php
                                                        $lastCategoryPart = $part->categories->last();
                                                        $attributesPart = $lastCategoryPart->attributes()->orderBy('sort', 'ASC')->get();
                                                        $midCategoryPart = $part->categories[1];
                                                    @endphp
                                                    <div class="break-inside-avoid whitespace-nowrap">
                                                        <div class="border border-green-800">
                                                            <div class="bg-green-800 p-1.5 col-span-3 mb-2">
                                                                <p class="font-bold text-center text-white text-sm">
                                                                    @if($part->name_en)
                                                                        {{ $part->name_en }}
                                                                    @else
                                                                        {{ $midCategoryPart->name_en }}
                                                                        {{ $lastCategoryPart->name_en ? " - " . $lastCategoryPart->name_en : '' }}
                                                                    @endif
                                                                </p>
                                                            </div>

                                                            @if(!$attributesPart->isEmpty())
                                                                <div class="mb-2">
                                                                    <div class="grid grid-cols-12 border border-green-800 p-1 mx-2">
                                                                        @foreach($attributesPart as $attribute)
                                                                            <div class="p-0 col-span-4 {{ $loop->first ? 'mt-2' : '' }}">
                                                                                <p class="text-xs font-medium text-black">
                                                                                    {{ $attribute->name }} :
                                                                                </p>
                                                                            </div>
                                                                            <div class="p-0 col-span-2 {{ $loop->first ? 'mt-2' : '' }}">
                                                                                <p class="text-xs font-medium text-black">
                                                                                    {{ $attribute->unit != '-' ? $attribute->unit : '' }}
                                                                                </p>
                                                                            </div>
                                                                            <div class="p-0 col-span-6 {{ $loop->first ? 'mt-2' : '' }}">
                                                                                <p class="text-xs font-medium text-black">
                                                                                    @php
                                                                                        $foundValue = false;
                                                                                    @endphp
                                                                                    @foreach($attribute->values as $value)
                                                                                        @if($part->attributeValues->contains($value))
                                                                                            {{ $value->value }}
                                                                                            @php
                                                                                                $foundValue = true;
                                                                                            @endphp
                                                                                        @endif
                                                                                    @endforeach
                                                                                    @if(!$foundValue)
                                                                                        {{ $attribute->pivot->default_value ?? '' }}
                                                                                    @endif
                                                                                </p>
                                                                            </div>
                                                                        @endforeach
                                                                        @if($lastCategoryPart->show_count)
                                                                            <div class="p-0 col-span-4">
                                                                                <p class="text-xs font-medium text-black">
                                                                                    Quantity :
                                                                                </p>
                                                                            </div>
                                                                            <div class="p-0 col-span-2">
                                                                                <p class="text-xs font-medium text-black">
                                                                                    No.
                                                                                </p>
                                                                            </div>
                                                                            <div class="p-0 col-span-6">
                                                                                <p class="text-xs font-medium text-black">
                                                                                    {{ number_format($amount->value) }}
                                                                                </p>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            @endif

                                                            <div class="grid grid-cols-2">
                                                                @foreach($part->children()->orderBy('sort', 'ASC')->get() as $children)
                                                                    @php
                                                                        $showData = false;
                                                                        $lastCategory = $children->categories->last();
                                                                        $attributes = $lastCategory->attributes()->orderBy('sort', 'ASC')->get();
                                                                        if ($children->pivot->value > 0 && !$attributes->isEmpty() && $children->pivot->datasheet) {
                                                                            $showData = true;
                                                                        }
                                                                    @endphp
                                                                    @if($showData)
                                                                        <div
                                                                            class="mx-2 mb-2 border border-green-800 p-1">
                                                                            <div class="bg-green-800 p-1.5">
                                                                                <p class="font-bold text-center text-white text-sm">
                                                                                    {{ $children->name_en ?? $children->name }}
                                                                                </p>
                                                                            </div>
                                                                            @foreach($attributes as $attribute)
                                                                                @if($children->pivot->value > 0 && !$attributes->isEmpty())
                                                                                    <div
                                                                                        class="col-span-2 grid grid-cols-4">
                                                                                        <div
                                                                                            class="p-0 col-span-2 flex items-center {{ $loop->first ? 'mt-2' : '' }}">
                                                                                            <div
                                                                                                class="w-2 h-2 rounded-full border-2 border-black mb-1 mr-1"></div>
                                                                                            <p class="text-xs font-medium text-black">
                                                                                                {{ $attribute->name }}
                                                                                                :
                                                                                            </p>
                                                                                        </div>
                                                                                        <div
                                                                                            class="p-0 col-span-1 {{ $loop->first ? 'mt-2' : '' }}">
                                                                                            <p class="text-xs font-medium text-black">
                                                                                                @php
                                                                                                    $foundValue = false;
                                                                                                @endphp
                                                                                                @foreach($attribute->values as $value)
                                                                                                    @if($children->attributeValues->contains($value))
                                                                                                        {{ $value->value }} {{ $attribute->unit != '-' ? "(" . $attribute->unit . ")" : '' }}
                                                                                                        @php
                                                                                                            $foundValue = true;
                                                                                                        @endphp
                                                                                                    @endif
                                                                                                @endforeach
                                                                                                @if(!$foundValue)
                                                                                                    {{ $attribute->pivot->default_value ?? '' }}
                                                                                                @endif
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            @endforeach
                                                                            @if($lastCategory->show_count)
                                                                                <div
                                                                                    class="col-span-2 grid grid-cols-4">
                                                                                    <div
                                                                                        class="p-0 col-span-2 flex items-center {{ $loop->first ? 'mt-2' : '' }}">
                                                                                        <div class="w-2 h-2 rounded-full border-2 border-black mb-1 mr-1"></div>
                                                                                        <p class="text-xs font-medium text-black">
                                                                                            Quantity
                                                                                            :
                                                                                        </p>
                                                                                    </div>
                                                                                    <div
                                                                                        class="p-0 col-span-1 {{ $loop->first ? 'mt-2' : '' }}">
                                                                                        <p class="text-xs font-medium text-black">
                                                                                            {{ number_format($children->pivot->value * $amount->value, 0) }}
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @else
                                                @php
                                                    $midCategory = $part->categories[1];
                                                    $lastCategory = $part->categories->last();
                                                    $attributes = $lastCategory->attributes()->orderBy('sort', 'ASC')->get();

                                                    $display = false;
                                                    if (!$attributes->isEmpty()) {
                                                        $display = true;
                                                    }
                                                @endphp
                                                @if($display)
                                                    @if($part->show_datasheet)
                                                        @if(!is_null($amount->value) && $amount->value > 0 && !$attributes->isEmpty())
                                                            <div class="break-inside-avoid whitespace-nowrap">
                                                                <div class="bg-green-800 p-1.5">
                                                                    <p class="font-bold text-center text-white text-sm">
                                                                        {{ $midCategory->name_en ?? $midCategory->name }}
                                                                        {{ $lastCategory->name_en ? " - " . $lastCategory->name_en : '' }}
                                                                    </p>
                                                                </div>
                                                                <div class="bg-white">
                                                                    @php
                                                                        $coilInput = null;
                                                                        $convertorInput = null;
                                                                    @endphp
                                                                    @php
                                                                        $part = \App\Models\Part::find($amount->part_id);
                                                                        if ($part->coil) {
                                                                            $coilInput = \App\Models\CoilInput::where('part_id', $part->id)->first();
                                                                            $convertorInput = \App\Models\ConvertorInput::where('part_id', $part->id)->where('inquiry_id', $inquiry->id)->first();
                                                                        }
                                                                    @endphp
                                                                    @if(!$attributes->isEmpty())
                                                                        <div class="mb-2">
                                                                            @if(!is_null($coilInput))
                                                                                <div class="border border-green-800 p-1">
                                                                                    <div class="grid grid-cols-3">
                                                                                        <div class="mt-2">
                                                                                            <p class="text-xs font-medium text-black">
                                                                                                Tube :
                                                                                            </p>
                                                                                        </div>
                                                                                        <div class="mt-2">
                                                                                            <p class="text-xs font-medium text-black">
                                                                                                -
                                                                                            </p>
                                                                                        </div>
                                                                                        <div class="mt-2">
                                                                                            <p class="text-xs font-medium text-black">
                                                                                                {{ $coilInput->loole_messi }}
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="grid grid-cols-3">
                                                                                        <div>
                                                                                            <p class="text-xs font-medium text-black">
                                                                                                Fin :
                                                                                            </p>
                                                                                        </div>
                                                                                        <div>
                                                                                            <p class="text-xs font-medium text-black">
                                                                                                -
                                                                                            </p>
                                                                                        </div>
                                                                                        <div>
                                                                                            <p class="text-xs font-medium text-black">
                                                                                                {{ $coilInput->fin_coil }}
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="grid grid-cols-3">
                                                                                        <div>
                                                                                            <p class="text-xs font-medium text-black">
                                                                                                Number of Row :
                                                                                            </p>
                                                                                        </div>
                                                                                        <div>
                                                                                            <p class="text-xs font-medium text-black">
                                                                                                No.
                                                                                            </p>
                                                                                        </div>
                                                                                        <div>
                                                                                            <p class="text-xs font-medium text-black">
                                                                                                {{ $coilInput->tedad_radif_coil }}
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="grid grid-cols-3">
                                                                                        <div>
                                                                                            <p class="text-xs font-medium text-black">
                                                                                                Fin per Inch :
                                                                                            </p>
                                                                                        </div>
                                                                                        <div>
                                                                                            <p class="text-xs font-medium text-black">
                                                                                                FPI
                                                                                            </p>
                                                                                        </div>
                                                                                        <div>
                                                                                            <p class="text-xs font-medium text-black">
                                                                                                {{ $coilInput->fin_dar_inch }}
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="grid grid-cols-3">
                                                                                        <div>
                                                                                            <p class="text-xs font-medium text-black">
                                                                                                Frame :
                                                                                            </p>
                                                                                        </div>
                                                                                        <div>
                                                                                            <p class="text-xs font-medium text-black">
                                                                                                -
                                                                                            </p>
                                                                                        </div>
                                                                                        <div>
                                                                                            <p class="text-xs font-medium text-black">
                                                                                                {{ $coilInput->zekhamat_frame_coil }}
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="grid grid-cols-3">
                                                                                        <div>
                                                                                            <p class="text-xs font-medium text-black">
                                                                                                Coating :
                                                                                            </p>
                                                                                        </div>
                                                                                        <div>
                                                                                            <p class="text-xs font-medium text-black">
                                                                                                -
                                                                                            </p>
                                                                                        </div>
                                                                                        <div>
                                                                                            <p class="text-xs font-medium text-black">
                                                                                                {{ $coilInput->pooshesh_khordegi }}
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="grid grid-cols-3">
                                                                                        <div>
                                                                                            <p class="text-xs font-medium text-black">
                                                                                                Face Area :
                                                                                            </p>
                                                                                        </div>
                                                                                        <div>
                                                                                            <p class="text-xs font-medium text-black">
                                                                                                FT^2
                                                                                            </p>
                                                                                        </div>
                                                                                        <div>
                                                                                            <p class="text-xs font-medium text-black">
                                                                                                {{ number_format($coilInput->sathe_coil, 2) }}
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="grid grid-cols-3">
                                                                                        <div>
                                                                                            <p class="text-xs font-medium text-black">
                                                                                                Quantity :
                                                                                            </p>
                                                                                        </div>
                                                                                        <div>
                                                                                            <p class="text-xs font-medium text-black">
                                                                                                No.
                                                                                            </p>
                                                                                        </div>
                                                                                        <div>
                                                                                            <p class="text-xs font-medium text-black">
                                                                                                {{ number_format($amount->value, 0) }}
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @elseif(!is_null($convertorInput))
                                                                                @if($convertorInput->type == 'Evaporator')
                                                                                    <div class="border border-green-800 p-1">
                                                                                        <div class="grid grid-cols-3">
                                                                                            <div class="mt-2">
                                                                                                <p class="text-xs font-medium text-black">
                                                                                                    Actual Cooling Load
                                                                                                    :
                                                                                                </p>
                                                                                            </div>
                                                                                            <div class="mt-2">
                                                                                                <p class="text-xs text-black font-medium">
                                                                                                    Ton
                                                                                                </p>
                                                                                            </div>
                                                                                            <div class="mt-2">
                                                                                                <p class="text-xs text-black font-medium">
                                                                                                    {{ $convertorInput->tonaj }}
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="grid grid-cols-3">
                                                                                            <div>
                                                                                                <p class="text-xs font-medium text-black">
                                                                                                    Refrigerant :
                                                                                                </p>
                                                                                            </div>
                                                                                            <div>
                                                                                                <p class="text-xs text-black font-medium">
                                                                                                    -
                                                                                                </p>
                                                                                            </div>
                                                                                            <div>
                                                                                                <p class="text-xs text-black font-medium">
                                                                                                    {{ $convertorInput->gaz }}
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="grid grid-cols-3">
                                                                                            <div>
                                                                                                <p class="text-xs font-medium text-black">
                                                                                                    Number of Curcuits :
                                                                                                </p>
                                                                                            </div>
                                                                                            <div>
                                                                                                <p class="text-xs text-black font-medium">
                                                                                                    No.
                                                                                                </p>
                                                                                            </div>
                                                                                            <div>
                                                                                                <p class="text-xs text-black font-medium">
                                                                                                    {{ $convertorInput->tedad_madar }}
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="grid grid-cols-3">
                                                                                            <div>
                                                                                                <p class="text-xs font-medium text-black">
                                                                                                    Shell :
                                                                                                </p>
                                                                                            </div>
                                                                                            <div>
                                                                                                <p class="text-xs text-black font-medium">
                                                                                                    Inch
                                                                                                </p>
                                                                                            </div>
                                                                                            <div>
                                                                                                <p class="text-xs text-black font-medium">
                                                                                                    {{ $convertorInput->size_loole_pooste }}
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="grid grid-cols-3">
                                                                                            <div>
                                                                                                <p class="text-xs font-medium text-black">
                                                                                                    Tube :
                                                                                                </p>
                                                                                            </div>
                                                                                            <div>
                                                                                                <p class="text-xs text-black font-medium">
                                                                                                    -
                                                                                                </p>
                                                                                            </div>
                                                                                            <div>
                                                                                                <p class="text-xs text-black font-medium">
                                                                                                    {{ $convertorInput->loole_messi }}
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="grid grid-cols-3">
                                                                                            <div>
                                                                                                <p class="text-xs font-medium text-black">
                                                                                                    Insulation :
                                                                                                </p>
                                                                                            </div>
                                                                                            <div>
                                                                                                <p class="text-xs text-black font-medium">
                                                                                                    -
                                                                                                </p>
                                                                                            </div>
                                                                                            <div>
                                                                                                <p class="text-xs text-black font-medium">
                                                                                                    {{ $convertorInput->ayegh }}
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="grid grid-cols-3">
                                                                                            <div>
                                                                                                <p class="text-xs font-medium text-black">
                                                                                                    Inlet & Outlet
                                                                                                    Connection :
                                                                                                </p>
                                                                                            </div>
                                                                                            <div>
                                                                                                <p class="text-xs text-black font-medium">
                                                                                                    Inch
                                                                                                </p>
                                                                                            </div>
                                                                                            <div>
                                                                                                <p class="text-xs text-black font-medium">
                                                                                                    {{ $convertorInput->flanch }}
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="grid grid-cols-3">
                                                                                            <div>
                                                                                                <p class="text-xs font-medium text-black">
                                                                                                    Bafel Material :
                                                                                                </p>
                                                                                            </div>
                                                                                            <div>
                                                                                                <p class="text-xs text-black font-medium">
                                                                                                    -
                                                                                                </p>
                                                                                            </div>
                                                                                            <div>
                                                                                                <p class="text-xs text-black font-medium">
                                                                                                    {{ $convertorInput->noe_bafel }}
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="grid grid-cols-3">
                                                                                            <div>
                                                                                                <p class="text-xs font-medium text-black">
                                                                                                    Number of Bafel :
                                                                                                </p>
                                                                                            </div>
                                                                                            <div>
                                                                                                <p class="text-xs text-black font-medium">
                                                                                                    No.
                                                                                                </p>
                                                                                            </div>
                                                                                            <div>
                                                                                                <p class="text-xs text-black font-medium">
                                                                                                    {{ $convertorInput->tedad_bafel }}
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="grid grid-cols-3">
                                                                                            <div>
                                                                                                <p class="text-xs font-medium text-black">
                                                                                                    Quantity :
                                                                                                </p>
                                                                                            </div>
                                                                                            <div>
                                                                                                <p class="text-xs text-black font-medium">
                                                                                                    No.
                                                                                                </p>
                                                                                            </div>
                                                                                            <div>
                                                                                                <p class="text-xs text-black font-medium">
                                                                                                    {{ number_format($amount->value) }}
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                @else
                                                                                    <div class="border border-green-800 p-1">
                                                                                        <div class="grid grid-cols-3">
                                                                                            <div class="mt-2">
                                                                                                <p class="text-xs font-medium text-black">
                                                                                                    Actual Cooling Load
                                                                                                    :
                                                                                                </p>
                                                                                            </div>
                                                                                            <div class="mt-2">
                                                                                                <p class="text-xs text-black font-medium">
                                                                                                    Ton
                                                                                                </p>
                                                                                            </div>
                                                                                            <div class="mt-2">
                                                                                                <p class="text-xs text-black font-medium">
                                                                                                    {{ $convertorInput->tonaj }}
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="grid grid-cols-3">
                                                                                            <div>
                                                                                                <p class="text-xs font-medium text-black">
                                                                                                    Refrigerant :
                                                                                                </p>
                                                                                            </div>
                                                                                            <div>
                                                                                                <p class="text-xs text-black font-medium">
                                                                                                    -
                                                                                                </p>
                                                                                            </div>
                                                                                            <div>
                                                                                                <p class="text-xs text-black font-medium">
                                                                                                    {{ $convertorInput->gaz }}
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="grid grid-cols-3">
                                                                                            <div>
                                                                                                <p class="text-xs font-medium text-black">
                                                                                                    Shell :
                                                                                                </p>
                                                                                            </div>
                                                                                            <div>
                                                                                                <p class="text-xs text-black font-medium">
                                                                                                    Inch
                                                                                                </p>
                                                                                            </div>
                                                                                            <div>
                                                                                                <p class="text-xs text-black font-medium">
                                                                                                    {{ $convertorInput->size_loole_pooste }}
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="grid grid-cols-3">
                                                                                            <div>
                                                                                                <p class="text-xs font-medium text-black">
                                                                                                    Tube :
                                                                                                </p>
                                                                                            </div>
                                                                                            <div>
                                                                                                <p class="text-xs text-black font-medium">
                                                                                                    -
                                                                                                </p>
                                                                                            </div>
                                                                                            <div>
                                                                                                <p class="text-xs text-black font-medium">
                                                                                                    {{ $convertorInput->loole_messi }}
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="grid grid-cols-3">
                                                                                            <div>
                                                                                                <p class="text-xs font-medium text-black">
                                                                                                    Inlet & Outlet
                                                                                                    Connection :
                                                                                                </p>
                                                                                            </div>
                                                                                            <div>
                                                                                                <p class="text-xs text-black font-medium">
                                                                                                    Inch
                                                                                                </p>
                                                                                            </div>
                                                                                            <div>
                                                                                                <p class="text-xs text-black font-medium">
                                                                                                    {{ $convertorInput->flanch }}
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="grid grid-cols-3">
                                                                                            <div>
                                                                                                <p class="text-xs font-medium text-black">
                                                                                                    Quantity :
                                                                                                </p>
                                                                                            </div>
                                                                                            <div>
                                                                                                <p class="text-xs text-black font-medium">
                                                                                                    No.
                                                                                                </p>
                                                                                            </div>
                                                                                            <div>
                                                                                                <p class="text-xs text-black font-medium">
                                                                                                    {{ number_format($amount->value) }}
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            @else
                                                                                <div class="grid grid-cols-12 border border-green-800 p-1">
                                                                                    @foreach($attributes as $attribute)
                                                                                        <div
                                                                                            class="p-0 col-span-4 {{ $loop->first ? 'mt-2' : '' }}">
                                                                                            <p class="text-xs font-medium text-black">
                                                                                                {{ $attribute->name }}
                                                                                                :
                                                                                            </p>
                                                                                        </div>
                                                                                        <div
                                                                                            class="p-0 col-span-2 {{ $loop->first ? 'mt-2' : '' }}">
                                                                                            <p class="text-xs font-medium text-black">
                                                                                                {{ $attribute->unit != '-' ? $attribute->unit : '' }}
                                                                                            </p>
                                                                                        </div>
                                                                                        <div
                                                                                            class="p-0 col-span-6 {{ $loop->first ? 'mt-2' : '' }}">
                                                                                            <p class="text-xs font-medium text-black">
                                                                                                @php
                                                                                                    $foundValue = false;
                                                                                                @endphp
                                                                                                @foreach($attribute->values as $value)
                                                                                                    @if($part->attributeValues->contains($value))
                                                                                                        {{ $value->value }}
                                                                                                        @php
                                                                                                            $foundValue = true;
                                                                                                        @endphp
                                                                                                    @endif
                                                                                                @endforeach
                                                                                                @if(!$foundValue)
                                                                                                    {{ $attribute->pivot->default_value ?? '' }}
                                                                                                @endif
                                                                                            </p>
                                                                                        </div>
                                                                                    @endforeach
                                                                                    @if($lastCategory->show_count)
                                                                                        <div
                                                                                            class="p-0 col-span-4">
                                                                                            <p class="text-xs font-medium text-black">
                                                                                                Quantity :
                                                                                            </p>
                                                                                        </div>
                                                                                        <div
                                                                                            class="p-0 col-span-2">
                                                                                            <p class="text-xs font-medium text-black">
                                                                                                No.
                                                                                            </p>
                                                                                        </div>
                                                                                        <div
                                                                                            class="p-0 col-span-6">
                                                                                            <p class="text-xs font-medium text-black">
                                                                                                {{ number_format($amount->value, 0) }}
                                                                                            </p>
                                                                                        </div>
                                                                                    @endif
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @php
                        $types = ['setup','years','control','power_cable','control_cable','pipe','install_setup_price','setup_price','supervision','transport','other','setup_one','install','cable','canal','copper_piping','carbon_piping', 'coil',null];
                    @endphp
                    @foreach($types as $type)
                        @php
                            $products = $inquiry->products()->where('part_id','!=',0)->where('type',$type)->orderBy('sort','ASC')->get();

                            $display = false;
                            foreach ($products as $product) {
                                $part = \App\Models\Part::find($product->part_id);
                                $midCategoryIds = collect([]);
                                $midCategory = $part->categories[1];
                                $lastCategory = $part->categories->last();
                                $categoryIds = [
                                    496, 495, 494, 493, 492, 472, 471, 133, 132, 131, 130, 129, 128
                                ];
                                $lastCategoryId = $part->categories()->latest()->first()->id;

                                if (!$lastCategory->attributes->isEmpty()) {
                                    $display = true;
                                }
                            }
                        @endphp
                        @if($display)
                            <div class="border border-indigo-500 mb-4 mx-4 pb-4" style="border-radius: 10px !important;">
                                <div class="mb-4 bg-[#005a96] py-1.5 rounded-t-lg">
                                    <p class="text-base font-extrabold text-white text-center">
                                        @switch($type)
                                            @case('setup')
                                                Commissioning Spare Parts
                                                @break
                                            @case('years')
                                                Two Years Spare Parts
                                                @break
                                            @case('control')
                                                Instruments
                                                @break
                                            @case('power_cable')
                                                Power Cable List
                                                @break
                                            @case('control_cable')
                                                Control Cable List
                                                @break
                                            @case('pipe')
                                                Piping
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
                                                Other Equipments
                                                @break
                                            @case('setup_one')
                                                Commissioning Parts
                                                @break
                                            @case('install')
                                                Installation Parts
                                                @break
                                            @case('cable')
                                                Cabling Equipments
                                                @break
                                            @case('canal')
                                                Ducting Equipments
                                                @break
                                            @case('copper_piping')
                                                دستمزد لوله کشی مسی
                                                @break
                                            @case('carbon_piping')
                                                دستمزد لوله کشی کربن استیل
                                                @break
                                            @case('coil')
                                                Coil and Heat Exchanger
                                                @break
                                            @case('')
                                                سایر تجهیزات (قطعات قبلی)
                                                @break
                                        @endswitch
                                    </p>
                                </div>
                                <div class="mt-4 space-y-4 p-4" dir="ltr">
                                    @foreach($products as $product)
                                        @php
                                            $part = \App\Models\Part::find($product->part_id);
                                            $midCategoryIds = collect([]);
                                            $midCategory = $part->categories[1];
                                            $lastCategory = $part->categories->last();
                                            if (!$lastCategory->attributes->isEmpty()) {
                                                $midCategoryIds->push($midCategory->id);
                                            }
                                        @endphp

                                        @if(!$part->children->isEmpty() && $part->coil && in_array($lastCategoryId, $categoryIds))
                                            <div class="break-inside-avoid whitespace-nowrap">
                                                <div class="border border-green-800">
                                                    <div class="bg-green-800 p-1.5 col-span-3 mb-2">
                                                        <p class="font-bold text-center text-white text-sm">
                                                            {{ $midCategory->name_en ?? $midCategory->name }}
                                                            {{ $lastCategory->name_en ? " - " . $lastCategory->name_en : '' }}
                                                        </p>
                                                    </div>
                                                    <div class="grid grid-cols-2">
                                                        @foreach($part->children()->wherePivot('head_part_id', null)->orderBy('sort', 'ASC')->get() as $children)
                                                            @php
                                                                $showData = false;
                                                                foreach ($children->children()->where('head_part_id', $part->id)->orderBy('sort', 'ASC')->get() as $child) {
                                                                    if ($child->pivot->value > 0 && $child->pivot->datasheet) {
                                                                        $showData = true;
                                                                    }
                                                                }
                                                            @endphp
                                                            @if($showData)
                                                                <div class="mx-2 mb-2 border border-green-800 p-1">
                                                                    <div class="bg-green-800 p-1.5">
                                                                        <p class="font-bold text-center text-white text-sm">
                                                                            {{ $children->name_en ?? $children->name }}
                                                                        </p>
                                                                    </div>
                                                                    @foreach($children->children()->where('head_part_id', $part->id)->orderBy('sort', 'ASC')->get() as $child)
                                                                        @if($child->pivot->value > 0 && $child->pivot->datasheet)
                                                                            <div class="col-span-2 grid grid-cols-3">
                                                                                <div class="p-0 col-span-2 flex items-center mt-1">
                                                                                    <div class="w-2 h-2 rounded-full border-2 border-black mb-1 mr-1"></div>
                                                                                    <p class="text-xs font-medium text-black">
                                                                                        {{ $child->name_en ?? 'ندارد' }}
                                                                                        :
                                                                                    </p>
                                                                                </div>
                                                                                <div class="p-0 col-span-1 mt-1">
                                                                                    <p class="text-xs font-medium text-black">
                                                                                        {{ number_format($child->pivot->value) }}
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif(!$part->children->isEmpty() && !$part->coil && !in_array($lastCategoryId, $categoryIds))
                                            @php
                                                $lastCategoryPart = $part->categories->last();
                                                $attributesPart = $lastCategoryPart->attributes()->orderBy('sort', 'ASC')->get();
                                                $midCategoryPart = $part->categories[1];
                                            @endphp
                                            <div class="break-inside-avoid whitespace-nowrap">
                                                <div class="border border-green-800">
                                                    <div class="bg-green-800 p-1.5 col-span-3 mb-2">
                                                        <p class="font-bold text-center text-white text-sm">
                                                            @if($part->name_en)
                                                                {{ $part->name_en }}
                                                            @else
                                                                {{ $midCategoryPart->name_en }}
                                                                {{ $lastCategoryPart->name_en ? " - " . $lastCategoryPart->name_en : '' }}
                                                            @endif
                                                        </p>
                                                    </div>

                                                    @if(!$attributesPart->isEmpty())
                                                        <div class="mb-2">
                                                            <div class="grid grid-cols-12 border border-green-800 p-1 mx-2">
                                                                @foreach($attributesPart as $attribute)
                                                                    <div class="p-0 col-span-4 {{ $loop->first ? 'mt-2' : '' }}">
                                                                        <p class="text-xs font-medium text-black">
                                                                            {{ $attribute->name }} :
                                                                        </p>
                                                                    </div>
                                                                    <div class="p-0 col-span-2 {{ $loop->first ? 'mt-2' : '' }}">
                                                                        <p class="text-xs font-medium text-black">
                                                                            {{ $attribute->unit != '-' ? $attribute->unit : '' }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="p-0 col-span-6 {{ $loop->first ? 'mt-2' : '' }}">
                                                                        <p class="text-xs font-medium text-black">
                                                                            @php
                                                                                $foundValue = false;
                                                                            @endphp
                                                                            @foreach($attribute->values as $value)
                                                                                @if($part->attributeValues->contains($value))
                                                                                    {{ $value->value }}
                                                                                    @php
                                                                                        $foundValue = true;
                                                                                    @endphp
                                                                                @endif
                                                                            @endforeach
                                                                            @if(!$foundValue)
                                                                                {{ $attribute->pivot->default_value ?? '' }}
                                                                            @endif
                                                                        </p>
                                                                    </div>
                                                                @endforeach
                                                                @if($lastCategoryPart->show_count)
                                                                    <div class="p-0 col-span-4">
                                                                        <p class="text-xs font-medium text-black">
                                                                            Quantity :
                                                                        </p>
                                                                    </div>
                                                                    <div class="p-0 col-span-2">
                                                                        <p class="text-xs font-medium text-black">
                                                                            No.
                                                                        </p>
                                                                    </div>
                                                                    <div class="p-0 col-span-6">
                                                                        <p class="text-xs font-medium text-black">
                                                                            {{ number_format($product->quantity) }}
                                                                        </p>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <div class="grid grid-cols-2">
                                                        @foreach($part->children()->orderBy('sort', 'ASC')->get() as $children)
                                                            @php
                                                                $showData = false;
                                                                $lastCategory = $children->categories->last();
                                                                $attributes = $lastCategory->attributes()->orderBy('sort', 'ASC')->get();
                                                                if ($children->pivot->value > 0 && !$attributes->isEmpty() && $children->pivot->datasheet) {
                                                                    $showData = true;
                                                                }
                                                            @endphp
                                                            @if($showData)
                                                                <div
                                                                    class="mx-2 mb-2 border border-green-800 p-1">
                                                                    <div class="bg-green-800 p-1.5">
                                                                        <p class="font-bold text-center text-white text-sm">
                                                                            {{ $children->name_en ?? $children->name }}
                                                                        </p>
                                                                    </div>
                                                                    @foreach($attributes as $attribute)
                                                                        @if($children->pivot->value > 0 && !$attributes->isEmpty())
                                                                            <div
                                                                                class="col-span-2 grid grid-cols-4">
                                                                                <div
                                                                                    class="p-0 col-span-2 flex items-center {{ $loop->first ? 'mt-2' : '' }}">
                                                                                    <div
                                                                                        class="w-2 h-2 rounded-full border-2 border-black mb-1 mr-1"></div>
                                                                                    <p class="text-xs font-medium text-black">
                                                                                        {{ $attribute->name }}
                                                                                        :
                                                                                    </p>
                                                                                </div>
                                                                                <div
                                                                                    class="p-0 col-span-1 {{ $loop->first ? 'mt-2' : '' }}">
                                                                                    <p class="text-xs font-medium text-black">
                                                                                        @php
                                                                                            $foundValue = false;
                                                                                        @endphp
                                                                                        @foreach($attribute->values as $value)
                                                                                            @if($children->attributeValues->contains($value))
                                                                                                {{ $value->value }} {{ $attribute->unit != '-' ? "(" . $attribute->unit . ")" : '' }}
                                                                                                @php
                                                                                                    $foundValue = true;
                                                                                                @endphp
                                                                                            @endif
                                                                                        @endforeach
                                                                                        @if(!$foundValue)
                                                                                            {{ $attribute->pivot->default_value ?? '' }}
                                                                                        @endif
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                    @if($lastCategory->show_count)
                                                                        <div
                                                                            class="col-span-2 grid grid-cols-4">
                                                                            <div
                                                                                class="p-0 col-span-2 flex items-center {{ $loop->first ? 'mt-2' : '' }}">
                                                                                <div class="w-2 h-2 rounded-full border-2 border-black mb-1 mr-1"></div>
                                                                                <p class="text-xs font-medium text-black">
                                                                                    Quantity
                                                                                    :
                                                                                </p>
                                                                            </div>
                                                                            <div
                                                                                class="p-0 col-span-1 {{ $loop->first ? 'mt-2' : '' }}">
                                                                                <p class="text-xs font-medium text-black">
                                                                                    {{ number_format($children->pivot->value * $amount->value, 0) }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            @if(!$lastCategory->attributes->isEmpty())
                                                <div class="mx-4 border border-green-800 mb-2 pb-2">
                                                    <div class="bg-green-800 p-1.5">
                                                        <p class="text-center text-white font-bold text-sm">
                                                            {{ $part->name_en ?? $part->name }}
                                                        </p>
                                                    </div>
                                                    <div class="px-4">
                                                        @php
                                                            $coilInput = null;
                                                            $convertorInput = null;
                                                            $attributes = $lastCategory->attributes()->orderBy('sort', 'ASC')->get();
                                                        @endphp
                                                        @php
                                                            if ($part->coil) {
                                                                $coilInput = \App\Models\CoilInput::where('part_id', $part->id)->first();
                                                                $convertorInput = \App\Models\ConvertorInput::where('part_id', $part->id)->where('inquiry_id', $inquiry->id)->first();
                                                            }
                                                        @endphp
                                                        @if(!$attributes->isEmpty())
                                                            <div class="break-inside-avoid whitespace-nowrap">
                                                                @if(!is_null($coilInput))
                                                                    <div class="grid grid-cols-3">
                                                                        <div class="mt-2">
                                                                            <p class="text-xs font-medium text-black">
                                                                                Tube :
                                                                            </p>
                                                                        </div>
                                                                        <div class="mt-2">
                                                                            <p class="text-xs font-medium text-black">
                                                                                -
                                                                            </p>
                                                                        </div>
                                                                        <div class="mt-2">
                                                                            <p class="text-xs font-medium text-black">
                                                                                {{ $coilInput->loole_messi }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="grid grid-cols-3">
                                                                        <div>
                                                                            <p class="text-xs font-medium text-black">
                                                                                Fin :
                                                                            </p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="text-xs font-medium text-black">
                                                                                -
                                                                            </p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="text-xs font-medium text-black">
                                                                                {{ $coilInput->fin_coil }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="grid grid-cols-3">
                                                                        <div>
                                                                            <p class="text-xs font-medium text-black">
                                                                                Number of Row :
                                                                            </p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="text-xs font-medium text-black">
                                                                                No.
                                                                            </p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="text-xs font-medium text-black">
                                                                                {{ $coilInput->tedad_radif_coil }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="grid grid-cols-3">
                                                                        <div>
                                                                            <p class="text-xs font-medium text-black">
                                                                                Fin per Inch :
                                                                            </p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="text-xs font-medium text-black">
                                                                                FPI
                                                                            </p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="text-xs font-medium text-black">
                                                                                {{ $coilInput->fin_dar_inch }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="grid grid-cols-3">
                                                                        <div>
                                                                            <p class="text-xs font-medium text-black">
                                                                                Frame :
                                                                            </p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="text-xs font-medium text-black">
                                                                                -
                                                                            </p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="text-xs font-medium text-black">
                                                                                {{ $coilInput->zekhamat_frame_coil }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="grid grid-cols-3">
                                                                        <div>
                                                                            <p class="text-xs font-medium text-black">
                                                                                Coating :
                                                                            </p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="text-xs font-medium text-black">
                                                                                -
                                                                            </p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="text-xs font-medium text-black">
                                                                                {{ $coilInput->pooshesh_khordegi }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="grid grid-cols-3">
                                                                        <div>
                                                                            <p class="text-xs font-medium text-black">
                                                                                Face Area :
                                                                            </p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="text-xs font-medium text-black">
                                                                                FT^2
                                                                            </p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="text-xs font-medium text-black">
                                                                                {{ number_format($coilInput->sathe_coil, 2) }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="grid grid-cols-3">
                                                                        <div>
                                                                            <p class="text-xs font-medium text-black">
                                                                                Quantity :
                                                                            </p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="text-xs font-medium text-black">
                                                                                No.
                                                                            </p>
                                                                        </div>
                                                                        <div>
                                                                            <p class="text-xs font-medium text-black">
                                                                                {{ number_format($amount->value, 0) }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                @elseif(!is_null($convertorInput))
                                                                    @if($convertorInput->type == 'Evaporator')
                                                                        <div class="grid grid-cols-3">
                                                                            <div class="mt-2">
                                                                                <p class="text-xs font-medium text-black">
                                                                                    Actual Cooling Load
                                                                                    :
                                                                                </p>
                                                                            </div>
                                                                            <div class="mt-2">
                                                                                <p class="text-xs text-black font-medium">
                                                                                    Ton
                                                                                </p>
                                                                            </div>
                                                                            <div class="mt-2">
                                                                                <p class="text-xs text-black font-medium">
                                                                                    {{ $convertorInput->tonaj }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="grid grid-cols-3">
                                                                            <div>
                                                                                <p class="text-xs font-medium text-black">
                                                                                    Refrigerant :
                                                                                </p>
                                                                            </div>
                                                                            <div>
                                                                                <p class="text-xs text-black font-medium">
                                                                                    -
                                                                                </p>
                                                                            </div>
                                                                            <div>
                                                                                <p class="text-xs text-black font-medium">
                                                                                    {{ $convertorInput->gaz }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="grid grid-cols-3">
                                                                            <div>
                                                                                <p class="text-xs font-medium text-black">
                                                                                    Number of Curcuits :
                                                                                </p>
                                                                            </div>
                                                                            <div>
                                                                                <p class="text-xs text-black font-medium">
                                                                                    No.
                                                                                </p>
                                                                            </div>
                                                                            <div>
                                                                                <p class="text-xs text-black font-medium">
                                                                                    {{ $convertorInput->tedad_madar }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="grid grid-cols-3">
                                                                            <div>
                                                                                <p class="text-xs font-medium text-black">
                                                                                    Shell :
                                                                                </p>
                                                                            </div>
                                                                            <div>
                                                                                <p class="text-xs text-black font-medium">
                                                                                    Inch
                                                                                </p>
                                                                            </div>
                                                                            <div>
                                                                                <p class="text-xs text-black font-medium">
                                                                                    {{ $convertorInput->size_loole_pooste }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="grid grid-cols-3">
                                                                            <div>
                                                                                <p class="text-xs font-medium text-black">
                                                                                    Tube :
                                                                                </p>
                                                                            </div>
                                                                            <div>
                                                                                <p class="text-xs text-black font-medium">
                                                                                    -
                                                                                </p>
                                                                            </div>
                                                                            <div>
                                                                                <p class="text-xs text-black font-medium">
                                                                                    {{ $convertorInput->loole_messi }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="grid grid-cols-3">
                                                                            <div>
                                                                                <p class="text-xs font-medium text-black">
                                                                                    Insulation :
                                                                                </p>
                                                                            </div>
                                                                            <div>
                                                                                <p class="text-xs text-black font-medium">
                                                                                    -
                                                                                </p>
                                                                            </div>
                                                                            <div>
                                                                                <p class="text-xs text-black font-medium">
                                                                                    {{ $convertorInput->ayegh }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="grid grid-cols-3">
                                                                            <div>
                                                                                <p class="text-xs font-medium text-black">
                                                                                    Inlet & Outlet
                                                                                    Connection :
                                                                                </p>
                                                                            </div>
                                                                            <div>
                                                                                <p class="text-xs text-black font-medium">
                                                                                    Inch
                                                                                </p>
                                                                            </div>
                                                                            <div>
                                                                                <p class="text-xs text-black font-medium">
                                                                                    {{ $convertorInput->flanch }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="grid grid-cols-3">
                                                                            <div>
                                                                                <p class="text-xs font-medium text-black">
                                                                                    Bafel Material :
                                                                                </p>
                                                                            </div>
                                                                            <div>
                                                                                <p class="text-xs text-black font-medium">
                                                                                    -
                                                                                </p>
                                                                            </div>
                                                                            <div>
                                                                                <p class="text-xs text-black font-medium">
                                                                                    {{ $convertorInput->noe_bafel }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="grid grid-cols-3">
                                                                            <div>
                                                                                <p class="text-xs font-medium text-black">
                                                                                    Number of Bafel :
                                                                                </p>
                                                                            </div>
                                                                            <div>
                                                                                <p class="text-xs text-black font-medium">
                                                                                    No.
                                                                                </p>
                                                                            </div>
                                                                            <div>
                                                                                <p class="text-xs text-black font-medium">
                                                                                    {{ $convertorInput->tedad_bafel }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="grid grid-cols-3">
                                                                            <div>
                                                                                <p class="text-xs font-medium text-black">
                                                                                    Quantity :
                                                                                </p>
                                                                            </div>
                                                                            <div>
                                                                                <p class="text-xs text-black font-medium">
                                                                                    No.
                                                                                </p>
                                                                            </div>
                                                                            <div>
                                                                                <p class="text-xs text-black font-medium">
                                                                                    {{ number_format($amount->value) }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @else
                                                                    <div class="grid grid-cols-12">
                                                                        @foreach($attributes as $attribute)
                                                                            <div
                                                                                class="p-0 col-span-4 {{ $loop->first ? 'mt-2' : '' }}">
                                                                                <p class="text-xs font-medium text-black">
                                                                                    {{ $attribute->name }}
                                                                                    :
                                                                                </p>
                                                                            </div>
                                                                            <div
                                                                                class="p-0 col-span-2 {{ $loop->first ? 'mt-2' : '' }}">
                                                                                <p class="text-xs font-medium text-black">
                                                                                    {{ $attribute->unit != '-' ? $attribute->unit : '' }}
                                                                                </p>
                                                                            </div>
                                                                            <div
                                                                                class="p-0 col-span-6 {{ $loop->first ? 'mt-2' : '' }}">
                                                                                <p class="text-xs font-medium text-black">
                                                                                    @php
                                                                                        $foundValue = false;
                                                                                    @endphp
                                                                                    @foreach($attribute->values as $value)
                                                                                        @if($part->attributeValues->contains($value))
                                                                                            {{ $value->value }}
                                                                                            @php
                                                                                                $foundValue = true;
                                                                                            @endphp
                                                                                        @endif
                                                                                    @endforeach
                                                                                    @if(!$foundValue)
                                                                                        {{ $attribute->pivot->default_value ?? '' }}
                                                                                    @endif
                                                                                </p>
                                                                            </div>
                                                                        @endforeach
                                                                        @if($lastCategory->show_count)
                                                                            <div
                                                                                class="p-0 col-span-4">
                                                                                <p class="text-xs font-medium text-black">
                                                                                    Quantity :
                                                                                </p>
                                                                            </div>
                                                                            <div
                                                                                class="p-0 col-span-2">
                                                                                <p class="text-xs font-medium text-black">
                                                                                    No.
                                                                                </p>
                                                                            </div>
                                                                            <div
                                                                                class="p-0 col-span-6">
                                                                                <p class="text-xs font-medium text-black">
                                                                                    {{ number_format($product->quantity) }}
                                                                                </p>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach

                    <div class="mt-4 space-y-4" dir="ltr">
                        @php
                            $products = $inquiry->products()->where('part_id','!=',0)->orderBy('sort','ASC')->get();
                        @endphp
                        @foreach($products as $product)
                            @php
                                $part = \App\Models\Part::find($product->part_id);
                            @endphp
                            @if(!is_null($part->name_title))
                                <div class="rounded-xl mx-4 border border-myBlue-100" style="page-break-before: always">
                                    <div class="p-4">
                                        <div class="break-inside-avoid whitespace-nowrap flex items-center">
                                            <div class="flex items-center space-x-2">
                                                <p class="text-xs font-bold text-black">
                                                    {{ $part->name_title ?? 'ندارد' }}
                                                    :
                                                </p>
                                                <p class="text-xs font-bold text-black">
                                                    {{ number_format($product->quantity) }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
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

