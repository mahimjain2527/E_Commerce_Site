<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CartItem;
use Razorpay\Api\Api;
use App\Models\Orders;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;
use Session;
use Exception;
use Auth;
  
class RazorpayPaymentController extends Controller
{
    public function index(Request $request)
    {       
        $cartItems = CartItem::where('customer_id', Auth::id())->get()->toArray();

        
        // dd($cartItems);
        // $productId = $request->input('product_id');
        // $quantity = $request->input('quantity');
        // dd($request->all());

        return view('lists.razorpayView');
    }


    public function createCheckoutSession(Request $request)
    {
        // Assuming you have some way to retrieve the cart items and total
        $cartItems = $request->session()->get('cart', []);
        $total = collect($cartItems)->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });

        $checkoutSessionId = uniqid('checkout_');
        $request->session()->put('checkoutSessionId', $checkoutSessionId);
        $request->session()->put('checkoutSessionItems', $cartItems);

        return redirect()->route('razorpay.payment', ['session_id' => $checkoutSessionId, 'total' => $total]);
    }

  
    public function store(Request $request)
    {
        $input = $request->all();
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if(count($input) && !empty($input['razorpay_payment_id'])) {
            try {
                // Attempt to capture the payment
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 

                // Fetch cart items from the database for the current authenticated user
                // $cartItems = CartItem::where('customer_id', Auth::id())->get();

                $cartItem = CartItem::join('products','products.id','=','cart_items.product_id')
                            ->where('cart_items.customer_id',auth()->id())
                            ->select('cart_items.product_id','cart_items.quantity','products.name','products.price')
                            ->get();

                // dd($cartItem);

                foreach ($cartItem as $item) {
                    $product = Product::find($item->product_id);
                    if ($product) {
                       
                        $product->quantity -= $item->quantity;
                        $product->save();
                    }
                    // dd($item->quantity);
                    Orders::create([
                        'customer_id' => Auth::id(),
                        'product_id' => $item->product_id,
                        'name' => $item->name,
                        'quantity' => $item->quantity, 
                        
                    ]);
                }

                // Clear the cart by deleting cart items
                CartItem::where('customer_id', Auth::id())->delete();

                // Optionally, log the successful payment or notify the user/admin

            } catch (Exception $e) {
                return  $e->getMessage();
                Session::put('error',$e->getMessage());
                return redirect()->back();
            }
        }
            
        Session::put('success', 'Payment successful');

        return redirect()->back();
    }

//     public function store(Request $request)
// {
//     $input = $request->all();
//     $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
//     $payment = $api->payment->fetch($input['razorpay_payment_id']);

//     if (count($input) && !empty($input['razorpay_payment_id'])) {
//         try {
//             // Attempt to capture the payment
//             $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 

//             // Fetch cart items from the database for the current authenticated user
//             $cartItems = CartItem::where('customer_id', Auth::id())->get(['product_id', 'quantity']);
            

//             // Store purchased items in the purchased_items table
//             foreach ($cartItems as $item) {
//                 Orders::create([
//                     'customer_id' => Auth::id(),
//                     'product_id' => $item->product_id,
//                     'quantity' => $item->quantity,
//                     // 'total' => $item->total
//                     // Add any other relevant fields
//                 ]);
//             }

//             // Clear the cart by deleting cart items
//             CartItem::where('customer_id', Auth::id())->delete();

//             // Optionally, log the successful payment or notify the user/admin

//         } catch (Exception $e) {
//             return  $e->getMessage();
//             Session::put('error',$e->getMessage());
//             return redirect()->back();
//         }
//     }
        
//     Session::put('success', 'Payment successful');
//     return redirect()->back();
// }

}
