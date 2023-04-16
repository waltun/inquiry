<x-layout>
    <!-- Breadcrumb -->
    <div class="flex items-center space-x-2 space-x-reverse">
        <a href="{{ route('dashboard') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0l4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0l-5.571 3-5.571-3"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    داشبورد
                </p>
            </div>
        </a>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                 class="breadcrumb-svg-arrow">
                <path fill-rule="evenodd"
                      d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                      clip-rule="evenodd"/>
            </svg>
        </div>
        <a href="{{ route('groups.index') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="breadcrumb-svg" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    مدیریت محصولات
                </p>
            </div>
        </a>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                 class="breadcrumb-svg-arrow">
                <path fill-rule="evenodd"
                      d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                      clip-rule="evenodd"/>
            </svg>
        </div>
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="breadcrumb-svg-active">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    ویرایش مدل زیر دسته {{ $modell->name }}
                </p>
            </div>
        </div>

    </div>

    <!-- Errors -->
    <div class="mt-4">
        <x-errors/>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('modells.update',$modell->id) }}" class="md:grid grid-cols-2 gap-4 mt-4">
        @csrf
        @method('PATCH')

        <div class="card">
            <div class="card-header">
                <p class="card-title">مشخصات کلی</p>
            </div>
            <div class="mt-4">
                <label for="inputName" class="form-label">نام مدل</label>
                <input type="text" id="inputName" name="name" class="input-text" value="{{ $modell->name }}">
            </div>
        </div>

        @if($modell->parent_id != 0)
            <div class="card">
                <div class="card-header">
                    <p class="card-title">مدل مربوطه</p>
                </div>

                <div class="mt-4">
                    <label for="inputParent" class="form-label">
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
                    <label for="inputPercent" class="form-label">ضریب پیش فرض</label>
                    <input type="text" id="inputPercent" name="percent" class="input-text" placeholder="مثال : 1.6"
                           value="{{ old('percent') ?? $modell->percent }}">
                </div>

                <div class="mt-4">
                    <label for="inputPercent" class="form-label">محصول استاندارد</label>
                    <select name="standard" id="inputStandard" class="input-text">
                        <option value="0" {{ !$modell->standard ? 'selected' : '' }}>نباشد</option>
                        <option value="1" {{ $modell->standard ? 'selected' : '' }}>باشد</option>
                    </select>
                </div>
            </div>
        @else
            <div class="card">
                <div class="card-header">
                    <p class="card-title">دسته مربوطه</p>
                </div>

                <div class="mt-4">
                    <label for="inputGroup" class="form-label">
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
                    <label for="inputPercent" class="form-label">ضریب پیش فرض</label>
                    <input type="text" id="inputPercent" name="percent" class="input-text" placeholder="مثال : 1.6"
                           value="{{ old('percent') ?? $modell->percent }}">
                </div>

                <div class="mt-4">
                    <label for="inputPercent" class="form-label">محصول استاندارد</label>
                    <select name="standard" id="inputStandard" class="input-text">
                        <option value="0" {{ !$modell->standard ? 'selected' : '' }}>نباشد</option>
                        <option value="1" {{ $modell->standard ? 'selected' : '' }}>باشد</option>
                    </select>
                </div>
            </div>
        @endif

        <div class="flex items-center space-x-2 space-x-reverse">
            <button type="submit" class="form-edit-btn">
                بروزرسانی مدل
            </button>
            <a href="{{ route('modells.children',$modell->parent_id) }}" class="form-cancel-btn">
                انصراف
            </a>
        </div>
    </form>
</x-layout>
