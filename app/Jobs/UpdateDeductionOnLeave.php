<?php

namespace App\Jobs;

use App\Models\Attendance;
use App\Models\Salary;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UpdateDeductionOnLeave implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $employeeId;
    protected $user_id;
    protected $salary;
    /**
     * Create a new job instance.
     */
    public function __construct($user_id, $employeeId,$salary)
    {
        $this->employeeId = $employeeId;
        $this->user_id = $user_id;
        $this->salary = $salary;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        // Query the database
        $absentDaysCount = Attendance::where('user_id', $this->user_id)
            ->where('attendance_status', 'absent')
            ->whereMonth('attendance_date', $currentMonth)
            ->whereYear('attendance_date', $currentYear)
            ->count();
        Salary::where('employee_id',$this->employeeId)
        ->whereMonth('created_at', $currentMonth)
        ->whereYear('created_at', $currentYear)
        ->update([
            'deductions'=>($this->salary/20)*$absentDaysCount
        ]);
        Log::info('salary deduction is updated');
    }
}
