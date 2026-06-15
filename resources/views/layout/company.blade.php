@extends('layout.app')

@section('title', 'Company Manegment')
@section('header')
    <x-layout.header title="Dashboard" subtitle="Welcome back" searchRoute="#" logoutRoute="company.logout" />
@endsection
@section('aside-bar')

    <x-layout.sidebar title="Management" :items="config('sidebar.company')">

        {{ auth('company')->user()->Company_name ?? '' }}
    </x-layout.sidebar>
@endsection
