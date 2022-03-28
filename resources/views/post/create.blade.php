@include('includes.errors')

@if (session('success'))
    {{ session('success') }}
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
