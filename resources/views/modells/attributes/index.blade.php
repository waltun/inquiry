<x-layout>
    <x-slot name="js">
        <script src="{{ asset('plugins/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
        <script>
            $("#inputName").select2({
                placeholder: 'برای انتخاب مشخصه فنی کلیک کنید',
                tags: true,
                width: '100%'
            });
            $("#inputUnit").select2({
                placeholder: 'برای انتخاب واحد مشخصه فنی کلیک کنید',
                tags: true,
                width: '100%'
            });
            $("#inputModell").select2({
                width: '100%'
            });
        </script>
        <script>
            function updateAttribute(id) {
                let unit = document.getElementById('inputUnitUpdate' + id);
                let name = document.getElementById('inputNameUpdate' + id);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    method: 'patch',
                    url: '/models/' + id + '/attributes',
                    data: {
                        id: id,
                        unit: unit.value,
                        name: name.value,
                        modell_id: '{{ $modell->id }}'
                    },
                    success: function () {
                        location.reload();
                    }
                });
            }

            function destroyAttribute(attrId, modId) {

                let conf = confirm('مشخصه فنی حذف شود ؟');

                if (conf) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'POST',
                        method: 'delete',
                        url: '/models/' + modId + '/attributes',
                        data: {
                            attrId: attrId,
                            modId: modId
                        },
                        success: function () {
                            location.reload();
                        }
                    });
                }
            }
        </script>
    </x-slot>
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
    </x-slot>

    <!-- Breadcrumb -->
    <div class="breadcrumb">
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
            <svg xmlns="http://www.w3.org/2000/svg" class="breadcrumb-svg" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p">
                    لیست محصولات
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
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <div class="mr-2">
                <p class="breadcrumb-p-active">
                    مشخصات فنی مدل {{ $modell->name }}
                </p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="flex items-center justify-between mt-8">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-8 h-8 dark:text-white">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <div class="mr-2">
                <p class="font-bold text-2xl text-black dark:text-white">
                    لیست مشخصات فنی {{ $modell->name }}
                </p>
            </div>
            <a href="{{ route('modells.children',$modell->id) }}"
               class="category-back">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75"/>
                </svg>
                <span class="mr-1 text-sm">بازگشت</span>
            </a>
        </div>
        <div class="flex items-center space-x-4 space-x-reverse">
            <div x-data="{open:false}">
                <!-- Create Attribute Button -->
                <button type="button" class="page-success-btn" @click="open = !open">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                    <span class="mr-2">ایجاد مشخصه جدید</span>
                </button>
                <!-- Create Attribute Modal -->
                <div class="relative z-10" x-show="open" x-cloak>
                    <div class="modal-backdrop"></div>
                    <div class="fixed z-10 inset-0 overflow-y-auto">
                        <div class="modal">
                            <div class="modal-body">
                                <div class="bg-white dark:bg-slate-800 p-4">
                                    <div class="mb-4 flex justify-between items-center">
                                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                            ایجاد مشخصه جدید برای دسته بندی {{ $modell->name }}
                                        </h3>
                                        <button type="button" @click="open = false">
                                        <span class="modal-close">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                 viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor"
                                                 class="w-5 h-5 dark:text-white">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </span>
                                        </button>
                                    </div>
                                    <form method="post"
                                          action="{{ route('modells.attributes.store',$modell->id) }}" class="mt-6">
                                        @csrf
                                        <div class="mb-4">
                                            <label for="inputName" class="form-label">نام مشخصه فنی</label>
                                            <select name="name" id="inputName" class="input-text">
                                                <option value=""></option>
                                                @foreach($allAttributes as $allAttribute)
                                                    <option value="{{ $allAttribute->name }}">
                                                        {{ $allAttribute->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label for="inputUnit" class="form-label">واحد مشخصه فنی</label>
                                            <select name="unit" id="inputUnit" class="input-text">
                                                <option value=""></option>
                                                @foreach($allAttributes as $allAttribute)
                                                    <option value="{{ $allAttribute->unit }}">
                                                        {{ $allAttribute->unit }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mt-2 space-y-2">
                                            <p class="text-xs font-bold text-red-600 dark:text-red-400">
                                                * برای انتخاب مشخصه فنی روی باکس بالا کلیک کنید و از لیست باز شده مشخصه
                                                فنی
                                                مورد نظر را انتخاب کنید.
                                            </p>
                                            <p class="text-xs font-bold text-red-600 dark:text-red-400">
                                                * اگر مشخصه فنی در لیست بالا نبود، روی باکس سفید کلیک کنید و نام مشخصه
                                                فنی
                                                جدید را ثبت و اینتر (Enter) بزنید.
                                            </p>
                                            <p class="text-xs font-bold text-red-600 dark:text-red-400">
                                                * سیستم به صورت خودکار از وارد شدن مشخصه فنی تکراری خودداری می‌کند.
                                            </p>
                                            <p class="text-xs font-bold text-red-600 dark:text-red-400">
                                                * قابلیت سرچ بین مشخصات فنی در لیست باز شده وجود دارد و با تایپ بخشی از
                                                مشخصه فنی، مشابه ها مشاهده می شوند.
                                            </p>
                                        </div>
                                        <div class="flex justify-end items-center space-x-4 space-x-reverse">
                                            <button type="submit" class="form-submit-btn">
                                                ثبت مشخصه
                                            </button>
                                            <button type="button" class="form-cancel-btn" @click="open = false">
                                                انصراف!
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div x-data="{open:false}">
                <!-- Copy Attribute Button -->
                <button type="button" class="page-warning-btn" @click="open = !open">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5A3.375 3.375 0 006.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0015 2.25h-1.5a2.251 2.251 0 00-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 00-9-9z"/>
                    </svg>
                    <span class="mr-2">کپی مشخصات فنی</span>
                </button>

                <!-- Copy Attribute Modal -->
                <div class="relative z-10" x-show="open" x-cloak>
                    <div class="modal-backdrop"></div>
                    <div class="fixed z-10 inset-0 overflow-y-auto">
                        <div class="modal">
                            <div class="modal-body">
                                <div class="bg-white dark:bg-slate-800 p-4">
                                    <div class="mb-4 flex justify-between items-center">
                                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                            کپی از مشخصات فنی مدل {{ $modell->name }}
                                        </h3>
                                        <button type="button" @click="open = false">
                                            <span class="modal-close">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                     viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor"
                                                     class="w-5 h-5 dark:text-white">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                            </span>
                                        </button>
                                    </div>
                                    <form method="post"
                                          action="{{ route('modells.attributes.replicate',$modell->id) }}"
                                          class="mt-6">
                                        @csrf

                                        <div class="mb-4">
                                            <label for="inputModell" class="form-label">انتخاب مدل</label>
                                            <select name="modell_id" id="inputModell" class="input-text">
                                                <option value="">انتخاب کنید</option>
                                                @foreach(\App\Models\Modell::all() as $child)
                                                    @if(!$child->children->isEmpty())
                                                        <option value="{{ $child->id }}">
                                                            {{ $child->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="flex justify-end items-center space-x-4 space-x-reverse">
                                            <button type="submit" class="form-submit-btn">
                                                کپی مشخصات فنی
                                            </button>
                                            <button type="button" class="form-cancel-btn" @click="open = false">
                                                انصراف!
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
    </div>

    <!-- Errors -->
    <div class="mt-8">
        <x-errors/>
    </div>

    <!-- Table -->
    @if(!$attributes->isEmpty())
        <form method="POST" action="{{ route('modells.attributes.storeSort',$modell->id) }}">
            @csrf
            <div class="mt-4 overflow-x-auto rounded-lg">
                <table class="w-full border-collapse">
                    <thead>
                    <tr class="table-th-tr">
                        <th scope="col" class="p-4 rounded-tr-lg">
                            Sort
                        </th>
                        <th scope="col" class="p-4">
                            نام مشخصه فنی
                        </th>
                        <th scope="col" class="p-4">
                            واحد مشخصه فنی
                        </th>
                        <th scope="col" class="p-4">
                            مقدار پیش فرض
                        </th>
                        <th scope="col" class="p-4">
                            دسته بندی
                        </th>
                        <th scope="col" class="p-4">
                            نمایش
                        </th>
                        <th scope="col" class="p-4 rounded-tl-lg">
                            اقدامات
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($attributes as $index => $attribute)
                        <tr class="table-tb-tr group">
                            <td class="table-tr-td border-t-0 border-l-0">
                                <input type="number" name="sorts[]" value="{{ $attribute->pivot->sort }}"
                                       class="input-text text-center w-16">
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                {{ $attribute->name }}
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                {{ $attribute->unit }}
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                <input type="text" class="input-text text-center" name="default_value[]"
                                       id="defaultValue{{ $attribute->id }}"
                                       value="{{ $attribute->pivot->default_value ?? '' }}">
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                <select name="attribute_group_id[]" id="attributeGroup{{ $attribute->id }}"
                                        class="input-text">
                                    <option value="">انتخاب کنید</option>
                                    @foreach($groups as $group)
                                        <option
                                            value="{{ $group->id }}" {{ $attribute->pivot->attribute_group_id == $group->id ? 'selected' : '' }}>
                                            {{ $group->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="table-tr-td border-t-0 border-x-0">
                                <select name="show_data[]" id="attributeShow{{ $attribute->id }}" class="input-text">
                                    <option value="">انتخاب کنید</option>
                                    <option value="1" {{ $attribute->pivot->show_data == '1' ? 'selected' : '' }}>
                                        نمایش در دیتاشیت
                                    </option>
                                    <option value="0" {{ $attribute->pivot->show_data == '0' ? 'selected' : '' }}>
                                        عدم نمایش در دیتاشیت
                                    </option>
                                </select>
                            </td>
                            <td class="table-tr-td border-t-0 border-r-0">
                                <div class="flex items-center justify-center space-x-4 space-x-reverse relative">

                                    <div x-data="{open:false}">
                                        <button type="button" @click="open = !open" class="table-dropdown-edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                            </svg>
                                            ویرایش
                                        </button>

                                        <!-- Edit Modal -->
                                        <div class="relative z-10" x-show="open" x-cloak>
                                            <div class="modal-backdrop"></div>
                                            <div class="fixed z-10 inset-0 overflow-y-auto">
                                                <div class="modal">
                                                    <div class="modal-body">
                                                        <div class="bg-white dark:bg-slate-800 p-4">
                                                            <div class="mb-4 flex justify-between items-center">
                                                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                                    ویرایش {{ $attribute->name }}
                                                                </h3>
                                                                <button type="button" @click="open = false">
                                                                    <span class="modal-close">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                             fill="none"
                                                                             viewBox="0 0 24 24"
                                                                             stroke-width="1.5" stroke="currentColor"
                                                                             class="w-5 h-5 dark:text-white">
                                                                            <path stroke-linecap="round"
                                                                                  stroke-linejoin="round"
                                                                                  d="M6 18L18 6M6 6l12 12"/>
                                                                        </svg>
                                                                    </span>
                                                                </button>
                                                            </div>
                                                            <div class="mt-6">
                                                                <div class="mb-4">
                                                                    <label for="inputNameUpdate{{ $attribute->id }}"
                                                                           class="form-label">
                                                                        نام مشخصه فنی
                                                                    </label>
                                                                    <input type="text" name="name"
                                                                           id="inputNameUpdate{{ $attribute->id }}"
                                                                           class="input-text"
                                                                           value="{{ $attribute->name }}">
                                                                </div>
                                                                <div class="mb-4">
                                                                    <label for="inputUnitUpdate{{ $attribute->id }}"
                                                                           class="form-label">
                                                                        واحد مشخصه فنی
                                                                    </label>
                                                                    <input type="text" name="unit"
                                                                           id="inputUnitUpdate{{ $attribute->id }}"
                                                                           class="input-text"
                                                                           value="{{ $attribute->unit }}">
                                                                </div>
                                                                <div class="mt-2 space-y-2">
                                                                    <p class="text-xs font-bold text-red-600 dark:text-red-400">
                                                                        * از این قسمت فقط می‌توانید نام مشخصه فنی را
                                                                        تغییر
                                                                        دهید.
                                                                    </p>
                                                                    <p class="text-xs font-bold text-red-600 dark:text-red-400">
                                                                        * لطفا توجه کنید اگر نام تکراری وارد شود، سیستم
                                                                        آن
                                                                        را قبول نمی‌کند.
                                                                    </p>
                                                                </div>
                                                                <div
                                                                    class="flex justify-end items-center space-x-4 space-x-reverse">
                                                                    <button type="button" class="form-edit-btn"
                                                                            onclick="updateAttribute({{ $attribute->id }})">
                                                                        بروزرسانی مشخصه
                                                                    </button>
                                                                    <button type="button" class="form-cancel-btn"
                                                                            @click="open = false">
                                                                        انصراف!
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-delete-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                        </svg>
                                        <button type="button"
                                                onclick="destroyAttribute({{ $attribute->id }},{{ $modell->id }})">
                                            حذف
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4 sticky bottom-4">
                <button class="form-submit-btn" type="submit">
                    ذخیره Sort
                </button>
            </div>
        </form>
    @else
        <div class="mt-8 bg-myYellow-100 rounded-lg p-4 shadow-yellow">
            <p class="text-black text-center text-sm font-bold">
                شما هنوز مشخصه فنی جدیدی وارد نکرده اید!
            </p>
        </div>
    @endif
</x-layout>
