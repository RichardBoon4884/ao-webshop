<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Clients;
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

        return view('order.index', ['shoppingCart' => $shoppingCart, 'client' => $client]);
    }
}