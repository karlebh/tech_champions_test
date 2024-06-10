<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-800">

                    @if (request()->session()->has('message'))
                        <div class="pb-5 font-medium text-white fixed z-50 bottom-0 right-0 bg-green-500 p-5">
                            {{ request()->session()->get('message') }}
                        </div>
                    @endif


                    <h2 class="text-xl text-blue-400 mb-3">{{ $post->title }}</h2>

                    <p>{{ $post->body }}</p>

                    @if (auth()->check() && $post->user_id === auth()->id())
                        <div class="flex items-baseline gap-x-3">
                            <div class="mt-10">
                                <a class=" underline" href="{{ route('post.edit', $post) }}">Edit
                                    Post</a>
                            </div>

                            <div class="mt-10">
                                <form action="{{ route('post.destroy', $post) }}" method="post">
                                    @method('delete')
                                    @csrf

                                    <input type="submit"
                                        class="cursor-pointer rounded text-red-400 bg-gray-100 underline"
                                        value="delete Post">
                                </form>
                            </div>
                        </div>
                    @endif

                    <Like :id="{{ $post->id }}" :like_count="{{ $post->likes()->count() }}"
                        :model="{{ $post }}" like="{{ $like }}" php_class="{{ $post::class }}"
                        model_url="{{ route('post.show', $post) }}" :auth="{{ auth()->check() ? 1 : 0 }}">
                    </Like>

                </div>

                @forelse ($post->images as $image)
                    <div>
                        <img alt="" class="h-48 w-96" src="{{ asset("storage/uploads/$image->src") }}">
                    </div>
                @empty
                @endforelse
            </div>

            <section>
                @auth
                    <div class="bg-white mt-3 p-4">
                        <toggle-comment-box :box_id="{{ $post->id }}"></toggle-comment-box>
                        <form action="{{ route('comment.store') }}" class="" id="commentBox-{{ $post->id }}"
                            enctype="multipart/form-data" method="post">

                            <input name="post_id" type="hidden" value="{{ $post->id }}">
                            <input name="post_slug" type="hidden" value="{{ $post->slug }}">

                            @error('post_id')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror

                            @csrf

                            <div>
                                <textarea cols="100" id="" name="body" rows="6"></textarea>
                                @error('body')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="space-y-8 mt-4" id="commentBox">
                                <div>
                                    <input accept="image/*" multiple name="images[]" type="file">
                                    @error('images.*')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <input name="parent_id" type="hidden" value="">
                                    @error('parent_id')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <input class="cursor-pointer rounded-md bg-blue-500 px-4 py-3 text-gray-50"
                                        type="submit" value="Submit Comment">

                                </div>
                            </div>
                        </form>
                    </div>
                @endauth

                @if ($post->comments()->exists())
                    <div class="bg-white my-4 rounded-md py-7">
                        <h1 class="text-xl font-medium px-4 pb-4">Replies</h1>
                        @forelse ($post->comments->load('replies') as $comment)
                            @include('post.partials.comment', ['comment' => $comment, 'parent' => true])
                        @empty
                        @endforelse
                    </div>
                @endif
            </section>
        </div>
    </div>
    </div>
</x-app-layout>
