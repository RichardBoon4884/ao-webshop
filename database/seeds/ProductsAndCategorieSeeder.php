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
                'title' => 'Herpa Wings: McDonnell Douglas MD-11 KLM (1:500)',
                'barCode' => '524896',
                'price' => 33.16,
            ],
            [
                'title' => 'Herpa Wings: Boeing 747-400 KLM Orlando (1:500)',
                'barCode' => '517805-002',
                'price' => 23.78,
            ],
            [
                'title' => 'Herpa Wings: Boeing 777-300ER KLM "Orange Pride" (1:500)',
                'barCode' => '529754',
                'price' => 38.95,
            ],
            [
                'title' => 'Boek 1 – Farewell MD-11',
                'barCode' => 'MD11BOEK',
                'price' => 25.00,
            ],
            [
                'title' => 'Boek 2 – MD-11 “End of Flightplan”',
                'barCode' => 'MD11-EOFP',
                'price' => 25.00,
            ],
            [
                'title' => 'Ticket to Malta',
                'barCode' => 'MLA',
                'price' => 99.99,
            ]
        ]);
        DB::table('categories')->insert([
            [
                'title' => 'Aircraft models'
            ],
            [
                'title' => 'Aviation'
            ],
            [
                'title' => 'Books'
            ],
            [
                'title' => 'Transport'
            ],
            [
                'title' => 'Travel'
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
            ],
            [
                'categories_id' => 2,
                'products_id' => 4,
            ],
            [
                'categories_id' => 3,
                'products_id' => 4,
            ],
            [
                'categories_id' => 4,
                'products_id' => 4,
            ],
            [
                'categories_id' => 2,
                'products_id' => 5,
            ],
            [
                'categories_id' => 3,
                'products_id' => 5,
            ],
            [
                'categories_id' => 4,
                'products_id' => 5,
            ],
            [
                'categories_id' => 5,
                'products_id' => 6,
            ]
        ]);
    }
}
