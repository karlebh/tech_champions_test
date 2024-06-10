<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg grid justify-items-end">
                <div class="p-6 text-gray-900 dark:text-gray-800 ">


                    {{ auth()->user()->unreadNotifications->markAsRead() }}

                    {{-- There is `readNotifications` --}}


                    @forelse (auth()->user()->notifications as $not)
                        {{-- Mention Notifications  --}}
                        @if ($not->type === 'App\Notifications\UserMentioned')
                            <div class="flex flex-col">
                                <p>
                                    <span
                                        class="text-md font-semibold text-green-500">{{ $not->data['sender']['name'] }}</span>
                                    mentioned you <a href="{{ $not->data['url'] }}"
                                        class="font-sembold text-md text-blue-500">here</a>
                                </p>
                                <form method="post" class="inline" action="{{ route('nots.delete', $not->id) }}">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="text-red-400 mx-5">delete</button>
                                </form>
                            </div>
                        @endif

                        {{-- Follow Notifications --}}
                        @if ($not->type === 'App\Notifications\UserFollowed')
                            <div class="flex flex-col">
                                <p>
                                    <span
                                        class="text-md font-semibold text-green-500">{{ $not->data['follower']['name'] }}</span>
                                    followed you.
                                </p>
                                <form method="post" class="inline" action="{{ route('nots.delete', $not->id) }}">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="text-red-400 mx-5">delete</button>
                                </form>
                            </div>
                        @endif

                        {{-- Unfollow Notifications --}}
                        @if ($not->type === 'App\Notifications\UserUnfollowed')
                            <div class="flex flex-col">
                                <p>
                                    <span
                                        class="text-md font-semibold text-green-500">{{ $not->data['follower']['name'] }}</span>
                                    unfollowed you.
                                </p>
                                <form method="post" class="inline" action="{{ route('nots.delete', $not->id) }}">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="text-red-400 mx-5">delete</button>
                                </form>
                            </div>
                        @endif

                        {{-- Comment Notifications --}}
                        @if ($not->type === 'App\Notifications\CommentedOnPost')
                            <div class="flex flex-col">
                                <p>
                                    <span
                                        class="text-md font-semibold text-green-500">{{ $not->data['commentOwner']['name'] }}</span>
                                    commented on your post. <a href="{{ $not->data['url'] }}"
                                        class="tex-md underline text-blue-500">Comment</a>
                                </p>
                                <form method="post" class="inline" action="{{ route('nots.delete', $not->id) }}">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="text-red-400 mx-5">delete</button>
                                </form>
                            </div>
                        @endif
                        {{-- Like Notifications  --}}
                        @if ($not->type === 'App\Notifications\UserLike')
                            <div class="flex flex-col">
                                <p>
                                    <span class="text-md font-semibold text-green-500">{{ $not->data['liker'] }}</span>
                                    liked your <a href="{{ $not->data['url'] }}">
                                        {{ strtolower(str_replace('App\Models\\', '', $not->data['model'])) }}</a>
                                </p>
                                <form method="post" class="inline" action="{{ route('nots.delete', $not->id) }}">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="text-red-400 mx-5">delete</button>
                                </form>
                            </div>
                        @endif
                    @empty
                        <p>No notifications yet.</p>
                    @endforelse

                </div>
                @if (auth()->user()->notifications()->count())
                    <form method="post" class="inline" action="{{ route('nots.delete') }}">
                        @method('delete')
                        @csrf
                        <button type="submit" class="bg-red-400 text-white rounded p-4 m-5">Delete All
                            Notifications</button>
                    </form>
                @endif

            </div>
        </div>


    </div>
</x-app-layout>
