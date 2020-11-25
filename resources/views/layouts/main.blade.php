<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Nick school</title>

        <link rel="stylesheet" href="{{ mix('css/tailwind.css') }}">
    </head>
    <body class="font-sans bg-gray-900 text-white">

        @include('layouts.navbar.index')

        @yield('breadcrumbs')

        @include('layouts.partials.flash')

        <div id="app">
            @yield('content')
        </div>

        @stack('scripts')

    </body>
</html>
