<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LeaveApprovalController extends Controller
{
    public function listLeaveData(){
        $leaveList = Leave::where('start_date', '>', Carbon::now())->with('getLeaveType','getEmployee.userDetails','getEmployee.departmentDetails')->paginate(12);
        return view('admin.leaveApproval',compact('leaveList'));
    }

    public function viewLeave($id){
        $leaveData = Leave::with('getLeaveType','getEmployee.userDetails','getEmployee.departmentDetails')->find($id);
        return response()->json($leaveData);
    }

    public function leaveStatusUpdate($id,Request $request){
        $leave = Leave::find($id);
        if (!$leave) {
            return response()->json(['error' => 'Leave not found'], 404);
        }
    
        if ($request->query('status') == 'approve') {
            $leave->update(['leave_status' => 'approved']);
        } elseif ($request->query('status') == 'reject') {
            $leave->update(['leave_status' => 'rejected']);
        } else {
            return response()->json(['error' => 'Invalid status'], 400);
        }
        return response()->json(['message'=>'leave status updated successfully']);
    }
}