@section('title', 'Confirm Password')

<x-app-layout isGuest>
    <form method="POST" action="{{ route('password.confirm') }}" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 p-4 border border-black shadow-[4px_4px_black] w-1/4">
        @csrf
        <div class="space-y-4">
            <div class="text-center">
                <h2 class="text-lg font-bold">CONFIRM PASSWORD</h2>
                <p class="text-center">
                    This is a secure area of the application. Please confirm your password before continuing.
                </p>
            </div>
            <x-text-field label="Password" type="password" id="password" name="password" required placeholder="xxxxxxxxxxxxxx" :errors="$errors->get('password')" />

            <x-primary-button type="submit" class="w-full">Confirm</x-primary-button>
        </div>

    </form>
</x-app-layout>