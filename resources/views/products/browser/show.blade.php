@props(['product', 'relatedProducts'])
@section('title', $product->name . ' | Product Details' )

@php
$isAuthed = auth()->check();
$isWishlisted = $isAuthed ? auth()->user()->wishlists->where('product_id', $product->id)->first() : null;
$isCarted = $isAuthed ? auth()->user()->carts->where('product_id', $product->id)->first() : null;

$sessionStatus = session('status');
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
                        <x-icon-cart class="text-red-700" />
                        {{$transactionsCount}} Transactions
                    </span>
                    <span class="flex items-center text-red-700">
                        @for($i=0; $i
                        <5;$i++) @if($rating <=$i) <x-icon-star class="mb-1" />
                        @else
                        <x-icon-filed-star class="mb-1" />
                        @endif
                        @endfor
                    </span>

                </div>
                <div class="mt-8"><label class="text-1xl" for="count">Count:</label>
                    <div class="flex items-center mt-4 gap-4">
                        <button onclick="changeQuantity('add')" class="flex items-center justify-center border border-black w-36 h-12 text-black transition-shadow hover:shadow-[4px_4px_black]">
                            <span class="text-2xl">+</span>
                        </button>
                        <span id="display-quantity" class="font-bold">1</span>
                        </span>
                        <button onclick="changeQuantity('remove')" class="flex items-center justify-center border border-black w-36 h-12 text-black transition-shadow hover:shadow-[4px_4px_black]">
                            <span class="text-4xl">-</span>
                        </button>
                    </div>
                </div>
                <div class="mt-12 flex flex-row justify-between">
                    <form action="{{route('transactions.store', [
                            'product_id' => $product->id,
                        ])
                    }}" method="POST">
                        @csrf
                        <input type="hidden" name="quantity" id="quantity" value="1">
                        <x-primary-button type="submit">Buy Now</x-primary-button>
                    </form>
                    <div class="flex items-center gap-2">
                        @if($isCarted)
                        <div>
                            <form action="{{ route('carts.destroy', $isCarted->id ) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button title="remove from cart" type="submit" class="p-1.5 border border-black transition-all hover:shadow-[5px_5px_black] shadow-[4px_4px_black] bg-lime-300">
                                    <x-icon-not-cart />
                                </button>
                            </form>
                        </div>
                        @else
                        <form action="{{ route('carts.store', ['product_id' => $product->id ]) }}" method="POST">
                            @csrf
                            <input type="hidden" name="quantity" id="quantity" value="1">
                            <button title="add to cart" type="submit" class="p-1.5 border border-black transition-all shadow-[4px_4px_black] hover:bg-lime-300">
                                <x-icon-cart />
                            </button>

                        </form>
                        @endif
                        <form action="{{ $isWishlisted ? route('wishlists.destroy', $isWishlisted->id) : route('wishlists.store', ['product_id' => $product->id ]) }}" method="POST">
                            @csrf
                            @if($isWishlisted)
                            @method('DELETE')
                            @endif
                            <button title="{{ $isWishlisted ? 'remove from wishlist' : 'add to wishlist'}}" type="submit" class="p-1.5 border border-black transition-all shadow-[4px_4px_black] {{ $isWishlisted ? 'hover:shadow-[5px_5px_black] bg-lime-300' : 'hover:bg-lime-300'}}">
                                @if($isWishlisted)
                                <x-icon-not-heart />
                                @else
                                <x-icon-heart />
                                @endif
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
                                    @for($i=0; $i
                                    <5;$i++) @if($rating <=$i) <x-icon-star size="w-4 h-4" />
                                    @else
                                    <x-icon-filed-star size="w-4 h-4" />
                                    @endif
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

<script>
    const quantity = document.querySelectorAll('#quantity');
    const displayQuantity = document.getElementById('display-quantity');

    function changeQuantity(direction) {
        const isAdd = direction === 'add';
        if (!isAdd && +quantity[0].value === 1) return;

        quantity.forEach(q => q.value = isAdd ? +q.value + 1 : +q.value - 1);
        displayQuantity.innerHTML = quantity[0].value;
    }
</script>

@if ($sessionStatus)
@if ($sessionStatus === 'added to cart')
<script>
    swal({
            title: "Added to Cart",
            text: "Product added to cart successfully",
            icon: "success",
            buttons: {
                cancel: {
                    value: null,
                    text: 'Ok',
                    visible: true,
                },
                confirm: {
                    value: true,
                    text: 'Go to Cart',
                }

            }
        })
        .then((value) => value && (window.location.href = "{{ route('carts.index') }}"));
</script>
@elseif ($sessionStatus === 'removed from cart')
<script>
    swal("Removed from Cart", "Product removed from cart successfully", "success");
</script>
@endif
@endif