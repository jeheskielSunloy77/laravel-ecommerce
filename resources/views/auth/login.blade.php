@php
$isError=!$errors->isEmpty();
@endphp

<!DOCTYPE html>
<html lang="en" class="bg-amber-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
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
            <div class="flex flex-col">
                <label for="email">
                    Email
                </label>
                <input type="email" id="email" name="email" required class="px-4 py-2 border border-black bg-amber-50 placeholder:text-gray-500" placeholder="someone@email.com">
            </div>
            <div class="flex flex-col">
                <label for="password">
                    Password
                </label>
                <input type="password" id="password" name="password" required class="px-4 py-2 border border-black bg-amber-50 placeholder:text-gray-500" placeholder="xxxxxxxxxxxxxx">
            </div>
            @if($isError)
            <span class="text-red-500">
                {{$errors->first()}}
            </span>
            @endif
            <div class="flex items-center justify-between">
                <label for="remember-me" class="inline-flex items-center gap-2">
                    <input id="remember-me" type="checkbox" class="w-4 h-4" name="remember">
                    <span class="text-sm">Remember Me</span>
                </label>
                <a href="{{ route('password.request') }}" class="hover:underline text-sm text-gray-700">
                    Forgot Password?
                </a>
            </div>
            <button type="submit" class="w-full border font-mono p-2 bg-lime-300 border-black shadow-[4px_4px_#000] hover:shadow-[6px_6px_#000] transition-shadow">Login</button>
        </div>

    </form>
</body>

</html>