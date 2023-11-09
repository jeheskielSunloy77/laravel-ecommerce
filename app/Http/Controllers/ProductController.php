<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = null;

        if ($request->query('search')) {
            $products = Product::where('name', 'like', '%' . $request->query('search') . '%')->get();
        } elseif ($request->query('category')) {
            $products = Product::where('category', $request->query('category'))->get();
        } else {
            $products = Product::all();
        }

        return view('products.index', compact('products'));
    }
    public function browserIndex(Request $request)
    {
        $products = null;
        $total = null;

        $page = $request->query('page') ? $request->query('page') : 1;
        $pageSize = $request->query('pageSize') ? $request->query('pageSize') : 20;
        $offset = ($page - 1) * $pageSize;

        if ($request->query('search')) {
            $query = Product::where('name', 'like', '%' . $request->query('search') . '%');

            $products = $query->offset($offset)->limit($pageSize)->with('transactions')->get();
            $total = $query->count();
        } elseif ($request->query('category')) {
            $query = Product::where('category', $request->query('category'));

            $products = $query->offset($offset)->limit($pageSize)->with('transactions')->get();
            $total = $query->count();
        } else {
            $products = Product::offset($offset)->limit($pageSize)->with('transactions')->get();
            $total = Product::count();
        }

        $totalPages = ceil($total / $pageSize);
        $nextPage = $page < $totalPages ? $page + 1 : null;
        $prevPage = $page > 1 ? $page - 1 : null;

        $pagination = [
            'total' => $total,
            'totalPages' => $totalPages,
            'nextPage' => $nextPage,
            'prevPage' => $prevPage,
            'page' => $page,
            'pageSize' => $pageSize,
        ];

        return view('products.browser.index', compact('products', 'pagination'));
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
        //

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product = Product::find($product->id);
        return view('products.show', compact('product'));
    }
    public function browserShow(Product $product)
    {
        $product = Product::find($product->id);
        $relatedProducts = Product::where('category', $product->category)->limit(4)->with('transactions')->get();
        $rating = 0;
        $transactionsCount = $product->transactions->count();

        foreach ($product->transactions as $transaction) {
            $rating += $transaction->rating;
        }
        $rating && $rating = round($rating / $transactionsCount);

        return view('products.browser.show', compact(
            'product',
            'relatedProducts',
            'rating',
            'transactionsCount'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $product = Product::find($product->id);
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|min:3|max:100',
            'category' => 'required|string|in:clothes,shoes,sports wear,bags,hats,watches,jewelery,electronics,kids,furniture,books,cosmetics,health,toys,grocery,stationary',
            'description' => 'required|min:20',
        ]);

        $product->update([
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('status', 'product updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->back()->with('status', 'product deleted');
    }
}
