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
                <tr>

                    {{-- Task --}}
                    <td class="first">

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
                    <td class="third">
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
                                {{ $task->priority?->value === 'high' ? 'p-high' : '' }}
                                {{ $task->priority?->value === 'medium' ? 'p-medium' : '' }}
                                {{ $task->priority?->value === 'low' ? 'p-low' : '' }}
                            ">
                            {{ ucfirst($task->priority?->value ?? '-') }}
                        </span>

                    </td>

                    {{-- Status --}}
                    <td>

                        <span
                            class="
                                {{ $task->status?->value === 'completed' ? 's-completed' : '' }}
                                {{ $task->status?->value === 'active' ? 's-active' : '' }}
                                {{ $task->status?->value === 'pending' ? 's-on-hold' : '' }}
                            ">
                            {{ ucfirst($task->status?->value ?? '-') }}
                        </span>

                    </td>

                    {{-- Due Date --}}
                    <td class="second">
                        {{ $task->due_date ?? '-' }}
                    </td>

                    {{-- Actions --}}
                    <td>

                        <span class="update">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </span>

                        <span class="show-row">
                            <i class="fa-regular fa-eye"></i>
                        </span>

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
