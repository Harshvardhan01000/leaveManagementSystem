<?php

namespace App\Http\Controllers;

use App\Mail\PasswordResetmail;
use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; 

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

    public function profile()
    {
        $Employee = Employee::where('user_id', Auth::user()->id)->with('departmentDetails')->first();
        $departments = Department::get();
        return view('profile', compact('Employee', 'departments'));
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::user()->id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
        ]);
        Employee::where('user_id', Auth::user()->id)->update([
            'department_id' => $request->department
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Data change Successfully',
        ]);
    }

    public function changePassword(Request $request)
    {
        // Check if current password matches the one in the database
        if (!Hash::check($request->currentPassword, auth()->user()->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Your current password is incorrect.',
            ], 422);
        }

        // Update the password
        User::find(Auth::user()->id)->update([
            'password' => Hash::make($request->newPassword),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Your password has been successfully updated.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function resetPassword(){
        return view('reset-password');
    }

    public function setPassword(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Generate a random password
        $newPassword = Str::random(8); // Use Str::random

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Update the user's password
            $user->password = Hash::make($newPassword);
            $user->save();

            // Send an email with the new password
            Mail::to($user->email)->send(new PasswordResetmail($user->first_name,$newPassword));

            return redirect()->back()->with('status', 'A new password has been sent to your email.');
        } else {
            return redirect()->back()->withErrors(['email' => 'The provided email address does not exist.']);
        }
    }
}
