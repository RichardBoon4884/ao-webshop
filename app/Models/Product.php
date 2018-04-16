<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    protected $fillable = array('title', 'barCode', 'price');

    public function categories()
    {
        return $this->belongsToMany('App\Models\Categories', 'categories_products', 'products_id', 'categories_id');
    }
}
