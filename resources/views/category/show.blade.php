<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg grid justify-items-end">
                <div class="p-6 text-gray-900 dark:text-gray-800 ">
                

                    {{$category->name}}


                   
                      @forelse ($category->posts as $post )
                      <div class="mt-10">
                      <a href="{{route('post.show', $post)}}"
                      class="text-gray-400 text-lg underline font-medium">{{ $post->title }}</a>
                    </div>
                      @empty
                        
                      @endforelse


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
