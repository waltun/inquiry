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
                        مدیریت کاربران
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Navigation Btn -->
    <div class="mt-4 flex md:justify-end justify-center space-x-4 space-x-reverse">
        <a href="{{ route('users.create') }}" class="form-submit-btn text-xs">ایجاد کاربر جدید</a>
        <a href="{{ route('users.deleted') }}" class="form-cancel-btn text-xs">کاربران حذف شده</a>
    </div>

    <!-- Navigation links -->
    <div class="space-x-2 space-x-reverse mt-4 flex md:block overflow-x-auto md:overflow-hidden">
        <a href="{{ route('users.index') }}"
           class="text-xs hover:text-indigo-600 whitespace-nowrap font-bold {{ !request()->has('role') ? 'text-indigo-600' : 'text-indigo-400' }}">
            همه کاربران ({{ \App\Models\User::count() }})
        </a>
        <span> | </span>
        <a href="{{ route('users.index') }}?role=admin"
           class="text-xs hover:text-indigo-600 whitespace-nowrap font-bold {{ request('role') == 'admin' ? 'text-indigo-600' : 'text-indigo-400' }}">
            کاربران مدیر ({{ \App\Models\User::where('role','admin')->count() }})
        </a>
        <span> | </span>
        <a href="{{ route('users.index') }}?role=it"
           class="text-xs hover:text-indigo-600 whitespace-nowrap font-bold {{ request('role') == 'it' ? 'text-indigo-600' : 'text-indigo-400' }}">
            کاربران آی تی ({{ \App\Models\User::where('role','it')->count() }})
        </a>
        <span> | </span>
        <a href="{{ route('users.index') }}?role=user"
           class="text-xs hover:text-indigo-600 whitespace-nowrap font-bold {{ request('role') == 'user' ? 'text-indigo-600' : 'text-indigo-400' }}">
            کاربران عادی - ثبت نام جدید ({{ \App\Models\User::where('role','user')->count() }})
        </a>
        <span> | </span>
        <a href="{{ route('users.deleted') }}"
           class="text-xs text-indigo-400 hover:text-indigo-600 whitespace-nowrap font-bold">
            کاربران حذف شده ({{ \App\Models\User::onlyTrashed()->count() }})
        </a>
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
                        نام
                    </th>
                    <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                        شماره تماس
                    </th>
                    <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                        ایمیل
                    </th>
                    <th scope="col" class="px-4 py-3 text-sm font-bold text-gray-800 text-center">
                        نقش (سمت)
                    </th>
                    <th scope="col" class="relative px-4 py-3 rounded-l-md">
                        <span class="sr-only">اقدامات</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-gray-500 text-center">{{ $loop->index + 1 }}</p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-black text-center">{{ $user->name }}</p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-black text-center">{{ $user->phone }}</p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <p class="text-sm text-black text-center">{{ $user->email }}</p>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <span class="text-sm bg-gray-300 text-black rounded-md py-2 px-4 block text-center">
                                @switch($user->role)
                                    @case('user')
                                        کاربر عادی - ثبت نام جدید
                                        @break
                                    @case('it')
                                        مدیر آی تی (IT)
                                        @break
                                    @case('admin')
                                        مدیر
                                        @break
                                    @case('co-sales-expert')
                                        کارشناس ارشد فروش
                                        @break
                                    @case('sales-expert')
                                        کارشناس فروش
                                        @break
                                    @case('accounting')
                                        حسابداری
                                        @break
                                    @case('inventory')
                                        انبار داری
                                        @break
                                @endswitch
                            </span>
                        </td>
                        <td class="px-4 py-3 space-x-3 space-x-reverse whitespace-nowrap">
                            <a href="{{ route('users.edit',$user->id) }}" class="form-edit-btn text-xs">
                                ویرایش
                            </a>
                            <form action="{{ route('users.destroy',$user->id) }}" method="POST"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="form-cancel-btn text-xs" onclick="return confirm('کاربر حذف شود ؟')">
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
            @foreach($users as $user)
                <div class="bg-white rounded-md p-4 border border-gray-200 shadow-sm mb-4 relative z-30">
                <span
                    class="absolute right-2 top-2 p-2 w-6 h-6 rounded-full bg-indigo-300 text-black text-xs grid place-content-center font-bold">
                    {{ $loop->index+1 }}
                </span>
                    <div class="space-y-4">
                        <p class="text-xs text-black text-center">نام و نام خانوادگی : {{ $user->name }}</p>
                        <p class="text-xs text-black text-center">شماره تماس : {{ $user->phone }}</p>
                        <p class="text-xs text-black text-center">ایمیل : {{ $user->email }}</p>
                        <p class="text-xs text-black text-center">
                            @switch($user->role)
                                @case('user')
                                    کاربر عادی - ثبت نام جدید
                                    @break
                                @case('it')
                                    مدیر آی تی (IT)
                                    @break
                                @case('admin')
                                    مدیر
                                    @break
                                @case('co-sales-expert')
                                    کارشناس ارشد فروش
                                    @break
                                @case('sales-expert')
                                    کارشناس فروش
                                    @break
                                @case('accounting')
                                    حسابداری
                                    @break
                                @case('inventory')
                                    انبار داری
                                    @break
                            @endswitch
                        </p>
                        <div class="flex w-full justify-between">
                            <a href="{{ route('users.edit',$user->id) }}" class="form-edit-btn text-xs">
                                ویرایش
                            </a>
                            <form action="{{ route('users.destroy',$user->id) }}" method="POST"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="form-cancel-btn text-xs" onclick="return confirm('کاربر حذف شود ؟')">
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
