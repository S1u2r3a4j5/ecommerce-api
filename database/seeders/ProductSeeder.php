<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [];

        // Loop to create 50 products
        for ($i = 1; $i <= 25; $i++) {
            $products[] = [
                'name' => 'Product ' . $i,
                'description' => 'Description of Product ' . $i,
                'price' => rand(10, 100), 
                'stock' => rand(1, 100),   
                'image_url' => 'http://example.com/product' . $i . '.jpg',
                'category_id' => rand(1, 5),  
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert 50 products in one query
        DB::table('products')->insert($products);
    }
}
