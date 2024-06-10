<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm  sm:rounded-lg flex justify-center">
                <div class="px-6 py-4 text-gray-900  flex-1">

                    <form action="{{ route('post.store') }}" class="space-y-5" enctype="multipart/form-data" method="post">
                        @csrf
                        <div>
                            <label for="" class="block">Title</label>
                            <input class="w-full md:w-2/3 lg:w-1/3" name='title' type="text">
                            @error('title')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="" class="block">Body</label>
                            <textarea class="w-full md:w-2/3 lg:w-1/3" name='body'></textarea>
                            @error('body')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <input class="w-full md:w-2/3 lg:w-1/3 bg-gray-300 p-2" accept="image/*" multiple
                                name="images[]" type="file">
                        </div>

                        <div>
                            <select id="" name='category_id' class="w-full md:w-2/3 lg:w-1/3">
                                <option>Select one</option>
                                @foreach (\App\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-red-500">
                                    Select a category
                                </span>
                            @enderror
                        </div>

                        <div>
                            <input class="mt-5 cursor-pointer rounded bg-green-500 p-4 text-gray-100" type="submit"
                                value="Create Post">
                        </div>
                    </form>



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
