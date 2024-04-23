<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Console\View\Components\Task;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ProductlistController extends Controller
{
    public function index()
    {
        $products = Product::all();
        // dd($products);
        return view('lists.product', compact('products'));
    }
  
   
    public function cart()
    {
        if (!Auth::check()) {
            return redirect('/login')->with('status', 'You need to log in to view your cart.');
        }
    
        // Use 'with' to eager load the 'product' relationship data
        $cartItems = CartItem::where('customer_id', Auth::id())
        ->join('products', 'cart_items.product_id', '=', 'products.id')
        ->select('cart_items.*', 'products.price')
        ->get();

    
        return view('lists.cart', compact('cartItems'));
    }
    
    


    public function addToCart($id)
    {
        
        if (!Auth::check()) {
            return redirect('/login')->with('status', 'You need to log in to add items to your cart.');
        }

        $product = Product::findOrFail($id);

        if ($product->quantity <= 0) {
            return redirect()->back()->with('error', 'Product is out of stock.');
        }
        
        // Create a new cart item
        $existingCartItem = CartItem::where('customer_id', Auth::id())
                                ->where('product_id', $product->id)
                                ->first();

        if ($existingCartItem) {
            $existingCartItem->quantity += 1;
            $existingCartItem->save();
        } else {
            $cartItem = new CartItem([
                'customer_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
            // dd($cartItem);  
            $cartItem->save();
        }
      
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }


  
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            // Find the cart item in the database by its ID
            $cartItem = CartItem::findOrFail($request->id);
            
            $product = Product::findOrFail($cartItem->product_id);
            if ($request->quantity > $product->quantity) {
                return redirect()->back()->with('error', 'Requested quantity exceeds available quantity for ' . $product->name . '.');
            }
            else{
                $cartItem->quantity = $request->quantity;
            }
        
            $cartItem->save();
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {
            // Find the cart item in the database by its ID
            $cartItem = CartItem::findOrFail($request->id);
            
        
            $cartItem->delete();
            
            session()->flash('success', 'Product removed successfully');
        }
    }


    public function store(Request $request)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect('/login')->with('status', 'You need to log in to add items to your cart.');
        }

        // Validate the incoming request
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Create a new cart item
        $cartItem = new CartItem([
            'customer_id' => Auth::id(), // Get the authenticated user's ID
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);

        // Save the cart item to the database
        $cartItem->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
  
}

