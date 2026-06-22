<!DOCTYPE html>
<html lang="en">

<head>
    @php
        use App\HelperFunctions ; 
    @endphp
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    @include('shared.partials.error-handiling')
    @include('shared.partials.alert')
    <div class="app-container">
        {{-- <header class="app-header">
            <div class="left">
                <h2>Dashboard</h2>
                <small>somthing here </small>
            </div>
            <div class="center">
                <form class="search" method="GET" action="#">

                    <i class="fa-solid fa-magnifying-glass"></i>

                    <input type="text" name="q" placeholder="Search...">

                </form>
            </div>
            <div class="right">

                <form action="{{ route('company.logout') }}" method="POST">

                    @csrf

                    <button type="submit" class="logout-btn">
                        Logout
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>

                </form>

            </div>
        </header> --}}

        @yield('header')


        @yield('aside-bar')

        <main class="app-main">@yield('content')</main>
    </div>

</body>

</html>
