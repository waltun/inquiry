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
                        استعلام های قیمت گذاری شده
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="my-4 md:flex justify-between items-center">
        <div class="mb-4 md:mb-0">
            <p class="text-lg text-black font-bold">
                لیست استعلام های قیمت گذاری شده
            </p>
        </div>

        <div class="flex items-center space-x-2 space-x-reverse overflow-x-auto whitespace-nowrap">
            <a href="{{ route('inquiries.create') }}" class="form-submit-btn text-xs">ایجاد استعلام جدید</a>
            <a href="{{ route('inquiries.index') }}" class="form-detail-btn text-xs">لیست استعلام ها</a>
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
                    <th scope="col" class="relative px-4 py-3 rounded-l-md">
                        <span class="sr-only">اقدامات</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($inquiries as $inquiry)
                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-gray-500 text-center">
                                {{ "INQ-" . $inquiry->inquiry_number }}
                            </p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-black text-center font-medium">{{ $inquiry->name }}</p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-black text-center">{{ $inquiry->manager }}</p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-black text-center">{{ $inquiry->marketer }}</p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap space-x-2 space-x-reverse">
                            @can('detail-inquiry')
                                <a href="{{ route('inquiries.show',$inquiry->id) }}" class="form-detail-btn text-xs">
                                    جزئیات
                                </a>
                            @endcan
                            <a href="{{ route('inquiries.products',$inquiry->id) }}"
                               class="form-submit-btn text-xs">
                                مشاهده قیمت محصولات
                            </a>
                            <form action="{{ route('inquiries.copy',$inquiry->id) }}" method="POST"
                                  class="inline">
                                @csrf
                                <button class="form-edit-btn text-xs"
                                        onclick="return confirm('استعلام کپی شود ؟')">
                                    کپی
                                </button>
                            </form>
                            <div x-data="{ open:false }" class="inline-flex">
                                <button class="form-cancel-btn text-xs" type="button" @click="open=!open">
                                    اصلاح
                                </button>
                                <div class="relative z-50" x-show="open" x-cloak>
                                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                                    <div class="fixed inset-0 overflow-y-auto">
                                        <div
                                            class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">
                                            <form method="POST"
                                                  action="{{ route('inquiries.correction',$inquiry->id) }}"
                                                  class="relative bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-lg sm:w-full">
                                                @csrf
                                                @method('PATCH')

                                                <div class="bg-white p-4">
                                                    <div class="mt-3 text-center sm:mt-0 sm:text-right">
                                                        <h3 class="text-lg font-medium text-gray-900 border-b border-gray-300 pb-3">
                                                            اصلاح استعلام
                                                        </h3>
                                                        <div class="mt-2">
                                                            <label for="inputText" class="text-sm mb-2 block">
                                                                علت اصلاح
                                                            </label>
                                                            <textarea name="message" id="inputText"
                                                                      class="input-text resize-none h-32"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="bg-gray-100 space-x-4 space-x-reverse px-4 py-2">
                                                    <button type="button" class="form-cancel-btn"
                                                            @click="open=!open">
                                                        انصراف
                                                    </button>
                                                    <button type="submit" class="form-submit-btn">
                                                        ثبت
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div x-data="{ open:false }" class="inline-flex">
                                <button class="form-cancel-btn text-xs bg-gray-600 hover:bg-gray-700" type="button"
                                        @click="open=!open">
                                    ارجاع
                                </button>
                                <div class="relative z-50" x-show="open" x-cloak>
                                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                                    <div class="fixed inset-0 overflow-y-auto">
                                        <div
                                            class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">
                                            <form method="POST"
                                                  action="{{ route('inquiries.referral',$inquiry->id) }}"
                                                  class="relative bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-lg sm:w-full">
                                                @csrf

                                                <div class="bg-white p-4">
                                                    <div class="mt-3 text-center sm:mt-0 sm:text-right">
                                                        <h3 class="text-lg font-medium text-gray-900 border-b border-gray-300 pb-3">
                                                            ارجاع استعلام
                                                        </h3>
                                                        <div class="mt-2">
                                                            <label for="inputUser" class="text-sm mb-2 block">
                                                                کاربر مورد نظر
                                                            </label>
                                                            <select name="user_id" id="inputUser" class="input-text">
                                                                @foreach(\App\Models\User::all() as $user)
                                                                    <option value="{{ $user->id }}">
                                                                        {{ $user->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="bg-gray-100 space-x-4 space-x-reverse px-4 py-2">
                                                    <button type="button" class="form-cancel-btn"
                                                            @click="open=!open">
                                                        انصراف
                                                    </button>
                                                    <button type="submit" class="form-submit-btn">
                                                        ثبت
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile List -->
        <div class="block md:hidden">
            @foreach($inquiries as $inquiry)
                <div class="bg-white rounded-md p-4 border border-gray-200 shadow-sm mb-4 relative">
                    <span
                        class="absolute right-2 top-2 p-2 w-6 h-6 rounded-full bg-indigo-300 text-black text-xs grid place-content-center font-bold">
                        {{ $loop->index+1 }}
                    </span>
                    <div class="space-y-4">
                        <p class="text-xs text-black text-center font-bold">
                            پروژه : {{ $inquiry->name }}
                        </p>
                        <p class="text-xs text-black text-center">
                            مسئول پروژه : {{ $inquiry->manager }}
                        </p>
                        <p class="text-xs text-black text-center">
                            بازاریاب : {{ $inquiry->marketer }}
                        </p>
                        <p class="text-xs text-gray-600 text-center font-medium">
                            شماره استعلام : {{ "INQ-" . $inquiry->inquiry_number }}
                        </p>
                        <div class="flex w-full justify-between">
                            @can('detail-inquiry')
                                <a href="{{ route('inquiries.show',$inquiry->id) }}" class="form-detail-btn text-xs">
                                    جزئیات
                                </a>
                            @endcan
                            <a href="{{ route('inquiries.products',$inquiry->id) }}"
                               class="form-submit-btn text-xs">
                                مشاهده قیمت محصولات
                            </a>
                            <form action="{{ route('inquiries.copy',$inquiry->id) }}" method="POST"
                                  class="inline">
                                @csrf
                                <button class="form-edit-btn text-xs"
                                        onclick="return confirm('استعلام کپی شود ؟')">
                                    کپی
                                </button>
                            </form>
                            <div x-data="{ open:false }" class="inline-flex">
                                <button class="form-cancel-btn text-xs" type="button" @click="open=!open">
                                    اصلاح
                                </button>
                                <div class="relative z-50" x-show="open" x-cloak>
                                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                                    <div class="fixed inset-0 overflow-y-auto">
                                        <div
                                            class="flex items-end items-center justify-center min-h-full p-4 text-center">
                                            <form method="POST"
                                                  action="{{ route('inquiries.correction',$inquiry->id) }}"
                                                  class="relative bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all my-8 md:max-w-lg w-full">
                                                @csrf
                                                @method('PATCH')

                                                <div class="bg-white p-4">
                                                    <div class="mt-3 text-center sm:mt-0 sm:text-right">
                                                        <h3 class="text-lg font-medium text-gray-900 border-b border-gray-300 pb-3">
                                                            اصلاح استعلام
                                                        </h3>
                                                        <div class="mt-2">
                                                            <label for="inputText" class="text-sm mb-2 block">
                                                                علت اصلاح
                                                            </label>
                                                            <textarea name="message" id="inputText"
                                                                      class="input-text resize-none h-32"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="bg-gray-100 space-x-4 space-x-reverse px-4 py-2">
                                                    <button type="button" class="form-cancel-btn"
                                                            @click="open=!open">
                                                        انصراف
                                                    </button>
                                                    <button type="submit" class="form-submit-btn">
                                                        ثبت
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
