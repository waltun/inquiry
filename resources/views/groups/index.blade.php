<x-layout>
    <x-slot name="js">
        <script>
            function showButtons(id) {
                let buttonSection = document.getElementById('buttonSection' + id);
                buttonSection.classList.remove('hidden');
            }

            function hideButtons(id) {
                let buttonSection = document.getElementById('buttonSection' + id);
                buttonSection.classList.add('hidden');
            }

            function showButtons2(id) {
                let buttonSection = document.getElementById('buttonSection2' + id);
                buttonSection.classList.remove('hidden');
            }

            function hideButtons2(id) {
                let buttonSection = document.getElementById('buttonSection2' + id);
                buttonSection.classList.add('hidden');
            }
        </script>
    </x-slot>

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
            <li aria-current="page">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                              clip-rule="evenodd"/>
                    </svg>
                    <span class="mr-2 text-xs md:text-sm font-medium text-gray-400">
                        مدیریت محصولات
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Navigation Btn -->
    <div class="mt-4 flex justify-between items-center space-x-4 space-x-reverse">
        <div>
            <p class="text-lg text-black font-bold">
                لیست محصولات
            </p>
        </div>
        <div>
            <a href="{{ route('groups.create') }}" class="form-submit-btn text-xs">ایجاد دسته اصلی</a>
        </div>
    </div>

    <!-- Content -->
    <div class="mt-4">
        @foreach($groups as $group)
            <div class="border border-gray-400 rounded-md p-4 bg-white shadow-sm mb-4" x-data="{open:false}"
                 :class="{'bg-indigo-200' : open}" onmouseenter="showButtons({{ $group->id }})"
                 onmouseleave="hideButtons({{ $group->id }})">
                <div class="md:flex items-center justify-between space-y-4 md:space-y-0">
                    <div class="flex items-center">
                        <div class="ml-4">
                            <span class="w-5 h-5 text-xs rounded-full bg-gray-200 grid place-content-center">
                                {{ $loop->index + 1 }}
                            </span>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-black">
                                {{ $group->name }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div>
                            <p class="text-sm text-gray-700 font-bold">
                                تعداد مدل ها : {{ count($group->modells) }}
                            </p>
                        </div>
                        <div class="mx-4">
                            <span class="text-gray-400 font-bold text-lg"> | </span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-800 font-bold">
                                کد : {{ $group->code }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 space-x-reverse hidden"
                         id="buttonSection{{ $group->id }}">
                        <a href="{{ route('modells.create',$group->id) }}" class="form-submit-btn text-xs">
                            زیردسته جدید
                        </a>
                        <a href="{{ route('groups.edit',$group->id) }}" class="form-edit-btn text-xs">
                            ویرایش نام گروه
                        </a>
                        <form action="{{ route('groups.destroy',$group->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="form-cancel-btn text-xs" onclick="return confirm('گروه حذف شود ؟')">
                                حذف
                            </button>
                        </form>
                        @if(count($group->modells) > 0)
                            <button type="button" @click="open = !open">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 transform transition-transform"
                                     fill="none" viewBox="0 0 24 24" :class="{'rotate-90' : open}"
                                     stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                                </svg>
                            </button>
                        @endif
                    </div>
                </div>
                <div x-show="open" x-cloak>
                    @foreach($group->modells()->where('parent_id',0)->get() as $modell)
                        <div class="border border-gray-400 rounded-md p-4 bg-white shadow-sm my-4"
                             x-data="{open:false}"
                             :class="{'bg-indigo-200' : open}" onmouseenter="showButtons2({{ $modell->id }})"
                             onmouseleave="hideButtons2({{ $modell->id }})">
                            <div class="md:flex items-center justify-between space-y-4 md:space-y-0">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <span
                                            class="w-5 h-5 text-xs rounded-full bg-gray-200 grid place-content-center">
                                            {{ $loop->index + 1 }}
                                        </span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-black">
                                            {{ $modell->name }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div>
                                        <p class="text-sm text-gray-800 font-bold">
                                            کد : {{ $modell->code }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3 space-x-reverse hidden"
                                     id="buttonSection2{{ $modell->id }}">
                                    <a href="{{ route('modells.create',$group->id) }}?parent={{ $modell->id }}"
                                       class="form-submit-btn text-xs">
                                        افزودن مدل جدید
                                    </a>
                                    <a href="{{ route('modells.edit',$modell->id) }}" class="form-edit-btn text-xs">
                                        ویرایش مدل
                                    </a>
                                    <form action="{{ route('modells.destroy',$modell->id) }}" method="POST"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="form-cancel-btn text-xs"
                                                onclick="return confirm('مدل حذف شود ؟')">
                                            حذف
                                        </button>
                                    </form>
                                    <form action="{{ route('modells.replicate',$modell->id) }}" method="POST"
                                          class="inline">
                                        @csrf
                                        <button class="form-detail-btn text-xs">
                                            کپی
                                        </button>
                                    </form>
                                    @if(count($modell->children) > 0)
                                        <button type="button" @click="open = !open">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="h-7 w-7 transform transition-transform"
                                                 fill="none" viewBox="0 0 24 24" :class="{'rotate-90' : open}"
                                                 stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M15 19l-7-7 7-7"/>
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                            </div>
                            <div x-show="open">
                                @foreach($modell->children as $children)
                                    <div class="border border-gray-400 rounded-md p-4 bg-white shadow-sm my-4"
                                         x-data="{open:false}"
                                         :class="{'bg-indigo-200' : open}"
                                         onmouseenter="showButtons2({{ $children->id }})"
                                         onmouseleave="hideButtons2({{ $children->id }})">
                                        <div class="md:flex items-center justify-between space-y-4 md:space-y-0">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                        <span
                                            class="w-5 h-5 text-xs rounded-full bg-gray-200 grid place-content-center">
                                            {{ $loop->index + 1 }}
                                        </span>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-bold text-black">
                                                        {{ $children->name }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex items-center">
                                                <div>
                                                    <p class="text-sm text-gray-800 font-bold">
                                                        کد : {{ $children->code }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-3 space-x-reverse hidden"
                                                 id="buttonSection2{{ $children->id }}">
                                                <a href="{{ route('modells.parts',$children->id) }}"
                                                   class="form-submit-btn text-xs">
                                                    قطعات مدل
                                                </a>
                                                <a href="{{ route('modells.edit',$children->id) }}"
                                                   class="form-edit-btn text-xs">
                                                    ویرایش مدل
                                                </a>
                                                <form action="{{ route('modells.destroy',$children->id) }}"
                                                      method="POST"
                                                      class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="form-cancel-btn text-xs"
                                                            onclick="return confirm('مدل حذف شود ؟')">
                                                        حذف
                                                    </button>
                                                </form>
                                                <form action="{{ route('modells.replicate',$children->id) }}"
                                                      method="POST"
                                                      class="inline">
                                                    @csrf
                                                    <button class="form-detail-btn text-xs">
                                                        کپی
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</x-layout>
