<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerificationMail;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:user,admin,customer'],
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'], // Set the role for the user based on the selected option
        ]);

        return $user;
        
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        Mail::to($user->email)->send(new VerificationMail($user));
        return redirect('/verify-email')->with('message', 'Mail has been sent to the email id.');
    }
    
        public function showRegistrationForm()
    {
        return view('auth.register', ['roles' => ['user', 'admin','customer']]);
    }

    protected function redirectTo()
    {
        // if (auth()->check()) { // Check if user is authenticated
        //     if (auth()->user()->isAdmin()) {
        //         return '/products'; // Redirect admins to the products page
        //     } else if (auth()->user()->isCustomer()) {
        //         return '/mainpage'; // Redirect customers to the main page
        //     }
        // }
    
        // return '/products'; // Redirect unauthenticated users to the products page

        return '/verify-email';
    }

}
