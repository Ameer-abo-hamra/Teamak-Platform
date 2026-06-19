<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;

class EmployeeAuth extends Controller
{

    public function signUp(Request $request)
    {
        // 1. Validation
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'employee_email' => 'required|email|unique:employees,email',
            'company_id' => 'required|exists:companies,id',
            'password' => 'required|string|min:6',
            'Phone_number' => 'nullable|string|max:30',
            'Address' => 'nullable|string|max:255',
            'job_title' => 'required'
        ]);

        // 2. Create Employee
        $employee = Employee::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['employee_email'],
            'company_id' => $validated['company_id'],
            'password' => Hash::make($validated['password']),
            'phone_number' => $validated['Phone_number'] ?? null,
            'address' => $validated['Address'] ?? null,
            'joining_date' => Carbon::now(),
            'job_title'=>$validated['job_title'],
            'status' => 'active', // أو invited -> active
        ]);

        // 3. Optional: login user مباشرة
        Auth::guard('employee')->login($employee);

        // 4. Redirect
        return redirect()
            ->route('employee.index')
            ->with('success', 'Your account has been created successfully!');
    }
}
