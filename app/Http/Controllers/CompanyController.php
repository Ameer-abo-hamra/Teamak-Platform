<?php

namespace App\Http\Controllers;

use App\Enums\AccountStatus;
use App\Enums\ProjectStatus;
use App\Enums\TaskStatus;
use App\HelperFunctions;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

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
    public function edit(Company $company) {}

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

        return view('company.employees.index', compact('departments', 'employees'));
    }

    public function showEmployee(Employee $employee)
    {
        abort_unless(
            $employee->company_id === auth('company')->id(),
            404
        );

        $tasks = $employee->tasks()->with('project')->latest()->get();

        if (request()->wantsJson()) {
            return response()->json([
                'first_name' => $employee->first_name,
                'last_name' => $employee->last_name,
                'email' => $employee->email,
                'phone_number' => $employee->phone_number,
                'address' => $employee->address,
                'job_title' => $employee->job_title,
                'joining_date' => $employee->joining_date,
                'account_status' => $employee->account_status?->value,
            ]);
        }

        return view('company.employees.show', compact('employee', 'tasks'));
    }

    public function editEmployee(Employee $employee)
    {
        abort_unless(
            $employee->company_id === auth('company')->id(),
            404
        );

        return view('company.employees.edit', compact('employee'));
    }

    public function updateEmployee(Request $request, Employee $employee)
    {
        abort_unless(
            $employee->company_id === auth('company')->id(),
            404
        );

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('employees', 'email')->ignore($employee->id),
            ],
            'phone_number' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'job_title' => 'nullable|string|max:255',
            'joining_date' => 'nullable|date',
            'account_status' => ['required', new Enum(AccountStatus::class)],
        ]);

        $employee->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address ?? $employee->address,
            'job_title' => $request->job_title,
            'joining_date' => $request->joining_date ?? $employee->joining_date,
            'account_status' => $request->account_status,
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Employee updated successfully',
                'type' => 'success',
                'employee' => [
                    'id' => $employee->id,
                    'first_name' => $employee->first_name,
                    'last_name' => $employee->last_name,
                    'email' => $employee->email,
                    'phone_number' => $employee->phone_number,
                    'address' => $employee->address,
                    'job_title' => $employee->job_title,
                    'joining_date' => $employee->joining_date,
                    'account_status' => $employee->account_status?->value,
                ],
            ], 200);
        }

        return redirect()
            ->route('company.employee.show', $employee)
            ->with('status', 'Employee updated successfully');
    }

    public function search(Request $request)
    {
        $employees = Employee::query()
            ->where('company_id', auth('company')->id())

            // SEARCH
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })

            // FILTER: department
            // ->when($request->department, function ($query, $department) {
            //     $query->where('department_id', $department);
            // })

            // FILTER: status
            ->when($request->status, function ($query, $status) {
                $query->where('account_status', $status);
            })

            ->latest()
            ->get();

        return view('company.employees.partials.table', compact('employees'));
    }

    public function companyProjects()
    {
        $company = auth('company')->user();

        $completed = $company->projects()
            ->where('project_status', ProjectStatus::COMPLETED)
            ->count();

        $all = $company->projects()->count();

        $active = $company->projects()
            ->where('project_status', ProjectStatus::ACTIVE)
            ->count();

        $projects = $company->projects()
            ->withCount([
                'tasks',
                'employees',
                'tasks as completed_tasks_count' => fn ($query) => $query->where('task_status', TaskStatus::DONE),
            ])
            ->latest()
            ->get();

        return view(
            'company.projects.index',
            compact('projects', 'completed', 'all', 'active')
        );
    }

    public function searchProjects(Request $request)
    {
        $company = auth('company')->user();

        $query = Project::query()
            ->where('company_id', $company->id);

        if ($request->filled('search')) {
            $query->where('title', 'like', '%'.$request->search.'%');
        }

        if ($request->filled('status')) {
            $query->where('project_status', $request->status);
        }

        $projects = $query->withCount([
            'tasks',
            'employees',
            'tasks as completed_tasks_count' => fn ($query) => $query->where('task_status', TaskStatus::DONE),
        ])
            ->latest()
            ->get();

        return view('company.projects.partials.table', compact('projects'));
    }

    public function tasks()
    {
        $company = auth('company')->user();

        $query = $company->tasks()
            ->with(['project', 'employee']);

        // Apply filters
        if (request()->filled('search')) {
            $query->where('title', 'like', '%'.request()->search.'%');
        }

        if (request()->filled('task_status')) {
            $query->where('task_status', request()->task_status);
        }

        if (request()->filled('priority')) {
            $query->where('priority', request()->priority);
        }

        if (request()->filled('project_id')) {
            $query->where('project_id', request()->project_id);
        }

        if (request()->filled('employee_id')) {
            $query->where('employee_id', request()->employee_id);
        }

        $tasks = $query->latest()->get();

        // If AJAX request, return table only
        if (request()->wantsJson() || request()->ajax()) {
            return view('company.tasks.partials.table', compact('tasks'));
        }

        $projects = $this->getCompanyProjects();
        $employees = $this->getCompanyUsers();

        return view('company.tasks.index', compact('tasks', 'projects', 'employees'));
    }
}
