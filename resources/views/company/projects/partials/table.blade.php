{{-- CHANGED: Added wrapper to use the global table.css styles --}}
<div class="data-table-wrapper">

    {{-- CHANGED: Added the shared table class --}}
    <table class="data-table">

        <thead>
            <tr>
                <th>Project</th>
                <th>Department</th>
                <th>Progress</th>
                <th>Status</th>
                <th>Deadline</th>
                <th>Team</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody id="projects-tbody">

            @forelse($projects as $project)
                <tr>

                    {{-- Project --}}
                    <td class="first">

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

                    {{-- CHANGED: Added class="third" to reuse generic text styling --}}
                    <td class="third">
                        <span>
                            {{ $project->department->name ?? '-' }}
                        </span>
                    </td>

                    {{-- CHANGED: Added class="second" to reuse generic text styling --}}
                    <td class="second">
                        <span>
                            {{ $project->progress }}%
                        </span>
                    </td>

                    {{-- Status --}}
                    <td>

                        <span
                            class="
                                {{ $project->project_status->value == App\Enums\ProjectStatus::ACTIVE->value ? 's-active' : '' }}
                                {{ $project->project_status->value == App\Enums\ProjectStatus::COMPLETED->value ? 's-completed' : '' }}
                                {{ $project->project_status->value == App\Enums\ProjectStatus::ONHOLD->value ? 's-on-hold' : '' }}
                            ">

                            {{ ucfirst($project->project_status?->value) }}

                        </span>

                    </td>

                    {{-- CHANGED: Added class="second" to reuse generic text styling --}}
                    <td class="second fs-14 color-gray">
                        {{ $project->end_date }}
                    </td>

                    {{-- CHANGED: Added class="second" to reuse generic text styling --}}
                    <td class="second">
                        {{ $project->employees_count }}
                    </td>

                    {{-- Actions --}}
                    <td>

                        {{-- Reuses shared action styles --}}
                        <span class="update">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </span>

                        {{-- Reuses shared action styles --}}
                        <span class="show-row">
                            <i class="fa-regular fa-eye"></i>
                        </span>

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
