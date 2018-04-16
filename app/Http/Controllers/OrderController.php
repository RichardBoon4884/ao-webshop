<?php

namespace App\Http\Controllers;

use App\Classes\ShoppingCart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Clients;
use App\Models\Orders;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $client = Clients::where('user_id', Auth::user()->id)->first();
        $orders = Orders::where('client_id', $client->id)->get();

        // Render the web page
        return view('order.index', ['orders' => $orders]);
    }

    public function confirmOrder(Request $request)
    {
        $shoppingCart = new ShoppingCart($request);

        $user = Auth::user();
        $client = Clients::where('user_id', $user->id)->first();

        if (is_null($client)) {
            // No client set for this user
            return redirect()->route('shoppingCartIndex');
        }

        return view('order.confirm', ['shoppingCart' => $shoppingCart, 'client' => $client]);
    }

    public function placeOrder(Request $request)
    {
        $shoppingCart = new ShoppingCart($request);

        $order = new Orders;

        $user = Auth::user();
        $client = Clients::where('user_id', $user->id)->first();

        $order->totalPrice = $shoppingCart->getTotalPrice();

        $order->client()->associate($client);

        $order->save();

        foreach ($shoppingCart->getProducts() as $product) {
            $order->products()->attach($product->id, ['amount' => $product->amount]);
        }

        $order->save();

        $shoppingCart->emptyShoppingCart();

        return redirect()->route('viewOrder', ['orderId' => $order->id]);
    }

    public function viewOrder(int $orderId)
    {
        $order = Orders::find($orderId);

        return view('order.view', ['order' => $order]);
    }
}