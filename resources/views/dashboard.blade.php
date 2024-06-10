<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-800">

                    @php
                        $posts = App\Models\Post::latest()->paginate();
                    @endphp

                    @forelse ($posts as $post)
                        <div class="my-2">
                            <a class="text-xl" href="{{ route('post.show', $post) }}">{{ $post->title }}</a>
                        </div>
                    @empty

                        <div class="text-center"></div>
                    @endforelse

                    {!! $posts->links() !!}


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
