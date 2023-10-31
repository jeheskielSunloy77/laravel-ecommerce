@section('title', 'Forgot Password')

<x-app-layout isGuest>
    <form method="POST" action="{{ route('password.email') }}" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 p-4 border border-black shadow-[4px_4px_black] w-1/4">
        @csrf
        <div class="space-y-4">
            <div class="text-center">
                <h2 class="text-lg font-bold">FORGOT PASSWORD</h2>
                <p class="text-center">
                    Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
                </p>
            </div>
            <x-text-field label="Email" type="email" id="email" name="email" required placeholder="someone@email.com" :errors="$errors->get('email')" />
            <x-primary-button type="submit" class="w-full">Send Reset Link</x-primary-button>
        </div>
    </form>
</x-app-layout>