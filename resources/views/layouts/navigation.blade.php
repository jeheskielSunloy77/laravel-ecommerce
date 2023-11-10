@php
$user=auth()->user();
$cart= $user ? $user -> carts : null;
@endphp
<nav class="fixed top-0 w-full bg-amber-50 z-50">
    <div class="container relative py-2 mx-auto md:flex md:justify-between md:items-center">
        <div class="flex items-center justify-between">
            <a href="/">
                <x-app-logo />
            </a>

            <div class="flex lg:hidden">
                <button type="button" class="text-gray-500 dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-400 focus:outline-none focus:text-gray-600 dark:focus:text-gray-400" aria-label="toggle menu">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16" />
                    </svg>

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="relative flex items-center w-1/3">
            <span class="absolute">
                <x-icon-search class="ml-3" />
            </span>
            <form class="w-full block">
                <input name="search" type="text" placeholder="Search for products" class="w-full shadow-[4px_4px_black] focus:shadow-[6px_6px_black] focus:outline-none transition-shadow block py-2.5 text-gray-700 placeholder-gray-400/70 bg-amber-50 border-2 border-black pl-11 pr-5 rtl:pr-11 rtl:pl-5 dark:bg-amber-50 dark:text-gray-300 dark:border-gray-600" value="{{request('search')}}">
            </form>
        </div>

        <div class="absolute inset-x-0 z-20 w-full px-6 py-4 transition-all duration-300 ease-in-out bg-white dark:bg-gray-800 md:mt-0 md:p-0 md:top-0 md:relative md:bg-transparent md:w-auto md:opacity-100 md:translate-x-0 md:flex md:items-center gap-2">
            @if($user)
            <div class="flex justify-center md:block">
                <a class="relative transform transition-all" href="/carts">
                    <button class="flex items-center gap-2 transition-all hover:shadow-[4px_4px_black] p-1.5 border border-transparent hover:border-black">
                        <x-icon-cart />
                    </button>
                    @if($cart->count())
                    <span class="absolute top-1 left-1 p-1 text-xs text-white bg-lime-500 rounded-full">
                    </span>
                    @endif
                </a>
            </div>
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="flex items-center gap-2 transition-all hover:shadow-[4px_4px_black] p-1.5 border border-transparent hover:border-black">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12 12q-1.65 0-2.825-1.175T8 8q0-1.65 1.175-2.825T12 4q1.65 0 2.825 1.175T16 8q0 1.65-1.175 2.825T12 12Zm-8 8v-2.8q0-.85.438-1.563T5.6 14.55q1.55-.775 3.15-1.163T12 13q1.65 0 3.25.388t3.15 1.162q.725.375 1.163 1.088T20 17.2V20H4Zm2-2h12v-.8q0-.275-.138-.5t-.362-.35q-1.35-.675-2.725-1.012T12 15q-1.4 0-2.775.338T6.5 16.35q-.225.125-.363.35T6 17.2v.8Zm6-8q.825 0 1.413-.588T14 8q0-.825-.588-1.413T12 6q-.825 0-1.413.588T10 8q0 .825.588 1.413T12 10Zm0-2Zm0 10Z" />
                        </svg>
                    </button>
                </x-slot>
                <x-slot name="content">
                    <div class="text-center bg-amber-50 divide-y divide-black rounded-sm border border-black shadow-[4px_4px_#000] w-44">
                        <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                            <div>
                                {{$user->name}}
                            </div>
                            <div class="font-medium truncate">
                                {{$user->email}}
                            </div>
                        </div>
                        <ul class="py-2 text-sm">
                            <li>
                                <a href="/profile" class="block px-4 py-2 hover:bg-lime-300 border-y border-transparent hover:border-black">Profile</a>
                            </li>
                            <li>
                                <a href="/wishlists" class="block px-4 py-2 hover:bg-lime-300 border-y border-transparent hover:border-black">Wishlists</a>
                            </li>
                            <li>
                                <a href="/transactions" class="block px-4 py-2 hover:bg-lime-300 border-y border-transparent hover:border-black">Transactions</a>
                            </li>
                        </ul>
                        <ul class="py-2 text-sm">
                            <li>
                                <a href="/products" class="block px-4 py-2 hover:bg-lime-300 border-y border-transparent hover:border-black">Products List</a>
                            </li>
                        </ul>
                        <form method="POST" action="{{ route('logout')}}" class="py-2">
                            @csrf
                            <input type="submit" value="Logout" class="w-full px-4 py-2 text-sm hover:bg-red-300 border-y border-transparent hover:border-black cursor-pointer" />
                        </form>
                    </div>
                </x-slot>
            </x-dropdown>
            @else
            <a href="/login">
                <x-primary-button class="w-1/3 lg:w-24">Login</x-primary-button>
            </a>
            @endif
        </div>
    </div>
</nav>