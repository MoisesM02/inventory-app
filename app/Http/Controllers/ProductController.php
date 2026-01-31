<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('categories')->orderBy('name', 'asc')->paginate(15);
        return view('products.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validate request
        $productData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['nullable', 'unique:products,code', 'max:25'],
            'unit' => ['nullable', 'string'],
            'price' => ['nullable', 'numeric']
        ]);

        $categories = $request->categories;
        //Validate all categories exist
        if($count = Category::find($categories)->count() != sizeof($categories))
            throw ValidationException::withMessages(['categories' => "The selected categories are invalid."]);
        //Create Product
        $product = Product::create($productData);
        //Add categories to product
        $product->categories()->attach($categories);

        return redirect('/products/create')->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $productCategories = $product->categories;
        return view('products.edit', [
            'product' => $product,
            'categories' => $categories,
            'productCategories' => $productCategories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //Validate Product model data
        $productData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['nullable' , 'max:25', Rule::unique('products', 'code')->ignore($product->id)],
            'unit' => ['nullable', 'string'],
            'price' => ['nullable', 'numeric']
        ]);

        //Validate categories
        $newCategories = $request->categories;
        //Validate all categories exist
        if($count = Category::find($newCategories)->count() != sizeof($newCategories))
            throw ValidationException::withMessages(['categories' => "The selected categories are invalid."]);
        $product->update($productData);
        $product->categories()->sync($newCategories);

        return redirect('/products/'. $product->id . '/edit')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $product)
    {
        Product::destroy($product);
        return redirect('/products')->with('success', 'Product deleted successfully!');
    }
}
