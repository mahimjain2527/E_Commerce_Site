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
}
