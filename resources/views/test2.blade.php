@extends('layouts.app')

@section('content')

    <h1>Das ist meine Test2 Datei!</h1>

    @include('includes.list', [
        'users' => ['Nutzer1', 'Nutzer2', 'Nutzer3'],
    ])

@endsection
