<?php

namespace App\Http\Controllers;
use App\OrderItem;
use App\Product;
use App\Customer;
use App\Invoice;
use App\User;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = DB::table('users')->count();
        $products = DB::table('products')->count();
        $categories = DB::table('categories')->count();
        $customers = DB::table('customers')->count();
        $orders = DB::table('order_items')->count();
        $sum = DB::table('invoices')->sum('total_amount');
        return view('adminHome',compact('orders','users','products','categories','customers','sum'));
    }

    public function adminHome()
    {
        $users = DB::table('users')->count();
        $products = DB::table('products')->count();
        $categories = DB::table('categories')->count();
        $customers = DB::table('customers')->count();
        $orders = DB::table('order_items')->count();
        $sum = DB::table('invoices')->sum('total_amount');
        return view('home',compact('orders','users','products','categories','customers','sum'));
    }
}
