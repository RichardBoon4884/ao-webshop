<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
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

        

        return view('order.index', ['shoppingCart' => $shoppingCart]);
    }
}