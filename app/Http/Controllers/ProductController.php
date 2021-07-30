<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('is_admin');
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = DB::table('products')
                    ->join('categories', 'products.category',  '=', 'categories.id')  
                    ->select('products.*','categories.name')  
                    ->orderBy('products.price', 'ASC')       
                    ->paginate(3);
        return view('products.index',compact('product'));
        // dd($product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = DB::Table('categories')->get();
        return view('products.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name'  => 'required',
            'description'  => 'required',
            'price'  => 'required',
            'category'  => 'required',
            'stacks'  => 'required',
            'image'  => 'required',
        ]);
        
        $product = new Product();
        
        $product->product_name = $request->product_name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category = $request->category;
        $product->stacks = $request->stacks;
        $product->product_name = $request->product_name;
        $product->created_at = date("Y-m-d H:i:s");

        $image = $request->file('image');
        
        if ($image) {
         
            $imageName = date('dmy_H_s_i');
            $ext = strtolower($image->getClientOriginalExtension());
            $imageFull = $imageName.".".$ext;
            $upload_path = 'public/images/products/';
            $image_url = $upload_path.$imageFull;
            $success = $image->move($upload_path,$imageFull);

            $product->product_image = $image_url;

            $insert = $product->save();

            if ($insert) {
                return redirect()->route( 'product.index' )->with([ 'inserted' => "New Product Added"]);
            }else {
                return redirect()->route( 'product.index' )->with([ 'error' => "this is an error"]);
            }

        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        dd($product->product_name);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $product = DB::table('categories')
                        ->join('products','categories.id','=','products.category')
                        ->where('products.id',$id)
                        ->first();
        $category = DB::Table('categories')->get();
        
        return view('products.edit',compact('product','category'));
        // dd($product);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->file('image')) {
            $image = $request->file('image');
            $imageName = date('dmy_H_s_i');
            $ext = strtolower($image->extension());
            $imageFull = $imageName.".".$ext;
            $upload_path = 'public/images/products/';
            $image_url = $upload_path.$imageFull;
            $success = $image->move($upload_path,$imageFull);
            
            $update = DB::table('products')
                        ->where('id',$id)
                        ->update([
                            'product_image' => $image_url,
                            'product_name' => $request->product_name,
                            'updated_at' => date("Y-m-d H:i:s"),
                            'description' => $request->description,
                            'price' => $request->price,
                            'category' => $request->category,
                            'stacks' => $request->stacks
                        ]);

           

            if ($update) 
            {
                return redirect()->route( 'product.index' )->with([ 'updated' => "Product Updated"]);
            }
            else 
            {
                return redirect()->route( 'product.index' )->with([ 'errorUpdate' => "this is an error"]);
            }

        }   
        else {
            $updateNoImage = DB::table('products')
                        ->where('id',$id)
                        ->update([
                            'product_name' => $request->product_name,
                            'updated_at' => date("Y-m-d h:i:s"),
                            'description' => $request->description,
                            'price' => $request->price,
                            'category' => $request->category,
                            'stacks' => $request->stacks
                        ]);

            if ($updateNoImage) 
            {
                return redirect()->route( 'product.index' )->with([ 'updated' => "Product Updated"]);
            }
            else 
            {
                return redirect()->route( 'product.index' )->with([ 'errorUpdate' => "this is an error"]);
            }
        }

        // dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('products')->where('id', $id)->delete();
        return redirect()->route( 'product.index' )->with([ 'deleted' => "Product deleted successfully"]);
    }
}
