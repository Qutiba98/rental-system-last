<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if($user->status == "pending"){
                return redirect()->back()->with('ErrorLessor' , "Please wait for admin approval");
            }elseif($user->status == "rejected"){
                return redirect()->back()->with('ErrorLessor' , "Your account rejected");

            }else{
                switch ($user->role) {
                    case 'admin':
                        return redirect()->intended('/dashboard');
                    case 'lessor':
                        return redirect()->intended('/dashboardB');
                    case 'renter':
                        return redirect()->intended('/home');
                    default:
                        return redirect()->intended('/error');
                }
            }

        }

        return redirect('/dashboard')->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Log the user out of the application.
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/home');
    }
}
