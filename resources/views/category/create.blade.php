<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid justify-items-end overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-800">


                    <form action="{{ route("post.store") }}" method="post">
                        @csrf

                        <input name="post_id" type="hidden" value="{{ $post->id }}">
                        <div>
                            <label for="">Title</label>
                            <input name='title' type="text">
                            @error("title")
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="">Body</label>
                            <input name='body' type="text">
                            @error("body")
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <select id="" name='category_id'>
                                <option>Select one</option>
                                @foreach (\App\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error("category_id")
                                <span class="text-red-500">
                                    Select a category
                                </span>
                            @enderror
                        </div>

                        <div>
                            <input class="mt-5 rounded bg-green-500 p-4 text-gray-100" type="submit"
                                value="Create Post">
                        </div>
                    </form>



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
