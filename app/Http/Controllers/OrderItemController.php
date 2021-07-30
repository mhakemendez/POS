<?php

namespace App\Http\Controllers;

use App\OrderItem;
use App\Product;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderItemController extends Controller
{

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
        $item = \Cart::session(auth()->id())->getContent();
        $order = DB::table('products')->paginate(3);
        return view('orders.index',compact('order','item'));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        
        $product = Product::find($id);

        \Cart::session(auth()->id())->add(array(
            'id' => $product->id,
            'name' => $product->product_name,
            'price' => $product->price,
            'quantity' => 1
            
        ));

        return redirect()->route( 'order.index' )->with([ 'cart' => "item inserted to cart"]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderItem $order, $id)
    {
        \Cart::session(auth()->id())->update($id, [
            'quantity' => array(
                'relative' => false,
                'value' => $request->qty
            )
        ]);

        return redirect()->route( 'order.index' )->with([ 'cartUpdate' => "cart updated"]);

       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderItem $order,$id)
    {
        \Cart::session(auth()->id())->remove($id);

        return redirect()->route( 'order.index' )->with([ 'cartdelete' => "item deleted"]);
    }
}

