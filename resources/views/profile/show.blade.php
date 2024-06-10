<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <Message :receiver_id="{{ \App\Models\User::whereName($name)->first()->id }}"
                :sender_id="{{ auth()->id() }}"></Message>
        </div>



    </div>
</x-app-layout>
