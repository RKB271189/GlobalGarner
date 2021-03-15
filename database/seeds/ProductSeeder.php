<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product')->insert([
            [
                'vendor' => 2,
                'productname' => 'Chartered Boat - 1',
                'image' => 'product/product1.jpg',
                'description' => 'charted boat small',
                'price' => 20000,
                'quantity' => 10,
                'discount' => 0,
                'isavailable' => 1,
                'createdate' => date('Y-m-d H:i:s')
            ],
            [
                'vendor' => 2,
                'productname' => 'Chartered Boat - 2',
                'image' => 'product/product2.jpg',
                'description' => 'charted boat medium',
                'price' => 25000,
                'quantity' => 11,
                'discount' => 0,
                'isavailable' => 1,
                'createdate' => date('Y-m-d H:i:s')
            ],
            [
                'vendor' => 2,
                'productname' => 'Chartered Boat - 3',
                'image' => 'product/product3.jpg',
                'description' => 'charted boat large',
                'price' => 30000,
                'quantity' => 5,
                'discount' => 0,
                'isavailable' => 1,
                'createdate' => date('Y-m-d H:i:s')
            ],
            [
                'vendor' => 2,
                'productname' => 'Jet Ski Boat - 1',
                'image' => 'product/product4.jpg',
                'description' => 'Jet ski small',
                'price' => 29000,
                'quantity' => 9,
                'discount' => 0,
                'isavailable' => 1,
                'createdate' => date('Y-m-d H:i:s')
            ],
            [
                'vendor' => 2,
                'productname' => 'Jet Ski Boat - 2',
                'image' => 'product/product5.jpg',
                'description' => 'Jet ski medium',
                'price' => 38000,
                'quantity' => 7,
                'discount' => 0,
                'isavailable' => 1,
                'createdate' => date('Y-m-d H:i:s')
            ],
            [
                'vendor' => 2,
                'productname' => 'Jet Ski Boat - 3',
                'image' => 'product/product6.jpg',
                'description' => 'Jet ski large',
                'price' => 39000,
                'quantity' => 6,
                'discount' => 0,
                'isavailable' => 1,
                'createdate' => date('Y-m-d H:i:s')
            ],
            [
                'vendor' => 2,
                'productname' => 'Snorkeling - 1',
                'image' => 'product/product7.jpg',
                'description' => 'snorkelling regular',
                'price' => 1000,
                'quantity' => 800,
                'discount' => 0,
                'isavailable' => 1,
                'createdate' => date('Y-m-d H:i:s')
            ],
            [
                'vendor' => 2,
                'productname' => 'Snorkeling - 2',
                'image' => 'product/product8.jpg',
                'description' => 'snorkelling regular',
                'price' => 1100,
                'quantity' => 450,
                'discount' => 0,
                'isavailable' => 1,
                'createdate' => date('Y-m-d H:i:s')
            ],
            [
                'vendor' => 2,
                'productname' => 'Snorkeling - 3',
                'image' => 'product/product9.jpg',
                'description' => 'snorkelling regular',
                'price' => 1300,
                'quantity' => 650,
                'discount' => 0,
                'isavailable' => 1,
                'createdate' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
