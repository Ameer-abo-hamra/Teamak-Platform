<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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


            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',

                'priority' => 'required|string',

                'project_id' => 'required|exists:projects,id',
                'employee_id' => 'required|exists:employees,id',
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date|after_or_equal:start_date',
            ]);


            $company = auth('company')->user();


            $task = Task::create([
                'title' => $request->title,
                'description' => $request->description,

                'task_status' => $request->task_status,
                'priority' => $request->priority,

                'project_id' => $request->project_id,
                'employee_id' => $request->employee_id,

                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);



            // 5. Response
            return response()->json([
                'message' => 'Task created successfully',
                'type' => 'success',
                'task' => $task
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
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
