@extends('layout.company')

@section('custom-title', 'Employee Details')
@section('custom-header')
    <x-layout.header title="Employee Details" subtitle="View employee profile" searchRoute="#" logoutRoute="company.logout" />
@endsection

@section('custom-content')
    <div class="page-card">
        <div class="employee-summary">
            <div class="head">
                <h2>{{ $employee->first_name }} {{ $employee->last_name }}</h2>

                <span
                    class="{{ $employee->account_status->value == App\Enums\AccountStatus::ACTIVE->value ? 's-active' : 's-in-active' }}">
                    {{ $employee->account_status->value }}
                </span>
            </div>
            <div class="body">
                <p>{{ $employee->email }}</p>
                <span class="job-title">{{ $employee->job_title ?? 'Employee' }}</span>
            </div>

            <div class="actions">
                <a href="{{ route('company.employee.index') }}" class="btn-back">
                    Back to Employees
                </a>

                <button class="btn-edit" data-edit-modal="edit-employee-modal"
                    data-url="{{ route('company.employee.show', $employee) }}"
                    data-endpoint="{{ route('company.employee.update', $employee) }}">
                    Edit Employee
                </button>
            </div>
        </div>

        <div class="employee-meta">

            <div class="meta-item">
                <span class="meta-icon"><i class="fa-solid fa-phone"></i></span>
                <div>
                    <small>Phone</small>
                    <strong>{{ $employee->phone_number ?? '-' }}</strong>
                </div>
            </div>

            <div class="meta-item">
                <span class="meta-icon"><i class="fa-solid fa-map-pin"></i></span>
                <div>
                    <small>Address</small>
                    <strong>{{ $employee->address ?? '-' }}</strong>
                </div>
            </div>

            <div class="meta-item">
                <span class="meta-icon"><i class="fa-regular fa-calendar-days"></i></span>
                <div>
                    <small>Joined</small>
                    <strong>{{ $employee->joining_date ?? '-' }}</strong>
                </div>
            </div>

        </div>

        <div class="employee-tasks">
            <h3>Assigned Tasks</h3>
            @if ($tasks->isEmpty())
                <p>No tasks assigned to this employee.</p>
            @else
                <div class="data-table-wrapper">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Task</th>
                                <th>Project</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Start Date</th>
                                <th>Due Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td class="first">
                                        <div class="left">
                                            <p>{{ strtoupper(substr($task->title, 0, 1)) }}</p>
                                        </div>
                                        <div class="right">
                                            <p>{{ $task->title }}</p>
                                            @if ($task->description)
                                                <small>{{ Str::limit($task->description, 40) }}</small>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="third">
                                        <span>{{ $task->project?->title ?? '-' }}</span>
                                    </td>
                                    <td>
                                        <span class="
                                            {{ $task->priority?->value === App\Enums\TaskPriority::LOW->value ? 'p-low' : '' }}
                                            {{ $task->priority?->value === App\Enums\TaskPriority::MEDIUM->value ? 'p-medium' : '' }}
                                            {{ $task->priority?->value === App\Enums\TaskPriority::HIGH->value ? 'p-high' : '' }}
                                            {{ $task->priority?->value === App\Enums\TaskPriority::CRITICAL->value ? 'p-critical' : '' }}
                                        ">
                                            {{ $task->priority?->value ?? '-' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="
                                            {{ $task->task_status?->value === App\Enums\TaskStatus::TODO->value ? 's-todo' : '' }}
                                            {{ $task->task_status?->value === App\Enums\TaskStatus::INPROGRESS->value ? 's-active' : '' }}
                                            {{ $task->task_status?->value === App\Enums\TaskStatus::INREVIEW->value ? 's-on-hold' : '' }}
                                            {{ $task->task_status?->value === App\Enums\TaskStatus::DONE->value ? 's-completed' : '' }}
                                        ">
                                            {{ $task->task_status?->value ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="second">
                                        {{ $task->start_date ?? '-' }}
                                    </td>
                                    <td class="second">
                                        {{ $task->end_date ?? '-' }}
                                    </td>
                                    <td>
                                        <a href="{{ route('task.show', $task) }}" class="show-row">
                                            <i class="fa-regular fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    </div>
@endsection

<x-modal id="edit-employee-modal" title="Edit Employee">
    <form class="d-flex-2-col ajax-update" data-endpoint="{{ route('company.employee.update', $employee) }}"
        data-method="POST">
        @csrf
        @method('PUT')

        <div class="invitation-input">
            <label for="first_name">First Name</label>
            <input id="first_name" name="first_name" />
        </div>

        <div class="invitation-input">
            <label for="last_name">Last Name</label>
            <input id="last_name" name="last_name" />
        </div>

        <div class="invitation-input">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" />
        </div>

        <div class="invitation-input">
            <label for="phone_number">Phone</label>
            <input id="phone_number" name="phone_number" />
        </div>

        <div class="invitation-input">
            <label for="job_title">Job Title</label>
            <input id="job_title" name="job_title" />
        </div>

        <div class="invitation-input">
            <label for="address">Address</label>
            <input id="address" name="address" />
        </div>

        <div class="invitation-input">
            <label for="joining_date">Joining Date</label>
            <input id="joining_date" type="date" name="joining_date" />
        </div>

        <div class="invitation-input f-b-100">
            <label for="account_status">Status</label>
            <x-form.select id="account_status" name="account_status" :options="App\Enums\AccountStatus::labels()" />
        </div>

        <div class="submit f-b-100">
            <button type="submit" class="btn-primary">Update Employee</button>
        </div>
    </form>
</x-modal>
