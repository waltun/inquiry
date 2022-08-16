<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
        <script>
            $(".inputAmount").select2({
                tags: true
            });
        </script>
    </x-slot>
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
    </x-slot>
    <!-- Breadcrumb -->
    <nav class="flex bg-gray-100 p-4 rounded-md" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-2 space-x-reverse">
            <li class="inline-flex items-center">
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center text-xs md:text-sm text-gray-500 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20"
                         fill="currentColor">
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                    داشبورد
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                              clip-rule="evenodd"/>
                    </svg>
                    <a href="{{ route('inquiries.index') }}"
                       class="mr-2 text-xs md:text-sm font-medium text-gray-500 hover:text-gray-900">
                        مدیریت استعلام ها
                    </a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                              clip-rule="evenodd"/>
                    </svg>
                    <span class="mr-2 text-xs md:text-sm font-medium text-gray-400">
                        تعیین مقادیر محصول {{ $product->name }}
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Navigation Btn -->
    <div class="mt-4 md:flex justify-between">
        <div class="mb-4 md:mb-0">
            <p class="text-lg font-bold">
                جزئیات محصول <span class="text-red-600">{{ $group->name }} - {{ $modell->name }}</span>
            </p>
        </div>
        <div class="flex md:justify-end space-x-2 space-x-reverse">
            <a href="{{ route('inquiries.product.index',$inquiry->id) }}" class="form-detail-btn text-xs">
                لیست محصولات استعلام
            </a>
        </div>
    </div>

    <!-- Errors -->
    <div class="my-4">
        <x-errors/>
    </div>

    <!-- Info -->
    <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4">
        <div class="md:flex justify-around items-center space-y-4 md:space-y-0">
            <p class="font-bold text-red-600 md:text-lg text-sm text-center">
                گروه : {{ $group->name }} با کد {{ $group->code }}
            </p>
            <p class="font-bold text-red-600 md:text-lg text-sm text-center">
                مدل : {{ $modell->name }} با کد {{ $modell->code }}
            </p>
        </div>
    </div>

    <!-- Laptop List -->
    <form method="POST" action="{{ route('inquiries.product.storeAmounts',$product->id) }}"
          class="mt-4 md:block hidden">
        @csrf
        <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4">
            <table class="border-collapse border border-gray-400 w-full">
                <thead>
                <tr>
                    <th class="border border-gray-300 p-4 text-sm">کد قطعه</th>
                    <th class="border border-gray-300 p-4 text-sm">نام قطعه</th>
                    <th class="border border-gray-300 p-4 text-sm">واحد قطعه</th>
                    <th class="border border-gray-300 p-4 text-sm">مقادیر</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $amounts = \App\Models\Amount::where('product_id', $product->id)->get();
                    $specials = \App\Models\Special::all()->pluck('part_id')->toArray();
                @endphp
                @foreach($group->parts as $part)
                    @php
                        $amount = \App\Models\Amount::where('product_id',$product->id)->where('part_id',$part->id)->first();
                        $code = '';
                        foreach($part->categories as $category) {
                            $code = $code . $category->code;
                        }
                    @endphp
                    <tr>
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            {{ $code . "-" . $part->code }}
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center flex items-center">
                            @if($amount)
                                @php
                                    $selectedPart = \App\Models\Part::find($amount->part_id);
                                    $lastCategory = $selectedPart->categories()->latest()->first();
                                    $categoryParts = $lastCategory->parts;
                                @endphp
                            @else
                                @php
                                    $selectedPart = \App\Models\Part::find($part->id);
                                    $lastCategory = $selectedPart->categories()->latest()->first();
                                    $categoryParts = $lastCategory->parts;
                                @endphp
                            @endif
                            <select name="part_ids[]" id="" class="input-text">
                                @foreach($categoryParts as $part2)
                                    @if($amount)
                                        <option
                                            value="{{ $part2->id }}" {{ $part2->id == $amount->part_id ? 'selected' : '' }}>
                                            {{ $part2->name }}
                                        </option>
                                    @else
                                        <option
                                            value="{{ $part2->id }}" {{ $part2->id == $part->id ? 'selected' : '' }}>
                                            {{ $part2->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @if(in_array($part->id,$specials))
                                <div class="whitespace-nowrap mr-2">
                                    @switch($part->code)
                                        @case(100)
                                            @if(session()->has('price'.$part->id))
                                                <a href="#" class="form-detail-btn">
                                                    محاسبه شد
                                                </a>
                                            @else
                                                <a href="{{ route('calculateCoil.evaperator.index',[$part->id,$product->id]) }}"
                                                   class="form-submit-btn">
                                                    محاسبه {{ $part->name }}
                                                </a>
                                            @endif
                                            @break
                                        @case(101)
                                            @if(session()->has('price'.$part->id))
                                                <a href="#" class="form-detail-btn">
                                                    محاسبه شد
                                                </a>
                                            @else
                                                <a href="{{ route('calculateCoil.condensor.index',[$part->id,$product->id]) }}"
                                                   class="form-submit-btn">
                                                    محاسبه {{ $part->name }}
                                                </a>
                                            @endif
                                            @break
                                        @case(102)
                                            @if(session()->has('price'.$part->id))
                                                <a href="#" class="form-detail-btn">
                                                    محاسبه شد
                                                </a>
                                            @else
                                                <a href="{{ route('calculateCoil.abi.index',[$part->id,$product->id]) }}"
                                                   class="form-submit-btn">
                                                    محاسبه {{ $part->name }}
                                                </a>
                                            @endif
                                            @break
                                        @case(103)
                                            @if(session()->has('price'.$part->id))
                                                <a href="#" class="form-detail-btn">
                                                    محاسبه شد
                                                </a>
                                            @else
                                                <a href="{{ route('calculateCoil.fancoil.index',[$part->id,$product->id]) }}"
                                                   class="form-submit-btn">
                                                    محاسبه {{ $part->name }}
                                                </a>
                                            @endif
                                            @break

                                        @case(120135)
                                            @if(session()->has('price'.$part->id))
                                                <a href="#" class="form-detail-btn">
                                                    محاسبه شد
                                                </a>
                                            @else
                                                <a href="{{ route('calculateDamper.taze.index',[$part->id,$product->id]) }}"
                                                   class="form-submit-btn">
                                                    محاسبه {{ $part->name }}
                                                </a>
                                            @endif
                                            @break
                                        @case(120120)
                                            @if(session()->has('price'.$part->id))
                                                <a href="#" class="form-detail-btn">
                                                    محاسبه شد
                                                </a>
                                            @else
                                                <a href="{{ route('calculateDamper.raft.index',[$part->id,$product->id]) }}"
                                                   class="form-submit-btn">
                                                    محاسبه {{ $part->name }}
                                                </a>
                                            @endif
                                            @break
                                        @case(130140)
                                            @if(session()->has('price'.$part->id))
                                                <a href="#" class="form-detail-btn">
                                                    محاسبه شد
                                                </a>
                                            @else
                                                <a href="{{ route('calculateDamper.bargasht.index',[$part->id,$product->id]) }}"
                                                   class="form-submit-btn">
                                                    محاسبه {{ $part->name }}
                                                </a>
                                            @endif
                                            @break
                                        @case(160160)
                                            @if(session()->has('price'.$part->id))
                                                <a href="#" class="form-detail-btn">
                                                    محاسبه شد
                                                </a>
                                            @else
                                                <a href="{{ route('calculateDamper.exast.index',[$part->id,$product->id]) }}"
                                                   class="form-submit-btn">
                                                    محاسبه {{ $part->name }}
                                                </a>
                                            @endif
                                            @break
                                    @endswitch
                                </div>
                            @endif
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            {{ $part->unit }}
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                            <input type="text" name="groupAmounts[]" id="inputAmount{{ $part->id }}"
                                   class="input-text" value="{{ $amount ? $amount->value : $part->pivot->value }}">
                        </td>
                    </tr>
                @endforeach

                @foreach($modell->parts as $index => $part)
                    @php
                        $amount = \App\Models\Amount::where('part_id', $part->id)->where('product_id', $product->id)->first();
                        $code = '';
                        foreach($part->categories as $category){
                            $code = $code . $category->code;
                        }
                    @endphp
                    <tr>
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            {{ $code . "-" . $part->code }}
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center flex items-center">
                            @if($amount)
                                @php
                                    $selectedPart = \App\Models\Part::find($amount->part_id);
                                    $lastCategory = $selectedPart->categories()->latest()->first();
                                    $categoryParts = $lastCategory->parts;
                                @endphp
                            @else
                                @php
                                    $selectedPart = \App\Models\Part::find($part->id);
                                    $lastCategory = $selectedPart->categories()->latest()->first();
                                    $categoryParts = $lastCategory->parts;
                                @endphp
                            @endif
                            <select name="part_ids[]" id="" class="input-text">
                                @foreach($categoryParts as $part2)
                                    @if($amount)
                                        <option
                                            value="{{ $part2->id }}" {{ $part2->id == $amount->part_id ? 'selected' : '' }}>
                                            {{ $part2->name }}
                                        </option>
                                    @else
                                        <option
                                            value="{{ $part2->id }}" {{ $part2->id == $part->id ? 'selected' : '' }}>
                                            {{ $part2->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @if(in_array($part->id,$specials))
                                <div class="whitespace-nowrap mr-2">
                                    @switch($part->code)
                                        @case(100)
                                            @if(session()->has('price'.$part->id))
                                                <a href="#" class="form-detail-btn">
                                                    محاسبه شد
                                                </a>
                                            @else
                                                <a href="{{ route('calculateCoil.evaperator.index',[$part->id,$product->id]) }}"
                                                   class="form-submit-btn">
                                                    محاسبه {{ $part->name }}
                                                </a>
                                            @endif
                                            @break
                                        @case(101)
                                            @if(session()->has('price'.$part->id))
                                                <a href="#" class="form-detail-btn">
                                                    محاسبه شد
                                                </a>
                                            @else
                                                <a href="{{ route('calculateCoil.condensor.index',[$part->id,$product->id]) }}"
                                                   class="form-submit-btn">
                                                    محاسبه {{ $part->name }}
                                                </a>
                                            @endif
                                            @break
                                        @case(102)
                                            @if(session()->has('price'.$part->id))
                                                <a href="#" class="form-detail-btn">
                                                    محاسبه شد
                                                </a>
                                            @else
                                                <a href="{{ route('calculateCoil.abi.index',[$part->id,$product->id]) }}"
                                                   class="form-submit-btn">
                                                    محاسبه {{ $part->name }}
                                                </a>
                                            @endif
                                            @break
                                        @case(103)
                                            @if(session()->has('price'.$part->id))
                                                <a href="#" class="form-detail-btn">
                                                    محاسبه شد
                                                </a>
                                            @else
                                                <a href="{{ route('calculateCoil.fancoil.index',[$part->id,$product->id]) }}"
                                                   class="form-submit-btn">
                                                    محاسبه {{ $part->name }}
                                                </a>
                                            @endif
                                            @break

                                        @case(120135)
                                            @if(session()->has('price'.$part->id))
                                                <a href="#" class="form-detail-btn">
                                                    محاسبه شد
                                                </a>
                                            @else
                                                <a href="{{ route('calculateDamper.taze.index',[$part->id,$product->id]) }}"
                                                   class="form-submit-btn">
                                                    محاسبه {{ $part->name }}
                                                </a>
                                            @endif
                                            @break
                                        @case(120120)
                                            @if(session()->has('price'.$part->id))
                                                <a href="#" class="form-detail-btn">
                                                    محاسبه شد
                                                </a>
                                            @else
                                                <a href="{{ route('calculateDamper.raft.index',[$part->id,$product->id]) }}"
                                                   class="form-submit-btn">
                                                    محاسبه {{ $part->name }}
                                                </a>
                                            @endif
                                            @break
                                        @case(130140)
                                            @if(session()->has('price'.$part->id))
                                                <a href="#" class="form-detail-btn">
                                                    محاسبه شد
                                                </a>
                                            @else
                                                <a href="{{ route('calculateDamper.bargasht.index',[$part->id,$product->id]) }}"
                                                   class="form-submit-btn">
                                                    محاسبه {{ $part->name }}
                                                </a>
                                            @endif
                                            @break
                                        @case(160160)
                                            @if(session()->has('price'.$part->id))
                                                <a href="#" class="form-detail-btn">
                                                    محاسبه شد
                                                </a>
                                            @else
                                                <a href="{{ route('calculateDamper.exast.index',[$part->id,$product->id]) }}"
                                                   class="form-submit-btn">
                                                    محاسبه {{ $part->name }}
                                                </a>
                                            @endif
                                            @break
                                    @endswitch
                                </div>
                            @endif
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            {{ $part->unit }}
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                            <input type="text" name="modellAmounts[]" id="inputAmount{{ $part->id }}"
                                   class="input-text" value="{{ $amount ? $amount->value : $part->pivot->value }}">
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="space-x-2 space-x-reverse">
            <button type="submit" class="form-submit-btn">
                ثبت مقادیر
            </button>
            <a href="{{ route('inquiries.index') }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>

    <!-- Mobile List -->
    <form method="POST" action="{{ route('inquiries.product.storeAmounts',$product->id) }}"
          class="mt-4 md:hidden block">
        @csrf

        @php
            $amounts = \App\Models\Amount::where('product_id', $product->id)->get();
            $specials = \App\Models\Special::all()->pluck('part_id')->toArray();
            $counter = 0;
        @endphp
        @foreach($group->parts as $part)
            @php
                $counter++;
                $amount = \App\Models\Amount::where('product_id',$product->id)->where('part_id',$part->id)->first();
                $code = '';
                foreach($part->categories as $category) {
                    $code = $code . $category->code;
                }
            @endphp

            <div class="bg-white rounded-md p-4 border border-gray-200 shadow-md mb-4 relative z-30">
                <span
                    class="absolute right-2 top-2 p-2 w-6 h-6 rounded-full bg-indigo-300 text-black text-xs grid place-content-center font-bold">
                    {{ $counter }}
                </span>
                <div class="space-y-4">
                    @if($amount)
                        @php
                            $selectedPart = \App\Models\Part::find($amount->part_id);
                            $lastCategory = $selectedPart->categories()->latest()->first();
                            $categoryParts = $lastCategory->parts;
                        @endphp
                    @else
                        @php
                            $selectedPart = \App\Models\Part::find($part->id);
                            $lastCategory = $selectedPart->categories()->latest()->first();
                            $categoryParts = $lastCategory->parts;
                        @endphp
                    @endif
                    <select name="part_ids[]" id="" class="input-text mt-6">
                        @foreach($categoryParts as $part2)
                            @if($amount)
                                <option
                                    value="{{ $part2->id }}" {{ $part2->id == $amount->part_id ? 'selected' : '' }}>
                                    {{ $part2->name }}
                                </option>
                            @else
                                <option
                                    value="{{ $part2->id }}" {{ $part2->id == $part->id ? 'selected' : '' }}>
                                    {{ $part2->name }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                    <p class="text-xs text-black text-center">
                        واحد : {{ $part->unit }}
                    </p>
                    @php
                        $code = '';
                        foreach($part->categories as $category){
                            $code = $code . $category->code;
                        }

                    @endphp
                    <p class="text-xs text-black text-center">
                        کد : {{ $part->code . "-" . $code }}
                    </p>
                    <div>
                        <input type="text" name="groupAmounts[]" id="inputAmount{{ $part->id }}"
                               class="input-text" value="{{ $amount ? $amount->value : $part->pivot->value }}">
                    </div>
                    <div class="flex w-full justify-between">

                    </div>
                </div>
            </div>

        @endforeach

        @foreach($modell->parts as $part)
            @php
                $counter++;
                $amount = \App\Models\Amount::where('part_id', $part->id)->where('product_id', $product->id)->first();
                $code = '';
                foreach($part->categories as $category){
                    $code = $code . $category->code;
                }
            @endphp

            <div class="bg-white rounded-md p-4 border border-gray-200 shadow-md mb-4 relative z-30">
                <span
                    class="absolute right-2 top-2 p-2 w-6 h-6 rounded-full bg-indigo-300 text-black text-xs grid place-content-center font-bold">
                    {{ $counter }}
                </span>
                <div class="space-y-4">
                    @if($amount)
                        @php
                            $selectedPart = \App\Models\Part::find($amount->part_id);
                            $lastCategory = $selectedPart->categories()->latest()->first();
                            $categoryParts = $lastCategory->parts;
                        @endphp
                    @else
                        @php
                            $selectedPart = \App\Models\Part::find($part->id);
                            $lastCategory = $selectedPart->categories()->latest()->first();
                            $categoryParts = $lastCategory->parts;
                        @endphp
                    @endif
                    <select name="part_ids[]" id="" class="input-text mt-6">
                        @foreach($categoryParts as $part2)
                            @if($amount)
                                <option
                                    value="{{ $part2->id }}" {{ $part2->id == $amount->part_id ? 'selected' : '' }}>
                                    {{ $part2->name }}
                                </option>
                            @else
                                <option
                                    value="{{ $part2->id }}" {{ $part2->id == $part->id ? 'selected' : '' }}>
                                    {{ $part2->name }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                    <p class="text-xs text-black text-center">
                        واحد : {{ $part->unit }}
                    </p>
                    @php
                        $code = '';
                        foreach($part->categories as $category){
                            $code = $code . $category->code;
                        }

                    @endphp
                    <p class="text-xs text-black text-center">
                        کد : {{ $part->code . "-" . $code }}
                    </p>
                    <div>
                        <input type="text" name="modellAmounts[]" id="inputAmount{{ $part->id }}"
                               class="input-text" value="{{ $amount ? $amount->value : $part->pivot->value }}">
                    </div>
                    <div class="flex w-full justify-between">

                    </div>
                </div>
            </div>

        @endforeach
        <div class="space-x-2 space-x-reverse">
            <button type="submit" class="form-submit-btn">
                ثبت مقادیر
            </button>
            <a href="{{ route('inquiries.index') }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>

</x-layout>
