<x-app-layout>
    <div class="gap-4 grid grid-cols-2">
        @foreach ($wishlists as $wishlist)
        <div class="p-4 border border-black flex items-center gap-4 shadow-[4px_4px_#000]">
            <img src="{{ $wishlist->product->image}}" alt="{{ $wishlist->product->name }}" class="w-36 h-36 rounded-sm" loading="lazy">
            <div class="flex items-center gap-4 justify-between w-full">
                <div>
                    <a href="{{ url('/products/' . $wishlist->product->id) }}">
                        <h3 class="text-3xl font-bold hover:underline">
                            {{ $wishlist->product->name }}
                        </h3>
                    </a>
                    <span class="text-lg text-red-500">$</span> {{ $wishlist->product->price }}
                </div>
                <div class="flex items-center gap-1 flex-col">
                    <form action="{{ url('/wishlists/' . $wishlist->id ) }}" method="post">
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