@php
$isError=!$errors->isEmpty();
@endphp

<!DOCTYPE html>
<html lang="en" class="bg-amber-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <form method="POST" action="{{ route('register') }}" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 p-4 border border-black shadow-[4px_4px_black] w-1/4">
        @csrf
        <div class="space-y-4">
            <div class="text-center">
                <h2 class="text-lg font-bold">REGISTER</h2>
                <p class="text-center">
                    Please register using your email and password or if you already have an account, you can
                    <a href="{{route('login')}}" class="font-semibold text-lime-600 hover:underline">login</a>.
                </p>
            </div>
            <div class="flex flex-col">
                <label for="name">
                    Name
                </label>
                <input type="text" id="name" name="name" required class="px-4 py-2 border border-black bg-amber-50 placeholder:text-gray-500" placeholder="someone182">
                @if($isError)
                <span class="text-red-500">
                    {{ $errors->first('name') }}
                </span>
                @endif
            </div>
            <div class="flex flex-col">
                <label for="email">
                    Email
                </label>
                <input type="email" id="email" name="email" required class="px-4 py-2 border border-black bg-amber-50 placeholder:text-gray-500" placeholder="someone@email.com">
                @if($isError)
                <span class="text-red-500 text-sm">
                    {{ $errors->first('email') }}
                </span>
                @endif
            </div>
            <div class="flex flex-col">
                <label for="password">
                    Password
                </label>
                <input type="password" minlength="8" id="password" name="password" required class="px-4 py-2 border border-black bg-amber-50 placeholder:text-gray-500" placeholder="xxxxxxxxxxxxxx">
                @if($isError)
                <span class="text-red-500 text-sm">
                    {{ $errors->first('password') }}
                </span>
                @endif
            </div>
            <div class="flex flex-col">
                <label for="password_confirmation">
                    Password Confirmation
                </label>
                <input type="password" minlength="8" id="password_confirmation" name="password_confirmation" required class="px-4 py-2 border border-black bg-amber-50 placeholder:text-gray-500" placeholder="xxxxxxxxxxxxxx">
                @if($isError)
                <span class="text-red-500 text-sm">
                    {{ $errors->first('password_confirmation') }}
                </span>
                @endif
            </div>
            <button type="submit" class="w-full border font-mono p-2 bg-lime-300 border-black shadow-[4px_4px_#000] hover:shadow-[6px_6px_#000] transition-shadow">Register</button>
        </div>

    </form>
</body>

</html>