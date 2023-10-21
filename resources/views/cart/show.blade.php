@section('title', 'Cart')

@section('content')
<div class="">
    @foreach ($carts as $cart)
    <div class="">
        {{ $cart->product->name }}
        {{ $cart->product->price }}
        {{ $cart->quantity }}
    </div>
    @endforeach
</div>
@endsection