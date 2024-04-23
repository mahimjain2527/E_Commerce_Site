<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ListController extends Controller
{
    
    public function addToCart(Request $request)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            // User is not logged in, redirect to login page
            return redirect('/login')->with('status', 'You need to log in to add items to your cart.');
        }

        // Add item to cart logic here
    }

}
