<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
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
}
