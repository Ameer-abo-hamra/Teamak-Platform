<?php

namespace App\Http\Controllers;

use App\Enums\TaskStatus;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

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
        try {

            // 1. Validate
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',

                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',

                'project_status' => 'required|string',
            ]);

            // 2. Company
            $company = auth('company')->user();

            // 3. Create Project
            $project = Project::create([
                'company_id' => $company->id,

                'title' => $request->title,
                'description' => $request->description,

                'start_date' => $request->start_date,
                'end_date' => $request->end_date,

                'project_status' => $request->project_status,
            ]);



            // 5. Response
            return response()->json([
                'message' => 'Project created successfully',
                'type' => 'success',
                'project' => $project
            ], 200);

        } catch (ValidationException $e) {

            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
                'type' => 'validation_error'
            ], 422);

        } catch (\Exception $e) {



            return response()->json([
                'message' => $e->getMessage(),
                'type' => 'error'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $data = [
            'allTasks' => $project->tasks()->count(),
            'completedTasks' => $project->tasks()
                ->where('task_status', TaskStatus::DONE)
                ->count(),
            'employees' => auth('company')->user()->employees->pluck('first_name', 'id')
        ];

        return view('company.projects.show', compact('project', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
