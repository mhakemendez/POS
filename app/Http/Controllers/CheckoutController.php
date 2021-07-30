<?php

namespace App\Http\Controllers;

use App\OrderItem;
use App\Product;
use App\Customer;
use App\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
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
        if ($item->count() < 1 ) {
            return redirect()->route('order.index')->with([ 'emptycart' => "Cart is empty"]);
        }else {
            return view('checkout.index',compact('item'));
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name'  => 'required',
            'contact'  => 'required',
            'address'  => 'required',
            'payment'  => 'required'
           
        ]);

        $customer = new Customer();
      
        $customer->customer_name = $request->name;
        $customer->contact_number = $request->contact;
        $customer->address = $request->address;
        
        $insertCustomer = $customer->save();

        $cusId = $customer->id;
        
        if ($insertCustomer ) {

            $invoice = new Invoice();

                $invoice->customer_id = $cusId;
                $invoice->total_amount = \Cart::session(auth()->id())->getTotal();
                $invoice->total_amount_pay = $request->payment;
                $invoice->change = $request->changed;
                $invoice->created_at = date("Y-m-d H:i:s");
                
                $insertInvoice = $invoice->save();
                $invoiceId = $invoice->id;
            
            if ($insertInvoice) {
                $item = \Cart::session(auth()->id())->getContent();
               
                foreach ($item as  $items) {
                    $order = new OrderItem();
                    $order->product_id = $items->id;
                    $order->invoice_id = $invoiceId;
                    $order->qty = $items->quantity;
                    $order->sub_total = \Cart::session(auth()->id())->get($items->id)->getPriceSum();
                    $order->created_at = date("Y-m-d H:i:s");

                    $inserOrder = $order->save();
                }
            }
          
            \Cart::session(auth()->id())->clear();

            return redirect()->route('checkout.show', $cusId)->with([ 'placeorder' => "place order successfully"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     
        $data = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('invoices', 'order_items.invoice_id', '=', 'invoices.id')
            ->join('customers', 'invoices.customer_id', '=', 'customers.id')
            ->select('customers.*','order_items.sub_total','order_items.qty',
                    'products.product_name','products.product_image','products.price',
                    'invoices.total_amount','invoices.total_amount_pay',
                    'invoices.change')
            ->where('customers.id',$id)
            ->get();
        
        return view('checkout.show',compact('data'));
        // dd($data);
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}








