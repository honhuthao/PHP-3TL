<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function index()
    {
        $products = Product::all();

        return view('product.index', ['products' => $products]);
    }

    function create()
    {
        $categories = Category::all();
        return view('product.create', ['categories' => $categories]);
    }

    function store(Request $request)
    {
        // validate
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'image' => 'required'
        ]);
        if (!$validated) {
            return response()->json(['message' => 'Cannot create product'], 400);
        }

        try {
            $product = new Product();
            $product->name = $request->name;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->discount = $request->discount;
            $product->category_id = $request->category_id;
            $product->image = $request->image;
            $product->stock = $request->stock;
            // attach to user
            $product->author_id = auth()->user()->id;
            $product->save();
            return redirect()->route('product.index');
        } catch (\Throwable $th) {
            return back()->with('error', 'Cannot create product');
        }
    }

    function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('product.edit', ['product' => $product, 'categories' => $categories]);
    }


    function update($id)
    {
        try {
            $product = Product::find($id);
            $product->name = request('name');
            $product->slug = request('slug');
            $product->description = request('description');
            $product->price = request('price');
            $product->discount = request('discount');
            $product->category_id = request('category_id');
            $product->image = request('image');
            $product->stock = request('stock');
            $product->save();
            return redirect()->route('product.index');
        } catch (\Throwable $th) {
            return back()->with('error', 'Cannot update product');
        }
    }
    

    function delete($id)
    {
        try {
            $product = Product::find($id);
            $product->delete();
            return response()->json(['message' => 'Deleted product successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Cannot delete product']);
        }
    }
}