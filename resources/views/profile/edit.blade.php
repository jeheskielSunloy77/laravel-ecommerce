@section('title', 'User Profile | Tokolaravel')

<x-app-layout>
    <div class="py-12">
        <div class="grid grid-cols-2 max-w-7xl mx-auto sm:px-6 lg:px-8 gap-6">
            <x-primary-card class="p-4">
                @include('profile.partials.update-profile-information-form')
            </x-primary-card>

            <x-primary-card class="p-4">
                @include('profile.partials.update-password-form')
            </x-primary-card>

            <x-primary-card class="col-span-2 p-4">
                @include('profile.partials.delete-user-form')
            </x-primary-card>
        </div>
    </div>
</x-app-layout>