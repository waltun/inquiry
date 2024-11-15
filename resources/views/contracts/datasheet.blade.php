<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DTS-CNT-{{ $contract->number }}</title>

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
                                تاریخ : {{ jdate($contract->created_at)->format('Y/m/d') }}
                            </p>
                            <p class="text-xs font-bold text-black mr-8">
                                شماره :
                                DTS-CNT-{{ $contract->number }}
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
                                پونک، ضلع شمالی مجتمع تجاری بوستان، خیابان کربلایی احمد، نبش کوچه اول، پلاک 2، طبقه
                                چهار، واحد 8
                            </p>
                        </div>
                    </div>
                    <div class="absolute right-56 -top-4 p-2">

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
                @php
                    $products = $contract->products()->where('group_id','!=',0)->where('model_id','!=',0)->orderBy('sort','ASC')->get();
                @endphp
                <div class="relative">
                    <div class="mt-4 space-y-4" dir="ltr">
                        @foreach($products as $product)
                            @php
                                $childModell = \App\Models\Modell::find($product->model_id);
                                $modell = $childModell->parent;
                            @endphp
                            <div class="rounded-xl mx-4 border border-myBlue-100 mb-2 pb-2"
                                 style="{{ !$loop->last ? 'page-break-after: always' : '' }}">
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
                                                                                        <div
                                                                                            class="w-2 h-2 rounded-full border-2 border-black mb-1 mr-1"></div>
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

                    <div class="mt-4 space-y-4" dir="ltr">
                        @php
                            $products2 = $contract->products()->where('part_id','!=',0)->orderBy('sort','ASC')->get();
                        @endphp
                        @foreach($products2 as $product)
                            @php
                                $part = \App\Models\Part::find($product->part_id);
                                $midCategoryIds = collect([]);
                                $midCategory = $part->categories[1];
                                $lastCategory = $part->categories->last();
                                if (!$lastCategory->attributes->isEmpty()) {
                                    $midCategoryIds->push($midCategory->id);
                                }
                            @endphp
                            @if(!$part->children->isEmpty())
                                <div class="rounded-xl mx-4 border border-myBlue-100 mb-2 pb-2">
                                    <div class="bg-[#005a96] p-1.5 rounded-t-lg">
                                        <p class="text-center text-white font-extrabold text-base">
                                            Datasheet for : {{ $part->name }}
                                        </p>
                                    </div>

                                    <!-- Part Attributes -->
                                    <div class="px-4 mt-4">
                                        <div class="space-y-2">
                                            @php
                                                $categoryIds = [
                                                    496, 495, 494, 493, 492, 472, 471, 133, 132, 131, 130, 129, 128
                                                ];
                                                $lastCategoryId = $part->categories()->latest()->first()->id;
                                                $midCategory = $part->categories[1];
                                            @endphp
                                            @if(!$part->children->isEmpty() && $part->coil && in_array($lastCategoryId, $categoryIds))
                                                <div class="break-inside-avoid whitespace-nowrap">
                                                    <div class="border border-green-800">
                                                        <div class="bg-green-800 p-1.5 col-span-3 mb-2">
                                                            <p class="font-bold text-center text-white text-sm">
                                                                {{ $midCategory->name_en ?? $midCategory->name }}
                                                                {{ $lastCategory->name_en ? " - " . $lastCategory->name_en : '' }} - Quantity : {{ number_format($product->quantity) }}
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
                                                                    <div class="mx-2 mb-2">
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
                                        </div>
                                    </div>
                                </div>
                            @else
                                @if(!$lastCategory->attributes->isEmpty())
                                    <div class="rounded-xl mx-4 border border-myBlue-100 mb-2 pb-2">
                                        <div class="bg-[#005a96] p-1.5 rounded-t-lg">
                                            <p class="text-center text-white font-extrabold text-base">
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
                                                    $invoice = \App\Models\Invoice::find($contract->invoice_id);
                                                    $convertorInput = \App\Models\ConvertorInput::where('part_id', $part->id)->where('inquiry_id', $invoice->inquiry_id)->first();
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
                                                        @else
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

