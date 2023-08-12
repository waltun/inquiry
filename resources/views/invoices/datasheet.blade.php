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
        <a href="{{ route('invoices.final.index') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    پیش فاکتور های نهایی
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
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg-active">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    دیتاشیت فنی پیش فاکتور {{ $invoice->inquiry->name }}
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
                    دیتاشیت فنی پیش فاکتور {{ $invoice->inquiry->name }}
                </p>
            </div>
        </div>
    </div>

    <!-- Content -->
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
                                <div class="mb-6">
                                    <div class="mb-2">
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
                                                        {{ $productAttribute->name }} :
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
                            $midCategoryIds->push($midCategory->id);
                        }
                        $uniqueMidCategoryIds = $midCategoryIds->unique()->toArray();
                        $midCategoryIds = $midCategoryIds->toArray();
                        $partIds = $partIds->toArray();
                    @endphp
                    @foreach($uniqueMidCategoryIds as $uniqueMidCategoryId)
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
                            <div>
                                <div class="bg-green-800 p-2">
                                    <p class="text-lg font-bold text-center text-white">
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
                                                $coilInput = \App\Models\CoilInput::where('part_id', 4961)->first();
                                            }
                                            $lastCategory = $part->categories->last();
                                            $attributes = $lastCategory->attributes()->orderBy('sort', 'ASC')->get();
                                            $amountValue = $amounts[$key];
                                        @endphp
                                        @if(!$attributes->isEmpty())
                                            <div class="mb-6">
                                                <div>
                                                    <p class="text-sm font-bold text-indigo-700 p-4">
                                                        {{ $lastCategory->name_en ?? $lastCategory->name }}
                                                    </p>
                                                </div>
                                                @if(!is_null($coilInput))
                                                    <div class="grid grid-cols-3">
                                                        <div class="p-2">
                                                            <p class="text-xs font-medium text-black">
                                                                Tube :
                                                            </p>
                                                        </div>
                                                        <div class="p-2">
                                                            <p class="text-xs text-black">
                                                                -
                                                            </p>
                                                        </div>
                                                        <div class="p-2">
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
                                                @else
                                                    <div class="grid grid-cols-3">
                                                        @foreach($attributes as $attribute)
                                                            <div class="p-2">
                                                                <p class="text-xs font-medium text-black">
                                                                    {{ $attribute->name }} :
                                                                </p>
                                                            </div>
                                                            <div class="p-2">
                                                                <p class="text-xs text-black">
                                                                    {{ $attribute->unit }}
                                                                </p>
                                                            </div>
                                                            <div class="p-2">
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
            </div>
        @endforeach

    </div>


</x-layout>
