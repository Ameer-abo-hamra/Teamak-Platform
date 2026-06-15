@extends('layout.auth')

@section('title', 'Company Login')

@section('content')


    <div class="container">

        <x-form.card>

            <div class="form-header">
                <h1>LOGIN</h1>
            </div>

            <div class="form-body">
                <form action="{{ route('company.login.post') }}" method="post">
                    @csrf

                    <x-form.input name="Official_email" label="Official Email" type="email" />
                    <x-form.input name="password" label="Password" type="password" />

                    <x-form.button text="Login" />

                </form>
            </div>

            <div class="form-footer">
                <p>
                    Don't have an account?
                    <a href="{{ route('company.register') }}" class="side-btn">
                        Create one
                    </a>
                </p>
            </div>

        </x-form.card>

    </div>
