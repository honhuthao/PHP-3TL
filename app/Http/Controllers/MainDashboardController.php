<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainDashboardController extends Controller
{
    function index(){
        $product = Product::all();
        return view('dashboard.index', ['products'=> DB::table('products')->paginate(9)]);
    }

    function get($id){
        try {
            $product = Product::find($id);
            return response()->json($product, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Cannot find product'], 400);
        }
    }
}
