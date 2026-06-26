@extends('layout.company')

@section('custom-title', 'Create Task')
@section('custom-header')
    <x-layout.header title="Create Task" subtitle="Create a new task" searchRoute="#" logoutRoute="company.logout" />
@endsection

@section('custom-content')
    <div class="page-card">
        <p>Use the task dashboard to create tasks via the modal. This page is a fallback for direct links.</p>
    </div>
@endsection
