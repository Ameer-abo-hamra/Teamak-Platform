@extends('layout.company')

@section('custom-title', 'Edit Employee')
@section('custom-header')
    <x-layout.header title="Edit Employee" subtitle="Update employee profile" searchRoute="#" logoutRoute="company.logout" />
@endsection

@section('custom-content')
    <div class="page-card">
        <form action="{{ route('company.employee.update', $employee) }}" method="POST" class="d-flex-2-col">
            @csrf
            @method('PUT')

            <div class="invitation-input">
                <label for="first_name">First Name</label>
                <input id="first_name" name="first_name" value="{{ old('first_name', $employee->first_name) }}" required />
            </div>

            <div class="invitation-input">
                <label for="last_name">Last Name</label>
                <input id="last_name" name="last_name" value="{{ old('last_name', $employee->last_name) }}" required />
            </div>

            <div class="invitation-input">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email', $employee->email) }}" required />
            </div>

            <div class="invitation-input">
                <label for="phone_number">Phone</label>
                <input id="phone_number" name="phone_number" value="{{ old('phone_number', $employee->phone_number) }}" />
            </div>

            <div class="invitation-input">
                <label for="address">Address</label>
                <input id="address" name="address" value="{{ old('address', $employee->address) }}" />
            </div>

            <div class="invitation-input">
                <label for="job_title">Job Title</label>
                <input id="job_title" name="job_title" value="{{ old('job_title', $employee->job_title) }}" />
            </div>

            <div class="invitation-input">
                <label for="joining_date">Joining Date</label>
                <input id="joining_date" type="date" name="joining_date" value="{{ old('joining_date', $employee->joining_date) }}" />
            </div>

            <div class="invitation-input f-b-100">
                <label for="account_status">Status</label>
                <x-form.select id="account_status" name="account_status" :options="App\Enums\AccountStatus::labels()" selected="{{ old('account_status', $employee->account_status->value) }}" />
            </div>

            <div class="submit f-b-100">
                <button type="submit" class="btn-primary">Update Employee</button>
            </div>
        </form>
    </div>
@endsection
