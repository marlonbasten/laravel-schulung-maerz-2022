@extends('layouts.app')

@section('content')

    <h1>{{ __('This is my test2 file!') }}</h1>

    <h2>{{ __('general.age', ['age' => $age]) }}</h2>

    {{ trans_choice('Mein Satz', 2) }}

    @include('includes.list', [
        'users' => $users,
    ])

    <a href="{{ route('switchLocale', ['locale' => 'en']) }}"><button>EN</button></a>
    <a href="{{ route('switchLocale', ['locale' => 'de']) }}"><button>DE</button></a>

@endsection
