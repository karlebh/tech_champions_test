<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid justify-items-end overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-800">

                    {{ $post->images }}

                    <div class="flex flex-wrap">

                        @forelse ($post->images as $image)
                            <div class="">
                                <button class="text-xl text-red-400" onclick="deleteImage({{ $image }})">X</button>
                                <img alt="" class="h-48 w-96" id="image-{{ $image->id }}"
                                    src="{{ asset("storage/uploads/$image->src") }}">
                            </div>
                        @empty
                        @endforelse

                    </div>


                    <div>
                        <form action="{{ route('post.update', $post) }}" class="space-y-3" enctype="multipart/form-data"
                            method="post">
                            @csrf
                            @method('PATCH')
                            <div>
                                <label for="">Title</label>
                                <input name='title' type="text" value="{{ $post->title }}">
                                @error('title')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="">Body</label>
                                <input name='body' type="text" value="{{ $post->body }}">
                                @error('body')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="">Images</label>
                                <input accept="image/*" multiple name="images[]" type="file">
                                <small class="block text-blue-600">Add to pictures</small>
                                @error('images')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <select id="" name='category_id'>
                                    @foreach (\App\Models\Category::all() as $category)
                                        <option @if ($post->category_id === $category->id) selected @endif
                                            value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="text-red-500">
                                        Select a category
                                    </span>
                                @enderror
                            </div>

                            <div class="flex justify-around">
                                <input class="mt-5 rounded bg-blue-500 p-4 text-gray-200" type="submit"
                                    value="Update Post">
                            </div>
                        </form>

                        <form action="{{ route('post.destroy', $post) }}" method="post">
                            @csrf
                            @method('delete')
                            <input class="mt-5 rounded bg-red-500 p-4 text-gray-200" type="submit" value="Delete Post">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
