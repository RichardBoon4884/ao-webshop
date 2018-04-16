<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Categories extends Model
{
    protected $table = 'categories';

    protected $fillable = array('title');

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'categories_products', 'categories_id', 'products_id');
    }
}
