<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg ">
                <div class="py-3 text-gray-900 dark:text-gray-800 ">




                    <div>
                        @forelse ($categories as $category)
                            <div class="bg-neutral-100">
                                <div class="px-5">
                                    <small class="text-blue-400 block">Created by <a
                                            href="{{ route('profile.show', $category->user) }}"
                                            class="font-semibold text-blue-500">{{ $category->user->name }}</a>,
                                        {{ $category->created_at->diffForHumans() }}</small>
                                    @php

                                        $commentsCount = 0;
                                        foreach ($category->posts as $post) {
                                            $commentsCount += $post->comments()->count();
                                        }

                                    @endphp
                                    <small>Stats: {{ $category->posts()->count() }} Posts,
                                        {{ $commentsCount }} Comments</small>
                                </div>

                                <a class="mb-2 p-5  text-xl block hover:bg-neutral-200 transition duration-100"
                                    href="{{ route('category.show', $category) }}">



                                    <div>
                                        {{ $category->name }}
                                    </div>

                                </a>
                            </div>
                        @empty
                    </div>

                    <div class="text-center"></div>
                    @endforelse

                    {!! $categories->links() !!}


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
