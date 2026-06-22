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

        <!-- Search Input -->
        <input type="text" id="employee-search" name="search" placeholder="search by name email ..">



        <x-form.select name="ameer" :options="$departments" />

        <x-form.select name="test" :options="App\Enums\AccountStatus::labels()" />

    </div>

    <div class="employee-table" id="employee-table">

        @include('company.employees.partials.table', [$employees])

    </div>

    @include('shared.partials.pop-up', [
        'modal_id' => 'invite-modal',
        'title' => 'Invite New Employe',
    ])

@endsection
