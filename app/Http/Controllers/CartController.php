<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;


class CartController extends Controller
{
    //
    function index()
    {
        $cart = session()->get('cart');
        return view('cart.index', ['cart' => $cart]);
    }

    function addToCart($id, Request $request)
    {
        $cart = session()->get('cart');
        $product = Product::find($id);
        if (!$cart) {
            $cart = [];
        }
        foreach ($cart as $key => $value) {
            if ($value['id'] == $id) {
                $cart[$key]['quantity'] += 1;
                session()->put('cart', $cart);
                return response()->json(['message' => 'Product added to cart', 'cart' => $cart]);
            }
        }
        $newItem = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'image' => $product->image
        ];
        array_push($cart, $newItem);
        session()->put('cart', $cart);
        return response()->json(['message' => 'Product added to cart', 'cart' => $cart]);
    }

    function cartCount()
    {
        $cart = session()->get('cart');
        if (isset($cart)) {
            $count = count($cart);
        } else {
            $count = 0;
        }
        return response()->json(['count' => $count]);
    }

    function updateCart(Request $request)
    {
        // get product id and quantity from request
        $id = $request->id;
        $quantity = $request->quantity;
        $cart = session()->get('cart');
        // check if product is in cart
        foreach ($cart as $key => $value) {
            if ($value['id'] == $id) {
                // check quantity valid
                if ($quantity <= 0) {
                    return response()->json(['message' => 'Quantity must be greater than 0'], 400);
                }
                // check quantity in stock
                if ($quantity > Product::find($id)->stock) {
                    return response()->json(['message' => 'Quantity must be less than stock'], 400);
                }
                $cart[$key]['quantity'] = $quantity;
                session()->put('cart', $cart);
                return response()->json(['message' => 'Product updated in cart'], 200);
            }
        }
    }

    function deleteCart($id)
    {
        $cart = session()->get('cart');
        foreach ($cart as $key => $value) {
            if ($value['id'] == $id) {
                unset($cart[$key]);
                session()->put('cart', $cart);
                return response()->json(['message' => 'Product removed from cart'], 200);
            }
        }
    }

    function deleteAllCart()
    {
        session()->forget('cart');
        return redirect()->route('home.index');
    }
}