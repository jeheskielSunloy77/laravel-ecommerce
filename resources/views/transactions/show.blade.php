@section('title', 'Transaction Detail')
@props(['product'])

@php
$sessionStatus = session('status');
@endphp

<x-app-layout>
    <div class="space-y-10">
        <section class="space-y-3 px-40">
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
            <x-primary-button>View Product</x-primary-button>
            <x-secondary-button>Give Rating</x-secondary-button>
        </section>
    </div>
</x-app-layout>

@if ($sessionStatus)
@if ($sessionStatus === 'transaction created')
<script>
    swal('Transaction Success', 'Your transaction has been successfully created, You can check the transaction details here. Thank you for shopping with us.', 'success')
</script>
@elseif ($sessionStatus === 'transaction updated')
<script>
    swal('Transaction Updated', 'Your transaction has been successfully updated, Thank you for your input', 'success')
</script>
@endif
@endif