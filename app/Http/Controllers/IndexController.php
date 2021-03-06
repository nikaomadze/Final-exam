<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $products = Product::paginate(6);

        return view('index', compact('products'));
    }
}