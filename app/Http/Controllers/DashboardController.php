<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function showDashBoard(){
        $user = Auth::user();
        $employee = Employee::where('user_id',$user->id)->first();
        
        if($user->role){
            return view('admin.welcome',compact('user','employee'));
        }else{
            return view('user.dashboard',compact('user','employee'));
        }
    }
}
