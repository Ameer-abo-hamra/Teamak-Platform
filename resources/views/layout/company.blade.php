<!DOCTYPE html>
<html lang="en">

<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Company Management')</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>


<body>

    @include('shared.partials.error-handiling')
    @include('shared.partials.company-navbar')
    @yield('content')
</body>

</html>
