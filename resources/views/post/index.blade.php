@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Posts') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Benutzer</th>
                            <th scope="col">Kategorien</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Aktionen</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                <th scope="row">
                                    @if ($post->image_path && $post->user_id === auth()->id())
                                        <img src="{{ route('post.image', ['post' => $post->id]) }}" alt="Image" height="75" width="75">
                                    @endif
                                </th>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->user?->name }}</td>
                                <td>
                                    @foreach ($post->categories as $category)
                                        <span class="badge bg-primary">{{ $category->name }}</span>
                                    @endforeach
                                </td>
                                <td>{{ $post->created_at }}</td>
                                <td>
                                    <a href="{{ route('post.show', ['post' => $post->id]) }}" class="btn btn-sm btn-success">Anzeigen</a>
                                    <a href="{{ route('post.edit', ['id' => $post->id]) }}" class="btn btn-sm btn-primary">Bearbeiten</a>
                                    <a href="{{ route('post.image', ['post' => $post->id]) }}" class="btn btn-sm btn-primary" target="_blank">Bild</a>
                                    <form action="{{ route('post.destroy') }}" method="POST" onsubmit="return confirm('Möchtest du den Post wirklich löschen?');">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $post->id }}">
                                        <input type="submit" class="btn btn-sm btn-danger" value="Löschen">
                                    </form>
                                </td>
                              </tr>
                            @endforeach
                        </tbody>
                      </table>

                      {{ $posts->links() }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
