@section('title', 'Cart')

<x-app-layout>
    <div class="gap-4 grid grid-cols-2">
        @foreach ($carts as $cart)
        @php
        $isEditing = request('edit_product_id') == $cart->product->id;
        @endphp

        <div class="p-4 border border-black flex items-center gap-4 shadow-[4px_4px_#000]">
            <img src="{{ $cart->product->image}}" alt="{{ $cart->product->name }}" class="w-36 h-36 rounded-sm">
            <div class="flex items-center gap-4 justify-between w-full">
                <div>
                    <a href="{{ url('/products/' . $cart->product->id) }}">
                        <h3 class="text-3xl font-bold hover:underline">
                            {{ $cart->product->name }}
                        </h3>
                    </a>
                    <div class="flex items-center gap-4 text-lg">
                        <span>
                            <span class="text-red-500">$</span> {{ $cart->product->price }}
                        </span>
                        @if($isEditing)
                        <form action="{{ url('/carts/' . $cart->id ) }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="number" name="quantity" value="{{ $cart->quantity }}" class="w-20 border border-black rounded-sm px-2 bg-amber-100">
                            <button type="submit" class="border border-black rounded-sm px-4 hover:shadow-[4px_4px_black] hover:bg-lime-300 transition-all">Change</button>
                        </form>
                        @else
                        <span>
                            {{ $cart->quantity }}<span class="text-red-500">x</span>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="flex items-center gap-1 flex-col">
                    <form action="{{ url('/carts/' . $cart->id ) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center text-sm hover:shadow-[4px_4px_black] hover:bg-red-400 text-black p-1.5 border border-black transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M7 21q-.825 0-1.413-.588T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.588 1.413T17 21H7ZM17 6H7v13h10V6ZM9 17h2V8H9v9Zm4 0h2V8h-2v9ZM7 6v13V6Z" />
                            </svg>
                        </button>
                    </form>
                    <a class="{{ ($isEditing ? 'shadow-[4px_4px_black] bg-lime-300' : 'hover:shadow-[4px_4px_black] hover:bg-lime-300 transition-all') .  ' inline-flex items-center text-sm text-black p-1.5 border border-black'}}" href="{{$isEditing ? route('carts.index') : route('carts.index',['edit_product_id'=> $cart->product->id ])}}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24">
                            <path fill="currentColor" d="{{ $isEditing ? 'm19.1 21.875l-6.375-6.35L7.25 21H3v-4.25l5.475-5.475l-6.35-6.35L3.55 3.5l16.975 16.975l-1.425 1.4ZM10.6 13.4l-.7-.7l.7.7l.7.7l-.7-.7Zm4.975-.725L14.15 11.25l.875-.875l-1.4-1.4l-.875.875l-1.425-1.425L13.6 6.15l4.25 4.25l-2.275 2.275Zm3.725-3.75l-4.25-4.2l1.4-1.4q.575-.575 1.413-.575t1.412.575l1.4 1.4q.575.575.6 1.388t-.55 1.387L19.3 8.925Zm-5.85 1.625ZM5 19h1.4l4.9-4.9l-1.4-1.4L5 17.6V19Z' : 'M5 19h1.4l8.625-8.625l-1.4-1.4L5 17.6V19ZM19.3 8.925l-4.25-4.2l1.4-1.4q.575-.575 1.413-.575t1.412.575l1.4 1.4q.575.575.6 1.388t-.55 1.387L19.3 8.925ZM17.85 10.4L7.25 21H3v-4.25l10.6-10.6l4.25 4.25Zm-3.525-.725l-.7-.7l1.4 1.4l-.7-.7Z' }}" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>