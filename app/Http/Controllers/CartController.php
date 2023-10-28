<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('carts.index')->with([
            'carts' => auth()->user()->carts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Cart::create([
            'user_id' => auth()->id(),
            'product_id' => $request->query('product_id'),
            'quantity' => $request->query('quantity') ?? 1,
        ]);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        // get all of the cart items for the user
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        $body = $request->validate([
            'quantity' => 'required|numeric|min:1',
        ]);

        $cart->update($body);
        return redirect()->route('carts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return back();
    }
}
