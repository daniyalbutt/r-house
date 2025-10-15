<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="{{ asset($favicon) }}">
    <title>{{ config('app.name') }}</title>
    @include('layouts.components.css')
    <style>
        .myaccount-tab-menu.nav a {
            display: block;
            padding: 10px 25px;
            font-size: 14px;
            align-items: center;
            width: 100%;
            color: inherit;
            border-radius: 0;
            border: 1px solid #25282a;
            margin-bottom: 15px;
            font-family: var(--heading--font-family);
            text-transform: uppercase;
            text-decoration: none;
            transition: 0.5s;
            font-weight: 600;
            border-radius: 50px;
        }

        .myaccount-tab-menu.nav a.active {
            background: #C59D5F;
            color: white;
        }

        section.dashboardSection {
            padding: 0;
            padding-bottom: 60px;
        }

        .myaccount-tab-menu.nav a:hover {
            background: #C59D5F;
            color: white;
        }

        .myaccount-tab-menu.nav a i {
            margin-right: 2px;
        }
    </style>
    @stack('css')
</head>

<body>

    @include('layouts.components.header')
    @yield('content')
    @include('layouts.components.footer')

    {{--  @include('layouts.components.modal')  --}}


    @include('layouts.components.script')
    @stack('js')





</body>

</html>
