<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        return view('wishlists.index')->with([
            'wishlists' => auth()->user()->wishlists,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
        ]);
        Wishlist::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
        ]);
        return back();
    }

    public function destroy(Wishlist $wishlist)
    {
        $wishlist->delete();
        return back();
    }
}
