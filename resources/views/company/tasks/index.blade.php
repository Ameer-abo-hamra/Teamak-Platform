@extends('layout.company')

@section('custom-title', 'Tasks Mangment')
@section('custom-header')
    <x-layout.header title="Tasks" subtitle="Manege your Tasks " searchRoute="#" logoutRoute="company.logout" />
@endsection


@section('custom-content')

    <div class="top">
        <div class="left">13 / 3</div>
        <div class="right">
            <button class="btn-primary" data-open-modal="create-task-modal">
                <i class="fa-solid fa-plus"></i> task
            </button>
        </div>
    </div>


    <div class="search-employee">

        <!-- Search Input -->
        <input type="text" id="employee-search" name="search" placeholder="search by task name ..">



        <x-form.select name="task_status" :options="App\Enums\TaskStatus::labels()" placeholder="All Status" />
        @php
            // dd(App\Enums\TaskPriority::labels());
            // dd($projects);
        @endphp
        <x-form.select name="priority" :options="App\Enums\TaskPriority::labels()" placeholder="Priority" />
        <x-form.select name="project_id" :options="$projects" placeholder="All projects" />
        <x-form.select name="employee_id" :options="$employees" placeholder="All Assignees" />

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
            <div class="invitation-input">
                <label for="project_id">Select Project:</label>

                <x-form.select id="project_id" name="project_id" :options="$projects" />
            </div>

            {{-- Assignee (Employee) --}}
            <div class="invitation-input">
                <label for="employee_id">Assign To:</label>

                <x-form.select id="employee_id" name="employee_id" :options="$employees" />
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

    <x-modal id="edit-task-modal" title="Edit Task">
        <form class="d-flex-2-col ajax-update" data-endpoint="" data-method="POST">
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

    @include('company.tasks.partials.table', ['tasks' => $tasks])
@endsection
