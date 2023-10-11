@extends('layout')

@section('title', $product->name )

@section('content')
<div class="md:flex md:items-center">
    <div class="w-full h-64 md:w-1/2 lg:h-96 "><img class="h-full w-full rounded-md object-cover max-w-lg mx-auto" src="{{$product->image}}" alt="{{$product->name}}"></div>
    <div class="w-full max-w-lg mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2 lg:py-12">
        <h3 class="text-3xl leading-7 mb-2 font-bold uppercase lg:text-5xl">{{$product->name}}</h3><span class="text-2xl leading-7 font-bold mt-3">${{$product->price}}</span>
        <div class="mt-8"><label class="text-1xl" for="count">Count:</label>
            <div class="flex items-center mt-4"><button class="border border-black w-36 h-12 text-gray-500 focus:outline-none focus:text-gray-600">
                    <div class="flex justify-center">
                        <div><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg></div>
                    </div>
                </button><span class="text-2xl mx-2">1</span><button class="border border-black w-36 h-12 text-gray-500 focus:outline-none focus:text-gray-600">
                    <div class="flex justify-center">
                        <div><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6"></path>
                            </svg></div>
                    </div>
                </button></div>
        </div>
        <div class="mt-12 flex flex-row justify-between "><button class="border p-2 mb-8 border-black shadow-offset-lime w-2/3 font-bold">Add to Shopping Cart</button><button class="-mt-8">
                <div><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg></div>
            </button></div>
    </div>
</div>
<h3 class="text-gray-600 text-2xl font-medium">Description</h3>
<p>{{$product->description}}</p>
@endsection