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
            @foreach($product->amounts()->orderBy('sort', 'ASC')->get() as $amount)
                @php
                    $part = \App\Models\Part::find($amount->part_id);
                    $lastCategory = $part->categories->last();
                    $midCategory = $part->categories[1];
                    $attributes = $lastCategory->attributes()->orderBy('sort', 'ASC')->get();
                @endphp

                @if(!$attributes->isEmpty())
                    <div class="p-2 rounded-lg border-2 border-sky-200">
                        <div class="mb-2 border-b border-gray-200 pb-2 flex">
                            <p class="text-base font-bold text-white bg-myBlue-100 px-4 py-2">
                                {{ $midCategory->name_en }} / {{ $lastCategory->name_en }} :
                            </p>
                        </div>

                        <div class="grid grid-cols-3 gap-1">
                            @foreach($attributes as $attribute)
                                <div>
                                    <div class="grid grid-cols-12 gap-2">
                                        <div class="col-span-4 p-2">
                                            <p class="text-xs text-black font-bold">
                                                {{ $attribute->name }} :
                                            </p>
                                        </div>
                                        <div class="col-span-2 p-2">
                                            <p class="text-xs text-black">
                                                {{ $attribute->unit }}
                                            </p>
                                        </div>
                                        <div class="col-span-6 p-2">
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
                                    </div>
                                </div>
                            @endforeach
                            @if($lastCategory->show_count)
                                <div>
                                    <div class="grid grid-cols-12 gap-1">
                                        <div class="col-span-4 p-2">
                                            <p class="text-xs font-bold text-black">
                                                Number Of {{ $midCategory->name_en }}
                                            </p>
                                        </div>
                                        <div class="col-span-2 p-2">
                                            <p class="text-xs text-black">
                                                -
                                            </p>
                                        </div>
                                        <div class="col-span-6 p-2">
                                            <p class="text-xs text-black">
                                                {{ $amount->value }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

            @endforeach
        @endforeach
    </div>

</x-layout>
