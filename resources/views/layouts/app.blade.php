<!DOCTYPE html>
<html lang="de">
    <head>
        <title>{{ config('app.name') }}</title>
    </head>
    <body>

        <ul>
            {{-- <li><a href="{{ route('test') }}">Test</a></li> --}}
            <li><a href="{{ route('test2') }}">Test 2</a></li>
        </ul>

        @yield('content')

        @yield('scripts')
    </body>
</html>
