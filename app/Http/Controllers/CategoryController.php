<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function index()
    {
        $categories = Category::all();
        return view('category.index', ['categories' => $categories]);
    }

    function get($id)
    {
        try {
            $category = Category::find($id);
            return response()->json($category, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Cannot find category'], 400);
        }
    }
    function delete($id)
    {
        try {
            $category = Category::find($id);
            $category->delete();
            return response()->json(['message' => 'Deleted category successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Cannot delete category']);
        }


    }
    function update($id, Request $request)
    {
        // validate
        $validated = $request->validate([
            'name' => 'required'
        ]);
        if (!$validated) {
            return response()->json(['message' => 'Cannot edit category'], 400);
        }

        try {
            $category = Category::find($id);
            $category->name = $request->name;
            $category->save();
            return response()->json(['message' => 'Updated category successfully', 'category' => $category], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 400);
        }
    }

    function create(Request $request)
    {
        // validate
        $validated = $request->validate([
            'name' => 'required|unique:categories,name'
        ]);
        if (!$validated) {
            return response()->json(['message' => 'Cannot create category'], 400);
        }

        try {
            $category = new Category;
            $category->name = $request->name;
            $category->save();
            return response()->json(['message' => 'Created category successfully', 'category' => $category], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 400);
        }
    }

}