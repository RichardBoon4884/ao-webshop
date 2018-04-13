<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    public function index(Request $request)
    {
        // Check if there is a shopping cart in the session
        if ($request->session()->has('shoppingCartItems')) {
            $shoppingCart = $request->session()->get('shoppingCartItems');
        } else { // There is no shopping cart in the session
            $shoppingCart = [];
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
        // Check if there is a shopping cart in the session
        if ($request->session()->has('shoppingCartItems')) {
            $shoppingCart = $request->session()->get('shoppingCartItems');
        } else { // There is no shopping cart in the session
            $shoppingCart = [];
        }

        // Check if product is in the shopping cart
        if (($key = $this->searchShoppingCart($shoppingCart, $productId)) !== null) {var_dump($key);
            // Check if there is a amount, otherwise increase amount
            isset($amount) ? $shoppingCart[$key]->amount = $amount : $shoppingCart[$key]->amount++;
        } else { // Product is not in shopping cart, add it
            $product = Product::find($productId);
            // Check if there is a amount, otherwise set to 1
            isset($amount) ? $product->amount = $amount : $product->amount = 1;

            array_push($shoppingCart, $product);
            end($shoppingCart);
            $key = key($shoppingCart);
        }

        // Check if product amount is 0, then unset it
        if ($shoppingCart[$key]->amount === 0) {
            unset($shoppingCart[$key]);
        }

        // Save shopping cart to the session, and redirect.
        $request->session()->put('shoppingCartItems', $shoppingCart);
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