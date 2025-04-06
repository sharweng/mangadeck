<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class VerificationController extends Controller
{
    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['verify', 'resendToGuest']);
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend', 'resendToGuest');
    }

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(Request $request)
    {
        $user = User::find($request->route('id'));

        if (!$user) {
            return redirect(route('login'))->with('error', 'User not found.');
        }

        if ($user->hasVerifiedEmail()) {
            return redirect($this->redirectPath())->with('info', 'Email already verified.');
        }

        if ($user->markEmailAsVerified()) {
            // Update user status to activated after email verification
            $user->update(['status' => 'activated']);
            
            event(new \Illuminate\Auth\Events\Verified($user));
        }

        // If the user is already logged in, redirect to home
        if (auth()->check()) {
            return redirect($this->redirectPath())->with('verified', true);
        }

        // If not logged in, redirect to login with success message
        return redirect(route('login'))->with('status', 'Your email has been verified! You can now log in.');
    }

    /**
     * Resend the email verification notification to a guest user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resendToGuest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'We could not find a user with that email address.');
        }

        if ($user->hasVerifiedEmail()) {
            return back()->with('info', 'This email is already verified. You can log in now.');
        }

        $user->sendEmailVerificationNotification();

        return back()->with('status', 'A fresh verification link has been sent to your email address.');
    }
}

