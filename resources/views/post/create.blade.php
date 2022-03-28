@include('includes.errors')

<form action="{{ route('post.store') }}" method="POST">
    @csrf
    <input type="text" name="name" value="{{ old('name') }}">
    @error('name')
        <p>{{ $message }}</p>
    @enderror
    <br><br>
    <input type="text" name="age">
    <br><br>
    <input type="submit" value="Speichern">
</form>
