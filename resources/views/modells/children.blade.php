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

@if(count($modell->children) > 0)
    @foreach($modell->children as $children)
        @php
            $status = true;
            $count = 0;
            $id = $children->id;
            while ($status){
                $cat = \App\Models\Modell::where('id',$id)->first();
                $parent_id = $cat->parent_id;
                if ($parent_id != 0){
                    $count++;
                    $id = $parent_id;
                } else{
                    $status = false;
                }
            }
        @endphp
        <div class="border border-gray-400 rounded-md p-4 bg-gray-50 my-4" x-data="{open : false}"
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
                    <a href="{{ route('modells.parts',$children->id) }}" class="form-detail-btn text-xs">
                        قطعات مدل
                    </a>
                    <a href="{{ route('modells.edit',$children->id) }}" class="form-edit-btn text-xs">
                        ویرایش مدل
                    </a>
                    <form action="{{ route('modells.destroy',$children->id) }}" method="POST"
                          class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="form-cancel-btn text-xs" onclick="return confirm('مدل حذف شود ؟')">
                            حذف
                        </button>
                    </form>
                    <form action="{{ route('modells.replicate',$children->id) }}" method="POST"
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
@endif
