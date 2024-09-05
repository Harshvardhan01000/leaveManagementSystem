<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class attendanceController extends Controller
{
    public function getIndividualAttendance($UserId){
       $data =  Attendance::where('user_id',$UserId)
        ->select('attendance_status', DB::raw('COUNT(*) as count'))
        ->groupBy('attendance_status')->get();
        $label = $data->pluck('attendance_status');
        $value = $data->pluck('count');
        return response()->json([
            'labels'=>$label,
            'values'=>$value
        ]);
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
}
