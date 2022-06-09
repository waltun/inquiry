@if($errors->any())
    <div class="bg-red-500 p-4 rounded-md text-white font-bold">
        <ul class="text-xs md:text-sm mr-5 mt-2 list-disc">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
