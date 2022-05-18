<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PriceType;
use Illuminate\Http\Request;

class PriceTypeController extends Controller
{
    public function index()
    {
        $priceTypes = PriceType::all();

        return response()->json([
            'priceTypes' => $priceTypes
        ], 200);
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $priceType = new PriceType; 

        //insert data
        $priceType->name = $request->name;

        //save to database
        $priceType->save();

        return redirect('http://127.0.0.1:7000/price-types/index')->with('status','Price Type has been Created Successfully !');
    }

    public function show(PriceType $priceType)
    {
        return response()->json([
            'message' => "Price Showed Successfully!!",
            'priceType' => $priceType
        ], 200);
    }

    public function edit(PriceType $priceType)
    {
        //
    }

    public function update(Request $request, PriceType $priceType)
    {
        //insert data
        $priceType->name = $request->name;

        //save to database
        $priceType->update();

        return redirect('http://127.0.0.1:7000/price-types/index')->with('status','Price Type has been Updated Successfully !');
    }

    public function destroy(PriceType $priceType)
    {
        $priceType->delete();

        return redirect('http://127.0.0.1:7000/price-types/index')->with('status','Price Type has been Deleted Successfully !');
    }
}
