<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Product::factory()->count(25)->create(); // 25 random products create honge


        // $products = [];

        // for ($i = 1; $i <= 25; $i++) {
        //     $products[] = [
        //         'name' => 'Product ' . $i,
        //         'description' => 'Description of Product ' . $i,
        //         'price' => rand(10, 100), 
        //         'stock' => rand(1, 100),   
        //         'image_url' => 'http://example.com/product' . $i . '.jpg',
        //         'category_id' => rand(1, 5),  
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ];
        // }

        // // Insert 50 products in one query
        // DB::table('products')->insert($products);
    }
}
