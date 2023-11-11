<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
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
        return redirect()->route('transactions.show', $transaction->id)->with('status', 'transaction created');
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('product');
        return view('transactions.show', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'review' => 'nullable|string|min:10'
        ]);
        $transaction->update([
            'rating' => $request->rating,
            'review' => $request->review
        ]);

        return redirect()->route('transactions.show', $transaction->id)->with('status', 'review submitted');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return back()->with('status', 'transaction deleted');
    }
}
