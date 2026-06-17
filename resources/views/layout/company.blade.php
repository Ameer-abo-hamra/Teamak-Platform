@extends('layout.app')

@section('title')
    @yield('custom-title')
@endsection
@section('header')
    @yield('custom-header')
@endsection
@section('aside-bar')
    <x-layout.sidebar title="Management" :items="config('sidebar.company')">

        {{ auth('company')->user()->Company_name ?? '' }}
    </x-layout.sidebar>
@endsection

@section('content')

@yield('custom-content')
@endsection
