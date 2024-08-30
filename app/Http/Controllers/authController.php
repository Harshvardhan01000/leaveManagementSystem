<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class authController extends Controller
{
    public function index()
    {
        return view('signIn');
    }

    public function login(Request $request)
    {
        // Validate the input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Check if the email exists
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'This email is not registered.'])->withInput();
        }
    
        // Attempt to log the user in
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->intended('/dashboard');
        } else {
            // Incorrect password
            return redirect()->back()->withErrors(['password' => 'Incorrect password.'])->withInput();
        }
    }
    


    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
