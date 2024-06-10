<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h1 class="text-2xl">Settings</h1>
                <div class="">
                    <form action="{{ route('settings.update', $user->id) }}" method="post" class="space-y-10 block">

                        @method('put')
                        @csrf

                        <Setting type="mention_notifiable" :setting="{{ $user->setting }}">
                            <p class="text-teal-400 text-xl">Toggle to disable or enable notification when users mention
                                you.</p>
                        </Setting>

                        <Setting type="like_notifiable" :setting="{{ $user->setting }}">
                            <p class="text-blue-400 text-xl">Toggle to disable or enable notification when users like
                                your
                                posts, comments or profile.</p>
                        </Setting>

                        <Setting type="follow_notifiable" :setting="{{ $user->setting }}">
                            <p class="text-blue-400 text-xl">Toggle to disable or enable notification when users follow
                                you.</p>
                        </Setting>

                        <Setting type="comment_notifiable" :setting="{{ $user->setting }}">
                            <p class="text-blue-400 text-xl">Toggle to disable or enable notification when users comment
                                on
                                your post.</p>
                        </Setting>
                    </form>
                </div>
            </div>


            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">

                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class="my-5">
                    <form action="{{ route('profile.image') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div>
                            <label for="image" class="text-xl font-medium ">Profile Picture</label> <br><br>
                            <input type="file" name="profile_image" accept="image/*" class="rounded p-5 bg-gray-300">
                        </div>

                        @error('profile_image')
                            <span class="text-red-500 block">{{ $message }}</span>
                        @enderror

                        <button class="text-gray-100 rounded px-3 py-2 bg-green-700 my-4 block" type="submit">Change
                            Profile Image</button>
                    </form>

                    @if (request()->user()->image()->exists())
                    @endif
                </div>

                @if (request()->user()->image()->exists())
                    <div id="profile-picture" class="my-10">
                        <img alt="" class="h-96 w-96 rounded-full object-cover p-10 bg-gray-300"
                            src="{{ asset('storage/uploads/' . request()->user()->image->src) }}">

                        <delete-profile-image class="mt-8"
                            :user="{{ request()->user()->load('image') }}"></delete-profile-image>
                    </div>
                @endif

            </div>


            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
