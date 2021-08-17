<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    function product(){
        $categories = Category::all();
        $products = Product::all();
        return view('product.index', compact('categories', 'products'));
    }
    function productpost(Request $request)
    {
        product::insert($request->except('_token')+[
            'created_at' => Carbon::now() 
        ]);

       return back();
    }
}
