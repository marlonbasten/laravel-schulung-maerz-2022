@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Post erstellen') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <form action="{{ route('post.store') }}" method="POST">
                        @csrf
                        <input type="text" name="title" value="{{ old('title') }}">
                        @error('title')
                            <p>{{ $message }}</p>
                        @enderror
                        <br><br>
                        <textarea name="content"></textarea>
                        <br><br>
                        <input type="submit" value="Speichern">
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
