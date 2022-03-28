<!DOCTYPE html>
<html lang="de">
    <head>
        <title>{{ config('app.name') }}</title>
    </head>
    <body>

        <ul>
            <li>Home</li>
            <li>Test</li>
        </ul>

        @yield('content')

        @yield('scripts')
    </body>
</html>
