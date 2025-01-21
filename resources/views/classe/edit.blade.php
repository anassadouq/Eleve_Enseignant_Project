<form action="{{ route('classe.update', $classe) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="name">Nom:</label>
    <input type="text" name="name" value="{{ $classe->name }}">
    <input type="submit" value="Update">
</form>