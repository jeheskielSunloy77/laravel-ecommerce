@section('title', 'Reset Password')

@php
$isError=!$errors->isEmpty();
@endphp

<x-app-layout isGuest>
    <form method="POST" action="{{ route('password.store') }}" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 p-4 border border-black shadow-[4px_4px_black] w-1/4">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <div class="space-y-4">
            <div class="text-center">
                <h2 class="text-lg font-bold">RESET PASSWORD</h2>
                <p class="text-center">
                    Please register using your email and password or if you already have an account, you can
                    <a href="{{route('login')}}" class="font-semibold text-lime-600 hover:underline">login</a>.
                </p>
            </div>
            <x-text-field label="Email" type="email" id="email" name="email" required placeholder="someone@email.com" :errors="$errors->get('email')" />
            <x-text-field label="Password" type="password" id="password" minlength="8" name="password" required placeholder="xxxxxxxxxxxxxx" :errors="$errors->get('password')" />
            <x-text-field label="Password Confirmation" type="password" minlength="8" id="password_confirmation" name="password_confirmation" required placeholder="xxxxxxxxxxxxxx" :errors="$errors->get('password_confirmation')" />
            <x-primary-button type="submit" class="w-full">Reset Password</x-primary-button>
        </div>
    </form>
</x-app-layout>