@extends('layout.company')

@section('custom-title', 'Edit Task')
@section('custom-header')
    <x-layout.header title="Edit Task" subtitle="Update task details" searchRoute="#" logoutRoute="company.logout" />
@endsection

@section('custom-content')
    <div class="page-card">
        <form action="{{ route('task.update', $task) }}" method="POST" class="d-flex-2-col">
            @csrf
            @method('PUT')

            <div class="invitation-input f-b-100">
                <label for="title">Task Title:</label>
                <input id="title" name="title" value="{{ old('title', $task->title) }}" required />
            </div>

            <div class="invitation-input">
                <label for="project_id">Project</label>
                <x-form.select id="project_id" name="project_id" :options="$projects" selected="{{ old('project_id', $task->project_id) }}" />
            </div>

            <div class="invitation-input">
                <label for="employee_id">Assign To:</label>
                <x-form.select id="employee_id" name="employee_id" :options="$employees" selected="{{ old('employee_id', $task->employee_id) }}" />
            </div>

            <div class="invitation-input">
                <label for="priority">Priority</label>
                <x-form.select id="priority" name="priority" :options="App\Enums\TaskPriority::labels()" selected="{{ old('priority', $task->priority->value) }}" />
            </div>

            <div class="invitation-input">
                <label for="task_status">Status</label>
                <x-form.select id="task_status" name="task_status" :options="App\Enums\TaskStatus::labels()" selected="{{ old('task_status', $task->task_status->value) }}" />
            </div>

            <div class="invitation-input f-b-100">
                <label for="start_date">Start Date</label>
                <input id="start_date" type="date" name="start_date" value="{{ old('start_date', $task->start_date) }}" />
            </div>

            <div class="invitation-input f-b-100">
                <label for="end_date">Due Date</label>
                <input id="end_date" type="date" name="end_date" value="{{ old('end_date', $task->end_date) }}" />
            </div>

            <div class="invitation-input f-b-100">
                <label for="description">Description</label>
                <textarea id="description" name="description" required>{{ old('description', $task->description) }}</textarea>
            </div>

            <div class="submit f-b-100">
                <button type="submit" class="btn-primary">Update Task</button>
            </div>
        </form>
    </div>
@endsection
