<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function carts(User $user)
    {
        $carts = $user->carts()->with('product')->get();
        redirect()->route('cart.show', ['cart' => $carts]);
    }
}
