<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

// use Illuminate\Http\Request;

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
        if (Auth::check()) {
            // Redirect authenticated users to the products index page
            return redirect()->route('products.index');
        } else {
            // If the user is not logged in, redirect to the login page
            return redirect()->route('login');
        }
    }
    
}
