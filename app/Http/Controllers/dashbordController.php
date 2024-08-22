<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashbordController extends Controller
{
    public function showDashBord(){
        

        return view('welcome');
    }
}
