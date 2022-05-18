<?php

namespace App\Http\Controllers\Api;

use App\Models\Price;
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
       // dd($request->all());
        $product = new Product; 

        //insert data
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->slug = Str::slug($request->name);
        $product->description = $request->description;

        //save to database
        $product->save();

        // Product Price Type Store
        $getAllPrices = $request->amount;
        $price_type_ids = $request->price_type_id;

        $values = [];

        if(($getAllPrices !== NULL) && ($price_type_ids !== NULL)){
            foreach ($getAllPrices as $index => $amount) {
                $values[] = [
                    'product_id' => $product->id,
                    'amount' => $amount,
                    'price_type_id' => $price_type_ids[$index],
                ];
            }
        }

        if ( ($amount !== NULL) && ($price_type_ids[$index] !== NULL) ){
            $product->prices()->insert($values);
        }

        return redirect('http://127.0.0.1:7000/products/index')->with('status','Product has been Created Successfully !');
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
        $product->category_id = $request->category_id;
        $product->slug = Str::slug($request->name);
        $product->description = $request->description;
        
        //save to database
        $product->update();

        // Update Prices
        $product_price_ids = $request->product_price_id;

        if($product_price_ids){
            for ($i = 0; $i < count($product_price_ids); $i++) {

                $values = [
                    'product_id' => $product->id,
                    'amount' => $request->amount[$i],
                ];

                $check_id = Price::find($product_price_ids[$i]);

                if ($check_id) {
                    $product->prices()->where('id', $check_id->id)->update($values);
                }
            }
        }

        return redirect('http://127.0.0.1:7000/products/index')->with('status','Product has been Updated Successfully !');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect('http://127.0.0.1:7000/products/index')->with('status','Product has been Deleted Successfully !');
    }
}
