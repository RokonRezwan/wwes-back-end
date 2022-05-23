<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return response()->json([
            'categories' => $categories
        ], 200);
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = new Category; 

        //insert data
        $category->name = $request->name;
        $category->slug = Str::slug($request->name, '-');

        //save to database
        $category->save();

        return redirect(config('app.frontend_url').'/categories/index')->with('status','Category has been Created Successfully !');
    }

    public function show(Category $category)
    {
        return response()->json([
            'message' => "Category Showed Successfully!!",
            'category' => $category
        ], 200);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //insert data
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);

        //save to database
        $category->update();

        return redirect(config('app.frontend_url').'/categories/index')->with('status','Category has been Updated Successfully !');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect(config('app.frontend_url').'/categories/index')->with('status','Category has been Deleted Successfully !');
    }

    public function toggleStatus(Category $category)
    {
        $category->is_active = !$category->is_active;
        

        $category->update();

        return redirect(config('app.frontend_url').'/categories/index')->with('status','Category STatus has been Toggled Successfully !');
    }
}
