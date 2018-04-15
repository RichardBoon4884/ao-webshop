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
            ],
            [
                'name' => 'Boek 1 – Farewell MD-11',
                'barCode' => 'MD11BOEK',
            ],
            [
                'name' => 'Boek 2 – MD-11 “End of Flightplan”',
                'barCode' => 'MD11-EOFP',
            ],
            [
                'name' => 'Ticket to Malta',
                'barCode' => 'MLA',
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
