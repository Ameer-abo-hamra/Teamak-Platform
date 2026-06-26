@extends('layout.company')

@section('custom-title', 'Create Employee')
@section('custom-header')
    <x-layout.header title="Create Employee" subtitle="Invite or add new employee" searchRoute="#" logoutRoute="company.logout" />
@endsection

@section('custom-content')
    <div class="page-card">
        <p>Use the employees page to invite and manage team members. This page is a fallback for direct links.</p>
    </div>
@endsection
