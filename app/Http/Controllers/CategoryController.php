<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filters = Product::orderBy('name', 'ASC')->get();
        $categories = Category::with('products')->paginate(10);
        return view('categories.index', [
            'products' => $filters,
            'categories' => $categories
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $categoryAttributes = $request->validate([
           'name' => ['required', 'string', 'min:3', 'unique:categories,name'],
        ]);
        Category::create($categoryAttributes);

        return redirect('/categories')->with('success', 'Category created!');
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate(['name' => ['required', 'unique:categories,name,']]);
        $category->update($validatedData);
        return redirect('/categories')->with('success', 'Category updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect('/categories')->with('success', 'Category deleted!');
    }
}
