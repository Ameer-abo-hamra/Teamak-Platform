<div class="data-table-wrapper">

    <table class="data-table">

        <thead>
            <tr>
                <th>Task</th>
                <th>Project</th>
                <th>Assigned To</th>
                <th>Priority</th>
                <th>Status</th>
                <th>Due Date</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

            @forelse($tasks as $task)
                <tr data-task-row-id="{{ $task->id }}">

                    {{-- Task --}}
                    <td class="first task-info">

                        <div class="left">
                            <p>
                                {{ strtoupper(substr($task->title, 0, 1)) }}
                            </p>
                        </div>

                        <div class="right">
                            <p>{{ $task->title }}</p>

                            @if ($task->description)
                                <small>
                                    {{ Str::limit($task->description, 40) }}
                                </small>
                            @endif
                        </div>

                    </td>

                    {{-- Project --}}
                    <td class="third task-project">
                        <span>
                            {{ $task->project?->title ?? '-' }}
                        </span>
                    </td>

                    {{-- Assigned Employee --}}
                    <td class="third">
                        <span>
                            {{ $task->employee?->first_name }}
                            {{ $task->employee?->last_name }}
                        </span>
                    </td>

                    {{-- Priority --}}
                    <td>

                        <span
                            class="
        {{ $task->priority?->value === App\Enums\TaskPriority::LOW->value ? 'p-low' : '' }}
        {{ $task->priority?->value === App\Enums\TaskPriority::MEDIUM->value ? 'p-medium' : '' }}
        {{ $task->priority?->value === App\Enums\TaskPriority::HIGH->value ? 'p-high' : '' }}
        {{ $task->priority?->value === App\Enums\TaskPriority::CRITICAL->value ? 'p-critical' : '' }}
    ">
                            {{ $task->priority?->value ?? '-' }}
                        </span>

                    </td>

                    {{-- Status --}}
                    <td>

                        <span
                            class="
        {{ $task->task_status?->value === App\Enums\TaskStatus::TODO->value ? 's-to-do' : '' }}
        {{ $task->task_status?->value === App\Enums\TaskStatus::INPROGRESS->value ? 's-in-progress' : '' }}
        {{ $task->task_status?->value === App\Enums\TaskStatus::INREVIEW->value ? 's-in-review' : '' }}

        {{ $task->task_status?->value === App\Enums\TaskStatus::DONE->value ? 's-done' : '' }}
    ">
                            {{ $task->task_status?->value ?? '-' }}
                        </span>

                    </td>

                    {{-- Due Date --}}
                    <td class="second">
                        {{ $task->end_date ?? '-' }}
                    </td>

                    {{-- Actions --}}
                    <td>
                        <button type="button" class="update" data-edit-modal="edit-task-modal"
                            data-url="{{ route('task.show', $task) }}"
                            data-endpoint="{{ route('task.update', $task) }}">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </button>

                        <a href="{{ route('task.show', $task) }}" class="show-row">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7">
                        No tasks found
                    </td>

                </tr>
            @endforelse

        </tbody>

    </table>

</div>
