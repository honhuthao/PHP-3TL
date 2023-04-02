<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    function index()
    {
        $product = Product::all();
        return view('home.index', ['products' => DB::table('products')->paginate(9)]);
    }
}