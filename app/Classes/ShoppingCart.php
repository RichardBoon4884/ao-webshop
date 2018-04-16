<?php

namespace App\Classes;


use App\Models\Product;
use Illuminate\Http\Request;

class ShoppingCart
{
    protected $products = [];
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;

        // Check if there is already a shopping cart, if not create one
        if ($request->session()->has('shoppingCart')) {
            $shoppingCart = $request->session()->get('shoppingCart');

            $this->products = $shoppingCart->products;
        } else {
            $this->saveToSession();
        }
    }

    /*
     * Update a item to the shopping cart
     *
     * Amount 0         : Will delete the product
     * Amount null      : Will increase the product by one or add it
     * Amount [number]  : Will set the amount to this number
     */
    public function updateProduct(Product $product, int $amount = null)
    {
        // Check if product is in the shopping cart
        if (($key = $this->searchShoppingCart($this->products, $product->id)) !== null) {
            // Check if there is a amount given and set it, otherwise increase amount by one
            isset($amount) ? $this->products[$key]->amount = $amount : $this->products[$key]->amount++;
        } else { // Product is not in shopping cart, add it
            // Check if there is a amount given and set it, otherwise set to 1
            isset($amount) ? $product->amount = $amount : $product->amount = 1;

            array_push($this->products, $product);
            end($this->products);
            $key = key($this->products);
        }

        // Check if product amount is 0, then unset it
        if ($this->products[$key]->amount === 0) {
            unset($this->products[$key]);
        }

        $this->saveToSession();
    }

    public function getTotalPrice()
    {
        $total = 0.00;
        foreach ($this->products as $product) {
            $total = $total + $product->price * $product->amount;
        }

        return $total;
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function emptyShoppingCart()
    {
        $this->products = [];
        $this->saveToSession();
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

    private function saveToSession()
    {
        $shoppingCart = (object) [];
        $shoppingCart->products = $this->products;

        $this->request->session()->put('shoppingCart', $shoppingCart);
    }
}