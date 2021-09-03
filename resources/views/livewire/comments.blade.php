<div>
    <div class="flex justify-center pt-10">
        <div class="space-y-10">
            <h1 class="text-center mt-10 text-4xl font-bold">Add Your Comment</h1>
            <form wire:submit.prevent='addComment'
                class="flex items-center p-6 space-x-6 bg-white rounded-xl shadow-lg transition duration-500">
                <div class="flex bg-gray-100 p-4 w-72 space-x-4 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 opacity-30" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input wire:model.lazy='addComment' class="bg-gray-100 outline-none" type="text"
                        placeholder="Article name or keyword..." />

                </div>
                <input type="submit" value="Add" type="submit"
                    class="bg-red-600 py-3 px-5 text-white font-semibold rounded-lg hover:shadow-lg transition duration-3000 cursor-pointer" />

            </form>
            @error('addComment')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @endError
            <div>
                @if (session()->has('message'))
                    <div class="bg-green-100 p-4 rounded">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <br>
    <div class="w-96 mx-auto">
        <input class="mb-3" id='image' wire:change='$emit("fileChoosen")' type="file">
        @if ($image)
            <img src="{{ $image }}" alt="" width="200">
        @endif
    </div>
    <br>
    <hr>

    <div class="w-96 mx-auto pt-5">
        @foreach ($comments as $comment)
            <div class="border-b-2 mt-3">
                <div class="flex text-sm justify-between mb-1.5">
                    <h2>{{ $comment->creator->name }}</h2>
                    <p>{{ $comment->created_at->diffForHumans() }}</p>
                    <button wire:click='removeComment({{ $comment->id }})' class="text-red-500 font-bold">x</button>
                </div>
                <p class="py-4">{{ $comment->body }}</p>
            </div>
        @endforeach

        <br>

        {{ $comments->links() }}
    </div>
</div>

<script>
    Livewire.on('fileChoosen', () => {
        let inputFile = document.getElementById('image');
        let file = inputFile.files[0];
        let reader = new FileReader();

        reader.onloadend = () => {
            Livewire.emit('fileUpload', reader.result);
        }
        reader.readAsDataURL(file);
    });
</script>
