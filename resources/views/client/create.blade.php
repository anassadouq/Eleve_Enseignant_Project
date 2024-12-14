<form action="{{ route('client.store') }}" method="POST">
    @csrf
    <label>Nom:</label>
    <input type="text" name="nom" required><br><br>
    <label>Adresse:</label>
    <input type="text" name="adresse" required><br><br>
    <label>Tel:</label>
    <input type="text" name="tel" required><br><br>
    <input type="submit" value="Create">
</form>