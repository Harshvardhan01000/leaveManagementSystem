<?php

use App\Http\Controllers\attendanceController;
use App\Http\Controllers\authController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\dashbordController;
use App\Http\Controllers\departmentController;
use App\Http\Controllers\employeeController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\LeaveApprovalController;
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
    Route::get('/dashboard',[DashboardController::class,'showDashBoard'])->name('dashboard');
    Route::resource('/employee', employeeController::class); 
    Route::get('fetch-department',[departmentController::class,'fetchDepartment']);
    Route::post('create-holiday',[HolidayController::class,'createHoliday']);
    Route::get('leaveApproval',[LeaveApprovalController::class,'listLeaveData'])->name('leave-approval');
    Route::get('view-leave/{id}',[LeaveApprovalController::class,'viewLeave']);
    Route::get('leave-status/{id}',[LeaveApprovalController::class,'leaveStatusUpdate']);
    Route::get('get-salary-details/{id}',[employeeController::class,'getSalary']);
    Route::get('get-attendance/{id}',[employeeController::class,'getAttendance']);
    Route::get('get-leave-data/{id}',[employeeController::class,'getLeaveData']);
    Route::get('/leave-page',[LeaveApprovalController::class,'index']);
    Route::get('/leave-form',[LeaveApprovalController::class,'createLeave']);
    Route::post('/leave-submit',[LeaveApprovalController::class,'leaveStore'])->name('leave-submit');
    Route::get('/salary-page',[employeeController::class,'salaryPage'])->name('salary-page');
    Route::get('/profile',[authController::class,'profile'])->name('profile');
    Route::post('/update-profile',[authController::class,'updateProfile'])->name('update-profile');
    Route::post('/change-password',[authController::class,'changePassword'])->name('change-password');

});
