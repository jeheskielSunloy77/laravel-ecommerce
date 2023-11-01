@section('title', 'Products')

@php
$categories = ['clothes', 'shoes', 'sports wear', 'bags', 'hats','watches','jewelery','electronics','kids','furniture','books','cosmetics','health','toys','grocery','stationary'];
@endphp

<x-app-layout>
    <div class="space-y-4">

        <section class="flex items-center justify-between mx-auto">
            @foreach($categories as $category)
            @php
            $isActive = request('category') === $category;
            @endphp
            <a href="{{$isActive ?  route('products.browser.index') : url('/?category=' . $category)}}">
                <div class="border border-black px-4 py-2 transition-all {{$isActive ? 'bg-lime-300 shadow-[4px_4px_black]' : 'hover:shadow-[4px_4px_black]'}}">
                    {{ $category }}
                </div>
            </a>
            @endforeach
        </section>
        <section class="grid 2xl:grid-cols-4 grid-cols-4 gap-4">
            @foreach($products as $product)
            <a href="{{ route('products.browser.show', ['product' => $product->id]) }}">
                <x-primary-card class="pb-4" hoverable>
                    <img class="object-cover w-full h-48" src="{{$product->image}}" alt="{{$product->name}}" loading="lazy">
                    <div class="mt-2 px-4">
                        <h3 class="text-lg text-gray-800 uppercase dark:text-white leading-4 line-clamp-1">{{$product->name}}</h3>
                        <span class="text-lg font-bold">$ {{$product->price}}</span>
                    </div>
                </x-primary-card>
            </a>
            @endforeach
        </section>
        <section class="flex items-center w-fit mx-auto gap-2">
            <!-- previous page -->
            <a href="{{url('/?page=' . $pagination['prevPage'] ) }}" class="border border-black shadow-[4px_4px_black] hover:shadow-[5px_5px_black] transition-shadow py-2 px-4">
                < </a>
                    @for($i = 1; $i <= $pagination['totalPages']; $i++) <a href="{{url('/?page=' . $i ) }}" class="border border-black shadow-[4px_4px_black] hover:shadow-[5px_5px_black] transition-shadow py-2 px-4 {{ $pagination['page'] == $i ? 'bg-lime-300':'' }}">{{$i}}
            </a>@endfor
            <a href="{{url('/?page=' . $pagination['nextPage'] ) }}" class="border border-black shadow-[4px_4px_black] hover:shadow-[5px_5px_black] transition-shadow py-2 px-4">
                > </a>
        </section>
    </div>
</x-app-layout>