<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Orders extends Model
{
    protected $table = 'orders';

    protected $fillable = array('notes', 'totalPrice');

    public function client()
    {
        return $this->belongsTo('App\Models\Clients', 'client_id');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'orders_products', 'order_id', 'products_id')->withPivot('amount');
    }
}