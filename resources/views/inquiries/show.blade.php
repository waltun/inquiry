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
            <li aria-current="page">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                              clip-rule="evenodd"/>
                    </svg>
                    <span class="mr-2 text-xs md:text-sm font-medium text-gray-400">
                        مدیریت استعلام ها
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Navigation Btn -->
    <div class="mt-4 flex md:justify-end justify-center space-x-4 space-x-reverse">
        <a href="{{ route('inquiries.index') }}" class="form-detail-btn text-xs">لیست استعلام ها</a>
    </div>

    <!-- Content -->
    <div class="mt-4">
        <div class="bg-white shadow-md border border-gray-200 rounded-md py-4 px-6 mb-4">
            <div class="md:flex justify-between items-center space-y-4 md:space-y-0">
                <p class="font-bold text-black md:text-lg text-sm text-center">
                    نام پروژه : {{ $inquiry->name }}
                </p>
                <p class="font-bold text-black md:text-lg text-sm text-center">
                    مسئول پروژه : {{ $inquiry->manager }}
                </p>
                <p class="font-bold text-black md:text-lg text-sm text-center">
                    تاریخ : {{ jdate($inquiry->created_at)->format('%A, %d %B %Y') }}
                </p>
            </div>
        </div>

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
                    <th class="border border-gray-300 p-4 text-sm">قیمت واحد</th>
                    <th class="border border-gray-300 p-4 text-sm">مقادیر</th>
                    <th class="border border-gray-300 p-4 text-sm">جمع کل</th>
                </tr>
                </thead>
                <tbody>
                @foreach($group->parts as $part)
                    @php
                        $amount = $inquiry->amounts()->where('part_id',$part->id)->first();
                        if ($amount){
                            $totalPrice += ($part->price * $amount->value);
                        }
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
                            {{ number_format($part->price) }} تومان
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center">
                            {{ $amount->value }}
                        </td>
                        <td class="border border-gray-300 p-4 text-sm text-center font-bold">
                            {{ number_format($part->price * $amount->value) }} تومان
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td class="border border-gray-300 p-4 text-lg text-center font-bold" colspan="5">
                        قیمت کل
                    </td>
                    <td class="border border-gray-300 p-4 text-lg text-center font-bold text-green-600">
                        {{ number_format($totalPrice) }} تومان
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
