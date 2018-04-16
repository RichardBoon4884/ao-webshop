<?php

namespace App\Http\Controllers;

use App\Classes\ShoppingCart;
use App\Models\Product;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    public function index(Request $request)
    {
        $shoppingCart = new ShoppingCart($request);

        return view('shopping_cart.index', ['shoppingCart' => $shoppingCart]);
    }

    /*
     * Update a item to the shopping cart
     *
     * Amount 0         : Will delete the product
     * Amount null      : Will increase the product by one or add it
     * Amount [number]  : Will set the amount to this number
     */
    public function update(Request $request, int $productId, int $amount = null)
    {
        $shoppingCart = new ShoppingCart($request);

        $shoppingCart->updateProduct(Product::find($productId), $amount);

        return redirect()->route('shoppingCartIndex');
    }
}