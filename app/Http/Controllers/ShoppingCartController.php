<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    public function index(Request $request)
    {
        // Check if there is a shopping cart in the session
        if ($request->session()->has('shoppingCart')) {
            $shoppingCart = $request->session()->get('shoppingCart');
        } else { // There is no shopping cart in the session
            $shoppingCart = (object) [];
            $shoppingCart->products = [];
            $shoppingCart->total = 0;
        }

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
        // Check if there is a shopping cart array in the session
        if ($request->session()->has('shoppingCart')) {
            $shoppingCart = $request->session()->get('shoppingCart');
        } else { // There is no shopping cart array in the session
            $shoppingCart = (object) [];
            $shoppingCart->products = [];
        }
        $shoppingCart->total = 0;

        // Check if product is in the shopping cart
        if (($key = $this->searchShoppingCart($shoppingCart->products, $productId)) !== null) {
            // Check if there is a amount given and set it, otherwise increase amount by one
            isset($amount) ? $shoppingCart->products[$key]->amount = $amount : $shoppingCart->products[$key]->amount++;
        } else { // Product is not in shopping cart, add it
            $product = Product::find($productId);
            // Check if there is a amount given and set it, otherwise set to 1
            isset($amount) ? $product->amount = $amount : $product->amount = 1;

            array_push($shoppingCart->products, $product);
            end($shoppingCart->products);
            $key = key($shoppingCart->products);
        }

        // Check if product amount is 0, then unset it
        if ($shoppingCart->products[$key]->amount === 0) {
            unset($shoppingCart->products[$key]);
        }

        // Som the total
        foreach ($shoppingCart->products as $product) {
            $shoppingCart->total = $shoppingCart->total + $product->price * $product->amount;
        }

        // Save shopping cart to the session, and redirect.
        $request->session()->put('shoppingCart', $shoppingCart);
        return redirect()->route('shoppingCartIndex');
    }

    private function searchShoppingCart(array $shoppingCart, int $productId)
    {
        foreach ($shoppingCart as $key => $shoppingCartItem) {
            if ($shoppingCartItem->id === $productId) {
                return $key;
            }
        }
        return null;
    }
}