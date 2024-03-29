<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script>
            function deletePartFromGroup(group, part) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'DELETE',
                    url: '/groups/' + group + '/' + part + '/' + 'destroy-part',
                    success: function () {
                        location.reload();
                    }
                });
            }
        </script>
    </x-slot>
    <!-- Breadcrumb -->
    <nav class="flex bg-gray-100 p-4 rounded-md overflow-x-auto whitespace-nowrap" aria-label="Breadcrumb">
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
                    <a href="{{ route('groups.index') }}"
                       class="mr-2 text-xs md:text-sm font-medium text-gray-500 hover:text-gray-900">
                        مدیریت گروه ها
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
                        لیست قطعات گروه {{ $group->name }}
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Navigation Btn -->
    <div class="mt-4 md:flex justify-between items-center md:space-x-4 space-x-reverse">
        <div class="mb-4 md:mb-0">
            <p class="text-lg font-bold text-black">
                لیست قطعات گروه <span class="text-red-600">{{ $group->name }}</span>
            </p>
        </div>
        <div class="space-x-2 space-x-reverse">
            <a href="{{ route('groups.index') }}" class="form-detail-btn text-xs">لیست گروه ها</a>
            <a href="{{ route('group.parts.index',$group->id) }}" class="form-submit-btn text-xs">
                افزودن قطعه
            </a>
        </div>
    </div>

    <!-- Content -->
    <div class="mt-4">
        <!-- Laptop List -->
        <form action="{{ route('group.partValues',$group->id) }}" method="POST"
              class="hidden md:block">
            @csrf
            <div class="bg-white shadow overflow-x-auto rounded-lg ">
                <table class="min-w-full">
                    <thead>
                    <tr class="bg-sky-200">
                        <th scope="col"
                            class="px-4 py-3 text-sm font-bold text-gray-800 text-center rounded-r-md">
                            #
                        </th>
                        <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                            نام
                        </th>
                        <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                            مقدار
                        </th>
                        <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                            واحد
                        </th>
                        <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                            قیمت
                        </th>
                        <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                            کد
                        </th>
                        <th scope="col" class="relative px-4 py-3 rounded-l-md">
                            <span class="sr-only">اقدامات</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($group->parts as $part)
                        <tr>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <p class="text-sm text-gray-500 text-center">{{ $loop->index + 1 }}</p>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <p class="text-sm text-black text-center font-medium">{{ $part->name }}</p>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <input type="text" class="input-text" name="values[]" id="partValue{{ $part->id }}"
                                       value="{{ $part->pivot->value }}">
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <p class="text-sm text-black text-center">{{ $part->unit }}</p>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                @if($part->price)
                                    <p class="text-sm text-black text-center font-medium">
                                        {{ number_format($part->price) }} تومان
                                    </p>
                                @else
                                    <p class="text-sm text-red-600 text-center font-medium">
                                        منتظر قیمت گذاری
                                    </p>
                                @endif
                            </td>
                            @php
                                $code = '';
                                foreach($part->categories as $category){
                                    $code = $code . $category->code;
                                }
                            @endphp
                            <td class="px-4 py-3 whitespace-nowrap">
                                <p class="text-sm text-black text-center">{{ $code . "-" . $part->code }}</p>
                            </td>
                            <td class="px-4 py-3 space-x-3 space-x-reverse">
                                <button type="button" class="form-cancel-btn text-xs"
                                        onclick="deletePartFromGroup({{ $group->id }},{{ $part->id }})">
                                    حذف از گروه {{ $group->name }}
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="my-4">
                <button type="submit" class="form-submit-btn">
                    ثبت مقادیر
                </button>
            </div>
        </form>

        <!-- Mobile List -->
        <form action="{{ route('group.partValues',$group->id) }}" method="POST"
              class="block md:hidden">
            @csrf
            <div>
                @foreach($group->parts as $part)
                    <div class="bg-white rounded-md p-4 border border-gray-200 shadow-md mb-4 relative z-30">
                        <span
                            class="absolute right-2 top-2 p-2 w-6 h-6 rounded-full bg-indigo-300 text-black text-xs grid place-content-center font-bold">
                            {{ $loop->index+1 }}
                        </span>
                        <div class="space-y-4">
                            <p class="text-xs text-black text-center font-bold">
                                {{ $part->name }}
                            </p>
                            <p class="text-xs text-black text-center">
                                واحد : {{ $part->unit }}
                            </p>
                            @if($part->price)
                                <p class="text-xs text-black text-center font-medium">
                                    قیمت : {{ number_format($part->price) }} تومان
                                </p>
                            @else
                                <p class="text-xs text-red-600 text-center font-medium">
                                    منتظر قیمت گذاری
                                </p>
                            @endif
                            @php
                                $code = '';
                                foreach($part->categories as $category){
                                    $code = $code . $category->code;
                                }
                            @endphp
                            <p class="text-xs text-black text-center">
                                کد : {{ $part->code . "-" . $code }}
                            </p>
                            <input type="text" class="input-text" name="values[]" id="partValue{{ $part->id }}"
                                   value="{{ $part->pivot->value }}">
                            <div class="flex w-full justify-center">
                                <button type="button" class="form-cancel-btn text-xs"
                                        onclick="deletePartFromGroup({{ $group->id }},{{ $part->id }})">
                                    حذف از گروه {{ $group->name }}
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="my-4">
                <button type="submit" class="form-submit-btn">
                    ثبت مقادیر
                </button>
            </div>

        </form>
    </div>
</x-layout>
