<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;


class ProductsController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.index',['products' => Product::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(),[
            'name'=> 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required|image',
        ]);

        $product = new Product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description; 
    
        $product_image = $request->image;
        $product_image_new_name = time(). $product_image->getClientOriginalName();
        $product_image->move('uploads/products/', $product_image_new_name);
        $product->image='uploads/products/'.$product_image_new_name;
     

        $product->save();

        Session::flash('success', 'Products updated successfully');
        return redirect()->route('products.index');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', ['product'=>$product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit' ,['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

            $this->validate(request(),[
                'name'=> 'required',
                'description' => 'required',
                'price' => 'required',
//                'image' => 'required|image', store()からコピペ、imageは不要
            ]);
                
    //        $product = new Product; いったん不要 $product = Product::find($id);を追加 , if($request->hasFile('image')){}の内側に挿入
//      if{}の下に移動/$product->save();を追加
    
         
 //   $product = Product::find($id); Eliminate this line by using Route Model Binging

    if($request->hasFile('image'))
    {
        $product_image = $request->image;
        $product_image_new_name = time(). $product_image->getClientOriginalName();
        $product_image->move('uploads/products/'. $product_image_new_name);
        $product->image='uploads/products/'.$product_image_new_name;
        $product->save();
    }

    $product->name = $request->name;
    $product->price = $request->price;
    $product->description = $request->description;
    $product->save();

    return redirect()->route('products.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
      //  $product = Product::find($id);

        if(file_exists($product->image))
        {
            unlink($product->image);
        }

        $product->delete();
        return redirect()->route('products.index');
    }
}
