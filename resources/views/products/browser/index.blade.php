@section('title', 'Products')

@php
$categories = ['clothes', 'shoes', 'sports wear', 'bags', 'hats','watches','jewelery','electronics','kids','furniture','books','cosmetics','health','toys','grocery','stationary'];
@endphp

<x-app-layout>
    <div class="flex items-center justify-between mx-auto mb-4">
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
    </div>
    <div class="grid 2xl:grid-cols-4 grid-cols-4 gap-4">
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
    </div>
</x-app-layout>