<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('dashboard', compact('products'));
    }
}
