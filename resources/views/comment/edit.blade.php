<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid p-10 overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="m-10 text-gray-900 dark:text-gray-800">

                    @if (request()->session()->has('message'))
                        <div class="pb-5 font-medium text-white fixed z-50 bottom-0 right-0 bg-red-500 p-5">
                            {{ request()->session()->get('message') }}
                            <button class="text-xl cursor-pointer ml-3" onclick="this.parentElement.remove()">X</button>
                        </div>
                    @endif

                    <div class="mb-10">

                        <form action="{{ route('comment.update', $comment) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <div>
                                <textarea name="body" id="" cols="30" rows="10" class="bg-gray-100">{{ $comment->body }}</textarea>
                            </div>


                            <div class="my-8">
                                <input accept="image/*" multiple name="images[]" type="file">
                                @error('images.*')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <input type="submit" value="Update Comment"
                                class="bg-blue-400 text-white px-4 py-2 mt-5 cursor-pointer">
                        </form>

                        <form action="{{ route('comment.destroy', $comment) }}" method="post">
                            @csrf
                            @method('delete')
                            <input class="mt-5 rounded bg-red-500 p-4 text-gray-200" type="submit" value="Delete Post">
                        </form>
                    </div>

                    @forelse ($comment->images as $image)
                        <div class="">
                            <button class="text-xl text-red-400" onclick="deleteImage({{ $image }})">X</button>

                            <img alt="" class="h-48 w-96" id="image-{{ $image->id }}"
                                src="{{ asset("storage/comments/$image->src") }}">
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
