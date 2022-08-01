@if(count($category->children) > 0)
    @foreach($category->children as $children)
        <div class="border border-gray-400 rounded-md p-4 bg-gray-50 my-4">
            <div class="flex items-center justify-between">
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
                <div class="flex items-center space-x-3 space-x-reverse">
                    <a href="{{ route('categories.create') }}?parent={{ $children->id }}"
                       class="form-detail-btn text-xs">
                        ثبت زیردسته
                    </a>
                    <a href="{{ route('categories.edit',$children->id) }}" class="form-edit-btn text-xs">
                        ویرایش
                    </a>
                    <form action="{{ route('categories.destroy',$children->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button class="form-cancel-btn text-xs" onclick="return confirm('دسته بندی حذف شود ؟')">
                            حذف
                        </button>
                    </form>
                </div>
            </div>
            @if(count($children->children) > 0)
                @include('categories.children',['category' => $children])
            @endif
        </div>
    @endforeach
@endif
