<?php

namespace App\Http\Controllers;

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
        // Check if there is a shopping cart in the session
        if ($request->session()->has('shoppingCart')) {
            $shoppingCart = $request->session()->get('shoppingCart');
        } else { // There is no shopping cart in the session
            return redirect()->route('shoppingCartIndex');
        }

        if (count($shoppingCart->products) == 0) {
            return redirect()->route('shoppingCartIndex');
        }

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
        // Check if there is a shopping cart in the session
        if ($request->session()->has('shoppingCart')) {
            $shoppingCart = $request->session()->get('shoppingCart');
        } else { // There is no shopping cart in the session
            return redirect()->route('shoppingCartIndex');
        }

        if (count($shoppingCart->products) == 0) {
            return redirect()->route('shoppingCartIndex');
        }

        $order = new Orders;

        $user = Auth::user();
        $client = Clients::where('user_id', $user->id)->first();

        $order->client()->associate($client);

        $order->save();

        foreach ($shoppingCart->products as $product) {
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