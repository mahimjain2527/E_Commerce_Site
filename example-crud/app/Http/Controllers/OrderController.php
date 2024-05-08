<?php

namespace App\Http\Controllers;
use App\Models\Orders;
use DataTables;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
      
        return view('products.orders');
    }

    public function list(Request $request){
        $query = Orders::query();
        $data = $query->latest()->get();
        return DataTables::of($data)->make(true);
    }

    public function myorders(){

        $orders = Orders::select('orders.*', 'products.price', 'products.image')
        ->join('products', 'orders.product_id', '=', 'products.id')
        ->where('orders.customer_id', auth()->id())
        ->get();

        // Calculate total price for each order
        foreach ($orders as $order) {
        $order->total_price = $order->price * $order->quantity;
        
        }
        return view('lists.myorders', compact('orders'));

    }
}
