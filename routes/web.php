<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\dashbordController;
use App\Http\Controllers\departmentController;
use App\Http\Controllers\employeeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [authController::class,'index'])->name('login');

Route::post('/authentication',[authController::class,'login']);

Route::get('/logout',[authController::class,'logout']);

Route::middleware('auth')->group(function () {
    Route::get('home',[dashbordController::class,'showDashBord']);
    Route::resource('employee', employeeController::class); 
    Route::get('fetch-department',[departmentController::class,'fetchDepartment']);
});

Route::get('/employeeListing', function () {
    return view('components.employeeListing');
});

Route::get('/leaveApproval', function () {
    return view('components.leaveApproval');
});