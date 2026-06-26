<?php

namespace App\Http\Controllers;

use App\Enums\ProjectStatus;
use App\Enums\TaskStatus;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\ValidationException;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.projects.create');
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
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'project_status' => ['required', new Enum(ProjectStatus::class)],
            ]);

            $company = auth('company')->user();

            $project = Project::create([
                'company_id' => $company->id,
                'title' => $request->title,
                'description' => $request->description,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'project_status' => $request->project_status,
            ]);

            return response()->json([
                'message' => 'Project created successfully',
                'type' => 'success',
                'project' => $project,
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
    public function show(Project $project)
    {
        abort_unless(
            $project->company_id === auth('company')->id(),
            404
        );

        $project->load(['tasks.employee', 'employees']);

        $data = [
            'allTasks' => $project->tasks()->count(),
            'completedTasks' => $project->tasks()
                ->where('task_status', TaskStatus::DONE)
                ->count(),
            'employees' => $project->employees->pluck('first_name', 'id')->toArray(),
        ];

        $tasks = $project->tasks()
            ->with('employee')
            ->latest()
            ->get();

        if (request()->wantsJson()) {
            // return simple JSON for modal population
            return response()->json([
                'title' => $project->title,
                'description' => $project->description,
                'start_date' => $project->start_date,
                'end_date' => $project->end_date,
                'project_status' => $project->project_status?->value,
            ]);
        }

        return view('company.projects.show', compact('project', 'data', 'tasks'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        abort_unless(
            $project->company_id === auth('company')->id(),
            404
        );

        return view('company.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        abort_unless(
            $project->company_id === auth('company')->id(),
            404
        );

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'project_status' => ['required', new Enum(ProjectStatus::class)],
        ]);

        $project->update([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'project_status' => $request->project_status,
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Project updated successfully',
                'type' => 'success',
                'project' => [
                    'id' => $project->id,
                    'title' => $project->title,
                    'description' => $project->description,
                    'end_date' => $project->end_date,
                    'project_status' => $project->project_status?->value,
                ],
            ], 200);
        }

        return redirect()
            ->route('project.show', $project)
            ->with('status', 'Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        abort_unless(
            $project->company_id === auth('company')->id(),
            404
        );

        $project->delete();

        return redirect()
            ->route('company.projects.index')
            ->with('status', 'Project deleted successfully');
    }
}
