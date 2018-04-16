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

        $order->client()->associate($client);

        $order->save();

        foreach ($shoppingCart->getProducts() as $product) {
            $order->products()->attach($product->id, ['amount' => $product->amount]);
        }

        $order->save();

        $request->session()->put('shoppingCart', null);

        return redirect()->route('viewOrder', ['orderId' => $order->id]);
    }

    public function viewOrder(int $orderId)
    {
        $order = Orders::find($orderId);

        return view('order.view', ['order' => $order]);
    }
}