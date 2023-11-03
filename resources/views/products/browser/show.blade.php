@props(['product', 'relatedProducts'])
@section('title', $product->name . ' | Product Details' )

@php
$isAuthed = auth()->check();
$isWishlisted = $isAuthed ? auth()->user()->wishlists->where('product_id', $product->id)->first() : null;
$isCarted = $isAuthed ? auth()->user()->carts->where('product_id', $product->id)->first() : null;
@endphp

<x-app-layout>
    <div class="space-y-4">
        <section class="md:flex md:items-center">
            <div class="w-full h-64 md:w-1/2 lg:h-96 "><img class="h-full w-full rounded-sm object-cover max-w-lg mx-auto" src="{{$product->image}}" alt="{{$product->name}}" loading="lazy"></div>
            <div class="w-full max-w-lg mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2 lg:py-12">
                <h3 class="text-3xl leading-7 mb-2 font-bold uppercase lg:text-5xl">{{$product->name}}</h3>
                <div class="flex items-center gap-4 text-lg">
                    <span class="font-bold text-2xl leading-7"> <span class="text-red-700">$</span> {{$product->price}}</span>
                    <span class="flex items-center gap-1 font-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-700" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M7 22q-.825 0-1.413-.588T5 20q0-.825.588-1.413T7 18q.825 0 1.413.588T9 20q0 .825-.588 1.413T7 22Zm10 0q-.825 0-1.413-.588T15 20q0-.825.588-1.413T17 18q.825 0 1.413.588T19 20q0 .825-.588 1.413T17 22ZM6.15 6l2.4 5h7l2.75-5H6.15ZM5.2 4h14.75q.575 0 .875.513t.025 1.037l-3.55 6.4q-.275.5-.738.775T15.55 13H8.1L7 15h12v2H7q-1.125 0-1.7-.988t-.05-1.962L6.6 11.6L3 4H1V2h3.25l.95 2Zm3.35 7h7h-7Z" />
                        </svg>
                        {{$transactionsCount}} Transactions
                    </span>
                    <span class="flex items-center text-red-700">
                        @for($i=0; $i<5;$i++) <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mb-1" viewBox="0 0 24 24">
                            <path fill="currentColor" d="{{ $rating <= $i ? 'm8.85 17.825l3.15-1.9l3.15 1.925l-.825-3.6l2.775-2.4l-3.65-.325l-1.45-3.4l-1.45 3.375l-3.65.325l2.775 2.425l-.825 3.575ZM5.825 22l1.625-7.025L2 10.25l7.2-.625L12 3l2.8 6.625l7.2.625l-5.45 4.725L18.175 22L12 18.275L5.825 22ZM12 13.25Z' : 'm5.825 22l1.625-7.025L2 10.25l7.2-.625L12 3l2.8 6.625l7.2.625l-5.45 4.725L18.175 22L12 18.275L5.825 22Z' }}" />
                            </svg>
                            @endfor
                    </span>

                </div>
                <div class="mt-8"><label class="text-1xl" for="count">Count:</label>
                    <div class="flex items-center mt-4">
                        <a href="{{ route('products.browser.show', ['product' => $product->id, 'add_count' => request('add_count') ? request('add_count') + 1 : 2]) }}">
                            <button class="border border-black w-36 h-12 text-black transition-shadow hover:shadow-[4px_4px_black]">
                                <div class="flex justify-center">
                                    <div><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg></div>
                                </div>
                            </button>
                        </a>
                        <span class="text-2xl mx-2">
                            {{ request('add_count') ? request('add_count') :'1' }}
                        </span>
                        <a href="{{route('products.browser.show', ['product' => $product->id, 'add_count' => request('add_count') ? request('add_count') - 1 : 0])}}">
                            <button class="border border-black w-36 h-12 text-black transition-shadow hover:shadow-[4px_4px_black]">
                                <div class="flex justify-center">
                                    <div><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6"></path>
                                        </svg></div>
                                </div>
                            </button>
                        </a>
                    </div>
                </div>
                <div class="mt-12 flex flex-row justify-between">
                    <form action="{{route('transactions.store', [
                            'product_id' => $product->id,
                            'quantity' => request('add_count') ? request('add_count') : 1
                        ])
                    }}" method="POST">
                        @csrf
                        <x-primary-button type="submit">Buy Now</x-primary-button>
                    </form>
                    <div class="flex items-center gap-2">
                        @if($isCarted)
                        <div>
                            <form action="{{ url('/carts/' . $isCarted->id ) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button title="remove from cart" type="submit" class="p-1.5 border border-black transition-all hover:shadow-[5px_5px_black] shadow-[4px_4px_black] bg-lime-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="m15.825 13l-2-2h1.725l2.75-5H8.825l-2-2H19.95q.575 0 .888.488t.012 1.062l-3.55 6.4q-.275.5-.713.775t-.762.275ZM7 22q-.825 0-1.413-.588T5 20q0-.825.588-1.413T7 18q.825 0 1.413.588T9 20q0 .825-.588 1.413T7 22Zm13.5 1.3L14.15 17H7.6q-1.1 0-1.675-.938T5.85 14.1l1.05-2.15L5.1 7.9L.7 3.5l1.4-1.4l19.8 19.8l-1.4 1.4ZM12.15 15l-2-2H8.6l-1 2h4.55Zm3.4-4h-1.725h1.725ZM17 22q-.825 0-1.413-.588T15 20q0-.825.588-1.413T17 18q.825 0 1.413.588T19 20q0 .825-.588 1.413T17 22Z" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                        @else
                        <form action="{{ url('/carts?product_id=' . $product->id . '&quantity=' . request('add_count') ) }}" method="post">
                            @csrf
                            <button title="add to cart" type="submit" class="p-1.5 border border-black transition-all shadow-[4px_4px_black] hover:bg-lime-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M11 9V6H8V4h3V1h2v3h3v2h-3v3h-2ZM7 22q-.825 0-1.413-.588T5 20q0-.825.588-1.413T7 18q.825 0 1.413.588T9 20q0 .825-.588 1.413T7 22Zm10 0q-.825 0-1.413-.588T15 20q0-.825.588-1.413T17 18q.825 0 1.413.588T19 20q0 .825-.588 1.413T17 22ZM1 4V2h3.275l4.25 9h7l3.9-7H21.7l-4.4 7.95q-.275.5-.738.775T15.55 13H8.1L7 15h12v2H7q-1.125 0-1.713-.975T5.25 14.05L6.6 11.6L3 4H1Z" />
                                </svg>
                            </button>

                        </form>
                        @endif
                        <form action="{{ $isWishlisted ? url('/wishlists/' . $isWishlisted->id) : url('/wishlists?product_id=' . $product->id) }}" method="post">
                            @csrf
                            @if($isWishlisted)
                            @method('DELETE')
                            @endif
                            <button title="{{ $isWishlisted ? 'remove from wishlist' : 'add to wishlist'}}" type="submit" class="p-1.5 border border-black transition-all shadow-[4px_4px_black] {{ $isWishlisted ? 'hover:shadow-[5px_5px_black] bg-lime-300' : 'hover:bg-lime-300'}}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="{{ $isWishlisted ? 'M11 11.475ZM11 21l-3.175-2.85q-1.8-1.625-3.088-2.9t-2.125-2.4q-.837-1.125-1.225-2.175T1 8.475q0-2.35 1.575-3.913T6.5 3q1.3 0 2.475.55T11 5.1q.85-1 2.025-1.55T15.5 3q2.1 0 3.825 1.475t1.725 4q0 .35-.05.738t-.15.787h-2.125q.125-.45.2-.85T19 8.4q0-1.875-1.25-2.638T15.5 5q-1.275 0-2.2.688T11.575 7.5h-1.15Q9.65 6.375 8.662 5.687T6.5 5q-1.425 0-2.463.988T3 8.474q0 .825.35 1.675t1.25 1.963q.9 1.112 2.45 2.6T11 18.3q.65-.575 1.525-1.325t1.4-1.25l.225.225l.488.488l.487.487l.225.225q-.55.5-1.4 1.238t-1.5 1.312L11 21Zm4-7v-2h8v2h-8Z' :  'm12 21l-1.45-1.3q-2.525-2.275-4.175-3.925T3.75 12.812Q2.775 11.5 2.388 10.4T2 8.15Q2 5.8 3.575 4.225T7.5 2.65q1.3 0 2.475.55T12 4.75q.85-1 2.025-1.55t2.475-.55q2.35 0 3.925 1.575T22 8.15q0 1.15-.388 2.25t-1.362 2.412q-.975 1.313-2.625 2.963T13.45 19.7L12 21Zm0-2.7q2.4-2.15 3.95-3.688t2.45-2.674q.9-1.138 1.25-2.026T20 8.15q0-1.5-1-2.5t-2.5-1q-1.175 0-2.175.662T12.95 7h-1.9q-.375-1.025-1.375-1.688T7.5 4.65q-1.5 0-2.5 1t-1 2.5q0 .875.35 1.763t1.25 2.025q.9 1.137 2.45 2.675T12 18.3Zm0-6.825Z' }}" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <section class="space-y-2">
            <h3 class="text-2xl font-medium">Description</h3>
            <p>{{$product->description}}</p>
        </section>
        <section class="space-y-2">
            <h3 class="text-2xl font-medium">Related Products</h3>
            <div class="grid grid-cols-4 gap-4">
                @foreach($relatedProducts as $relatedProduct)

                @php
                $rating = 0;
                foreach ($relatedProduct->transactions as $transaction) {
                $rating += $transaction->rating;
                }
                $rating && $rating= round($rating / $relatedProduct->transactions->count());

                @endphp

                <a href="{{ route('products.browser.show', ['product' => $relatedProduct->id]) }}">
                    <x-primary-card class="pb-4" hoverable>
                        <img class="object-cover w-full h-48" src="{{$relatedProduct->image}}" alt="{{$relatedProduct->name}}" loading="lazy">
                        <div class="mt-2 px-4">
                            <h3 class="text-lg text-gray-800 uppercase dark:text-white leading-4 line-clamp-1">{{$relatedProduct->name}}</h3>
                            <div class="flex items-center gap-4 text-lg">
                                <span class="font-bold"> <span class="text-red-700">$</span> {{$relatedProduct->price}}</span>
                                <span class="flex items-center text-red-700">
                                    @for($i=0; $i<5;$i++) <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="{{ $rating <= $i ? 'm8.85 17.825l3.15-1.9l3.15 1.925l-.825-3.6l2.775-2.4l-3.65-.325l-1.45-3.4l-1.45 3.375l-3.65.325l2.775 2.425l-.825 3.575ZM5.825 22l1.625-7.025L2 10.25l7.2-.625L12 3l2.8 6.625l7.2.625l-5.45 4.725L18.175 22L12 18.275L5.825 22ZM12 13.25Z' : 'm5.825 22l1.625-7.025L2 10.25l7.2-.625L12 3l2.8 6.625l7.2.625l-5.45 4.725L18.175 22L12 18.275L5.825 22Z' }}" />
                                        </svg>
                                        @endfor
                                </span>
                            </div>
                        </div>
                    </x-primary-card>
                </a>
                @endforeach
            </div>
        </section>
    </div>

</x-app-layout>