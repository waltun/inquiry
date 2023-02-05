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

@if(count($category->children) > 0)
    @foreach($category->children as $children)
        @php
            $status = true;
            $count = 0;
            $id = $children->id;
            while ($status){
                $cat = \App\Models\Category::where('id',$id)->first();
                $parent_id = $cat->parent_id;
                if ($parent_id != 0){
                    $count++;
                    $id = $parent_id;
                } else{
                    $status = false;
                }
            }
        @endphp
        <div class="border border-gray-400 rounded-md px-4 py-1 bg-gray-50 my-4" x-data="{open : false}"
             :class="{'bg-indigo-300' : open}" onmouseenter="showButtons({{ $children->id }})"
             onmouseleave="hideButtons({{ $children->id }})">
            <div class="md:flex items-center justify-between space-y-4 md:space-y-0">
                <div class="flex items-center">
                    <div class="ml-4">
                            <span class="w-5 h-5 text-xs rounded-full bg-gray-200 grid place-content-center">
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
                        <p class="text-sm text-gray-700 font-bold">
                            تعداد قطعات : {{ count($children->parts) }}
                        </p>
                    </div>
                    <div class="mx-4">
                        <span class="text-gray-400 font-bold text-lg"> | </span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-800 font-bold">
                            کد : {{ $children->code }}
                        </p>
                    </div>
                </div>
                <div class="flex items-center space-x-3 space-x-reverse hidden" id="buttonSection{{ $children->id }}">
                    @if($delete->categories)
                        <form action="{{ route('categories.destroy',$category->id) }}" class="inline">
                            @csrf
                            <button type="submit" class="form-cancel-btn text-xs">حذف</button>
                        </form>
                    @endif
                    @if($count != 2)
                        <a href="{{ route('categories.create') }}?parent={{ $children->id }}"
                           class="form-detail-btn text-xs">
                            ثبت زیردسته
                        </a>
                    @endif
                    <a href="{{ route('categories.edit',$children->id) }}" class="form-edit-btn text-xs">
                        ویرایش
                    </a>
                    @if(count($children->children) > 0)
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
            @if(count($children->children) > 0)
                <div x-show="open">
                    @include('categories.children',['category' => $children, 'delete' => $delete])
                </div>
            @endif
        </div>
    @endforeach
@endif
