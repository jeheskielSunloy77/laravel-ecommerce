@section('title', 'User Wishlist | Tokolaravel')

<x-app-layout>
    <div class="gap-4 grid grid-cols-2">
        @foreach ($wishlists as $wishlist)
        <div class="p-4 border border-black flex items-center gap-4 shadow-[4px_4px_#000]">
            <img src="{{ $wishlist->product->image}}" alt="{{ $wishlist->product->name }}" class="w-36 h-36 rounded-sm" loading="lazy">
            <div class="flex items-center gap-4 justify-between w-full">
                <div>
                    <a href="{{ route('products.browser.show', $wishlist->product->id) }}">
                        <h3 class="text-3xl font-bold hover:underline">
                            {{ $wishlist->product->name }}
                        </h3>
                    </a>
                    <div class="flex items-center gap-4 text-lg">
                        <span> <span class="text-red-700 font-bold">$</span> {{$wishlist->product->price}}</span>
                        <div class="flex items-center gap-1 capitalize">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-700" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M6.5 11L12 2l5.5 9h-11Zm11 11q-1.875 0-3.188-1.313T13 17.5q0-1.875 1.313-3.188T17.5 13q1.875 0 3.188 1.313T22 17.5q0 1.875-1.313 3.188T17.5 22ZM3 21.5v-8h8v8H3ZM17.5 20q1.05 0 1.775-.725T20 17.5q0-1.05-.725-1.775T17.5 15q-1.05 0-1.775.725T15 17.5q0 1.05.725 1.775T17.5 20ZM5 19.5h4v-4H5v4ZM10.05 9h3.9L12 5.85L10.05 9ZM12 9Zm-3 6.5Zm8.5 2Z" />
                            </svg>
                            {{ $wishlist->product->category }}
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-1 flex-col">
                    <form action="{{ route('wishlists.destroy', $wishlist->id ) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center text-sm hover:shadow-[4px_4px_black] hover:bg-red-400 text-black p-1.5 border border-black transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M7 21q-.825 0-1.413-.588T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.588 1.413T17 21H7ZM17 6H7v13h10V6ZM9 17h2V8H9v9Zm4 0h2V8h-2v9ZM7 6v13V6Z" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>