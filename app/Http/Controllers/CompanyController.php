<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('company.index');
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
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
    }


    public function companyEmployee(Company $c)
    {
        $departments = config('departments');
        $employees = auth('company')->user()->employees;
        return view('company.Employees.index', compact('departments', 'employees'));
    }
    public function search(Request $request)
    {
        $employees = Employee::query()

            ->where('first_name', 'like', '%' . $request->search . '%')

            ->orWhere('last_name', 'like', '%' . $request->search . '%')

            ->orWhere('email', 'like', '%' . $request->search . '%')

            ->get();

        return view(
            'company.employees.partials.table',
            compact('employees')
        );
    }
}
