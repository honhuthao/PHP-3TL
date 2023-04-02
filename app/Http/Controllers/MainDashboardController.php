<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainDashboardController extends Controller
{
    function index()
    {
        return view('dashboard.index');
    }
}