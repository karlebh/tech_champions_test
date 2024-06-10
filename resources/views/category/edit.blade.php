<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg grid justify-items-end">
                <div class="p-6 text-gray-900 dark:text-gray-800 ">

                  {{$post->slug}}
                

                    <form action="{{route('post.update', $post)}}" method="post">
                        @csrf
                        @method('PATCH')
                        <div>
                            <label for="">Title</label>
                            <input type="text" name='title' value="{{ $post->title }}">
                            @error('title')
                                <span class="text-red-500">{{$message}}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="">Body</label>
                            <input type="text" name='body' value="{{$post->body}}">
                            @error('body')
                            <span class="text-red-500">{{$message}}</span>
                        @enderror
                        </div>

                        <div>
                            <select id="" name='category_id'>
                                @foreach (\App\Models\Category::all() as $category)
                                     <option @if($post->category_id === $category->id) selected @endif value="{{$category->id}}">
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

                        <div>
                            <input type="submit" value="Update Post" class="bg-blue-500 text-gray-200 rounded mt-5 p-4">
                        </div>
                    </form>



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
