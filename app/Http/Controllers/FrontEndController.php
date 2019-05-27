<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Session;

class FrontEndController extends Controller
{
    public function index()
    {
        return view('index',['products'=>Product::paginate(3)]);//paginate(3):1ページにつき3プロダクト
    }

    public function singleProduct(Product $product){

        return view('single',['product'=> $product]);
    }
}
