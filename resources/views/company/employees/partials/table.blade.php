<div class="data-table-wrapper">

    <table class="data-table">

        <thead>
            <tr>
                <th>Employee</th>
                <th>Title</th>
                <th>Department</th>
                <th>Role</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

            @forelse($employees as $employee)

                <tr data-employee-row-id="{{ $employee->id }}">

                    {{-- Employee --}}
                    <td class="first employee-info">

                        <div class="left">
                            <p>
                                {{ strtoupper($employee->first_name[0]) }}
                                {{ strtoupper($employee->first_name[1] ?? '') }}
                            </p>
                        </div>

                        <div class="right">
                            <p>{{ $employee->first_name }} {{ $employee->last_name }}</p>
                            <small>{{ $employee->email }}</small>
                        </div>

                    </td>

                    {{-- Title --}}
                    <td class="second employee-title">
                        {{ $employee->job_title ?? '-' }}
                    </td>

                    {{-- Department --}}
                    <td class="third">
                        <span>
                            {{ $employee->department->name ?? 'Engineering' }}
                        </span>
                    </td>

                    {{-- Role --}}
                    <td>
                        <span class="{{ $employee->role == 'Maneger' ? 'r-m' : 'r-e' }}">
                            {{ $employee->role ?? 'Employee' }}
                        </span>
                    </td>

                    {{-- Status --}}
                    <td class="employee-status">
                        <span
                            class="employee-status-badge {{ $employee->account_status->value == App\Enums\AccountStatus::ACTIVE->value ? 's-active' : 's-in-active' }}">
                            {{ $employee->account_status->value }}
                        </span>
                    </td>

                    {{-- Actions --}}
                    <td>
                        <button type="button" class="update" data-edit-modal="edit-employee-modal" data-url="{{ route('company.employee.show', $employee) }}" data-endpoint="{{ route('company.employee.update', $employee) }}">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </button>

                        <a href="{{ route('company.employee.show', $employee) }}" class="show-row">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="6">
                        No employees found
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</div>
