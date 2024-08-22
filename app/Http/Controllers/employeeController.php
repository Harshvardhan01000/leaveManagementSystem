<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;

class employeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Employee::with(['userDetails', 'departmentDetails'])->get();
        return response()->json($data);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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

        $Employee = Employee::find($id)->update([
            'department_id' => $request->department_id,
            'designation' => $request->designation,
            'joining_date' => $request->joining_date,
            'current_salary' => $request->current_salary,
        ]);
        User::find($Employee->user_id)->update([
            'first_name'=> $request->first_name,
            'last_name'=> $request->last_name,
            'email'=> $request->email,
            'phone_number'=> $request->phone_number,
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
