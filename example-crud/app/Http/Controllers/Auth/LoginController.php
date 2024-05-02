<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';


//     protected function authenticated(Request $request, $user)
// {
//     if (Auth::check() && $user->role === 'customer') {
//         return redirect('/mainpage');
//     }
//     return redirect('/home'); // Redirect to dashboard or any other default page for non-customers
// }

protected function authenticated(Request $request, $user)
    {
        // Check if the user's email is verified
        if (is_null($user->email_verified_at)) {
            return redirect('/verify-email'); // Redirect to the email verification notice page
        }

        // Check user role and redirect accordingly
        if ($user->role === 'customer') {
            return redirect('/mainpage'); // Redirect to customer specific page
        }

        return redirect('/home'); // Redirect to dashboard or any other default page for other roles
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
