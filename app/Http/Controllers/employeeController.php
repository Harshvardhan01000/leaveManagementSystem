<?php

namespace App\Http\Controllers;

use App\Jobs\SendRegistrationMail;
use App\Models\Employee;
use App\Models\Salary;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class employeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Get filter and search inputs
        $filter = $request->input('filter', 'name'); // Default filter is 'name'
        $search = $request->input('search', '');

        // Build the query with filtering and searching
        $query = Employee::with(['userDetails', 'departmentDetails']);

        if ($search) {
            switch ($filter) {
                case 'department':
                    $query->whereHas('departmentDetails', function ($q) use ($search) {
                        $q->where('department_name', 'like', '%' . $search . '%');
                    });
                    break;
                case 'designation':
                    $query->where('designation', 'like', '%' . $search . '%');
                    break;
                case 'name':
                default:
                    $query->whereHas('userDetails', function ($q) use ($search) {
                        $q->where('first_name', 'like', '%' . $search . '%')
                            ->orWhere('last_name', 'like', '%' . $search . '%');
                    });
                    break;
            }
        }

        $data = $query->orderBy('created_at')->paginate(10);

        return view('admin.employee', compact('user', 'data'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password)
        ]);
        if ($request->has('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $user_logo_name = time() . "." . $extention;
            $file->move('userImages/', $user_logo_name);
            $user->image = $user_logo_name;
            $user->save();
        }
        Employee::create([
            'user_id' => $user->id,
            'department_id' => $request->department,
            'designation' => $request->designation,
            'joining_date' => $request->joining_date,
            'current_salary' => $request->current_salary,
        ]);
        SendRegistrationMail::dispatch($user,$request->password);
        return response()->json([
            "Message" => "employee created successfully"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Employee = Employee::find($id);
        $Employee->load('departmentDetails', 'userDetails');
        return view('admin.employeeView', compact('Employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Employee::find($id);
        return response()->json($data->load(['userDetails', 'departmentDetails']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $Employee = Employee::find($id);
        $user = User::find($Employee->user_id);
        if ($request->has('image')) {
            $name = $user->image;
            if ($name != 'userlogo.png') {
                unlink("userImages/$name");
            }

            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $user_logo_name = time() . "." . $extention;
            $file->move('userImages/', $user_logo_name);
            $user->image = $user_logo_name;
            $user->save();
        }


        $Employee->update([
            'department_id' => $request->department,
            'designation' => $request->designation,
            'joining_date' => $request->joining_date,
            'current_salary' => $request->current_salary,
        ]);
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
        ]);
        return response()->json([
            'message' => 'successfully updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd($id);
        $record = Employee::find($id);
        User::where('id', $record->user_id)->delete();
        $record->delete();
        return response()->json([
            "Message" => "record delete successfully"
        ]);
    }

}
