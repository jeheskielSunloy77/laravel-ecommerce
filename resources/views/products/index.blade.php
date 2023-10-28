@extends('layout')

@section('title', 'Products List')

@section('content')
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