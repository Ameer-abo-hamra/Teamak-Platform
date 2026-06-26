<?php

namespace App\Http\Controllers;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\ValidationException;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $company = auth('company')->user();

        $tasks = $company->tasks()
            ->with(['project', 'employee'])
            ->latest()
            ->get();

        $projects = $company->projects()->pluck('title', 'id');
        $employees = $company->employees()->pluck('first_name', 'id');

        return view('company.tasks.index', compact('tasks', 'projects', 'employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $company = auth('company')->user();
        $projects = $company->projects()->pluck('title', 'id');
        $employees = $company->employees()->pluck('first_name', 'id');

        return view('company.tasks.create', compact('projects', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'priority' => ['required', new Enum(TaskPriority::class)],
                'project_id' => 'required|exists:projects,id',
                'employee_id' => 'required|exists:employees,id',
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date|after_or_equal:start_date',
            ]);

            $task = Task::create([
                'title' => $request->title,
                'description' => $request->description,
                'priority' => $request->priority,
                'project_id' => $request->project_id,
                'employee_id' => $request->employee_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);

            return response()->json([
                'message' => 'Task created successfully',
                'type' => 'success',
                'task' => $task,
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
                'type' => 'validation_error',
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'type' => 'error',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        abort_unless(
            $task->project->company_id === auth('company')->id(),
            404
        );

        $task->load(['project', 'employee']);

        if (request()->wantsJson()) {
            return response()->json([
                'title' => $task->title,
                'description' => $task->description,
                'priority' => $task->priority?->value,
                'task_status' => $task->task_status?->value,
                'project_id' => $task->project_id,
                'employee_id' => $task->employee_id,
                'start_date' => $task->start_date,
                'end_date' => $task->end_date,
            ]);
        }

        $company = auth('company')->user();
        $projects = $company->projects()->pluck('title', 'id');
        $employees = $company->employees()->pluck('first_name', 'id');

        return view('company.tasks.show', compact('task', 'projects', 'employees'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        abort_unless(
            $task->project->company_id === auth('company')->id(),
            404
        );

        $company = auth('company')->user();
        $projects = $company->projects()->pluck('title', 'id');
        $employees = $company->employees()->pluck('first_name', 'id');

        return view('company.tasks.edit', compact('task', 'projects', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        abort_unless(
            $task->project->company_id === auth('company')->id(),
            404
        );

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => ['required', new Enum(TaskPriority::class)],
            'task_status' => ['required', new Enum(TaskStatus::class)],
            'project_id' => 'required|exists:projects,id',
            'employee_id' => 'required|exists:employees,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'task_status' => $request->task_status,
            'project_id' => $request->project_id,
            'employee_id' => $request->employee_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        $task->load(['project', 'employee']);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Task updated successfully',
                'type' => 'success',
                'task' => [
                    'id' => $task->id,
                    'title' => $task->title,
                    'description' => $task->description,
                    'priority' => $task->priority?->value,
                    'task_status' => $task->task_status?->value,
                    'project_id' => $task->project_id,
                    'employee_id' => $task->employee_id,
                    'start_date' => $task->start_date,
                    'end_date' => $task->end_date,
                    'project' => [
                        'title' => $task->project?->title,
                    ],
                    'employee' => [
                        'first_name' => $task->employee?->first_name,
                        'last_name' => $task->employee?->last_name,
                    ],
                ],
            ], 200);
        }

        return redirect()
            ->route('task.show', $task)
            ->with('status', 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        abort_unless(
            $task->project->company_id === auth('company')->id(),
            404
        );

        $task->delete();

        return redirect()
            ->route('company.tasks')
            ->with('status', 'Task deleted successfully');
    }
}
