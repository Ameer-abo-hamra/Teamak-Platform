@extends('layout.company')

@section('custom-title', 'Task Details')
@section('custom-header')
    <x-layout.header title="Task Details" subtitle="View task summary" searchRoute="#" logoutRoute="company.logout" />
@endsection

@section('custom-content')
    <div class="page-card">
        <div class="task-meta">
            <h2>{{ $task->title }}</h2>
            <p>{{ $task->description }}</p>
            <span class="tag {{ strtolower($task->priority->value) }}">{{ $task->priority->value }}</span>
            <span class="tag {{ strtolower($task->task_status->value) }}">{{ $task->task_status->value }}</span>
        </div>

        <div class="task-details">
            <p><strong>Project:</strong> {{ $task->project?->title ?? '-' }}</p>
            <p><strong>Assignee:</strong> {{ $task->employee?->first_name }} {{ $task->employee?->last_name }}</p>
            <p><strong>Start date:</strong> {{ $task->start_date ?? '-' }}</p>
            <p><strong>Due date:</strong> {{ $task->end_date ?? '-' }}</p>
        </div>

        <div class="actions">
            <button class="btn-secondary" data-edit-modal="edit-task-modal" data-url="{{ route('task.show', $task) }}" data-endpoint="{{ route('task.update', $task) }}">Edit Task</button>
            <a href="{{ route('company.tasks') }}" class="btn-primary">Back to Tasks</a>
        </div>
    </div>
@endsection

<x-modal id="edit-task-modal" title="Edit Task">
    <form class="d-flex-2-col ajax-update" data-endpoint="{{ route('task.update', $task) }}" data-method="POST">
        @csrf
        @method('PUT')

        <div class="invitation-input f-b-100">
            <label for="title">Task Title:</label>
            <input id="title" name="title" />
        </div>

        <div class="invitation-input">
            <label for="project_id">Project</label>
            <x-form.select id="project_id" name="project_id" :options="$projects" />
        </div>

        <div class="invitation-input">
            <label for="employee_id">Assign To:</label>
            <x-form.select id="employee_id" name="employee_id" :options="$employees" />
        </div>

        <div class="invitation-input">
            <label for="priority">Priority</label>
            <x-form.select id="priority" name="priority" :options="App\Enums\TaskPriority::labels()" />
        </div>

        <div class="invitation-input">
            <label for="task_status">Status</label>
            <x-form.select id="task_status" name="task_status" :options="App\Enums\TaskStatus::labels()" />
        </div>

        <div class="invitation-input f-b-100">
            <label for="start_date">Start Date</label>
            <input id="start_date" type="date" name="start_date" />
        </div>

        <div class="invitation-input f-b-100">
            <label for="end_date">Due Date</label>
            <input id="end_date" type="date" name="end_date" />
        </div>

        <div class="invitation-input f-b-100">
            <label for="description">Description</label>
            <textarea id="description" name="description"></textarea>
        </div>

        <div class="submit f-b-100">
            <button type="submit" class="btn-primary">Update Task</button>
        </div>
    </form>
</x-modal>
