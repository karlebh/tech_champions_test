<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class=" overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-800">

                    @forelse (\App\Models\User::all() as $user)
                        @if ($user->id !== auth()->id())
                            <div class="flex space-x-5 my-4">
                                <span class="mr-10">
                                    <a class="underline cursor-pointer text-lg"
                                        href=" {{ route('profile.show', $user) }}">
                                        {{ $user->name }}
                                    </a>
                                </span>


                                @php

                                @endphp

                                <Follow url="{{ route('follow', $user) }}"
                                    :follows_back="{{ $user->follows->contains(auth()->id()) && !auth()?->user()?->follows->contains($user) ? 1 : 0 }}"
                                    :follows="{{ auth()?->user()?->follows->contains($user) ? 1 : 0 }}" />
                            </div>
                        @endif
                    @empty
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
