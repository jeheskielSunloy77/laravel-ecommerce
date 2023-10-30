<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="grid grid-cols-2 max-w-7xl mx-auto sm:px-6 lg:px-8 gap-6">
            <div class="p-4 border border-black shadow-[4px_4px_#000]">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="p-4 border border-black shadow-[4px_4px_#000]">
                @include('profile.partials.update-password-form')
            </div>

            <div class="col-span-2 p-4 border border-black shadow-[4px_4px_#000]">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>