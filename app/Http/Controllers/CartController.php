<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Show form to enter quantity
    public function create($product_id)
    {
        $product = Product::findOrFail($product_id);
        return view('cart.create', compact('product'));
    }

    // Store cart item
    public function store(Request $request, $product_id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $product_id,
            'quantity' => $request->quantity
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product added to cart successfully');
    }

    // Show cart page
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return view('cart.index', compact('cartItems'));
    }
}
