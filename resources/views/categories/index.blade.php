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
                        مدیریت دسته بندی ها
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Navigation Btn -->
    <div class="mt-4 flex justify-between items-center space-x-4 space-x-reverse">
        <div>
            <p class="text-lg text-black font-bold">
                لیست دسته بندی ها
            </p>
        </div>
        <div>
            <a href="{{ route('categories.create') }}" class="form-submit-btn text-xs">ایجاد دسته بندی جدید</a>
        </div>
    </div>

    <!-- Content -->
    <div class="mt-4">
        @foreach($categories as $category)
            <div class="border border-gray-400 rounded-md p-4 bg-white shadow-sm mb-4" x-data="{open:false}"
                 :class="{'bg-indigo-200' : open}" onmouseenter="showButtons({{ $category->id }})"
                 onmouseleave="hideButtons({{ $category->id }})">
                <div class="md:flex items-center justify-between space-y-4 md:space-y-0">
                    <div class="flex items-center">
                        <div class="ml-4">
                            <span class="w-5 h-5 text-xs rounded-full bg-gray-200 grid place-content-center">
                                {{ $loop->index + 1 }}
                            </span>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-black">
                                {{ $category->name }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div>
                            <p class="text-sm text-gray-700 font-bold">
                                تعداد قطعات : {{ count($category->parts) }}
                            </p>
                        </div>
                        <div class="mx-4">
                            <span class="text-gray-400 font-bold text-lg"> | </span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-800 font-bold">
                                کد : {{ $category->code }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 space-x-reverse hidden"
                         id="buttonSection{{ $category->id }}">
                        <a href="{{ route('categories.create') }}?parent={{ $category->id }}"
                           class="form-detail-btn text-xs">
                            ثبت زیردسته
                        </a>
                        <a href="{{ route('categories.edit',$category->id) }}" class="form-edit-btn text-xs">
                            ویرایش
                        </a>
                        @if(count($category->children) > 0)
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
                    @include('categories.children',['category' => $category])
                </div>
            </div>
        @endforeach
    </div>
</x-layout>
