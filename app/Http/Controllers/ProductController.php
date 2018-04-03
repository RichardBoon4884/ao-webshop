<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Get the data from the database
        $products = DB::table('products')->get();

        // Render the web page
        return view('product.index', ['products' => $products]);
    }

    public function view($id, $slug = null)
    {
        // Get the data from the database
        $product = DB::table('products')->where('id', $id)->first();

        // Render the web page
        return view('product.view', ['product' => $product]);
    }
}