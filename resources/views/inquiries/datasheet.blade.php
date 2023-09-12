<x-layout>
    <!-- Breadcrumb -->
    <div class="flex items-center space-x-2 space-x-reverse">
        <a href="{{ route('dashboard') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0l4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0l-5.571 3-5.571-3"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    داشبورد
                </p>
            </div>
        </a>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                 class="breadcrumb-svg-arrow">
                <path fill-rule="evenodd"
                      d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                      clip-rule="evenodd"/>
            </svg>
        </div>
        @if($inquiry->submit)
            <a href="{{ route('inquiries.submitted') }}" class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="breadcrumb-svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div class="mr-2">
                    <p class="breadcrumb-p">
                        استعلام های منتظر قیمت
                    </p>
                </div>
            </a>
        @else
            <a href="{{ route('inquiries.index') }}" class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="breadcrumb-svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div class="mr-2">
                    <p class="breadcrumb-p">
                        مدیریت استعلام ها
                    </p>
                </div>
            </a>
        @endif
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                 class="breadcrumb-svg-arrow">
                <path fill-rule="evenodd"
                      d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                      clip-rule="evenodd"/>
            </svg>
        </div>
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg-active">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    دیتاشیت فنی {{ $inquiry->name }}
                </p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="md:flex items-center justify-between mt-8 space-y-4 md:space-y-0">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-8 h-8 dark:text-white">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
            </svg>
            <div class="mr-2">
                <p class="font-bold text-2xl text-black dark:text-white">
                    دیتاشیت فنی {{ $inquiry->name }}
                </p>
            </div>
        </div>
        <a href="{{ route('inquiries.printDatasheet',$inquiry->id) }}" target="_blank"
           class="flex items-center text-sm font-bold text-indigo-500 underline underline-offset-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-6 h-6 ml-1">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z"/>
            </svg>
            برای پرینت دیتاشیت کلیک کنید
        </a>
    </div>

    <!-- Content -->
    <div class="mt-4 space-y-4" dir="ltr">
        @php
            $products = $inquiry->products()->where('group_id','!=',0)->where('model_id','!=',0)->orderBy('sort', 'ASC')->get();
        @endphp

        @foreach($products as $product)
            @php
                $childModell = \App\Models\Modell::find($product->model_id);
                $modell = $childModell->parent;
            @endphp
            <div class="border border-myRed-200 rounded-xl">
                <div class="bg-myRed-200 p-4 rounded-t-lg">
                    <p class="text-center text-white font-extrabold text-xl">
                        Datasheet for : {{ $product->model_custom_name }}
                    </p>
                </div>

                <!-- Product attributes -->
                <div class="p-4">
                    @if(!$modell->attributes->isEmpty())
                        <div class="bg-green-800 p-2 mt-6">
                            <p class="text-lg font-bold text-center text-white">
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
                        <div class="bg-white p-4">
                            @foreach($uniqueAttributeGroupIds as $uniqueAttributeGroupId)
                                @php
                                    $keys = array_keys($attributeGroupIds, $uniqueAttributeGroupId);
                                    $productsAttribute = $modell->attributes[$keys[0]];
                                    $modelAttribute = \App\Models\AttributeGroup::find($productsAttribute->pivot->attribute_group_id);
                                @endphp
                                <div class="mb-2">
                                    <div class="mb-2 pt-2 {{ !$loop->first ? 'border-t border-gray-200' : '' }}">
                                        <p class="text-sm font-bold text-indigo-700">
                                            {{ $modelAttribute->name }}
                                        </p>
                                    </div>
                                    <div class="grid grid-cols-3 gap-4">
                                        @foreach($keys as $key)
                                            @php
                                                $productAttribute = $modell->attributes[$key];
                                            @endphp
                                            <div class="grid grid-cols-12 gap-1">
                                                <div class="col-span-5">
                                                    <p class="text-xs font-medium">
                                                        {{ $productAttribute->name }}
                                                        @if($productAttribute->unit != '-')
                                                            ({{ $productsAttribute->unit }})
                                                        @endif
                                                        :
                                                    </p>
                                                </div>
                                                <div class="col-span-7">
                                                    <p class="text-xs text-black">
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
                <div class="p-4 grid grid-cols-2 gap-6">
                    @php
                        $midCategoryIds = collect([]);
                        $partIds = collect([]);
                        $amounts = collect([]);
                        foreach ($product->amounts()->orderBy('sort', 'ASC')->get() as $amount) {
                            $part = \App\Models\Part::find($amount->part_id);
                            $partIds->push($part->id);
                            $amounts->push($amount->value);
                            $midCategory = $part->categories[1];
                            $lastCategory = $part->categories->last();
                            if (!$lastCategory->attributes->isEmpty()) {
                                $midCategoryIds->push($midCategory->id);
                            }
                        }

                        $uniqueMidCategoryIds = $midCategoryIds->unique()->toArray();
                        $midCategoryIds = $midCategoryIds->toArray();
                        $partIds = $partIds->toArray();

                        $evenItems = collect([]);
                        $oddItems = collect([]);

                        $uniqueMidCategoryIds = array_values($uniqueMidCategoryIds);

                        foreach ($uniqueMidCategoryIds as $key => $uniqueMidCategoryId) {
                            if ($key % 2 == 0) {
                                $evenItems->push($uniqueMidCategoryId);
                            } else {
                                $oddItems->push($uniqueMidCategoryId);
                            }
                        }
                    @endphp
                    @foreach([$evenItems, $oddItems] as $uniqueMidCategoryIds2)
                        <div class="space-y-4">
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
                                    <div class="break-inside-avoid">
                                        <div class="bg-green-800 p-2">
                                            <p class="text-lg font-bold text-center text-white">
                                                {{ $midCategory->name_en ?? $midCategory->name }}
                                            </p>
                                        </div>
                                        <div class="bg-white">
                                            @php
                                                $coilInput = null;
                                                $convertorInput = null;
                                            @endphp
                                            @foreach($keys as $key)
                                                @php
                                                    $part = \App\Models\Part::find($partIds[$key]);
                                                    if ($part->coil) {
                                                        $coilInput = \App\Models\CoilInput::where('part_id', $part->id)->where('inquiry_id', $inquiry->id)->first();
                                                        $convertorInput = \App\Models\ConvertorInput::where('part_id', $part->id)->where('inquiry_id', $inquiry->id)->first();
                                                    }
                                                    $lastCategory = $part->categories->last();
                                                    $attributes = $lastCategory->attributes()->orderBy('sort', 'ASC')->get();
                                                    $amountValue = $amounts[$key];
                                                @endphp
                                                @if(!$attributes->isEmpty())
                                                    <div class="mb-4">
                                                        <div>
                                                            <p class="text-sm font-bold text-indigo-700 p-4">
                                                                {{ $lastCategory->name_en ?? $lastCategory->name }}
                                                            </p>
                                                        </div>
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
                                                                            Face Area :
                                                                        </p>
                                                                    </div>
                                                                    <div class="p-2">
                                                                        <p class="text-xs text-black">
                                                                            -
                                                                        </p>
                                                                    </div>
                                                                    <div class="p-2">
                                                                        <p class="text-xs text-black">
                                                                            {{ $coilInput->sathe_coil }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @elseif(!is_null($convertorInput))
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
                                                                        {{ $convertorInput->loole_messi }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="grid grid-cols-3">
                                                                <div class="p-2">
                                                                    <p class="text-xs font-medium text-black">
                                                                        Shell Size :
                                                                    </p>
                                                                </div>
                                                                <div class="p-2">
                                                                    <p class="text-xs text-black">
                                                                        -
                                                                    </p>
                                                                </div>
                                                                <div class="p-2">
                                                                    <p class="text-xs text-black">
                                                                        {{ $convertorInput->size_loole_pooste }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="grid grid-cols-3">
                                                                <div class="p-2">
                                                                    <p class="text-xs font-medium text-black">
                                                                        Insolation :
                                                                    </p>
                                                                </div>
                                                                <div class="p-2">
                                                                    <p class="text-xs text-black">
                                                                        -
                                                                    </p>
                                                                </div>
                                                                <div class="p-2">
                                                                    <p class="text-xs text-black">
                                                                        {{ $convertorInput->ayegh }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="grid grid-cols-3">
                                                                <div class="p-2">
                                                                    <p class="text-xs font-medium text-black">
                                                                        Inlet & Outlet Connection :
                                                                    </p>
                                                                </div>
                                                                <div class="p-2">
                                                                    <p class="text-xs text-black">
                                                                        -
                                                                    </p>
                                                                </div>
                                                                <div class="p-2">
                                                                    <p class="text-xs text-black">
                                                                        {{ $convertorInput->flanch }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="grid grid-cols-3">
                                                                <div class="p-2">
                                                                    <p class="text-xs font-medium text-black">
                                                                        Number of Curcuits :
                                                                    </p>
                                                                </div>
                                                                <div class="p-2">
                                                                    <p class="text-xs text-black">
                                                                        No.
                                                                    </p>
                                                                </div>
                                                                <div class="p-2">
                                                                    <p class="text-xs text-black">
                                                                        {{ $convertorInput->tedad_madar }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="grid grid-cols-3">
                                                                <div class="p-2">
                                                                    <p class="text-xs font-medium text-black">
                                                                        Bafel :
                                                                    </p>
                                                                </div>
                                                                <div class="p-2">
                                                                    <p class="text-xs text-black">
                                                                        -
                                                                    </p>
                                                                </div>
                                                                <div class="p-2">
                                                                    <p class="text-xs text-black">
                                                                        {{ $convertorInput->noe_bafel }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="grid grid-cols-3">
                                                                <div class="p-2">
                                                                    <p class="text-xs font-medium text-black">
                                                                        Shell Length :
                                                                    </p>
                                                                </div>
                                                                <div class="p-2">
                                                                    <p class="text-xs text-black">
                                                                        -
                                                                    </p>
                                                                </div>
                                                                <div class="p-2">
                                                                    <p class="text-xs text-black">
                                                                        {{ $convertorInput->toole_loole_pooste }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="grid grid-cols-3">
                                                                <div class="p-2">
                                                                    <p class="text-xs font-medium text-black">
                                                                        Number of Bafel :
                                                                    </p>
                                                                </div>
                                                                <div class="p-2">
                                                                    <p class="text-xs text-black">
                                                                        No.
                                                                    </p>
                                                                </div>
                                                                <div class="p-2">
                                                                    <p class="text-xs text-black">
                                                                        {{ $convertorInput->tedad_bafel }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="grid grid-cols-3">
                                                                <div class="p-2">
                                                                    <p class="text-xs font-medium text-black">
                                                                        Actual Cooling Load :
                                                                    </p>
                                                                </div>
                                                                <div class="p-2">
                                                                    <p class="text-xs text-black">
                                                                        -
                                                                    </p>
                                                                </div>
                                                                <div class="p-2">
                                                                    <p class="text-xs text-black">
                                                                        {{ $convertorInput->tonaj }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="grid grid-cols-3">
                                                                <div class="p-2">
                                                                    <p class="text-xs font-medium text-black">
                                                                        Refrigerant :
                                                                    </p>
                                                                </div>
                                                                <div class="p-2">
                                                                    <p class="text-xs text-black">
                                                                        -
                                                                    </p>
                                                                </div>
                                                                <div class="p-2">
                                                                    <p class="text-xs text-black">
                                                                        {{ $convertorInput->gaz }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="grid grid-cols-3">
                                                                @foreach($attributes as $attribute)
                                                                    <div class="p-1">
                                                                        <p class="text-xs font-medium text-black">
                                                                            {{ $attribute->name }} :
                                                                        </p>
                                                                    </div>
                                                                    <div class="p-1">
                                                                        <p class="text-xs text-black">
                                                                            {{ $attribute->unit }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="p-1">
                                                                        <p class="text-xs text-black">
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


</x-layout>
