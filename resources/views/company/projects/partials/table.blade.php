{{-- CHANGED: Added wrapper to use the global table.css styles --}}
<div class="data-table-wrapper">

    {{-- CHANGED: Added the shared table class --}}
    <table class="data-table">

        <thead>
            <tr>
                <th>Project</th>
                <th>Tasks</th>
                <th>Progress</th>
                <th>Status</th>
                <th>Deadline</th>
                <th>Team</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody id="projects-tbody">

            @forelse($projects as $project)
                <tr data-project-row-id="{{ $project->id }}">

                    {{-- Project --}}
                    <td class="first project-info">

                        {{-- Reuses the shared avatar style from table.css --}}
                        <div class="left">
                            <p>
                                {{ strtoupper(substr($project->title, 0, 1)) }}
                            </p>
                        </div>

                        {{-- Reuses the shared content style from table.css --}}
                        <div class="right">
                            <p>{{ $project->title }}</p>
                            <small>{{ $project->description }}</small>
                        </div>

                    </td>

                    <td class="third">
                        <span>
                            {{ $project->tasks_count ?? 0 }}
                        </span>
                    </td>

                    <td class="second">
                        <span>
                            {{ $project->tasks_count > 0 ? round(($project->completed_tasks_count / $project->tasks_count) * 100) : 0 }}%
                        </span>
                    </td>

                    {{-- Status --}}
                    <td class="project-status-cell">

                        <span
                            class="project-status
                                {{ $project->project_status->value == App\Enums\ProjectStatus::ACTIVE->value ? 's-active' : '' }}
                                {{ $project->project_status->value == App\Enums\ProjectStatus::COMPLETED->value ? 's-completed' : '' }}
                                {{ $project->project_status->value == App\Enums\ProjectStatus::ONHOLD->value ? 's-on-hold' : '' }}
                            ">

                            {{ ucfirst($project->project_status?->value) }}

                        </span>

                    </td>

                    {{-- CHANGED: Added class="second" to reuse generic text styling --}}
                    <td class="second fs-14 color-gray project-deadline">
                        {{ $project->end_date }}
                    </td>

                    {{-- CHANGED: Added class="second" to reuse generic text styling --}}
                    <td class="second">
                        {{ $project->employees_count }}
                    </td>

                    {{-- Actions --}}
                    <td>
                        <button type="button" class="update" data-edit-modal="edit-project-modal" data-url="{{ route('project.show', $project) }}" data-endpoint="{{ route('project.update', $project) }}">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </button>

                        <a href="{{ route('project.show', $project) }}" class="show-row">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                    </td>

                </tr>

            @empty

                <tr>

                    {{-- Unchanged except formatting --}}
                    <td colspan="7">
                        No projects found
                    </td>

                </tr>
            @endforelse

        </tbody>

    </table>

</div>
