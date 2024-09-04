<?php

namespace App\Jobs;

use App\Models\Attendance;
use App\Models\Leave;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class AddAttendanceForLeave implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $leaveId;
    /**
     * Create a new job instance.
     */
    public function __construct($leaveId)
    {
        $this->leaveId = $leaveId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('add attendance leave queue running');
        $leave = Leave::find($this->leaveId);

        if (!$leave) {
            return; // Leave record not found
        }

        $startDate = Carbon::parse($leave->start_date);
        $endDate = Carbon::parse($leave->end_date);
        $employeeId = $leave->employee_id;

        // Iterate through each day between start_date and end_date
        while ($startDate->lte($endDate)) {
            // Create an attendance record for each day of leave
            Attendance::updateOrCreate(
                [
                    'user_id' => $employeeId,
                    'attendance_date' => $startDate->format('Y-m-d')
                ],
                [
                    'attendance_status' => 'absent'
                ]
            );

            // Move to the next day
            $startDate->addDay();
        }
    }
}
