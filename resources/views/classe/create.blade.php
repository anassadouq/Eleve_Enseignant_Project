<form action="{{ route('classe.store') }}" method="POST">
    @csrf
    <label>Name:</label>
    <input type="text" name="name" required>
    <input type="submit" value="Create">
</form>