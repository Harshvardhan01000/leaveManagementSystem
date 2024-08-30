<?php

use App\Http\Controllers\attendanceController;
use App\Http\Controllers\authController;
use App\Http\Controllers\DashboardController;
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
    Route::get('/dashboard',[DashboardController::class,'showDashBoard']);
    Route::resource('/employee', employeeController::class); 
    Route::get('fetch-department',[departmentController::class,'fetchDepartment']);
//     Route::get('/employeeView',function(){
//         return view('userPages.viewPage');
//     });
//     Route::get('/get-individual-attendance/{id}',[attendanceController::class,'getIndividualAttendance']);
// });

// Route::get('/employeeListing', function () {
//     return view('components.employeeListing');
// });

// Route::get('/leaveApproval', function () {
//     return view('components.leaveApproval');
});



// testing file 

// Route::get('/', function () {
//     return view('signIn');
// });
// Route::any('/dashboard', function () {
//     return view('admin.welcome');
// });
Route::get('leaveApproval',function(){
    return view('admin.leaveApproval');
});
// Route::get('employee',function(){
//     return view('admin.employee');
// });
Route::get('employee/employeeView',function(){
    return view('admin.employeeView');
});
// Route::get('/user/dashboard',function(){
//     return view('user.dashboard');
// });
Route::get('user/leaves',function(){
    return view('user.leave-page');
});
Route::get('user/salary',function(){
    return view('user.salary-page');
});
Route::get('user/leaves/leave-form',function(){
    return view('user.leave-form');
});
Route::get('/profile',function(){
    return view('profile');
});