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
                    <a href="{{ route('modells.index',$group->id) }}"
                       class="mr-2 text-xs md:text-sm font-medium text-gray-500 hover:text-gray-900">
                        مدیریت مدل ها
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
                        ویرایش مدل {{ $modell->name }} برای گروه {{ $group->name }}
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('modells.update',$modell->id) }}" class="md:grid grid-cols-2 gap-4 mt-4">
        @csrf
        @method('PATCH')

        <div class="col-span-2 flex justify-center">
            <span
                class="text-lg text-center font-bold text-black bg-white p-4 rounded-md shadow-md border border-gray-200">
                شما در حال ویرایش مدل <span class="text-red-600">{{ $modell->name }}</span> برای گروه <span
                    class="text-red-600">{{ $group->name }}</span> می باشید
            </span>
        </div>

        <div class="bg-white shadow-sm p-4 rounded-md border border-gray-200 mb-4 md:mb-0">
            <p class="md:text-sm text-xs text-black font-bold border-b-2 border-teal-400 pb-3">مشخصات کلی</p>
            <div class="mt-4">
                <label for="inputName" class="block mb-2 md:text-sm text-xs text-black">نام مدل</label>
                <input type="text" id="inputName" name="name" class="input-text" value="{{ $modell->name }}">
            </div>
        </div>

        @if($modell->parent_id != 0)
            <div class="bg-white shadow-sm p-4 rounded-md border border-gray-200 mb-4 md:mb-0">
                <p class="md:text-sm text-xs text-black font-bold border-b-2 border-teal-400 pb-3">مدل مربوطه</p>
                <div class="mt-4">
                    <label for="inputParent" class="block mb-2 md:text-sm text-xs text-black">
                        مدل مرتبط
                    </label>
                    <select name="parent_id" id="inputParent" class="input-text">
                        @foreach(\App\Models\Modell::where('parent_id',0)->get() as $modell2)
                            <option
                                value="{{ $modell2->id }}" {{ $modell2->id == $modell->parent_id ? 'selected' : '' }}>
                                {{ $modell2->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-4">
                    <label for="inputPercent" class="block mb-2 md:text-sm text-xs text-black">ضریب پیش فرض</label>
                    <input type="text" id="inputPercent" name="percent" class="input-text" placeholder="مثال : 1.6"
                           value="{{ old('percent') ?? $modell->percent }}">
                </div>

                <div class="mt-4">
                    <label for="inputPercent" class="block mb-2 md:text-sm text-xs text-black">محصول استاندارد</label>
                    <select name="standard" id="inputStandard" class="input-text">
                        <option value="0" {{ !$modell->standard ? 'selected' : '' }}>نباشد</option>
                        <option value="1" {{ $modell->standard ? 'selected' : '' }}>باشد</option>
                    </select>
                </div>
            </div>
        @else
            <div class="bg-white shadow-sm p-4 rounded-md border border-gray-200 mb-4 md:mb-0">
                <p class="md:text-sm text-xs text-black font-bold border-b-2 border-teal-400 pb-3">دسته مربوطه</p>
                <div class="mt-4">
                    <label for="inputGroup" class="block mb-2 md:text-sm text-xs text-black">
                        دسته مرتبط
                    </label>
                    <select name="group_id" id="inputGroup" class="input-text">
                        @foreach(\App\Models\Group::all() as $group2)
                            <option
                                value="{{ $group2->id }}" {{ $group2->id == $modell->group_id ? 'selected' : '' }}>
                                {{ $group2->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-4">
                    <label for="inputPercent" class="block mb-2 md:text-sm text-xs text-black">ضریب پیش فرض</label>
                    <input type="text" id="inputPercent" name="percent" class="input-text" placeholder="مثال : 1.6"
                           value="{{ old('percent') ?? $modell->percent }}">
                </div>

                <div class="mt-4">
                    <label for="inputPercent" class="block mb-2 md:text-sm text-xs text-black">محصول استاندارد</label>
                    <select name="standard" id="inputStandard" class="input-text">
                        <option value="0" {{ !$modell->standard ? 'selected' : '' }}>نباشد</option>
                        <option value="1" {{ $modell->standard ? 'selected' : '' }}>باشد</option>
                    </select>
                </div>
            </div>
        @endif

        <div class="col-span-2 space-x-2 space-x-reverse">
            <button type="submit" class="form-edit-btn">
                بروزرسانی مدل
            </button>
            <a href="{{ route('modells.index',$group->id) }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>
