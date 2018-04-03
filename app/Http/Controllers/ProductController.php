<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = DB::table('products')->get();

        return view('product.index', ['products' => $products]);
    }

    public function view($id, $slug = null)
    {
        $product = DB::table('products')->where('id', $id)->first();

        return view('product.view', ['product' => $product]);
    }
}