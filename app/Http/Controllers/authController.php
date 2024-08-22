<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class authController extends Controller
{
    public function index()
    {
        return view('authentication.login');
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('home');
        } else {
            return redirect()->route('login')->with('message','email or password is incorrect');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
