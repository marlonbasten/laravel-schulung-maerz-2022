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

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif

                    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Titel</label>
                            <input type="text" name="title" class="form-control" id="title">
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Inhalt</label>
                            <textarea name="content" id="content" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Bild</label>
                            <input type="file" name="image" id="image" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="sendMail" class="form-label">Email senden</label>
                            <input type="checkbox" name="sendMail" id="sendMail">
                        </div>
                        <button type="submit" class="btn btn-primary">Speichern</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function createPost() {
        $.ajax({
        type: "POST",
        url: '{{ route('post.store') }}',
        data: {
            '_token': '{{ csrf_token() }}',
            'title': 'Mein Test Post',
            'content': 'Das ist mein jQuery Content :)',
            'sendMail': false
        },
        success: function (data) {
            const json = JSON.parse(data);
            console.log(data.message);
            console.log(json);
        },
        dataType: 'json'
    });
    }
</script>
@endsection
