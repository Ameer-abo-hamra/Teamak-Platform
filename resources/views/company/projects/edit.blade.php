@extends('layout.company')

@section('custom-title', 'Edit Project')
@section('custom-header')
    <x-layout.header title="Edit Project" subtitle="Update project details" searchRoute="#" logoutRoute="company.logout" />
@endsection

@section('custom-content')
    <div class="page-card">
        <form action="{{ route('project.update', $project) }}" method="POST" class="d-flex-2-col">
            @csrf
            @method('PUT')

            <div class="invitation-input f-b-100">
                <label for="title">Project Title:</label>
                <input id="title" name="title" value="{{ old('title', $project->title) }}" required />
            </div>

            <div class="invitation-input f-b-100">
                <label for="description">Description:</label>
                <textarea id="description" name="description" required>{{ old('description', $project->description) }}</textarea>
            </div>

            <div class="invitation-input">
                <label for="start_date">Start Date:</label>
                <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $project->start_date) }}" required />
            </div>

            <div class="invitation-input">
                <label for="end_date">End Date:</label>
                <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $project->end_date) }}" required />
            </div>

            <div class="invitation-input f-b-100">
                <label for="project_status">Status:</label>
                <x-form.select id="project_status" name="project_status" :options="App\Enums\ProjectStatus::labels()" selected="{{ old('project_status', $project->project_status->value) }}" />
            </div>

            <div class="submit f-b-100">
                <button type="submit" class="btn-primary">Update Project</button>
            </div>
        </form>
    </div>
@endsection
