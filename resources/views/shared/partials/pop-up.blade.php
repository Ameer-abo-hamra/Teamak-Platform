<x-modal id="{{ $modal_id }}" title="{{ $title }}">

    <form id="invite-form" class="d-flex-2-col">
        <div class="invitation-input">
            <label for="job_title"> Job Titlet:</label>

            <input id="job_title" name="job_title" placeholder="Job Title" />
        </div>



        <div class="invitation-input">
            <label for="department_id"> Select Department:</label>

            <x-form.select id="department_id" name="department_id" :options="config('departments')" />
        </div>
        <div class="invitation-input f-b-100">
            <label for="email"> Employee Email:</label>
            <input id="email" type="email" name="employee_email" placeholder="Employee Email" class="w-75">

        </div>

        <div class="invitation-input">
            <label for="description"> Invitation Description:</label>

            <textarea id="description" name="description" value='bal bla'></textarea>
        </div>

        <div class="submit">
            <button type="submit" class="btn-primary">
                Send Invitation
            </button>
        </div>

    </form>
</x-modal>
