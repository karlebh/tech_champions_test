<section>
    <div id="comment-#{{ $comment->id }}" class="bg-gray-200 p-4 mb-4">


        <div class="mb-3"><small class="font-medium">by <a class="underline"
                    href="{{ route('profile.show', $comment->user) }}">{{ $comment->user->name }}</a>
                created at {{ $comment->created_at->diffForHumans() }}</small></div>

        <p class="text-lg font-normal">{{ $comment->body }}</p>

        <div>
            @if ($comment->images()->exists())
                <div class="grid grid-cols-2 justify-items-center my-4">
                    @foreach ($comment->images as $image)
                        <div class="">
                            <img alt="" class="h-48 w-96" src="{{ asset("storage/comments/$image->src") }}">
                        </div>
                    @endforeach
                </div>
            @endif

            @auth
                <div class="flex items-baseline gap-x-5 mt-10 mb-6">
                    @if ($parent)
                        <a href="#commentBox" class="underline" onclick="makeReply({{ $comment->id }})">reply</a>
                    @endif

                    @if ($comment->user->id == auth()->id())
                        <a href="{{ route('comment.edit', $comment) }}" class="underline">edit
                            comment</a>
                        <form action="{{ route('comment.destroy', $comment) }}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" value="delete comment" class="underline">
                        </form>
                    @endif

                    @php
                        $like = \App\Models\Like::where([
                            'user_id' => auth()->id(),
                            'likeable_id' => $comment->id,
                            'likeable_type' => $comment::class,
                        ])->exists();
                    @endphp

                    <Like :id="{{ $comment->id }}" :like_count="{{ $comment->likes()->count() }}"
                        :model="{{ $comment }}" :like="{{ $like ? 1 : 0 }}" php_class="{{ $comment::class }}"
                        model_url="{{ route('post.show', $post) . '#comment-#' . $comment->id }}"
                        :auth="{{ auth()->check() ? 1 : 0 }}">
                    </Like>
                </div>
            @endauth

            @forelse ($comment->replies as $comment)
                @include('post.partials.comment', ['comment' => $comment, 'parent' => false])
            @empty
            @endforelse
        </div>
    </div>
</section>
