@extends('layout.company')

@section('custom-title', 'Employe Mangment')
@section('custom-header')
    <x-layout.header title="Employees" subtitle="Manege your team " searchRoute="#" logoutRoute="company.logout" />
@endsection


@section('custom-content')

    <div class="top">

        <div class="left">
            <span>total 8 , active 2</span>
        </div>
        <div class="right">
            <button id="add-employee" class="btn-primary"><i class="fa-solid fa-plus"></i>Invite Employee</button>
        </div>
    </div>

    <div class="search-employee">

        <!-- Search Input -->
        <input type="text" name="search" placeholder="search by name email ..">

        {{-- <select name="department_id" class="select">
            <option value="">All Departments</option>

            @foreach ($departments as $department)
                <option value="{{ $department }}">
                    {{ $department }}
                </option>
            @endforeach
        </select>

        <select name="account_status" class="select">
            <option value="">All Status</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
            <option value="suspended">Suspended</option>
        </select> --}}

        <x-form.select name="ameer" :options="$departments" />

        <x-form.select name="test" :options="App\Enums\AccountStatus::labels()" />

    </div>

    <div class="employee-table">

        <table>
            <thead>
                <tr>
                    <th>Employee</th>
                    <th>title</th>
                    <th>Department</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($employees as $employee)
                    <tr>
                        <td class="first">
                            <div class="left">
                                <p>{{ strtoupper($employee->first_name[0]) }}{{ strtoupper($employee->first_name[1]) }}</p>
                            </div>
                            <div class="right">
                                <p>{{ $employee->first_name }} {{ $employee->last_name }}</p>
                                <small>{{ $employee->email }}</small>
                            </div>
                        </td>

                        <td class="second">{{ $employee->title ?? '-' }}</td>

                        <td class="third">
                            <span>{{ $employee->department->name ?? 'Engineering' }}</span>
                        </td>

                        <td>
                            <span
                                class="{{ $employee->role == 'Maneger' ? 'r-m' : 'r-e' }}">{{ $employee->role ?? 'Employee' }}</span>
                        </td>

                        <td>
                            <span
                                class="{{ $employee->account_status->value == App\Enums\AccountStatus::ACTIVE->value ? 's-active' : 's-in-active' }}">
                                {{ $employee->account_status->value }}
                            </span>
                        </td>

                        <td>
                            <span class="delete"><i class="fa-regular fa-trash-can"></i></span>
                            <span class="update"><i class="fa-regular fa-pen-to-square"></i></span>
                            <span class=".show-row"><i class="fa-regular fa-eye"></i></span>
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="6">No employees found</td>
                    </tr>
                @endforelse

            </tbody>
        </table>

    </div>

    @include('shared.partials.pop-up', [
        'modal_id' => 'invite-modal',
        'title' => 'Invite New Employe',
    ])
@endsection
