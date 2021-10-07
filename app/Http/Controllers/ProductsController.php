<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    //
    public function index(Request $request)
    {
        $products = Product::query()->where('in_warehouse',true)->paginate(10);
        return view('products.index',['products'=>$products]);
    }
}
