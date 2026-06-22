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

                <tr>

                    {{-- Employee --}}
                    <td class="first">

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
                    <td class="second">
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
                    <td>
                        <span
                            class="{{ $employee->account_status->value == App\Enums\AccountStatus::ACTIVE->value ? 's-active' : 's-in-active' }}">
                            {{ $employee->account_status->value }}
                        </span>
                    </td>

                    {{-- Actions --}}
                    <td>

                        {{-- <span class="delete">
                            <i class="fa-regular fa-trash-can"></i>
                        </span> --}}

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
                    <td colspan="6">
                        No employees found
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</div>