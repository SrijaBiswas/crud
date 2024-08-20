<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function showCart()
    {
        $cartItems = Cart::with('product')->get();

        return view('cart.show', [
            'cartItems' => $cartItems,
        ]);
    }

    public function addToCart(Product $product)
    {
        $cartItem = Cart::where('product_id', $product->id)->first();

        if ($cartItem) {
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            $cartItem = new Cart([
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
            $cartItem->save();
        }

        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }

    public function removeFromCart(Product $product)
    {
        $cartItem = Cart::where('product_id', $product->id)->first();
        
        if ($cartItem) {
            $cartItem->delete();
        }

        return redirect()->back()->with('success', 'Product removed from cart successfully.');
    }
    
}
