@extends('layout.auth')

@section('title', 'Create Company Account')

@section('content')

    <div class="container">

        <x-form.card>

            <div class="form-header">
                <h1>REGISTER</h1>
            </div>

            <div class="form-body">
                <form action="{{ route('company.register.post') }}" method="post">
                    @csrf

                    <x-form.input name="Company_name" label="Company Name" />
                    <x-form.input name="Official_email" label="Official Email" type="email" />
                    <x-form.input name="password" label="Password" type="password" />
                    <x-form.input name="Phone_number" label="Phone Number" />
                    <x-form.input name="Address" label="Address" />

                    <x-form.button text="Create Account" />

                </form>
            </div>

            <div class="form-footer">
                <p>
                    Already have an account?
                    <a href="{{ route('company.login') }}" class="side-btn">
                        Login here
                    </a>
                </p>
            </div>

        </x-form.card>

    </div>

@endsection
