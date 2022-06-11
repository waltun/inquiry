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
        <a href="{{ route('inquiries.create') }}" class="form-submit-btn text-xs">ایجاد استعلام جدید</a>
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
                        #
                    </th>
                    <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                        نام پروژه
                    </th>
                    <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                        مسئول پروژه
                    </th>
                    <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                        گروه
                    </th>
                    <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                        مدل
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
                        $modell = \App\Models\Modell::find($inquiry->model_id);
                        $group = \App\Models\Group::find($inquiry->group_id);
                    @endphp
                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-gray-500 text-center">{{ $loop->index + 1 }}</p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-black text-center">{{ $inquiry->name }}</p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-black text-center">{{ $inquiry->manager }}</p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-black text-center">{{ $group->name }}</p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-black text-center">{{ $modell->name }}</p>
                        </td>
                        <td class="px-4 py-3 space-x-3 space-x-reverse">
                            @can('create-inquiry')
                                <a href="{{ route('inquiries.edit',$inquiry->id) }}" class="form-edit-btn text-xs">
                                    ویرایش
                                </a>
                            @endcan
                            @can('inquiry-detail')
                                <a href="{{ route('inquiries.show',$inquiry->id) }}" class="form-detail-btn text-xs">
                                    جزئیات
                                </a>
                            @endcan
                            @can('inquiry-amounts')
                                <a href="{{ route('inquiries.amounts',$inquiry->id) }}" class="form-submit-btn text-xs">
                                    مقادیر
                                </a>
                            @endcan
                            @can('create-inquiry')
                                <form action="" method="POST" class="inline">
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
                            @can('inquiry-amounts')
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
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile List -->
        <div class="block md:hidden">
            @foreach($inquiries as $inquiry)
                @php
                    $modell = \App\Models\Modell::find($inquiry->model_id);
                    $group = \App\Models\Group::find($inquiry->group_id);
                @endphp
                <div class="bg-white rounded-md p-4 border border-gray-200 shadow-sm mb-4 relative z-30">
                    <span
                        class="absolute right-2 top-2 p-2 w-6 h-6 rounded-full bg-indigo-300 text-black text-xs grid place-content-center font-bold">
                        {{ $loop->index+1 }}
                    </span>
                    <div class="space-y-4">
                        <p class="text-xs text-black text-center">
                            نام پروژه : {{ $inquiry->name }}
                        </p>
                        <p class="text-xs text-black text-center">
                            مسئول پروژخ : {{ $inquiry->manager }}
                        </p>
                        <p class="text-xs text-black text-center">
                            گروه : {{ $group->name }}
                        </p>
                        <p class="text-xs text-black text-center">
                            مدل : {{ $modell->name }}
                        </p>
                        <div class="flex w-full justify-between">
                            <a href="{{ route('inquiries.edit',$inquiry->id) }}" class="form-edit-btn text-xs">
                                ویرایش
                            </a>
                            <a href="{{ route('inquiries.show',$inquiry->id) }}" class="form-detail-btn text-xs">
                                جزئیات
                            </a>
                            <a href="{{ route('inquiries.amounts',$inquiry->id) }}" class="form-submit-btn text-xs">
                                مقادیر
                            </a>
                            <form action="" method="POST"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="form-cancel-btn text-xs" onclick="return confirm('قطعه حذف شود ؟')">
                                    حذف
                                </button>
                            </form>
                        </div>
                        <div class="flex w-full justify-center">
                            <form action="{{ route('inquiries.submit',$inquiry->id) }}" method="POST"
                                  class="inline">
                                @csrf
                                @method('PATCH')
                                <button class="form-submit-btn text-xs"
                                        onclick="return confirm('استعلام ثبت نهایی شود ؟')">
                                    ثبت نهایی
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
