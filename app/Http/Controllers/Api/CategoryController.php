<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return response()->json([
            'status' => true,
            'category' => $categories
        ], 200);
    }

    public function create()
    {
        //
    }

    public function store(CategoryStoreRequest $request)
    {
        $category = new Category; 

        //insert data
        $category->name = $request->name;
        $category->slug = Str::slug($request->name, '-');

        //save to database
        $category->save();

        return response()->json([
            'status' => true,
            'message' => "Category Created Successfully!!",
            'category' => $category
        ], 200);
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        //
    }

    public function update(CategoryStoreRequest $request, Category $category)
    {
        //insert data
        $category->name = $request->name;
        $category->slug = Str::slug($request->product_name, '-');

        //save to database
        $category->update();

        return response()->json([
            'status' => true,
            'message' => "Category updated Successfully!!",
            'category' => $category
        ], 200);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'status' => true,
            'message' => "Category Deleted Successfully!!",
        ], 200);
    }
}
