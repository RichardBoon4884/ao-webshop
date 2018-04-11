<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Categories extends Model
{
    protected $table = 'categories';

    protected $fillable = array('title');

    public function categories()
    {
        return $this->belongsToMany('App\Models\Products', 'categories_products', 'categories_id', 'products_id');
    }
}
