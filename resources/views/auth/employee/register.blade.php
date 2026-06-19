@extends('layout.auth')

@section('title', 'Accept Invitation')



@section('content')

    <div class="container">

        <x-form.card>

            <div class="form-header">
                <h1>Accept Invitation</h1>
                <p>Create your account to join the company</p>
            </div>

            <div class="form-body">
                <form action="{{ route('employee.register.post') }}" method="post">
                    @csrf

                    <x-form.input name="first_name" label="First Name" :required="true" />
                    <x-form.input name="last_name" label="Last Name" :required="true" />
                    <x-form.input name="job_title" type="hidden" :value="$data['job_title']" />
                    <x-form.input name="employee_email" type="hidden" :value="$data['employee_email']" />
                    <x-form.input name="company_id" type="hidden" :value="$data['company_id']" />

                    <x-form.input name="password" label="Create Password" type="password" :class="'password'"
                        :required="true" />

                    <x-form.input name="Phone_number" label="Phone Number" :required="true" />
                    <x-form.input name="Address" label="Address" />

                    <x-form.button text="Accept Invitation" />
                </form>
            </div>

            {{-- <div class="form-footer">
                <p>
                    Already have an account?
                    <a href="{{ route('company.login') }}" class="side-btn">
                        Login here
                    </a>
                </p>
            </div> --}}

        </x-form.card>

    </div>

@endsection
