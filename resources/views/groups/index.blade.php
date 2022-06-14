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
                        مدیریت گروه ها
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Navigation Btn -->
    <div class="mt-4 flex justify-between items-center space-x-4 space-x-reverse">
        <div>
            <p class="text-lg text-black font-bold">
                لیست گروه ها
            </p>
        </div>
        <div>
            <a href="{{ route('groups.create') }}" class="form-submit-btn text-xs">ایجاد گروه جدید</a>
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
                        کد
                    </th>
                    <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                        نام
                    </th>
                    <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                        تصویر
                    </th>
                    <th scope="col" class="relative px-4 py-3">
                        <span class="sr-only">مدل ها</span>
                    </th>
                    <th scope="col" class="relative px-4 py-3">
                        <span class="sr-only">قطعات</span>
                    </th>
                    <th scope="col" class="relative px-4 py-3 rounded-l-md">
                        <span class="sr-only">اقدامات</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($groups as $group)
                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-gray-500 text-center">{{ $group->code }}</p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-black text-center">{{ $group->name }}</p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            @if($group->image)
                                <img src="/files/groups/{{ $group->image }}" alt="" class="h-20 mx-auto rounded-md">
                            @else
                                <p class="text-sm text-black text-center">-</p>
                            @endif
                        </td>
                        <td class="px-4 py-3 space-x-3 space-x-reverse">
                            <a href="{{ route('modells.create',$group->id) }}" class="form-submit-btn text-xs">
                                افزودن مدل
                            </a>
                            <a href="{{ route('modells.index',$group->id) }}" class="form-detail-btn text-xs">
                                مدل ها
                            </a>
                        </td>
                        <td class="px-4 py-3 space-x-3 space-x-reverse">
                            <a href="{{ route('group.parts.index',$group->id) }}" class="form-submit-btn text-xs">
                                افزودن قطعه
                            </a>
                            <a href="{{ route('group.parts',$group->id) }}" class="form-detail-btn text-xs">
                                قطعات
                            </a>
                        </td>
                        <td class="px-4 py-3 space-x-3 space-x-reverse">
                            <a href="{{ route('groups.edit',$group->id) }}" class="form-edit-btn text-xs">
                                ویرایش
                            </a>
                            <form action="{{ route('groups.destroy',$group->id) }}" method="POST"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="form-cancel-btn text-xs" onclick="return confirm('گروه حذف شود ؟')">
                                    حذف
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile List -->
        <div class="block md:hidden">
            @foreach($groups as $group)
                <div class="bg-white rounded-md p-4 border border-gray-200 shadow-sm mb-4 relative z-30">
                <span
                    class="absolute right-2 top-2 p-2 w-6 h-6 rounded-full bg-indigo-300 text-black text-xs grid place-content-center font-bold">
                    {{ $group->code }}
                </span>
                    <div class="space-y-4">
                        @if($group->image)
                            <img src="/files/groups/{{ $group->image }}" alt="" class="mx-auto h-20 rounded-md">
                        @else
                            <p class="text-xs text-black text-center">تصویر ندارد</p>
                        @endif
                        <p class="text-xs text-black text-center">نام : {{ $group->name }}</p>
                        <p class="text-xs text-black text-center">
                            تعداد مدل ها : {{ count($group->model_ids ?? []) }}
                        </p>
                        <div class="flex w-full justify-between">
                            <a href="{{ route('modells.index',$group->id) }}" class="form-detail-btn text-xs">
                                مدل ها
                            </a>
                            <a href="{{ route('modells.create',$group->id) }}" class="form-submit-btn text-xs">
                                افزودن مدل
                            </a>
                            <a href="{{ route('group.parts',$group->id) }}" class="form-detail-btn text-xs">
                                قطعات
                            </a>
                            <a href="{{ route('group.parts.index',$group->id) }}" class="form-submit-btn text-xs">
                                افزودن قطعه
                            </a>
                        </div>
                        <div class="flex w-full justify-between">
                            <a href="{{ route('groups.edit',$group->id) }}" class="form-edit-btn text-xs">
                                ویرایش
                            </a>
                            <form action="{{ route('groups.destroy',$group->id) }}" method="POST"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="form-cancel-btn text-xs" onclick="return confirm('گروه حذف شود ؟')">
                                    حذف
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
