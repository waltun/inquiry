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
                        استعلام های منتظر قیمت
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Search -->
    <div class="bg-white shadow p-4 rounded-md border border-gray-200 mt-4"
        {{ request()->query() ? 'x-data={open:true}' : 'x-data={open:false}' }}>
        <div class="flex items-center justify-between cursor-pointer" @click="open=!open"
             :class="{'border-b border-gray-300 pb-3' : open}">
            <p class="text-sm font-bold text-black">جستجو در استعلام ها</p>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-6 h-6 transition" :class="{'rotate-180' : open}">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
            </svg>
        </div>
        <form method="GET" action="" class="mt-4 grid grid-cols-4 gap-4" x-show="open" x-cloak>
            <div class="mb-4">
                <label for="inputInquiryNumber" class="block mb-2 text-sm font-bold">شماره استعلام</label>
                <input type="text" id="inputInquiryNumber" class="input-text" name="inquiry_number"
                       placeholder="جستجو براساس شماره استعلام (بدون INQ)" value="{{ request('inquiry_number') }}">
            </div>
            <div class="mb-4">
                <label for="inputName" class="block mb-2 text-sm font-bold">نام پروژه</label>
                <input type="text" id="inputName" class="input-text" name="name"
                       placeholder="جستجو براساس نام پروژه" value="{{ request('name') }}">
            </div>
            <div class="mb-4">
                <label for="inputManager" class="block mb-2 text-sm font-bold">مسئول پروژه</label>
                <input type="text" id="inputManager" class="input-text" name="manager"
                       placeholder="جستجو براساس مسئول پروژه" value="{{ request('manager') }}">
            </div>
            <div>
                <label for="inputMarketer" class="block mb-2 text-sm font-bold">بازاریاب</label>
                <input type="text" id="inputMarketer" class="input-text" name="marketer"
                       placeholder="جستجو براساس بازاریاب" value="{{ request('marketer') }}">
            </div>
            <div>
                <label for="inputGroup" class="block mb-2 text-sm font-bold">دسته</label>
                <select name="group_id" id="inputGroup" class="input-text">
                    <option value="">جستجو براساس دسته</option>
                    @foreach($groups as $group)
                        <option
                            value="{{ $group->id }}" {{ $group->id == request()->get('group_id') ? 'selected' : '' }}>
                            {{ $group->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="inputModell" class="block mb-2 text-sm font-bold">مدل</label>
                <select name="model_id" id="inputModell" class="input-text">
                    <option value="">جستجو براساس مدل</option>
                    @foreach($modells as $modell)
                        <option
                            value="{{ $modell->id }}" {{ $modell->id == request()->get('model_id') ? 'selected' : '' }}>
                            {{ $modell->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-4 flex justify-end space-x-2 space-x-reverse">
                <button class="form-submit-btn" type="submit">
                    جستجو
                </button>
                @if(request()->query())
                    <a href="{{ route('inquiries.submitted') }}" class="form-detail-btn">
                        پاکسازی
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Navigation Btn -->
    <div class="mt-4 md:flex justify-between items-center">
        <div class="mb-4 md:mb-0">
            <p class="text-lg text-black font-bold">
                لیست استعلام های منتظر قیمت
            </p>
        </div>
        <div class="space-x-2 space-x-reverse flex items-center overflow-x-auto whitespace-nowrap">
            <a href="{{ route('inquiries.index') }}" class="form-detail-btn text-xs">لیست استعلام ها</a>
            <a href="{{ route('inquiries.priced') }}" class="form-submit-btn text-xs">استعلام های قیمت گذاری شده</a>
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
                    <th scope="col" class="relative px-4 py-3 rounded-l-md">
                        <span class="sr-only">اقدامات</span>
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
                    <tr class="hover:bg-gray-100">
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-center {{ $color ?? 'text-gray-500' }}">
                                {{ "INQ-" . $inquiry->inquiry_number }}
                            </p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-black text-center font-medium">{{ $inquiry->name }}</p>
                        </td>
                        @php
                            $user = \App\Models\User::find($inquiry->user_id);
                        @endphp
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-black text-center">
                                {{ $user->name }}
                            </p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-black text-center">{{ $inquiry->marketer }}</p>
                        </td>
                        <td class="px-4 py-3 space-x-3 space-x-reverse whitespace-nowrap">
                            @if($inquiry->type == 'product' || $inquiry->type == 'both')
                                @can('create-inquiry')
                                    <a href="{{ route('inquiries.product.index',$inquiry->id) }}"
                                       class="form-submit-btn text-xs">
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
                            @can('detail-inquiry')
                                <a href="{{ route('inquiries.show',$inquiry->id) }}" class="form-detail-btn text-xs">
                                    جزئیات
                                </a>
                            @endcan
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
                                <div class="relative z-10" x-show="open" x-cloak>
                                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                                    <div class="fixed z-10 inset-0 overflow-y-auto">
                                        <div
                                            class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">
                                            <form method="POST"
                                                  action="{{ route('inquiries.submittedCorrection',$inquiry->id) }}"
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
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile List -->
        <div class="block md:hidden">
            @foreach($inquiries as $inquiry)
                <div class="bg-white rounded-md p-4 border border-gray-200 shadow-sm mb-4 relative z-30">
                    <span
                        class="absolute right-2 top-2 p-2 w-6 h-6 rounded-full bg-indigo-300 text-black text-xs grid place-content-center font-bold">
                        {{ $loop->index + 1 }}
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
                        <p class="text-xs text-gray-600 text-center">
                            شماره استعلام : {{ "INQ-" . $inquiry->inquiry_number }}
                        </p>
                        <div class="flex w-full justify-between">
                            @can('detail-inquiry')
                                <a href="{{ route('inquiries.show',$inquiry->id) }}" class="form-detail-btn text-xs">
                                    جزئیات
                                </a>
                            @endcan
                            @can('create-inquiry')
                                <a href="{{ route('inquiries.product.index',$inquiry->id) }}"
                                   class="form-submit-btn text-xs">
                                    محصولات
                                </a>
                            @endcan
                            @can('create-inquiry')
                                <a href="{{ route('inquiries.parts.index',$inquiry->id) }}"
                                   class="form-detail-btn text-xs">
                                    قطعات تکی
                                </a>
                            @endcan
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
                                <div class="relative z-10" x-show="open" x-cloak>
                                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                                    <div class="fixed z-10 inset-0 overflow-y-auto">
                                        <div class="flex items-center justify-center min-h-full p-4">
                                            <form method="POST"
                                                  action="{{ route('inquiries.correction',$inquiry->id) }}"
                                                  class="relative bg-white rounded-lg overflow-hidden shadow-xl transform transition-all w-full">
                                                @csrf
                                                @method('PATCH')
                                                <div class="bg-white p-4">
                                                    <div class="mt-3">
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
                                                <div class="bg-gray-100 space-x-2 space-x-reverse px-4 py-2">
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
