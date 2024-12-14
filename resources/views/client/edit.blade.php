<form action="{{ route('client.update', $client) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="nom">Nom:</label>
    <input type="text" name="nom" value="{{ $client->nom }}" required><br><br>
    <label for="adresse">Adresse:</label>
    <input type="text" name="adresse" value="{{ $client->adresse }}" required><br><br>
    <label for="tel">Tel:</label>
    <input type="text" name="tel" value="{{ $client->tel }}" required><br><br>
    <input type="submit" value="Update">
</form>