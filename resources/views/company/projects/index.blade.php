@extends('layout.company') @section('custom-title', 'Projects Mangment') @section('custom-header') <x-layout.header
    title="Projects" subtitle="Manege your Projects " searchRoute="#" logoutRoute="company.logout" />

@endsection

@section('custom-content') <div class="porject-container">
    <div class="header">


        @include('company.projects.partials.content-header', [
        'active' => $active,
        'completed' => $completed,
        'all' => $all,
    ])

    </div>
    <div class="projects-center">
        <div class="center-header">
            <div class="filters">

                <button data-status="" class="active">All</button>
                <button data-status="active" class=""> Active </button>
                <button data-status="on_hold"> On Hold </button>
                <button data-status="completed"> Completed </button>
            </div>
            <div class="right">
                <input type="text" id="projects-search" class="search-project" placeholder="search projects..">

                <button class="btn-primary" data-open-modal="create-project-modal">
                    <i class="fa-solid fa-plus"></i> project
                </button>
            </div>
            <x-modal id="create-project-modal" title="Create New Project">

                <form id="create_project" class="d-flex-2-col">

                    @csrf

                    {{-- Project Title --}}
                    <div class="invitation-input f-b-100">
                        <label for="title">Project Title:</label>

                        <input id="title" name="title" placeholder="Project title" required />
                    </div>

                    {{-- Description --}}
                    <div class="invitation-input f-b-100">
                        <label for="description">Description:</label>

                        <textarea id="description" name="description" placeholder="Project description"></textarea>
                    </div>

                    {{-- Start Date --}}
                    <div class="invitation-input">
                        <label for="start_date">Start Date:</label>

                        <input type="date" name="start_date" id="start_date">
                    </div>

                    {{-- End Date --}}
                    <div class="invitation-input">
                        <label for="end_date">End Date:</label>

                        <input type="date" name="end_date" id="end_date">
                    </div>

                    {{-- Status --}}
                    <div class="invitation-input f-b-100">
                        <label for="project_status">Status:</label>

                        <x-form.select id="project_status" name="project_status" :options="App\Enums\ProjectStatus::labels()" />
                    </div>

                    {{-- Submit --}}
                    <div class="submit f-b-100">
                        <button type="submit" class="btn-primary">
                            Create Project
                        </button>
                    </div>

                </form>

            </x-modal>

            <x-modal id="edit-project-modal" title="Edit Project">
                <form class="d-flex-2-col ajax-update" data-endpoint="" data-method="POST">
                    @csrf
                    @method('PUT')

                    <div class="invitation-input f-b-100">
                        <label for="title">Project Title:</label>
                        <input id="title" name="title" />
                    </div>

                    <div class="invitation-input f-b-100">
                        <label for="description">Description:</label>
                        <textarea id="description" name="description"></textarea>
                    </div>

                    <div class="invitation-input">
                        <label for="start_date">Start Date:</label>
                        <input type="date" name="start_date" id="start_date" />
                    </div>

                    <div class="invitation-input">
                        <label for="end_date">End Date:</label>
                        <input type="date" name="end_date" id="end_date" />
                    </div>

                    <div class="invitation-input f-b-100">
                        <label for="project_status">Status:</label>
                        <x-form.select id="project_status" name="project_status" :options="App\Enums\ProjectStatus::labels()" />
                    </div>

                    <div class="submit f-b-100">
                        <button type="submit" class="btn-primary">Update Project</button>
                    </div>
                </form>
            </x-modal>
        </div>
        <div class="employee-table" id="projects-table">
            @include('company.projects.partials.table', ['projects' => $projects])
        </div>
    </div>
</div> @endsection
