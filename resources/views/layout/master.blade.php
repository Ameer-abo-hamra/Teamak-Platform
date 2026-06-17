<!DOCTYPE html>
<html lang="en">

<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <title>@yield('title', 'Email')</title>

    <style>
        :root {
            --aside-bg-color: #1e293b;
            --button-bg-color: #2563eb;
            --content-section-bg-color: #f0f4f8;
            --border-color: #ffffff45;
            --text-color: #ffffffb5;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
            background-color: var(--content-section-bg-color);
            color: #111;
        }

        .email-wrapper {
            width: 100%;
            padding: 30px 0;
        }

        .email-container {
            max-width: 600px;
            margin: auto;
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            overflow: hidden;
        }

        .email-header {
            background: var(--aside-bg-color);
            color: var(--text-color);
            padding: 20px;
            text-align: center;
        }

        .email-body {
            padding: 30px;
        }

        .email-footer {
            background: #f8fafc;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px solid var(--border-color);
        }

        .btn {

            border: none;
            padding: 10px;
            background: var(--button-bg-color);
            color: white;
            font-weight: bold;
            border-radius: 10px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all .2s;
        }


        .btn:hover {
            opacity: 0.9;
        }
    </style>
</head>

<body>

    <div class="email-wrapper">
        <div class="email-container">

            {{-- HEADER --}}
            <div class="email-header">
                <h2>@yield('header', config('app.name'))</h2>
            </div>

            {{-- BODY --}}
            <div class="email-body">
                @yield('content')
            </div>

            {{-- FOOTER --}}
            <div class="email-footer">
                © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </div>

        </div>
    </div>

</body>

</html>
