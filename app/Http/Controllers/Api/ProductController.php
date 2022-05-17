<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category','prices')->get();

        return response()->json([
            'product' => $products
        ], 200);
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $product = new Product; 

        //insert data
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->slug = Str::slug($request->name);

        //save to database
        $product->save();

       /*  // Product Price Type Store
        $getAllPrices = $request->price;
        $price_type_id = $request->price_type_id;
        $active_date = $request->active_date;

        $values = [];

        foreach ($getAllPrices as $index => $price) {
            $values[] = [
                'product_id' => $product->id,
                'price' => $price,
                'price_type_id' => $price_type_id[$index],
                'active_date' => $active_date[$index],
            ];
        }

        if ( ($price !== NULL) && ($price_type_id[$index] !== NULL) ){
            $product->productPrices()->insert($values);
        } */

        return response()->json([
            'message' => "Product Created Successfully!!",
            'product' => $product
        ], 200);
    }

    public function show(Product $product)
    {
        $product = Product::with('category','prices')->find($product->id);
        return response()->json([
            'message' => "Product Showed Successfully!!",
            'product' => $product
        ], 200);
    }

    public function edit(Product $product)
    {
        //
    }

    public function update(Request $request, Product $product)
    {
        //insert data
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);

        //save to database
        $product->update();

        return response()->json([
            'message' => "Product updated Successfully!!",
            'product' => $product
        ], 200);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'message' => "Product Deleted Successfully!!",
        ], 200);
    }
}
