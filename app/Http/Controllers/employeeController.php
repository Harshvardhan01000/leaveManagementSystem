<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    public function getSalary($id,Request $request)
    {
        // Find the employee by ID
        $Employee = Employee::find($id);

        // Determine the start and end date based on the duration parameter
        switch ($request->duration) {
            case 'current_month':
                $startDate = now()->startOfMonth();
                $endDate = now()->endOfMonth();
                break;

            case 'last_6_months':
                $startDate = now()->subMonths(6)->startOfMonth();
                $endDate = now()->endOfMonth();
                break;

            case 'full_year':
                $startDate = now()->startOfYear();
                $endDate = now()->endOfYear();
                break;

            default:
                return response()->json(['error' => 'Invalid duration parameter'], 400);
        }

        $salary = $Employee->salaryDetails()
        ->whereBetween('payment_date', [$startDate, $endDate]);

        if (!$salary) {
            return response()->json(['error' => 'No salary records found for the given duration'], 404);
        }

        // Prepare the salary data for the response
        $salaryChart['payment_date'] = $salary->pluck('payment_date');
        $salaryChart['basic_salary'] = $salary->pluck('basic_salary');
        $salaryChart['allowances'] = $salary->pluck('allowances');
        $salaryChart['deductions'] = $salary->pluck('deductions');

        return response()->json($salaryChart);
    }


    public function getAttendance($id)
    {
        $Employee = Employee::find($id);
        $startDate = Carbon::now()->subMonths(12)->startOfMonth(); // Adjust as needed for the range
        $endDate = Carbon::now()->endOfMonth();

        // Fetch user and their attendance data within the date range
        $Attendance = User::where('id', $Employee->user_id)
            ->with(['attendances' => function ($query) use ($startDate, $endDate) {
                $query->whereBetween('attendance_date', [$startDate, $endDate]);
            }])
            ->first();

        // Initialize arrays to hold months and attendance data
        $monthlyData = [];

        // Iterate through each attendance record
        foreach ($Attendance->attendances as $attendance) {
            // Format the month from the attendance date
            $month = Carbon::parse($attendance->attendance_date)->format('F Y'); // Full month name and year

            // Initialize the month if not already present
            if (!isset($monthlyData[$month])) {
                $monthlyData[$month] = [
                    'present' => 0,
                    'absent' => 0
                ];
            }

            // Increment the count based on attendance status
            if ($attendance->attendance_status === 'present') {
                $monthlyData[$month]['present']++;
            } else if ($attendance->attendance_status === 'absent') {
                $monthlyData[$month]['absent']++;
            }
        }

        // Prepare labels and data for response
        $labels = array_keys($monthlyData); // Get month names
        $presentData = array_column($monthlyData, 'present'); // Get count of present days
        $absentData = array_column($monthlyData, 'absent'); // Get count of absent days

        return response()->json([
            'labels' => $labels,
            'present' => $presentData,
            'absent' => $absentData
        ]);
    }

    public function getLeaveData($id)
    {
        // Find the employee by the given ID
        $Employee = Employee::find($id);

        if (!$Employee) {
            return response()->json(['error' => 'Employee not found'], 404);
        }

        // Get the current month and year
        $currentMonth = date('m');
        $currentYear = date('Y');

        // Load the 'leave' relationship and filter by the current month and year
        $leaves = $Employee->leave()
            ->whereMonth('start_date', $currentMonth)
            ->whereYear('start_date', $currentYear)
            ->with('getLeaveType')->get();

        // Return the leave data as JSON response
        return response()->json($leaves);
    }

    public function userDashboard(Request $request){
        $Employee = Employee::find($request->id);
        $Employee->load('departmentDetails', 'userDetails');
        return view('admin.employeeView', compact('Employee'));
    }
}
