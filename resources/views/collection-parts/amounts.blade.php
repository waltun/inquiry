<x-layout>
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
                    <a href="{{ route('collections.index') }}"
                       class="mr-2 text-xs md:text-sm font-medium text-gray-500 hover:text-gray-900">
                        مدیریت مجموعه ها
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
                        تعیین مقادیر مجموعه {{ $parentPart->name }}
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Navigation Btn -->
    <div class="mt-4 flex md:justify-end justify-center space-x-4 space-x-reverse">
        <a href="{{ route('collections.index') }}" class="form-detail-btn text-xs">لیست مجموعه ها</a>
    </div>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <!-- Content -->
    <form method="POST" action="{{ route('collections.storeAmounts',$parentPart->id) }}" class="mt-4">
        @csrf
        @method('PATCH')

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
                @foreach($parentPart->children as $childPart)
                    <tr>
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            {{ $childPart->code }}
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            {{ $childPart->name }}
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            {{ $childPart->unit }}
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                            <input type="text" name="values[]" id="inputValue{{ $childPart->id }}" class="input-text"
                                   value="{{ $childPart->pivot->value ?? '' }}">
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
            <a href="{{ route('collections.index') }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>
