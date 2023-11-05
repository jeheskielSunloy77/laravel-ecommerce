<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $transactions = null;

        if ($request->query('search')) {
            $transactions = Transaction::where('user_id', auth()->user()->id)->whereHas('product', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->query('search') . '%');
            })->orderBy('created_at', 'desc')->get();
        } else {
            $transactions = Transaction::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
        }

        return view('transactions.index', compact('transactions'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|numeric|min:1'
        ]);

        $transaction = Transaction::create([
            'id' => Str::uuid(),
            'user_id' => auth()->user()->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity
        ]);

        $cartId = $request->query('cart_id');

        if ($cartId) {
            Cart::find($cartId)->delete();
        }

        return redirect()->route('transactions.show', $transaction->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        $transaction->load('product');
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        Auth::logoutOtherDevices(auth()->user()->password);

        return back();
    }
}
