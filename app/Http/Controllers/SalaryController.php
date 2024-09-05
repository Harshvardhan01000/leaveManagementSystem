<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Salary;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalaryController extends Controller
{
    public function getSalary($id, Request $request)
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

    public function salaryPage()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $employeeId = Employee::where('user_id', Auth::user()->id)->first()->id;
        $leaveCount = Attendance::whereMonth('attendance_date',$currentMonth)
                        ->whereYear('attendance_date',$currentYear)
                        ->where('attendance_status','absent')->count();
        $salary  = Salary::whereMonth('created_at',$currentMonth)
        ->whereYear('created_at',$currentYear)
        ->where('employee_id',$employeeId)->first();
        // $total_absent_days = 
        return view('user.salary-page', compact('employeeId','leaveCount','salary'));
    }

    public function getSalaryDetailsForForm(Request $request)
    {
        $currentMonth = Carbon::now()->month;
        $salaryDetails = Salary::where('employee_id', $request->employeeId)->whereMonth('created_at', $currentMonth)->first();
        return response()->json($salaryDetails);
    }

    public function salaryEditFormHandle(Request $request, $employeeId)
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        Salary::where('employee_id')->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->update([
                'basic_salary' => $request->basicSalary,
                'allowances' => $request->allowances,
                'deductions' => $request->deduction,
                'payment_date' => $request->paymentDate
            ]);
        return response()->json(['message' => 'Salary Edited successfully']);
    }

    public function getPayslip(Request $request){
        $employeeId = $request->employeeId;
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $data = Salary::where('employee_id',$employeeId)
                ->whereMonth('created_at',$currentMonth)
                ->whereYear('created_at',$currentYear)
                ->with('employee.userDetails','employee.departmentDetails')
                ->first();
        return response()->json($data);
    }
    public function downloadPayslip(Request $request){
            $employeeId = $request->employeeId;
            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;
            $data = Salary::where('employee_id',$employeeId)
                    ->whereMonth('created_at',$currentMonth)
                    ->whereYear('created_at',$currentYear)
                    ->with('employee.userDetails','employee.departmentDetails')
                    ->first();

            $result = [
                'firstName' => $data->employee->userDetails->first_name." ".$data->employee->userDetails->last_name,
            'designation' => $data->employee->designation,
            'department' => $data->employee->departmentDetails->department_name,
            'basicSalary' => $data->basic_salary,
            'allowances' => $data->allowances,
            'deductions' => $data->deductions,
            'netSalary' => $data->net_salary,
            'paymentDate' => Carbon::parse($data->payment_date)->format('d F Y'),
            'paymentStatus' => $data->payment_status,
            ];
            $pdf = FacadePdf::loadView('payslip', $result);
            return $pdf->download('payslip.pdf');
        
    }
}
