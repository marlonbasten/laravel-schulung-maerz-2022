@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Post bearbeiten') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('post.update', ['id' => $post->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="form-label">Titel</label>
                            <input type="text" name="title" class="form-control" id="title" value="{{ $post->title }}">
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Inhalt</label>
                            <textarea name="content" id="content" class="form-control">{{ $post->content }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="categories" class="form-label">Kategorien</label>
                            <select name="categories[]" id="categories" class="form-control" multiple>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if($post->categories()->where('categories.id', $category->id)->first()) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Speichern</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
