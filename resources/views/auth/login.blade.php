@section('title', 'Login')

<x-app-layout isGuest>
    <form method="POST" action="{{ route('login') }}" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 p-4 border border-black shadow-[4px_4px_black] w-1/4">
        @csrf
        <div class="space-y-4">
            <div class="text-center">
                <h2 class="text-lg font-bold">LOGIN</h2>
                <p class="text-center">
                    Please login using your email and password or if you don't have an account, please
                    <a href="{{route('register')}}" class="font-semibold text-lime-600 hover:underline">register</a> first.
                </p>
            </div>
            <x-text-field label="Email" type="email" id="email" name="email" required placeholder="someone@email.com" :errors="$errors->get('email')"/>
            <x-text-field label="Password" type="password" id="password" name="password" required placeholder="xxxxxxxxxxxxxx" :errors="$errors->get('password')" />
            <div class="flex items-center justify-between">
                <label for="remember-me" class="inline-flex items-center gap-2">
                    <input id="remember-me" type="checkbox" class="w-4 h-4" name="remember">
                    <span class="text-sm">Remember Me</span>
                </label>
                <a href="{{ route('password.request') }}" class="hover:underline text-sm text-gray-700">
                    Forgot Password?
                </a>
            </div>
            <x-primary-button type="submit" class="w-full">Login</x-primary-button>
        </div>

    </form>
</x-app-layout>