<x-layout>
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
                        استعلام های موقتی
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Navigation Btn -->
    <div class="mt-4 md:flex justify-between items-center">
        <div class="mb-4 md:mb-0">
            <p class="text-lg text-black font-bold">
                لیست استعلام های موقتی
            </p>
        </div>
        <div class="space-x-2 space-x-reverse flex items-center overflow-x-auto whitespace-nowrap">
            <a href="{{ route('inquiries.index') }}" class="form-submit-btn text-xs">لیست استعلام ها</a>
            <a href="{{ route('inquiries.priced') }}" class="form-detail-btn text-xs">استعلام های قیمت گذاری شده</a>
            <a href="{{ route('inquiries.submitted') }}" class="form-edit-btn text-xs">استعلام های منتظر قیمت</a>
        </div>
    </div>

    <!-- Content -->
    <div class="mt-4">
        <!-- Laptop List -->
        <div class="bg-white shadow overflow-x-auto rounded-lg hidden md:block">
            <table class="min-w-full">
                <thead>
                <tr class="bg-sky-200">
                    <th scope="col"
                        class="px-4 py-3 text-sm font-bold text-gray-800 text-center rounded-r-md">
                        شماره استعلام
                    </th>
                    <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                        نام پروژه
                    </th>
                    <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                        مسئول پروژه
                    </th>
                    <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                        بازاریاب
                    </th>
                    <th scope="col" class="relative px-4 py-3">
                        <span class="sr-only">محصولات</span>
                    </th>
                    <th scope="col" class="relative px-4 py-3">
                        <span class="sr-only">اقدامات</span>
                    </th>
                    <th scope="col" class="relative px-4 py-3 rounded-l-md">
                        <span class="sr-only">ثبت نهایی</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($inquiries as $inquiry)
                    @php
                        $color = '';
                        $twoDays = \Carbon\Carbon::now()->subDays(2);
                        $oneDay = \Carbon\Carbon::now()->subDay();
                        if ($inquiry->created_at < $twoDays) {
                            $color = 'text-red-500';
                        }
                        if ($inquiry->created_at > $twoDays && $inquiry->created_at < $oneDay) {
                            $color = 'text-yellow-500';
                        }
                    @endphp
                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-gray-500 text-center {{ $color ?? 'text-gray-500' }}">
                                {{ "INQ-" . $inquiry->inquiry_number }}
                            </p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-black text-center font-medium">
                                {{ $inquiry->name }}
                            </p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-black text-center">{{ $inquiry->manager }}</p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-black text-center">{{ $inquiry->marketer }}</p>
                        </td>
                        <td class="px-4 py-3 space-x-3 space-x-reverse whitespace-nowrap">
                            @if($inquiry->type == 'product' || $inquiry->type == 'both')
                                @can('create-inquiry')
                                    <a href="{{ route('inquiries.product.index',$inquiry->id) }}"
                                       class="form-detail-btn text-xs">
                                        محصولات
                                    </a>
                                @endcan
                            @endif
                            @if($inquiry->type == 'part' || $inquiry->type == 'both')
                                @can('create-inquiry')
                                    <a href="{{ route('inquiries.parts.index',$inquiry->id) }}"
                                       class="form-submit-btn text-xs">
                                        قطعات تکی
                                    </a>
                                @endcan
                            @endif
                            @can('create-inquiry')
                                <a href="{{ route('inquiries.description',$inquiry->id) }}"
                                   class="form-submit-btn text-xs bg-gray-500 hover:bg-gray-600">
                                    شرایط استعلام
                                </a>
                            @endcan
                        </td>
                        <td class="px-4 py-3 space-x-3 space-x-reverse whitespace-nowrap">
                            @can('create-inquiry')
                                <a href="{{ route('inquiries.edit',$inquiry->id) }}" class="form-edit-btn text-xs">
                                    ویرایش اطلاعات پروژه
                                </a>
                            @endcan
                            @can('delete-inquiry')
                                <form action="{{ route('inquiries.destroy',$inquiry->id) }}" method="POST"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="form-cancel-btn text-xs"
                                            onclick="return confirm('استعلام حذف شود ؟')">
                                        حذف
                                    </button>
                                </form>
                            @endcan
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            @can('create-inquiry')
                                <form action="{{ route('inquiries.submit',$inquiry->id) }}" method="POST"
                                      class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button class="form-submit-btn text-xs"
                                            onclick="return confirm('استعلام ثبت نهایی شود ؟')">
                                        ثبت نهایی
                                    </button>
                                </form>
                            @endcan
                            @if($inquiry->message)
                                <div class="inline-flex" x-data="{open:false}">
                                    <button type="button" class="text-sm font-bold text-indigo-500 underline mr-2"
                                            @click="open=!open">
                                        مشاهده اصلاحیه
                                    </button>
                                    <div class="relative z-10" x-show="open" x-cloak>
                                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                                        <div class="fixed z-10 inset-0 overflow-y-auto">
                                            <div
                                                class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">
                                                <div
                                                    class="relative bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-lg sm:w-full">
                                                    <div class="bg-white p-4">
                                                        <div class="mt-3 text-center sm:mt-0 sm:text-right">
                                                            <h3 class="text-lg font-medium text-gray-900 border-b border-gray-300 pb-3">
                                                                اصلاح استعلام
                                                            </h3>
                                                            <div class="mt-2">
                                                                <div
                                                                    class="border border-gray-300 rounded-md p-4 shadow">
                                                                    <p class="text-sm leading-6 font-bold text-gray-800">
                                                                        {{ $inquiry->message }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bg-gray-100 px-4 py-2">
                                                        <button type="button" class="form-cancel-btn"
                                                                @click="open=!open">
                                                            خب!
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
