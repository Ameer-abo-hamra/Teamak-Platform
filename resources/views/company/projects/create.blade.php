@extends('layout.company')

@section('custom-title', 'Create Project')
@section('custom-header')
    <x-layout.header title="Create Project" subtitle="Create a new project" searchRoute="#" logoutRoute="company.logout" />
@endsection

@section('custom-content')
    <div class="page-card">
        <p>Use the project dashboard to create projects via the modal. This page is a fallback for direct links.</p>
    </div>
@endsection
