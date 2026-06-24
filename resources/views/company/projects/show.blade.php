@extends('layout.company') @section('custom-title', 'Projects Mangment') @section('custom-header') <x-layout.header
    title="Projects" subtitle="Tasks,Team and Progress " searchRoute="#" logoutRoute="company.logout" />

@endsection

@section('custom-content')

<div class="top-card">
    <div class="left">
        <div class="logo">

            {{ Str::upper(substr($project->title, 0, 1)) }}
        </div>
        <div class="title">
            <h2>{{ $project->title }}</h2>
            <span
                class="{{ $project->project_status->value == App\Enums\ProjectStatus::ACTIVE->value ? 's-active' : '' }}
                                {{ $project->project_status->value == App\Enums\ProjectStatus::COMPLETED->value ? 's-completed' : '' }}
                                {{ $project->project_status->value == App\Enums\ProjectStatus::ONHOLD->value ? 's-on-hold' : '' }}
                       ">

                {{ ucfirst($project->project_status?->value) }}

            </span>
            <small class="project-description">{{ $project->description }}</small>
        </div>

    </div>
    <div class="right">
        <button class="btn-primary" data-open-modal="create-task-modal">
            <i class="fa-solid fa-plus"></i> task
        </button>
    </div>

    <div class="bottom">
        <p>Overall Progress</p>
        <p>{{ $data['completedTasks'] }}/{{ $data['allTasks'] }} tasks ·
            {{ $data['allTasks'] > 0 ? round(($data['completedTasks'] / $data['allTasks']) * 100) : 0 }}%</p>
        <span class="progress">
            <span class="back-progress"></span>
            <span class="calc-progress"
                style="width: {{ $data['allTasks'] > 0 ? round(($data['completedTasks'] / $data['allTasks']) * 100) : 0 }}%"></span>
        </span>
    </div>
</div>
<x-modal id="create-task-modal" title="Create New Task">

    <form method="POST" class="d-flex-2-col" id="create_task">
        @csrf

        {{-- Task Title --}}
        <div class="invitation-input f-b-100">
            <label for="title">Task Title:</label>

            <input id="title" name="title" placeholder="Enter task title" required />
        </div>

        {{-- Project --}}
        <input type="hidden" name="project_id" value="{{ $project->id }}">

        {{-- Assignee (Employee) --}}
        <div class="invitation-input">
            <label for="employee_id">Assign To:</label>

            <x-form.select id="employee_id" name="employee_id" :options="$data['employees']" />
        </div>

        {{-- Priority --}}
        <div class="invitation-input">
            <label for="priority">Priority:</label>

            <x-form.select id="priority" name="priority" :options="App\Enums\TaskPriority::labels()" />
        </div>

        {{-- Status --}}
        {{-- <div class="invitation-input">
                <label for="status">Status:</label>

                <x-form.select id="status" name="status" :options="App\Enums\TaskStatus::labels()" />
            </div> --}}

        {{-- Due Date --}}
        <div class="invitation-input f-b-100">
            <label for="due_date"> Start Date</label>

            <input id="due_date" type="date" name="start_date" />
        </div>
        <div class="invitation-input f-b-100">
            <label for="due_date">Due Date:</label>

            <input id="due_date" type="date" name="end_date" />
        </div>

        {{-- Description --}}
        <div class="invitation-input f-b-100">
            <label for="description">Description:</label>

            <textarea id="description" name="description" placeholder="Task description..."></textarea>
        </div>

        {{-- Submit --}}
        <div class="submit f-b-100">
            <button type="submit" class="btn-primary" id="create-task">
                Create Task
            </button>
        </div>

    </form>

</x-modal>
@endsection
