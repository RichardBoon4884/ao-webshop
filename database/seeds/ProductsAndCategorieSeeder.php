<?php

use Illuminate\Database\Seeder;

class ProductsAndCategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Herpa Wings: McDonnell Douglas MD-11 KLM (1:500)',
                'barCode' => '524896',
            ],
            [
                'name' => 'Herpa Wings: Boeing 747-400 KLM Orlando (1:500)',
                'barCode' => '517805-002',
            ],
            [
                'name' => 'Herpa Wings: Boeing 777-300ER KLM "Orange Pride" (1:500)',
                'barCode' => '529754',
            ]
        ]);
        DB::table('categories')->insert([
            [
                'title' => 'Aircraft models'
            ],
            [
                'title' => 'Aviation'
            ]
        ]);
        DB::table('categories_products')->insert([
            [
                'categories_id' => 1,
                'products_id' => 1,
            ],
            [
                'categories_id' => 2,
                'products_id' => 1,
            ],
            [
                'categories_id' => 1,
                'products_id' => 2,
            ],
            [
                'categories_id' => 2,
                'products_id' => 2,
            ],
            [
                'categories_id' => 1,
                'products_id' => 3,
            ],
            [
                'categories_id' => 2,
                'products_id' => 3,
            ]
        ]);
    }
}
