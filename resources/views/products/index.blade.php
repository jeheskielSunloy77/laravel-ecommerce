@extends('layout')

@section('title', 'Products List')

@php
$categories = ['clothes', 'shoes', 'sports wear', 'bags', 'hats','watches','jewelery','electronics','kids','furniture','books','cosmetics','health','toys','grocery','stationary'];
@endphp

@section('content')
<div class="flex items-center justify-between mx-auto mb-4">
    @foreach($categories as $category)
    <a href="{{url('/products?category=' . $category)}}">
        <div class="border border-black px-4 py-2 transition-all {{request('category') == $category ? 'bg-lime-300 shadow-[4px_4px_black]' : 'hover:shadow-[4px_4px_black]'}}">
            {{ $category }}
        </div>
    </a>
    @endforeach
</div>
<div class="grid 2xl:grid-cols-4 grid-cols-4 gap-4">
    @foreach($products as $product)
    <a href="{{ url('/products/' . $product->id ) }}">
        <div class="pb-4 border border-black shadow-[4px_4px_#000] hover:shadow-[6px_6px_#000] transition-shadow">
            <img class="object-cover w-full h-48" src="{{$product->image}}" alt="{{$product->name}}" loading="lazy">
            <div class="mt-2 px-4">
                <h3 class="text-lg text-gray-800 uppercase dark:text-white leading-4 line-clamp-1">{{$product->name}}</h3>
                <span class="text-lg font-bold">$ {{$product->price}}</span>
            </div>
        </div>
    </a>
    @endforeach
</div>
@endsection