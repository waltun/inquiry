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
    <div class="mt-4 flex md:justify-end justify-center space-x-4 space-x-reverse">
        <a href="{{ route('inquiries.product.index',$inquiry->id) }}" class="form-detail-btn text-xs">
            لیست محصولات استعلام
        </a>
    </div>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <!-- Content -->
    <form method="POST" action="{{ route('inquiries.product.storeAmounts',$product->id) }}" class="mt-4">
        @csrf

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
                @if(!$amounts->isEmpty())
                    @foreach($amounts as $amount)
                        @php
                            $part = \App\Models\Part::find($amount->part_id);
                        @endphp
                        <tr>
                            <td class="border border-gray-300 p-4 text-sm text-center">
                                {{ $part->code }}
                            </td>
                            <td class="border border-gray-300 p-4 text-sm text-center flex items-center">
                                @if($part->name == "کویل DX")
                                    <a href="{{ route('calculate.index',$part->id) }}" class="form-submit-btn">
                                        محاسبه {{ $part->name }}
                                    </a>
                                @else
                                    <select name="part_ids[]" id="" class="input-text">
                                        @foreach(\App\Models\Part::all() as $part2)
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
                                            @if($part->code == 100 || $part->code == 101 || $part->code == 102 || $part->code == 103)
                                                <a href="{{ route('calculate.coil.index',$part->id) }}"
                                                   class="form-submit-btn">
                                                    محاسبه {{ $part->name }}
                                                </a>
                                            @endif
                                            @if($part->code == 120135)
                                                <a href="{{ route('calculate.damper.index',$part->id) }}"
                                                   class="form-submit-btn">
                                                    محاسبه {{ $part->name }}
                                                </a>
                                            @endif
                                            @if($part->code == 120120)
                                                <a href="{{ route('calculate.damper.index',$part->id) }}"
                                                   class="form-submit-btn">
                                                    محاسبه {{ $part->name }}
                                                </a>
                                            @endif
                                            @if($part->code == 130140)
                                                <a href="{{ route('calculate.damper.index',$part->id) }}"
                                                   class="form-submit-btn">
                                                    محاسبه {{ $part->name }}
                                                </a>
                                            @endif
                                            @if($part->code == 160160)
                                                <a href="{{ route('calculate.damper.index',$part->id) }}"
                                                   class="form-submit-btn">
                                                    محاسبه {{ $part->name }}
                                                </a>
                                            @endif
                                        </div>
                                    @endif
                                @endif

                            </td>
                            <td class="border border-gray-300 p-4 text-sm text-center">
                                {{ $part->unit }}
                            </td>
                            <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                                <input type="text" name="groupAmounts[]" id="inputAmount{{ $part->id }}"
                                       class="input-text"
                                       value="{{ $amount ? $amount->value : $part->pivot->value }}">
                            </td>
                        </tr>
                    @endforeach
                @else
                    @foreach($group->parts as $part)
                        @php
                            $amount = \App\Models\Amount::where('product_id',$product->id)->where('part_id',$part->id)->first();
                        @endphp
                        <tr>
                            <td class="border border-gray-300 p-4 text-sm text-center">
                                {{ $part->code }}
                            </td>
                            <td class="border border-gray-300 p-4 text-sm text-center flex items-center">
                                <select name="part_ids[]" id="" class="input-text">
                                    @foreach(\App\Models\Part::all() as $part2)
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
                                        @if($part->code == 100 || $part->code == 101 || $part->code == 102 || $part->code == 103)
                                            <a href="{{ route('calculate.coil.index',$part->id) }}"
                                               class="form-submit-btn">
                                                محاسبه {{ $part->name }}
                                            </a>
                                        @endif

                                        @if($part->code == 120135)
                                            <a href="{{ route('calculate.damperTaze.index',$part->id) }}"
                                               class="form-submit-btn">
                                                محاسبه {{ $part->name }}
                                            </a>
                                        @endif
                                        @if($part->code == 120120)
                                            <a href="{{ route('calculate.damperRaft.index',$part->id) }}"
                                               class="form-submit-btn">
                                                محاسبه {{ $part->name }}
                                            </a>
                                        @endif
                                        @if($part->code == 130140)
                                            <a href="{{ route('calculate.damperBargasht.index',$part->id) }}"
                                               class="form-submit-btn">
                                                محاسبه {{ $part->name }}
                                            </a>
                                        @endif
                                        @if($part->code == 160160)
                                            <a href="{{ route('calculate.damperExast.index',$part->id) }}"
                                               class="form-submit-btn">
                                                محاسبه {{ $part->name }}
                                            </a>
                                        @endif
                                    </div>
                                @endif
                            </td>
                            <td class="border border-gray-300 p-4 text-sm text-center">
                                {{ $part->unit }}
                            </td>
                            <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                                <input type="text" name="groupAmounts[]" id="inputAmount{{ $part->id }}"
                                       class="input-text"
                                       value="{{ $amount ? $amount->value : $part->pivot->value }}">
                            </td>
                        </tr>
                    @endforeach
                @endif
                @foreach($modell->parts as $index => $part)
                    @php
                        $amount = \App\Models\Amount::where('part_id', $part->id)->where('product_id', $product->id)->first();
                    @endphp
                    <tr>
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            {{ $part->code }}
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            {{ $part->name }}
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            {{ $part->unit }}
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                            <input type="text" name="modellAmounts[]" id="inputAmount{{ $part->id }}"
                                   class="input-text" value="{{ $part->pivot->value }}">
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
</x-layout>
