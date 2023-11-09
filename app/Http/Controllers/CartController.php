<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('carts.index')->with([
            'carts' => auth()->user()->carts,
        ]);
    }

    public function store(Request $request)
    {
        Cart::create([
            'user_id' => auth()->id(),
            'product_id' => $request->query('product_id'),
            'quantity' => $request->query('quantity') ?? 1,
        ]);
        return back()->with('status', 'added to cart');
    }

    public function update(Request $request, Cart $cart)
    {
        $body = $request->validate([
            'quantity' => 'required|numeric|min:1',
        ]);

        $cart->update($body);
        return redirect()->route('carts.index');
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return back()->with('status', 'removed from cart');
    }
}
