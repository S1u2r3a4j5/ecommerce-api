<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class ProductController extends Controller
{
    // Get all products
    public function index()
    {
        $products = Cache::remember("products", 60 ,function(){
            return Product::all();
        });

        return response()->json( $products );
    }

    // Store a new product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image_url' => 'nullable|url',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image_url' => $request->image_url,
            'category_id' => $request->category_id, // Assuming category_id is passed
        ]);

        //  Refresh cache
        Cache::forget('products');

        return response()->json($product, 201);
    }

    // Show a specific product
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return response()->json($product);
    }

    // Update a product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update($request->all());

        //  Refresh cache
        Cache::forget('products');

        return response()->json($product);
    }

    // Delete a product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        // 🔁 Refresh cache
        Cache::forget('products');
        
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
