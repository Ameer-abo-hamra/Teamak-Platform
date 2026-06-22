<?php

namespace App\Http\Controllers;

use App\Enums\ProjectStatus;
use App\HelperFunctions;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Project;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    use HelperFunctions;
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

    public function companyProjects()
    {
        $company = auth('company')->user();

        $completed = $company->projects()
            ->where('project_status', ProjectStatus::COMPLETED)
            ->count();

        $all = $company->projects()

            ->count();

        $active = $company->projects()
            ->where('project_status', ProjectStatus::ACTIVE)
            ->count();

        $projects = $company->projects()
            ->latest()
            ->get();
        return view(
            'company.projects.index',
            compact(
                'projects',
                'completed',
                'all',
                'active'
            )
        );

    }

    public function searchProjects(Request $request)
    {
        $query = Project::query();

        if ($request->filled('search')) {

            $query->where(
                'title',
                'like',
                '%' . $request->search . '%'
            );
        }

        if ($request->filled('status')) {

            $query->where(
                'project_status',
                $request->status
            );
        }

        $projects = $query->latest()->get();

        return view(
            'company.projects.partials.table',
            compact('projects')
        );
    }


    public function tasks()
    {
        $company = auth('company')->user();

        $tasks = $company->tasks()
            ->with([
                'project',
                'employee',
            ])
            ->latest()
            ->get();

        $projects = $this->getCompanyProjects();
        $employees = $this->getCompanyUsers();

        return view(
            'company.tasks.index',
            compact('tasks', 'projects', 'employees')
        );
    }
}
