@extends('layouts.app')

@section('content')
<h1>Das ist meine Test view!</h1>

<h2>Hallo, {{ $name }} @if($age) - Du bist {{$age}} @endif</h2>

<h1>App Name: {{ config('app.app_test_name') }}</h1>
@endsection


@section('scripts')
    <script>
        console.log('Hallo Welt!');
    </script>
@endsection
