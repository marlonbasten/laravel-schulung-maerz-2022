@extends('layouts.app')

@section('content')

    <h1>Das ist meine Test2 Datei!</h1>

    <h2>Age: {{ $age }}</h2>

    @include('includes.list', [
        'users' => $users,
    ])

@endsection
