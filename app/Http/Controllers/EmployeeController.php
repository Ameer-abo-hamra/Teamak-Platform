<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Invitation;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      return 'hi';
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
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }

    public function acceptInvitation($token)
    {
        $invitation = Invitation::where('invitation_token', $token)->firstOrFail();
        $data = [
            'company_id' => $invitation->company->id,
            'job_title' => $invitation->job_title,
            'employee_email'=>$invitation->employee_email
        ];

        return view('auth.employee.register', compact('data'));
    }
}
