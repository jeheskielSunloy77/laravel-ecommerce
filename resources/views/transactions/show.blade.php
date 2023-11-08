@section('title', 'Transaction Detail')
@props(['product'])

@php
$sessionStatus = session('status');
@endphp

<x-app-layout>
    <div class="space-y-10">
        <section class="space-y-3 2xl:px-40 xl:px-32">
            <h4 class="text-xs font-bold">
                Product Details
            </h4>
            <div class="flex items-center justify-between">
                Product Name :
                <span>
                    {{$transaction->product->name}}
                </span>
            </div>
            <div class="flex items-center justify-between">
                Product Category :
                <span class="capitalize">
                    {{$transaction->product->category}}
                </span>
            </div>
            <div class="flex items-center justify-between">
                Product Price :
                <span>
                    <span class="font-bold text-red-700">$</span> {{$transaction->product->price}}
                </span>
            </div>
            <hr class="border-black">
            <h4 class="text-xs font-bold">
                Transaction Information
            </h4>
            <div class="flex items-center justify-between">
                Transaction Id :
                <span>
                    {{$transaction->id}}
                </span>
            </div>
            <div class="flex items-center justify-between">
                Transaction Date :
                <span>
                    {{$transaction->created_at->format('d M Y H:i')}}
                </span>
            </div>
            <div class="flex items-center justify-between">
                Rating
                <span>
                    @if($transaction->rating)
                    <span class="flex items-center text-red-700">
                        @for($i=0; $i<5;$i++) <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24">
                            <path fill="currentColor" d="{{ $transaction->rating <= $i ? 'm8.85 17.825l3.15-1.9l3.15 1.925l-.825-3.6l2.775-2.4l-3.65-.325l-1.45-3.4l-1.45 3.375l-3.65.325l2.775 2.425l-.825 3.575ZM5.825 22l1.625-7.025L2 10.25l7.2-.625L12 3l2.8 6.625l7.2.625l-5.45 4.725L18.175 22L12 18.275L5.825 22ZM12 13.25Z' : 'm5.825 22l1.625-7.025L2 10.25l7.2-.625L12 3l2.8 6.625l7.2.625l-5.45 4.725L18.175 22L12 18.275L5.825 22Z' }}" />
                            </svg>
                            @endfor
                    </span>
                    @else
                    Not Rated
                    @endif
                </span>
            </div>
            <div class="flex items-center justify-between">
                Payment Method :
                <span>
                    Manual
                </span>
            </div>
            <div class="flex items-center justify-between">
                Payment Date :
                <span>
                    {{$transaction->created_at->format('d M Y H:i')}}
                </span>
            </div>
            <div class="flex items-center justify-between">
                Purchase Quantity :
                <span>
                    {{$transaction->quantity}}
                </span>
            </div>
            <hr class="border-black">
            <div class="flex items-center justify-between font-bold">
                Total Price :
                <span>
                    <span class="text-red-700">$</span> {{$transaction->product->price * $transaction->quantity}}
                </span>
            </div>
        </section>
        <section class="flex items-center gap-4">
            <a href="{{ route('products.browser.show',$transaction->product->id) }}">
                <x-primary-button>View Product</x-primary-button>
            </a>
            <a href="{{ route('transactions.show',['transaction'=>$transaction->id,'review'=>'true']) }}">
                <x-secondary-button>Give Review</x-secondary-button>
            </a>
            @if(request('review')==='true')
            <x-modal name="product-review" :show="true" focusable>
                <form method="post" action="{{route('transactions.update',$transaction->id) }}" class="p-6 space-y-4">
                    @csrf
                    @method('PUT')
                    <div class="space-y-1">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            Product Review
                        </h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Please give your rating for this product, your rating will be used to improve our product quality and for other user reference. Thank you for your input.
                        </p>
                    </div>
                    <div>
                        <x-input-label for="rating">
                            Rating
                        </x-input-label>
                        <input type="number" class="hidden" id="rating" name="rating" value="{{$transaction->rating}}">
                        <span class="flex items-center text-red-700">
                            @for($i=0; $i<5;$i++) <svg id="rating-star-{{$i+1}}" xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 cursor-pointer hover:text-red-600" viewBox="0 0 24 24">
                                <path fill="currentColor" d="{{ $transaction->rating <= $i ? 'm8.85 17.825l3.15-1.9l3.15 1.925l-.825-3.6l2.775-2.4l-3.65-.325l-1.45-3.4l-1.45 3.375l-3.65.325l2.775 2.425l-.825 3.575ZM5.825 22l1.625-7.025L2 10.25l7.2-.625L12 3l2.8 6.625l7.2.625l-5.45 4.725L18.175 22L12 18.275L5.825 22ZM12 13.25Z' : 'm5.825 22l1.625-7.025L2 10.25l7.2-.625L12 3l2.8 6.625l7.2.625l-5.45 4.725L18.175 22L12 18.275L5.825 22Z' }}" />
                                </svg>
                                @endfor
                        </span>
                        <x-input-error :messages="$errors->get('rating')" class="mt-1" />
                    </div>
                    <x-text-field label="Review" id="review" required name="review" placeholder="This product is very good, I like it very much. I will buy it again in the future." rows="4" :errors="$errors->get('review')" isTextArea />

                    <div class="flex justify-end gap-4">
                        <a href="{{ route('transactions.show',$transaction->id) }}">
                            <x-secondary-button x-on:click="$dispatch('close')" type="button">
                                Cancel
                            </x-secondary-button>
                        </a>
                        <x-primary-button type="submit">
                            Submit
                        </x-primary-button>
                    </div>
                </form>
            </x-modal>
            <script>
                const rating = document.getElementById('rating');
                const ratingStars = document.querySelectorAll('[id^="rating-star-"]');
                ratingStars.forEach((star) => {
                    star.addEventListener('click', () => {
                        rating.setAttribute('value', star.id.split('-')[2]);
                        ratingStars.forEach((s) =>
                            s.children[0].setAttribute('d', 'm8.85 17.825l3.15-1.9l3.15 1.925l-.825-3.6l2.775-2.4l-3.65-.325l-1.45-3.4l-1.45 3.375l-3.65.325l2.775 2.425l-.825 3.575ZM5.825 22l1.625-7.025L2 10.25l7.2-.625L12 3l2.8 6.625l7.2.625l-5.45 4.725L18.175 22L12 18.275L5.825 22ZM12 13.25Z')
                        );
                        for (let i = 0; i < rating.value; i++) {
                            document.querySelector(`[id^="rating-star-${i+1}"]`).children[0].setAttribute('d', 'm5.825 22l1.625-7.025L2 10.25l7.2-.625L12 3l2.8 6.625l7.2.625l-5.45 4.725L18.175 22L12 18.275L5.825 22Z')
                        }
                    });
                });
            </script>
            @endif
        </section>
    </div>
</x-app-layout>

@if ($sessionStatus)
@if ($sessionStatus === 'transaction created')
<script>
    swal('Transaction Success', 'Your transaction has been successfully created, You can check the transaction details here. Thank you for shopping with us.', 'success')
</script>
@elseif ($sessionStatus === 'review submitted')
<script>
    swal('Review Submitted', 'Your review has been successfully submitted, Thank you for your review.', 'success')
</script>
@endif
@endif