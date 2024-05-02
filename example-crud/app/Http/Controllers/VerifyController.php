<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Foundation\Auth\VerifiesEmails;
class VerifyController extends Controller
{
    public function verifymail(User $user)
    {
        return view('mail.displayverify');
    }


    use VerifiesEmails;

    public function verify(Request $request)
    {
        $userID = $request->route('id');
        $user = User::findOrFail($userID);

        // Automatically log in the user
        Auth::login($user);

        // Verify the email if not already done
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        // Redirect to the intended page after successful verification
        // return redirect($this->redirectPath())->with('verified', true);
        if ($user->role === 'customer') {
            // Redirect to a specific page for customers
            return redirect('/mainpage')->with('verified', true);
        } else {
            // Redirect to a default page for non-customers or admins
            return redirect('/home')->with('verified', true);
        }
    }
}
