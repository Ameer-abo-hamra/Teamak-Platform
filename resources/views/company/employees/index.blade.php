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
            <button id="add-employee" class="btn-primary" data-open-modal="invite-modal"><i class="fa-solid fa-plus"></i>Invite
                Employee</button>
        </div>
    </div>

    <div class="search-employee">

        <input type="text" id="employee-search" placeholder="search by name email ..">

        <x-form.select id="department-filter" name="department" :options="$departments" />

        <x-form.select id="status-filter" name="status" :options="App\Enums\AccountStatus::labels()" />
    </div>

    <div class="employee-table" id="employee-table">

        @include('company.employees.partials.table', ['employees' => $employees])

    </div>

    @include('shared.partials.pop-up', [
        'modal_id' => 'invite-modal',
        'title' => 'Invite New Employe',
    ])

    <x-modal id="edit-employee-modal" title="Edit Employee">
        <form class="d-flex-2-col ajax-update" data-endpoint="" data-method="POST">
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

@endsection
